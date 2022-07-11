<?php

namespace App\Services;

class UserService
{
    public function registerTelegramUser(int $telegramId): User
    {
        return User::firstOrCreate([
            'telegram_id' => $telegramId
        ]);
    }
}