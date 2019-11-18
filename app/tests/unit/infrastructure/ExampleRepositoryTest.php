<?php

namespace tests\unit\infrastructure;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use TKuni\PhpCliAppTemplate\Domain\Models\Github\Issue;
use TKuni\PhpCliAppTemplate\Infrastructure\GithubAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IExampleRepository;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IProgressRepository;
use TKuni\PhpCliAppTemplate\Infrastructure\ExampleRepository;

class ExampleRepositoryTest extends TestCase
{
    /**
     * @test
     */
    public function find_shouldComplete() {
        $logger = \Mockery::mock(LoggerInterface::class);
        $logger->shouldReceive('info');
        app()->bind(LoggerInterface::class, function() use ($logger) {
            return $logger;
        });

        $repo = app()->make(IExampleRepository::class);
        $model = $repo->find('id-0001');
        var_dump($model);
        $this->assertTrue(true);
    }
}