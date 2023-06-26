<?php

use Illuminate\Support\Facades\Route;

Route::post('/coinbase/web-hook',[App\Http\Controllers\WebhookController::class, 'index'])->name('coinbase.webhook');
  
Route::group(['middleware' => ['auth']], function() {
    Route::get('/user/dashboard', [App\Http\Controllers\DahboardController::class, 'index'])->name('front.dashoard');
});
Route::get('/user/test', [App\Http\Controllers\DahboardController::class, 'test']);

 
Route::middleware(['App\Http\Middleware\setfactor'])->group(function () {
    Route::get('/', App\Http\Livewire\Front\Home\Index::class)->name('front.home');
    Route::get('/blog/{id?}', App\Http\Livewire\Front\Blog\Blog::class)->name('front.blog');
    Route::get('/post/{id}', App\Http\Livewire\Front\Post\Index::class)->name('front.post');
    Route::get('/page/about', App\Http\Livewire\Front\Page\About::class)->name('front.about');
    Route::get('/page/contact', App\Http\Livewire\Front\Page\Contact::class)->name('front.contact');
    Route::get('/page/help-center', App\Http\Livewire\Front\Page\Faq::class)->name('front.faq');
    Route::get('/page/features', App\Http\Livewire\Front\Page\Feature::class)->name('front.feature');
    Route::get('/page/how-to-work', App\Http\Livewire\Front\Page\Work::class)->name('front.work');
    Route::get('/page/packages', App\Http\Livewire\Front\Page\Pack::class)->name('front.pack');
    Route::get('/getPage/{id}', App\Http\Livewire\Front\Page\Index::class)->name('front.page');
    Route::get('/payment/success', App\Http\Livewire\Front\Checkout\Success::class)->name('front.success');
    Route::get('/payment/cancell', App\Http\Livewire\Front\Checkout\Error::class)->name('front.cancell');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/user/tickets', App\Http\Livewire\Front\Ticket\Index::class)->name('front.ticket');
        Route::get('/user/orders', App\Http\Livewire\Front\Order\Index::class)->name('front.order');
        Route::get('/userTicket/edit/{id}', App\Http\Livewire\Front\Ticket\Edit::class)->name('front.ticket.edit');
        Route::get('/userTicket/add', App\Http\Livewire\Front\Ticket\Add::class)->name('front.ticket.add');
        Route::get('/user/profile', App\Http\Livewire\Front\Profile\Index::class)->name('front.profile');
        Route::get('/{language}/user/tickets', App\Http\Livewire\Front\Ticket\Index::class)->name('front.ticket.language');
        Route::get('/{language}/user/orders', App\Http\Livewire\Front\Order\Index::class)->name('front.order.language');
        Route::get('/{language}/userTicket/edit/{id}', App\Http\Livewire\Front\Ticket\Edit::class)->name('front.ticket.edit.language');
        Route::get('/{language}/userTicket/add', App\Http\Livewire\Front\Ticket\Add::class)->name('front.ticket.add.language');
        Route::get('/{language}/user/profile', App\Http\Livewire\Front\Profile\Index::class)->name('front.profile.language');

        Route::get('/user/checkout/{id}', App\Http\Livewire\Front\Order\Checkout::class)->name('front.checkout');
        Route::post('/user/checkout/redirect/{id}', [App\Http\Controllers\DahboardController::class, 'checkout2'])->name('front.checkout.redirect');
    
        
    });
    Route::get('{language}/', App\Http\Livewire\Front\Home\Index::class)->name('front.home.language');
    Route::get('/{language}/blog/{id?}', App\Http\Livewire\Front\Blog\Blog::class)->name('front.blog.language');
    Route::get('/{language}/post/{id}', App\Http\Livewire\Front\Post\Index::class)->name('front.post.language');
    Route::get('/{language}/page/about', App\Http\Livewire\Front\Page\About::class)->name('front.about.language');
    Route::get('/{language}/page/contact', App\Http\Livewire\Front\Page\Contact::class)->name('front.contact.language');
    Route::get('/{language}/page/help-center', App\Http\Livewire\Front\Page\Faq::class)->name('front.faq.language');
    Route::get('/{language}/page/features', App\Http\Livewire\Front\Page\Feature::class)->name('front.feature.language');
    Route::get('/{language}/page/how-to-work', App\Http\Livewire\Front\Page\Work::class)->name('front.work.language');
    Route::get('/{language}/page/packages', App\Http\Livewire\Front\Page\Pack::class)->name('front.pack.language');
    Route::get('/{language}/getPage/{id}', App\Http\Livewire\Front\Page\Index::class)->name('front.page.language');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::middleware(['auth:sanctum'])->group(function () {
    
});
