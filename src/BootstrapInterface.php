<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.6
 */

namespace kartik\base;

/**
 * BootstrapInterface includes bootstrap constants and any common method signatures
 *
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
interface BootstrapInterface
{
    /**
     * @var string bootstrap **extra small** size modifier - **deprecated** - use [[SIZE_X_SMALL]] instead
     */
    const SIZE_TINY = 'xs';

    /**
     * @var string bootstrap **extra small** size modifier
     */
    const SIZE_X_SMALL = 'xs';

    /**
     * @var string bootstrap **small** size modifier
     */
    const SIZE_SMALL = 'sm';

    /**
     * @var string bootstrap **medium** size modifier (this is the default size)
     */
    const SIZE_MEDIUM = 'md';

    /**
     * @var string bootstrap **large** size modifier
     */
    const SIZE_LARGE = 'lg';

    /**
     * @var string bootstrap **large** size modifier
     */
    const SIZE_X_LARGE = 'xl';
}