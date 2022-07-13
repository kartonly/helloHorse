<?php

use Illuminate\Support\Facades\Route;

Route::get('hi', 'ProductController@hi')->middleware('cors');
