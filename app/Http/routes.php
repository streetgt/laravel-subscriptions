<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/plans', 'PlanController@index')->name('plans.index');
    Route::get('/plan/{plan}', 'PlanController@show')->name('plans.show');

    Route::get('/braintree/token', 'BraintreeTokenController@token')->name('braintree.token');

    Route::post('/subscription', 'SubscriptionController@create')->name('subscription.create');

    Route::group(['middleware' => 'subscribed'], function () {
        Route::get('/lessons', 'LessonController@index')->name('lessons.index');

        Route::get('/subscription', 'SubscriptionController@index')->name('subscription.index');
        Route::post('/subscription/cancel', 'SubscriptionController@cancel')->name('subscription.cancel');
        Route::post('/subscription/resume', 'SubscriptionController@resume')->name('subscription.resume');
    });

    Route::group(['middleware' => 'subscribed.pro'], function () {
        Route::get('/lessons/pro', 'LessonController@pro')->name('lessons.pro');
    });

    Route::group(['middleware' => 'customer'], function () {
        Route::get('/invoices', 'InvoiceController@index')->name('invoices.index');
        Route::get('/invoices/{invoiceId}', 'InvoiceController@show')->name('invoices.show');
    });
});

Route::post('/webhook/braintree', 'BraintreeWebhookController@handleWebhook');
