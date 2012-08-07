<?php
namespace FTC\Bundle\WebBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FTC\Bundle\CodeBundle\Event\Events as CodeEvents;
use FTC\Bundle\CodeBundle\Event\CommentPayload;
use FTC\Bundle\CodeBundle\Event\SnippetPayload;
use FTC\Bundle\CodeBundle\Event\CodeEntryPayload;

/**
 * Listens and sends notifications
 */
class NotificationListener implements EventSubscriberInterface
{

    /**
     * @var \Symfony\Bundle\TwigBundle\TwigEngine
     */
    protected $templating;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @param \Symfony\Bundle\TwigBundle\TwigEngine $templating
     * @param \Swift_Mailer $mailer
     */
    public function __construct($templating, $mailer)
    {
        $this->templating = $templating;
        $this->mailer     = $mailer;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            CodeEvents::NEW_COMMENT => array("onNewComment"),
            CodeEvents::NEW_SNIPPET => array("onNewSnippet"),
            CodeEvents::NEW_ENTRY   => array("onNewEntry"),
        );
    }

    /**
     * @param \FTC\Bundle\CodeBundle\Event\CommentPayload $event
     */
    public function onNewComment(CommentPayload $event)
    {
        $recipient = $event->getComment()->getEntry()->getAuthor();
        $subject   = "New comment on FixThatCode.com";
        $body      = $this->templating->render('FTCWebBundle:Email:notification_comment.html.twig', array(
            'entry'   => $event->getComment()->getEntry(),
            'comment' => $event->getComment(),
        ));

        $email = $this->createEmail($recipient, $subject, $body);
        $this->mailer->send($email);
    }

    /**
     * @param \FTC\Bundle\CodeBundle\Event\SnippetPayload $event
     */
    public function onNewSnippet(SnippetPayload $event)
    {
        $recipient = $event->getSnippet()->getComment()->getEntry()->getAuthor();
        $subject   = "New code snippet on FixThatCode.com";
        $body      = $this->templating->render('FTCWebBundle:Email:notification_snippet.html.twig', array(
            'entry'   => $event->getSnippet()->getComment()->getEntry(),
            'snippet' => $event->getSnippet(),
        ));

        $email = $this->createEmail($recipient, $subject, $body);
        $this->mailer->send($email);
    }

    /**
     * @param \FTC\Bundle\CodeBundle\Event\CodeEntryPayload $event
     *
     * @todo implement this once watching categories is done, emails should come from there.
     */
    public function onNewEntry(CodeEntryPayload $event)
    {
        return;
    }

    /**
     * @param \FTC\Bundle\AuthBundle\Entity\User $recipient
     * @param string $subject
     * @param string $body
     *
     * @return \Swift_Message
     */
    protected function createEmail($recipient, $subject, $body)
    {
        $email = new \Swift_Message();
        $email->addTo($recipient->getEmail(), $recipient->getFullname());
        $email->setFrom('notifications@fixthatcode.com', 'FixThatCode.com');
        $email->setSubject($subject);
        $email->setBody($body, 'text/html');

        return $email;
    }
}
