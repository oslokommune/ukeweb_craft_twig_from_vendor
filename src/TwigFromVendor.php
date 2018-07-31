<?php
/**
 * Twig from vendor plugin for Craft CMS 3.x
 *
 * Allows including twig files from vendor folder
 *
 * @link      https://oslo.kommune.no
 * @copyright Copyright (c) 2018 oslo.kommune.no
 */

namespace oslokommune\twigfromvendor;

use Craft;
use craft\base\Plugin;

use craft\web\View;
use yii\base\Event;

/**
 * Class TwigFromVendor
 *
 * @author    oslo.kommune.no
 * @package   TwigFromVendor
 * @since     1.0.0
 *
 */
class TwigFromVendor extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var TwigFromVendor
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Protected Properties
    // =========================================================================

    protected $lsgPath = '/oslokommune/ok-atomic-frontend/src/';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            View::class,
            View::EVENT_REGISTER_SITE_TEMPLATE_ROOTS,
            function(craft\events\RegisterTemplateRootsEvent $event) {
                $event->roots = [
                    'vendor' => Craft::$app->getPath()->getVendorPath(),
                    'atoms' => Craft::$app->getPath()->getVendorPath() . $this->lsgPath,
                    'molecules' => Craft::$app->getPath()->getVendorPath() . $this->lsgPath,
                    'organisms' => Craft::$app->getPath()->getVendorPath() . $this->lsgPath
                ];
            }
        );

        Craft::info(
            Craft::t(
                'twig-from-vendor',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
}
