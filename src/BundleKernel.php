<?php
/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 20.02.16
 * Time: 07:45
 */

namespace KoalamonIntegration;

use KoalamonIntegration\WebhookBundle\KoalamonIntegrationWebhookBundle;

class BundleKernel
{
    public static function registerBundles($environment)
    {
        $bundles = [
            new KoalamonIntegrationWebhookBundle(),
        ];

        return $bundles;
    }
}