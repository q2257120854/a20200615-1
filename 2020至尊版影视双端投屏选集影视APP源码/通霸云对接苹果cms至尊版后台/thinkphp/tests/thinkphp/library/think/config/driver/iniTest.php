<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | 更多资源请关注：三岁半资源网:sansuib.com
// +----------------------------------------------------------------------

/**
 * Ini配置测试
 * @author    7IN0SAN9 <me@7in0.me>
 */

namespace tests\thinkphp\library\think\config\driver;

use tests\thinkphp\library\think\config\ConfigInitTrait;
use think\config;

class iniTest extends \PHPUnit_Framework_TestCase
{
    use ConfigInitTrait;

    public function testParse()
    {
        Config::parse('inistring=1', 'ini');
        $this->assertEquals(1, Config::get('inistring'));
        Config::reset();
        Config::parse(__DIR__ . '/fixtures/config.ini');
        $this->assertTrue(Config::has('inifile'));
        $this->assertEquals(1, Config::get('inifile'));
        Config::reset();
    }
}
