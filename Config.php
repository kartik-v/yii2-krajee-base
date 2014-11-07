<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-krajee-base
 * @version 1.0.0
 */

namespace kartik\base;

use Yii;
use yii\base\InvalidConfigException;

/**
 * Global configuration helper class for Krajee extensions
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Config
{
    const VENDOR_NAME = "kartik-v/";
    const NAMESPACE_PREFIX = "\\kartik\\";
    const DEFAULT_REASON = "for your selected functionality";

    protected static $_validInputWidgets = [
        '\kartik\widgets\Select2' => 'yii2-widgets',
        '\kartik\widgets\Typeahead' => 'yii2-widgets',
        '\kartik\widgets\SwitchInput' => 'yii2-widgets',
        '\kartik\widgets\StarRating' => 'yii2-widgets',
        '\kartik\widgets\RangeInput' => 'yii2-widgets',
        '\kartik\widgets\ColorInput' => 'yii2-widgets',
        '\kartik\widgets\DatePicker' => 'yii2-widgets',
        '\kartik\widgets\TimePicker' => 'yii2-widgets',
        '\kartik\widgets\DateTimePicker' => 'yii2-widgets',
        '\kartik\daterange\DateRangePicker' => 'yii2-daterange',
        '\kartik\sortinput\SortableInput' => 'yii2-sortinput',
        '\kartik\money\MaskMoney' => 'yii2-money',
        '\kartik\checkbox\CheckboxX' => 'yii2-checkbox',
    ];
    
    /**
     * Validate a single extension dependency
     * @param string name the extension class name (without vendor namespace prefix)
     * @param string repo the extension package repository name (without vendor name prefix)
     * @param string reason a user friendly message for dependency validation failure
     * @throws InvalidConfigException if extension fails dependency validation
     */
    public static function checkDependency($name = '', $repo = '', $reason = self::DEFAULT_REASON) {
        if (empty($name)) {
            return;
        }
        $class = (substr($name, 0, 8) == self::NAMESPACE_PREFIX) ? $name : self::NAMESPACE_PREFIX . $name;
        if (!class_exists($class)) {
            throw new InvalidConfigException("The class '{$class}' was not found and is required {$reason}.\n\n".
                "Please ensure you have installed the '{$repo}' extension. " . 
                "To install, you can run this console command from your application root:\n\n" .
                "php composer.phar require " . self::VENDOR_NAME . $repo . ": \"@dev\" \n");
        }
    }

    /**
     * Validate multiple extension dependencies
     * @param array extensions the configuration of extensions with each array 
     * item setup as required in `checkDependency` method. The following keys
     * can be setup:
     * - name: string, the extension class name (without vendor namespace prefix)
     * - repo: string,  the extension package repository name (without vendor name prefix)
     * - reason: string,  a user friendly message for dependency validation failure
     * @throws InvalidConfigException if extension fails dependency validation
     */
    public static function checkDependencies($extensions = []) {
        foreach ($extensions as $extension) {
            $name = empty($extension[0]) ? '' : $extension[0];
            $repo = empty($extension[1]) ? '' : $extension[1];
            $reason = empty($extension[2]) ? '' :self::DEFAULT_REASON;
            self::checkDependency($name, $repo, $reason);
        }
    }
    
    /**
     * Gets list of namespaced Krajee input widget classes as an associative
     * array, where the array keys are the namespaced classes, and the array
     * values are the names of the github repository to which these classes
     * belong to.
     * @returns array
     */
    public static function getInputWidgets() {
        return self::$_validInputWidgets;
    }
   
    /**
     * Check if a namespaced widget is valid input widget
     * @returns boolean
     */
    public static function isInputWidgetValid($type) {
        return isset(self::$_validInputWidgets[$type]);
    }
    
    /**
     * Check if a namespaced widget is valid or installed.
     * @throws InvalidConfigException
     */
    public static function validateInputWidget($type, $reason = self::DEFAULT_REASON) {
        if (self::isInputWidgetValid($type)) {
            self::checkDependency($type, self::$_validInputWidgets[$type], $reason);
        }
    }
}
