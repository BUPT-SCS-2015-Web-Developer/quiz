//https://www.cnblogs.com/Zjmainstay/archive/2012/08/09/jQuery_upload_image.html
//https://www.cnblogs.com/2050/p/3913184.html
$("#submit").click(function(){
	var body = $("#textareabody").val();
	var choice1 = $("#textareaA").val();
	var choice2 = $("#textareaB").val();
	var choice3 = $("#textareaC").val();
	var choice4 = $("#textareaD").val();
	var correctanswer = $("#correct").val();
	var hints = $("#hints").val();
	var files=new Object;
	files.img1=$("img").eq(0).attr("src");
	files.img2=$("img").eq(1).attr("src");
	files.img3=$("img").eq(2).attr("src");
	files.img4=$("img").eq(3).attr("src");
	files.audio=$("audio").eq(0).attr("src");
	files.video=$("video").eq(0).attr("src");
	$.ajax({
		url: "pushcommit.php",
		type: "POST",
		data: {
			file:files,
			body:body,
			choice1:choice1,
			choice2:choice2,
			choice3:choice3,
			choice4:choice4,
			hints:hints,
			correctanswer:correctanswer,
		},
		success:function(msg){
			console.log(msg);
			if(msg=="error_questionbody"){
				alert("再检查一下你的题干吧");
			}
			else if(msg=="error_choice1"){
				alert("再检查一下你的A选项吧");
			}
			else if(msg=="error_choice2"){
				alert("再检查一下你的B选项吧");
			}
			else if(msg=="error_choice3"){
				alert("再检查一下你的C选项吧");
			}
			else if(msg=="error_choice4"){
				alert("再检查一下你的D选项吧");
			}
			else if(msg=="error_hints"){
				alert("再检查一下你的hints吧");
			}
			else if(msg=="error_correctanswer"){
				alert("认真设置正确答案= =");
			}
			else if(msg=="success"){
				alert("提交成功");
				location.reload(); 
			}
			else{
				alert("哪里好像不对");
			}
        },
        error:function(data){
               alert('上传图片出错');
        }
	});
	
	
})