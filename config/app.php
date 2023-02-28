<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 * 
 * Read more about application configuration:
 * https://craftcms.com/docs/4.x/config/app.html
 */

use craft\helpers\App;

return [
    'id' => App::env('CRAFT_APP_ID') ?: 'CraftCMS',
    '*' => [
        'modules' => [
          //'my-module' => \modules\Module::class,
          'module' => [
            'class' => \modules\Module::class,
          ],
        ],
        'bootstrap' => ['module'],
        
    ],
    // Staging environment settings
    'staging' => [
        'components' => [
            'redis' => [
                'class' => yii\redis\Connection::class,
                'hostname' => getenv('REDIS_HOST'),
                'port' => getenv('REDIS_PORT')
            ],
            'cache' => [
                'class' => yii\redis\Cache::class,
                'defaultDuration' => 86400,
                // 'keyPrefix' => getenv('REDIS_KEY_PREFIX'),
            ],
            'session' => function() {
                // Get the default component config
                $config = craft\helpers\App::sessionConfig();
  
                // Override the class to use Redis' session class
                $config['class'] = yii\redis\Session::class;
  
                // Instantiate and return it
                return Craft::createObject($config);
            },
            'mutex' => [
                'mutex' => 'yii\redis\Mutex',
            ]
        ]
    ]

];
