<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
  protected $token;

  public function __construct($token)
  {
    $this->token = $token;
  }

  protected function sendRequest($method, $parameters = [])
  {
    $url = "https://api.telegram.org/bot{$this->token}/{$method}";
    $response = Http::post($url, $parameters);

    if ($response->successful()) {
      return $response->json();
    } else {
      Log::error("Telegram API error: {$response->body()}");
      return null;
    }
  }

  public function sendMessage($chatId, $message)
  {
    return $this->sendRequest('sendMessage', [
      'chat_id' => $chatId,
      'text' => $message,
      'parse_mode' => 'HTML',
    ]);
  }
}
