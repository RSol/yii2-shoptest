<?php

namespace app\assets;

use yii\web\AssetBundle;

class CardAsset extends AssetBundle
{
    public $js = [
        '/js/card.js'
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];
}
