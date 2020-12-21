<?php

use Illuminate\Support\Facades\Route;
use Din\ContactUs\Http\Controllers\ContactUsController;

Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact-us');