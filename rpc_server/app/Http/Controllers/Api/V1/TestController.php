<?php

namespace app\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\BaseController;

class TestController extends BaseController
{

    /**
     * @OA\Get(
     *     path="/test",
     *     tags={"测试"},
     *     @OA\Response(
     *         response=200,
     *         description="result"
     *     ),
     *     security={
     *         {"passport": {}},
     *     }
     * )
     */
    public function test(){
        return json_success_return();
    }

}