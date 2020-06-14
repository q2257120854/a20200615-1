<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Fh extends Controller

{
	public function _initialize()
    {
      parent::_initialize();
    }
    public function index(){
    	
    	$r = db::name('fh')->where('status = 1')->select();
    	if(!$r){
    		exit('empty url');
    	}
    	$url = "http://api.monkeyapi.com";
		$params = array(
			'appkey' =>'2DA72260790BB6854EE8C9A5B2956C24',//
		);
    	foreach($r as $v){
    		$params['url'] = $v['url'];
    		$paramstring = http_build_query($params);
			$content = $this->Curl($url, $paramstring);
			echo $content."<br>";
			$result = json_decode($content, true);
			if($result && $result['code']==200) {
				if($result['msg']=='域名已封杀'){
					db::name('fh')->where('id = '.$v['id'])->update(['status'=>0]);
				}
			}
    	}
    	exit("ok");
    }
    public function add(){
    	
    	if($_POST){
    		$l = explode("\n", $_POST['url_list']);
    		foreach($l as $v){
    			if(preg_match("/^((https|http)?:\/\/)[^\s]+/",$v)){
    				db::name('fh')->insert(['url'=>$v,'status'=>1]);
    			}
    		}
    		echo "<script>alert('添加成功');history.go(-1);</script>";die;
    	}
    	return $this->fetch("add.html"); 
    }
    /**
	    * 请求接口返回内容
	    * @param    string $url [请求的URL地址]
	    * @param    string $params [请求的参数]
	    * @param    int $ipost [是否采用POST形式]
	    * @return    string
	*/
	public function Curl($url, $params = false, $ispost = 0)
	{
	    $httpInfo = array();
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    if ($ispost) {
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
	        curl_setopt($ch, CURLOPT_URL, $url);
	    }else {
	        if ($params) {
	            curl_setopt($ch, CURLOPT_URL, $url.'?'.$params);
	        } else {
	            curl_setopt($ch, CURLOPT_URL, $url);
	        }
	    }

	    $response = curl_exec($ch);
	        if ($response === FALSE) {
	        return false;
	    }
	    // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	    // $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
	    curl_close($ch);
	    return $response;
	}


}
