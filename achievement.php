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
//成就设置：自己的战绩&rank，综合榜前10战绩，特殊成就：连续三次正确率85%以上（获得此成就的勇士有）
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>出题</title>

  <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<header>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo" style="font-family:微软雅黑">我爱学习</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="commit.php">出题</a></li>
        <li><a href="answerlist.php">答题</a></li>
		<li><a href="achievement.php">成就</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="commit.php">出题</a></li>
        <li><a href="answerlist.php">答题</a></li>
        <li><a href="achievement.php">成就</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
</header>
<div class="container">
	 <div class="row">
        <div class="col s12 m6">
          <div class="card brown darken-1">
            <div class="card-content white-text">
              <span class="card-title">想知道这里都有什么吗？</span>
              <p>
              嘿嘿~
              <br>★首先肯定少不了你自己的成绩和rank了
              <br>★其次每套题都有一份自己的前十名光荣榜
              <br>★最后，还有一项特殊成就，那就是：连续三次正确率85%以上！
              </p>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <!--part 1-->
         <div class="row">
      <?php
      //获取成绩和rank
      include("connect.php");
     try{
		//已经发布的
		$publicqry=$DBH->prepare("SELECT flag,name from  listname where ifpublic = '1' ");
		$publicqry->execute();
		$publics=$publicqry->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	foreach ($publics as $public_group) {
          		try{
					  $ifdone=$DBH->prepare("select score from userresult where name  ='$username' and groupid = ?");
  					  $ifdone->bindParam(1,$public_group['flag']);
					  $ifdone->execute();
				      $score=$ifdone->fetch(PDO::FETCH_ASSOC);
					  $score=$score['score'];
			
		
	
				}catch(PDOException $e){
					die($e->getMessage());
				//die("Database Error.Please contact supporter!");
				}
				if($score!=null){
					//查rank
					try{
						$rankq=$DBH->prepare("select name,id,avg(score) from userresult where groupid = ? group by id");
						$rankq->bindParam(1,$public_group['flag']);
						$rankq->execute();
						//print_r($rankq->errorInfo());

					}catch(PDOException $e){
						die($e->getMessage());
					//die("Database Error.Please contact supporter!");
					}
					$rankr=$rankq->fetchAll(PDO::FETCH_ASSOC);
					//计算rank
					$i=0;
					$rank=1;
					foreach ($rankr as $item) {
						if($score<$rankr[$i++]['avg(score)']){
							$rank++;
						}
					}
				}else{
					continue;
				}
          	
		?>

      <div class="col s6 m4">
        <div class="card-panel blue-grey darken-3">
          <span class="white-text">套题名称：<?=$public_group['name']?>
          </span><br>
          <span class="white-text">
          	你的成绩：<?=$score?>
          </span><br>
          <h5 class="white-text">
          	RANK：<?=$rank?>/<?=count($rankr)?>
          </h5>
        </div>
      </div>
   
		<?php
	}
      ?>
        </div>
      <hr>
      <!--part 2-->
        <div class="row">
      <?php
    try{
		//已经发布的
		$publicqry=$DBH->prepare("SELECT flag,name from  listname where ifpublic = '1' ");
		$publicqry->execute();
		$publics=$publicqry->fetchAll(PDO::FETCH_ASSOC);
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	foreach ($publics as $public_group) {
		//获取这套题的前十名的名字
		$highscoresq=$DBH->prepare("SELECT name,avg(score) from userresult where groupid = ? group by id order by avg(score) desc");
		$highscoresq->bindParam(1,$public_group['flag']);
		$highscoresq->execute();
		$highscores=$highscoresq->fetchAll(PDO::FETCH_ASSOC);

		if(count($highscores)>0){
		?>
  <div class="col s6 m4">
        <div class="card-panel blue-grey darken-3">
          <span class="white-text">套题名称：<?=$public_group['name']?>
          </span><br>
          <span class="white-text">
          <?php
          $j=1;
          		foreach ($highscores as $highscore) {
          			if($j==10){
          				break;
          			}
          			echo "NO.".$j."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$highscore['name'].":".round($highscore['avg(score)'])."<br>";
          			$j++;
          			
          		}
          ?>
          </span>
        </div>
      </div>
		<?php
	}
	}
      ?>
</div>
      <hr>
      <!--part 3-->
        <ul class="collection with-header">
        <li class="collection-header blue-grey darken-3"><h5 class="white-text">达成特殊成就的勇士有：</h5></li>
      <?php
      $string="";
      $selectedstu=array();
      $constantcorrectq=$DBH->prepare("select name,id from userresult group by id");
      $constantcorrectq->execute();
      $constantcorrect=$constantcorrectq->fetchAll(PDO::FETCH_ASSOC);
      foreach ($constantcorrect as $username) {
      	$query=$DBH->prepare("select name,score from userresult where id = ? group by groupid order by submittime");
      	$query->bindParam(1,$username['id']);
      	$query->execute();
      	$queryresult=$query->fetchAll(PDO::FETCH_ASSOC);
      	foreach ($queryresult as $ascore) {
      		if($ascore['score']>=85){
      			$string=$string.'1';
      		}else{
      			$string=$string.'0';
      		}
      	}
      //	echo '<br>';
      //	echo $string;
      	if(strpos($string,"111")){
      		$selectedstu[]=$username['name'];
      	}
      	$string='';
      }

     // print_r($selectedstu);
      if($selectedstu){
      	foreach ($selectedstu as $student) {
      		?>
      		<li class="collection-item blue-grey lighten-4"><div class="text"><?=$student?></div></li>
      		<?php
      	}
      }else{
      	      ?>
<div class="row">
      <div class="col s12 m12">
        <div class="card-panel blue-grey darken-3">
          <span class="white-text"><?php echo "暂时还没有一位勇士达成此成就，快去挑战吧，相信下一个就是你";?>
          </span>
        </div>
      </div>
    </div>
      <?php
      	
      }
      
 ?>

      
      </ul>    

</div>


 <footer class="page-footer orange">
    <div class="container">
	 <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Team</h5>
          <p class="grey-text text-lighten-4">我们是一群喜欢技术的小伙伴们聚在一起组成的一个团队。如果你在使用这个出题答题系统时有任何问题请联系我们，我们感谢你提出的任何意见。</p>
		   </div>
		<div class="col l2 s12">
        </div>
		<div class="col l4 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
		  <p class="grey-text text-lighten-4">
            邮箱：atlasquan98@gmail.com
			</p>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="#">Team Eggplant</a>
      </div>
    </div>
	</div>
</footer>

  <!--  Scripts-->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>