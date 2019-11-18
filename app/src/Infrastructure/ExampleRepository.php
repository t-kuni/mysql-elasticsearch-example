<?php


namespace TKuni\PhpCliAppTemplate\Infrastructure;


use Carbon\Carbon;
use Psr\Log\LoggerInterface;
use SleekDB\SleekDB;
use TKuni\PhpCliAppTemplate\Domain\Models\ExampleModel;

class ExampleRepository implements IExampleRepository
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->store  = SleekDB::store('example', '/app/storage');
        $this->logger = $logger;
    }

    public function save(ExampleModel $model)
    {
        $this->logger->info('Start to save', func_get_args());

        $ctx = $this->store->keepConditions()
            ->where('id', '=', $model->id());

        $result = $ctx->fetch();

        if (empty($result[0])) {
            $doc = [
                'id'    => $model->id(),
                'title' => $model->title(),
                'body'  => $model->body()
            ];
            $this->store->insert($doc);
        } else {
            $ctx->update([
                'title' => $model->title(),
                'body' => $model->body(),
            ]);
        }

        $this->logger->info('End to save');
    }

    public function find(string $id): ?ExampleModel
    {
        $this->logger->info('Start to find', func_get_args());

        $docs = $this->store->where('id', '=', $id)
            ->fetch();

        $this->logger->info('End to find');

        if (empty($docs[0])) {
            return null;
        } else {
            $doc = $docs[0];
            return new ExampleModel($doc['id'], $doc['title'], $doc['body']);
        }
    }
}