<?php
    class DB {
        private static $db;
        public static function getDB() {
            if (self::$db == null) {
                self::$db = new mysqli("localhost", "root", "", "upload");
            }
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                exit();
            }
            return self::$db;
        }
    }
?>