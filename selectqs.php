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
  <title>生成套题</title>

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
         <span class="white-text center">管理员你好！你可以自己出题，也可以从同学们贡献的题目中选取合适的题目。<br>
		 点击提交后并不会发布这套题，你可以在“管理中心”预览这套题并设置是否发布。
		 另外在生成一套题前需要给它起一个合适的名字并配上一张好看的封面图哦。<br><br>
		 Notice: 填空题的挖空处请用<*>...<*>表示<br>
		 eg:中国的四大名著是：红楼梦、三国演义、水浒传和<*>西游记<*>

		 </div>
	<div class="questions">	 
	<div class="card-panel z-depth-5 question choice" id="question-1">
    
	<a class="btn-floating btn-small waves-effect waves-light teal right"><i class="material-icons right">clear</i></a>
	<div style=" width:50px; height:50px; background-color:C6C3C2; border-radius:25px;">
         <span style="height:50px; line-height:50px; display:block; color:#FFF; text-align:center">
		 <h3 class="header">1</h3>
		 </span>
    </div>
	<div class="row">
	
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textareabody" class="materialize-textarea" length="120"></textarea>
          <label for="textareabody">题干</label>
        </div>
      </div>
	  <div class="row">
	  <div class="input-field col m6 s12">
          <textarea id="textareaA" class="materialize-textarea" length="120"></textarea>
          <label for="textareaA">选项A</label>
        </div>
	  <div class="input-field col m6 s12">
          <textarea id="textareaB" class="materialize-textarea" length="120"></textarea>
          <label for="textareaB">选项B</label>
        </div>
	  <div class="input-field col m6 s12">
          <textarea id="textareaC" class="materialize-textarea" length="120"></textarea>
          <label for="textareaC">选项C</label>
        </div>
	  <div class="input-field col m6 s12">
          <textarea id="textareaD" class="materialize-textarea" length="120"></textarea>
          <label for="textareaD">选项D</label>
        </div>
      </div>
    </form>
	</div>
    <blockquote>
	来吧，上传你喜欢的图片/视频/音频吧
	<br>
	别忘了，上传图片和上传视频和上传音频之间是或的关系哟
	<br>
	不需要上传可以跳过
	</blockquote>
	<form action="#">
		<div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input id="inputfile-1" type="file" multiple>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="选择一个或更多文件">
      </div>
    </div>
  </form>
  <!--图片预览-->
  <div id="feedback-1" class="row">
	</div>
  <!--end-->
    <blockquote>
	设置正确的选项：
	</blockquote>
  <div class="row">
  <form id="correct-1" action="#">
      <input class="with-gap col l3 s3" value="1" name="group1" type="radio" id="1-1" />
      <label for="1-1">A</label>
      <input class="with-gap col l3 s3" value="2" name="group1" type="radio" id="1-2" />
      <label for="1-2">B</label>
      <input class="with-gap col l3 s3" value="3" name="group1" type="radio" id="1-3"  />
      <label for="1-3">C</label>
      <input class="with-gap col l3 s3" value="4" name="group1" type="radio" id="1-4"  />
      <label for="1-4">D</label>
    </p>
  </form>
  <div class="input-field col l9 s6">
          <input placeholder="是否想对这道题作出一些提示......" id="hints" type="text" class="validate" length="20">
          <label for="hints">Hints:</label>
        </div>
  
  </div>
  </div>
  
  	<div class="card-panel z-depth-5 question text hide" id="text-model">
	<a class="btn-floating btn-small waves-effect waves-light teal right"><i class="material-icons right">clear</i></a>
	<div style=" width:50px; height:50px; background-color:C6C3C2; border-radius:25px;">
         <span style="height:50px; line-height:50px; display:block; color:#FFF; text-align:center">
		 <h3 class="header">1</h3>
		 </span>
    </div>
	<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textareabody" class="materialize-textarea" length="120"></textarea>
          <label for="textareabody">题干</label>
        </div>
      </div>
    </form>
	</div>
  <br><br>
  <div class="row">
  <div class="input-field col l12 s12">
          <input placeholder="是否想对这道题作出一些提示......" id="hints" type="text" class="validate" length="20">
          <label for="hints">Hints:</label>
        </div>
  </div>
  </div>
  </div>


        
	
	  <a class='dropdown-button btn right' href='#' data-activates='dropdown1'>继续出题<i class="material-icons right">add</i></a>
  <!-- Dropdown Structure -->
  <ul id='dropdown1' class='dropdown-content'>
    <li><a href="#!" class="continue-choice">选择题</a></li>
    <li><a href="#!" class="continue-text">填空题</a></li>
  </ul>
	
	
	<button class="btn waves-effect waves-light left select" type="submit" name="select">从库中选
    <i class="material-icons right">add</i>
	</button>
	<br>
	<br>
	<button class="btn waves-effect waves-light left next" type="submit" id="next" name="action">下一步骤
    <i class="material-icons right">check</i>
  </button>
  
  <div class="addition hide">
       <br><br>	   
       <div class="card-panel z-depth-5">  
  <div class="row">
  <form action="#" class="col l4 s12">
		<div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" >
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="选择一张封面图">
      </div>
    </div>
  </form>
  <div class="col l8 s8"></div>
  <br>
<br>
  <div class="col s12">
  <blockquote>
  请设置答题时间(单位“分钟”）:
  </blockquote>
  
	  <form action="#" >
    <p class="range-field ">
      <input type="range" id="limittime" min="0" max="120" />
    </p>
  </form>
 </div>
  <br>
  <div class="input-field col l12 s12">
          <input placeholder="为这套题起一个合适的名字吧......" id="name" type="text" class="validate" length="10">
          <label for="name">名字:</label>
        </div>
    
        <div class="input-field col s12">
          <textarea id="summary" class="materialize-textarea" length="120"></textarea>
          <label for="summary">简介</label>
        </div>
  </div>
  </div>   
  </div>
  <button class="btn waves-effect waves-light right confirm hide" id="confirm" type="submit" name="action">确认提交
    <i class="material-icons right">send</i>
  </button>
		
       </div>
     </div>
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
</footer>

  <!--  Scripts-->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/do.js"></script>
  <script src="js/uploadfiles.js"></script>

</body>
<?php
?>