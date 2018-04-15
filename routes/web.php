<?php

//Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);

Auth::routes();
/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', 'PagesController@homepage');
Route::get('/about', 'PagesController@about');
Route::get('/contact', 'PagesController@contact');
Route::get('/sendEmail', 'PagesController@sendEmail');
Route::post('/contact/sendMessage', 'ContactMessageController@sendMessage');
Route::get('/getValues', 'CryptoCurrencyController@getValues');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

/*
|--------------------------------------------------------------------------
| LOGIN REQUIRED
|--------------------------------------------------------------------------
*/

Route::get('/account', 'UserController@userAccount')->middleware('auth');
Route::post('/userAccountUpdate', 'UserController@userAccountUpdate')->middleware('auth');
Route::post('/submitOrder', 'OrderController@store');

//MESSAGE TO ADMIN
Route::get('/messages', 'MessageController@index')->middleware('auth');
Route::post('/sendMessage', 'MessageController@sendMessage')->middleware('auth');

//EXCHANGE
Route::get('/exchange', 'ExchangeController@index')->middleware('auth');

Route::get('/getWalletForCurrency', 'CurrencyController@getWalletForCurrency');
/*
|--------------------------------------------------------------------------
| BACKEND
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['role:admin']], function() {

//DASHBOARD
    Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

//GENERAL CONFIG
    Route::get('/config', 'GeneralConfigController@edit')->middleware('auth');

//MESSAGES
    Route::get('/dashboardMessages', 'MessageController@dashboardMessages')->middleware('auth');
    Route::get('/dashboardUserMessages', 'MessageController@dashboardUserMessages')->middleware('auth');
    Route::post('/sendMessageReplay', 'MessageController@sendMessageReplay')->middleware('auth');
    Route::post('/getNewMessagesFromUser', 'MessageController@getNewMessagesFromUser')->middleware('auth');

//CURRENCY
    Route::post('/currency', 'CurrencyController@store');
    Route::put('/currency/{id}', 'CurrencyController@update');
    Route::delete('/currency/{id}', 'CurrencyController@destroy');
    Route::get('/currency', 'CurrencyController@index');
    Route::get('/currency/create', 'CurrencyController@create');
    Route::get('/currency/{id}/edit', 'CurrencyController@edit');

//ORDERS
    Route::get('/order', 'OrderController@index');
    Route::get('/order/{order}', 'OrderController@show');

//USERS
    Route::get('/user', 'UserController@index');
    Route::get('/user/create', 'UserController@create');

});

