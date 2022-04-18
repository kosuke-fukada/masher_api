<?php
declare(strict_types=1);

namespace Tests;

use Illuminate\Database\Connectors\SQLiteConnector;

class SQLiteTestingConnector extends SQLiteConnector
{
    /**
     * @var [type]
     */
    protected static $shared_memory_connection = null;

    /**
     * Establish a database connection.
     *
     * databaseが:shared-memory:のときは作成したPDOを保存して以後はそれを返すようにする
     *
     * @param  array  $config
     * @return \PDO
     *
     * @throws \InvalidArgumentException
     */
    public function connect(array $config)
    {
        if ($config['database'] === ':shared-memory:') {
            if (self::$shared_memory_connection === null) {
                $options = $this->getOptions($config);
                self::$shared_memory_connection = $this->createConnection('sqlite::memory:', $config, $options);
            }

            return self::$shared_memory_connection;
        }

        return parent::connect($config);
    }
}
