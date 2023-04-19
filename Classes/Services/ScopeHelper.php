<?php

/**
 * @package     Messagetoolbox
 * @since       19.04.2023 - 10:33
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2023
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Classes\Services;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;

class ScopeHelper
{
    /**
     * @param RequestStack $requestStack
     * @param ScopeMatcher $scopeMatcher
     */
    public function __construct(private RequestStack $requestStack, private ScopeMatcher $scopeMatcher)
    {
    }


    /**
     * @return bool
     */
    public function isBackend(): bool
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            return false;
        }

        return $this->scopeMatcher->isBackendRequest($request);
    }


    /**
     * @return bool
     */
    public function isFrontend(): bool
    {
        $request = $this->requestStack->getCurrentRequest();

        if (null === $request) {
            return false;
        }

        return $this->scopeMatcher->isFrontendRequest($request);
    }
}
