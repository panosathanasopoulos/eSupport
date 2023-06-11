<?php

class Admin {
  public $usr;
  public $id;

  
  function __construct() {
	$usr=new User();
	$id=0;
  }
  
  function setAdmin($id)
  {
		$this->id=$id;
  }

  static function findAdminById($id)
  {
		
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from admins where id=$id";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);

			
			$this->usr=User::findUserById($r[id]);
			$this->id=$id;
			
			return $u;

		 }
		 else
		 {
			return null;
			
		 }
		
  
  }
  
  
  static function findAdmin($eml,$pss)
  {
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from users inner join admins on users.id=admins.id where email='$eml' and password='$pss'";
		$q=mysqli_query($con,$sql);
		if(mysqli_num_rows($q)>0)
		{
			$r=mysqli_fetch_assoc($q);
			$this->usr->set($r['id'],$r['email'],$r['password']);
			$this->id=$r['id'];

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
	try{
		$this->usr->insertDb();
		$id=$this->id;
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="insert into admin set id='$id'";
		
		if(mysqli_query($con,$sql))
		{
			return $this->id;
		}
		else
		{
			throw new Exception('Query Error');
		}
	}
	catch(Exception $e)
	{
		throw new Exception('Query Error');
	}
  }
  
  function updatePass()
  {
	$this->usr->updatePass();

  }

   function updateDb() {
	$this->usr->updateDb();
	
	
  }
  
  
   function deleteDb() {
	
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	
		$sql="delete from admin where id=".$this->id;
	
		mysqli_query($con,$sql);
  }
  
  
  
  
   static function getAll() {
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="select * from admin";
	
	$q=mysqli_query($con,$sql);
	$A=[];
	while($r=mysqli_fetch_assoc($q))
	{
		$u=new Admin();
		
		 
		$u->findAdminById($r['id']);
		$A[]=$u;
		
	}
	
	return json_encode($A);
  }
  
  
 
}

