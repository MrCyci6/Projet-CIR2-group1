<?php

    class Onduleur {
        public static function get(int $id) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT p.id, pm.id as id_modele, pm.denomination as modele, m.id as id_marque, m.denomination as marque FROM onduleur p 
                    INNER JOIN onduleur_modele pm ON pm.id=p.id_modele 
                    INNER JOIN marque m ON m.id=p.id_marque
                    WHERE p.id = $id;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getModeleCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) AS total FROM onduleur_modele;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getMarqueCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(DISTINCT id_marque) AS total FROM onduleur;",
                    []
                );

                $result = $statement->fetch();
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result["total"];
        }

        public static function getMarquePageNumber(int $rows) {           
            return ceil(Onduleur::getMarqueCount()/$rows);
        }

        public static function getAllMarque(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT DISTINCT(m.denomination), m.id FROM onduleur o 
                    INNER JOIN marque m ON o.id_marque=m.id
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

        public static function getCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM onduleur;",
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
            return ceil(Onduleur::getCount()/$rows);
        }

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT p.id, pm.id as id_modele, pm.denomination as modele, m.id as id_marque, m.denomination as marque FROM onduleur p 
                    INNER JOIN onduleur_modele pm ON pm.id=p.id_modele 
                    INNER JOIN marque m ON m.id=p.id_marque
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

        public static function add(int $id_marque, int $id_modele) {
            try {
                $statement = Database::preparedQuery(
                    "INSERT INTO onduleur(id_marque, id_modele) VALUES ($id_marque, $id_modele);",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }

        public static function remove(int $id) {
            try {
                $statement = Database::preparedQuery(
                    "DELETE FROM onduleur WHERE id=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }

        public static function update(int $id, int $id_marque, int $id_modele) {
            try {
                $statement = Database::preparedQuery(
                    "UPDATE onduleur SET id_marque=$id_marque, id_modele=$id_modele WHERE id=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }
    }

?>