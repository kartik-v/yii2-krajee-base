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
 * Global helper class for Krajee extensions
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Config
{
    const VENDOR_NAME = "kartik-v/";
    const NAMESPACE_PREFIX = "\\kartik\\";
    const DEFAULT_REASON = "for your selected functionality";

    /**
     * Validate a single extension dependency
     * @param string name the extension class name (without vendor namespace prefix)
     * @param string repo the extension package repository name (without vendor name prefix)
     * @param string reason a user friendly message for dependency validation failure
     * @throws InvalidConfigException if extension fails dependency validation
     */
    public static function checkDependency($name, $repo, $reason = self::DEFAULT_REASON) {
        if (empty($name)) {
            return;
        }
        $class = self::NAMESPACE_PREFIX . $name;
        if (!class_exists($class)) {
            throw new InvalidConfigException("The class '{$class}' was not found and is required {$reason}.\n\n".
                "Please ensure you have installed the '{$repo}' extension. To install you can run this console command from your application root:\n\n" .
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
            $name = '';
            $repo = '';
            $reason = self::DEFAULT_REASON;
            extract($extension);
            self::checkDependency($name, $repo, $reason);
        }
    }
    
}
