<?php

namespace App\Http\Controllers\Manuscript;

use App\Http\Controllers\Controller;
use App\Models\Manuscript\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller {
  public function search(Request $request, $keyword) {
    if ($request->ajax()) {
      $keywords = Keyword::where('name', 'like', '%' . $keyword . '%')->get();
      $keywords = $keywords->map(function ($keyword) {
        return $keyword->name;
      });
      return response()->json($keywords);
    }
    return abort(404);
  }
}
