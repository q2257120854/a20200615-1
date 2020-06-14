<?php

namespace addons\Biquan;

use app\common\library\Menu;
use think\Addons;

/**
 * game
 */
class Biquan extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    { 
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
   
        return true;
    }
    
    /**
     * 插件启用方法
     */
    public function enable()
    {
 
    }

    /**
     * 插件禁用方法
     */
    public function disable()
    {
       // Menu::disable('Lonfeng');
    }

}
