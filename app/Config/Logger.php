<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use Psr\Log\LogLevel;

class Logger extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Logging Threshold
     * --------------------------------------------------------------------------
     *
     * If you have adopted the PSR-3 LogLevel interface, you can set this
     * to the level that you want to log.
     *
     * @var int
     */
    public int $threshold = 4;

    /**
     * --------------------------------------------------------------------------
     * Log Handlers
     * --------------------------------------------------------------------------
     *
     * An array of log handlers to use. The order they are listed here
     * is the order they will be called.
     *
     * @var array<string, array<string, mixed>>
     */
    public array $handlers = [
        'CodeIgniter\Log\Handlers\FileHandler' => [
            'handles' => ['critical', 'alert', 'emergency', 'error', 'warning', 'notice', 'info', 'debug'],
        ],
    ];

    /**
     * --------------------------------------------------------------------------
     * Log File Permissions
     * --------------------------------------------------------------------------
     *
     * The permissions to set on log files when created.
     *
     * @var int|string
     */
    public int|string $filePermissions = 0644;

    /**
     * --------------------------------------------------------------------------
     * Log File Path
     * --------------------------------------------------------------------------
     *
     * The path to the directory that holds the log files.
     *
     * @var string
     */
    public string $filePath = APPPATH . 'logs';

    /**
     * --------------------------------------------------------------------------
     * Date Format
     * --------------------------------------------------------------------------
     *
     * The date format to use for log entries.
     *
     * @var string
     */
    public string $dateFormat = 'Y-m-d H:i:s';
}
