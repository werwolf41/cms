<?php

return [
	'components'=>[
        'cache'=>'vendor\\core\\components\\Cache',
        'mailer'=>[
            'class'=>'duncan3dc\\SwiftMailer\\Mailer',
            'config'=>[

                'smtpServer'    => 'smtp.gmail.com',
                'port'	 	    =>  465,
                'encryption'    => 'ssl',
                'username'      => '',
                'password'	    => '',
                "fromAddress"   =>  "krasnikovrs@gmail.com",
                "fromName"      =>  "Mr Example",
            ],
        ]
	],
];