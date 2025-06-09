<?php

    class Installateur {
        public static function getCount() {
            try {
                $statement = Database::preparedQuery(
                    "SELECT COUNT(*) as total FROM installateur;",
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
            return ceil(Installateur::getCount()/$rows);
        }

        public static function get(int $id) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT * FROM installateur
                    WHERE id=$id;",
                    []
                );

                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT * FROM installateur
                    ORDER BY id DESC
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

        public static function add(string $nom) {
            try {
                $statement = Database::preparedQuery(
                    "INSERT INTO installateur(denomination) VALUES (?);",
                    [$nom]
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
                    "DELETE FROM installateur WHERE id=$id;",
                    []
                );
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return true;
        }

        public static function update(int $id, string $denomination) {
            try {
                $statement = Database::preparedQuery(
                    "UPDATE installateur SET denomination=? WHERE id=$id;",
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