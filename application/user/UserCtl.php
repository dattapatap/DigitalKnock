<?php 
require_once('User.php');
require_once('UserSvc.php');

if(isset( $_POST['userSave'] )) {
    $userCtl = new UserCtl();
    $userCtl->save();
}

if(isset( $_POST['deleteUser'] )) {
    $userCtl = new UserCtl();
    $userCtl->delete($_POST['deleteUser']);
}
if(isset( $_POST['getUser'] )) {
    $userCtl = new UserCtl();
    $userCtl->getUserById($_POST['getUser']);
}
if(isset( $_POST['getUserImage'] )) {
    $userCtl = new UserCtl();
    $userCtl->getUserImage($_POST['getUserImage']);
}
if(isset($_FILES['fileName'])) {
	$jsnHttpResponse = array();
	$userSvc = new UserSvc();
	$userStm =  $userSvc->AddNewImage();
	if($userStm){
		$jsnHttpResponse["status"]=true;
		$jsnHttpResponse["data"]="Image Uploaded";      
	}else{
		$jsnHttpResponse["status"]=false;
		$jsnHttpResponse["data"]="Image Not Uploaded, please try again.";
	}
	$jsn=json_encode($jsnHttpResponse);
	echo $jsn;
	exit();
}


class UserCtl{
	public function save(){
	
		$jsnData=$_POST['userSave'];
		$vjsn=json_decode($jsnData,true);
		$vobjUser = new User($vjsn['id'],$vjsn['name'],$vjsn['email'], $vjsn['phone']);
			
		$objUserSvc = new UserSvc();
		$vobjUser = $objUserSvc->save($vobjUser);   
		if($vobjUser->getId() > 0){            
				$httpResponce['data']='User Saved Successfully';
				$httpResponce['status']=true;
		}else{
					$httpResponce['status']=false;
					$httpResponce['data']='User not saved, please try again';
		}	
		$jsn = json_encode($httpResponce);
		echo $jsn;
		exit;
	}
	
	public function delete($userId){
		$objUserSvc = new UserSvc();
		$vintStatus = $objUserSvc->delete($userId);   
		if($vintStatus){            
				$httpResponce['data']='User Deleted.';
				$httpResponce['status']=true;
			}else{
				$httpResponce['status']=false;
				$httpResponce['data']="User Not Deleted, Please try again";
		}
		$jsn = json_encode($httpResponce);
		echo $jsn;
		exit();
		
	}
   
	public function getUserById($userId){
		$vobjUserSvc = new UserSvc();
		$vobjUser = $vobjUserSvc->getUserById($userId);	
		if($vobjUser){
			$jsnHTTPResponse['status']=true ;
			$jsnHTTPResponse['user'] = [ 'id'=>$vobjUser->getId(),
											'name'=>$vobjUser->getName(), 
											'phone'=>$vobjUser->getPhone(), 
											'email'=>$vobjUser->getEmail() 
									    ];
			
		}else{
			 $jsnHTTPResponse['status']=false;
		}
	   $jsn=json_encode($jsnHTTPResponse);
	   echo $jsn; 
	}

	public function getUserImage($userId){
		$jsonArray = array();
		$jsnHttpResponse = array();
		$vobjUserSvc = new UserSvc();
		$vobjUser = $vobjUserSvc->getUserImage($userId);	
		if($vobjUser){
			for($ctr=0; $ctr < count($vobjUser); $ctr++){
				array_push( $jsonArray,['id'=>$vobjUser[$ctr]['id'],
										'image'=>$vobjUser[$ctr]['image']
									]);
			}
			$jsnHttpResponse['status'] = true; 
			$jsnHttpResponse['data'] = $jsonArray; 
		
		}else{
			 $jsnHTTPResponse['status']=false;
		}
	   $jsn=json_encode($jsnHttpResponse);
	   echo $jsn; 
	   exit();

	}
  
	
}
?>
