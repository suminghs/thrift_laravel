<?php
namespace App\Library\Tools;

use App\Library\Thrift\ThriftCommonCallServiceClient;
use Thrift\Protocol\TBinaryProtocol;
use Thrift\Protocol\TMultiplexedProtocol;
use Thrift\Transport\TBufferedTransport;
use Thrift\Transport\TSocket;

class Socket
{
    // 保存对象实例化
    private $_instance;

    // 保存服务连接池
    private static $client = [];

    // 配置文件
    private $config = [];

    private function __construct($type)
    {
        $config = [
            'erp' => [
                'host' => env('ERP_RPC_HOST'),
                'port' => env('ERP_RPC_PORT')
            ]
        ];
        $this->config = $config[$type];
    }

    /**
     * 连接服务
     * @param string $name  调用的方法名
     * @param array $args   1、参数数组 2、具体哪个方法名  3、所属的 Service 名称
     * @return bool
     */
    public static function __callStatic($name, $args)
    {
        if (substr($name, 0, 8) != 'SocketTo') {
            return false;
        }

        $type = strtolower(substr($name, 8));
        // 实例化操作
        if (!isset(self::$client[$type])) {
            self::$client[$type] = new self($type);
        }

        return self::$client[$type]->invoke($args[0],$args[1],$args[2]);
    }

    private function invoke($param,$service,$method)
    {
        try {
            $socket = new TSocket($this->config['host'], $this->config['port']);
            $socket->setRecvTimeout(50000);
            $socket->setDebug(true);
            $transport = new TBufferedTransport($socket, 1024, 1024);
            $protocol = new TBinaryProtocol($transport);
            $thriftProtocol = new TMultiplexedProtocol($protocol, $service);
            $client = new ThriftCommonCallServiceClient($thriftProtocol);
            $transport->open();
            // 拼装参数与类型

            $result = $client->$method(json_encode($param));
            $result->data = json_decode($result->data, true);
            $transport->close();
            return $result;
        } catch (\Exception $Te) {
            app('log')->error('服务连接失败 ', ['host' => $this->config, 'methodName' => $method, 'content' => $Te->getMessage()]);
            return ['host' => $this->config, 'methodName' => $method, 'content' => $Te->getMessage()];
        }
    }
}