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
	$groupid=$_GET['id'];
?>
<?php
include("connect.php");
	/*判断是否做过这套题*/
	try{
		$ifdone=$DBH->prepare("select score from userresult where name  ='$username' and groupid = ?");
    $ifdone->bindParam(1,$groupid);
		$ifdone->execute();
		$score=$ifdone->fetch(PDO::FETCH_ASSOC);
		$score=$score['score'];
		if($score!=null){
				exit("你已经做过这套题了，得分是".$score."分");
		}
		
	
	}catch(PDOException $e){
		die($e->getMessage());
		//die("Database Error.Please contact supporter!");
	}
	
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>出题</title>

  <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
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
  <div class="container">

  
    <div class="row">
     <div class="col s12 m12">
       <div class="card-panel teal">
         <h5 class="white-text center title" id="<?=$groupid?>"></h5>
		 <h5 class="white-text center" ><div id="timecount"></div></h5>
       </div>
     </div>
   </div>
   <div class="quizs">
   <!--moudle-->
  <div class="hide quiz card-panel z-depth-3" id="quiz">
	<p class="quiz-body"><span>1.</span>若如淫雨霏霏</p>
	<div class="pics row hide">
		<div id="pic1">
			<img class="materialboxed col s6 m3" src="pics/2.jpg"></img>
		</div>
		<div id="pic2">
			<img class="materialboxed col s6 m3" src="pics/3.png"></img>
		</div>
		<div id="pic3">
			<img class="materialboxed col s6 m3" src="pics/1.jpg"></img>
		</div>
		<div id="pic4">
			<img class="materialboxed col s6 m3" src="pics/2.jpg"></img>
		</div>
	
	</div>
	<div class="video hide">
		<video class="responsive-video" controls>
		<source src="videos/1.mp4" type="video/mp4">
		</video>
	</div>
	
	<div class="audio hide">
		<audio class="responsive-audio" controls>
		<source src="audios/1.mp3" type="audio/mp3">
		</audio>
	</div>
	
	  <form id="choicegroup" action="#">
    <p>
      <input name="group1" type="radio" value='1' id="choice1" />
      <label for="choice1-1">Red</label>
    </p>
    <p>
      <input name="group1" type="radio" value='2' id="choice2" />
      <label for="choice1-2">Yellow</label>
    </p>
    <p>
      <input  name="group1" type="radio" value='3' id="choice3"  />
      <label for="choice1-3">Green</label>
    </p>
    <p>
      <input name="group1" type="radio"  value='4' id="choice4"  />
      <label for="choice1-4">Brown</label>
    </p>
  </form>
  <br>
  <p class="hints">hints:</p>
  </div>
  <!--moudle end-->
  </div>

 
  <br>
   <button class="btn waves-effect waves-light right" type="submit" name="action" id="submit">提交
    <i class="material-icons right">send</i>
  </button>
  </div>
 <br>
<br> 
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
  <script src="js/answer.js"></script>
<script>

</script>
</body>
<?php

?>