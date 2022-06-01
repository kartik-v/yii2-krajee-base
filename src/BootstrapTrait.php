<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.5
 */

namespace kartik\base;

use Exception;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\base\InvalidConfigException;

/**
 * BootstrapTrait includes bootstrap library init and parsing methods. The class which uses this trait, must also
 * necessarily implement the [[BootstrapInterface]].
 *
 * @property-read int $bsExtBasename The yii2 bootstrap extension base name (**readonly** property available via getter method [[getBsExtBasename()]])
 * @property-read int $bsVer Bootstrap version number currently set (**readonly** property available via getter method [[getBsVer()]])
 * @property-read string $defaultBtnCss Default bootstrap button CSS (**readonly** property available via getter method [[getDefaultBtnCss()]])
 * @property-read string $defaultIconPrefix Default icon prefix (**readonly** property available via getter method [[getDefaultIconPrefix()]])
 * @property-read string $dropdownClass Bootstrap dropdown class name based on currently configured bootstrap version
 * (**readonly** property available via getter method [[getDropdownClass()]])
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
trait BootstrapTrait
{
    /**
     * @var array CSS conversion mappings across bootstrap library versions.
     *
     * This is set as `$key => $value` pairs where:
     *
     * - `$key`: _string_, is the style type to be configured (one of the constants starting with `BS_`)
     * - `$value`: _array_, consists of 3 rows / items, each of which can be setup either as  _string_
     *    (single CSS class) or an _array_ (multiple CSS classes). Each of the row items indicate the following:
     *      - the first item represents the CSS class(es) for Bootstrap 3.x.
     *      - the second item represents the CSS class(es) for Bootstrap 4.x
     *      - the third item represents the CSS class(es) for Bootstrap 5.x (if it does not exist will use bootstrap 4.x setting)
     */
    public static $bsCssMap = [
        self::BS_SR_ONLY => ['sr-only', 'sr-only', 'visually-hidden'],
        self::BS_PANEL => ['panel', 'card'],
        self::BS_PANEL_HEADING => ['panel-heading', 'card-header'],
        self::BS_PANEL_TITLE => ['panel-title', 'card-title'],
        self::BS_PANEL_BODY => ['panel-body', 'card-body'],
        self::BS_PANEL_FOOTER => ['panel-footer', 'card-footer'],
        self::BS_PANEL_DEFAULT => ['panel-default', ['bg-light', 'text-dark']],
        self::BS_PANEL_DARK => ['panel-default', ['bg-dark', 'text-white']],
        self::BS_PANEL_SECONDARY => ['panel-default', ['bg-secondary', 'text-white']],
        self::BS_PANEL_PRIMARY => ['panel-primary', ['bg-primary', 'text-white']],
        self::BS_PANEL_SUCCESS => ['panel-success', ['bg-success', 'text-white']],
        self::BS_PANEL_INFO => ['panel-info', ['bg-info', 'text-dark']],
        self::BS_PANEL_WARNING => ['panel-warning', ['bg-warning', 'text-dark']],
        self::BS_PANEL_DANGER => ['panel-danger', ['bg-danger', 'text-white']],
        self::BS_LABEL => ['label', 'badge'],
        self::BS_BADGE => ['badge', ['badge', 'badge-pill'], ['badge', 'rounded-pill']],
        self::BS_LABEL_DEFAULT => ['label-default', 'badge-secondary', 'bg-secondary'],
        self::BS_LABEL_LIGHT => ['label-default', ['bg-light', 'text-dark']],
        self::BS_LABEL_DARK => ['label-default', ['bg-dark', 'text-white']],
        self::BS_LABEL_PRIMARY => ['label-primary', 'badge-primary', 'bg-primary'],
        self::BS_LABEL_SUCCESS => ['label-success', 'badge-success', 'bg-success'],
        self::BS_LABEL_INFO => ['label-info', 'badge-info', ['bg-info', 'text-dark']],
        self::BS_LABEL_WARNING => ['label-warning', 'badge-warning', ['bg-warning', 'text-dark']],
        self::BS_LABEL_DANGER => ['label-danger', 'badge-danger', 'bg-danger'],
        self::BS_TABLE_ACTIVE => ['default', 'table-active'],
        self::BS_TABLE_PRIMARY => ['primary', 'table-primary'],
        self::BS_TABLE_SUCCESS => ['success', 'table-success'],
        self::BS_TABLE_INFO => ['info', 'table-info'],
        self::BS_TABLE_WARNING => ['warning', 'table-warning'],
        self::BS_TABLE_DANGER => ['danger', 'table-danger'],
        self::BS_PROGRESS_BAR_ACTIVE => ['active', 'progress-bar-animated'],
        self::BS_PROGRESS_BAR_PRIMARY => ['progress-bar-primary', 'bg-primary'],
        self::BS_PROGRESS_BAR_SUCCESS => ['progress-bar-success', 'bg-success'],
        self::BS_PROGRESS_BAR_INFO => ['progress-bar-info', 'bg-info'],
        self::BS_PROGRESS_BAR_WARNING => ['progress-bar-warning', 'bg-warning'],
        self::BS_PROGRESS_BAR_DANGER => ['progress-bar-danger', 'bg-danger'],
        self::BS_WELL => ['well', ['card', 'card-body']],
        self::BS_WELL_SM => ['well-sm', ['card', 'card-body', 'p-2']],
        self::BS_WELL_LG => ['well-lg', ['card', 'card-body', 'p-4']],
        self::BS_THUMBNAIL => ['thumbnail', ['card', 'card-body']],
        self::BS_NAVBAR_DEFAULT => ['navbar-default', 'navbar-light'],
        self::BS_NAVBAR_TOGGLE => ['navbar-toggle', 'navbar-toggler'],
        self::BS_NAVBAR_RIGHT => ['navbar-right', 'ml-auto'],
        self::BS_NAVBAR_BTN => ['navbar-btn', 'nav-item'],
        self::BS_NAVBAR_FIXTOP => ['navbar-fixed-top', 'fixed-top'],
        self::BS_NAV_STACKED => ['nav-stacked', 'flex-column'],
        self::BS_NAV_ITEM => ['', 'nav-item'],
        self::BS_NAV_LINK => ['', 'nav-link'],
        self::BS_PAGE_ITEM => ['', 'page-item'],
        self::BS_PAGE_LINK => ['', 'page-link'],
        self::BS_LIST_INLINE_ITEM => ['', 'list-inline-item'],
        self::BS_BTN_DEFAULT => ['btn-default', 'btn-secondary'],
        self::BS_IMG_RESPONSIVE => ['img-responsive', 'img-fluid'],
        self::BS_IMG_CIRCLE => ['img-circle', 'rounded-circle'],
        self::BS_IMG_ROUNDED => ['img-rounded', 'rounded'],
        self::BS_RADIO => ['radio', 'form-check'],
        self::BS_CHECKBOX => ['checkbox', 'form-check'],
        self::BS_INPUT_LG => ['input-lg', 'form-control-lg'],
        self::BS_INPUT_SM => ['input-sm', 'form-control-sm'],
        self::BS_CONTROL_LABEL => ['control-label', 'col-form-label'],
        self::BS_TABLE_CONDENSED => ['table-condensed', 'table-sm'],
        self::BS_CAROUSEL_ITEM => ['item', 'carousel-item'],
        self::BS_CAROUSEL_ITEM_NEXT => ['next', 'carousel-item-next'],
        self::BS_CAROUSEL_ITEM_PREV => ['prev', 'carousel-item-prev'],
        self::BS_CAROUSEL_ITEM_LEFT => ['left', 'carousel-item-left'],
        self::BS_CAROUSEL_ITEM_RIGHT => ['right', 'carousel-item-right'],
        self::BS_CAROUSEL_CONTROL_LEFT => [['carousel-control', 'left'], 'carousel-control-left'],
        self::BS_CAROUSEL_CONTROL_RIGHT => [['carousel-control', 'right'], 'carousel-control-right'],
        self::BS_HELP_BLOCK => ['help-block', 'form-text'],
        self::BS_PULL_RIGHT => ['pull-right', 'float-right', 'float-end'],
        self::BS_PULL_LEFT => ['pull-left', 'float-left', 'float-start'],
        self::BS_CENTER_BLOCK => ['center-block', ['mx-auto', 'd-block']],
        self::BS_HIDE => ['hide', 'd-none'],
        self::BS_HIDDEN_PRINT => ['hidden-print', 'd-print-none'],
        self::BS_HIDDEN_XS => ['hidden-xs', ['d-none', 'd-sm-block']],
        self::BS_HIDDEN_SM => ['hidden-sm', ['d-sm-none', 'd-md-block']],
        self::BS_HIDDEN_MD => ['hidden-md', ['d-md-none', 'd-lg-block']],
        self::BS_HIDDEN_LG => ['hidden-lg', ['d-lg-none', 'd-xl-block']],
        self::BS_VISIBLE_PRINT => ['visible-print-block', ['d-print-block', 'd-none']],
        self::BS_VISIBLE_XS => ['visible-xs', ['d-block', 'd-sm-none']],
        self::BS_VISIBLE_SM => ['visible-sm', ['d-none', 'd-sm-block', 'd-md-none']],
        self::BS_VISIBLE_MD => ['visible-md', ['d-none', 'd-md-block', 'd-lg-none']],
        self::BS_VISIBLE_LG => ['visible-md', ['d-none', 'd-lg-block', 'd-xl-none']],
        self::BS_FORM_CONTROL_STATIC => ['form-control-static', 'form-control-plaintext'],
        self::BS_DROPDOWN_DIVIDER => ['divider', 'dropdown-divider'],
        self::BS_SHOW => ['in', 'show'],
    ];

    /**
     * @var int|string the bootstrap library version that you wish to use for this specific extension / widget.
     *
     * - To use with bootstrap 3 - you can set this to any string starting with 3 (e.g. `3` or `3.3.7` or `3.x`)
     * - To use with bootstrap 4 - you can set this to any string starting with 4 (e.g. `4` or `4.6.0` or `4.x`)
     * - To use with bootstrap 5 - you can set this to any string starting with 5 (e.g. `5` or `5.1.0` or `5.x`)
     *
     * This property can be set up globally in Yii application params in your Yii2 application config file.
     *
     * For example:
     *
     * ```php
     * 'params' = [
     *     'bsVersion' => '5.x' // will enable Bootstrap 5.x globally
     * ]
     * ```
     *
     * Note that if this property is set as part of this extension class, then the extension setting will override the
     * `Yii::$app->params['bsVersion']`. This property will default to `3.x` (Bootstrap 3.x version) if it is not
     * set anywhere (extension or module or Yii params).
     */
    public $bsVersion;

    /**
     * @var array the bootstrap grid column css prefixes mapping, the key is the bootstrap versions, and the value is
     * an array containing the sizes and their corresponding grid column css prefixes. The class using this trait, must
     * implement BootstrapInterface. If not set will default to:
     *
     * ```php
     * [
     *     3 => [
     *         self::SIZE_X_SMALL => 'col-xs-',
     *         self::SIZE_SMALL => 'col-sm-',
     *         self::SIZE_MEDIUM => 'col-md-',
     *         self::SIZE_LARGE => 'col-lg-',
     *         self::SIZE_X_LARGE => 'col-lg-',
     *     ],
     *     4 => [
     *         self::SIZE_X_SMALL => 'col-',
     *         self::SIZE_SMALL => 'col-sm-',
     *         self::SIZE_MEDIUM => 'col-md-',
     *         self::SIZE_LARGE => 'col-lg-',
     *         self::SIZE_X_LARGE => 'col-xl-',
     *     ],
     *     5 => [
     *         self::SIZE_X_SMALL => 'col-',
     *         self::SIZE_SMALL => 'col-sm-',
     *         self::SIZE_MEDIUM => 'col-md-',
     *         self::SIZE_LARGE => 'col-lg-',
     *         self::SIZE_X_LARGE => 'col-xl-',
     *     ],
     * ];
     * ```
     */
    public $bsColCssPrefixes = [];

    /**
     * @var int current bootstrap version number
     */
    protected $_bsVer;

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
     *
     * This property is deprecated since v3.0.0 and replaced by the more flexible [[_bsVer]] flag.
     *
     * @deprecated since v3.0.0 and replaced by [[_bsVer]] flag
     */
    protected $_isBs4;

    /**
     * Initializes bootstrap versions for the widgets and asset bundles.
     *
     * Sets the [[_bsVer]] flag by parsing [[bsVersion]].
     *
     * @throws InvalidConfigException
     */
    protected function initBsVersion()
    {
        $ver = $this->configureBsVersion();
        $this->_defaultIconPrefix = 'glyphicon glyphicon-';
        $this->_defaultBtnCss = 'btn-default';
        $ext = $this->getBsExtBasename();
        if (!class_exists("yii\\{$ext}\\Alert")) {
            $message = "You must install 'yiisoft/yii2-{$ext}' extension for Bootstrap {$ver}.x version support. ".
                "Dependency to 'yii2-{$ext}' has not been included with 'yii2-krajee-base'. To resolve, you must add ".
                "'yiisoft/yii2-{$ext}' to the 'require' section of your application's composer.json file and then ".
                "run 'composer update'.\n\n".
                "NOTE: This dependency change has been done since v2.0 of 'yii2-krajee-base' because only one of ".
                "'yiisoft/yii2-bootstrap' OR 'yiisoft/yii2-bootstrap4' OR 'yiisoft/yii2-bootstrap5' extensions can ".
                "be installed. The developer can thus choose and control which bootstrap extension library to install.";
            throw new InvalidConfigException($message);
        }
        if ($this->getBsVer() > 3) {
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
                3 => [
                    self::SIZE_X_SMALL => 'col-xs-',
                    self::SIZE_SMALL => 'col-sm-',
                    self::SIZE_MEDIUM => 'col-md-',
                    self::SIZE_LARGE => 'col-lg-',
                    self::SIZE_X_LARGE => 'col-lg-',
                    self::SIZE_XX_LARGE => 'col-lg-',
                ],
                4 => [
                    self::SIZE_X_SMALL => 'col-',
                    self::SIZE_SMALL => 'col-sm-',
                    self::SIZE_MEDIUM => 'col-md-',
                    self::SIZE_LARGE => 'col-lg-',
                    self::SIZE_X_LARGE => 'col-xl-',
                    self::SIZE_XX_LARGE => 'col-xl-',
                ],
                5 => [
                    self::SIZE_X_SMALL => 'col-',
                    self::SIZE_SMALL => 'col-sm-',
                    self::SIZE_MEDIUM => 'col-md-',
                    self::SIZE_LARGE => 'col-lg-',
                    self::SIZE_X_LARGE => 'col-xl-',
                    self::SIZE_XX_LARGE => 'col-xxl-',
                ],
            ];
        }
    }

    /**
     * Configures the bootstrap version settings
     * @return int the bootstrap lib parsed version number (defaults to 3)
     * @throws Exception
     */
    protected function configureBsVersion()
    {
        $v = empty($this->bsVersion) ? ArrayHelper::getValue(Yii::$app->params, 'bsVersion', '3') :
            $this->bsVersion;
        $this->_bsVer = static::parseVer($v);

        return $this->_bsVer;
    }

    /**
     * The yii2-bootstrap extension base name.
     *
     * Based on the currently set bootstrap version (3, 4, or 5), returns one of `bootstrap`, `bootstrap4`
     * or `bootstrap5`.
     *
     * @return string
     * @throws Exception
     */
    protected function getBsExtBasename()
    {
        $ver = $this->getBsVer();

        return 'bootstrap'.($ver > 3 ? $ver : '');
    }

    /**
     * Validate Bootstrap version
     * @param  int  $ver
     * @return bool
     * @throws Exception
     */
    public function isBs($ver)
    {
        return $this->getBsVer() === $ver;
    }

    /**
     * Gets the current set bootstrap version number.
     *
     * @return int
     * @throws Exception
     */
    public function getBsVer()
    {
        if (empty($this->_bsVer)) {
            $this->configureBsVersion();
        }

        return $this->_bsVer;
    }

    /**
     * Validate if Bootstrap 4.x version.
     *
     * This property is deprecated since v3.0.0 and replaced by the [[isBs]] method.
     *
     * @deprecated since v3.0.0 and replaced by the [[isBs]] method
     *
     * @return bool
     * @throws Exception
     */
    public function isBs4()
    {
        return $this->isBs(4);
    }

    /**
     * Gets the respective bootstrap dropdown class name based on currently configured bootstrap version.
     *
     * @param  bool  $isBtn whether to get the Button Dropdown widget class
     * @return string
     * @throws InvalidConfigException
     */
    public function getDropdownClass($isBtn = false)
    {
        $ver = $this->getBsVer();
        $btn = $isBtn ? 'Button' : '';
        if ($ver == 3) {
            $class = "\\yii\\bootstrap\\{$btn}Dropdown";
            $repo = "yiisoft/yii2-bootstrap";
        } else {
            $class = "\\kartik\\bs{$ver}dropdown\\{$btn}Dropdown";
            $repo = "yii2-bootstrap{$ver}-dropdown";
        }
        if (!class_exists($class)) {
            Config::checkDependency($class, $repo, 'for enabling dropdown functionality.');
        }
        return $class;
    }

    /**
     * Gets the respective Bootstrap class based on currently configured bootstrap version.
     *
     * @var string $className
     * @throws InvalidConfigException
     */
    public function getBSClass($className)
    {
        $ver = $this->getBsVer();
        $bootstrap = 'bootstrap' . ($ver == 3 ? '' : $ver);
        $class = "\\yii\\{$bootstrap}\\{$className}";

        if (!class_exists($class)) {
            throw new InvalidConfigException("The Bootstrap class '{$class}' does not exist. " .
                "Ensure the 'yiisoft/yii2-{$bootstrap}' extension is installed on your application.");
        }
        return $class;
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
     * Gets bootstrap css class by parsing the bootstrap version for the specified BS CSS type.
     *
     * @param  string  $type  the bootstrap CSS class type
     * @param  bool  $asString  whether to return classes as a string separated by space
     * @return string
     * @throws Exception
     */
    public function getCssClass($type, $asString = true)
    {
        if (empty(static::$bsCssMap[$type])) {
            return '';
        }
        $config = static::$bsCssMap[$type];
        $ver = $this->getBsVer();
        $i = $ver - 3;
        if ($ver > 4 && !isset($config[$i])) {
            $i = 1;
        }
        $css = !empty($config[$i]) ? $config[$i] : '';

        return $asString && is_array($css) ? implode(' ', $css) : $css;
    }

    /**
     * Adds bootstrap CSS class to options by parsing the bootstrap version for the specified Bootstrap CSS type.
     *
     * @param  array  $options  the HTML attributes for the container element that will be modified
     * @param  string  $type  the bootstrap CSS class type
     * @return Widget|mixed current object instance that uses this trait
     * @throws Exception
     */
    public function addCssClass(&$options, $type)
    {
        $css = $this->getCssClass($type, false);
        if (!empty($css)) {
            Html::addCssClass($options, $css);
        }

        return $this;
    }

    /**
     * Removes bootstrap CSS class from options by parsing the bootstrap version for the specified Bootstrap CSS type.
     *
     * @param  array  $options  the HTML attributes for the container element that will be modified
     * @param  string  $type  the bootstrap CSS class type
     * @return Widget|mixed current object instance that uses this trait
     * @throws Exception
     */
    public function removeCssClass(&$options, $type)
    {
        $css = $this->getCssClass($type, false);
        if (!empty($css)) {
            Html::removeCssClass($options, $css);
        }

        return $this;
    }

    /**
     * Parses and returns the major BS version
     * @param  string  $ver
     * @return int
     */
    protected static function parseVer($ver)
    {
        $ver = Lib::substr(Lib::trim((string)$ver), 0, 1);

        return is_numeric($ver) ? (int)$ver : 3;
    }

    /**
     * Compares two versions and checks if they are of the same major BS version.
     *
     * @param  int|string  $ver1  first version
     * @param  int|string  $ver2  second version
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