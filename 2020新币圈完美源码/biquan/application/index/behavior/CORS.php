<?php
namespace app\index\behavior;
use think\Response;
class CORS {
    public function appInit(){
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token, Origin, X-Requested-With, Content-Type, Accept, Authorization");
        header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE');
        if(request()->isOptions()){
            exit();
        }
    }

}