<?php
require_once(__DIR__."/../connection/DBConnection.php");


class LoginPst{

    public function validateLogin($pstrLoginId, $pstrPassword){
			$login = '';
		
		    try{
                $SQLStmt = "SELECT * from tbl_login WHERE email='$pstrLoginId' and password='$pstrPassword'";
            
                $conn=DBConnection::getConnection();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($SQLStmt);
                $stmt->execute();
                $row = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                $login = $stmt->fetch();
			}catch(Exception $ex){
				echo $ex->getMessage();
			}	
            return $login;
    }
}
?>
