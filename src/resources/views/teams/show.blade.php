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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $team->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <img src="/image/{{ $team->logoURL }}" width="500px">
                </div>
            </div>
        </div>
    </div>
@endsection
