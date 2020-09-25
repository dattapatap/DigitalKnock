<?php
require_once('User.php');
require_once('UserPst.php'); 
class UserSvc{
   
	public function save($pobjUser){
		$vobjUserPst  = new UserPst();
		if($pobjUser->getId()== -1){
			$vobjUser =  $vobjUserPst->save($pobjUser);
		}else{
			$vobjUser =  $vobjUserPst->update($pobjUser);
		} 
		return $vobjUser;
	}

	public function delete($userId){
        $vobjUserPst  = new UserPst();	 
	    $user =  $vobjUserPst->delete($userId);
		return $user;
	}

	public function getUserById($pobjUserId){
        $vobjUserPst  = new UserPst();	 
	    $vobjUser =  $vobjUserPst->getUserById($pobjUserId);
		return $vobjUser;
	}
	
	public function getUserImage($pobjUserId){
        $vobjUserPst  = new UserPst();	 
	    $vobjUser =  $vobjUserPst->getUserImage($pobjUserId);
		return $vobjUser;
	}
	public function AddNewImage(){
		$userPst = new UserPst();
		$target_path = $_SERVER['DOCUMENT_ROOT'].'/images/users';
	

		$month =  rand();		
		$userId = $_POST['userId'];    
  
		$res = $userPst->saveImage($userId, $month.'_'.$_FILES['fileName']['name']);
		if($res){	  
			$vstrFileName = $month.'_'.basename($_FILES['fileName']['name']);
			move_uploaded_file($_FILES['fileName']['tmp_name'], "$target_path/$vstrFileName");
				
		}
		return $res;
	}

	
}

?>
