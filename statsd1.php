<?php
require 'vendor/autoload.php';

$connection = new \Domnikl\Statsd\Connection\UdpSocket('statsd', 8125);
$statsd = new \Domnikl\Statsd\Client($connection, "statsd1");

for ($i = 0; $i < 100; $i ++) {
    var_dump($statsd->increment("foo.bar"));
}
