<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Askoldex\Teletant\Bot;
use Askoldex\Teletant\Settings;

class TelegramBotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Bot::class, function (){
            $settings = new Settings(config('telegram.bot.token'));
            $settings->setHookOnFirstRequest(
                (bool)config('telegram.bot.hook_on_first_request')
            );
            return $settings;
        });

        $this->app->singleton(Bot::class, function(){
            return new Bot(app(Settings::class));
        });
    }
}
