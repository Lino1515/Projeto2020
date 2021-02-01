<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'v1' => [
            'class' => 'app\modules\v1\v1',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'c8EkGJvnuOn8dEpnWA8b9sAapqkQsQ2X',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => null
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        /* 'authManager' =>
          [
          'class' => 'yii\rbac\DbManager',
          'defaultRoles' => ['guest'],
          ], */
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/tipojogo', 'v1/jogos', 'v1/comentarios', 'v1/comentariosreports', 'v1/comentariosutilizador', 'v1/review', 'v1/reviewreports', 'v1/reviewutilizador', 'v1/user'],
                    'tokens' => [
                         '{id}' => '<id:\\d[\\d,]*>',
                        //'{username}' => '<username:\\d[\\d,]*>',
                        //'{type}' => '<type:\\w+>'
                        '{username}' => '<username:[a-zA-Z0-9\\-]+>',
                        '{password}' => '<password:[a-zA-Z0-9\\-]+>'
                    ],
                    'pluralize' => false,
                    'extraPatterns' => [
                        'GET total' => 'total', //Obtem total de clientes                        
                        'GET {id}/tipo' => 'tipo', //Obtem o tipo de jogo ActionTipo
                        //VAIS BUSCAR OS MAIS RECENTES E MAIS ANTIGOS PARA EXIBIR NA PAGINA PRINCIPAL
                        'GET top' => 'top', //Obtem o top de jogos actionTop
                        'GET bot' => 'bot', //Obtem o top de jogos actionTop
                        //TOP REVIEWS DE DETERMINADO JOGO
                        'GET topreview/{id}' => 'topreview', //Obtem o top de jogos actionTop
                        //TOP COMENTARIO DE DETERMINADO JOGO
                        'GET topcomentario/{id}' => 'topcomentario', //Obtem o top de jogos actionTop
                        //ORDENAÇÃO
                        'GET dataasc' => 'dataasc', //Obtem todos os resultados em asc por data
                        'GET datadesc' => 'datadesc', //Obtem todos os resultados em desc por data
                        'GET nomeasc' => 'nomeasc', //Obtem todos os resultados em asc por nome
                        'GET nomedesc' => 'nomedesc', //Obtem todos os resultados em desc por nome
                        'GET jogosandtipojogo' => 'jogosandtipojogo',
                        'GET loginuser/{username}/{password}' => 'loginuser',
                    ],
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
