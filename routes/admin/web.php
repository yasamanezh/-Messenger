<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

Route::group(['prefix' => 'laravel-filemanager'], function () {

    UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth.admin']], function() {

    Route::prefix('languages')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])->name('translations_ui.index');
        Route::prefix('phrases')->group(function () {
            Route::get('{translation}', [LanguageController::class, 'phrases'])->name('translations_ui.phrases.index');
            Route::get('{translation}/edit/{phrase:uuid}', [LanguageController::class, 'phrase'])->name('translations_ui.phrases.show');
        });
    });
    //======================================= > //dashboard//
    Route::get('/dashboard', App\Http\Livewire\Admin\Home\Index::class)->name('Dashboard');

    //======================================= > //blogs//
    Route::group(['prefix' => 'blogs'], function() {
        Route::get('/', App\Http\Livewire\Admin\Blog\Index::class)->name('admin.blogs');
        Route::get('/add', App\Http\Livewire\Admin\Blog\Add::class)->name('admin.blog.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Blog\Edit::class)->name('admin.blog.edit');
    });
    //======================================= > //post//
    Route::group(['prefix' => 'posts'], function() {
        Route::get('/', App\Http\Livewire\Admin\Post\Index::class)->name('admin.posts');
        Route::get('/add', App\Http\Livewire\Admin\Post\Add::class)->name('admin.post.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Post\Edit::class)->name('admin.post.edit');
    });

    //======================================= > //users//
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', \App\Http\Livewire\Admin\Users\Index::class)->name('admin.users');
        Route::get('/edit/{user}', \App\Http\Livewire\Admin\Users\Edit::class)->name('admin.user.edit');
        Route::get('/Add', \App\Http\Livewire\Admin\Users\Add::class)->name('admin.user.add');
    });

    //=======================================> //role//
    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', App\Http\Livewire\Admin\Role\Index::class)->name('admin.roles');
        Route::get('/add', App\Http\Livewire\Admin\Role\Add::class)->name('admin.role.add');
        Route::get('/edit/{role}', App\Http\Livewire\Admin\Role\Edit::class)->name('admin.role.edit');
    });

    //=======================================> //logs//
    Route::group(['prefix' => 'logs'], function() {
        Route::get('/list', App\Http\Livewire\Admin\LogUser\Index::class)->name('admin.userlogs');
    });
    //=======================================> //ticket//
    Route::group(['prefix' => 'tickets'], function() {
        Route::get('/', App\Http\Livewire\Admin\Ticket\Index::class)->name('admin.tickets');
        Route::get('/add', App\Http\Livewire\Admin\Ticket\Add::class)->name('admin.ticket.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Ticket\Edit::class)->name('admin.ticket.edit');
    });
    //=======================================> //part//
    Route::group(['prefix' => 'parts'], function() {
        Route::get('/', App\Http\Livewire\Admin\Ticket\Part\Index::class)->name('admin.tickets.part');
        Route::get('/add', App\Http\Livewire\Admin\Ticket\Part\Add::class)->name('admin.ticket.part.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Ticket\Part\Edit::class)->name('admin.ticket.part.edit');
    });
    //=======================================> //faq//
    Route::group(['prefix' => 'faqs'], function() {
        Route::get('/', App\Http\Livewire\Admin\Faq\Index::class)->name('admin.faqs');
        Route::get('/add', App\Http\Livewire\Admin\Faq\Add::class)->name('admin.faq.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Faq\Edit::class)->name('admin.faq.edit');
    });
    //=======================================> //Help//
    Route::group(['prefix' => 'helps'], function() {
        Route::get('/', App\Http\Livewire\Admin\Help\Index::class)->name('admin.helps');
        Route::get('/add', App\Http\Livewire\Admin\Help\Add::class)->name('admin.help.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Help\Edit::class)->name('admin.help.edit');
    });
    //=======================================> //pach option//
    Route::group(['prefix' => 'packages/options'], function() {
        Route::get('/', App\Http\Livewire\Admin\Option\Index::class)->name('admin.pack.options');
        Route::get('/add', App\Http\Livewire\Admin\Option\Add::class)->name('admin.pack.option.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Option\Edit::class)->name('admin.pack.option.edit');
    });

    //=======================================> //pachage//
    Route::group(['prefix' => 'packages'], function() {
        Route::get('/', App\Http\Livewire\Admin\Package\Index::class)->name('admin.packs');
        Route::get('/add', App\Http\Livewire\Admin\Package\Add::class)->name('admin.pack.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Package\Edit::class)->name('admin.pack.edit');
    });

    //=======================================> //modules //
    Route::group(['prefix' => 'modules'], function() {
        Route::get('/download', App\Http\Livewire\Admin\Module\Download::class)->name('admin.module.download');
        Route::get('/video', App\Http\Livewire\Admin\Module\Video::class)->name('admin.module.video');
        Route::get('/top-page', App\Http\Livewire\Admin\Module\Top::class)->name('admin.module.top');
        Route::get('/screens', App\Http\Livewire\Admin\Module\Screen::class)->name('admin.module.screen');
        Route::get('/about', App\Http\Livewire\Admin\Module\About::class)->name('admin.module.about');
        Route::get('/customer', App\Http\Livewire\Admin\Module\Customer\Index::class)->name('admin.module.customer');
        Route::get('/packedit', App\Http\Livewire\Admin\Module\Pack::class)->name('admin.module.pack');
        Route::get('/weblog', App\Http\Livewire\Admin\Module\Blog::class)->name('admin.module.blog');
        Route::get('/', App\Http\Livewire\Admin\Module\Index::class)->name('admin.modules');
        Route::get('/feature', App\Http\Livewire\Admin\Module\Featur\Index::class)->name('admin.module.feature');
    });

    //=======================================> //feature options//
    Route::group(['prefix' => 'modules/feature/keys'], function() {
        Route::get('/', App\Http\Livewire\Admin\Module\Featur\Option\Index::class)->name('admin.feature.options');
        Route::get('/add', App\Http\Livewire\Admin\Module\Featur\Option\Add::class)->name('admin.feature.option.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Module\Featur\Option\Edit::class)->name('admin.feature.option.edit');
    });

    //=======================================> //feature options//
    Route::group(['prefix' => 'modules/client/users'], function() {
        Route::get('/', App\Http\Livewire\Admin\Module\Customer\User\Index::class)->name('admin.customer.users');
        Route::get('/add', App\Http\Livewire\Admin\Module\Customer\User\Add::class)->name('admin.customer.user.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Module\Customer\User\Edit::class)->name('admin.customer.user.edit');
    });
    //=======================================> //counter Module//
    Route::group(['prefix' => 'modules/counters'], function() {
        Route::get('/', App\Http\Livewire\Admin\Module\Counter\Index::class)->name('admin.module.counters');
        Route::get('/add', App\Http\Livewire\Admin\Module\Counter\Add::class)->name('admin.module.counter.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Module\Counter\Edit::class)->name('admin.module.counter.edit');
    });
    Route::get('/setting', App\Http\Livewire\Admin\Setting\Index::class)->name('admin.setting');
    Route::get('/socials', App\Http\Livewire\Admin\Social\Index::class)->name('admin.socials');

    Route::group(['prefix' => 'menus'], function() {
        Route::get('/', App\Http\Livewire\Admin\Menu\Index::class)->name('admin.menus');
        Route::get('/add', App\Http\Livewire\Admin\Menu\Add::class)->name('admin.menu.add');
        Route::get('/edit/{id}', App\Http\Livewire\Admin\Menu\Edit::class)->name('admin.menu.edit');
    });
});
