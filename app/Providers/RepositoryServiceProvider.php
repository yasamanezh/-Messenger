<?php

namespace app\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contract\{
   iBlog ,ILog ,IUser , IRole,Ipart,ITicket,IPost,IHelp,IFaq,IPack,IOption,IModule,IModuleOption
   ,ISetting,ISocial,IMenu
};
use App\Repositories\Elequent\{
    BlogRepository,RoleRepository,LogRepository,UserRepository,PartRepository,
    TicketRepository,PostRepository,HelpRepository,FaqRepository
    ,PackRepository,OptionRepository,ModuleRepository,ModuleOptionRepository,SettingRepository
    ,SocialRepository,MenuRepository
    
};




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IMenu::class ,MenuRepository::class);
        $this->app->bind(ISocial::class ,SocialRepository::class);
        $this->app->bind(ISetting::class ,SettingRepository::class);
        $this->app->bind(IModuleOption::class ,ModuleOptionRepository::class);
        $this->app->bind(IModule::class ,ModuleRepository::class);
        $this->app->bind(IPack::class ,PackRepository::class);
        $this->app->bind(IOption::class ,OptionRepository::class);
        $this->app->bind(iBlog::class ,BlogRepository::class);
        $this->app->bind(ILog::class ,LogRepository::class);
        $this->app->bind(IUser::class ,UserRepository::class);
        $this->app->bind(IRole::class ,RoleRepository::class);
        $this->app->bind(Ipart::class ,PartRepository::class);
        $this->app->bind(ITicket::class ,TicketRepository::class);
        $this->app->bind(IPost::class ,PostRepository::class);
        $this->app->bind(IHelp::class ,HelpRepository::class);
        $this->app->bind(IFaq::class ,FaqRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
       
    }
}
