<?php
	/*验证登陆状态*/
?>
<?php
/*验证用户登录状态*/
	session_start();
	if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['type'])){
		exit('illeagle access!');
	}else{
		$userid=$_SESSION['id'];
		$username=$_SESSION['name'];
	}

?>
<?php
	$groupid=$_POST['groupid'];
	include("connect.php");
	$questions=array();
	/*首先获取标题和限时*/
	try{
		$getlist=$DBH->prepare("select name,limittime from listname where flag=?");
		$getlist->bindParam(1,$groupid);
		$getlist->execute();
		$data=$getlist->fetch(PDO::FETCH_ASSOC);
		//print_r($getlist->errorInfo());
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	/*获取这套题所有的questionid*/
	try{
		$getids=$DBH->prepare("select questionid from questiongroup where groupid = ? order by numorder ASC");
		$getids->bindParam(1,$groupid);
		$getids->execute();
	//	print_r($getids->errorInfo());
		$qids=$getids->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
	}
	/*获取这些id的对应的题目*/
	try{
		$getqs=$DBH->prepare("select type,questionbody,choice1,choice2,choice3,choice4,pic1,pic2,pic3,pic4,audio,video,hints from questionsbyall where flag=?");
		$getqs->bindParam(1,$questionid);
		foreach($qids as $qid){
			$questionid=$qid['questionid'];
			$getqs->execute();
			//print_r($getqs->errorInfo());
			$questions[]=$getqs->fetch(PDO::FETCH_ASSOC);
		}
	}catch(PDOException $e){
		die($e->getMessage());
	}
	//echo var_dump($questions);
	$results['questions']=$questions;
	$results['data']=$data;
	echo json_encode($results);
?>