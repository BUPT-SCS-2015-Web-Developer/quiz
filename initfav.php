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
	try{
		$allfavq=$DBH->prepare("select answergroupid from answerlist_fav where user = ?");
		$allfavq->bindParam(1,$userid);
		$allfavq->execute();
		$allfav=$allfavq->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
  	    die($e->getMessage());
    }
    echo json_encode($allfav);
?>