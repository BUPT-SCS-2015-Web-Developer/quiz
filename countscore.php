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
	$answer=$_POST['answer'];
	$groupid=$_POST['groupid'];
	include("connect.php");
	/*获取这套题的所有questionid*/
	try{
		$getids=$DBH->prepare("select questionid from questiongroup where groupid = ? order by numorder ASC");
		$getids->bindParam(1,$groupid);
		$getids->execute();
	//	print_r($getids->errorInfo());
		$qids=$getids->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
	}
	/*获取所有答案*/
	try{
		$getqs=$DBH->prepare("select type,correctanswer from questionsbyall where flag=?");
		$getqs->bindParam(1,$questionid);
		foreach($qids as $qid){
			$questionid=$qid['questionid'];
			$getqs->execute();
			//print_r($getqs->errorInfo());
			$answers[]=$getqs->fetch(PDO::FETCH_ASSOC);
		}
	}catch(PDOException $e){
		die($e->getMessage());
	}
	/*判断正误并回复给前端*/
	$j=0;
	$right=0;
	$reply=array();
	//var_dump($answers);
	foreach($answers as $thisanswer){
		if($thisanswer['type']=="choice"){//选择题
			if($answer[$j]==$thisanswer['correctanswer']){
				$reply[$j]='o';//正确
				$right++;
			}else{
			if($thisanswer['correctanswer']=='1')
				$reply[$j]='A';
			if($thisanswer['correctanswer']=='2')
				$reply[$j]='B';
			if($thisanswer['correctanswer']=='3')
				$reply[$j]='C';
			if($thisanswer['correctanswer']=='4')
				$reply[$j]='D';
			}
		}else if($thisanswer['type']=="text"){//判断题
			
		}
		
		$j++;
	}
	$score=round(100*($right/$j));
	$reply[]=$score;
	//echo $score;
	echo json_encode($reply);
	
	/*存入数据库*/
	try{
		$insertqry=$DBH->prepare("insert into userresult (name,id,groupid,numorder,answer,submittime,score) values ('$username','$userid','$groupid',?,?,now(),'$score') ");
		$insertqry->bindParam(1,$index);
		$insertqry->bindParam(2,$realanswer);
		for($index=1;$index<=$j;$index++){
			$realanswer=$answer[$index-1];
			$insertqry->execute();
		}
	}catch(PDOException $e){
		die($e->getMessage());
	}
	
	
?>