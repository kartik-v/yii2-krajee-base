<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   2.0.3
 */

namespace kartik\base;

/**
 * Common base widget asset bundle for all Krajee widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class WidgetAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/kv-widgets']);
        $this->setupAssets('js', ['js/kv-widgets']);
        parent::init();
    }
}
