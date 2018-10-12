<?php
class Smser
{
    static $acsClient = null;
    /**
     * 取得AcsClient
     *
     * @return DefaultAcsClient
     */
    public static function getAcsClient() {
        $product = "Dysmsapi";
        $domain = "dysmsapi.aliyuncs.com";
        $accessKeyId = "LTAIugDkfUvkpCYp"; // AccessKeyId
        $accessKeySecret = "3ETgb7i0tr2zVcJBGq5WWV46zDg5OQ"; // AccessKeySecret
        $region = "cn-hangzhou";
        $endPointName = "cn-hangzhou";

        if(static::$acsClient == null) {
            $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
            DefaultProfile::addEndpoint($endPointName, $region, $product, $domain);
            static::$acsClient = new DefaultAcsClient($profile);
        }
        return static::$acsClient;
    }
    /**
     * 发送短信
     * @return stdClass
     */
    public static function sendSms($mobi,$temp,$temp_arr,$smsoutid) {
        $request = new SendSmsRequest();
        //可选-启用https协议
        //$request->setProtocol("https");
        // 必填，设置短信接收号码
        $request->setPhoneNumbers($mobi);
        $request->setSignName("粮安益祥");
        $request->setTemplateCode($temp);
        //设置模板参数, 假如模板中存在变量需要替换则为必填项
        $request->setTemplateParam(json_encode($temp_arr, JSON_UNESCAPED_UNICODE));
        //设置流水号
        $request->setOutId($smsoutid);
        //选填，上行短信扩展码（扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段）
        $request->setSmsUpExtendCode("1234567");

        $acsResponse = static::getAcsClient()->getAcsResponse($request);
        return $acsResponse;
    }
}

function ClientGetIP(){
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return($ip);
}
function getTempCode($type){
    if(empty($type)){
        $temp_arr[$type] = '';
    }else{
        $temp_arr['reg'] = 'SMS_147200552';//注册，验证码
        $temp_arr['rsp'] = 'SMS_147195982';//重置密码，验证码
        $temp_arr['lgn'] = 'SMS_147200981';//登录，验证码
        if(empty($temp_arr[$type]))$temp_arr[$type] = '';
    }
    return $temp_arr[$type];
}
if(ClientGetIP()=='127.0.0.1'){

    ini_set("display_errors", "on");
//    require_once dirname(__DIR__) . '/api_sdk/vendor/autoload.php';
    die(dirname(__DIR__) . '/dysms/api_sdk/vendor/autoload.php');

    // 加载区域结点配置
    Config::load();
    $mobi=empty($_POST['mobile'])?'':$_POST['mobile'];
    $temp=getTempCode($_POST['type']);
    $code=empty($_POST['code'])?'':$_POST['code'];
    $err=array();
    switch ($type) {
        default:
            if(empty($mobi))$err[]='err_mobile,';
            if(empty($temp))$err[]='err_type,';
            if(empty($code)){
                $err[]='err_code';
            }else{
                $temp_arr = array("code"=>$code);
            }
            break;
    }
    if(empty($err)){
        $smsoutid = $type.time();
        $response = Smser::sendSms($mobi,$temp,$temp_arr,$smsoutid);
        print_r($response);
        /*stdClass Object
        (
            [Message] => OK
            [RequestId] => 189473F1-B52D-480F-B349-1EA3C32AC033
            [BizId] => 906205439313144455^0
            [Code] => OK
        )*/
    }else{
        print_r($err);
    }
}else{
    echo 'err_post';
}


// 调用示例：
//set_time_limit(0);
//header('Content-Type: text/plain; charset=utf-8');

//$response = Smser::sendSms();
//echo "发送短信(sendSms)接口返回的结果:\n";
//print_r($response);