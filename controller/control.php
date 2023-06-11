<?php
session_start();
include "controller/settings.php";
include "model/User.php";
include "model/Emp.php";
include "model/Admin.php";
include "model/Customer.php";
include "model/Message.php";

 
// o katalogos pou topothetoume to project
$dir="/";

$root= $_SERVER['REQUEST_URI'];
$root=str_replace($dir,"",$root);
$root=str_replace("index.php","",$root);



/// pages view ///
if($root=="/"){
		$menu="menu1.php";
		$page="page1.php";
		
		include "view/main.php";

}


/// pages view ///

// selida syndesis diaxeiristi
if($root=="/admin"){
	$menu="menu2.php";
	$page="pagea1.php";
	
	include "view/main.php";

}


// selida syndesis diaxeiristi
if($root=="/emp"){
	$menu="menu3.php";
	$page="pagee1.php";
	
	include "view/main.php";

}
// logout
if($root=="/logout"){
		session_destroy();
		session_start();
		$menu="menu1.php";
		$page="page1.php";
		
		include "view/main.php";
}

// neos xristis
if($root=="/newaccount"){
	
		$menu="menu1.php";
		$page="page2.php";
		
		
		include "view/main.php";
}



// selida syndesis xristi
if($root=="/loginuser"){
	if($_SESSION["uid"]=="")
	{
	echo "Error. You must login";
	die();
	}
	
	$u=User::findUserById($_SESSION["uid"]);
	if ($u==null)
	{
		$menu="menu1.php";
		$page="page1.php";
		
		
	}
	else{
		$menu="menucustomer.php";
		$page="pagelogin.php";
		include "view/main.php";
	
	}
	
}


// selida syndesis diaxeiristi
if($root=="/loginadmin"){
	if($_SESSION["aid"]=="")
	{
	echo "Error. You must login";
	die();
	}
	
	$u=User::findUserById($_SESSION["aid"]);
	if ($u==null)
	{
		echo 0;
		
	}
	else{
		$menu="menuadmin.php";
		$page="pagelogin.php";
		include "view/main.php";
	
	}
	
}

// profile xristi
if($root=="/profileu"){
	$menu="menucustomer.php";
	$u=User::findUserById($_SESSION['uid']);
	$page="profileu.php";
	include "view/main.php";
}


// profile diaxiristi
if($root=="/profilea"){
	$menu="menuadmin.php";
	$u=User::findUserById($_SESSION['aid']);
	$page="profilea.php";
	include "view/main.php";
}


if($root=="/userlist"){
	$menu="menuadmin.php";
	$page="userlist.php";
	include "view/main.php";
}



if($root=="/umessages"){
	$menu="menucustomer.php";
	$M=json_encode(Message::findbyfrom($_SESSION['uid']));
	$page="messagelist1.php";
	include "view/main.php";
}



if($root=="/allmessages"){
	$menu="menuadmin.php";
	$M=json_encode(Message::findAll());
	$page="messagelist2.php";
	include "view/main.php";
}


// neos xristis
if($root=="/newmessage"){
	
	$menu="menucustomer.php";
	$page="page3.php";
	
	
	include "view/main.php";
}

// API PAGES

if(@$_GET["q"]=="ins1"){
	
		$eml=$_POST['email'];
		$pss=$_POST['pwd'];
		$fn=$_POST['fn'];
		$addr=$_POST['addr'];
		$city=$_POST['city'];
		$ph=$_POST['ph'];
		$u=new User();
		$cst=new Customer();
		try{
			$u=User::findUser($eml,$pss);
			if($u!=null)
			{
				$cst->setCustomer($u->id,$fn,$ph,$addr,$city);
				
				$cst->insertDb();

			}
			else
			{
				$u=new User();
				$u->setUser(0,$eml,$pss);
				$u->insertDb();
				
				$cst->setCustomer($u->id,$fn,$ph,$addr,$city);
				$cst->insertDb();
			}
			echo 1;
			
		}
		catch(Exception $e){
			echo 0;
		
		}
		
}



if(@$_GET["q"]=="login"){
	
	$eml=$_POST['email'];
	$pss=$_POST['pwd'];
	
	
	
	$u=User::findUser($eml,$pss);
	if ($u==null)
	{
		echo 0;
		
	}
	else{
		$_SESSION["uid"]=$u->id;
		echo 1;
	
	}
	
}




if(@$_GET["q"]=="logina"){
	
	$eml=$_POST['email'];
	$pss=$_POST['pwd'];
	
	
	
	$u=User::findAdmin($eml,$pss);
	if ($u==null)
	{
		echo 0;
		
	}
	else{
		$_SESSION["aid"]=$u->id;
		echo 1;
	
	}
	
}





if(@$_GET["q"]=="getuser"){
	$u=User::findUserById($_SESSION['uid']);
	echo json_encode($u);
	
	
}

if(@$_GET["q"]=="users"){
	echo User::getAll();
	
	
}


if(@$_GET["q"]=="upd1"){
	
		$eml=$_POST['email'];
		$pss=$_POST['pwd'];
		$fn=$_POST['fn'];
		$u=User::findUserById($_SESSION['uid']);
		try{
			$u->updateDb($eml,$pss,$fn,$u->type);
			echo 1;
			
		}
		catch(Exception $e){
			echo 0;
		
		}
		
}



if(@$_GET["q"]=="upd2"){
	
		$eml=$_POST['email'];
		$pss=$_POST['pwd'];
		$fn=$_POST['fn'];
		$u=User::findUserById($_SESSION['aid']);
		try{
			$u->updateDb($eml,$pss,$fn, $u->type);
			echo 1;
			
		}
		catch(Exception $e){
			echo 0;
		
		}
		
}








if(@$_GET["q"]=="userdata"){
	$menu="menuadmin.php";
	$u=User::findUserById($_GET['id']);
	$page="userdata.php";
	include "view/main.php";
}



if(@$_GET["q"]=="newmsg"){
	$msg=$_POST['msg'];
		$m=new Message();
		$m->setMinima(NULL,NULL,$_SESSION['uid'],$msg,date('Y-m-d h:i:s'));
		try{
			$m->insertDb();
			echo 1;
			
		}
		catch(Exception $e){
			echo 0;
		
		}
}







?>