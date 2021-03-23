<?php

namespace App\Logging;

use App\Models\Log;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * @property string table
 */
class MySQLLoggingHandler extends AbstractProcessingHandler
{
    /**
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     */
    protected function write(array $record): void
    {
        Log::create([
            'message'         => $record['message'],
            'context'         => !empty($record['context']) ? (array)$record['context']['exception'] : $record['context'],
            'level'           => $record['level_name'],
            'channel'         => $record['channel'],
            'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra'           => (array)$record['extra'],
            'formatted'       => $record['formatted'],
            'remote_addr'     => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'user_agent'      => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
        ]);
    }
}
