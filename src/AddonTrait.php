<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   3.0.1
 */

namespace kartik\base;

use Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * AddonTrait includes methods to render bootstrap styled addons based on `addon` setting
 *
 * @property array $addon
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
trait AddonTrait
{
    /**
     * Parses and returns addon content.
     *
     * @param  string  $type  the addon type `prepend` or `append`. If any other value is set, it will default to `prepend`
     * @param  int|null  $bsVer  bootstrap version
     * @return string
     * @throws Exception
     */
    protected function getAddonContent($type, $bsVer = null)
    {
        $addon = ArrayHelper::getValue($this->addon, $type, '');
        if (empty($bsVer) && method_exists($this, 'getBsVer')) {
            $bsVer = $this->getBsVer();
        }
        if (!is_array($addon)) {
            return $addon;
        }
        if (isset($addon['content'])) {
            $out = static::renderAddonItem($addon, $bsVer);
        } else {
            $out = '';
            foreach ($addon as $item) {
                if (is_array($item) && isset($item['content'])) {
                    $out .= static::renderAddonItem($item, $bsVer);
                }
            }
        }
        if ($bsVer != 4) {
            return $out;
        }
        $pos = $type === 'append' ? 'append' : 'prepend';

        return Html::tag('div', $out, ['class' => "input-group-{$pos}"]);
    }

    /**
     * Renders an addon item based on its configuration
     *
     * @param  array  $config  the addon item configuration
     * @param  int|null  $bsVer  bootstrap version
     * @return string
     * @throws Exception
     */
    protected static function renderAddonItem($config, $bsVer = null)
    {
        $content = ArrayHelper::getValue($config, 'content', '');
        $options = ArrayHelper::getValue($config, 'options', []);
        $asButton = ArrayHelper::getValue($config, 'asButton', false);
        if ($bsVer === 3) {
            Html::addCssClass($options, 'input-group-'.($asButton ? 'btn' : 'addon'));

            return Html::tag('span', $content, $options);
        }
        if ($asButton) {
            return $content;
        }
        Html::addCssClass($options, 'input-group-text');

        return Html::tag('span', $content, $options);
    }
}
