(function($){
  $(function(){
		//获取所有未完成和已完成的信息
		$.ajax({
			url:"mcinit.php",
			type:"POST",
			datatype:"JSON",
			success:function(msg){
				if(msg){
					var data = $.parseJSON(msg);
					var personals=data.personal;
					var publics=data.public;
				}
				$.each(personals,function(i,item){
					//console.log(item.flag);
					var copy=$("#prequiz0").clone(true);
					copy.removeClass('hide');
					if(!item.pic){
						item.pic="coverpics/2.png"
					}
					copy.find('img').attr("src",item.pic);
					copy.find('.card-title').html(item.name);
					copy.find('.card-content').find('p').html(item.summary);
					copy.attr("id","prequiz"+item.flag);
					$(".personal").append(copy);
					
				})
				$.each(publics,function(i,item){
					//console.log(item.flag);
					var copy=$("#afterquiz0").clone(true);
					copy.removeClass('hide');
					if(!item.pic){
						item.pic="coverpics/1.png"
					}
					copy.find('img').attr("src",item.pic);
					copy.find('.card-title').html(item.name);
					copy.find('.card-content').find('p').html(item.summary);
					copy.attr("id","afterquiz"+item.flag);
					$(".public").append(copy);
				})
			},
			error:function(data){
				
			}
		})
  }); // end of document ready
})(jQuery); // end of jQuery name space

$("#publicquestions").click(function(){
	$(this).parent().parent().parent().hide();
	$quizid=$(this).parent().parent().parent().attr("id");
	var groupid=$quizid.split("prequiz")[1];
	$.ajax({
		url:"handleqry.php",
		method:"POST",
		data:{groupid:groupid,
			action:"publicquestions",},
		success:function(msg){
			if(msg=="success"){
				console.log("public success");
			}
		},
	
	})
})

$("#undo").click(function(){
	$(this).parent().parent().parent().hide();
	$quizid=$(this).parent().parent().parent().attr("id");
	var groupid=$quizid.split("afterquiz")[1];
	$.ajax({
		url:"handleqry.php",
		method:"POST",
		data:{groupid:groupid,
			action:"undo",},
		success:function(msg){
			if(msg=="success"){
				console.log("undo success");
			}
		},
	
	})
})