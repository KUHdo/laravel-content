<?php

use Illuminate\Support\Facades\Route;
use KUHdo\Content\Http\Controllers\ContentController;
use KUHdo\Content\Http\Controllers\TextController;

Route::apiResource('contents', ContentController::class);

Route::get('contents/{content}/texts', [TextController::class, 'index'])->name('contents.texts.index');
Route::post('contents/{content}/texts', [TextController::class, 'store'])->name('contents.texts.store');
Route::patch('contents/{content}/texts/{text}', [TextController::class, 'update'])->name('contents.texts.update');
Route::delete('contents/{content}/texts/{text}', [TextController::class, 'destroy'])->name('contents.texts.destroy');
Route::get('texts/{text}', [TextController::class, 'show'])->name('texts.show');
