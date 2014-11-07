<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'ipt@trila.sk',
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
