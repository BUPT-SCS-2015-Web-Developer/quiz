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
  
  
  <div class="container">
  
  <div class="row">
     <div class="col s12 m12">
       <div class="card-panel teal">
         <h5 class="white-text center">题目名称：天地无用</h5>
		 <h5 class="white-text center">限时：05:00</h5>
       </div>
     </div>
   </div>
   <table class="bordered striped ">
      <thead>
        <tr>
          <th data-field="name">姓名</th>
          <th data-field="id">学号</th>
          <th data-field="scores">成绩</th>
          <th data-field="time">用时</th>
          <th data-field="submittime">提交时间</th>
          <th data-field="examine"></th>
          <th data-field="remove"></th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Alvin</td>
          <td>123</td>
          <td>87</td>
          <td>23</td>
          <td>2016-12-02 22：12</td>
          <td><a href="">详情</a></td>
          <td><a href="">删除</a></td>
        </tr>
        <tr>
          <td>Alvin</td>
          <td>123</td>
          <td>87</td>
          <td>23</td>
          <td><a href="">详情</a></td>
          <td><a href="">删除</a></td>
        </tr>
        <tr>
          <td>Alvin</td>
          <td>123</td>
          <td>87</td>
          <td>23</td>
          <td><a href="">详情</a></td>
          <td><a href="">删除</a></td>
        </tr>
      </tbody>
    </table>
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

</body>
<?php
?>