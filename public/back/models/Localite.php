<?php

    class Localite {
        public static function get(int $code_insee) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT l.code_insee, l.denomination, l.cp, l.population, d.code as dep_code, d.denomination as departement, r.code as reg_code, r.denomination as region, p.id as id_pays, p.denomination as pays FROM localite l 
                    INNER JOIN departement d ON d.code=l.code_departement 
                    INNER JOIN region r ON r.code=d.code_region 
                    INNER JOIN pays p ON p.id=r.id_pays
                    WHERE l.code_insee = $code_insee;",
                    []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getPaysCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM pays;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getDepartementCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM departement;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getRegionCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM region;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM localite;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getPageNumber(int $rows) {           
            return ceil(Localite::getCount()/$rows);
        }

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT l.code_insee, l.denomination, l.cp, l.population, d.code as dep_code, d.denomination as departement, r.code as reg_code, r.denomination as region, p.id as id_pays, p.denomination as pays FROM localite l 
                    INNER JOIN departement d ON d.code=l.code_departement 
                    INNER JOIN region r ON r.code=d.code_region 
                    INNER JOIN pays p ON p.id=r.id_pays
                    ORDER BY RAND() ASC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    []
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function add(int $code_insee, string $nom, int $cp, int $population) {
            try {
                $statement = Database::preparedQuery(
                    "INSERT INTO localite(code_insee, denomination, cp, population) VALUES ($code_insee,?,$cp,$population);",
                    [$nom]
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }

        public static function remove(int $code_insee) {
            try {
                Database::preparedQuery(
                    "DELETE FROM localite WHERE code_insee=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }

        public static function update(int $code_insee, string $denomination, int $cp, int $population) {
            try {
                $statement = Database::preparedQuery(
                    "UPDATE installateur SET denomination=?, cp=$cp, population=$population WHERE code_insee=$code_insee;",
                    [$denomination]
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }
    }

?>