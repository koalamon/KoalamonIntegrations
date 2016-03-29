<?php

namespace KoalamonIntegration\EmailBundle\Command;

use Ddeboer\Imap\Server;
use Koalamon\Bundle\IncidentDashboardBundle\Entity\Event;
use Koalamon\Bundle\IncidentDashboardBundle\Entity\Project;
use Koalamon\Bundle\IncidentDashboardBundle\Entity\RawEvent;
use KoalamonIntegration\EmailBundle\Formats\FormatFactory;
use KoalamonIntegration\EmailBundle\Formats\IcingaFormat;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('koalamon:integration:email')
            ->setDescription('Fetch events from icinga email address.');
    }

    private function getMessages(OutputInterface $output)
    {
        $server = new Server('imap.gmail.com');
        $connection = $server->authenticate('koalamon.com@gmail.com', '$stro8879');

        $mailbox = $connection->getMailbox("[Gmail]/Alle Nachrichten");

        $trash = $connection->getMailbox('[Gmail]/Papierkorb');

        $imapMessages = $mailbox->getMessages();

        $messages = [];

        foreach ($imapMessages as $imapMessage) {
            $to = $imapMessage->getTo()[0]->getMailbox();

            $format = substr($to, 0, strpos($to, '.'));

            if ($format == "") {
                $output->writeln('<error>Format not found in ' . $to . '</error>');
                continue;
            }

            $projectKey = substr($to, strpos($to, '.') + 1);

            $messages[] = ['format' => $format, 'message' => (string)$imapMessage->getBodyText(), 'projectKey' => $projectKey];
            $imapMessage->delete();
            $imapMessage->move($trash);
        }

        $mailbox->expunge();
        return $messages;
    }

    private function clean($string)
    {
        return str_replace(chr(13), "\n", str_replace(chr(10), '', $string));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messages = $this->getMessages($output);

        $formatFactory = new FormatFactory();
        $formatFactory->registerFormat('icinga', new IcingaFormat());

        foreach ($messages as $message) {

            $project = @$this->getContainer()
                ->get('doctrine')
                ->getManager()
                ->getRepository('KoalamonIncidentDashboardBundle:Project')
                ->findOneBy(['apiKey' => $message['projectKey']]);

            if ($project == null) {
                $output->writeln('<error>Project with api key ' . $message['projectKey'] . ' not found.</error>');
                continue;
            }

            $imapMessage = $this->clean($message['message']);

            if ($formatFactory->hasFormat($message['format'])) {

                $format = $formatFactory->getFormat($message['format']);
                $rawEvent = $format->getRawEvent($imapMessage);
                @$this->getContainer()->get('koalamon.project.helper')->addRawEvent($rawEvent, $project);

                $output->writeln('<info>Event ' . $rawEvent->getIdentifier() . ' created</info>');
            } else {
                $output->writeln('<error>Format not found: ' . $message['format'] . '</error>');
            }
        }
    }
}
