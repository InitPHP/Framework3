<?php
use InitPHP\Framework\HTTP\Route;


Route::get('/', [\App\HTTP\Controllers\Welcome::class, 'index'])->name('home');
