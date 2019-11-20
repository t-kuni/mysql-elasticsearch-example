<?php


namespace TKuni\PhpCliAppTemplate;


use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Schema;
use TKuni\PhpCliAppTemplate\interfaces\ITestRecordGenerator;

class TestRecordGenerator implements ITestRecordGenerator
{
    public function generate()
    {
        $conn = $this->initialize();

        $sm = $conn->getSchemaManager();

        $fromSchema = $sm->createSchema();
        $toSchema   = clone $fromSchema;

        $this->setupSchema($toSchema);

        $queries = $fromSchema->getMigrateToSql($toSchema, $conn->getDatabasePlatform());

        foreach ($queries as $query) {
            $conn->query($query);
        }

        $builder = $conn->createQueryBuilder();

        $builder->insert('products')
            ->values(
                [
                    'name' => '?'
                ]
            )
            ->setParameter(0, 'test-product')
            ->execute();

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

    private function setupSchema(Schema &$schema)
    {
        $table = $schema->createTable('products');
        $table->addColumn("id", "integer", ["unsigned" => true, 'autoincrement' => 'true']);
        $table->addColumn("name", "string", ["length" => 32]);
        $table->setPrimaryKey(['id']);
    }
}