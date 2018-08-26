<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.3
 */

namespace kartik\base;

use ReflectionException;
use yii\base\InvalidConfigException;
use yii\base\Module as YiiModule;

/**
 * Base module class for Krajee extensions
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.9.3
 */
class Module extends YiiModule
{
    use TranslationTrait;
    use BootstrapTrait;

    /**
     * @var int|string the bootstrap library version.
     *
     * To use with bootstrap 3 - you can set this to any string starting with 3 (e.g. `3` or `3.3.7` or `3.x`)
     * To use with bootstrap 4 - you can set this to any string starting with 4 (e.g. `4` or `4.1.1` or `4.x`)
     *
     * This property can be set up globally in Yii application params in your Yii2 application config file.
     *
     * For example:
     * `Yii::$app->params['bsVersion'] = '4.x'` to use with Bootstrap 4.x globally
     *
     * If this property is set, this setting will override the `Yii::$app->params['bsVersion']`. If this is not set, and
     * `Yii::$app->params['bsVersion']` is also not set, this will default to `3.x` (Bootstrap 3.x version).
     */
    public $bsVersion;

    /**
     * @var array the the internalization configuration for this widget
     */
    public $i18n = [];

    /**
     * @var string translation message file category name for i18n
     */
    protected $_msgCat = '';

    /**
     * @var bool flag to detect whether bootstrap 4.x version is set
     */
    private $_isBs4;

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
