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
     <div class="row list">
     <div class=" col s12 m3 hide" id="quiz">
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
             <a href="javascript:void(0) " class="favorite hide">
              <i class="material-icons fav-pre">favorite_border</i>
              点赞 &nbsp; <span id="num"><?='11'?></span> </a>
              <a href="javascript:void(0) " class="favorite-after hide">
              <i class="material-icons fav-aft">favorite</i>
              已点赞 &nbsp; <span id="num"><?='11'?></span> </a>

           <a href="javascript:void(0)" class="right" id="gointo"> <i class="material-icons gointo">create</i>进入答题</a>
         </div>
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
	</div>
</footer>

  <!--  Scripts-->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
  <script src="js/alinit.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    //初始化所有的点赞
    $(".favorite-after").hide();
    $.ajax({
      url:"initfav.php",
      type:"POST",
      datatype:'json',
      success:function(data){
        var msg = $.parseJSON(data);
        $.each(msg,function(i,item){
          var favedid=item.answergroupid;
          $("#quiz"+favedid).find(".favorite").hide();
          $("#quiz"+favedid).find(".favorite-after").show();
        })
      }
    })
   // $(".favorite").hide();
   // $(".favorite-after").show();
    $(".favorite-after").removeClass("hide");
    $(".favorite").removeClass("hide");
  })
    $(".favorite").click(function(){
      $(this).hide();
      $(this).siblings(".favorite-after").show();
      var myfavid=$(this).parent().parent().parent().attr("id").slice(4);
      console.log(myfavid);
      var favnum=$(this).find("#num").html();
      favnum=Number(favnum)+1;
      $(this).find("#num").html(favnum);
      $(this).siblings(".favorite-after").find("#num").html(favnum);
      $.ajax({
        url:"myfavhandle.php",
        data:{myfavid:myfavid,
              state:1},
        type:"POST",
        success:function(data){
//有一个模态框
        },
      })
    })
    $(".favorite-after").click(function(){
      $(this).siblings(".favorite").show();
      $(this).hide();
      var myfavid=$(this).parent().parent().parent().attr("id").slice(4);
      var favnum=$(this).find("#num").html();
      favnum=Number(favnum)-1;
      $(this).find("#num").html(favnum);
      $(this).siblings(".favorite").find("#num").html(favnum);
      $.ajax({
        url:"myfavhandle.php",
        data:{myfavid:myfavid,
              state:0},
        type:"POST",
        success:function(data){

        },
      })
    })
</script>
</body>
<?php
?>