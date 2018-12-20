<?php
// 应用公共文件
function getToken()
{
    //先查看文件里是否有token并且没过期
    $token_info = file_get_contents('token.php');
    //print_r($token_info);die();
    if($token_info)
    {
        $token_info = substr($token_info,15);
        $token_info = json_decode($token_info,1);
        if($token_info['expire_time'] <= time())
        {
            $new_token = getLineToken();
            if($new_token)
            {
                $new_tokens = putFile($new_token);
                return $new_tokens['access_token'];
            }
        }else{
            return $token_info['access_token'];
        }
    }else{
        $new_token = getLineToken();
        if($new_token)
        {
            $new_tokens = putFile($new_token);
            return $new_tokens['access_token'];
        }
    }
}

function putFile($new_token)
{
    $new_tokens = json_decode($new_token,1);
    $json['expire_time'] = 7100+time();
    $json['access_token'] = $new_tokens['access_token'];
    $jsons = json_encode($json);
    $jsons = '<?php exit();?>'.$jsons;
    file_put_contents('token.php', $jsons);
    //     $f = fopen('token.php','w+');
    //     fwrite($f, $jsons);
    //     fclose($f);
    return $new_tokens;
}
function getLineToken()
{
    $appid = config('param.appid');
    $appsecret = config('param.appsecret');
    $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
    $new_token = wx_curl($url);
    return $new_token;
}

function wx_curl($url,$params=false,$ispost=0){
    $httpInfo = array();
    $ch = curl_init();
    //设置协议版本
    curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
    //设置代理
    curl_setopt( $ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22' );
    //设置连接超时时间(连接之后)
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 30 );
    //设置最大延迟时间(连接以前)
    curl_setopt( $ch, CURLOPT_TIMEOUT , 30);
    //CURLOPT_RETURNTRANSFER为true,不直接输出
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
    //ssl证书检查,这里如果设置1或者true,出现报错,
    //PHP Notice: curl_setopt(): CURLOPT_SSL_VERIFYHOST with value 1 is deprecated and will be removed as of libcurl 7.28.1. It is recommended to use value 2 instead
    //请把值改为2,curl的版本问题
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);
    //        curl_setopt($ch,CURLOPT_CAINFO,'./cacert.pem');
    //        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //        curl_setopt($ch,CURLOPT_CAINFO,'./cacert.pem');
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    //ssl证书检查
    if( $ispost )
    {
        curl_setopt( $ch , CURLOPT_POST , true );
        curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
        curl_setopt( $ch , CURLOPT_URL , $url );
    }
    else
    {
        if($params){
            curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
        }else{
            curl_setopt( $ch , CURLOPT_URL , $url);
        }
    }
    $response = curl_exec( $ch );
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
    $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
    curl_close( $ch );
    return $response;
}
/**
 * @param unknown $_FILE[]对应的name
 * @param unknown $put_file_name 存入哪个文件名
 * @return multitype:number NULL
 */
function upload($name,$put_file_name,$size = 1024000,$ext = 'jpg,png')
{
    // 获取表单上传文件 例如上传了001.jpg
    $file = request()->file($name);
    // 移动到框架应用根目录/uploads/ 目录下
    $info = $file->validate(['size'=>$size,'ext'=>$ext])->move( 'uploads/'.$put_file_name);
    if($info){
        // 成功上传后 获取上传信息
        // 输出 jpg
        //         echo $info->getExtension();
        //         // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        //         echo $info->getSaveName();
        //         // 输出 42a79759f284b767dfcb2a0197904287.jpg
        //         echo $info->getFilename();
        return ['code'=>1,'url'=>$info->getSaveName()];
    }else{
        // 上传失败获取错误信息
        //echo $file->getError();
        return ['code'=>-1,'msg'=>$file->getError()];
    }
}








