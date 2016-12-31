<?php
  session_start();
  if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['type'])){
    exit('illeagle access!');
  }else{
    $userid=$_SESSION['id'];
    $username=$_SESSION['name'];
  }
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
      <div class="card-panel blue-grey darken-1 z-depth-5">
         <div class="card-content white-text">
           <h5>出题须知</h5>
             <p>你可以选择上传不超过四张图片或上传一个视频或上传一个音频。如果不需要上传文件直接跳过
			 即可。另外，如果你希望给这道题作出一些提示也可以写在hints里，同样，如果不需要提示跳过即可。<br><br>注：
			 hints是伴随题目一起展示给用户的。每张图片大小不超过 KB。</p>
         </div>
       </div>
		 
		 
		    <div class="card-panel z-depth-5">
    <div class="row">
	
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <textarea id="textareabody" class="materialize-textarea" length="250"></textarea>
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
	不需要上传可以跳过这一步
	</blockquote>
	<form action="#" id="files">
		<div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input type="file" multiple id="inputfile">
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="选择一个或更多文件">
      </div>
    </div>
  </form>
  <!--图片预览-->
  <span class="loading"></span>
  <div id="feedback" class="row">
	
	</div>
  <!--end-->
  <br><br>
  <div class="row">
<div class="input-field col l3 s6">
    <select id="correct">
      <option value="1" selected>A</option>
      <option value="2">B</option>
      <option value="3">C</option>
      <option value="4">D</option>
    </select>
    <label>选出你想要设置的正确选项</label>
  </div>
  <div class="input-field col l9 s6">
          <input placeholder="是否想对这道题作出一些提示......" id="hints" type="text" class="validate" length="20">
          <label for="hints">Hints:</label>
        </div>
  
  </div>
  </div>
       </div>
     </div>
<br>
    <button class="btn waves-effect waves-light right" type="submit" name="action" id="submit">提交
    <i class="material-icons right">send</i>
	</button>

  </div>
  <br><br><br>
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
  <script src="js/commit.js"></script>
  <script src="js/uploadfiles.js"></script>

</body>


<?php
?>