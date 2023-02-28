<?php

namespace modules\variables;

use Craft;
use craft\commerce\Plugin;
use Exception;

class SiteVariable
{

    public function getMessage(bool $delete)
    {
        $message = "";
        if($delete)
            $message = Craft::$app->session->remove('dipt_message');
        else
            $message = Craft::$app->session->get('dipt_message');
        
        return $message;
    }
}