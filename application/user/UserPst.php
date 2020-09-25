<?php  
require_once(__DIR__."/../connection/DBConnection.php");

class UserPst{
	

	public function delete($user){
		$conn = DBConnection::getConnection();
	    $sqlQuery="update tbl_user set  is_deleted= true  where id= '$user'";
			// echo $sqlQuery;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sqlQuery);
		$res = $stmt->execute();
			
		return $res;
	}


	public function update($user){
			$conn = DBConnection::getConnection();
			
			$vintId=$user->getId();
			$vstrname=$user->getName();
			$vstrEmail=$user->getEmail();
			$vstrPhone=$user->getPhone();
            try{
				
				$sqlQuery="update tbl_user set  email='$vstrEmail', phone='$vstrPhone', name='$vstrname'  where id= '$vintId'";
				// echo $sqlQuery;
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($sqlQuery);
                $res = $stmt->execute();
				
            }catch(Exception $ex){
                 echo $ex->getMessage();    
            }               
            return $user;
	}
   
	public function save($pobjUser){
	        $conn = DBConnection::getConnection();
			
			$vintId=$pobjUser->getId();
			$vstrname=$pobjUser->getName();
			$vstrEmail=$pobjUser->getEmail();
			$vstrPhone=$pobjUser->getPhone();
      

			$sqlQuery="insert into tbl_user (NAME,PHONE,EMAIL)values('$vstrname','$vstrPhone','$vstrEmail')";
			
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($sqlQuery);
			$res = $stmt->execute();

			$vintUserId = $conn->lastInsertId();
			$pobjUser->setId($vintUserId);
			return $pobjUser;
	}	
	
	public function getUserById($pintUserId){
		$vobjUser = '';
		$vintUserId= $pintUserId;
		$conn = DBConnection::getConnection();
		try{
		$query = "select * from tbl_user where ID='$vintUserId'";
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$stmt=$conn->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows=$stmt->fetch();
		if($rows){		
			$vobjUser = new User($rows['id'],$rows['name'],$rows['email'],$rows['phone']);
			
		}			
		}catch(Exception $ex){
               echo $ex->getMessage();    
        } 
		
		return $vobjUser;
	}

	public function getUserImage($pintUserId){
		$vobjUserArray = array();
		$vintUserId= $pintUserId;
		$conn = DBConnection::getConnection();
		try{
		$query = "select * from tbl_images where u_id='$vintUserId' ORDER BY ID DESC";
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$stmt=$conn->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows=$stmt->fetchAll();
		foreach($rows as $row){    	
			array_push($vobjUserArray, $row);			
		}			
		}catch(Exception $ex){
               echo $ex->getMessage();    
        } 
		
		return $vobjUserArray;
	}
	public function saveImage($userId, $file){
		$conn = DBConnection::getConnection();
		$sqlQuery="insert into tbl_images (u_id,image)values($userId,'$file')";
		
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sqlQuery);
		$res = $stmt->execute();
		return $res;
	}
    
    public function checkEmailexist($pstrEmail){
        $status= '';
		$conn = DBConnection::getConnection();
		try{
		$query = "select * from tbl_user where EMAIL='$pstrEmail'";
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$stmt=$conn->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows=$stmt->fetch();
		if($rows){		
			$status = true;	
        }else{
            $status = false;
        }			
		}catch(Exception $ex){
               echo $ex->getMessage();    
        } 		
		return $status;
	}
    

	
}

?>