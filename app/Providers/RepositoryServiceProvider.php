<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        
        }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot() {
        $this->app->bind(\App\Repositories\Contract\IPhrase::class, \App\Repositories\Elequent\PhraseRepository::class);
        $this->app->bind(\App\Repositories\Contract\INews::class, \App\Repositories\Elequent\NewsRepository::class);
        $this->app->bind(\App\Repositories\Contract\ITranslation::class, \App\Repositories\Elequent\TranslationRepository::class);
        $this->app->bind(\App\Repositories\Contract\IComment::class, \App\Repositories\Elequent\CommentRepository::class);
        $this->app->bind(\App\Repositories\Contract\IContact::class, \App\Repositories\Elequent\ContactRepository::class);
        $this->app->bind(\App\Repositories\Contract\IPage::class, \App\Repositories\Elequent\PageRepository::class);
        $this->app->bind(\App\Repositories\Contract\IMenu::class, \App\Repositories\Elequent\MenuRepository::class);
        $this->app->bind(\App\Repositories\Contract\IFooter::class, \App\Repositories\Elequent\FooterRepository::class);
        $this->app->bind(\App\Repositories\Contract\ISocial::class, \App\Repositories\Elequent\SocialRepository::class);
        $this->app->bind(\App\Repositories\Contract\ISetting::class, \App\Repositories\Elequent\SettingRepository::class);
        $this->app->bind(\App\Repositories\Contract\IModuleOption::class, \App\Repositories\Elequent\ModuleOptionRepository::class);
        $this->app->bind(\App\Repositories\Contract\IModule::class, \App\Repositories\Elequent\ModuleRepository::class);
        $this->app->bind(\App\Repositories\Contract\IPack::class, \App\Repositories\Elequent\PackRepository::class);
        $this->app->bind(\App\Repositories\Contract\IOption::class, \App\Repositories\Elequent\OptionRepository::class);
        $this->app->bind(\App\Repositories\Contract\iBlog::class, \App\Repositories\Elequent\BlogRepository::class);
        $this->app->bind(\App\Repositories\Contract\ILog::class, \App\Repositories\Elequent\LogRepository::class);
        $this->app->bind(\App\Repositories\Contract\IUser::class, \App\Repositories\Elequent\UserRepository::class);
        $this->app->bind(\App\Repositories\Contract\IRole::class, \App\Repositories\Elequent\RoleRepository::class);
        $this->app->bind(\App\Repositories\Contract\Ipart::class, \App\Repositories\Elequent\PartRepository::class);
        $this->app->bind(\App\Repositories\Contract\ITicket::class, \App\Repositories\Elequent\TicketRepository::class);
        $this->app->bind(\App\Repositories\Contract\IPost::class, \App\Repositories\Elequent\PostRepository::class);
        $this->app->bind(\App\Repositories\Contract\IHelp::class, \App\Repositories\Elequent\HelpRepository::class);
        $this->app->bind(\App\Repositories\Contract\IFaq::class, \App\Repositories\Elequent\FaqRepository::class);
   
    }

    /*public function provides() {
        return [
         \App\Repositories\Contract\IComment::class, 
        \App\Repositories\Contract\IContact::class,
        \App\Repositories\Contract\IMenu::class, 
        \App\Repositories\Contract\IFooter::class,
        \App\Repositories\Contract\ISocial::class, 
        \App\Repositories\Contract\ISetting::class,
        \App\Repositories\Contract\IModuleOption::class,
        \App\Repositories\Contract\IModule::class,
        \App\Repositories\Contract\IPack::class,
        \App\Repositories\Contract\IOption::class, 
        \App\Repositories\Contract\iBlog::class,
        \App\Repositories\Contract\IPage::class,
        \App\Repositories\Contract\ILog::class,
        \App\Repositories\Contract\IUser::class, 
        \App\Repositories\Contract\IRole::class,
        \App\Repositories\Contract\Ipart::class,
        \App\Repositories\Contract\ITicket::class,
        \App\Repositories\Contract\IPost::class,
        \App\Repositories\Contract\IHelp::class,
        \App\Repositories\Contract\IFaq::class, 
   
        ];
    }*/

}
