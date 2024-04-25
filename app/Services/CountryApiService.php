<?php

namespace App\Services;

class CountryApiService {

  public function __construct() {
  }

  public function getCountries() {
    try {
      $client = new \GuzzleHttp\Client();
      $response = $client->request('GET', 'https://restcountries.com/v3.1/all?fields=name,cca3');
      $countries = collect(json_decode($response->getBody(), true));
      return $countries->map(fn ($country) => ['name' => $country['name']['common'], 'code' => $country['cca3']])->sort(fn ($a, $b) => $a['name'] <=> $b['name'])->values();
    } catch (\GuzzleHttp\Exception\BadResponseException  $e) {
      return [];
    }
  }
}
