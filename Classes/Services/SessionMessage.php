<?php declare(strict_types = 1);
/**
 * @package     messagetoolbox
 * @filesource  SessionMessage.php
 * @version     1.0.0
 * @since       12.06.19 - 09:37
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     EULA
 */
namespace Esit\Messagetoolbox\Classes\Services;

use Contao\FrontendTemplate;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class SessionMessage
 * @package Esit\Messagetoolbox\Classes\Services
 */
class SessionMessage
{


    /**
     * @var Session
     */
    protected $session;


    /**
     * @var FrontendTemplate
     */
    protected $template;


    /**
     * Key unter dem die Werte in der Session gespeichert werden.
     * @var string
     */
    protected $sessionKey = 'esitsessionmessage';


    /**
     * Name des Ausgabetemplates
     * @var string
     */
    protected $templateName = 'inc_message';


    /**
     * SessionMessage constructor.
     * @param Session          $session
     * @param FrontendTemplate $template
     */
    public function __construct(Session $session, FrontendTemplate $template)
    {
        $this->session  = $session;
        $this->template = $template;
        $this->template->setName($this->templateName);
    }


    /**
     * @return string
     */
    public function getSessionKey(): string
    {
        return $this->sessionKey;
    }


    /**
     * @param string $sessionKey
     */
    public function setSessionKey(string $sessionKey): void
    {
        $this->sessionKey = $sessionKey;
    }


    /**
     * Fügt dem Array der Nachrichten eine neue hinzu.
     * @param string $msg
     */
    public function addMessage(string $msg): void
    {
        $messages   = $this->getMessages();
        $messages[] = $msg;
        $messages   = \serialize($messages);
        $this->session->set($this->getSessionKey(), $messages);
    }


    /**
     * Gibt die Nachrichten aus der Session zurück.
     * @return array
     */
    public function getMessages(): array
    {
        $messages = $this->session->get($this->getSessionKey());

        if (!empty($messages)) {
            $messages = @\unserialize($messages, [null]);

            if (\is_array($messages)) {
                return $messages;
            }
        }

        return [];
    }


    /**
     * Löscht alle Nachrichten aus der Session.
     */
    public function deleteMessages(): void
    {
        $this->session->remove($this->getSessionKey());
    }


    /**
     * Erstellt die Ausgabe für die Nachrichten.
     * @param  bool   $deleteMsg
     * @return string
     */
    public function output($deleteMsg = true): string
    {
        $content    = '';
        $messages   = $this->getMessages();

        if (\count($messages)) {
            $this->template->messages   = $messages;
            $content                    = $this->template->parse();
        }

        if (true === $deleteMsg) {
            $this->deleteMessages();
        }

        return $content;
    }
}
