<?php

class Customer {
  public $usr;
  public $id;
  public $fullname;
  public $phone;
  public $address;
  public $city;

  
  function __construct() {
	$usr=new User();
	$id=0;
	$fullname="";
    $phone="";
    $address="";
    $city="";
  }
  
  function setCustomer($id,$fullname,$phone,$address,$city)
  {
		$this->id=$id;
		$this->fullname=$fullname;
		$this->phone=$phone;
		$this->address=$address;
		$this->city=$city;
  }

  static function findCustomerById($id)
  {
		
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from customers where id=$id";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);
			$u=new Customer();
			$u->usr=User::findUserById($r[id]);
			if($u->usr!=null)
			{
				$u->set($id,$r['fullname'],$r['phone'],$r['address'],$r['city']);
				
				
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
  
  
  static function findCustomer($eml,$pss)
  {
	$u=new Emp();	
	$u->usr=User::findUser($eml,$pss);
	if($u->usr!=null)
	{
		$u=EMP::findCustomerById($u->usr->id);
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
		
		$id=$this->id;
		$f=$this->fullname;
		$c=$this->city;
		$a=$this->address;
        $p=$this->phone;
		

		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="insert into customers set id='$id', fullname='$f',  city='$c', address='$a', phone='$p'";
		
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
		$p=$this->phone;

		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="update customers set  fullname='$f', phone='$p', city='$c', address='$a' where id='$id' ";
		
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
  
  
   function deleteDb() {
	
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	
		$sql="delete from customers where id=".$this->id;
	
		mysqli_query($con,$sql);
  }
  
  
  
  
   static function getAll() {
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="select * from customers";
	
	$q=mysqli_query($con,$sql);
	$A=[];
	while($r=mysqli_fetch_assoc($q))
	{
		$u=new Customer();
		
		 
		$u->findCustomerById($r['id']);
		$A[]=$u;
		
	}
	
	return json_encode($A);
  }
  
  
 
}

