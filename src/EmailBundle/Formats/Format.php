<?php
/**
 * Created by PhpStorm.
 * User: nils.langner
 * Date: 26.03.16
 * Time: 22:32
 */

namespace KoalamonIntegration\EmailBundle\Formats;
use Koalamon\IncidentDashboardBundle\Entity\RawEvent;

interface Format
{
    /**
     * @param string $emailText
     * @return RawEvent
     */
    public function getRawEvent($emailText);
}