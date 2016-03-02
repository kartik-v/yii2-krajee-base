<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @version   1.8.2
 */

namespace kartik\base;

use Yii;

/**
 * Trait for all translations used in Krajee extensions
 *
 * @property array $i18n
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.8.2
 */
trait TranslationTrait
{
    /**
     * Yii i18n messages configuration for generating translations
     *
     * @param string $dir the directory path where translation files will exist
     * @param string $cat the message category
     *
     * @return void
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
            $reflector = new \ReflectionClass(get_class($this));
            $dir = dirname($reflector->getFileName());
        }
        Yii::setAlias("@{$cat}", $dir);

        $default_config = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => "@{$cat}/messages",
            'forceTranslation' => true
        ];

        $global_config = isset(Yii::$app->i18n->translations["{$cat}*"])
            ? Yii::$app->i18n->translations["{$cat}*"]
            : [];

        $inline_config = is_array($this->i18n) ? $this->i18n : [];

        Yii::$app->i18n->translations["{$cat}*"] = array_merge(
            $default_config, $global_config, $inline_config
        );
    }
}
