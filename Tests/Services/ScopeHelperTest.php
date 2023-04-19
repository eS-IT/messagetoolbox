<?php

/**
 * @package     Messagetoolbox
 * @since       19.04.2023 - 10:46
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2023
 * @license     EULA
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Tests\Services;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Esit\Messagetoolbox\Classes\Services\ScopeHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class ScopeHelperTest extends TestCase
{


    /**
     * @var Request
     */
    private Request $request;


    /**
     * @var RequestStack
     */
    private RequestStack $requestStack;


    /**
     * @var ScopeMatcher
     */
    private ScopeMatcher $scopeMatcher;


    /**
     * @var ScopeHelper
     */
    private ScopeHelper $helper;


    protected function setUp(): void
    {
        $this->request      = $this->getMockBuilder(Request::class)->disableOriginalConstructor()->getMock();
        $this->requestStack = $this->getMockBuilder(RequestStack::class)->disableOriginalConstructor()->getMock();
        $this->scopeMatcher = $this->getMockBuilder(ScopeMatcher::class)->disableOriginalConstructor()->getMock();
        $this->helper       = new ScopeHelper($this->requestStack, $this->scopeMatcher);
    }


    public function testIsBackendReturnFalseIfRequestIsBackend(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn($this->request);

        $this->scopeMatcher
            ->expects(self::once())
            ->method('isBackendRequest')
            ->with($this->request)
            ->willReturn(true);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isFrontendRequest');

        self::assertTrue($this->helper->isBackend());
    }


    public function testIsBackendWillReturnTrueIfRequestIsNull(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn(null);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isBackendRequest');

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isFrontendRequest');

        self::assertFalse($this->helper->isBackend());
    }


    public function testIsBackendWillReturnFalseIfRequestIsNotBackend(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn($this->request);

        $this->scopeMatcher
            ->expects(self::once())
            ->method('isBackendRequest')
            ->with($this->request)
            ->willReturn(false);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isFrontendRequest');

        self::assertFalse($this->helper->isBackend());
    }


    public function testIsFrontendWillReturnTrueIfRequestIsNull(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn(null);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isBackendRequest');

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isFrontendRequest');

        self::assertFalse($this->helper->isFrontend());
    }


    public function testIsFrontendWillReturnTrueIfRequestIsFrontend(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn($this->request);

        $this->scopeMatcher
            ->expects(self::once())
            ->method('isFrontendRequest')
            ->with($this->request)
            ->willReturn(true);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isBackendRequest');

        self::assertTrue($this->helper->isFrontend());
    }


    public function testIsFrontendWillReturnFalseIfRequestIsNotFrontend(): void
    {
        $this->requestStack->expects(self::once())->method('getCurrentRequest')->willReturn($this->request);

        $this->scopeMatcher
            ->expects(self::once())
            ->method('isFrontendRequest')
            ->with($this->request)
            ->willReturn(false);

        $this->scopeMatcher
            ->expects(self::never())
            ->method('isBackendRequest');

        self::assertFalse($this->helper->isFrontend());
    }
}
