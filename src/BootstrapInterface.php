<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2022
 * @version   3.0.4
 */

namespace kartik\base;

/**
 * BootstrapInterface includes all Bootstrap library specific constants implemented by all Krajee extension
 * classes. These constants are used in configuration of Bootstrap version specific configurations as set via
 * [[BootstrapTrait::$bsCssMap]].
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
interface BootstrapInterface
{
    /**
     * bootstrap **extra small** size modifier - **deprecated** - use [[SIZE_X_SMALL]] instead
     */
    const SIZE_TINY = 'xs';

    /**
     * bootstrap **extra small** size modifier
     */
    const SIZE_X_SMALL = 'xs';

    /**
     * bootstrap **small** size modifier
     */
    const SIZE_SMALL = 'sm';

    /**
     * bootstrap **medium** size modifier (this is the default size)
     */
    const SIZE_MEDIUM = 'md';

    /**
     * bootstrap **large** size modifier
     */
    const SIZE_LARGE = 'lg';

    /**
     * bootstrap **extra large** size modifier
     */
    const SIZE_X_LARGE = 'xl';

    /**
     * bootstrap **extra extra large** size modifier
     */
    const SIZE_XX_LARGE = 'xxl';

    /**
     * Bootstrap panel
     */
    const BS_SR_ONLY = 'sr-only';

    /**
     * Bootstrap panel
     */
    const BS_PANEL = 'panel';

    /**
     * Bootstrap panel heading
     */
    const BS_PANEL_HEADING = 'panel-heading';

    /**
     * Bootstrap panel title
     */
    const BS_PANEL_TITLE = 'panel-title';

    /**
     * Bootstrap panel body
     */
    const BS_PANEL_BODY = 'panel-body';

    /**
     * Bootstrap panel footer
     */
    const BS_PANEL_FOOTER = 'panel-footer';

    /**
     * Bootstrap panel default contextual color
     */
    const BS_PANEL_DARK = 'panel-dark';

    /**
     * Bootstrap panel default contextual color
     */
    const BS_PANEL_DEFAULT = 'panel-default';

    /**
     * Bootstrap panel secondary contextual color
     */
    const BS_PANEL_SECONDARY = 'panel-secondary';

    /**
     * Bootstrap panel primary contextual color
     */
    const BS_PANEL_PRIMARY = 'panel-primary';

    /**
     * Bootstrap panel success contextual color
     */
    const BS_PANEL_SUCCESS = 'panel-success';

    /**
     * Bootstrap panel info contextual color
     */
    const BS_PANEL_INFO = 'panel-info';

    /**
     * Bootstrap panel warning contextual color
     */
    const BS_PANEL_WARNING = 'panel-warning';

    /**
     * Bootstrap panel danger contextual color
     */
    const BS_PANEL_DANGER = 'panel-danger';

    /**
     * Bootstrap badge style
     */
    const BS_BADGE = 'badge';

    /**
     * Bootstrap label
     */
    const BS_LABEL = 'label';

    /**
     * Bootstrap label default contextual color
     */
    const BS_LABEL_LIGHT = 'label-light';

    /**
     * Bootstrap label default contextual color
     */
    const BS_LABEL_DARK = 'label-dark';

    /**
     * Bootstrap label default contextual color
     */
    const BS_LABEL_DEFAULT = 'label-default';

    /**
     * Bootstrap label primary contextual color
     */
    const BS_LABEL_PRIMARY = 'label-primary';

    /**
     * Bootstrap label success contextual color
     */
    const BS_LABEL_SUCCESS = 'label-success';

    /**
     * Bootstrap label info contextual color
     */
    const BS_LABEL_INFO = 'label-info';

    /**
     * Bootstrap label warning contextual color
     */
    const BS_LABEL_WARNING = 'label-warning';

    /**
     * Bootstrap label danger contextual color
     */
    const BS_LABEL_DANGER = 'label-danger';

    /**
     * Bootstrap table default contextual color
     */
    const BS_TABLE_ACTIVE = 'table-active';

    /**
     * Bootstrap table primary contextual color
     */
    const BS_TABLE_PRIMARY = 'table-primary';

    /**
     * Bootstrap table success contextual color
     */
    const BS_TABLE_SUCCESS = 'table-success';

    /**
     * Bootstrap table info contextual color
     */
    const BS_TABLE_INFO = 'table-info';

    /**
     * Bootstrap table warning contextual color
     */
    const BS_TABLE_WARNING = 'table-warning';

    /**
     * Bootstrap table danger contextual color
     */
    const BS_TABLE_DANGER = 'table-danger';

    /**
     * Bootstrap progress-bar active animated state
     */
    const BS_PROGRESS_BAR_ACTIVE = 'progress-bar-active';

    /**
     * Bootstrap progress-bar primary contextual color
     */
    const BS_PROGRESS_BAR_PRIMARY = 'progress-bar-primary';

    /**
     * Bootstrap progress-bar success contextual color
     */
    const BS_PROGRESS_BAR_SUCCESS = 'progress-bar-success';

    /**
     * Bootstrap progress-bar info contextual color
     */
    const BS_PROGRESS_BAR_INFO = 'progress-bar-info';

    /**
     * Bootstrap progress-bar warning contextual color
     */
    const BS_PROGRESS_BAR_WARNING = 'progress-bar-warning';

    /**
     * Bootstrap progress-bar danger contextual color
     */
    const BS_PROGRESS_BAR_DANGER = 'progress-bar-danger';

    /**
     * Bootstrap well style
     */
    const BS_WELL = 'well';

    /**
     * Bootstrap well large style
     */
    const BS_WELL_LG = 'well-lg';

    /**
     * Bootstrap well small style
     */
    const BS_WELL_SM = 'well-sm';

    /**
     * Bootstrap well small style
     */
    const BS_THUMBNAIL = 'thumbnail';

    /**
     * Bootstrap navbar right style
     */
    const BS_NAVBAR_DEFAULT = 'navbar-default';

    /**
     * Bootstrap navbar toggle style
     */
    const BS_NAVBAR_TOGGLE = 'navbar-toggle';

    /**
     * Bootstrap navbar right style
     */
    const BS_NAVBAR_RIGHT = 'navbar-right';

    /**
     * Bootstrap navbar button style
     */
    const BS_NAVBAR_BTN = 'navbar-btn';

    /**
     * Bootstrap navbar fixed top style
     */
    const BS_NAVBAR_FIXTOP = 'navbar-fixed-top';

    /**
     * Bootstrap NAV stacked style
     */
    const BS_NAV_STACKED = 'nav-stacked';

    /**
     * Bootstrap NAV item style
     */
    const BS_NAV_ITEM = 'nav-item';

    /**
     * Bootstrap NAV link style
     */
    const BS_NAV_LINK = 'nav-link';

    /**
     * Bootstrap page item style
     */
    const BS_PAGE_ITEM = 'page-item';

    /**
     * Bootstrap page link style
     */
    const BS_PAGE_LINK = 'page-link';

    /**
     * Bootstrap list inline item style
     */
    const BS_LIST_INLINE_ITEM = 'list-inline-item';

    /**
     * Bootstrap default button style
     */
    const BS_BTN_DEFAULT = 'btn-default';

    /**
     * Bootstrap image responsive style
     */
    const BS_IMG_RESPONSIVE = 'img-responsive';

    /**
     * Bootstrap image circle style
     */
    const BS_IMG_CIRCLE = 'img-circle';

    /**
     * Bootstrap image rounded style
     */
    const BS_IMG_ROUNDED = 'img-rounded';

    /**
     * Bootstrap radio style
     */
    const BS_RADIO = 'radio';

    /**
     * Bootstrap checkbox style
     */
    const BS_CHECKBOX = 'checkbox';

    /**
     * Bootstrap large input style
     */
    const BS_INPUT_LG = 'input-lg';

    /**
     * Bootstrap small input style
     */
    const BS_INPUT_SM = 'input-sm';

    /**
     * Bootstrap label control style
     */
    const BS_CONTROL_LABEL = 'control-label';

    /**
     * Bootstrap condensed table style
     */
    const BS_TABLE_CONDENSED = 'table-condensed';

    /**
     * Bootstrap carousel item style
     */
    const BS_CAROUSEL_ITEM = 'carousel-item';

    /**
     * Bootstrap carousel item next style
     */
    const BS_CAROUSEL_ITEM_NEXT = 'carousel-item-next';

    /**
     * Bootstrap carousel item previous style
     */
    const BS_CAROUSEL_ITEM_PREV = 'carousel-item-prev';

    /**
     * Bootstrap carousel item left style
     */
    const BS_CAROUSEL_ITEM_LEFT = 'carousel-item-left';

    /**
     * Bootstrap carousel item right style
     */
    const BS_CAROUSEL_ITEM_RIGHT = 'carousel-item-right';

    /**
     * Bootstrap carousel control left style
     */
    const BS_CAROUSEL_CONTROL_LEFT = 'carousel-control-left';

    /**
     * Bootstrap carousel control right style
     */
    const BS_CAROUSEL_CONTROL_RIGHT = 'carousel-control-right';

    /**
     * Bootstrap help block style
     */
    const BS_HELP_BLOCK = 'form-text';

    /**
     * Bootstrap pull right style
     */
    const BS_PULL_RIGHT = 'pull-right';

    /**
     * Bootstrap pull left style
     */
    const BS_PULL_LEFT = 'pull-left';

    /**
     * Bootstrap center block style
     */
    const BS_CENTER_BLOCK = 'center-block';

    /**
     * Bootstrap hide print style
     */
    const BS_HIDE = 'hide';

    /**
     * Bootstrap hidden print style
     */
    const BS_HIDDEN_PRINT = 'hidden-print';

    /**
     * Bootstrap hidden extra small style
     */
    const BS_HIDDEN_XS = 'hidden-xs';

    /**
     * Bootstrap hidden small style
     */
    const BS_HIDDEN_SM = 'hidden-sm';

    /**
     * Bootstrap hidden medium style
     */
    const BS_HIDDEN_MD = 'hidden-md';

    /**
     * Bootstrap hidden large style
     */
    const BS_HIDDEN_LG = 'hidden-lg';

    /**
     * Bootstrap hidden print block style
     */
    const BS_VISIBLE_PRINT = 'visible-print-block';

    /**
     * Bootstrap visible extra small style
     */
    const BS_VISIBLE_XS = 'visible-xs';

    /**
     * Bootstrap visible small style
     */
    const BS_VISIBLE_SM = 'visible-sm';

    /**
     * Bootstrap visible medium style
     */
    const BS_VISIBLE_MD = 'visible-md';

    /**
     * Bootstrap visible large style
     */
    const BS_VISIBLE_LG = 'visible-lg';

    /**
     * Bootstrap form control static style
     */
    const BS_FORM_CONTROL_STATIC = 'form-control-static';

    /**
     * Bootstrap dropdown divider style
     */
    const BS_DROPDOWN_DIVIDER = 'dropdown-divider';

    /**
     * Bootstrap show style
     */
    const BS_SHOW = 'show';
}