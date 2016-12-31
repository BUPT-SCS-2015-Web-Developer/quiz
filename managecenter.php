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
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>管理中心</title>

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
  <div  class="container">
  
   <ul class="collapsible" data-collapsible="expandable">
     <li>
       <div class="collapsible-header"><i class="mdi-image-filter-drama"></i>已发布</div>
       <div class="collapsible-body">
	     <div class="public row">
       <div class=" col s12 m4 publicitem hide" id="afterquiz0">
       <div class="card">
         <div class="card-image">
           <img src="pics/1.jpg">
		   <span class="card-title">Card Title</span>
         </div>
         <div class="card-content">
           <p>I am a very simple card. I am good at containing small bits of information.
           I am convenient because I require little markup to use effectively.</p>
         </div>
         <div class="card-action">
           <a href="#" id="showquestions">查看</a>
           <a href="#" id="undo">撤销发布</a>
           <a href="#" class="right" id="showscores">查看成绩</a>
         </div>
       </div>
     </div>
	 </div>
	   </div>
     </li>
	 
	 
     <li>
       <div class="collapsible-header active"><i class="mdi-maps-place"></i>未发布</div>
       <div class="collapsible-body">
	     <div class="personal row">
       <div class=" col s12 m4 personalitem hide" id="prequiz0">
       <div class="card">
         <div class="card-image">
           <img src="pics/1.jpg">
		   <span class="card-title">Card Title</span>
         </div>
         <div class="card-content">
           <p>I am a very simple card. I am good at containing small bits of information.
           I am convenient because I require little markup to use effectively.</p>
         </div>
         <div class="card-action">
           <a href="#" id="showquestions">查看</a>
           <a href="#" id="editquestions">编辑</a>
           <a href="#" class="right" id="publicquestions">发布</a>
         </div>
       </div>
     </div>
	 </div>
	   
	   </div>
     </li>
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
  <script src="js/do.js"></script>
  <script src="js/mcinit.js"></script>

</body>
<?php
?>