<?php

namespace App\Http\Controllers;

use App\Library\Tools\Socket;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function client(Request $request)
    {
        $param = ['test'=>'hello'];
        //调用Service
//        $data = Socket::SocketToErp($param, 'thriftCommonCallService', 'invokeMethod');
        $data = Socket::SocketToErp($param, 'thriftCommonCallService', 'invokeMethod');
        return response()->json($data);
    }
}
