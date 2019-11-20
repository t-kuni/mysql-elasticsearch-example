<?php


namespace TKuni\PhpCliAppTemplate;


use Doctrine\DBAL\DriverManager;
use TKuni\PhpCliAppTemplate\interfaces\ITestRecordGenerator;

class TestRecordGenerator implements ITestRecordGenerator
{
    public function generate()
    {
        $conn = $this->initialize();

        $sm = $conn->getSchemaManager();

        $fromSchema = $sm->createSchema();
        $toSchema   = clone $fromSchema;

        $table = $toSchema->createTable('products');
        $table->addColumn("id", "integer", ["unsigned" => true]);
        $table->addColumn("name", "string", ["length" => 32]);

        $queries = $fromSchema->getMigrateToSql($toSchema, $conn->getDatabasePlatform());

        foreach ($queries as $query) {
            $conn->query($query);
        }
        $conn->close();
    }

    private function initialize()
    {
        $database = 'xxx_service';

        $conn = DriverManager::getConnection([
            'url' => 'mysql://root:password@mysql',
        ]);

        $queryBuilder = $conn->createQueryBuilder();

        $sm = $conn->getSchemaManager();

        try {
            $sm->dropDatabase($database);
        } catch (\Exception $e) {
        }
        $sm->createDatabase($database);

        $conn->close();

        return DriverManager::getConnection([
            'url' => 'mysql://root:password@mysql/' . $database,
        ]);
    }
}