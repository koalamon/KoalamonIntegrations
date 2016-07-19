<?php

namespace KoalamonIntegration\EmailBundle\Controller;

use Koalamon\IncidentDashboardBundle\Controller\ProjectAwareController;

class DefaultController extends ProjectAwareController
{
    public function indexAction($integrationName)
    {
        return $this->render('KoalamonIntegrationEmailBundle:Default:' . $integrationName . '.html.twig');
    }
}
