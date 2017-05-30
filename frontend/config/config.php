<?php
return [
    'web'=>'frontend',
    'routes'=>[
        '^/$'=> ['controller'=>'home', 'action='>'index'],
        '^/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=>''
    ],
    'templates'=>[
        'vievs'=>'default',
        'layout'=>'default',
    ]
];