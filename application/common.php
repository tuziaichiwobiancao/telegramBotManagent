<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 删除TelegramHook信息
 * @param string $token 机器人token
 * @return boolean
 */
if(function_exists("deleteHook")){
    function deleteHook($token){
        $url = "https://api.telegram.org/bot{$token}/deletewebhook";
        $result = json_decode(file_get_contents($url),true);
        if($result["ok"] == false){
            throw new DeleteErrorException($result["description"]);
        }
        return true;
    }
}
/**
 * 设置TelegramHook信息
 * @param string $token 机器人token
 * @param string $url 机器人hook链接
 * @return boolean
 */
if(function_exists("setWebHook")){
    function setWebHook($token,$url){
        $url = "https://api.telegram.org/bot{$token}/setwebhook?url={$url}";
        $result = json_decode(file_get_contents($url),true);
        if($result["ok"] == false){
            throw new SetErrorException($result["description"]);
        }
        return true;
    }
}
/**
 * 获取机器人信息
 * @param string $token 机器人token
 * @return array
 */
if(function_exists("getMe")){
    function getMe($token){
        $url = "https://api.telegram.org/bot{$token}/getme";
        $result = json_decode(file_get_contents($url),true);
        if($result["ok"] == false){
            throw new MeErrorException($result["description"]);
        }
        $arr = [
            "id" => $result["result"]["id"],                            //机器人id
            "nick" => $result["result"]["first_name"],                  //机器人昵称
            "username" => $result["result"]["username"],                //机器人用户名
            "url" => "https://t.me/".$result["result"]["username"],     //机器人链接
        ];
        return $arr;
    }
}
/**
 * 发送机器人信息
 * @param Object $bot 实例化的机器人
 * @param int $id 群组或者用户或者频道id
 * @param string $message 要发送的消息支持html
 * @param array $arr 按钮数组(可以为空)
 * @return boolean
 */
if(function_exists("sendMessage")){
    function sendMessage($bot,$id,$message,$arr = null){
        $result = null;
        if($arr == null){
            $result = $bot->sendMessage($id,$message,"HTML",true);
        }else {
            $keyboard = new \TelegramBot\Api\Types\Inline\InlineKeyboardMarkup($arr);
            $result = $bot->sendMessage($id, $message, "HTML", true, null, $keyboard);
        }
        if($result){
            return true;
        }else{
            return false;
        }
    }
}