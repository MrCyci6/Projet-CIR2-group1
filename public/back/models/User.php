<?php

    class User {
        public static function login(string $username, string $password) {
            try {
                $statement = Database::preparedQuery(
                    "SELECT id FROM user
                    WHERE denomination=? AND password=PASSWORD(?);",
                    [$username, $password]
                );

                $result = $statement->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $exception) {
                error_log('Request error: '.$exception->getMessage());
                return false;
            }
            
            return $result;
        }
    }

?>