
<html>
  <button onclick="updatenow()">更新</button>
<script type="text/javascript">
  public function updatenow(){
        include('Update.class.php');
        $version = './Data/version.php';
        $ver = include($version);
        $ver = $ver['ver'];
        $ver = substr($ver,-3);
        $hosturl = urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
        $updatehost = 'http://cmscs1.jc3c.cn/update.php';
        $updatehosturl = $updatehost . '?a=update&v=' . $ver . '&u=' . $hosturl;
        $updatenowinfo = file_get_contents($updatehosturl);
        if (strstr($updatenowinfo, 'zip')){
            $pathurl = $updatehost . '?a=down&f=' . $updatenowinfo;
            $updatedir = './Data/logs/Temp/update';
            delDirAndFile($updatedir);
            get_file($pathurl, $updatenowinfo, $updatedir);
            $updatezip = $updatedir . '/' . $updatenowinfo;
            $archive = new PclZip($updatezip);
            if ($archive -> extract(PCLZIP_OPT_PATH, './', PCLZIP_OPT_REPLACE_NEWER) == 0){
                echo "远程升级文件不存在.升级失败</font>";
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
                echo "<font color=red>升级完成 {$sqlinfo}</font><span><a href=./index.php?g=System&m=Update>点击这里 查看是否还有升级包</a></span>";
            }
        }
        //delDirAndFile($updatedir);
        
    }
    </script>
</html>

