<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/{subGate}/tasks')->middleware(['sub_gate', 'auth', 'verified'])->controller(\App\Http\Controllers\Manuscript\TaskController::class)->group(function () {
  Route::get('/invitation', 'indexInvitation')->name('tasks.indexInvitation')->middleware('role:academic-editor, reviewer');
  Route::get('/assignment', 'indexAssignment')->name('tasks.indexAssignment')->middleware('role:editor-assistant,editor-in-chief,academic-editor, reviewer');
  Route::get('/in-progress ', 'indexInProgress')->name('tasks.indexInProgress')->middleware('role:editor-in-chief,academic-editor');
  Route::get('/finalization ', 'indexFinalization')->name('tasks.indexFinalization')->middleware('role:editor-in-chief');
  Route::get('/history', 'indexHistory')->name('tasks.indexHistory')->middleware('role:editor-assistant,editor-in-chief,academic-editor,reviewer');

  Route::get('/{task}', 'show')->name('tasks.show');
  Route::put('/{task}', 'update')->name('tasks.update');
  Route::put('/invitation/{task}', 'invitationDecision')->name('tasks.invitationDecision');
});
