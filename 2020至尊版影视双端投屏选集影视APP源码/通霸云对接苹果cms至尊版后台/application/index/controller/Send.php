<?php
 
namespace app\index\controller;

use think\Controller;
use think\Session;  
use JPush\Client as JPush;
 
include EXTEND_PATH.'jpush/autoload.php'; 

class Send extends Controller
{ 
  
	public function index(){
		$status=0;
		 if(request()->isPost())
		{
			$key = input('key');
			$send = input('send');
			$src = input('src');
			$appKey = $key;
			$masterSecret = $src;
			 db('jpush')->where(['id'=>1])->update(['key'=>$key,'secret'=>$src]); 
			if($send==1) {
						$cont = input('content');
						
						$title = input('title');
						$id = (int)input('r_id');
						//$id =   ''; '120c83f760792c908ed';'18071adc034d6546722';
						$client = new JPush($appKey, $masterSecret); 
						if(!$cont){
							return false;
						} 
						$msg = $cont;
						if(!$id){ 
							$push_payload = $client->push()
								->setPlatform('all')
								->addAllAudience()
								->setNotificationAlert($msg );
								try {
									$response = $push_payload->send(); 
									
								} catch (\JPush\Exceptions\APIConnectionException $e) {
									// try something here
									$status=2;
								} catch (\JPush\Exceptions\APIRequestException $e) {
									// try something here
									//print $e;
									$status=2;
								} 
						}else{
							try { 
									$push_payload =$client->push()
										-> addRegistrationId($id)
										->setPlatform('all')
										->iosNotification($msg , [
											'sound' => 'sound',
											'badge' => '+1' 

										])->androidNotification($msg ,[
											'title'=> $title 
										]);
									$response = $push_payload->send();  
								} catch (\JPush\Exceptions\APIConnectionException $e) {
									//print $e;
									// try something here
									//trace($e->getMessage(), 'error');
									$status=2;
								} catch (\JPush\Exceptions\APIRequestException $e) {
									print $e;
									// try something here
									//trace($e->getMessage(), 'error');
									//return false;
									$status=2;
								}
						}
			}
			
			$status=1;
		}
		 $data = db('jpush')->where(['id'=>1])->find(); 
		return view('sendMessage',[
				'data'=>$data,
                'status' =>$status, 
            ]);
	}
	public function bind(){
		$id = input('registrationId');
		if($id){
			session('registrationId',$id);
		}
		$uid = session('usershshefsdf');
		if($uid){
			db('user')->where(['id'=>$uid])->update(['jpush_id'=>$id]);
		}
		echo json_encode(['code'=>1,'msg'=>$_SESSION]);
	}
	public function tc(){
		$data = db('tc')->find();
		echo json_encode(['code'=>1,'msg'=>$data]);
	}
	public function setTc(){
		$status=0;
		 if(request()->isPost())
		{
			 db('tc')->where(['id'=>1])->update($_POST);
			 $status=1;
		}
		$data = db('tc')->find();
		return view('tc',[
                'data' =>$data , 
				'status'=>$status
            ]);
	}
}