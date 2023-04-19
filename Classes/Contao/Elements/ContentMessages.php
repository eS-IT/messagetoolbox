<?php

/**
 * @package     messagetoolbox
 * @since       14.11.19 - 11:11
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Classes\Contao\Elements;

use Contao\ContentElement;
use Contao\System;
use Esit\Messagetoolbox\Classes\Services\ScopeHelper;
use Esit\Messagetoolbox\Classes\Services\SessionMessage;

class ContentMessages extends ContentElement
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_messages';


    /**
     * Generate the content element
     */
    protected function compile(): void
    {
        /** @var ScopeHelper $matcher */
        $matcher = System::getContainer()->get(ScopeHelper::class);

        if (true === $matcher->isBackend()) {
            $this->genBeOutput();
        } else {
            $this->genFeOutput();
        }
    }


    /**
     * Erzeugt die Ausgabe für das Backend.
     */
    protected function genBeOutput(): void
    {
        $this->strTemplate        = 'be_wildcard';
        $this->Template           = new \BackendTemplate($this->strTemplate);
        $this->Template->title    = $this->headline;            // @phpstan-ignore-line
        $this->Template->wildcard = '### ContentMessages ###';  // @phpstan-ignore-line
    }


    /**
     * Erzeugt die Ausgabe für das Frontend.
     */
    protected function genFeOutput(): void
    {
        /** @var SessionMessage $sm */
        $sm                         = System::getContainer()->get(SessionMessage::class);
        $this->Template->content    = $sm->output();
    }
}
