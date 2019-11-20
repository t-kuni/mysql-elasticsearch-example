<?php

namespace tests\unit;

use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use TKuni\PhpCliAppTemplate\interfaces\ITestRecordGenerator;

class TestRecordGeneratorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $logger = \Mockery::mock(LoggerInterface::class);
        $logger->shouldReceive('info');
        app()->bind(LoggerInterface::class, function() use ($logger) {
            return $logger;
        });
    }

    protected function tearDown(): void
    {
        \Mockery::close();
        parent::tearDown();
    }

    /**
     * @test
     */
    public function run_shouldRunCompleteIfDontHaveProgress()
    {
        #
        # Prepare
        #

        #
        # Run
        #
        $generator = app()->make(ITestRecordGenerator::class)->generate();

        #
        # Assertion
        #
        $this->assertTrue(true);
    }
}