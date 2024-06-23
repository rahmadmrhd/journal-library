<?php

namespace App\Http\Controllers;

use App\Models\SubGate;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class OrcidController extends Controller {
  /**
   * Mendapatkan token dari ORCID API.
   *
   * Fungsi ini akan mengirimkan permintaan ke ORCID API untuk mendapatkan token
   * berdasarkan `code` yang diberikan oleh ORCID setelah proses otorisasi.
   * Token yang didapatkan akan digunakan untuk mengakses informasi lebih lanjut
   * dari ORCID API.
   *
   * @param  \Illuminate\Http\Request  $request
   */
  private function getToken(Request $request, $scope) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, env('ORCID_TOKEN_LINK'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
      'client_id' => Config::get('orcid.client_id'),
      'client_secret' => Config::get('orcid.client_secret'),
      'grant_type' => 'authorization_code',
      'redirect_uri' => Config::get('orcid.redirect_uri') . '/' . $scope,
      'code' => $request->code,
    ]));

    $headers = [
      'Accept: application/json',
      'Content-Type: application/x-www-form-urlencoded',
    ];
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
      $error = curl_error($ch);
      curl_close($ch);
      return ['error' => $error];
    }
    curl_close($ch);
    $result = json_decode($result);
    return $result;
  }
  public function auth(Request $request, SubGate $subGate) {
    $result = $this->getToken($request, 'auth');
    if (isset($result->error)) {
      return response()->json($result);
    }
    $user = User::where('orcid_id', $result->orcid)->first();
    if (!$user) {
      $splitName = explode(' ', $result->name, 2);
      $user = User::createOrFirst(['orcid_id' => $result->orcid], ['first_name' => $splitName[0], 'last_name' => $splitName[1]]);
      $user->roles()->attach([1, 2]);

      event(new Registered($user));
      return redirect()->route('setting', $subGate->slug)->withFragment('account')->with('message', [
        'status' => 'success',
        'msg' => 'Successfully registered with an orcid account'
      ]);
    }
    Auth::login($user);
    return redirect()->intended(route('dashboard', $subGate->slug, absolute: false));
  }
  public function connect(Request $request, SubGate $subGate) {
    $result = $this->getToken($request, 'connect');
    if (isset($result->error)) {
      return response()->json($result);
    }
    $findOrcid = User::where('orcid_id', $result->orcid)->first();
    if ($findOrcid) {
      return redirect()->route('setting', $subGate->slug)->withFragment('account')->with('message', [
        'status' => 'error',
        'msg' => 'Orcid has been connected to other accounts'
      ]);
    }
    $request->user()->orcid_id = $result->orcid;
    $request->user()->save();
    return redirect()->route('setting', $subGate->slug)->withFragment('account')->with('message', [
      'status' => 'success',
      'msg' => 'Successfully connected to your orcid account'
    ]);
  }

  public function destroy(Request $request, SubGate $subGate) {
    $request->user()->orcid_id = null;
    $request->user()->save();
    return back()->withFragment('account')->with('message', [
      'status' => 'success',
      'msg' => 'Successfully deleted orcid account'
    ]);
  }
}
