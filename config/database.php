<? php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('setUniqdoesntmatter', 'remuserdb'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'remuserdb' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_1', '127.0.0.1'),
            'port' => env('DB_PORT_1', '3306'),
            'database' => env('DB_DATABASE_1', 'forge'),
            'username' => env('DB_USERNAME_1', 'forge'),
            'password' => env('DB_PASSWORD_1', 'forge'),
            'unix_socket' => '/var/run/mysqld/mysqld.sock',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false, //this was changed from default of true!
            'engine' => null,
            'options'  => array(PDO::MYSQL_ATTR_LOCAL_INFILE => true),
        ],

        'remailsynch' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_2', '127.0.0.1'),
            'port' => env('DB_PORT_2', '3306'),
            'database' => env('DB_DATABASE_2', 'forge'),
            'username' => env('DB_USERNAME_2', 'forge'),
            'password' => env('DB_PASSWORD_2', ''),
            'unix_socket' => env('DB_SOCKET_2', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false, //this was changed from default of true!
            'engine' => null,
        ],

        'deletes' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_3', '127.0.0.1'),
            'port' => env('DB_PORT_3', '3306'),
            'database' => env('DB_DATABASE_3', 'forge'),
            'username' => env('DB_USERNAME_3', 'forge'),
            'password' => env('DB_PASSWORD_3', ''),
            'unix_socket' => env('DB_SOCKET_3', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false, //this was changed from default of true!
            'engine' => null,
        ],

        'remarchives' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_4', '127.0.0.1'),
            'port' => env('DB_PORT_4', '3306'),
            'database' => env('DB_DATABASE_4', 'forge'),
            'username' => env('DB_USERNAME_4', 'forge'),
            'password' => env('DB_PASSWORD_4', ''),
            'unix_socket' => env('DB_SOCKET_4', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false, //this was changed from default of true!
            'engine' => null,
        ],

        'rememaildb' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_5', '127.0.0.1'),
            'port' => env('DB_PORT_5', '3306'),
            'database' => env('DB_DATABASE_5', 'forge'),
            'username' => env('DB_USERNAME_5', 'forge'),
            'password' => env('DB_PASSWORD_5', ''),
            'unix_socket' => env('DB_SOCKET_5', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false, //this was changed from default of true!
            'engine' => null,
        ],


        'oldsite' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_6', 'www.realtyemails.com'),
            'port' => env('DB_PORT_6', '3306'),
            'database' => env('DB_DATABASE_6', 'forge'),
            'username' => env('DB_USERNAME_6', 'forge'),
            'password' => env('DB_PASSWORD_6', ''),
            'unix_socket' => env('DB_SOCKET_6', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
            'options'   => array(
                PDO::ATTR_TIMEOUT => "2",
            )
        ],

        'rets' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_7', '127.0.0.1'),
            'port' => env('DB_PORT_7', '3306'),
            'database' => env('DB_DATABASE_7', 'forge'),
            'username' => env('DB_USERNAME_7', 'forge'),
            'password' => env('DB_PASSWORD_7', ''),
            'unix_socket' => env('DB_SOCKET_7', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
            'options'   => array(
                PDO::ATTR_TIMEOUT => "2",
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            ),
        ],

        'adre' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_8', '127.0.0.1'),
            'port' => env('DB_PORT_8', '3306'),
            'database' => env('DB_DATABASE_8', 'forge'),
            'username' => env('DB_USERNAME_8', 'forge'),
            'password' => env('DB_PASSWORD_8', ''),
            'unix_socket' => env('DB_SOCKET_8', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
            'options'   => array(
                PDO::ATTR_TIMEOUT => "2",
                PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            ),
        ],

        'oldEmails' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST_9', '127.0.0.1'),
            'port' => env('DB_PORT_9', '3306'),
            'database' => env('DB_DATABASE_9', 'forge'),
            'username' => env('DB_USERNAME_9', 'forge'),
            'password' => env('DB_PASSWORD_9', ''),
            'unix_socket' => env('DB_SOCKET_9', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => false,
            'engine' => null,
            'options'   => array(
                PDO::ATTR_TIMEOUT => "2",
            ),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
