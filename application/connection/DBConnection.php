<?php
    class DBConnection {
        public static $dbConn=null;
		
        public static function getConnection(){
            $servername = "localhost";
            $username = "root";
            $dbname = "digitalKnock";	
				
            $conn;
			
            try {
                self::$dbConn = new PDO("mysql:host=$servername;dbname=$dbname", $username);
                self::$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            return self::$dbConn;
        }

    }

?>
