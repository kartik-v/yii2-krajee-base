<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @version   1.7.8
 */

namespace kartik\base;

use Yii;

/**
 * Trait for all translations used in Krajee extensions
 *
 * @property array $i18n
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.7.8
 */
trait TranslationTrait
{
    /**
     * Yii i18n messages configuration for generating translations
     *
     * @param string $dir the directory path where translation files will exist
     *
     * @return void
     */
    public function initI18N($dir = '')
    {
        if (empty($this->_msgCat)) {
            return;
        }
        if (empty($dir)) {
            $reflector = new \ReflectionClass(get_class($this));
            $dir = dirname($reflector->getFileName());
        }
        Yii::setAlias("@{$this->_msgCat}", $dir);
        if (empty($this->i18n)) {
            $this->i18n = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => "@{$this->_msgCat}/messages",
                'forceTranslation' => true
            ];
        }
        Yii::$app->i18n->translations[$this->_msgCat . '*'] = $this->i18n;
    }
}
