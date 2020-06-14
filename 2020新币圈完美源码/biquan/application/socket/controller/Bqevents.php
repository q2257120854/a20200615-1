<?php

namespace app\socket\controller;

/**

 * 用于检测业务代码死循环或者长时间阻塞等问题

 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload

 * 然后观察一段时间workerman.log看是否有process_timeout异常

 */

//declare(ticks=1);

/**

 * 聊天主逻辑

 * 主要是处理 onMessage onClose 

 */

use \GatewayWorker\Lib\Gateway;
use \Workerman\Lib\Timer;
use app\socket\controller\Bqroom;
use think\Db;
use think\Cache;
use extend\org;
require_once __DIR__ .'/Bqroom.php';
class Bqevents

{

 public static $tmp;
  /**

    * 有消息时

    * @param int $client_id

    * @param mixed $message

    */
   public static function onMessage($client_id, $message)

   {
     
        $message_data = json_decode($message, true);
        if(!$message_data){return ;}
        Bqroom::onmessage($client_id, $message_data);
        //默认房间1

   }

   

    /**

    * 当客户端断开连接时

    * @param integer $client_id 客户端id

    */

   public static function onConnect($client_id)

   {

     Bqroom::onConnect($client_id);

   }

/**

    * 当客户端开始时

    * @param integer $client_id 客户端id

    */

  public static function onWorkerStart($client_id)

   {

     Bqroom::onWorkerStart($client_id);
    

   }

   /**

    * 当客户端断开连接时

    * @param integer $client_id 客户端id

    */

   public static function onClose($client_id)

   {

     

     Bqroom::onClose($client_id);  

   }

  

  

}

