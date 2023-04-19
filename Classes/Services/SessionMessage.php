<?php

/**
 * @package     Messagetoolbox
 * @since       12.06.19 - 09:37
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Classes\Services;

use Contao\FrontendTemplate;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionMessage
{
    /**
     * Key unter dem die Werte in der Session gespeichert werden.
     * @var string
     */
    protected string $sessionKey = 'esitsessionmessage';


    /**
     * Name des Ausgabetemplates
     * @var string
     */
    protected string $templateName = 'inc_message';


    /**
     * @param FrontendTemplate $template
     */
    public function __construct(protected RequestStack $requestStack, protected FrontendTemplate $template)
    {
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
        $session    = $this->requestStack->getSession();
        $session->set($this->getSessionKey(), $messages);
    }


    /**
     * Gibt die Nachrichten aus der Session zurück.
     * @return array|string[]
     */
    public function getMessages(): array
    {

        $session    = $this->requestStack->getSession();
        $messages   = $session->get($this->getSessionKey());

        if (!empty($messages) && true  === \is_string($messages)) {
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
        $session = $this->requestStack->getSession();
        $session->remove($this->getSessionKey());
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
            $this->template->messages   = $messages; // @phpstan-ignore-line
            $content                    = $this->template->parse();
        }

        if (true === $deleteMsg) {
            $this->deleteMessages();
        }

        return $content;
    }
}
