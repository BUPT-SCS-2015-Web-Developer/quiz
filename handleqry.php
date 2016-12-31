<?php
/*先做管理员认证*/
?>
<?php
  session_start();
  if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['type'])){
    exit('illeagle access!');
  }else{
    $userid=$_SESSION['id'];
    $username=$_SESSION['name'];
  }
  /*验证type*/
?>
<?php
	include("connect.php");
	$action=$_POST['action'];
	if($action=="publicquestions"){
		$groupid=$_POST['groupid'];
		try{
			$topublic=$DBH->prepare("update listname set ifpublic='1' where flag=?");
			$topublic->bindParam(1,$groupid);
			$topublic->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	echo "success";
	}
	else if($action=="undo"){
		$groupid=$_POST['groupid'];
		try{
			$topublic=$DBH->prepare("update listname set ifpublic='0' where flag=?");
			$topublic->bindParam(1,$groupid);
			$topublic->execute();
		}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	echo "success";
	}
?>