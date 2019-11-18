<?php

namespace tests\unit;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use SimpleLog\Logger;
use TKuni\PhpCliAppTemplate\App;
use TKuni\PhpCliAppTemplate\Domain\Models\ExampleModel;
use TKuni\PhpCliAppTemplate\Domain\Models\Github\Comment;
use TKuni\PhpCliAppTemplate\Domain\Models\Github\Issue;
use TKuni\PhpCliAppTemplate\Domain\Models\Github\Progress;
use TKuni\PhpCliAppTemplate\Domain\ObjectValues\ExampleBody;
use TKuni\PhpCliAppTemplate\Infrastructure\GithubAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IAnkiWebAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IGithubAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IProgressRepository;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IExampleRepository;

class AppTest extends TestCase
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
        app()->make('app')->run();

        #
        # Assertion
        #
        $this->assertTrue(true);
    }
}