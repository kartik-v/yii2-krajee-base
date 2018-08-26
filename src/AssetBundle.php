<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.3
 */

namespace kartik\base;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * Asset bundle used for all Krajee extensions with bootstrap and jquery dependency.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class AssetBundle extends BaseAssetBundle
{
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
     * @var bool whether the bootstrap JS plugins are to be loaded and enabled
     */
    public $bsPluginEnabled = false;

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\YiiAsset',
    ];

    /**
     * @var bool flag to detect whether bootstrap 4.x version is set
     */
    private $_isBs4;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->initBsAssets();
        parent::init();
    }

    /**
     * Initialize bootstrap assets dependencies
     * @throws InvalidConfigException
     */
    protected function initBsAssets()
    {
        $lib = 'bootstrap' . ($this->isBs4() ? '4' : '');
        $this->depends[] = "yii\\{$lib}\\BootstrapAsset";
        if ($this->bsPluginEnabled) {
            $this->depends[] = "yii\\{$lib}\\BootstrapPluginAsset";
        }
    }

    /**
     * Registers this asset bundle with a view after validating the bootstrap version
     * @param View $view the view to be registered with
     * @param string $bsVer the bootstrap version
     * @return static the registered asset bundle instance
     */
    public static function registerBundle($view, $bsVer = null)
    {
        $currVer = ArrayHelper::getValue(Yii::$app->params, 'bsVersion', null);
        if (empty($bsVer) || static::isSameVersion($currVer, $bsVer)) {
            return static::register($view);
        }
        Yii::$app->params['bsVersion'] = $bsVer;
        $out = static::register($view);
        if (!empty($currVer)) {
            Yii::$app->params['bsVersion'] = $currVer;
        }
        return $out;
    }
}
