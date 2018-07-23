<?php
namespace ProtocolTest;

use Xervice\Core\Locator\Locator;

class IntegrationTest extends \Codeception\Test\Unit
{
    /**
     * @group App
     * @group Integration
     */
    public function testIntegration()
    {
        $kernel = Locator::getInstance()->kernel()->facade();
        $kernel->boot();

        ob_start();
        $kernel->run();
        $response = ob_get_contents();
        ob_end_clean();

        $this->assertEquals(
            'Hello World undefined',
            $response
        );
    }
}