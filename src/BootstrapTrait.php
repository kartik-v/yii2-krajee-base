<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.6
 */

namespace kartik\base;

use Yii;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

/**
 * BootstrapTrait includes bootstrap library init and parsing methods
 *
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
trait BootstrapTrait
{
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
     * @var array the bootstrap grid column css prefixes mapping, the key is the bootstrap versions, and the value is
     * an array containing the sizes and their corresponding grid column css prefixes. The class using this trait, must
     * implement BootstrapInterface. If not set will default to:
     * ```php
     * [
     *   '3' => [
     *      self::SIZE_X_SMALL => 'col-xs-',
     *      self::SIZE_SMALL => 'col-sm-',
     *      self::SIZE_MEDIUM => 'col-md-',
     *      self::SIZE_LARGE => 'col-lg-',
     *      self::SIZE_X_LARGE => 'col-lg-',
     *   ],
     *   '4' => [
     *      self::SIZE_X_SMALL => 'col-',
     *      self::SIZE_SMALL => 'col-sm-',
     *      self::SIZE_MEDIUM => 'col-md-',
     *      self::SIZE_LARGE => 'col-lg-',
     *      self::SIZE_X_LARGE => 'col-xl-',
     *   ],
     * ];
     * ```
     */
    public $bsColCssPrefixes = [];

    /**
     * @var string default icon CSS prefix
     */
    protected $_defaultIconPrefix;

    /**
     * @var string default bootstrap button CSS
     */
    protected $_defaultBtnCss;

    /**
     * @var bool flag to detect whether bootstrap 4.x version is set
     */
    protected $_isBs4;

    /**
     * Initializes bootstrap versions for the widgets and asset bundles.
     * Sets the [[_isBs4]] flag by parsing [[bsVersion]]
     *
     * @throws InvalidConfigException
     */
    protected function initBsVersion()
    {
        $v = empty($this->bsVersion) ? ArrayHelper::getValue(Yii::$app->params, 'bsVersion', '3.x') : $this->bsVersion;
        $this->_isBs4 = static::parseVer($v) === '4';
        $this->_defaultIconPrefix = 'glyphicon glyphicon-';
        $this->_defaultBtnCss = 'btn-default';
        if ($this->_isBs4) {
            if (!class_exists('yii\bootstrap4\Html')) {
                throw new InvalidConfigException(
                    "You must install 'yiisoft/yii2-bootstrap4' extension for Bootstrap 4.x version support. " .
                    "Dependency to 'yii2-bootstrap4' has not been included with 'yii2-krajee-base'. To resolve, you " .
                    "must add 'yiisoft/yii2-bootstrap4' to the 'require' section of your application's composer.json " .
                    "and then run 'composer update'."
                );
            }
            $this->_defaultIconPrefix = 'fas fa-';
            $this->_defaultBtnCss = 'btn-outline-secondary';
        }
        $interface = BootstrapInterface::class;
        if (!($this instanceof $interface)) {
            $class = get_called_class();
            throw new InvalidConfigException("'{$class}' must implement '{$interface}'.");
        }
        if (empty($this->bsColCssPrefixes)) {
            $this->bsColCssPrefixes = [
                '3' => [
                    self::SIZE_X_SMALL => 'col-xs-',
                    self::SIZE_SMALL => 'col-sm-',
                    self::SIZE_MEDIUM => 'col-md-',
                    self::SIZE_LARGE => 'col-lg-',
                    self::SIZE_X_LARGE => 'col-lg-',
                ],
                '4' => [
                    self::SIZE_X_SMALL => 'col-',
                    self::SIZE_SMALL => 'col-sm-',
                    self::SIZE_MEDIUM => 'col-md-',
                    self::SIZE_LARGE => 'col-lg-',
                    self::SIZE_X_LARGE => 'col-xl-',
                ],
            ];
        }
    }

    /**
     * Validate if Bootstrap 4.x version
     * @return bool
     *
     * @throws InvalidConfigException
     */
    public function isBs4()
    {
        if (!isset($this->_isBs4)) {
            $this->initBsVersion();
        }
        return $this->_isBs4;
    }

    /**
     * Gets the default button CSS
     * @return string
     */
    public function getDefaultBtnCss()
    {
        return $this->_defaultBtnCss;
    }

    /**
     * Gets the default icon css prefix
     * @return string
     */
    public function getDefaultIconPrefix()
    {
        return $this->_defaultIconPrefix;
    }

    /**
     * Parses and returns the major BS version
     * @param string $ver
     * @return bool|string
     */
    protected static function parseVer($ver)
    {
        $ver = (string)$ver;
        return substr(trim($ver), 0, 1);
    }

    /**
     * Compares two versions and checks if they are of the same major BS version
     * @param int|string $ver1 first version
     * @param int|string $ver2 second version
     * @return bool whether major versions are equal
     */
    protected static function isSameVersion($ver1, $ver2)
    {
        if ($ver1 === $ver2 || (empty($ver1) && empty($ver2))) {
            return true;
        }
        return static::parseVer($ver1) === static::parseVer($ver2);
    }
}