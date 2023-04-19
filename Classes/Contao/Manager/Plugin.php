<?php

/**
 * @package     Messagetoolbox
 * @since       14.11.2019 - 10:30
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Classes\Contao\Manager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Config\ConfigInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Esit\Messagetoolbox\EsitMessagetoolboxBundle;

class Plugin implements BundlePluginInterface
{
    /**
     * @param  ParserInterface         $parser
     * @return array|ConfigInterface[]
     */
    public function getBundles(ParserInterface $parser): array
    {
        return [BundleConfig::create(EsitMessagetoolboxBundle::class)->setLoadAfter([ContaoCoreBundle::class])];
    }
}
