<?php

namespace ovidiupop\identities;

use yii\web\AssetBundle;

class IdentititiesAsset extends AssetBundle
{
    public $sourcePath;
    public $css = [];
    public $js;

    public function init()
    {
        parent::init();
        $this->sourcePath = __DIR__ . '/assets';
        $this->js = [
            'js/identities.js',
        ];
    }

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}