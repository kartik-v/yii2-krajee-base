<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.5
 */

namespace kartik\base;

use yii\base\InvalidConfigException;
use yii\base\Widget as YiiWidget;

/**
 * Widget is the base class for widgets extending [[YiiWidget]] used in Krajee extensions.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
class Widget extends YiiWidget implements BootstrapInterface
{
    use TranslationTrait;
    use WidgetTrait;
    use BootstrapTrait;

    /**
     * @var array HTML attributes or other settings for widgets.
     */
    public $options = [];

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        $this->initBsVersion();
        parent::init();
        $this->mergeDefaultOptions();
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->initDestroyJs();
    }
}
