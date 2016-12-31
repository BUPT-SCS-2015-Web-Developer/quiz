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
/*接受并校验数据合法性*/
	if((isset($_POST['body'])&&!empty($_POST['body']))
		&&(mb_strlen($_POST['body'],"utf8")<=250))//校验题干长度(用mb_strlen()函数保证一个中文字符作为长度1计算)
	{
			$questionbody=$_POST['body'];
		
	}else{
		echo "error_questionbody";
		exit();
	}
	
	if((isset($_POST['choice1'])&&!empty($_POST['choice1']))
		&&(mb_strlen($_POST['choice1'],"utf8")<=120))//校验选项1长度
	{	     
		$choice1=$_POST['choice1'];
	}else{
		echo "error_choice1";
		exit();
	}
	
	if((isset($_POST['choice2'])&&!empty($_POST['choice2']))
		&&(mb_strlen($_POST['choice2'],"utf8")<120))//校验选项2长度
	{	
		$choice2=$_POST['choice2'];
		
	}else{
		echo "error_choice2";
		exit();
	}
	
	if((isset($_POST['choice3'])&&!empty($_POST['choice3']))
		&&(mb_strlen($_POST['choice3'],"utf8")<=120))//校验选项3长度
	{	
		$choice3=$_POST['choice3'];

	}else{
		echo "error_choice3";
		exit();
	}
	
	if((isset($_POST['choice4'])&&!empty($_POST['choice4']))
		&&(mb_strlen($_POST['choice4'],"utf8")<=120))//校验选项4长度
	{
			$choice4=$_POST['choice4'];

	}else{
		echo "error_choice4";
		exit();
	}
	

	if((isset($_POST['correctanswer'])&&!empty($_POST['correctanswer']))
		&&(in_array($_POST['correctanswer'],array("1","2","3","4"))))//校验设置的正确选项是否合法
	{
		$correctanswer=$_POST['correctanswer'];
	}else{
		echo "error_correctanswer";
		exit();
	}

	if(isset($_POST['hints'])&&!empty($_POST['hints'])||$_POST['hints']=='0')
	{
		if(mb_strlen($_POST['hints'],"utf8")<=20)//校验hints长度
		{	
			$hints=$_POST['hints'];
		}else{
			echo "error_hints";
			exit();
		}	
	}else{
		$hints='';//hints作为可选项可能为空(这里要区别空和0的区别)
	}
		
	
	if(isset($_POST['file'])&&!empty($_POST['file'])){
		//if()  校验上传文件是否存在于服务器以及名称是否合法
		$files=$_POST['file'];
	}else{
		$files='';//files作为可选项可能为空
	}
	
	//上传的文件对应存入变量
	if(isset($files['img1'])&&!empty($files['img1'])) 
		$pic1=$files['img1'];
	else
		$pic1='';
	
	if(isset($files['img2'])&&!empty($files['img2'])) 
		$pic2=$files['img2'];
	else
		$pic2='';
	
	if(isset($files['img3'])&&!empty($files['img3'])) 
		$pic3=$files['img3'];
	else
		$pic3='';
	
	if(isset($files['img4'])&&!empty($files['img4'])) 
		$pic4=$files['img4'];
	else
		$pic4='';
	
	if(isset($files['audio'])&&!empty($files['audio'])) 
		$audio=$files['audio'];
	else
		$audio='';
	
	if(isset($files['video'])&&!empty($files['video'])) 
		$video=$files['video'];
	else
		$video='';
	
	 
/*存入数据库*/
	
	include("connect.php");
	try{
		$qry="insert into questionsbyall (name,id,time,type,questionbody,correctanswer,choice1,choice2,choice3,choice4,pic1,pic2,pic3,pic4,audio,video,hints) values (?,?,now(),'choice',?,?,?,?,?,?,?,?,?,?,?,?,?)";
		$query=$DBH->prepare($qry);
		$query->bindParam(1,$userid);
		$query->bindParam(2,$username);
		$query->bindParam(3,$questionbody);
		$query->bindParam(4,$correctanswer);
		$query->bindParam(5,$choice1);
		$query->bindParam(6,$choice2);
		$query->bindParam(7,$choice3);
		$query->bindParam(8,$choice4);
		$query->bindParam(9,$pic1);
		$query->bindParam(10,$pic2);
		$query->bindParam(11,$pic3);
		$query->bindParam(12,$pic4);
		$query->bindParam(13,$audio);
		$query->bindParam(14,$video);
		$query->bindParam(15,$hints);
		$query->execute();
		//print_r($query->errorInfo());
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	echo "success";
	
	

?>