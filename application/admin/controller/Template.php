<?php
namespace app\admin\controller;
use think\Db;
use think\Config;
use think\Cache;

class Template extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test_cache()
    {
        $param = input();

        if (!isset($param['type']) || empty($param['host']) || empty($param['port'])) {
            return $this->error('参数错误!');
        }

        $options = [
            'type' => $param['type'],
            'port' => $param['port'],
            'username' => $param['username'],
            'password' => $param['password']
        ];

        Cache::connect($options);
        Cache::set('test', 'test');

        return json(['code' => 1, 'msg' => '测试成功']);
    }


    public function index()
    {
        $param = input();
        $path = $param['path'];
        $path = str_replace('\\','',$path);
        $path = str_replace('/','',$path);

        if(empty($path)){
            $path = '.@template';
        }

        if(substr($path,0,10) != ".@template") { $path = ".@template"; }
        if(count( explode(".@",$path) ) > 2) {
            $this->error('非法目录请求');
            return;
        }

        $uppath = substr($path,0,strrpos($path,"@"));
        $ischild = 0;
        if ($path !=".@template"){
            $ischild = 1;
        }

        $config = config('maccms.site');
        if($param['current']==1){
            $path = '.@template@' . $config['template_dir'] .'@' . $config['html_dir'] ;
            $ischild = 0;
            $pp = str_replace('@','/',$path);
            $filters = $pp.'/*';
        }
        elseif($param['label']==1){
            $path = '.@template@' . $config['template_dir'] .'@' . $config['html_dir'] ;
            $ischild = 0;
            $pp = str_replace('@','/',$path);
            $filters = $pp.'/label/*';
        }
        elseif($param['ads']==1){
            $path = '.@template@' . $config['template_dir'] .'@' . $config['html_dir'] ;
            $ischild = 0;
            $pp = str_replace('@','/',$path);
            $filters = $pp.'/ads/*';
        }
        else{
            $pp = str_replace('@','/',$path);
            $filters = $pp.'/*';
        }

        $this->assign('curpath',$path);
        $this->assign('uppath',$uppath);
        $this->assign('ischild',$ischild);

        $num_path = 0;
        $num_file = 0;
        $sum_size = 0;
        $files = [];

        if(is_dir($pp)) {
            $farr = glob($filters);
            if ($farr) {
                foreach ($farr as $f) {

                    if(is_dir($f)) {
                        $num_path++;
                        $tmp_path = str_replace('./template/', '.@template/', $f);
                        $tmp_path = str_replace('/', '@', $tmp_path);
                        $tmp_name = str_replace($path . '@', '', $tmp_path);
                        $ftime = filemtime($f);

                        $files[] = ['isfile' => 0, 'name' => $tmp_name, 'path' => $tmp_path, 'note'=>'文件夹', 'time' => $ftime];
                    }
                    elseif(is_file($f)) {
                        $num_file++;
                        $fsize = filesize($f);
                        $sum_size += $fsize;
                        $fsize = mac_format_size($fsize);
                        $ftime = filemtime($f);
                        $tmp_path = mac_convert_encoding($f, "UTF-8", "GB2312");

                        $path_info = @pathinfo($f);
                        $tmp_path = $path_info['dirname'];
                        $tmp_name = $path_info['basename'];

                        $files[] = ['isfile' => 1, 'name' => $tmp_name, 'path' => $tmp_path, 'fullname'=> $tmp_path.'/'.$tmp_name, 'size' => $fsize,'note'=>'文件', 'time' => $ftime];
                    }
                }
            }
        }
        $this->assign('sum_size',mac_format_size($sum_size));
        $this->assign('num_file',$num_file);
        $this->assign('num_path',$num_path);
        $this->assign('files',$files);

        $this->assign('title','模板管理');
        return $this->fetch('admin@template/index');
    }

    public function ads()
    {
        $adsdir = $GLOBALS['config']['site']['ads_dir'];
        if(empty($adsdir)){
            $adsdir='ads';
        }
        $path = './template/'.$GLOBALS['config']['site']['template_dir'].'/'.$adsdir ;
        if(!file_exists($path)){
            mac_mkdirss($path);
        }

        $filters = $path.'/*.js';
        $num_file=0;
        $sum_size=0;
        $farr = glob($filters);
        if ($farr) {
            foreach ($farr as $f) {
                if(is_file($f)) {
                    $num_file++;
                    $fsize = filesize($f);
                    $sum_size += $fsize;
                    $fsize = mac_format_size($fsize);
                    $ftime = filemtime($f);
                    $tmp_path = mac_convert_encoding($f, "UTF-8", "GB2312");

                    $path_info = @pathinfo($f);
                    $tmp_path = $path_info['dirname'];
                    $tmp_name = $path_info['basename'];

                    $files[] = ['isfile' => 1, 'name' => $tmp_name, 'path' => $tmp_path, 'fullname'=> $tmp_path.'/'.$tmp_name, 'size' => $fsize,'note'=>'文件', 'time' => $ftime];
                }
            }
        }
        $this->assign('curpath',$path);
        $this->assign('sum_size',mac_format_size($sum_size));
        $this->assign('num_file',$num_file);
        $this->assign('files',$files);
        $this->assign('title','广告位管理');
        return $this->fetch('admin@template/ads');
    }

    public function info()
    {
        $param = input();

        $fname = $param['fname'];
        $fpath = $param['fpath'];

        if( empty($fpath)){
            $this->error('参数错误1');
            return;
        }
        $fpath = str_replace('@','/',$fpath);
        $fullname = $fpath .'/' .$fname;
        $fullname = str_replace('\\','/',$fullname);

        if( (substr($fullname,0,10) != "./template") || count( explode("./",$fullname) ) > 2) {
            $this->error('参数错误2');
            return;
        }
        $path = pathinfo($fullname);
        if(!empty($fname)) {
            $extarr = array('html', 'htm', 'js', 'xml');
            if (!in_array($path['extension'], $extarr)) {
                $this->error('参数错误，后缀名只允许htm,html,js,xml');
                return;
            }
        }

        if (Request()->isPost()) {
            $fcontent = $param['fcontent'];
            if(strpos($fcontent,'<?')!==false){
                $this->error('安全提示，模板中包含php代码禁止在后台编辑');
                return;
            }
            $res = @fwrite(fopen($fullname,'wb'),$fcontent);

            if($res===false){
                return $this->error('保存失败，请重试');
            }
            return $this->success('保存成功');
        }

        $fcontent = @file_get_contents($fullname);
        $fcontent = str_replace('</textarea>','<&#47textarea>',$fcontent);
        $this->assign('fname',$fname);
        $this->assign('fpath',$fpath);
        $this->assign('fcontent',$fcontent);

        return $this->fetch('admin@template/info');
    }

    public function del()
    {
        $param = input();
        $fname = $param['fname'];
        if(!empty($fname)){
            if(!is_array($fname)){
                $fname = [$fname];
            }
            foreach($fname as $a){
                $a = str_replace('\\','/',$a);

                if( (substr($a,0,10) != "./template") || count( explode("./",$a) ) > 2) {

                }
                else{
                    $a = mac_convert_encoding($a,"UTF-8","GB2312");
                    if(file_exists($a)){ @unlink($a); }
                }
            }
        }
        return $this->success('删除成功');
    }

    public function wizard()
    {
        $this->assign('title','标签向导管理');
        return $this->fetch('admin@template/wizard');
    }

    public function template()
    {
        if (Request()->isPost()) {
            $config = input();
            // \print_r($config);die;
            $validate = \think\Loader::validate('System');
            if(!$validate->check($config)){
                return $this->error($validate->getError());
            }
            unset($config['__token__']);


            $ads_dir='ads';
            $mob_ads_dir='ads';
            $path = ROOT_PATH .'template/'.$config['site']['template_dir'].'/info.ini';
            $cc = Config::load($path,'ini');
            if(!empty($cc['adsdir'])){
                $ads_dir = $cc['adsdir'];
            }

            $path = ROOT_PATH .'template/'.$config['site']['mob_template_dir'].'/info.ini';
            $cc = Config::load($path,'ini');
            if(!empty($cc['adsdir'])){
                $mob_ads_dir = $cc['adsdir'];
            }
            $config['site']['ads_dir'] = $ads_dir;
            $config['site']['mob_ads_dir'] = $mob_ads_dir;

            if(empty($config['app']['cache_flag'])){
                $config['app']['cache_flag'] = substr(md5(time()),0,10);
            }

            $config['app']['search_vod_rule'] = join('|', $config['app']['search_vod_rule']);
            $config['app']['search_art_rule'] = join('|', $config['app']['search_art_rule']);

            $config['extra'] = [];
            if(!empty($config['app']['extra_var'])){
                $extra_var = str_replace(array(chr(10),chr(13)), array('','#'),$config['app']['extra_var']);
                $tmp = explode('#',$extra_var);
                foreach($tmp as $a){
                    if(strpos($a,'$$$')!==false){
                        $tmp2 = explode('$$$',$a);
                        $config['extra'][$tmp2[0]] = $tmp2[1];
                    }
                }
                unset($tmp,$tmp2);
            }

            $config_new['site'] = $config['site'];
            $config_new['app'] = $config['app'];
            $config_new['extra'] = $config['extra'];

            $config_old = config('maccms');
            // $config_new = array_merge($config_old, $config_new);
            $config_old['site']['template_dir'] = $config['site']['template_dir'];
            $config_old['site']['site_tj'] = $config['site']['site_tj'];
            $tj = $config_old['site']['site_tj'];
            if(strpos($tj,'document.w') ===false){
                $tj = 'document.write(\'' . str_replace("'","\'",$tj) . '\')';
            }
            $res = @fwrite(fopen('./static/js/tj.js', 'wb'), $tj);
            
            $res = mac_arr2file(APP_PATH . 'extra/maccms.php', $config_old);
            if ($res === false) {
                return $this->error('保存失败，请重试!');
            }
            return $this->success('保存成功!');
        }


        $template = glob('./template' . '/*', GLOB_ONLYDIR);
        
        foreach ($template as $k => &$v) {
            
            /**
             * 这里根据目录把目录名称以及缩略图路径--添加到数据库当中
             */
            $image = str_replace('.', '', $v);
            $v = str_replace('./template/', '', $v);

            $first = db::table('template')->where('name',$v)->select();

            if(!$first) db::table('template')->insert(['name'=>$v,'image'=>$image]);


            /**
             * 如果模板已被删除-对应得缩略图sql也删除
             */
            $templates = db::table('template')->select();

            foreach($templates as $key=>$value){
                
                //如果没有此目录-则删除对应数据
                if(!is_dir($_SERVER['DOCUMENT_ROOT'].$value['image'])){

                    db::table('template')->where('id',$value['id'])->delete();

                }

            }

        }

        $templates = db::table('template')->select();

        $this->assign('templates', $templates);

        $usergroup = Db::name('group')->select();
        $this->assign('usergroup', $usergroup);

        $config = config('maccms');
        $this->assign('config', $config);
        $this->assign('title', '网站参数配置');
        return $this->fetch('admin@template/template');
    }

}
