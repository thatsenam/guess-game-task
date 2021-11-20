@extends('layout')
@section('content')
    <a class="btn btn-outline-primary" href="{{ route('index') }}">Play Game</a>

    <div class="row box  justify-content-center">
        <div class="col">
            <form action="{{ route('results') }}">
                <table class="table table-bordered">
                    <tr>
                        <td>FILTER</td>
                        <th>
                            <select class="form-control" name="game_id" id="game_id">
                                <option value="" selected>--Game ID--</option>
                                @foreach($game_ids as $game_id)
                                    <option value="{{ $game_id }}"
                                            @if($game_id == $filtered_game_id ) selected @endif> {{ $game_id }} </option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select class="form-control" name="move_number" id="move_number">
                                <option value="" selected>--Move Number--</option>

                                @foreach($move_numbers as $move_number)
                                    <option value="{{ $move_number }}"
                                            @if($move_number == $filtered_move_number ) selected @endif> {{ $move_number }} </option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select class="form-control" name="guess_value" id="guess_value">
                                <option value="" selected>--Guess Value--</option>

                                @foreach($guess_values as $guess_value)
                                    <option value="{{ $guess_value }}"> {{ $guess_value }} </option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select class="form-control" name="generated_value" id="generated_value">
                                <option value="" selected>--Generated Value--</option>
                                @foreach($generated_values as $generated_value)
                                    <option value="{{ $generated_value }}"> {{ $generated_value }} </option>
                                @endforeach
                            </select>
                        </th>
                        <th><select class="form-control" name="generated_value" id="computer_answer">
                                <option value="" selected>--Computer Answer--</option>

                                @foreach($computer_answers as $computer_answer)
                                    <option value="{{ $computer_answer }}"> {{ $computer_answer }} </option>
                                @endforeach
                            </select></th>
                    </tr>
                    <tr>
                        <th>SL</th>
                        <th>GAME ID</th>
                        <th>Move Number</th>
                        <th>Guess Value</th>
                        <th>Generated Value</th>
                        <th>Computer Answer</th>
                    </tr>
                    <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ (($histories->currentPage() - 1) * $histories->perPage()) + $loop->iteration }}</td>
                            <td>{{ $history->game_id }}</td>
                            <td>{{ $history->move_number }}</td>
                            <td>{{ $history->guess_value }}</td>
                            <td>{{ $history->generated_value }}</td>
                            <td>{{ $history->computer_answer }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
            {!! $histories->appends(request()->query())->links() !!}
        </div>

    </div>
@endsection
@section('js')
    <script>
        $('select').on('change', function () {
            $('form').submit()
        })
    </script>
@endsection

