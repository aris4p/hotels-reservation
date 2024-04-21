<?php

use App\Livewire\Kamar;
use App\Livewire\Login;
use App\Livewire\Dashboard;
use App\Livewire\Pelanggan;
use App\Livewire\Reservation;
use App\Livewire\Transaksi;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'guest'], function(){

    

    Route::get('/', function () {
        return view('index');
    })->name('login');

    Route::get('/reservasi', Reservation::class)->name('reservasi');
   

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/kamar', Kamar::class)->name('kamar');
    Route::get('/pelanggan', Pelanggan::class)->name('pelanggan');
    Route::get('/transaksi', Transaksi::class)->name('transaksi');
    Route::get('/logout', Login::class)->name('logout');

    
});

