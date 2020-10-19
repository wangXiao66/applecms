<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:78:"D:\phpstudy_pro\WWW\applecms(9)\applecms/application/admin\view\art\batch.html";i:1601360319;s:80:"D:\phpstudy_pro\WWW\applecms(9)\applecms\application\admin\view\public\head.html";i:1602480301;}*/ ?>
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
<div class="page-container p10">

    <form class="layui-form" method="post" action="">

        <div class="my-toolbar-box">

            <div class="center mb10">

                    <div class="layui-input-inline w150">
                        <select name="type">
                            <option value="">选择分类</option>
                            <?php if(is_array($type_tree) || $type_tree instanceof \think\Collection || $type_tree instanceof \think\Paginator): $i = 0; $__LIST__ = $type_tree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;if($vo['type_mid'] == 2): ?>
                            <option value="<?php echo $vo['type_id']; ?>" <?php if($param['type'] == $vo['type_id']): ?>selected <?php endif; ?>><?php echo $vo['type_name']; ?></option>
                            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $ch['type_id']; ?>" <?php if($param['type'] == $ch['type_id']): ?>selected <?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;├&nbsp;<?php echo $ch['type_name']; ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="status">
                            <option value="">选择状态</option>
                            <option value="0" <?php if($param['status'] == '0'): ?>selected <?php endif; ?>>未审核</option>
                            <option value="1" <?php if($param['status'] == '1'): ?>selected <?php endif; ?>>已审核</option>
                        </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="level">
                            <option value="">选择推荐</option>
                            <option value="9" <?php if($param['level'] == '9'): ?>selected <?php endif; ?>>推荐9-幻灯</option>
                            <option value="1" <?php if($param['level'] == '1'): ?>selected <?php endif; ?>>推荐1</option>
                            <option value="2" <?php if($param['level'] == '2'): ?>selected <?php endif; ?>>推荐2</option>
                            <option value="3" <?php if($param['level'] == '3'): ?>selected <?php endif; ?>>推荐3</option>
                            <option value="4" <?php if($param['level'] == '4'): ?>selected <?php endif; ?>>推荐4</option>
                            <option value="5" <?php if($param['level'] == '5'): ?>selected <?php endif; ?>>推荐5</option>
                            <option value="6" <?php if($param['level'] == '6'): ?>selected <?php endif; ?>>推荐6</option>
                            <option value="7" <?php if($param['level'] == '7'): ?>selected <?php endif; ?>>推荐7</option>
                            <option value="8" <?php if($param['level'] == '8'): ?>selected <?php endif; ?>>推荐8</option>
                        </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="lock">
                            <option value="">选择锁定</option>
                            <option value="0" <?php if($param['lock'] == '0'): ?>selected <?php endif; ?>>未锁定</option>
                            <option value="1" <?php if($param['lock'] == '1'): ?>selected <?php endif; ?>>已锁定</option>
                        </select>
                    </div>
                    <div class="layui-input-inline w150">
                        <select name="pic">
                            <option value="">选择图片</option>
                            <option value="1" <?php if($param['pic'] == '1'): ?>selected<?php endif; ?>>无图片</option>
                            <option value="2" <?php if($param['pic'] == '2'): ?>selected<?php endif; ?>>远程图片</option>
                            <option value="3" <?php if($param['pic'] == '3'): ?>selected<?php endif; ?>>同步出错图</option>
                        </select>
                    </div>

                    <div class="layui-input-inline">
                        <input type="text" autocomplete="off" placeholder="请输入关键字" class="layui-input" name="wd" value="<?php echo $param['wd']; ?>">
                    </div>

            </div>

        </div>

        <fieldset class="layui-elem-field">
            <legend>批量删除</legend>
            <div class="layui-field-box">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label"><input type="checkbox" lay-ignore value="1" name="ck_del">确认删除</label>
                        <div class="layui-input-inline" style="width: 100px;">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button type="button" class="layui-btn btn_submit">批量删除</button>
                </div>
            </div>
        </fieldset>

        <fieldset class="layui-elem-field">
        <legend>批量设置</legend>
        <div class="layui-field-box">

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><input type="checkbox" lay-ignore value="1" name="ck_level" title="推荐">推荐</label>
                    <div class="layui-input-inline" style="width: 100px;">
                        <select name="val_level">
                            <option value="">选择推荐</option>
                            <option value="9" >推荐9-幻灯</option>
                            <option value="1" >推荐1</option>
                            <option value="2" >推荐2</option>
                            <option value="3" >推荐3</option>
                            <option value="4" >推荐4</option>
                            <option value="5" >推荐5</option>
                            <option value="6" >推荐6</option>
                            <option value="7" >推荐7</option>
                            <option value="8" >推荐8</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><input type="checkbox" lay-ignore value="1" name="ck_lock">锁定</label>
                    <div class="layui-input-inline" style="width: 100px;">
                        <select name="val_lock">
                            <option value="">选择操作</option>
                            <option value="0" >解锁</option>
                            <option value="1" >锁定</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><input type="checkbox" lay-ignore value="1" name="ck_status">状态</label>
                    <div class="layui-input-inline" style="width: 100px;">
                        <select name="val_status">
                            <option value="">选择状态</option>
                            <option value="0" >未审核</option>
                            <option value="1" >已审核</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label"><input type="checkbox" lay-ignore value="1" name="ck_hits">人气</label>
                    <div class="layui-input-inline" style="width: 100px;">
                        <input type="text" name="val_hits_min" required  placeholder="最小值" autocomplete="off" class="layui-input">
                    </div>
                    <div class="layui-input-inline" style="width: 100px;">
                        <input type="text" name="val_hits_max" required  placeholder="最大值" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <button type="submit" class="layui-btn btn_submit">批量设置</button>
            </div>

        </div>
    </fieldset>
    </form>
</div>

<script type="text/javascript">
    layui.use(['form'], function () {

    });

    $('.btn_submit').click(function(){
        $('form').submit();
    })
</script>
</body>
</html>