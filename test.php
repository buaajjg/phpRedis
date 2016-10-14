<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'Predis/Autoloader.php';
Predis\Autoloader::register();
if (isset($_GET['cmd']) === true) {
  $host = 'redis-master';
  if (getenv('GET_HOSTS_FROM') == 'env') {
    $host = getenv('REDIS_MASTER_SERVICE_HOST');
  }
  header('Content-Type: application/json');
if ($_GET['cmd'] == 'set') {
        $redis = new Predis\Client();
        $redis->set($_GET['key'], $_GET['value']);
        echo "message updated!!!!";
        print('{"message":"Updated"}');
}
else{
        $redis = new Predis\Client();
        $value = $redis->get($_GET['key']);
        echo "$value";
        print('{"data":"'.$value.'"}');
}
}
else{
phpinfo();
}
?>
