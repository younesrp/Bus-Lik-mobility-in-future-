<?php
class Db {
    private static ?PDO $connect = null;
    private static $host = "localhost";
    private static $db_name = "buslik";
    private static $password = "";
    private static $user = "root";
    private static $port = 3307;

    public static function connection(): PDO {
        if (self::$connect === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$db_name;
                self::$connect = new PDO($dsn, self::$user, self::$password);
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // For hackathon: send as JSON instead of echo
                echo json_encode(["status" => "error", "message" => "Database connection failed: " . $e->getMessage()]);
                exit;
            }
        }
        return self::$connect;
    }
}
?>
