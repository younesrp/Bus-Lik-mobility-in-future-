<?php
    class Db{
        private static ?PDO $connect = null;
        private static $host = "localhost";
        private static $db_name = "buslik";
        private static $password = "";
        private static $user = "root";
        private static $root = 3307;

        public static function connection(){
            if(self::$connect === null){
                try{
                     $sdn = "mysql:host=". self::$host . ";port=" . self::$root .";dbname=" . self::$db_name;
                    self::$connect = new PDO($sdn, self::$user, self::$password );
                    self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
               catch(PDOException $e){
                    echo "error" . $e->getMessage();
               }
            }
            
        }
    }

    $s = new Db();
    $s::connection();

    ?>
    