<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('welcome')->with('teams', $teams);
    }

    public function show(Request $request,$team_id)
    {
        $input = $request->all();
        $players = DB::table('players')->where('team_id', $team_id)->get();
        $team_name = DB::table('teams')->where('id', $team_id)->value('name');
        return view('playerinfo')->with('players', $players)->with('team_name', $team_name);
    }

}
