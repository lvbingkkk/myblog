<?php
$redis = new Redis();
$host = '127.0.0.1';
$redis->connect($host);
$redis->set('a', 'isa');
$data = $redis->get('a');
echo $data;


