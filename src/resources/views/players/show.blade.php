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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    {{ $player->firstName }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                    <strong>Last Name:</strong>
                    {{ $player->lastName }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Player Image:</strong>
                    <img src="/image/{{ $player->playerImageURL }}" width="500px">
                </div>
            </div>
        </div>
    </div>
@endsection
