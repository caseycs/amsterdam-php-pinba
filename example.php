<?php
$controllerActions = [
    'user::register' => [
        'c' => 10,
        'memcache::set' => 3,
        'mysql::select' => 4,
        'mysql::insert' => 2
    ],
    'user::logIn' => [
        'memcache::get' => 5,
        'memcache::set' => 10,
        'mysql::select' => 3,
    ],
    'user::logOut' => [
        'memcache::get' => 5,
        'memcache::set' => 2,
        'mysql::select' => 1,
    ],
];

$controllerAction = array_rand($controllerActions);

pinba_hostname_set(array_rand(['app1.com' => true, 'app2.com' => true, 'app3.com' => true,]));
pinba_server_name_set(array_rand(['www1' => true, 'www2' => true, 'www3' => true,]));
pinba_script_name_set($controllerAction);

foreach ($controllerActions[$controllerAction] as $k => $calls) {
    for ($i = 0; $i < $calls; $i++) {
        switch ($k) {
            case 'memcache::get':
                $timer = pinba_timer_start(
                    [
                        'group' => 'memcache',
                        'op' => 'get',
                        'server' => array_rand(
                            ['cache1' => true, 'cache2' => true, 'cache3' => true]
                        )
                    ]
                );
                usleep(rand(200, 404));
                pinba_timer_stop($timer);
                break;
            case 'memcache::set':
                $timer = pinba_timer_start(
                    [
                        'group' => 'memcache',
                        'op' => 'set',
                        'server' => array_rand(
                            ['cache1' => true, 'cache2' => true, 'cache3' => true]
                        )
                    ]
                );
                usleep(rand(400, 604));
                pinba_timer_stop($timer);
                break;
            case 'mysql::select':
                $timer = pinba_timer_start(
                    [
                        'group' => 'mysql',
                        'op' => 'select',
                        'server' => array_rand(
                            ['db1' => true, 'db2' => true, 'db3' => true]
                        )
                    ]
                );
                usleep(rand(1000, 2000));
                pinba_timer_stop($timer);
                break;
            case 'mysql::insert':
                $timer = pinba_timer_start(
                    [
                        'group' => 'mysql',
                        'op' => 'insert',
                        'server' => array_rand(
                            ['db1' => true, 'db2' => true, 'db3' => true]
                        )
                    ]
                );
                usleep(rand(4000, 5000));
                pinba_timer_stop($timer);
                break;
        }
    }
}