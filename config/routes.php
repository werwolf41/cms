<?php
return [
	'^/admin$'=>['module'=>'admin', 'controller'=>'admin', 'action'=>'index'],
    '^$'=> ['controller'=>'home', 'action='>'index'],
    '^/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=>'',
    '^/(?P<module>admin)/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$'=>'',
];