<?php

namespace App\Logging;

use App\Handler\LineNotifyLogHandler;
use Monolog\Logger;
use Phattarachai\LineNotify\Line;

class LineNotifyLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('LineNotifyLogHandler');
        $logger->pushHandler(new LineNotifyLogHandler());

        return $logger;
    }
}
