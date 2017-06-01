<?php
return [
    '^/$'=> ['controller'=>'home', 'action='>'index'],
    '^/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=>''
];