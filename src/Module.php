<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.5
 */

namespace kartik\base;

use ReflectionException;
use yii\base\InvalidConfigException;
use yii\base\Module as YiiModule;

/**
 * This is the base module class for all modules implemented in Krajee extensions. It includes specific
 * enhancements for configuring translations for the Krajee modules. It also allows initializing Bootstrap library
 * specific parameters based on the Bootstrap library version (3.x, 4.x, or 5.x) used by your application.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class Module extends YiiModule implements BootstrapInterface
{
    use TranslationTrait;
    use BootstrapTrait;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     * @throws ReflectionException
     */
    public function init()
    {
        $this->initBsVersion();
        parent::init();
        $this->initI18N();
    }
}
