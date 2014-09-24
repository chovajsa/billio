<?php

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 */

class SideBar extends \yii\base\Widget
{
    
    public $route;

    public function init()
    {
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }

        parent::init();
    }

    public function run() {
        return $this->render('sideBar', ['route'=>$this->route]);
    }

}
