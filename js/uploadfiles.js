$(document).ready(function(){
    //响应文件添加成功事件
    $("#inputfile").change(function(){
        //创建FormData对象
        var data = new FormData();
        //为FormData对象添加数据
        $.each($('#inputfile')[0].files, function(i, file) {
            data.append('upload_file'+i, file);
        });
        $(".loading").show();    //显示加载图片
        //发送数据
        $.ajax({
            url:'submit_files.php',
            type:'POST',
            data:data,
            cache: false,
            contentType: false,        //不可缺参数
            processData: false,        //不可缺参数
            success:function(data){
                data = $(data).html();
				$("#feedback").empty();
                //第一个feedback数据直接append，其他的用before第1个（ .eq(0).before() ）放至最前面。
                //data.replace(/&lt;/g,'<').replace(/&gt;/g,'>') 转换html标签，否则图片无法显示。
                if($("#feedback").children('img').length == 0)
					$("#feedback").append(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
                else 
					$("#feedback").children('img').eq(0).before(data.replace(/&lt;/g,'<').replace(/&gt;/g,'>'));
					$(".loading").hide();    //加载成功移除加载图片
            },
            error:function(){
                alert('上传出错');
                $(".loading").hide();    //加载失败移除加载图片
            }
        });
    });
});