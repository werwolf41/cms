<?php
return [
    'web'=>'frontend',
    'routes'=>[
        '^/$'=> ['controller'=>'home', 'action='>'index'],
        '^/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=>''
    ],
    'vievs'=>[
        'themes'=>'default',
        'layout'=>'default',
    ]
];