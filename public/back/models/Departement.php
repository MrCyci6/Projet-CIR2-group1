<?php

    class Departement {

        public static function getAll(int $page, int $rows) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT * FROM departement
                    ORDER BY code ASC
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

        public static function getPageNumber(int $rows) {           
            return ceil(Departement::getCount()/$rows);
        }
    }

?>