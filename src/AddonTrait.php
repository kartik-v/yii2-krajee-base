<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.2
 */

namespace kartik\base;

use Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * AddonTrait includes methods to render bootstrap styled addons based on the `addon` property in classes that
 * use this trait.
 *
 * @property array $addon
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
trait AddonTrait
{
    /**
     * @var array addon to prepend or append to the widget (based on bootstrap input group styling).
     *
     * - `prepend`: _array_|_string_, the prepend addon configuration. If set as a string will be rendered as is. If set
     *   as an array, the following properties can be set:
     *    - `content`: _string_, the prepend addon content.
     *    - `asButton`: _boolean`, whether the addon is a button or button group. Defaults to `false`.
     * - `append`: _array_|_string_, the append addon configuration. If set as a string will be rendered as is. If set
     *   as an array, the following properties can be set:
     *    - `content`: _string_, the append addon content.
     *    - `asButton`: _boolean`, whether the addon is a button or button group. Defaults to `false`.
     * - `preCaption `: _array_|_string_, the addon content placed before the caption. Note that this property is
     *    applicable for [[Html5Input]] widget only. If set as a _string_, will be rendered as a raw markup without HTML
     *    encoding. If set as an _array_, the following options can be set:
     *   - `content `: _string_, the append addon content
     *   - `asButton `: _boolean_, whether the addon is a button
     *   - `options `: _array the HTML attributes for the append addon
     * - `contentBefore`: _string_, content placed before the addon
     * - `contentAfter`: _string_, content placed after the addon
     * - `groupOptions`: _array_, HTML options for the input group
     */
    public $addon = [];

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
