<?php
return [
    'paths'=>[
        'migrations'=> __DIR__.'/../migrations',
        'seeds'=> __DIR__.'/../migrations/seeds',
    ],
    'environments'=>[
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'production'=>[
            'adapter'=> 'mysql',
            'host' => 'localhost',
            'name' => 'cms',
            'user' => 'root',
            'pass' => 'root',
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ],


        'development'=>[
            'adapter'=> 'mysql',
            'host' => 'localhost',
            'name' => 'cms',
            'user' => 'root',
            'pass' => 'root',
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ],


        'testing'=>[
            'adapter'=> 'mysql',
            'host' => 'localhost',
            'name' => 'cms',
            'user' => 'root',
            'pass' => '',
            'port' => 3306,
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix'    => ''
        ],

        'version_order'=> 'creation'
    ],
];