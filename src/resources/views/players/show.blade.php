@extends('layout')

@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-6 text-left">
                <h2> Show Player</h2>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-primary" href="/teams/{{$player->team_id}}/players"> Back</a>
            </div>
        </div>

        <div class="row">
        <div class="col-md-12" style="display:flex;justify-content:space-evenly;">
                <div class="col-md-2">
                    <strong>First Name:</strong>
                </div>
                <div class="col-md-10">
                    {{ $player->firstName }}
                </div>
            </div>
            <div class="col-md-12" style="display:flex;justify-content:space-evenly;">
                <div class="col-md-2">
                    <strong>Last Name:</strong>
                </div>
                <div class="col-md-10">
                    {{ $player->lastName }}
                </div>
            </div>
            <div class="col-md-12" style="display:flex;justify-content:space-evenly;">
                <div class="col-md-2">
                    <strong>Player Image:</strong>
                </div>
                <div class="col-md-10">
                    <img src="/image/{{ $player->playerImageURL }}" width="500px">
                </div>
            </div>
        </div>
    </div>
@endsection
