<?php

namespace Classes;

class Telegram {
    private $botToken;
    private $chatId;
    private $url;

    public function __construct() {
        $this->botToken = TELEGRAM['bot'];
        $this->chatId = TELEGRAM['chat'];
        $this->url = "https://api.telegram.org/bot{$this->botToken}/sendMessage";
    }

    public function sendNotification($message) {
        $data = array(
            'chat_id' => $this->chatId,
            'text' => $message,
            'parse_mode' => 'Markdown'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
?>
