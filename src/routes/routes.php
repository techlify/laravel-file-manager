<?php

Route::group(['prefix' => 'api', 'middleware' => 'api'], function()
{
    Route::post("techlify-files/upload", "Techlify\FileManager\Controllers\FilesController@upload");

    /* Files Management */
    Route::post("techlify-files", "\Techlify\FileManager\Controllers\FilesController@store");
    Route::get("techlify-files", "\Techlify\FileManager\Controllers\FilesController@index");
    Route::put("techlify-files/{id}", "\Techlify\FileManager\Controllers\FilesController@update");
    Route::get("techlify-files/{id}", "\Techlify\FileManager\Controllers\FilesController@show");
    Route::delete("techlify-files/{id}", "\Techlify\FileManager\Controllers\FilesController@destroy");
});