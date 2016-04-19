/*!
 * @package    yii2-krajee-base
 * @subpackage yii2-widget-activeform
 * @author     Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright  Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @version    1.8.5
 *
 * Common script file for all kartik\widgets.
 *
 * For more JQuery/Bootstrap plugins and demos visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */
(function ($) {
    "use strict";
    /**
     * Krajee's selector string fetcher. Gets the selector from a jQuery object based on the following logic:
     * - if an `id` attribute if available the selector is returned based on the id attribute,
     * - else if a data attribute `kvId` exists the selector is returned based on this data attribute,
     * - else a unique data attribute `kvId` is generated and the selector is returned based on this data attribute.
     */
    $.fn.kvSelector = function () {
        var $node = $(this), id, sel = '';
        if (!$node.length) {
            return '';
        }
        id = $node.attr('id');
        if (id) {
            return '#' + id;
        }
        id = $node.attr('data-kv-id');
        if (id) {
            return '[data-kv-id="' + id + '"]';
        }
        do {
            id = 'kv-' + Math.round(new Date().getTime() + (Math.random() * 100));
            sel = '[data-kv-id="' + id + '"]';
        } while ($(sel).length);
        $node.attr('data-kv-id', id);
        return sel;
    };
})(window.jQuery);