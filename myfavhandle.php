<?php
	session_start();
	if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['type'])){
		exit('illeagle access!');
	}else{
		$userid=$_SESSION['id'];
		$username=$_SESSION['name'];
	}
?>
<?php
	include("connect.php");
	$myfavid=$_POST['myfavid'];
	$state=$_POST['state'];
	if($state==0){//取消点赞
		try{
			$cancelfavquery=$DBH->prepare("delete from answerlist_fav where user = ? and answergroupid = ?");
			$cancelfavquery->bindParam(1,$userid);
			$cancelfavquery->bindParam(2,$myfavid);
			$cancelfavquery->execute();
		//				print_r($cancelfavquery->errorInfo());

		}catch(PDOException $e){
 		   die($e->getMessage());
 		}
	}else if($state==1){//点赞
		try{
			$favquery=$DBH->prepare("insert into answerlist_fav (user,time,answergroupid) values (?,now(),?)");
			$favquery->bindParam(1,$userid);
			$favquery->bindParam(2,$myfavid);
			$favquery->execute();
		//	print_r($favquery->errorInfo());
		}catch(PDOException $e){
 		   die($e->getMessage());
 		}
	}
?>