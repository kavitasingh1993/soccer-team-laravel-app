@extends('layout')

@section('content')
@auth
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-6 text-left">
                <h2>Add New Player</h2>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-primary" href="/teams"> Back</a>
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

        <form action="/teams/{{$team->id}}/players" method="POST" enctype="multipart/form-data">
            @csrf

             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>First Name:</strong>
                        <input type="text" name="firstName" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Last Name:</strong>
                        <input type="text" name="lastName" class="form-control" placeholder="Name">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Player Image:</strong>
                        <input type="file" name="playerImageURL" class="form-control" placeholder="image">
                    </div>
                </div>
                <input type="hidden" name="team_id" value="{{$team->id}}" class="form-control" placeholder="image">
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
@endauth
    @guest
        <p>Please Login to access the site</p>
    @endguest
@endsection
