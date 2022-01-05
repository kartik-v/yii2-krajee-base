<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.2
 */

namespace kartik\base;

/**
 * This is the base asset bundle class for Krajee extensions which enables Krajee's special jQuery plugin handling
 * functionality. It also includes special configurations to automatically enable Bootstrap library Plugins based
 * on your bootstrap library version.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class PluginAssetBundle extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $bsPluginEnabled = true;
}
