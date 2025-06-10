<?php

    class Session {

        static function start() {
            session_set_cookie_params([
                'secure' => isset($_SERVER['HTTPS']),
                'httponly' => true, // Utilisation que par http donc pas de js
                'samesite' => 'Strict' // Utilisation de session que sur le dashboard
            ]);

            session_start();
            session_regenerate_id(true);
        }

        static function loginUser($userId) {
            $_SESSION['isLogged'] = true;
            $_SESSION['userId'] = $userId;
            $_SESSION['lastSeen'] = time();
        }

        static function logoutUser() {
            session_unset(); // Vide la session
            
            // Suppression du cookie
            $params = session_get_cookie_params();
            setcookie(
                session_name(), 
                '', 
                time() - 60, 
                $params['path'], 
                $params['domain'], 
                $params['secure'], 
                $params['httponly']
            );

            // Destruction de la session
            session_destroy();
        }

        static function isUserLogged() {
            if(isset($_SESSION['isLogged']) && $_SESSION['isLogged'] === true && isset($_SESSION['userId'])) {
                if (isset($_SESSION['lastSeen']) && (time() - $_SESSION['lastSeen'] > 60*30)) { // 30 minutes
                    self::logoutUser();
                    return false;
                }
                $_SESSION['lastSeen'] = time();
                return true;
            }
            return false;
        }
    }

?>