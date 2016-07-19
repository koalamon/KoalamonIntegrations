<?php

namespace KoalamonIntegration\WebhookBundle\Controller;

use Koalamon\IncidentDashboardBundle\Controller\ProjectAwareController;
use Koalamon\IntegrationBundle\Entity\Configuration;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends ProjectAwareController
{
    public function webhookAction($hookName)
    {
        $config = $this->getDoctrine()
            ->getRepository('KoalamonIntegrationBundle:Configuration')
            ->findOneBy(['project' => $this->getProject(), 'format' => $hookName]);

        if ($config) {
            $options = $config->getOptions();
        } else {
            $options = [];
        }

        return $this->render('KoalamonIntegrationWebhookBundle:Default:' . $hookName . '.html.twig', ['format' => $hookName, 'options' => $options]);
    }

    public function storeOptionsAction(Request $request, $hookName)
    {
        $options = $request->get('options');

        $config = $this->getDoctrine()
            ->getRepository('KoalamonIntegrationBundle:Configuration')
            ->findOneBy(['project' => $this->getProject(), 'format' => $hookName]);

        if (!$config) {
            $config = new Configuration();
            $config->setFormat($hookName);
            $config->setProject($this->getProject());
        }

        $config->setOptions($options);

        $em = $this->getDoctrine()->getManager();
        $em->persist($config);
        $em->flush();

        return new JsonResponse(['status' => 'success', 'message' => 'Options successfully stored']);
    }
}
