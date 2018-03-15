<?php

Route::get('/health/status', "Laravel\Health\Http\Controllers\HealthCheckerController@index");
Route::get('/health/{checker}/status', "Laravel\Health\Http\Controllers\HealthCheckerController@show");
