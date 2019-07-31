<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"E:\phpstudy\WWW\thinkphp_5.0.24\public/../application/admin\view\index\category.html";i:1564127556;}*/ ?>
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
	</head>

	<body>
		<div class="page-content-wrap">
				<form class="layui-form" action="">
					<div class="layui-form-item">
						<div class="layui-inline tool-btn">
							<button class="layui-btn layui-btn-small layui-btn-normal addBtn hidden-xs" data-url="<?php echo url('admin/index/categoryadd'); ?>"><i class="layui-icon">&#xe654;</i></button>
<!--							<button class="layui-btn layui-btn-small layui-btn-warm listOrderBtn hidden-xs" data-url="/admin/category/listorderall.html"><i class="iconfont">&#xe656;</i></button>-->
							<button class="layui-btn layui-btn-small layui-btn-warm refreshbtn hidden-xs" onclick="window.location.reload()">刷新</button>
						</div>
<!--						<div class="layui-inline">-->
<!--							<input type="text" name="title" placeholder="请输入标" autocomplete="off" class="layui-input">-->
<!--						</div>-->
<!--						<div class="layui-inline">-->
<!--							<select name="category" lay-filter="status">-->
<!--								<option value="0">主导航</option>-->
<!--								<option value="010">关于我们</option>-->
<!--								<option value="021">产品中心</option>-->
<!--								<option value="021">新闻中心</option>-->
<!--								<option value="021">业务范围</option>-->
<!--								<option value="021">联系我们</option>-->
<!--								<option value="021">在线留言</option>-->
<!--							</select>-->
<!--						</div>-->
<!--						<button class="layui-btn layui-btn-normal" lay-submit="search">搜索</button>-->
					</div>
				</form>
				<div class="layui-form" id="table-list">
					<table class="layui-table" lay-even lay-skin="nob">
						<colgroup>
							<col width="50">
							<col class="hidden-xs" width="50">
							<col class="hidden-xs" width="100">
							<col>
							<col width="80">
							<col width="150">
						</colgroup>
						<thead>
							<tr>
								<th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose"></th>
								<th class="hidden-xs">ID</th>
<!--								<th class="hidden-xs">排序</th>-->
								<th>菜单名称</th>
								<th>状态</th>
								<th>推荐</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
						<?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$category): $mod = ($i % 2 );++$i;?>
							<tr>
								<td><input type="checkbox" name="" lay-skin="primary" data-id="<?php echo $category['id']; ?>"></td>
								<td class="hidden-xs"><?php echo $category['id']; ?></td>
<!--								<td class="hidden-xs"><input type="text" name="title" autocomplete="off" class="layui-input" value="0" data-id="1"></td>-->
								<td><?php echo $category['name']; ?></td>
								<td><button class="layui-btn layui-btn-mini layui-btn-<?php echo $category['is_show']==1?'normal':'warm'; ?> table-list-status" data-status='<?php echo $category['is_show']; ?>'><?php echo $category['is_show']==1?'显示':'隐藏'; ?></button></td>
								<td><button class="layui-btn layui-btn-mini layui-btn-<?php echo $category['is_recommend']==1?'normal':'warm'; ?> table-list-status" data-status='<?php echo $category['is_recommend']; ?>'><?php echo $category['is_recommend']==1?'推荐':'不推荐'; ?></button></td>
								<td>
									<div class="layui-inline">
<!--										<button class="layui-btn layui-btn-mini layui-btn-normal  add-btn" data-id="1" data-url="menu-add2.html"><i class="layui-icon">&#xe654;</i></button>-->
										<button class="layui-btn layui-btn-mini layui-btn-normal  edit-btn" data-id="<?php echo $category['id']; ?>" data-url="<?php echo url('admin/index/categoryedit'); ?>"><i class="layui-icon">&#xe642;</i></button>
										<button class="layui-btn layui-btn-mini layui-btn-danger del-btn" data-id="<?php echo $category['id']; ?>" onclick="del()"><i class="layui-icon">&#xe640;</i></button>
									</div>
								</td>
							</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
		</div>
		<script src="../../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
		<script src="../../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
		<script>
			layui.use(['form', 'jquery', 'layer', 'dialog'], function() {
				var $ = layui.jquery;

				//修改状态
				// $('#table-list').on('click', '.table-list-status', function() {
				// 	var That = $(this);
				// 	var status = That.attr('data-status');
				// 	var id = That.parent().attr('data-id');
				// 	if(status == 1) {
				// 		That.removeClass('layui-btn-normal').addClass('layui-btn-warm').html('隐藏').attr('data-status', 2);
				// 	} else if(status == 2) {
				// 		That.removeClass('layui-btn-warm').addClass('layui-btn-normal').html('显示').attr('data-status', 1);
				//
				// 	}
				// })

			});
		</script>
	</body>

</html>