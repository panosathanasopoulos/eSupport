<?php

class Emp {
  public $usr;
  public $id;
  public $fullname;
  public $msgcost;
  public $phone;
  public $address;
  public $city;

  
  function __construct() {
	$usr=new User();
	$id=0;
	$fullname="";
    $msgcost=0;
    $phone="";
    $address="";
    $city="";
  }
  
  function setEmp($id,$fullname,$msgcost,$phone,$address,$city)
  {
		$this->id=$id;
		$this->fullname=$fullname;
		$this->msgcost=$msgcost;
		$this->phone=$phone;
		$this->address=$address;
		$this->city=$city;
  }

  static function findEmpById($id)
  {
		
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from emp where id=$id";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);
			$u=new Emp();
			$u->usr=User::findUserById($r[id]);
			if($u->usr!=null)
			{
				$u->set($id,$r['fullname'],$r['msgcost'],$r['phone'],$r['address'],$r['city']);
				
				
				$u->id=$id;
				return $u;
			}
			else
			{
				return null;
			}
			

		 }
		 else
		 {
			return null;
			
		 }
		
  
  }
  
  
  static function findEmp($eml,$pss)
  {
	$u=new Emp();	
	$u->usr=User::findUser($eml,$pss);
	if($u->usr!=null)
	{
		$u=EMP::findEmpById($u->usr->id);
		if($u!=null){
			return $u;
		}
		else
		{
			return null;
		}
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
		$f=$this->fullname;
		$c=$this->city;
		$a=$this->address;
		$mc=$this->msgcost;

		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="insert into emp set id='$id', fullname='$f', msgcost='$mc', city='$c', address='$a' ";
		
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
	
	try {
		$this->usr->updateDb();
		$id=$this->id;
		$f=$this->fullname;
		$c=$this->city;
		$a=$this->address;
		$mc=$this->msgcost;

		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="update emp set  fullname='$f', msgcost='$mc', city='$c', address='$a' where id='$id'";
		
		if(mysqli_query($con,$sql))
		{
			return $this->id;
		}
		else
		{
			throw new Exception('Query Error');
		}
	}
  }
  
  
   function deleteDb() {
	
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	
		$sql="delete from emp where id=".$this->id;
	
		mysqli_query($con,$sql);
  }
  
  
  
  
   static function getAll() {
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="select * from emp";
	
	$q=mysqli_query($con,$sql);
	$A=[];
	while($r=mysqli_fetch_assoc($q))
	{
		$u=new Emp();
		
		 
		$u->findEmpById($r['id']);
		$A[]=$u;
		
	}
	
	return json_encode($A);
  }
  
  
 
}

