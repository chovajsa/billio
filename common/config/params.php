<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,

    'roles'=>[
    	'admin'=>['admin'],
    	'light'=>['lightApprove'],
    	'lightApprove'=>['lightApprove'],
    	'hardApprove'=>['hardApprove'],
    	'strongApprove'=>['strongApprove'],
    	'pay'=>['pay']
    ]
];
