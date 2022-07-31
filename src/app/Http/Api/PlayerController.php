<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use Exception;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function getTeamPlayers(Request $request, Team $team): JsonResponse
    {
        $players = $this->playerService->getTeamPlayers($team, $request);
         return response()->json($players,200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function storePlayerDetails(Request $request): JsonResponse
    {
        $input = $request->all();
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'playerImageURL' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'team_id'=> 'required',
        ]);

        $playerData =$this->playerService->storePlayerDetails($input);
        $team_id = $request->input('team_id');
        if(!$playerData){
            throw new Exception("Player Cannot be Added");
        }
        return response()->json(['message'=>'Player created successfully'],201);
    }


    /**
     * @param Request $request
     * @param Player $player
     * @return JsonResponse
     * @throws Exception
     */
    public function updatePlayerDetails(Request $request, Player $player): JsonResponse
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required'
        ]);
        $input = $request->all();
        $this->playerService->updatePlayerDetails($player,$input);

        return response()->json(['message'=>'Player has been updated successfully'],201);
    }


    /**
     * @param Request $request
     * @param Player $player
     * @return JsonResponse
     * @throws Exception
     */
    public function deletePlayerDetails(Request $request, Player $player): JsonResponse
    {
        if(!$player){
            throw new Exception("Player Does not Exist");
        }
        $this->playerService->deletePlayerDetails($player);
        $team_id = $request->input('team_id');

        return response()->json(['message'=>'Player has been deleted successfully'],201);
    }

}
