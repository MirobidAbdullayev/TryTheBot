<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $this->telegramBotService = $telegramBotService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->telegramBotService->bootEvents();
        $this->telegramBotService->listen();
        return 0;
    }
}
