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
	/*接收并检验数据合法性*/
	$questions=$_POST['questions'];
	//检验合法性...（待补充）
	$i=1;
	$questionbodys=array();
	$hintss=array();
	foreach($questions as $question){
		if(isset($question['hints'])&&!empty($question['hints'])||$question['hints']=='0')
		{
			if(mb_strlen($question['hints'],"utf8")<=20)//校验hints长度
			{	
				$hintss[$i]=$question['hints'];
			}else{
				echo "error_hints".$i;
				exit();
			}	
		}else{
			$hintss[$i]='';//hints作为可选项可能为空(这里要区别空和0的区别)
		}
		if((isset($question['questionbody'])&&!empty($question['questionbody']))
		&&(mb_strlen($question['questionbody'],"utf8")<=250))//校验题干长度(用mb_strlen()函数保证一个中文字符作为长度1计算)
		{
			$questionbodys[$i]=$question['questionbody'];
		
		}else{
			echo "error_questionbody".$i;
			exit();
		}
		
		$i++;
	}

	
	/*先把题目存入装所有题目的表中*/
	include("connect.php");
	try{
		$pushqry=$DBH->prepare("insert into questionsbyall (name,id,time,type,ifused,questionbody,correctanswer,choice1,choice2,choice3,choice4,pic1,pic2,pic3,pic4,audio,video,hints)		values (?,?,now(),?,'1',?,?,?,?,?,?,?,?,?,?,?,?,?)");
		$pushqry->bindParam(1,$username);
		$pushqry->bindParam(2,$userid);
		$pushqry->bindParam(3,$type);
		$pushqry->bindParam(4,$questionbody);
		$pushqry->bindParam(5,$correctanswer);
		$pushqry->bindParam(6,$choice1);
		$pushqry->bindParam(7,$choice2);
		$pushqry->bindParam(8,$choice3);
		$pushqry->bindParam(9,$choice4);
		$pushqry->bindParam(10,$pic1);
		$pushqry->bindParam(11,$pic2);
		$pushqry->bindParam(12,$pic3);
		$pushqry->bindParam(13,$pic4);
		$pushqry->bindParam(14,$audio);
		$pushqry->bindParam(15,$video);
		$pushqry->bindParam(16,$hints);
		$i=1;
		foreach($questions as $question){
			if($question['flag']=="choice"){
				$type="choice";
				$questionbody=$questionbodys[$i];
				$choice1=$question['textareaA'];
				$choice2=$question['textareaB'];
				$choice3=$question['textareaC'];
				$choice4=$question['textareaD'];
				$correctanswer=$question['correctanswer'];
				$hints=$hintss[$i];
				//关于文件上传的信息
				$pic1=$pic2=$pic3=$pic4=$audio=$video='';
				
			}else if($question['flag']=="text"){
				$type="text";
				$questionbody=$questionbodys[$i];
				$correctanswer=$questionbodys[$i];
				$hints=$hintss[$i];
				$choice1=$choice2=$choice3=$choice4=$pic1=$pic2=$pic3=$pic4=$audio=$video='';
			}
			$pushqry->execute();
			$idqry=$DBH->prepare('SELECT LAST_INSERT_ID()');
			$idqry->execute();
			$id=$idqry->fetch(PDO::FETCH_ASSOC);
			$questionids[]=$id['LAST_INSERT_ID()'];
			//print_r($pushqry->errorInfo());
			$i++;
		}
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	
	//var_dump($questionids);
	/*获取套题设置的相关信息并加入到套题列表中*/
	$info=$_POST['info'];
	$cover=$info['pic'];
	$name=$info['name'];
	$summary=$info['summary'];
	$lt=$info['limittime'];
	try{
		$listqry=$DBH->prepare("insert into listname (name,ifpublic,summary,pic,limittime) values (?,'0',?,?,?)");
		$listqry->bindParam(1,$name);
		$listqry->bindParam(2,$summary);
		$listqry->bindParam(3,$cover);
		$listqry->bindParam(4,$lt);
		$listqry->execute();
		//print_r($listqry->errorInfo());
		$groupidqry=$DBH->prepare('SELECT LAST_INSERT_ID()');
		$groupidqry->execute();
		$groupid=$groupidqry->fetch(PDO::FETCH_ASSOC);
		$groupid=$groupid['LAST_INSERT_ID()'];
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	
	/*将刚才的题和这套题链接起来*/
	try{
		$linkqry=$DBH->prepare("insert into questiongroup (groupid,numorder,questionid) values ('$groupid',?,?)");
		$linkqry->bindParam(1,$order);
		$linkqry->bindParam(2,$questionid);
		$j=1;
		foreach($questionids as $questionid){
			$order=(string)$j;
			$j++;
			$linkqry->execute();
			//print_r($linkqry->errorInfo());
		}
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	
	
	echo "success";
?>