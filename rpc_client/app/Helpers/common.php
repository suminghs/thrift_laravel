<?php

function json_success_return($arr = array(), $msg = 'success',$status_code=200)
{
    $result = array(
        'code' => 200,
        'msg' => $msg,
        'data' => $arr
    );
    return response($result,$status_code);
}

function json_fail_return($msg, $code = 400,$status_code=400)
{
    $result = array(
        'code' => $code,
        'msg' => $msg,
    );
    return response($result,$status_code);
}