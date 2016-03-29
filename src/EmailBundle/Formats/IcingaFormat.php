<?php

namespace KoalamonIntegration\EmailBundle\Formats;

use Koalamon\Bundle\IncidentDashboardBundle\Entity\Event;
use Koalamon\Bundle\IncidentDashboardBundle\Entity\RawEvent;

class IcingaFormat implements Format
{
    public function getRawEvent($emailBody)
    {
        $rawEvent = new RawEvent();

        if (strpos($emailBody, "Notification Type: RECOVERY") !== false) {
            $rawEvent->setStatus(Event::STATUS_SUCCESS);
        } else {
            $rawEvent->setStatus(Event::STATUS_FAILURE);
        }

        preg_match('^Service: (.*)^', $emailBody, $matches);
        $system = str_replace(' ', '_', $matches[1]);

        preg_match('^Host: (.*)^', $emailBody, $matches);
        $host = str_replace(' ', '_', $matches[1]);

        $rawEvent->setMessage('System: ' . $system . ', Message: ' . rtrim(substr($emailBody, strpos($emailBody, 'Additional Info:') + 18)));
        $rawEvent->setSystem($host);
        $rawEvent->setType('icinga');

        $rawEvent->setIdentifier('icinga.' . $host . '.' . $system);

        return $rawEvent;
    }
}