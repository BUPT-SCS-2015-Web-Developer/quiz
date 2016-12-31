(function($){
 $(function(){
	 //获取发布的题的信息
		$.ajax({
			url:"initlist.php",
			method:"POST",
			datatype:"JSON",
			success:function(msg){
				if(msg){
					var data = $.parseJSON(msg);
					var publics=data.public;
					$.each(publics,function(i,item){
						var copy = $("#quiz").clone(true);
						copy.removeClass("hide");
						/*pic,name,summary,flag,limittime,count(answergroupid)*/
						console.log(item);
						console.log(item.favnums);
						if(!item.pic){
							item.pic="coverpics/2.png"
						}
						copy.find('img').attr("src",item.pic);
						copy.find('.card-title').html(item.name);
						copy.find('.card-content').find('p').html(item.summary);
						copy.attr("id","quiz"+item.flag);
						copy.find("#gointo").attr("href","answer.php?id="+item.flag);
						copy.find("#num").html(item.favnums);
						$(".list").append(copy);
					})
				}
			},
		})
		
		
		
    }); // end of document ready
})(jQuery); // end of jQuery name space