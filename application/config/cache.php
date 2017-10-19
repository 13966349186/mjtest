<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//数据缓存Memcache配置
$config['data']['host'] = 'localhost';
$config['data']['port'] = '11211';
//业务逻辑缓存Memcache配置
$config['logic']['host'] = 'localhost';
$config['logic']['port'] = '11211';
