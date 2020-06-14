<?php
/**
 * Created by PhpStorm.
 * User: Ice
 * Email: 190520601@qq.com
 * Date: 2019/1/19
 * Time: 10:37
 */
class UpdateTP
{
    public $version='5.0.24';
    public $tpDir='';
    private $download_url = '';
    /**
     * @var UpdateTP 对象实例
     */
    protected static $instance;
    public function __construct($version=null,$dir='../thinkphp')
    {
        if(!is_null($version)){
            $this->version = $version;
        }
        $this->tpDir = $dir;
        $this->download_url = 'https://github.com/top-think/framework/archive/v' . $this->version . '.zip';
    }
    /**
     * 初始化
     * @access public
     * @param array $options 参数
     * @return UpdateTP
     */
    public static function instance($version = null)
    {
        if (is_null(self::$instance))
        {
            self::$instance = new static($version);
        }

        return self::$instance;
    }

    /**
     * php实现下载远程图片保存到本地
     **
     * $url 所在地址
     * $path 保存图片的路径
     * $filename 自定义命名
     * $type 使用什么方式下载
     * 0:curl方式,1:readfile方式,2file_get_contents方式
     *
     * return 文件名
     */
    private function getFile($url, $path = '', $filename = '', $type = 0)
    {
        if ($url == '') {
            return false;
        }
        //获取远程文件数据
        if ($type === 0) {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);//最长执行时间
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);//最长等待时间

            $img = curl_exec($ch);
            curl_close($ch);
        }
        if ($type === 1) {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }
        if ($type === 2) {
            $img = file_get_contents($url);
        }
        //判断下载的数据 是否为空 下载超时问题
        if (empty($img)) {
            throw new \Exception("下载错误,无法获取下载文件！");
        }

        //没有指定路径则默认当前路径
        if ($path === '') {
            $path = "./";
        }
        //如果命名为空
        if ($filename === "") {
            $filename = md5($img);
        }
        //获取后缀名
        $ext = substr($url, strrpos($url, '.'));
        if ($ext && strlen($ext) < 5) {
            $filename .= $ext;
        }

        //防止"/"没有添加
        $path = rtrim($path, "/") . "/";
        //var_dump($path.$filename);die();
        $fp2 = @fopen($path . $filename, 'a');

        fwrite($fp2, $img);
        fclose($fp2);
        //echo "finish";
        return $filename;
    }
    /**
     * 解压文件
     *
     * @param   string $name 文件名
     * @return  string
     * @throws  Exception
     */
    public function unzip($name)
    {
        $dir = __DIR__ . DIRECTORY_SEPARATOR  . $this->tpDir;
        if (class_exists('ZipArchive')) {
            $zip = new ZipArchive;
            if ($zip->open($name) !== TRUE) {
                throw new Exception('无法打开ZIP文件');
            }
            for($i = 0; $i < $zip->numFiles; $i++) {
                $filename = $zip->getNameIndex($i);
                $_filename=str_replace('framework-'.$this->version,'',$filename);
                @mkdir(dirname($dir . $_filename), 0777, true);
                @copy("zip://" . $name . "#" . $filename, $dir . $_filename);
            }
            $zip->close();
            return $dir;
        }
        throw new Exception("无法执行解压操作，请确保ZipArchive安装正确");
    }

    /**
     * 检查TP版本
     * @return string
     */
    public function checkThinkPHPVersion(){
        require_once $this->tpDir.'/base.php';
        return THINK_VERSION;
    }

    /**
     * 远程下载TP程序
     * @param int $type
     * @return string
     * @throws Exception
     */
    public function download($type=0){
        $old_version=$this->checkThinkPHPVersion();
        if($old_version >= $this->version){
            throw new \Exception("当前版本不需要更新！");
        }
        return $this->getFile($this->download_url,'',$this->version,$type);
    }

    /**
     * 执行升级
     * @param int $type
     * @return string
     * @throws Exception
     */
    public function start($type=2){
        if(!file_exists($this->version.'.zip')){
            $filename=$this->download($type);
        }else{
            $filename=$this->version.'.zip';
        }
        return $this->unzip($filename);
    }

}
try {
    $dir = updateTP::instance('5.0.24')->start();
    echo '成功解压到'.$dir;
}catch (Exception $exception){
    echo $exception->getMessage();
}
