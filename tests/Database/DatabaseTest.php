<?php
/**
 * AVOLUTIONS
 *
 * Just another open source PHP framework.
 *
 * @copyright   Copyright (c) 2019 - 2021 AVOLUTIONS
 * @license     MIT License (http://avolutions.org/license)
 * @link        http://avolutions.org
 */

use PHPUnit\Framework\TestCase;

use Avolutions\Config\Config;
use Avolutions\Database\Database;

class DatabaseTest extends TestCase
{
    protected function setUp(): void
    {
        Config::set('database/host', getenv('DB_HOST') ?: '127.0.0.1');
        Config::set('database/database', getenv('DB_DATABASE') ?: 'avolutions');
        Config::set('database/port', getenv('DB_PORT') ?: '3306');
        Config::set('database/user', getenv('DB_USER') ?: 'avolutions');
        Config::set('database/password', getenv('DB_PASSWORD') ?: 'avolutions');
        Config::set('database/charset', 'utf8');
    }

    public function testDatabaseConnection()
    {
        $Database = new Database();

        $this->assertInstanceOf('\PDO', $Database);
    }

    public function testMigrationTableCanBeCreated()
    {
        $table = [
            [
                'Field' => 'MigrationID',
                'Type' => 'int(255)',
                'Null' => 'NO',
                'Key' => 'PRI',
                'Default' => '',
                'Extra' => 'auto_increment'
            ],
            [
                'Field' => 'Version',
                'Type' => 'bigint(255)',
                'Null' => 'NO',
                'Key' => '',
                'Default' => '',
                'Extra' => '',
            ],
            [
                'Field' => 'Name',
                'Type' => 'varchar(255)',
                'Null' => 'NO',
                'Key' => '',
                'Default' => '',
                'Extra' => ''
            ],
            [
                'Field' => 'CreateDate',
                'Type' => 'datetime',
                'Null' => 'NO',
                'Key' => '',
                'Default' => 'CURRENT_TIMESTAMP',
                'Extra' => ''
            ]
        ];

        Database::migrate();

        $Database = new Database();

        $query = 'DESCRIBE migration';
        $stmt = $Database->prepare($query);
		$stmt->execute();

        $rows = $stmt->fetchAll($Database::FETCH_ASSOC);

        // workaround because unix system return 'CURRENT_TIMESTAMP' and windows returns 'current_timestamp()'
        $rows[3]['Default'] = str_replace('current_timestamp()', 'CURRENT_TIMESTAMP', $rows[3]['Default']);

        $this->assertEquals($rows, $table);
    }
}