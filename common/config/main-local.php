<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            //'dsn' => 'mysql:host=localhost;dbname=techelm_mobile',
            //'username' => 'techelm_mobile',
            //'password' => 'nnr5JNLrf@)R',
          //   'dsn' => 'mysql:host=localhost;dbname=api_techelm',
            'dsn' => 'mysql:host=localhost;dbname=techelm_crm',
             'username' => 'root',
             'password' => '',
            'charset' => 'utf8',
        ],
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => '',
                'username' => '',
                'password' => '',
              //  'host' => 'smtp.gmail.com',
              //  'username' => 'currentdemo777@gmail.com',
            //    'password' => 'lepassword',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions'=> [ 'ssl' =>
                    [ 'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ] //here
            ],
        ],
    ],
];
