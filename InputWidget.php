<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-krajee-base
 * @version 1.6.0
 */

namespace kartik\base;

use Yii;
use yii\helpers\FormatConverter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Base input widget class for yii2-widgets
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class InputWidget extends \yii\widgets\InputWidget
{
    const LOAD_PROGRESS = '<div class="kv-plugin-loading">&nbsp;</div>';

    /**
     * @var string the language configuration (e.g. 'fr-FR', 'zh-CN'). The format for the language/locale is 
     * ll-CC where ll is a two or three letter lowercase code for a language according to ISO-639 and 
     * CC is the country code according to ISO-3166.
     * If this property not set, then the current application language will be used.
     */
    public $language;
    
    /**
     * @var boolean whether input is to be disabled
     */
    public $disabled = false;
    
    /**
     * @var boolean whether input is to be readonly
     */
    public $readonly = false;

    /**
     * @var mixed show loading indicator while plugin loads
     */
    public $pluginLoading = true;

    /**
     * @var array the data (for list inputs)
     */
    public $data = [];

    /**
     * @var string the name of the jQuery plugin
     */
    public $pluginName = '';
    
    /**
     * @var array widget plugin options
     */
    public $pluginOptions = [];

    /**
     * @var array widget JQuery events. You must define events in
     * event-name => event-function format
     * for example:
     * ~~~
     * pluginEvents = [
     *        "change" => "function() { log("change"); }",
     *        "open" => "function() { log("open"); }",
     * ];
     * ~~~
     */
    public $pluginEvents = [];

    /**
     * @var boolean whether the widget should automatically format the date from
     * the PHP DateTime format to the javascript/jquery plugin format
     * @see http://php.net/manual/en/function.date.php
     */
    public $convertFormat = false;

    /**
     * @var string the hashed variable to store the pluginOptions
     */
    protected $_dataVar;
    
    /**
     * @var string the hashed variable to store the pluginOptions
     */
    protected $_hashVar;

    /**
     * @var string the Json encoded options
     */
    protected $_encOptions = '';

    /**
     * @var string the indicator for loading
     */
    protected $_loadIndicator = '';

    /**
     * @var string the two or three letter lowercase code 
     * for the language according to ISO-639
     */
    protected $_lang = '';

    /**
     * @var string the language js file
     */
    protected $_langFile = '';
    

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if (!isset($this->language)) {
            $this->language = Yii::$app->language;
        }
        $this->_lang = Config::getLang($this->language);
        if ($this->pluginLoading) {
            $this->_loadIndicator = self::LOAD_PROGRESS;
        }
        if ($this->hasModel()) {
            $this->name = empty($this->options['name']) ? Html::getInputName($this->model,
                $this->attribute) : $this->options['name'];
            $this->value = $this->model[Html::getAttributeName($this->attribute)];
        }
        $this->initDisability($this->options);
        $view = $this->getView();
        WidgetAsset::register($view);
    }

    /**
     * Sets HTML5 data variable
     * @param string $name the plugin name
     */
    protected function setDataVar($name) {
        $this->_dataVar = "data-krajee-{$name}";
    }
    
    /**
     * Initialize the plugin language
     *
     * @param string $property the name of language property in [[pluginOptions]].
     * @param boolean $full whether to use the full language string. Defaults to `false` 
     * which is the 2 (or 3) digit ISO-639 format.
     * Defaults to 'language'.
     */
    protected function initLanguage($property = 'language', $full = false)
    {
        if (empty($this->pluginOptions[$property]) && $this->_lang != 'en') {
            $this->pluginOptions[$property] = $full ? $this->language : $this->_lang;
        }
    }
    /**
     * Sets the language JS file if it exists
     * @param string $assetPath the path to the assets
     * @param string $filePath the path to the JS file with the file name prefix
     * @param string $suffix the file name suffix - defaults to '.js'
     */
    protected function setLanguage($prefix, $assetPath = null, $filePath = null, $suffix = '.js') {
        $pwd = Config::getCurrentDir($this);
        $s = DIRECTORY_SEPARATOR;
        if ($assetPath === null) {
            $assetPath = "{$pwd}/assets/";
        } elseif (substr($assetPath, -1) != '/') {
            $assetPath = substr($assetPath, 0, -1);
        }
        if ($filePath === null) {
            $filePath = "js/locales/";
        } elseif (substr($filePath, -1) != '/') {
            $filePath = substr($filePath, 0, -1);
        }
        $full = $filePath . $prefix . $this->language . $suffix;
        $fullLower = $filePath . $prefix . strtolower($this->language) . $suffix;
        $short = $filePath . $prefix . $this->_lang . $suffix;
        if (Config::fileExists($assetPath . $full)) {
            $this->_langFile = $full;
            $this->pluginOptions['language'] = $this->language;
        } elseif (Config::fileExists($assetPath . $fullLower)) {
            $this->_langFile = $fullLower;
            $this->pluginOptions['language'] = strtolower($this->language);
        }  elseif (Config::fileExists($assetPath . $short)) {
            $this->_langFile = $short;
            $this->pluginOptions['language'] = $this->_lang;
        } else {
            $this->_langFile = '';
        }
    }
    
    /**
     * Adds an asset to the view
     *
     * @param View $view The View object
     * @param string $file The asset file name
     * @param string $type The asset file type (css or js)
     * @param string $class The class name of the AssetBundle
     */
    protected function addAsset($view, $file, $type, $class)
    {
        if ($type == 'css' || $type == 'js') {
            $asset = $view->getAssetManager();
            $bundle = $asset->bundles[$class];
            if ($type == 'css') {
                $bundle->css[] = $file;
            } else {
                $bundle->js[] = $file;
            }
            $asset->bundles[$class] = $bundle;
            $view->setAssetManager($asset);
        }
    }

    /**
     * Generates an input
     */
    protected function getInput($type, $list = false)
    {
        if ($this->hasModel()) {
            $input = 'active' . ucfirst($type);
            return $list ?
                Html::$input($this->model, $this->attribute, $this->data, $this->options) :
                Html::$input($this->model, $this->attribute, $this->options);
        }
        $input = $type;
        $checked = false;
        if ($type == 'radio' || $type == 'checkbox') {
            $this->options['value'] = $this->value;
            $checked = ArrayHelper::remove($this->options, 'checked', '');
            if (empty($checked) && !empty($this->value)) {
                $checked = ($this->value == 0) ? false : true;
            } elseif (empty($checked)) {
                $checked = false;
            }
        }
        return $list ?
            Html::$input($this->name, $this->value, $this->data, $this->options) :
            (($type == 'checkbox' || $type == 'radio') ?
                Html::$input($this->name, $checked, $this->options) :
                Html::$input($this->name, $this->value, $this->options));
    }

    /**
     * Generates a hashed variable to store the pluginOptions. The following special data attributes
     * will also be setup for the input widget, that can be accessed through javascript :
     * - 'data-krajee-{name}' will store the hashed variable storing the plugin options. The {name}
     *   tag will represent the plugin name (e.g. select2, typeahead etc.) - Fixes issue #6.
     * @param string $name the name of the plugin
     */
    protected function hashPluginOptions($name)
    {
        $this->_encOptions = empty($this->pluginOptions) ? '' : Json::encode($this->pluginOptions);
        $this->_hashVar = $name . '_' . hash('crc32', $this->_encOptions);
        $this->options['data-krajee-' . $name] = $this->_hashVar;
    }

    /**
     * Registers plugin options by storing it in a hashed javascript variable
     */
    protected function registerPluginOptions($name)
    {
        $view = $this->getView();
        $this->hashPluginOptions($name);
        $encOptions = empty($this->_encOptions) ? '{}' : $this->_encOptions;
        $view->registerJs("var {$this->_hashVar} = {$encOptions};\n", View::POS_HEAD);
    }

    /**
     * Registers a specific plugin and the related events
     *
     * @param string $name the name of the plugin
     * @param string $element the plugin target element
     * @param string $callback the javascript callback function to be called after plugin loads
     * @param string $callbackCon the javascript callback function to be passed to the plugin constructor
     */
    protected function registerPlugin($name, $element = null, $callback = null, $callbackCon = null)
    {
        $script = $this->getPluginScript($name, $element, $callback, $callbackCon);
        if (!empty($script)) {
            $view = $this->getView();
            $view->registerJs($script);
        }
    }

    /**
     * Returns the plugin registration script
     *
     * @param string $name the name of the plugin
     * @param string $element the plugin target element
     * @param string $callback the javascript callback function to be called after plugin loads
     * @param string $callbackCon the javascript callback function to be passed to the plugin constructor
     * @return the generated plugin script
     */
    protected function getPluginScript($name, $element = null, $callback = null, $callbackCon = null) {
        $id = $element == null ? "jQuery('#" . $this->options['id'] . "')" : $element;
        $script = '';
        if ($this->pluginOptions !== false) {
            $this->registerPluginOptions($name, View::POS_HEAD);
            $script = "{$id}.{$name}({$this->_hashVar})";
            if ($callbackCon != null) {
                $script = "{$id}.{$name}({$this->_hashVar}, {$callbackCon})";
            }
            if ($callback != null) {
                $script = "jQuery.when({$script}).done({$callback})";
            }
            $script .= ";\n";
        }
        if (!empty($this->pluginEvents)) {
            $js = [];
            foreach ($this->pluginEvents as $event => $handler) {
                $function = new JsExpression($handler);
                $js[] = "{$id}.on('{$event}', {$function});";
            }
            $script .= implode("\n", $js) . "\n";
        }
        return $script;
    }

    /**
     * Validates and sets disabled or readonly inputs
     * @param array $options the HTML attributes for the input
     */
    protected function initDisability(&$options)
    {
        if ($this->disabled && !isset($options['disabled'])) {
            $options['disabled'] = true;
        }
        if ($this->readonly && !isset($options['readonly'])) {
            $options['readonly'] = true;
        }
    }
    
    /**
     * Automatically convert the date format from PHP DateTime to Javascript DateTime format
     *
     * @see http://php.net/manual/en/function.date.php
     * @see http://bootstrap-datetimepicker.readthedocs.org/en/release/options.html#format
     * @param string $format the PHP date format string
     * @return string
     */
    protected static function convertDateFormat($format)
    {
        
        return strtr($format, [
            // meridian lowercase
            'a' => 'p',
            // meridian uppercase
            'A' => 'P',
            // second (with leading zeros)
            's' => 'ss',
            // minute (with leading zeros)
            'i' => 'ii',
            // hour in 12-hour format (no leading zeros)
            'g' => 'H',
            // hour in 24-hour format (no leading zeros)
            'G' => 'h',
            // hour in 12-hour format (with leading zeros)
            'h' => 'HH',
            // hour in 24-hour format (with leading zeros)
            'H' => 'hh',
            // day of month (no leading zero)
            'j' => 'd',
            // day of month (two digit)
            'd' => 'dd',
            // day name short is always 'D'
            // day name long
            'l' => 'DD',
            // month of year (no leading zero)
            'n' => 'm',
            // month of year (two digit)
            'm' => 'mm',
            // month name short is always 'M'
            // month name long
            'F' => 'MM',
            // year (two digit)
            'y' => 'yy',
            // year (four digit)
            'Y' => 'yyyy',
        ]);
    }

    /**
     * Parses date format based on attribute type using yii\helpers\FormatConverter
     * Used only within DatePicker and DateTimePicker.
     *
     * @param string $type the attribute type whether date, datetime, or time
     * @return mixed|string
     * @throws InvalidConfigException
     */
    protected function parseDateFormat($type)
    {
        if (!$this->convertFormat) {
            return;
        }
        if (isset($this->pluginOptions['format'])) {
            $format = $this->pluginOptions['format'];
            $format = strncmp($format, 'php:', 4) === 0 ?  substr($format, 4) : FormatConverter::convertDateIcuToPhp($format, $type);
            $this->pluginOptions['format'] = static::convertDateFormat($format);
            return;
        }
        $attrib = $type . 'Format';
        $format = isset(Yii::$app->formatter->$attrib) ? Yii::$app->formatter->$attrib : '';
        if (isset($this->dateFormat) && strncmp($this->dateFormat, 'php:', 4) === 0) {
            $this->pluginOptions['format'] = static::convertDateFormat(substr($format, 4));
        } elseif ($format != '') {
            $format = FormatConverter::convertDateIcuToPhp($format, $type);
            $this->pluginOptions['format'] = static::convertDateFormat($format);
        } else {
            throw InvalidConfigException("Error parsing '{$type}' format.");
        }
    }
}