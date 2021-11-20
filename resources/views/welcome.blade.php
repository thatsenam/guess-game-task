@extends('layout')
@section('content')
    <a class="btn btn-outline-primary" href="{{ route('results') }}">Game Board</a>

    <div class="row box  align-items-center justify-content-center">
        <div class="col">
            <img class="bg" src="{{ asset('guess the number bg.png') }}" alt="">
        </div>
        <div class="col ">
            <div class="playButton">
                <img class="playNowButton" src="{{ asset('start_now.gif') }}" alt="">
            </div>
            <div class="loading">
            </div>
            <div class="playground mb-4">

                <h5>A number is generated between 1 and 100. <b> Guess the number</b></h5>
                <form id="guessForm" action="{{ route('check_guess') }}" method="post">
                    @csrf
                    <div class="d-flex">
                        <div class="form-group flex-1 ">
                            <input type="number" class="form-control "
                                   name="guess_value"
                                   id="guess_value"
                                   placeholder="Guess Number">
                        </div>
                        <p class="mx-2">&nbsp</p>
                        <div class="flex-1">

                            <button id="guessButton" class="btn btn-primary ">Guess Now</button>
                            <input type="hidden" name="game_id" id="game_id">
                            <input type="hidden" name="move_number" id="move_number">
                        </div>

                    </div>
                </form>
                <p class="mx-2"></p>
                <p id="guessMessage">&nbsp</p>
                <div id="guessHistory">

                </div>

            </div>
            <div class="won">
                <h2>Bingo. You are right.</h2>
                <img src="https://c.tenor.com/r4wOle0DXuIAAAAC/youre-right-correct.gif" alt="">
                <img class="playAgain" src="{{ asset('play_again.png') }}" alt="">
            </div>

        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('index.js') }}"></script>
@endsection

