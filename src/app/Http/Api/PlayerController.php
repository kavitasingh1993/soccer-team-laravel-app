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
     * @OA\Get(
     *      path="/api/teams/{team}/players",
     *      operationId="getTeamPlayers",
     *      tags={"players"},
     *      summary="Get list of team players",
     *      description="Returns list of team players",
     *      @OA\Parameter(
     *          name="team",
     *          description="team id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       )
     *     )
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

    /**
     * @OA\Post(
     *      path="/api/players",
     *      operationId="storePlayerDetails",
     *      tags={"players"},
     *      summary="Store new player in team",
     *      description="Store new player in team",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass player information to add",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                 @OA\Property(property="firstName", type="string", format="firstName", example="prakash"),
     *                 @OA\Property(property="lastName", type="string", format="lastName", example="chand"),
     *                 @OA\Property(property="playerImageURL", type="string", format="binary", example="testing.jpeg"),
     *                 @OA\Property(property="team_id", type="int", format="team_id", example="1"),
     *            ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Player created successfully")
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
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

    /**
     * @OA\Put(
     *      path="/api/players/{player}",
     *      operationId="updatePlayerDetails",
     *      tags={"players"},
     *      summary="Update existing player detail",
     *      description="Update existing player detail",
     *      @OA\RequestBody(
     *          required=false,
     *          description="Pass player information to update",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                 @OA\Property(property="firstName", type="string", format="firstName", example="prakash"),
     *                 @OA\Property(property="lastName", type="string", format="lastName", example="chand"),
     *                 @OA\Property(property="playerImageURL", type="string", format="binary", example="testing.jpeg"),
     *                 @OA\Property(property="team_id", type="int", format="team_id", example="1"),
     *            ),
     *          ),
     *       ),
     *      @OA\Parameter(
     *          name="player",
     *          description="player id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Player has been updated successfully")
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function updatePlayerDetails(Request $request, Player $player): JsonResponse
    {
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
    /**
     * @OA\Delete(
     *      path="/api/players/{player}",
     *      operationId="deletePlayerDetails",
     *      tags={"players"},
     *      summary="Delete existing player",
     *      description="Deletes player record",
     *      @OA\Parameter(
     *          name="player",
     *          description="player id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Player has been deleted successfully")
     *          )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
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
