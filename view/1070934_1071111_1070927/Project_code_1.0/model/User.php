<?php

class User {
  public $id;
  public $email;
  public $password;
  
  function __construct() {
	$this->id = "";
    $this->email = "";
	$this->password = "";
  }
  
  
  function setUser($id,$usr,$pss)
  {
		$this->id=$id;
		$this->email=$usr;
		$this->password=$pss;
  
  }
  
  
  static function findUser($eml,$pss)
  {
		$eml=htmlspecialchars($eml);
		$pss=md5($pss);
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from users where email='$eml' and password='$pss' ";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);
			
			$u=new User();
			$u->setUser($r['id'],$r['email'],$r['password']);
			
			return $u;
		 
		 
		 }
		 else
		 {
			return null;
			
		 }
		
  
  }

  
  static function findUserById($id)
  {
		
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from users where id=$id";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);
			$u=new User();
			$u->setUser($r['id'],$r['email'],$r['password']);
			
			return $u;
		 
		 
		 }
		 else
		 {
			return null;
			
		 }
		
  
  }
  
  
  
  
  
  
  function getJSON()
  {
	
	return json_encode($this);
  }
  
  
  function insertDb() {
	$eml=$this->email;
	$pss=$this->password;
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="insert into users set email='$eml', password='".md5($pss)."'";
	
	if(mysqli_query($con,$sql))
	{
		$this->id = mysqli_insert_id($con);
	}
	else
	{
		throw new Exception('Query Error');
	}
  }
  
  function updatePass()
  {
	$pss=$this->password;
	$sql="update users set password='".md5($pss)."' where id=".$this->id;

  }

   function updateDb() {
	$eml=$this->email;
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	
	$sql="update users set email='$eml'  where id=".$this->id;
	
	if(mysqli_query($con,$sql))
	{
		$this->id = mysqli_insert_id($con);
		
		
		
	}
	else
	{
		throw new Exception('Query Error');
	}
  }
  
  
   function deleteDb() {
	
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	
		$sql="delete from users where id=".$this->id;
	
		mysqli_query($con,$sql);
  }
  
  
  
  
   static function getAll() {
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="select * from users";
	
	$q=mysqli_query($con,$sql);
	$A=[];
	while($r=mysqli_fetch_assoc($q))
	{
		$u=new User();
		 
		$u->setUser($r['id'],$r['email'],$r['password']);
		$A[]=$u;
	}
	
	return json_encode($A);
  }
  
  
 
}

