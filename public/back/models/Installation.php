<?php

    class Installation {
        public static function getSurfaceTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(surface) as surface FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['surface'];
        }

        public static function getSurfaceAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(surface) as surface FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['surface'];
        }

        public static function getProductionTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(production_pvgis) as production FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['production'];
        }

        public static function getProductionAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT AVG(production_pvgis) as production FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['production'];
        }
        
        public static function getPuissanceTotal() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT SUM(puissance_crete) as puissance FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['puissance'];
        }
        
        public static function getPuissanceAverage() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT AVG(puissance_crete) as puissance FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['puissance'];
        }

        public static function search(string $query, int $page, int $rows, $id_onduleur, $id_panneau, $code_departement, $annee) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT i.id as id_installation, i.annee, pm.denomination as panneau, om.denomination as onduleur, l.cp, l.denomination as localite, d.denomination as departement, r.denomination as region FROM installation i 
                    INNER JOIN onduleur o ON o.id=i.id_onduleur 
                    INNER JOIN onduleur_modele om ON om.id=o.id_modele 
                    INNER JOIN panneau p ON p.id=i.id_panneau 
                    INNER JOIN panneau_modele pm ON pm.id=p.id_modele
                    INNER JOIN localite l ON l.code_insee=i.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    INNER JOIN region r ON r.code=d.code_region
                    WHERE (
                        LOWER(pm.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(om.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(d.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(r.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR CAST(l.cp AS VARCHAR(255)) LIKE LOWER(CONCAT('%', ?, '%'))
                    ) ".
                    ($id_onduleur != null ? "AND o.id=$id_onduleur " : "").
                    ($id_panneau != null ? "AND p.id=$id_panneau " : "").
                    ($code_departement != null ? "AND LOWER(d.code)=LOWER(?) " : "").
                    ($annee != null ? "AND i.annee=$annee " : "").
                    " ORDER BY i.id ASC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    (
                        $code_departement != null ?
                        [$query, $query, $query, $query, $query, $code_departement] :
                        [$query, $query, $query, $query, $query]
                    )
                );

                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }
        
        public static function getSearchCount(string $query, int $page, int $rows, $id_onduleur, $id_panneau, $code_departement, $annee) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(i.id) as total FROM installation i 
                    INNER JOIN onduleur o ON o.id=i.id_onduleur 
                    INNER JOIN onduleur_modele om ON om.id=o.id_modele 
                    INNER JOIN panneau p ON p.id=i.id_panneau 
                    INNER JOIN panneau_modele pm ON pm.id=p.id_modele
                    INNER JOIN localite l ON l.code_insee=i.code_insee
                    INNER JOIN departement d ON d.code=l.code_departement
                    INNER JOIN region r ON r.code=d.code_region
                    WHERE (
                        LOWER(pm.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(om.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(d.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR LOWER(r.denomination) LIKE LOWER(CONCAT('%', ?, '%'))
                        OR CAST(l.cp AS VARCHAR(255)) LIKE LOWER(CONCAT('%', ?, '%'))
                    ) ".
                    ($id_onduleur != null ? "AND o.id=$id_onduleur " : "").
                    ($id_panneau != null ? "AND p.id=$id_panneau " : "").
                    ($code_departement != null ? "AND LOWER(d.code)=LOWER(?) " : "").
                    ($annee != null ? "AND i.annee=$annee " : "").
                    " ORDER BY i.id ASC
                    LIMIT $rows OFFSET ".($page-1)*$rows.";",
                    (
                        $code_departement != null ?
                        [$query, $query, $query, $query, $query, $code_departement] :
                        [$query, $query, $query, $query, $query]
                    )
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result['total'];
        }

        public static function get(int $id) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT * FROM installation
                    WHERE id = $id;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM installation;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getPageNumber(int $rows) {           
            return ceil(Installation::getCount()["total"]/$rows);
        }

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT * FROM installation
                    ORDER BY annee DESC
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

        public static function remove(int $id) {
            try {
                Database::preparedQuery(
                    "DELETE FROM installation WHERE id=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }

        public static function add(
            int $puissance_crete, int $surface, int $pente, int $pente_optimum, int $orientation, int $orientation_optimum, 
            int $production_pvgis, string $political, int $annee, int $mois, float $latitude, float $longitude, 
            int $code_insee, int $id_installateur, int $id_panneau, int $nb_panneau, int $id_onduleur, int $nb_onduleur
        ) {
            
            try {
                Database::preparedQuery(
                    "INSERT INTO installation(puissance_crete, surface, pente, pente_optimum, orientation, orientation_optimum, production_pvgis, political,
                    annee, mois, latitude, longitude, code_insee, id_installateur, id_panneau, nb_panneau, id_onduleur, nb_onduleur)
                    VALUES ($puissance_crete, $surface, $pente, $pente_optimum, $orientation, $orientation_optimum, $production_pvgis, ?,
                    $annee, $mois, $latitude, $longitude, $code_insee, $id_installateur, $id_panneau, $nb_panneau, $id_onduleur, $nb_onduleur);",
                    [$political]
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }

            return true;
        }
    }

?>