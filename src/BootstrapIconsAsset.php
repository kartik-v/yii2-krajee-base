<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.2
 */

namespace kartik\base;

use yii\web\AssetBundle as YiiAssetBundle;

/**
 * Asset bundle for bootstrap 5 icons
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class BootstrapIconsAsset extends YiiAssetBundle
{
    /**
     * @inheritDoc
     */
    public $css = ['https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css'];
}
