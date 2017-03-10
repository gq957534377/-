<?php
/**
 * Created by PhpStorm.
 * User: 郭庆
 * Date: 2017-03-10
 * Time: 16:28
 */

namespace App;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;

class Common
{
    /**
     * 返回七牛upToken
     * @return mixed
     * @author guoqing
     */
    public static function getToken()
    {
        // 需要填写你的 Access Key 和 Secret Key
//        $accessKey = 'c_M1yo7k90djYAgDst93NM3hLOz1XqYIKYhaNJZ4';
//        $secretKey = 'Gb2K_HZbepbu-A45y646sP1NNZF3AqzY_w680d5h';

        // 构建鉴权对象
        $auth = new Auth(QINIU_ACCESS_KEY, QINIU_SECRET_KEY);

        // 要上传的空间
        $bucket = QINIU_BUCKET;

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);
        return $token;
    }
}