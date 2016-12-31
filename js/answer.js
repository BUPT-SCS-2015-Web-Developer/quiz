var lt;
var groupid;

var hour
var minute
var second

var t

var flag=1
function getmod(a,b){//return a%b
	/*不知道为什么 % 一直不能正常运行，所以自己封装一个*/
	while(a>=b){
		a=a-b;
	}
	return a;
}

function convert(){
	second = getmod(lt,60);
	minute = getmod(((lt-second)/60),60);
	hour = getmod((lt - 60*minute - second),60*60);
}
function appendtime(h,m,s){
	if(lt){
	$("#timecount").html(h+":"+m+":"+s);
}
}
function timeCount()
{
	if(flag==0)
		return;
	convert();
	//console.log(lt,hour,minute,second);
	appendtime(hour,minute,second);
	if(hour==minute&&minute==second&&second==0){
		
		$("#submit").click();

		return;
	}

//document.getElementById('timecount').value=c
lt=lt-1;

t=setTimeout("timeCount()",1000);

//console.log(t);
}
	 
(function($){
 $(function(){


	 groupid=$(".title").attr("id");
	 //获取这套题的有关信息
		$.ajax({
			url:"questioninit.php",
			method:"POST",
			data:{
				groupid:groupid,
			},
			datatype:"JSON",
			asyn:"false",
			success:function(msg){
				var results = $.parseJSON(msg);
				$(".title").html(results.data.name);
				lt=results.data.limittime*60;//seconds
				
				var qs=results.questions;
				console.log(qs);
				$.each(qs,function(i,oneq){
					var quiz=$("#quiz").clone(true);
					if(oneq.type=="choice"){//单选题
						if(oneq.pic1){
							quiz.find("#pic1").find('img').attr("src",oneq.pic1);
							quiz.find("#pic2").find('img').attr("src",oneq.pic2);
							quiz.find("#pic3").find('img').attr("src",oneq.pic3);
							quiz.find("#pic4").find('img').attr("src",oneq.pic4);
							quiz.find(".pics").removeClass("hide");
						}
						/*else if(oneq.audio){
							
						}
						else if(oneq.video){
							
						}*/
						quiz.find(".quiz-body").html("<span>"+(i+1)+".</span>"+oneq.questionbody);
						quiz.find("#choicegroup").find('label').eq(0).html(oneq.choice1);
						quiz.find("#choicegroup").find('label').eq(1).html(oneq.choice2);
						quiz.find("#choicegroup").find('label').eq(2).html(oneq.choice3);
						quiz.find("#choicegroup").find('label').eq(3).html(oneq.choice4);
						quiz.find("#choicegroup").find('label').eq(0).attr("for","choice"+(i+1)+"-1");
						quiz.find("#choicegroup").find('label').eq(1).attr("for","choice"+(i+1)+"-2");
						quiz.find("#choicegroup").find('label').eq(2).attr("for","choice"+(i+1)+"-3");
						quiz.find("#choicegroup").find('label').eq(3).attr("for","choice"+(i+1)+"-4");
						quiz.find("input").attr("name","group"+(i+1));
						quiz.find("#choice1").attr("id","choice"+(i+1)+"-1");
						quiz.find("#choice2").attr("id","choice"+(i+1)+"-2");
						quiz.find("#choice3").attr("id","choice"+(i+1)+"-3");
						quiz.find("#choice4").attr("id","choice"+(i+1)+"-4");
						quiz.find("#choicegroup").attr("id","choicegroup"+(i+1));
						if(oneq.hints==''){
							quiz.find('.hints').hide();
						}else{
							quiz.find(".hints").html("hints:"+oneq.hints);
						}
						
						
						quiz.removeClass("hide");
						quiz.attr("id","quiz-"+(i+1));
						$(".quizs").append(quiz);
					}else if(oneq.type=="text"){//填空题

						quiz.attr("id","quiz-"+(i+1));
						$(".quizs").append(quiz);
					}
				})
       		  //  convert();
				//console.log(hour,minute,second);

			},
			error:function(data){
				
			},
		})
        /*初始化时间*/

        timeCount();

    }); // end of document ready
})(jQuery); // end of jQuery name space

var answer=new Array();
$("#submit").click(function(){
	flag=0;
	var total = $(".quiz").length - 1;//减掉模板，一共total道题（不包含text类型的题，text类型也占用一个.quiz,题的quiz-%是递增的）
	console.log(total);
	for(var i = 0;i < total;i++){
		if($("#quiz-"+(i+1)).find("#choice"+(i+1)+"-1").val()){//选择题
		var it = $("input[type='radio'][name='group"+(i+1)+	"']:checked").val();
		if(!it){
			answer[i]='0';
		}else{
			answer[i]=it;
		}
	}else{//填空题

	}
		
	}
	console.log(answer);
	$.ajax({
		url : "countscore.php",
		method:"POST",
		datatype:"JSON",
		data:{
			groupid:groupid,
			answer:answer,
		},
		success:function(msg){
			var msg = $.parseJSON(msg);
			//console.log(msg);
			var reply='';
			for(var i=0;i<total;i++){
				item=msg[i];
				if(item!='o'){
					reply=reply+'第'+(i+1)+"题的正确答案是"+item+'\n';
					
				}
				
			}
			if(i==total){
					reply=reply+"你的总成绩是"+msg[i]+"分";
				}
			alert(reply);
			$("#submit").hide();
		},
	})
	
	
})