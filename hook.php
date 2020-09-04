<?php

require_once "vendor/autoload.php";

try {
    $bot = new \TelegramBot\Api\Client('---------');

    $bot->command('call', function ($message) use ($bot) {
        
        $resendto = -0000;
        $allowed = array(-0000, 000);
        $a = 0;

        if (in_array($message->getChat()->getId(), $allowed) or in_array($message->getFrom()->getId(), $allowed)) $a = 1;
        
        if ((strlen($message->getText())>6) && ($message->getText()!='/call@BotPereDast_bot') && ($message->getChat()->getId() != $resendto)) {
		if ($a == 1) {
		    $bot->sendMessage($resendto, str_replace('/call ', 'Вам тут из соседнего чатика @'. $message->getFrom()->getUsername() .' просит передать следующее:'.PHP_EOL,  $message->getText()));
		    $bot->sendMessage($message->getChat()->getId(), 'Передано!', null, false, $message->getMessageId());
		}
        else $bot->sendMessage($message->getChat()->getId(), 'Бот не авторизован пересылать сообщения из этого канала.');
        }

    });

    $bot->command('getid', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'Код этого чата: '.$message->getChat()->getId());
    });

	$bot->command('ping', function ($message) use ($bot) {
        $bot->sendMessage($message->getChat()->getId(), 'pong!');
    });
    
    $bot->run();

} catch (\TelegramBot\Api\Exception $e) {
    $e->getMessage();
}

?>
