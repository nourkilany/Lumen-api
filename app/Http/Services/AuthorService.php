<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

class AuthorService extends BaseService
{
  public function prepareCreate($data): array
  {
    return [
      'name' =>     $data['name'],
      'email' =>    $data['email'],
      'github' =>   $data['github'],
      'twitter' =>  $data['twitter'],
      'location' => $data['location'],
      'password' => Hash::make($data['password']),
    ];
  }
}
