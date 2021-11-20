<div class="row  bg-white p-4">

    <div class="col ">
        <h5>Greater Than</h5>
        <hr>

    @foreach($guess_history as $history)
            <h5>@if($history->computer_answer == "Less") {{ $history->guess_value }} @endif</h5>
        @endforeach
    </div>

    <div class="col">
        <h5>Less Than</h5>
        <hr>
        @foreach($guess_history as $history)
            <h5>@if($history->computer_answer == "More") {{ $history->guess_value }} @endif</h5>
        @endforeach

    </div>
</div>
