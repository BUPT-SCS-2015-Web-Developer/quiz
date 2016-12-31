<?php
/*先做用户认证*/
?>
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
	include('connect.php');
	$groups=array();
	try{
		//已经发布的
		$publicqry=$DBH->prepare("SELECT * from (SELECT count(answergroupid) as favnums,pic,name,summary,flag,limittime,ifpublic FROM listname left join answerlist_fav on answerlist_fav.answergroupid=listname.flag group by flag) as temp WHERE temp.ifpublic = '1'");
		$publicqry->execute();
		$publics=$publicqry->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	$list['public']=$publics;
	echo json_encode($list);
	/*select * from (
select count(answergroupid),pic,name,summary,flag,limittime,ifpublic from listname right join answerlist_fav on answerlist_fav.answergroupid=listname.flag group by answergroupid ) as temp where temp.ifpublic = '1'*/
?>

