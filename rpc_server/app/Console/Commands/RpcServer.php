<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SocketController;
use App\Library\Rpc\Server;
use App\Library\Thrift\ThriftCommonCallServiceProcessor;
use Thrift\Exception\TException;
use Thrift\Factory\TBinaryProtocolFactory;
use Thrift\Factory\TTransportFactory;
use Thrift\Server\TServerSocket;
use Thrift\Server\TSimpleServer;
use Thrift\TMultiplexedProcessor;

class RpcServer extends Command
{
    /**
     * 控制台命令 signature 的名称。
     *
     * @var string
     */
    protected $signature = 'server:rpc';

    /**
     * 控制台命令说明。
     *
     * @var string
     */
    protected $description = 'rpc 服务';

    protected static $socketController;

    /**
     * rpcServer constructor.
     * @param SocketController $socketController
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 执行控制台命令。
     *
     * @return mixed
     */
    public function handle()
    {
//        self::$socketController->server();
        try {
            $thriftProcessor = new ThriftCommonCallServiceProcessor(new Server());
            $tFactory = new TTransportFactory();
            $pFactory = new TBinaryProtocolFactory(true, true);
            $processor = new TMultiplexedProcessor();
            // 注册服务
            $processor->registerProcessor('thriftCommonCallService', $thriftProcessor);

            // 监听开始
            $transport = new TServerSocket('127.0.0.1', 9999);
            $server = new TSimpleServer($processor, $transport, $tFactory, $tFactory, $pFactory, $pFactory);
            $server->serve();
        } catch (TException $te) {
            app('log')->error('socket 服务启动失败', ['content' => $te->getMessage()]);
        }
    }
}
