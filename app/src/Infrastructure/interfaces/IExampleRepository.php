<?php

namespace TKuni\PhpCliAppTemplate\Infrastructure\interfaces;

use TKuni\PhpCliAppTemplate\Domain\Models\ExampleModel;

interface IExampleRepository
{
    public function save(ExampleModel $model);

    public function find(string $id): ?ExampleModel;
}