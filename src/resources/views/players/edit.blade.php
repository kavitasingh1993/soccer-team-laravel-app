@extends('layout')

@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-6 text-left">
                <h2>Edit Player</h2>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-primary" href="/teams/{{$player->team_id}}/players"> Back</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('players.update',$player->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        <input type="text" name="firstName" value="{{ $player->firstName }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        <input type="text" name="lastName" value="{{ $player->lastName }}" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Player Image:</strong>
                        <input type="file" name="logoURL" class="form-control" placeholder="image">
                        <img src="/image/{{ $player->playerImageURL }}" class="my-4" width="300px">
                    </div>
                </div>
                 <input type="hidden" name="team_id" value="{{$player->team_id}}" class="form-control" placeholder="">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endsection
