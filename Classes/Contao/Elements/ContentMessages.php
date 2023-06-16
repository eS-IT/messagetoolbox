<?php declare(strict_types = 1);
/**
 * @package     messagetoolbox
 * @filesource  ContentMessages.php
 * @version     1.0.0
 * @since       14.11.19 - 11:11
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see        http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     EULA
 */
namespace Esit\Messagetoolbox\Classes\Contao\Elements;

use Contao\System;
use Esit\Messagetoolbox\Classes\Services\SessionMessage;

/**
 * Class ContentMessages
 * @package Messagetoolbox\Classes\Contao\Elements
 */
class ContentMessages extends \ContentElement
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
        if ('BE' === TL_MODE) {
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
        $this->Template->title    = $this->headline;
        $this->Template->wildcard = '### ContentMessages ###';
    }


    /**
     * Erzeugt die Ausgabe für das Frontend.
     */
    protected function genFeOutput(): void
    {
        $sm                         = System::getContainer()->get(SessionMessage::class);
        $this->Template->content    = $sm->ouput();
    }
}
