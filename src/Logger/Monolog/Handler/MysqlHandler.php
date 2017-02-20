<?php

namespace Logger\Monolog\Handler;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class MysqlHandler extends AbstractProcessingHandler
{
    protected $table;

    public function __construct($table = 'logs', $level = Logger::DEBUG, $bubble = true)
    {
        $this->table = $table;

        parent::__construct($level, $bubble);
    }

    /**
     * Writes the record for this implementing handler.
     *
     * @param  array $record
     * @return void
     */
    protected function write(array $record)
    {
        $data = [
            'channel'     => $record['channel'],
            'message'     => $record['message'],
            'level'       => $record['level'],
            'level_name'  => $record['level_name'],
            'context'     => json_encode($record['context']),
            'remote_addr' => isset($_SERVER['REMOTE_ADDR'])     ? ip2long($_SERVER['REMOTE_ADDR']) : null,
            'user_agent'  => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT']      : null,
            'session_id'  => Session::getId(),
            'created_by'  => $this->currentUser(),
            'created_at'  => $record['datetime']->format('Y-m-d H:i:s'),
        ];

        DB::connection()->table($this->table)->insert($data);
    }

    /**
     * Get the identity of the current logged in user, if available.
     *
     * @return null|string
     */
    protected function currentUser()
    {
        if (Auth::guest())
        {
            return null;
        }

        return Auth::getAuthIdentifier();
    }

}
