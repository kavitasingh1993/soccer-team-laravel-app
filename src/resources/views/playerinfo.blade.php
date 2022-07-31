<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Player Details</title>
</head>
<body>
    <div class="container">
        <h3>Players of team {{$team_name}}</h3>
        <div class="panel-group">
        @if (count($players) >= 1)
            @foreach($players as $player)
                <div class="panel panel-default">
                <div class="panel-heading"> {{$player->firstName}} {{$player->lastName}} </div>
                <div class="panel-body"> <img src="/image/{{ $player->playerImageURL }}" width="100px"></div>
                </div>
            @endforeach 
        @else
            <h5>No Players Added in this team yet</h5>
        @endif              
        
        </div>
    </div>
    
</body>
</html>