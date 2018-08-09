<?php

/**
 * @package   yii2-krajee-base
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2018
 * @version   1.9.0
 */

namespace kartik\base;

/**
 * Asset bundle used for all Krajee extensions with bootstrap and jquery dependency.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class AssetBundle extends BaseAssetBundle
{
    use BootstrapTrait;

    /**
     * @var int|string the bootstrap library version
     */
    public $bsVersion;

    /**
     * @var bool whether the bootstrap JS plugins are to be loaded and enabled
     */
    public $bsPluginEnabled = false;
    
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
    
    /**
     * @var bool flag to detect whether bootstrap 4.x version is set
     */
    private $_isBs4;
    
    /**
     * @inheritdoc
     */
    public function init() {
        $this->initBsAssets();
        parent::init();
    }
    
    /**
     * Initialize bootstrap assets dependencies
     */
    protected function initBsAssets()
    {
        $lib = 'bootstrap' . ($this->isBs4() ? '4' : '');
        $typ = $this->bsPluginEnabled ? 'Plugin' : ''; 
        $this->depends[] = "yii\\{$lib}\\Bootstrap{$typ}Asset";
    }
}
