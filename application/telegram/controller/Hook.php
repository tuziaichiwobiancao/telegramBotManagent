<?php

namespace app\telegram\controller;

use TelegramBot\Api\BotApi;

class Hook extends Base
{
    public function webhook($token = null){
        if($token == null){
            die("token不能为空");
        }
        $bot = new BotApi("asdfa");
        $bot->editMessageReplyMarkup("asdf","asdfa");
    }
}