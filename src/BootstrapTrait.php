<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.1
 */

namespace kartik\base;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * BootstrapTrait includes bootstrap library init and parsing methods
 *
 * @property string $bsVersion
 * @property bool   $_isBs4
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 */
trait BootstrapTrait
{    
    /**
     * Initializes bootstrap versions for the widgets and asset bundles.
     * Sets the [[_isBs4]] flag by parsing [[bsVersion]]
     */
    protected function initBsVersion()
    {
        if (empty($this->bsVersion)) {
            $ver = ArrayHelper::getValue(Yii::$app->params, 'bsVersion', '3.x');
        } else {
            $ver = (string) $this->bsVersion;
        }
        $this->_isBs4 = substr(trim($ver), 0, 1) === '4';
    }
    
    /**
     * Validate if Bootstrap 4.x version
     * @return bool
     */
    public function isBs4()
    {
        if (!isset($this->_isBs4)) {
            $this->initBsVersion();
        }
        return $this->_isBs4;
    }
}
