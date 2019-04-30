<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::post("files/upload", "Techlify\FileManager\Controllers\FilesController@upload");

    /* Files Management */
    Route::post("files", "\Techlify\FileManager\Controllers\FilesController@store");
    Route::get("files", "\Techlify\FileManager\Controllers\FilesController@index");
    Route::put("files/{id}", "\Techlify\FileManager\Controllers\FilesController@update");
    Route::get("files/{id}", "\Techlify\FileManager\Controllers\FilesController@show");
    Route::delete("files/{id}", "\Techlify\FileManager\Controllers\FilesController@destroy");
});