<?php
namespace app\admin\controller;
use think\Db;
use think\Config;
use think\Cache;
use think\Request;

class Category extends Base
{
    public function create(Request $request){
        if($request->isPost()){
            $data = $request->post();
//            var_dump($data);die;
            $res = Db::name('category')->insert($data);
            if($res) {
                return $this->success('保存成功');
            }
        }else{
            return $this->fetch('admin@category/create');
        }

    }
}