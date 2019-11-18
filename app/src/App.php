<?php

namespace TKuni\PhpCliAppTemplate;

use Psr\Log\LoggerInterface;
use TKuni\PhpCliAppTemplate\Domain\AnkiCardAdder;
use TKuni\PhpCliAppTemplate\Domain\Models\ExampleModel;
use TKuni\PhpCliAppTemplate\Domain\ObjectValues\ExampleBody;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IAnkiWebAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IGithubAdapter;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IProgressRepository;
use TKuni\PhpCliAppTemplate\Infrastructure\interfaces\IExampleRepository;

class App
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var IExampleRepository
     */
    private $repo;

    public function __construct(LoggerInterface $logger, IExampleRepository $repo)
    {
        $this->logger = $logger;
        $this->repo   = $repo;
    }

    public function run()
    {
        $this->logger->info('Start application');

        $text   = getenv('TEXT_FROM_ENV');
        $model = new ExampleModel('id-0001', 'example-title', new ExampleBody($text));
        $this->repo->save($model);

        $this->logger->info('Exit application');
    }
}