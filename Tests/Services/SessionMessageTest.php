<?php

/**
 * @package     Messagetoolbox
 * @since       04.07.19 - 17:44
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2019
 * @license     LGPL-3.0-or-later
 */

declare(strict_types=1);

namespace Esit\Messagetoolbox\Tests\Services;

use Contao\FrontendTemplate;
use Esit\Messagetoolbox\Classes\Services\SessionMessage;
use Esit\Messagetoolbox\EsitTestCase;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionMessageTest extends EsitTestCase
{


    public function testSetSessionKey(): void
    {
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);
        $key        = $sm->getSessionKey();
        $this->assertEquals('esitsessionmessage', $key);

        $sm->setSessionKey('testsessionkey');
        $keyTow = $sm->getSessionKey();
        $this->assertEquals('testsessionkey', $keyTow);
    }


    public function testAddMessage(): void
    {
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);

        $sess->expects($this->once())
             ->method('set')
             ->with($this->equalTo('esitsessionmessage'), $this->equalTo('a:1:{i:0;s:4:"test";}'));

        $sess->method('get')->willReturn(\serialize([]));

        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);
        $sm->addMessage('test');
    }


    /**
     * @dataProvider getMessages_dataProvider
     * @param array $messages
     */
    public function testGetMessages(array $messages): void
    {
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $sess->method('set')->willReturn(null);
        $sess->method('get')->willReturn(\serialize($messages));
        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);

        if (\count($messages)) {
            $this->assertEquals($messages, $sm->getMessages());
        } else {
            $this->assertEquals([], $sm->getMessages());
        }
    }


    /**
     * @return array
     */
    public function getMessages_dataProvider(): array
    {
        return $this->uniDataProvider(__METHOD__);
    }


    public function testDeleteMessages(): void
    {
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $sess->expects($this->once())->method('remove')->with($this->equalTo('esitsessionmessage'));
        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);
        $sm->deleteMessages();
    }


    public function testOutputReturnStringIfMessagesAreNotEmpty(): void
    {
        $content    = \serialize(['This is content!']);
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $sess->method('get')->willReturn($content);
        $template   = $this->createMock(FrontendTemplate::class);
        $template->method('parse')->willReturn($content);
        $sm         = new SessionMessage($stack, $template);
        $rtn        = $sm->output(false);

        $this->assertEquals($content, $rtn);
    }


    public function testOutputReturnEmptyStringIfMessagesAreEmpty(): void
    {
        $content    = '';
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $sess->method('get')->willReturn($content);
        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);
        $rtn        = $sm->output(false);

        $this->assertEmpty($rtn);
    }


    public function testOutputDeletesMessagesIfParameterIsTrue(): void
    {
        $sess       = $this->getMockBuilder(SessionInterface::class)->disableOriginalConstructor()->getMock();
        $stack      = $this->createMock(RequestStack::class);
        $stack->method('getSession')->willReturn($sess);
        $sess->expects($this->once())->method('remove')->with($this->equalTo('esitsessionmessage'));
        $sess->expects($this->once())->method('get')->with($this->equalTo('esitsessionmessage'));
        $template   = $this->createMock(FrontendTemplate::class);
        $sm         = new SessionMessage($stack, $template);
        $sm->output(true);
    }
}
