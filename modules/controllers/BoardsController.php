<?php

namespace modules\controllers;

use Craft;
use craft\web\Controller;

class BoardsController extends Controller
{

    protected array|bool|int $allowAnonymous = true;
    
    public function actionCreate(){
        
        Craft::$app->session->set('dipt_message', 'Board successfully created');

        Craft::$app->getUrlManager()->setRouteParams([
            'success' => '1'
        ]);

        return $this->asSuccess();
    }
}