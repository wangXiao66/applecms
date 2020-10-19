<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:82:"D:\phpstudy_pro\WWW\applecms(1)\applecms/application/admin\view\template\info.html";i:1602824619;s:80:"D:\phpstudy_pro\WWW\applecms(1)\applecms\application\admin\view\public\head.html";i:1602824618;s:80:"D:\phpstudy_pro\WWW\applecms(1)\applecms\application\admin\view\public\foot.html";i:1602824618;}*/ ?>
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
    <form class="layui-form layui-form-pane" method="post" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">路径：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $fpath; ?>" placeholder="" id="fpath" name="fpath" readonly="readonly">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">文件名：</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="<?php echo $fname; ?>" placeholder="后缀名仅允许html、htm、js、xml；自定义页面以label_开头。" id="fname" name="fname" <?php if($fname != ''): ?>readonly="readonly"<?php endif; ?>>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">内容：</label>
            <div class="layui-input-block">
                <textarea name="fcontent" cols="" rows="" class="layui-textarea"  placeholder="" style="height:550px;"><?php echo $fcontent; ?></textarea>
            </div>
        </div>

        <div class="layui-form-item center">
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit" data-child="true">保 存</button>
                <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
            </div>
        </div>
    </form>

</div>
<script type="text/javascript" src="/static/js/admin_common.js"></script>

<script type="text/javascript">

</script>

</body>
</html>