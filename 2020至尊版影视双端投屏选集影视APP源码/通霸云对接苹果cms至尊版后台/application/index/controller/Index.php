<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
	
	/**设置提卡**/
	
	public function setTpay(){
		if(request()->isPost())
		{
				$data = input();
				$status = false;
				foreach($data['setValue'] as $k=>$v){
					if($status==false){
						if(((int)$k)===0){
							$data = db('tpay_type')->where(['str_name'=>$k,'uid'=>1])->find();
							$data['uid']=(int)session('usershshefsdf');
							$data['money']=$v;
							unset($data['id']);
							db('tpay_type')->insert($data);
						}else{
							db('tpay_type')->where(['id'=>$k])->update(['money'=>$v]);
						}
					} 
					
				} 
		}
		$data = db('tpay_type')->where(['uid'=>session('usershshefsdf')])->select();
		if(!$data){
			$data = db('tpay_type')->where(['uid'=>1])->select();
			foreach($data as $k=>$v){
				if($v['str_name']!='daili'){
					$data[$k]['id']=$v['str_name'];	
				}
				
			}
		}
		return view('setTpay',[
                'data' => $data, 
            ]);
	}
    public function _initialize()
    {
        $id         =   session('usershshefsdf');
        if(!$id)
        {
            $this->redirect('login/login/index');
        }
    }
    public function index()
    {
        if(session('power')=='1')
        {
            return view('huan');
        }else{
            $tzcount  =   db('user')->where('(power = 1 or power =2) and logintime >'. strtotime(date('Y-m-d')))->count();
            $dcount   =   db('user')->where('power = 1')->count();
            $ycount   =   db('user')->where('power = 2')->count();
       	 	$fcount	=	db('dianka')->distinct('yid')->where('yid>1')->count();
          
            $fcount2 =   db('user')
                ->alias('u')
                ->join('timelog t','t.cid=u.id','right')
                ->where('u.power=2')
                ->count();
          $banben=db('advert')->where('id',48)->find();
         
          $updatehost = 'http://cmscs1.jc3c.cn//update.php';
        $lastver = file_get_contents(($updatehost . '?a=check&v=111111') );
          
          
          $ver = $banben['content'];
        $updatehost = 'http://cmscs1.jc3c.cn//update.php';
        $lastver = file_get_contents(($updatehost . '?a=check&v=') . $ver);
        if($lastver !== $ver){
            $updateinfo = '<span>
		   <a href="javascript:if(confirm(\'升级前,请确认已经做好数据库和程序备份!\'))location=\'./index.php?g=System&m=Update&a=updatenow\'">点击这里在线升级</a>
           </span>';
            $chanageinfo = file_get_contents(($updatehost . '?a=chanage&v=') . $lastver);
        }else{
            $updateinfo = ('<p class="red">最新版本为： ' . $lastver) . '</p><span>已经是最新系统 不需要升级</span>';
        }
        $this -> assign('updateinfo', $updateinfo);
        $this -> assign('chanageinfo', $chanageinfo);
        $this -> display();
          
          
          
            return view('index',[
                'fcount' => $fcount,
                'mcount' => $ycount-$fcount,
                'tzcount' =>   $tzcount,
                'dcount'  =>    $dcount,
                'ycount'  =>    $ycount,
              'banben'  =>    $banben['content'],
               'zxbanben'  =>    $lastver,
              'gengx'=>$updateinfo,
            ]);
        }

    }
  
  public function upup()
    {
    $banben=db('advert')->where('id',48)->find();
    $ver = $banben['content'];
        $hosturl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        $updatehost = 'http://cmscs1.jc3c.cn//update.php';
        $updatehosturl = $updatehost . '?a=update&v=' . $ver . '&u=' . $hosturl.'&key=7f56843f3a709865';
        $updatenowinfo = file_get_contents($updatehosturl);
        if (strstr($updatenowinfo, 'zip')){
            $pathurl = $updatehost . '?a=down&f=' . $updatenowinfo;
            $updatedir = '/Data/logs/Temp/update';
             $this ->delDirAndFile($updatedir);
            $this ->get_file($pathurl, $updatenowinfo, $updatedir);
            $updatezip = $updatedir . '/' . $updatenowinfo;
            $archive = new PclZip($updatezip);
            if ($archive -> extract(PCLZIP_OPT_PATH, './', PCLZIP_OPT_REPLACE_NEWER) == 0){
                $updatenowinfo = "远程升级文件不存在.升级失败</font>";
            }else{
                $sqlfile = $updatedir . '/update.sql';
                $sql = file_get_contents($sqlfile);
                if($sql){
                    $sql = str_replace("wy_", C('DB_PREFIX'), $sql);
                    $Model = new Model();
                    error_reporting(0);
                    foreach(split(";[\r\n]+", $sql) as $v){
                        @mysql_query($v);
                    }
                }
                $updatenowinfo = "<font color=red>升级完成 {$sqlinfo}</font><span><a href=./index.php?g=System&m=Update>点击这里 查看是否还有升级包</a></span>";
            }
        }
        //delDirAndFile($updatedir);
        $this -> assign('updatenowinfo', $updatenowinfo);
        $this -> display();

    echo($updatenowinfo);
    }

function delDirAndFile( $dirName )
{
if ( $handle = opendir( "$dirName" ) ) {
   while ( false !== ( $item = readdir( $handle ) ) ) {
   if ( $item != "." && $item != ".." ) {
   if ( is_dir( "$dirName/$item" ) ) {
   delDirAndFile( "$dirName/$item" );
   } else {
   if( unlink( "$dirName/$item" ) )echo "成功删除文件： $dirName/$item<br />\n";
   }
   }
   }
   closedir( $handle );
   if( rmdir( $dirName ) )echo "成功删除目录： $dirName<br />\n";
}
}

}
