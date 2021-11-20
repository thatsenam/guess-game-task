<?php

namespace App\Http\Controllers;

use App\Models\GuessGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GamesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function initialize()
    {
        $game_id = $this->generateGameID();
        $generated_number = rand(1, 100);
        session()->put('game_id', $game_id);
        session()->put('generated_number', $generated_number);

        return ['game_id' => $game_id];
    }

    public function guess(Request $request)
    {
        $guess_value = $request->guess_value;
        $generated_value = session()->get('generated_number');
        $game_id = $request->game_id;
        $move_number = $request->move_number;

        if ($guess_value == $generated_value) {
            $computer_answer = "Bingo";
        } elseif ($guess_value < $generated_value) {
            $computer_answer = "Less";
        } else {
            $computer_answer = "More";
        }
        $latest_guess = GuessGame::create(['game_id' => $game_id, 'move_number' => $move_number, 'guess_value' => $guess_value, 'generated_value' => $generated_value, 'computer_answer' => $computer_answer]);
        $guess_history = GuessGame::query()->where('game_id', $game_id)->get();
        return ['latest_guess' => $latest_guess, 'guess_history' => view('partials.guess_history', compact('guess_history'))->render()];

    }

    public function results(Request $request)
    {
        $move_numbers = GuessGame::query()->pluck('move_number')->unique();
        $game_ids = GuessGame::query()->pluck('game_id')->unique();
        $guess_values = GuessGame::query()->pluck('guess_value')->unique();
        $generated_values = GuessGame::query()->pluck('generated_value')->unique();
        $computer_answers = GuessGame::query()->pluck('computer_answer')->unique();

        /* Incoming Filters */
        $filtered_move_number     = $request->move_number;
        $filtered_game_id         = $request->game_id;
        $filtered_guess_value     = $request->guess_value;
        $filtered_generated_value = $request->generated_value;
        $filtered_computer_answer = $request->computer_answer;


        $histories = GuessGame::query()
            ->when($filtered_move_number != null, function ($query) use ($filtered_move_number) {
                return $query->where('move_number', $filtered_move_number);
            })
            ->when($filtered_game_id != null, function ($query) use ($filtered_game_id) {
                return $query->where('game_id', $filtered_game_id);
            })
            ->when($filtered_guess_value != null, function ($query) use ($filtered_guess_value) {
                return $query->where('guess_value', $filtered_guess_value);
            })
            ->when($filtered_generated_value != null, function ($query) use ($filtered_generated_value) {
                return $query->where('generated_value', $filtered_generated_value);
            })
            ->when($filtered_computer_answer != null, function ($query) use ($filtered_computer_answer) {
                return $query->where('computer_answer', $filtered_computer_answer);
            })
            ->paginate(10);

        return view('results', compact('histories', 'move_numbers', 'game_ids', 'guess_values', 'generated_values', 'computer_answers',
            'filtered_move_number', 'filtered_game_id', 'filtered_guess_value', 'filtered_generated_value', 'filtered_computer_answer'));
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
