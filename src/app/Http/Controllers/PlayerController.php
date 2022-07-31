<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\PlayerService;

class PlayerController extends Controller
{
    /**
     * @var PlayerService
     */
    protected $playerService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }


    /**
     * @param Request $request
     * @param Team $team
     * @return Application|Factory|View
     */
    public function getTeamPlayers(Request $request,Team $team)
    {
        $players = $this->playerService->getTeamPlayers($team, $request);
        return view('players.index',compact('players', 'team'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * @param Request $request
     * @param Team $team
     * @return Application|Factory|View
     */
    public function createPlayer(Request $request, Team $team)
    {
        return view('players.create', compact('team'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function storePlayer(Request $request, Team $team): RedirectResponse
    {
        $input = $request->all();
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'playerImageURL' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'team_id'=> 'required',
        ]);

        $playerData =$this->playerService->storePlayerDetails($input);

        if(!$playerData){
            throw new Exception("Player Cannot be Added");
        }

        return redirect("teams/$team->id/players")->with('success', 'Player created successfully.');
    }


    /**
     * @param Player $player
     * @return Application|Factory|View
     */
    public function showPlayer(Player $player)
    {
        return view('players.show',compact('player'));
    }


    /**
     * @param Player $player
     * @return Application|Factory|View
     */
    public function editPlayer(Player $player)
    {
        return view('players.edit',compact('player'));
    }


    /**
     * @param Request $request
     * @param Player $player
     * @return RedirectResponse
     * @throws Exception
     */
    public function updatePlayer(Request $request, Player $player): RedirectResponse
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required'
        ]);

        $input = $request->all();
        if($player->team_id != (int)$request->input('team_id')){
            $input = $request->all();
                throw new Exception("You cannot change Players Team. Please delete player first");
        }
        $player = $this->playerService->updatePlayerDetails($player,$input);

        return redirect("teams/$player->team_id/players")
            ->with('success', 'Player updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Player $player
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroyPlayer(Request $request, Player $player): RedirectResponse
    {
        if(!$player){
            throw new Exception("Player Does not Exist");
        }
        $this->playerService->deletePlayerDetails($player);

        return redirect("teams/$player->team_id/players")
            ->with('success', 'Player deleted successfully');
    }

}
