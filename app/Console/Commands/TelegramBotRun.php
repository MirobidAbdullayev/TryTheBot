<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TelegramBotService;

class TelegramBotRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:bot:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Telegram bot runner';

    //protected TelegramBotService $telegramBotService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TelegramBotService $telegramBotService)
    {
        $this->telegramBotService = app(TelegramBotService::class);
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->telegramBotService->boot();
        $this->comment('Telegram bot started');
        $this->telegramBotService->polling();
        return 0;
    }
}
