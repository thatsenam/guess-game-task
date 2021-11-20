<?php

namespace App\Console\Commands;

use App\Models\GuessGame;
use Illuminate\Console\Command;

class GamesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'guess_game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Guess the number';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $generated_value = rand(1, 100);
        $game_id = $this->generateGameID();
        $this->info("A number between 1-100 is generated. Guess the number.");
        $continue = true;
        $move_number = 1;
        while ($continue) {
            $guess_value = $this->ask("Guess Value?");

            if ($guess_value > $generated_value) {
                $computer_answer = "More";
            } elseif ($guess_value < $generated_value) {
                $computer_answer = "Less";
            } else {
                $computer_answer = "Bingo";
                $continue = false;
            }
            GuessGame::create(['game_id' => $game_id, 'move_number' => $move_number, 'guess_value' => $guess_value,
                'generated_value' => $generated_value, 'computer_answer' => $computer_answer]);
            $move_number++;

        }
        return Command::SUCCESS;
    }

    function generateGameID()
    {
        $number = mt_rand(1000000, 9999999);
        if ($this->gameIdNumberExists($number)) {
            return $this->generateGameID();
        }
        return $number;
    }

    function gameIdNumberExists($number)
    {
        return GuessGame::whereGameId($number)->exists();
    }

}
