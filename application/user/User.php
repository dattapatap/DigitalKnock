<?php
class User{
   
    public $name;
    public $phone;
    public $email;
    
    public function __construct($id, $pstrname, $pintphone,$pstremail){

       
            $this->setId($id);
            $this->setName($pstrname);
            $this->setPhone($pintphone);
            $this->setEmail($pstremail);  
    }   

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }

	public function setName($pstrname){
        $this->name = $pstrname;
    }    
	public function getName(){
        return $this->name;
    }
    public function setPhone($pintPhone){
        $this->phone = $pintPhone;
    }    
    public function getPhone(){
        return $this->phone;
    }
    public function setEmail($pstremail){
        $this->email = $pstremail;
    }
    
	public function getEmail(){
        return $this->email;
    }
	
} 

?>
