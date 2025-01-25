<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleSheetService
{
  protected $accessToken;

  public function __construct(string $accessToken)
  {
    $this->accessToken = $accessToken;
  }

  public function appendRow(array $values, string $spreadsheetId, string $range)
  {
    $url = "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$range}:append?valueInputOption=RAW";

    $response = Http::withHeaders([
      'Authorization' => "Bearer {$this->accessToken}",
      'Content-Type' => 'application/json',
    ])->post($url, [
      'values' => [$values],
    ]);

    return $response;
  }
}
