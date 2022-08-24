@extends('layout')

@section('content')
    <div class="container">
        <div class="row my-2">
            <div class="col-lg-6 text-left">
                <h2> Show Team</h2>
            </div>
            <div class="col-lg-6 text-right">
                <a class="btn btn-primary" href="{{ route('teams.index') }}"> Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="display:flex;justify-content:space-evenly;">
                <div class="col-md-1">
                    <strong>Name:</strong>
                </div>
                <div class="col-md-11">
                    {{ $team->name }}
                </div>
            </div>
            <div class="col-md-12" style="display:flex;justify-content:space-evenly;">
                <div class="col-md-1">
                    <strong>Image:</strong>
                </div>
                <div class="col-md-11">
                    <img src="/image/{{ $team->logoURL }}" width="500px">
                </div>
            </div>
        </div>
    </div>
@endsection
