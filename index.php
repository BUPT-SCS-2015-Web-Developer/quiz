<?php
	session_start();
  /*测试时使用*/
  $_SESSION['id']='789';
  $_SESSION['name']='AB';
  $_SESSION['type']='student';
  /**/
	if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['type'])){
		exit('illeagle access!');
	}else{
		$userid=$_SESSION['id'];
		$username=$_SESSION['name'];
	}
	

/*
$_SESSION['id']记录用户id
$_SESSION['name']记录用户姓名
$_SESSION['type']记录用户是辅导员还是学生
*/
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

<main>
	<div class="section no-pad-bot" id="index-banner">
	<div class="container">
	 <br><br>
	<h1 class="header center orange-text">欢迎来到答题系统</h1>
	  <div class="row center">
        <h5 class="header col s12 light">在这里你可以自己出题，也可以去答题，还有更多有趣的功能等你发现，快去体验吧</h5>
      </div>
	  </div>
	</div>
	  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block commit">
            <h2 class="center light-blue-text"><i class="material-icons">add</i></h2>
            <h5 class="center">出题</h5>

            <p class="light">少年，是否觉得题目都太无聊？是否亟不可待想把自己的好题分享给大家？
			  那就来吧！题目形式仅限于单选，但是题目涉及的知识领域不限（你懂的），而且支持图片哦！</p>
          </div>
		  <div class="center">
		  <a href="commit.php" class="btn waves-effect waves-light orange">立刻出题</a>
		  </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block answer">
            <h2 class="center light-blue-text"><i class="material-icons">edit</i></h2>
            <h5 class="center">做题</h5>

            <p class="light" >哟嚯，少年，看你骨骼清奇，不如<s>干了这套离散/信基/数逻/**题，来世还做北邮人</s>
			点开看看里面有什么宝贝，说不定就看到好东西了对吧。</p>
          </div>
		  <div class="center">
		  <a href="answerlist.php" class="btn waves-effect waves-light orange">我要答题</a>
		  </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block achievement"  height="500px">
            <h2 class="center light-blue-text"><i class="material-icons">equalizer</i></h2>
            <h5 class="center">成就</h5>

            <p class="light" >在这里你可以看到自己取得的所有成就，也可以看到别人的成就。</p>
          </div>
		  <div class="center">
		  <a href="achievement.php" class="btn waves-effect waves-light orange">查看成绩</a>
		  </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>
</main>

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
</footer>

  
  
  <!--  Scripts-->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</body>


<?php
?>