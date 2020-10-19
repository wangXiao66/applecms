<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:75:"D:\phpstudy_pro\WWW\applecms/application/admin\view\system\href_config.html";i:1602492340;s:68:"D:\phpstudy_pro\WWW\applecms\application\admin\view\public\head.html";i:1602480301;s:68:"D:\phpstudy_pro\WWW\applecms\application\admin\view\public\foot.html";i:1601360319;}*/ ?>
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
<?php echo $GLOBALS['a'] ?>
<div class="page-container">

    <div class="showpic" style="display:none;"><img class="showpic_img" width="120" height="160"></div>

    <form class="layui-form layui-form-pane" action="">
        <input type="hidden" name="__token__" value="<?php echo \think\Request::instance()->token(); ?>" />

        <div class="layui-tab" lay-filter="tb1">
            <ul class="layui-tab-title">
                <li class="layui-this" lay-id="config_1">基本设置</li>
            </ul>
            <div class="layui-tab-content">

                <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label">链接1</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href1]" placeholder="链接1" value="<?php echo $config['site']['href1']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接2</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href2]" placeholder="链接2" value="<?php echo $config['site']['href2']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接3</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href3]" placeholder="链接3" value="<?php echo $config['site']['href3']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接4</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href4]" placeholder="链接4" value="<?php echo $config['site']['href4']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接5</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href5]" placeholder="链接5" value="<?php echo $config['site']['href5']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接6</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href6]" placeholder="链接6" value="<?php echo $config['site']['href6']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接7</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href7]" placeholder="链接7" value="<?php echo $config['site']['href7']; ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">链接8</label>
                    <div class="layui-input-block">
                        <input type="text" name="site[href8]" placeholder="链接8" value="<?php echo $config['site']['href8']; ?>" class="layui-input">
                    </div>
                </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">二维码：</label>
                        <div class="layui-input-inline w600">
                            <input type="text" name="site[code]" placeholder="图片" value="<?php echo $config['site']['code']; ?>" class="layui-input upload-input">
                        </div>
                        <div class="layui-input-inline ">
                            <button type="button" class="layui-btn layui-upload" lay-data="{data:{thumb:0,thumb_class:'site[site_logo]'}}" id="upload1">上传图片</button>
                        </div>
                    </div>

                    <div class="layui-form-item center">
                        <div class="layui-input-block">
                            <button type="submit" class="layui-btn" lay-submit="" lay-filter="formSubmit">保 存</button>
                            <button class="layui-btn layui-btn-warm" type="reset">还 原</button>
                        </div>
                    </div>
                    
            </div>
        </div>
    </form>
</div>

<script type="text/javascript" src="/static/js/admin_common.js"></script>
<script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
<script type="text/javascript">

    layui.use(['form','upload', 'layer'], function(){
        // 操作对象
        var element = layui.element
            ,form = layui.form
            , layer = layui.layer
            , upload = layui.upload;

        form.on('radio(cache_type)',function(data){
            $('.row_cache_server').hide();
           if(data.value=='memcache' || data.value=='redis' || data.value=='memcached'){
               $('.row_cache_server').show();
           }
        });

        element.on('tab(tb1)', function(){
            $.cookie('config_tab', this.getAttribute('lay-id'));
        });

        if( $.cookie('config_tab') !=null ) {
            element.tabChange('tb1', $.cookie('config_tab'));
        }

        upload.render({
            elem: '.layui-upload'
            ,url: "<?php echo url('upload/upload'); ?>?flag=site"
            ,method: 'post'
            ,before: function(input) {
                layer.msg('文件上传中...', {time:3000000});
            },done: function(res, index, upload) {
                var obj = this.item;
                if (res.code == 0) {
                    layer.msg(res.msg);
                    return false;
                }
                layer.closeAll();
                var input = $(obj).parent().parent().find('.upload-input');
                if ($(obj).attr('lay-type') == 'image') {
                    input.siblings('img').attr('src', res.data.file).show();
                }
                input.val(res.data.file);

                if(res.data.thumb_class !=''){
                    $('.'+ res.data.thumb_class).val(res.data.thumb[0].file);
                }
            }
        });

        $('.upload-input').hover(function (e){
            var e = window.event || e;
            var imgsrc = $(this).val();
            if(imgsrc.trim()==""){ return; }
            var left = e.clientX+document.body.scrollLeft+20;
            var top = e.clientY+document.body.scrollTop+20;
            $(".showpic").css({left:left,top:top,display:""});
            if(imgsrc.indexOf('://')<0){ imgsrc = ROOT_PATH + '/' + imgsrc;	} else{ imgsrc = imgsrc.replace('mac:','http:'); }
            $(".showpic_img").attr("src", imgsrc);
        },function (e){
            $(".showpic").css("display","none");
        });


    });

    function test_cache(){
        var type = $("input[name='app[cache_type]']:checked").val();
        var host = $("input[name='app[cache_host]']").val();
        var port = $("input[name='app[cache_port]']").val();
        var user_name =  $("input[name='app[cache_username]']").val();
        var password = $("input[name='app[cache_password]']").val();
        layer.msg('数据提交中...',{time:500000});
        $.ajax({
            url: "<?php echo url('system/test_cache'); ?>",
            type: "post",
            dataType: "json",
            data: {type:type,host:host,port:port,username:user_name,password:password},
            beforeSend: function () {
            },
            error:function(r){
                layer.msg('发生错误，请检查是否开启扩展库和配置项!',{time:1800});
            },
            success: function (r) {
                layer.msg(r.msg,{time:1800});
            },
            complete: function () {
            }
        });
    }


</script>

</body>
</html>