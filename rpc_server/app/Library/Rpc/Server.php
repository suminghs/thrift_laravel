<?php
/**
 * Created by PhpStorm.
 * User: CCA
 * Date: 2020/2/10
 * Time: 16:27
 */
namespace App\Library\Rpc;

use App\Library\Thrift\ThriftCommonCallServiceIf;
use App\Library\Thrift\Response;
use App\Services\AuthService;

class Server implements ThriftCommonCallServiceIf
{
    /**
     * 实现 socket 各个service 之间的转发
     * @param string $params
     * @return Response
     * @throws \Exception
     */
    public function invokeMethod($params)
    {
        // 转换字符串 json
        $input = json_decode($params, true);
        // 自己可以实现转发的业务逻辑
        $response = new Response();
        $response->code = 200;
        $response->msg = '';
        $response->data = json_encode($input);
        return $response;
    }
}