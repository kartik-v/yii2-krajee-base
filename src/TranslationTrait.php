<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.2
 */

namespace kartik\base;

use ReflectionClass;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * TranslationTrait manages methods for all translations used in Krajee extensions
 *
 * @property array $i18n
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.9.2
 */
trait TranslationTrait
{
    /**
     * Yii i18n messages configuration for generating translations
     *
     * @param string $dir the directory path where translation files will exist
     * @param string $cat the message category
     *
     * @throws \ReflectionException
     */
    public function initI18N($dir = '', $cat = '')
    {
        if (empty($cat) && empty($this->_msgCat)) {
            return;
        }
        if (empty($cat)) {
            $cat = $this->_msgCat;
        }
        if (empty($dir)) {
            $class = get_class($this);
            $reflector = new ReflectionClass($class);
            $dir = dirname($reflector->getFileName());
        }
        Yii::setAlias("@{$cat}", $dir);
        $config = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@{$cat}/messages",
            'forceTranslation' => true,
        ];
        $globalConfig = ArrayHelper::getValue(Yii::$app->i18n->translations, "{$cat}*", []);
        if (!empty($globalConfig)) {
            $config = array_merge($config, is_array($globalConfig) ? $globalConfig : (array)$globalConfig);
        }
        if (!empty($this->i18n) && is_array($this->i18n)) {
            $config = array_merge($config, $this->i18n);
        }
        Yii::$app->i18n->translations["{$cat}*"] = $config;
    }
}
