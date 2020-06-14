<?php

return array (
  0 => 
  array (
    'name' => 'title',
    'title' => '游戏名字',
    'type' => 'string',
    'content' => 
    array (
    ),
    'value' => '108源码',
    'rule' => 'required',
    'msg' => '',
    'tip' => '游戏的名字',
    'ok' => '',
    'extend' => '',
  ),
  1 => 
  array (
    'name' => 'ifkeep',
    'title' => '开启抽水',
    'type' => 'radio',
    'content' => 
    array (
      1 => '开启抽水',
      0 => '不开启',
    ),
    'value' => '1',
    'rule' => 'required',
    'msg' => '',
    'tip' => '开启抽水系统',
    'ok' => '',
    'extend' => '',
  ),
  2 => 
  array (
    'name' => 'waterlever',
    'title' => '大杀水线',
    'type' => 'string',
    'value' => '30',
    'rule' => 'required',
    'msg' => '',
    'tip' => '最大值100,不受开启/关闭控制,输赢超过这个值直接杀掉',
    'ok' => '',
    'extend' => '',
  ),
  3 => 
  array (
    'name' => 'percent',
    'title' => '抽水比例',
    'type' => 'string',
    'value' => '5',
    'rule' => 'required',
    'msg' => '',
    'tip' => '最大值100,受开启/关闭控制',
    'ok' => '',
    'extend' => '',
  ),
  4 => 
  array (
    'name' => 'addin',
    'title' => '自增用户数',
    'type' => 'string',
    'value' => '0',
    'rule' => 'required',
    'msg' => '',
    'tip' => '在ID加上这个数',
    'ok' => '',
    'extend' => '',
  ),
  5 => 
  array (
    'name' => 'hepv',
    'title' => '开和概率',
    'type' => 'string',
    'value' => '0',
    'rule' => 'required',
    'msg' => '',
    'tip' => '0默认关闭',
    'ok' => '',
    'extend' => '',
  ),
  6 => 
  array (
    'name' => 'ipaddress',
    'title' => '接口地址',
    'type' => 'string',
    'value' => '127.0.0.1',
    'rule' => 'required',
    'msg' => '',
    'tip' => '通讯接口地址',
    'ok' => '',
    'extend' => '',
  ),
  7 => 
  array (
    'name' => 'basedata',
    'title' => '基础数据',
    'type' => 'string',
    'value' => '317000',
    'rule' => 'required',
    'msg' => '',
    'tip' => '不要改动基础数据，除非你懂,默认290000',
    'ok' => '',
    'extend' => '',
  ),
  8 => 
  array (
    'name' => 'robot',
    'title' => '开启机器人',
    'type' => 'radio',
    'content' => 
    array (
      1 => '开启机器人',
      0 => '不开启',
    ),
    'value' => '1',
    'rule' => 'required',
    'msg' => '',
    'tip' => '开启机器人',
    'ok' => '',
    'extend' => '',
  ),
  9 => 
  array (
    'name' => 'haibao',
    'title' => '推广海报',
    'type' => 'string',
    'value' => 'ptcjoy.cn/public/Uploads/123.jpg',
    'rule' => 'required',
    'msg' => '',
    'tip' => '不要改动基础数据，除非你懂',
    'ok' => '',
    'extend' => '',
  ),
);
