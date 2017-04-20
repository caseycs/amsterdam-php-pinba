<?php
$controllerActions = [
    'user::register' => true,
    'user::login' => true,
    'user::logOut' => true,
];

pinba_hostname_set(array_rand(['app1.com' => true,'app2.com' => true,'app3.com' => true,]));
pinba_server_name_set(array_rand(['www1' => true,'www2' => true,'www3' => true,]));
pinba_script_name_set(array_rand($controllerActions));

$timer = pinba_timer_start(['group' => 'memcache', 'op' => 'get']);
usleep(rand(200, 400));
pinba_timer_stop($timer);
