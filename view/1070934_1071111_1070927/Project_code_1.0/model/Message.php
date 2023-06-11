<?php

class Message {
	  public $id;
	  public $id_to;
	  public $id_from;
	  public $minima;
	  public $date1;
	  public $idm;
	  

	 function __construct() {
		$this->name = "";
		$this->id = "";
		$this->id_to = "";
		$this->id_from = "";
		$this->minima = "";
		$this->idm="";
		$this->date1=date("Y-m-d h:i:sa");
	
	}
	
	function setMinima($id,$id_to, $id_from,$msg,$dt)
	{
		
		$this->id = $id;
		$this->id_to = $id_to;
		$this->id_from = $id_from;
		$this->minima=$msg;
		$this->date1=$dt;
	}
	
	
	static function findMsg($id)
	{
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from messages where id=$id";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$r=mysqli_fetch_assoc($q);
			$a=new Message();
			try{
			$a->setMinima($r["id"],$r["id_to"],$r["id_from"],$r["minima"],$r["date1"]);
			return $a;
			}
			catch (Exception $e)
			{
			
			return null;
			}
		 
		 }
		 else
		 {
			return null;
			
		 }
		
	
	}
	

	static function findbyto($idu)
	{
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from messages where id_to=$idu";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$A=[];
			while($r=mysqli_fetch_assoc($q))
			{
				$a=new Message();
				
				$a->setMinima($r["id"],$r["id_to"],$r["id_from"],$r["minima"],$r["date1"]);
				$A[]=$a;
				
			}
			return json_encode($A);
		 
		 }
		 else
		 {
			return null;
			
		 }
		
	
	}
	

	static function findbyfrom($idu)
	{
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from messages where id_from=$idu";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$A=[];
			while($r=mysqli_fetch_assoc($q))
			{
				$a=new Message();
				
				$a->setMinima($r["id"],$r["id_to"],$r["id_from"],$r["minima"],$r["date1"]);
				$A[]=$a;
				
			}
			return json_encode($A);
		 
		 }
		 else
		 {
			return null;
			
		 }
	}
	
	  
	
	
	static function findAll()
	{
		$con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
		$sql="select * from messages,users where id_from=users.id order by date1";
		
		 $q=mysqli_query($con,$sql);
		 if(mysqli_num_rows($q)>0)
		 {
			$A=[];
			while($r=mysqli_fetch_assoc($q))
			{
				
				
				$A[]=$r;
			
				
			}
			return json_encode($A);
		 
		 }
		 else
		 {
			return null;
			
		 }
	}
	
  function replayto($idm)
  {
	$this->idm=$idm;
  }	
	
  function insertDb() {
    $con=mysqli_connect($GLOBALS["server"],$GLOBALS["userdb"],$GLOBALS["pssdb"],$GLOBALS['database']);
	$sql="insert into messages set minima='".$this->minima."', idm='".$this->idm."',
			id_to='".$this->id_to."', id_from='".$this->id_from."',date1=now()";
	
	$this->date1=date("Y-m-d h:i:sa");
	if(mysqli_query($con,$sql))
	{
		$this->id = mysqli_insert_id($con);
	}
	else
	{
		throw new Exception('Query Error');
	}
  }
  
  
   




}