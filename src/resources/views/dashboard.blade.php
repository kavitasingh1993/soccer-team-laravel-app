@extends('layout')

@section('content')
@auth
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <p>Soccer is a team sport played by a team of <strong>11 players</strong> against another team of 11 players on a field. The team has one designated goalkeeper and 10 outfield players. Outfield players are usually specialised in attacking or defending or both.</p>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <img src="{{URL::asset('/image/soccer_team.jpg')}}" alt="Soccer Team" height="300" width="300">
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('teams.index') }}"> Team information</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth
    @guest
        <p>Please Login to access the site</p>
    @endguest
@endsection
