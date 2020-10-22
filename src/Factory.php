<?php

declare(strict_types=1);

namespace DarkMatter\Components\Logger;

class Factory
{
    /**
     * @var array $config
     */
    protected $config = [];

    public function __construct(array $config)
    {
        $this->config = $config['logger'] ?? [];
    }

    /**
     * Creates a new file logger.
     *
     * @return FileLogger
     * @throws LoggerException
     */
    public function makeFileLogger(): FileLogger
    {
        if (empty($this->config['path_logs'])) {
            throw new LoggerException('Invalid logger config. "path_logs" is missing.');
        }
        $logger = new FileLogger;
        $logger->setLogsDir($this->config['path_logs']);
        $logger->setMinLevel($this->config['min_level'] ?? LogLevel::WARNING);

        return $logger;
    }

    /**
     * Creates a new null logger.
     *s
     * @return NullLogger
     */
    public function makeNullLogger(): NullLogger
    {
        return new NullLogger;
    }
}
