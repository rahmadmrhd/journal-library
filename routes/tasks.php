<?php

use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->middleware(['auth', 'verified', 'role:reviewer,editor-in-chief,editor-assistant,academic-editor'])->controller(\App\Http\Controllers\Manuscript\TaskController::class)->group(function () {
  Route::get('/invitation', 'indexInvitation')->name('tasks.indexInvitation');
  Route::get('/assignment', 'indexAssignment')->name('tasks.indexAssignment');
  Route::get('/in-progress ', 'indexInProgress')->name('tasks.indexInProgress');
  Route::get('/history', 'indexHistory')->name('tasks.indexHistory');

  Route::get('/{task}', 'show')->name('tasks.show');
  Route::put('/{task}', 'update')->name('tasks.update');
});
