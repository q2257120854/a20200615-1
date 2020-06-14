# thinkphp-update
## 自动下载并升级TP框架

### TP5.0和5.1 最近爆出漏洞，导致之前很多用TP做的项目都需要升级，所以做了这个小工具来升级。

#使用方法
1. 将updateTP.php放到public目录，不用关心项目的入口文件是在根目录还是在public目录
2. 修改要下载的版本号，默认是5.0.24
    ```php
    $dir = updateTP::instance('5.0.24')->start();
    ```
3. 访问updateTP.php，执行程序
4. 删除pulic目录下的下载压缩包