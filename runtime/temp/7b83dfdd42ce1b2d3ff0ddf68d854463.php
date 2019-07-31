<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"E:\phpstudy\WWW\thinkphp_5.0.24\public/../application/admin\view\index\categoryadd.html";i:1564124437;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>网站后台管理模版</title>
		<link rel="stylesheet" type="text/css" href="../../static/admin/layui/css/layui.css" />
		<link rel="stylesheet" type="text/css" href="../../static/admin/css/admin.css" />
		<link href="https://cdn.bootcss.com/font-awesome/5.10.0-11/css/all.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="wrap-container">
				<form class="layui-form" style="width: 90%;padding-top: 20px;">
					<div class="layui-form-item">
						<label class="layui-form-label">分类名称：</label>
						<div class="layui-input-block">
							<input type="text" lay-verify="required" name="name" class="layui-input" autocomplete="off">
						</div>
					</div>

<!--					<div class="layui-form-item">-->
<!--						<label class="layui-form-label">标签：</label>-->
<!--						<div class="layui-input-block">-->
<!--							<input type="text" name="label" required lay-verify="required" placeholder="请输入标签" autocomplete="off" class="layui-input" value="关于我们">-->
<!--						</div>-->
<!--					</div>-->

					<div class="layui-form-item">
						<label class="layui-form-label">状态：</label>
						<div class="layui-input-block">
							<input type="radio" name="is_show" value="1" title="显示" checked>
							<input type="radio" name="is_show" value="0" title="隐藏">
						</div>

					</div>

					<div class="layui-form-item">
						<label class="layui-form-label">推荐：</label>
						<div class="layui-input-block">
							<input type="radio" name="is_recommend" value="1" title="推荐" checked>
							<input type="radio" name="is_recommend" value="0" title="不推荐">
						</div>

					</div>
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn layui-btn-normal " lay-submit  lay-filter="formDemo">立即提交</button>
							<button type="reset" class="layui-btn layui-btn-primary">重置</button>
						</div>
					</div>
				</form>
		</div>
		<script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
		<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
		<script>
			//Demo
			layui.use(['form'], function() {
				var form = layui.form();
				form.render();
				//监听提交
				form.on('submit(formDemo)', function(data) {
					$.ajax({
						url:"<?php echo url('admin/index/categoryadd'); ?>",
						type:'post',
						dataType:'json',
						data:data.field,
						success:function(e){
							if(e.status=='200'){
								parent.location.reload();
							}
						}
					})
					// return false;
					// layer.closeAll()
				});
			});
		</script>
	</body>

</html>