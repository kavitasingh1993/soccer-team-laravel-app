<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\TeamService;

class TeamController extends Controller
{
    protected $teamService;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(TeamService $teamService)
    {
        $this->teamService = $teamService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    /**
     * @OA\Get(
     *      path="/api/teams",
     *      operationId="getAllTeams",
     *      tags={"teams"},
     *      summary="Get list of teams",
     *      description="Returns list of teams",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function getAllTeams(): JsonResponse
    {
        $teams = $this->teamService->getAllTeamDetails();
        return response()->json($teams,200);
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Post(
     *      path="/api/teams",
     *      operationId="storeTeamDetails",
     *      tags={"teams"},
     *      summary="Store new Team",
     *      description="Returns new team",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass team information to add",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                 @OA\Property(property="name", type="string", format="name", example="team bhutan"),
     *                 @OA\Property(property="logoURL", type="string", format="binary", example="testing.jpeg"),
     *            ),
     *          ),
     *       ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Team has been created successfully")
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
    public function storeTeamDetails(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'logoURL' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $this->teamService->storeTeamDetails($input);

        return response()->json(['message'=>'Team has been created successfully'],201);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Team $team
     * @param Request $request
     * @return JsonResponse
     */

    /**
     * @OA\Put(
     *      path="/api/teams/{team}",
     *      operationId="updateTeamDetails",
     *      tags={"teams"},
     *      summary="Update existing team",
     *      description="Returns updated team",
     *      @OA\RequestBody(
     *          required=false,
     *          description="Pass team information to update",
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                 @OA\Property(property="name", type="string", format="name", example="team bhutan"),
     *                 @OA\Property(property="logoURL", type="string", format="binary", example="testing.jpeg"),
     *                 @OA\Property(property="_method", type="string", format="_method", example="put"),
     *            ),
     *          ),
     *       ),
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
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Team has been updated successfully")
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
    public function updateTeamDetails(Request $request, Team $team): JsonResponse
    {
        $input = $request->all();
        $this->teamService->updateTeamDetails($input,$team);

        return response()->json(['message'=>'Team has been updated successfully'],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return JsonResponse
     * @throws Exception
     */
    /**
     * @OA\Delete(
     *      path="/api/teams/{team}",
     *      operationId="deleteTeamDetails",
     *      tags={"teams"},
     *      summary="Delete existing team",
     *      description="Deletes a record and returns no content",
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
     *          response=201,
     *          description="Successful operations",
     *          @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Team has been deleted successfully")
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
    public function deleteTeamDetails(Team $team): JsonResponse
    {
        if($team->players->count() > 0){
            throw new Exception("You cannot delete team if it has players. Please delete all players first from this team");
        }
        $this->teamService->deleteTeamDetails($team);

        return response()->json(['message'=>'Team has been deleted successfully'],201);
    }
}
