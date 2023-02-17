<?php

use App\Http\Controllers\documents\DocumentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DocumentsController::class, 'index'])->name('index.document');
Route::get('documento/crear', [DocumentsController::class, 'create'])->name('create.document');
Route::post('documento/guardar', [DocumentsController::class, 'save'])->name('save.document');
Route::get('documento/editar/{data}', [DocumentsController::class, 'edit'])->name('edit.document');
Route::put('documento/actualizar/{id}', [DocumentsController::class, 'update'])->name('update.document');
Route::delete('documento/eliminar/{id}', [DocumentsController::class, 'delete'])->name('delete.document');
Route::get('documento/ver/{data}', [DocumentsController::class, 'preview'])->name('preview.document');


