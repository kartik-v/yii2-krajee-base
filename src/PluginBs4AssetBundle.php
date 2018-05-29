<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.0
 */

namespace kartik\base;

/**
 * Base asset bundle for Krajee extensions (including bootstrap 4.x assets and plugins)
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.6.0
 */
class PluginBs4AssetBundle extends AssetBundle
{
    /**
     * @inheritdoc
     */
     public $depends = [
        'yii\bootstrap4\BootstrapPluginAsset'
    ];
}
