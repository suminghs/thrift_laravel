<?php
namespace app\Library\Thrift;

/**
 * Autogenerated by Thrift Compiler (0.12.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;

interface LoginServiceIf
{
    /**
     * @param string $username
     * @param string $pwd
     * @return \app\Library\Thrift\Response
     */
    public function login($username, $pwd);
    /**
     * @param string $username
     * @param string $pwd
     * @return \app\Library\Thrift\Response
     */
    public function Register($username, $pwd);
    /**
     * @param string $sessionid
     * @return \app\Library\Thrift\Response
     */
    public function getCheckCode($sessionid);
    /**
     * @param string $sessionid
     * @param string $checkcode
     * @return \app\Library\Thrift\Response
     */
    public function verifyCheckCode($sessionid, $checkcode);
}
