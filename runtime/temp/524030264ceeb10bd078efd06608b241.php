<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:84:"D:\phpstudy_pro\WWW\applecms(9)\applecms/application/admin\view\category\create.html";i:1602561057;s:80:"D:\phpstudy_pro\WWW\applecms(9)\applecms\application\admin\view\public\head.html";i:1602480301;s:80:"D:\phpstudy_pro\WWW\applecms(9)\applecms\application\admin\view\public\foot.html";i:1601360319;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title; ?> - 麦云网络管理系统</title>
    <link rel="stylesheet" href="/static/layui/css/layui.css?v=1020">
    <link rel="stylesheet" href="/static/css/admin_style.css?v=1020">
    <script type="text/javascript" src="/static/js/jquery.js?v=1020"></script>
    <script type="text/javascript" src="/static/layui/layui.js?v=1020"></script>
    <script>
        var ROOT_PATH="",ADMIN_PATH="<?php echo $_SERVER['SCRIPT_NAME']; ?>", MAC_VERSION='v10';
    </script>
</head>
<body>

<div class="page-container">

    <form action="<?php echo url('category/create'); ?>" method="post">

        <div class="layui-tab-item layui-show" style="margin-top: 2%">
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称：</label>
                <div class="layui-input-block">
                    <input type="text" name="cate_name" placeholder="请输入分类名称" value="" class="layui-input">
                </div>
            </div>
        </div>

        <div class="layui-input-block" style="text-align: left;margin-top: 6%">
            <!--<input type="submit" class="layui-btn" value = '保存'>-->
            <button type="submit" class="layui-btn" >保 存</button>
            <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
        </div>

    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>


</body>
</html>