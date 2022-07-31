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
    public function getAllTeams(): JsonResponse
    {
        $teams = $this->teamService->getAllTeamDetails();
        return response()->json($teams,200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return JsonResponse
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
    public function deleteTeamDetails(Team $team): JsonResponse
    {
        if($team->players->count() > 0){
            throw new Exception("You cannot delete team if it has players. Please delete all players first from this team");
        }
        $this->teamService->deleteTeamDetails($team);

        return response()->json(['message'=>'Team has been deleted successfully'],201);
    }
}
