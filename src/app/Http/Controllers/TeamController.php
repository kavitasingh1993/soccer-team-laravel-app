<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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
     * @return Application|Factory|View
     */
    public function getAllTeams()
    {
        $teams = $this->teamService->getAllTeamDetails();
        return view('teams.index',compact('teams'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * @return Application|Factory|View
     */
    public function createTeam()
    {
        return view('teams.create');
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeTeam(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'logoURL' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        $this->teamService->storeTeamDetails($input);

        return redirect()->route('teams.index')
                        ->with('success','Team created successfully.');
    }


    /**
     * @param Team $team
     * @return Application|Factory|View
     */
    public function showTeam(Team $team)
    {
        return view('teams.show',compact('team'));
    }


    /**
     * @param Team $team
     * @return Application|Factory|View
     */
    public function editTeam(Team $team)
    {
        return view('teams.edit',compact('team'));
    }


    /**
     * @param Request $request
     * @param Team $team
     * @return RedirectResponse
     */
    public function updateTeam(Request $request, Team $team): RedirectResponse
    {
        $request->validate([
            'name' => 'required'
        ]);
        $input = $request->all();
        $this->teamService->updateTeamDetails($input,$team);

        return redirect()->route('teams.index')
                        ->with('success','Team updated successfully');
    }


    /**
     * @param Team $team
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroyTeam(Team $team): RedirectResponse
    {
        if($team->players->count() > 0){
            throw new Exception("You cannot delete team if it has players. Please delete all players first from this team");
        }
        $this->teamService->deleteTeamDetails($team);

        return redirect()->route('teams.index')
                        ->with('success','Team deleted successfully');
    }



}
