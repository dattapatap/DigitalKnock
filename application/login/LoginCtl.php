<?php
require_once('LoginPst.php');

if(isset( $_POST['login'] )) {
    $jsnHttpResponse = array();
    $jsnData=$_POST['login'];
    $jsn=json_decode($jsnData,true);
    $loginId = $jsn['loginId'];
    $password = $jsn['password'];
    $login = new LoginPst();
    $user = $login->validateLogin($loginId, $password);
    if($user){
            $jsnHttpResponse["status"]=true;
            $jsnHttpResponse["url"] = "home.php";
    }else{
        $jsnHttpResponse["status"]=false;
        $jsnHttpResponse["message"]="Invalid UserId OR Password";
    }
    $jsn=json_encode($jsnHttpResponse);
    echo $jsn;
    exit();
}

Class LoginCtl{


	
	
}
?>
