<?php

namespace App\Services;

use Askoldex\Teletant\Bot;
use Askoldex\Teletant\UserService;
use Askoldex\Teletant\Context;
use Askoldex\Teletant\Exception\TeletantException;
use App\Models\User;

class TelegramBotService
{
    //private Bot $bot;
    //private UserService $userService;

    public function __construct(Bot $bot, UserService $userService)
    {
        $this->bot = $bot;
        $this->UserService = $userService;
    }

    public function boot(): void
    {
        $this->bootMiddlewares();
        $this->bootEvents();
    }

    public function bootMiddlewares()
    {
        $this->bot->middlewares([
            function (Context $ctx, callable $next){
                $user = $this->userServise->registerTelegramUser($ctx->getUserId());
                $ctx->getContainer()->singleton(User::class, function() use ($user) {
                    return $user;
                });

                $next($ctx);
            }
        ]);
    }

    public function bootEvents()
    {
        $this->bot->onCommand('start', function (Context $ctx, User $user){
            $ctx->replyHTML('Hello' . $user->telegram_id);
        });
    }

    public function polling()
    {
        $this->bot->polling();
    }
}