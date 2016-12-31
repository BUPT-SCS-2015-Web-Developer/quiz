<?php
/*验证是否是管理员，否则exit*/
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
	include('connect.php');
	$groups=array();
	try{
		//未发布的
		$personalqry=$DBH->prepare("SELECT * FROM listname WHERE ifpublic='0'");
		$personalqry->execute();
		$personals=$personalqry->fetchAll(PDO::FETCH_ASSOC);
		//已经发布的
		$publicqry=$DBH->prepare("SELECT * FROM listname WHERE ifpublic='1'");
		$publicqry->execute();
		$publics=$publicqry->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	$groups['personal']=$personals;
	$groups['public']=$publics;
	echo json_encode($groups);
?>