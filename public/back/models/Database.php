<?php
    require_once __DIR__ . '/../config/constants.php';

    class Database {
        static $db = "";
        
        static function getConnection() {
            if(Database::$db != null)
                return Database::$db;
            
            $dsn = "mysql:dbname=".DB_NAME.";host=".DB_SERVER.";port=".DB_PORT;
            $username = DB_USER;
            $password = DB_PASSWORD;
            try {
                $conn = new PDO($dsn, $username, $password);
            } catch (PDOException $e) {
                error_log("Error while connection to database: ".$e->getMessage());
                return false;
            }
            
            Database::$db = $conn;
            return $conn;
        }
        
        static function preparedQuery(string $request, array $params) {
            try {
                $conn = Database::getConnection();
                if(!$conn) return false;
                
                $statement = $conn->prepare($request);
                $statement->execute($params);
                
                return $statement;
            } catch(PDOException $e) {
                error_log('Prepared query error: '.$e->getMessage());
                return false;
            }
        }
    }
?>