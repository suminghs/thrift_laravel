// thrift -r --out ./ --gen php:server Library/thriftSource/thriftCommon.thrift
// thrift -r --out ./ --gen php Library/thriftSource/thriftCommon.thrift
namespace php app.Library.Thrift  # 指定生成什么语言，生成文件存放的目录

// 返回结构体
struct Response {
    1: i32 code;    // 返回状态码
    2: string msg;  // 码字回提示语名
    3: string data; // 返回内容
}

// 服务体
service ThriftCommonCallService {
    // json 字符串参数  客户端请求方法
    Response invokeMethod(1:string params)
}

service LoginService {
	Response login(1:string username, 2:string pwd),
	Response Register(1:string username,2:string pwd),
	Response getCheckCode(1:string sessionid),
	Response verifyCheckCode(1:string sessionid, 2:string checkcode)
}

service UserService {
	Response detail(1:i64 id),
	Response update(1:string params),
}