<?php

namespace App\Console\Commands;

use App\Events\RandomNumber;
use App\Events\RemainingTimeChanged;
use Illuminate\Console\Command;

class gameExecution extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:play';
    private $timer = 15;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to play a game.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        while (true) {
            broadcast(new RemainingTimeChanged($this->timer . 's'));

            $this->timer--;
            sleep(1);

            if ($this->timer === 0) {
                $this->timer = 'Waiting to start';
                broadcast(new RemainingTimeChanged($this->timer));

                broadcast(new RandomNumber(mt_rand(1, 12)));

                sleep(5);
                $this->timer = 15;
            }
        }
    }
}
