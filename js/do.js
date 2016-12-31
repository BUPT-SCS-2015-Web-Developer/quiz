$(".continue-choice").click(function(){
	var i=$(".question").length;
	var model=$("#question-1").clone(true);
	model.find(".header").html(i);
	model.find("#inputfile-1").empty();
	model.find(".file-path").val("");//复制节点但不复制表单的值
	model.find("#textareabody").val("");
	model.find("#textareaA").val("");
	model.find("#textareaB").val("");
	model.find("#textareaC").val("");
	model.find("#textareaD").val("");
	model.find("#hints").val("");
	model.find("#inputfile-1").attr("id","inputfile-"+i);
	model.find("#feedback-1").empty();
	model.find("#feedback-1").attr("id","feedback-"+i);
	//区别不同的选择题
	model.find("#correct-1").find("label").eq(0).attr("for",i+"-1");
	model.find("#correct-1").find("#1-1").attr("name","group"+i);
	model.find("#correct-1").find("#1-1").attr("id",i+"-1");
	model.find("#correct-1").find("label").eq(1).attr("for",i+"-2");
	model.find("#correct-1").find("#1-2").attr("name","group"+i);
	model.find("#correct-1").find("#1-2").attr("id",i+"-2");
	model.find("#correct-1").find("label").eq(2).attr("for",i+"-3");
	model.find("#correct-1").find("#1-3").attr("name","group"+i);
	model.find("#correct-1").find("#1-3").attr("id",i+"-3");
	model.find("#correct-1").find("label").eq(3).attr("for",i+"-4");
	model.find("#correct-1").find("#1-4").attr("name","group"+i);
	model.find("#correct-1").find("#1-4").attr("id",i+"-4");
	model.find("#correct-1").attr("id","correct-"+i);

	model.attr("id","question-"+(i));
	$(".questions").append(model);
	$('.collapsible').collapsible({
       accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
     });

})

$(".continue-text").click(function(){
	var i=$(".question").length;
	var model=$("#text-model").clone(true);
	model.removeClass('hide');
	model.find(".header").html(i);
	model.attr("id","question-"+(i));
	$(".questions").append(model);
	 $('.collapsible').collapsible({
       accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
     });

})


$(".next").click(function(){
	$("#next").addClass("hide");
	$(".confirm").removeClass("hide");
	$(".addition").removeClass("hide");
})

var questions=new Array();
var info= new Object;
$("#confirm").click(function(){

	console.log();
	var i=$(".question").length - 1;//减去一个question中隐藏的model
	var j=0;
	
	for(;j<i;j++){
		if($('#question-'+(j+1)).hasClass('choice')){//单选题
			questions[j]=new Object;
			questions[j].flag='choice';
			questions[j].questionbody=$('#question-'+(j+1)).find("#textareabody").val();
			questions[j].textareaA=$('#question-'+(j+1)).find("#textareaA").val();
			questions[j].textareaB=$('#question-'+(j+1)).find("#textareaB").val();
			questions[j].textareaC=$('#question-'+(j+1)).find("#textareaC").val();
			questions[j].textareaD=$('#question-'+(j+1)).find("#textareaD").val();
			//questions[j].files=new Object;	关于上传文件的信息
			questions[j].correctanswer=$("input[type='radio'][name='group"+(j+1)+	"']:checked").val();	
			questions[j].hints=$('#question-'+(j+1)).find('#hints').val();
			
		}else if($('#question-'+(j+1)).hasClass('text')){//填空题
			questions[j]=new Object;
			questions[j].flag='text';
			questions[j].questionbody=$('#question-'+(j+1)).find("#textareabody").val();
			questions[j].hints=$('#question-'+(j+1)).find('#hints').val();
		}
		
	}
	
	info.pic='';
	info.name=$("#name").val();
	info.summary=$("#summary").val();
	info.limittime=$("#limittime").val();
	
	$.ajax({
	url:"masterpush.php",
	type:"POST",
	data:{questions:questions,
		info:info},
	success:function(msg){
		if(msg=="success"){
			alert("提交成功");
			location.reload(); 
		}
	},
	error:function(data){
		
	}
});
})

