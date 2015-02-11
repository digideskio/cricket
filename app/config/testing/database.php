<?php

return array(
    'default' => 'sqlite',
    'connections' => array(
        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => ''
        ),
    )
);

// attempt to use real data
// sqllite db in memory does not allow enum, so unable to use artisan migrate
// the setup below returns an error: Database does not exist, even though it does exist
return array(
    'default' => 'sqlite',
    'connections' => array(
        'mysql' => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'practice_test',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),
    )
);
