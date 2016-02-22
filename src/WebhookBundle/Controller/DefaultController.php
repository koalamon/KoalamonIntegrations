<?php

namespace KoalamonIntegration\WebhookBundle\Controller;

use Koalamon\Bundle\IncidentDashboardBundle\Controller\ProjectAwareController;

class DefaultController extends ProjectAwareController
{
    public function webhookAction($hookName)
    {
        return $this->render('KoalamonIntegrationWebhookBundle:Default:' . $hookName . '.html.twig');
    }
}
