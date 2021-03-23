<?php


namespace App\Logging;

use Monolog\Logger;

/**
 * Class MySQLCustomLogger
 * @package App\Logging
 */
class MySQLCustomLogger
{
    /**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return Logger
     */
    public function __invoke(array $config){
        return (new Logger("MySQLLoggingHandler"))->pushHandler(new MySQLLoggingHandler());
    }
}
