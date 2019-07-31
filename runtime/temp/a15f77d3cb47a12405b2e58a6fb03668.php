<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"C:\Users\li\Desktop\thinkphp_5.0.24\public/../application/index\view\index\test.html";i:1563328146;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="en">
	<meta charset="UTF-8">
	<title>jquery自动补全+ajax</title>
	<style>
		body{font-size:12px;}
		*{margin:0;padding:0;}
		#searchBox{position:relative;margin:100px auto;width:200px;}
		/*补全框*/
		.autocomplete{background:#fff;border:1px solid #efefef;list-style-type:none;}
		.autocomplete li{height:20px;line-height:20px;border-bottom:1px solid #efefef;cursor:default;}
		.highlight {background-color: #9ACCFB;}
		#search{outline:none;width:100%;}
	</style>
</head>
<body>
<div id="searchBox">
	<form>
		<input type="text" id="search" autocomplete="off" value=""/>
<!--		<input type="button" value="123" class="sub">-->
	</form>

</div>
<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
<script>

	//-------注册地自动补全开始----------------------------------
	var search=$("#search");
	//创建自动完成的下拉列表，用于显示服务器返回的数据，插入在输入框后面，然后调整位置
	var autocomplete=$('<ul class="autocomplete"></ul>').hide().appendTo("#searchBox");
	//清空下拉列表的内容并且隐藏下拉列表
	var clear= function () {
		autocomplete.empty().hide();
	};
	//注册事件，当输入框失去焦点的时候清空下拉列表并隐藏
	search.blur(function () {
		setTimeout(clear,500);
	});
	// if(search.val()==' '){
	// 	setTimeout(clear,500);
	// }
	//下拉列表中高亮的项目的索引，当显示下拉列表项的时候，移动鼠标或者键盘的下键就会移动高亮的项目
	var selectedItem=null;
	var timeoutId=null;
	//设置下拉项的高亮背景
	var setSelectedItem= function (item) {
		selectedItem=item;
		//按上下键是循环显示的，小于0就设置成最大值，大于最大值就设置成0
		if(selectedItem<0){
			selectedItem=autocomplete.find("li").length-1;
		}else if(selectedItem>autocomplete.find("li").length-1){
			selectedItem=0;
		}
		//首先移除其他列表项的高亮背景，然后再高亮当前索引的背景
		autocomplete.find("li").removeClass("highlight")
				.eq(selectedItem).addClass("highlight");
	};
	var ajax_request= function () {
//        ajax服务端通信
		$.ajax({
			url:"<?php echo url('index/index/t'); ?>",
			contentType:"application/x-www-form-urlencoded:charset=UTF-8",
			type:"get",
			dataType:"json",
			data:{"username":$("#search").val()},
			success: function (data) {
				var cityArr=data;
//                var cityArr=["大壳宝","大壳美","大壳棒棒哒","厉害了我的壳"];
				//如果有数据
				if(cityArr.length>0){
					$.each(cityArr, function (index, term) {
						//创建li标签，添加到下拉列表中
						$('<li></li>').text(term).appendTo(autocomplete)
								.addClass("clickable")
								.hover(function () {
									$(this).siblings().removeClass("highlight");
									$(this).addClass("highlight");
									selectedItem=index;
								}, function () {
									$(this).removeClass("highlight");
									selectedItem=-1;
								}).click(function () {
							//鼠标单击下拉列表的这一项的话，就将这一项的值添加到输入框中
							search.val(term);
							//清空并隐藏下拉列表
							autocomplete.empty().hide();
						});
					});//事件注册完毕
					//设置下拉列表的位置，然后显示下拉列表
					var ypos=search.height()+4;
					var xpos=search.position().left;
					autocomplete.css('width',search.css('width'));
					autocomplete.css({'position':'absolute','left':xpos+'px','top':ypos+'px',"z-index":"100"});
					setSelectedItem(0);
					//显示下拉列表
					autocomplete.show();
				}
			}
		});
	};
	//对输入框进行事件注册
	search.keyup(function (e) {
		//字母数字、退格、空格
		if(e.keyCode > 40 || e.keyCode == 8 || e.keyCode ==32){
			//首先删除下拉列表中的信息
			autocomplete.empty().hide();
			clearTimeout(timeoutId);
			if (search.val()!=='') {
				timeoutId=setTimeout(ajax_request,100);
			}

		}else if(e.keyCode==38){
			//上
			//selectedItem=-1代表鼠标离开
			if(selectedItem==-1){
				setSelectedItem(autocomplete.find("li").length-1);
			}else{
				//索引减1
				setSelectedItem(selectedItem-1);
			}
			e.preventDefault();
		}else if(e.keyCode==40){
			//下
			if(selectedItem==-1){
				setSelectedItem(0);
			}else{
				setSelectedItem(selectedItem+1);
			}
			e.preventDefault();
		}
	}).keypress(function (e) {
		//enter回车键
		if(e.keyCode==13){
			//列表为空或者鼠标离开导致当前没有索引值
			if(autocomplete.find("li").length==0||selectedItem==-1){
				return;
			}
			search.val(autocomplete.find("li").eq(selectedItem).text());
			autocomplete.empty().hide();
			e.preventDefault();
		}
	}).keydown(function (e) {
		//esc后退
		if(e.keyCode==27){
			autocomplete.empty().hide();
			e.preventDefault();
		}
	});
	//------注册地自动补全结束----------------------------
</script>
</body>
</html>