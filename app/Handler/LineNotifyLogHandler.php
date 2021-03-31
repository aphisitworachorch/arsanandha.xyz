<?php
namespace App\Handler;

use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Phattarachai\LineNotify\Line;

class LineNotifyLogHandler extends AbstractProcessingHandler{
    /**
     *
     * Reference:
     * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
     * @param int $level
     * @param bool $bubble
     */
    public function __construct($level = Logger::DEBUG, $bubble = true) {
        parent::__construct($level, $bubble);
    }
    protected function write(array $record):void
    {
        // dd($record);
        $data = array(
            'message'       => $record['message'],
            'context'       => json_encode($record['context']),
            'level'         => $record['level'],
            'level_name'    => $record['level_name'],
            'channel'       => $record['channel'],
            'record_datetime' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra'         => json_encode($record['extra']),
            'formatted'     => $record['formatted'],
            'remote_addr'   => $_SERVER['REMOTE_ADDR'],
            'user_agent'    => $_SERVER['HTTP_USER_AGENT'],
            'created_at'    => date("Y-m-d H:i:s"),
        );
        $formatter =
            "\n" .
            "Levels : ".$record['level_name'] . "\n" .
            "Message : " . $record['message'] . "\n\n" .
            "UA : " . htmlspecialchars($_SERVER['HTTP_USER_AGENT']). "\n".
            "Date : ".$record['datetime']->format('Y-m-d H:i:s');
        $lineNotifyLog = new Line(env('LINE_NOTIFY_LOGGER_ACCESS_TOKEN'));
        $lineNotifyLog->send($formatter);
    }
}
