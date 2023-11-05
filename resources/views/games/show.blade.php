@extends('layouts.app')

@push('styles')
<style type="text/css">
@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

    .refresh {
        position: relative;
        /* animation: rotate 4s linear infinite; */
        animation: rotate 1.5s linear infinite;
    }
</style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header">Game</div>

                <div class="card-body">

                   
                    <div class="text-center ">
                        <img id="circle" class="refresh" src="{{ asset('images/circle.png') }}" height="250" width="250">

                        <p id="winner" class="display-1 text-primary"></p>
                    </div>
                    <hr>

                    <div class="text-center">
                        <label class="font-weight-bold h5">Your Bet</label>
                        <select id="bet" class="custom-select col-auto">
                            <option selected>Not in</option>

                            @foreach(range(1, 12) as $number)
                                <option>{{ $number }}</option>
                            @endforeach
                        </select>
                        <hr>
                        <p class=" h5">Remaining Time</p>
                        <p id="timer" class="h5 text-danger"></p>
                        <hr>
                        <p id="result" class="h1"></p>
                    </div>
               
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="module">

    const circleElement =document.getElementById('circle');
    const betElement =document.getElementById('bet');

    const timerElement = document.getElementById('timer');
    const resultElement =document.getElementById('result');
    const winnerElement =document.getElementById('winner');




    Echo.channel('game')

     .listen('RemainingTimeChanged', (e)=>{
   

        timerElement.innerText = e.timer;

        circleElement.classList.add('refresh');

        winnerElement.classList.add('d-none');

        resultElement.innerText = '';
        resultElement.classList.remove('text-success');
        resultElement.classList.remove('text-danger');


    })

    .listen( 'RandomNumber', (e)=>{
        circleElement.classList.remove('refresh');

let winner = e.randomNumber;
winnerElement.innerText = winner;
winnerElement.classList.remove('d-none');

let bet = betElement[betElement.selectedIndex].innerText;

if (bet == winner) {
    resultElement.innerText = 'You WIN';
    resultElement.classList.add('text-success');
} else {
    resultElement.innerText = 'You LOSE';
    resultElement.classList.add('text-danger');
}

    });

    </script>


@endpush