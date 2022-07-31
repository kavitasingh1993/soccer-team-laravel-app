<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;
use App\Models\Team;
use App\Repositories\TeamRepository;

class TeamService {
    protected $session;
    protected $instance;
    /**
     * @var TeamRepository
     */
    private $team;


    public function __construct(TeamRepository $team)
    {
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getAllTeamDetails(){
        return $this->team->getAllTeamDetails();
    }

    /**
     * @param array $input
     * @return Team
     */
    public function storeTeamDetails(array $input): Team
    {
        if ($image = $input['logoURL']) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['logoURL'] = "$profileImage";
        }

        return $this->team->create($input);
    }

    /**
     * @param array $input
     * @param team $team
     * @return boolean
     */
    public function updateTeamDetails(array $input, Team $team): bool
    {
        if(isset($input['logoURL']) && !empty($input['logoURL'])){
            if ($image = $input['logoURL']) {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['logoURL'] = "$profileImage";
            }else{
                unset($input['logoURL']);
            }
        }

        return $this->team->update($team->id,$input);
    }


    /**
     * @param team $team
     * @return boolean
     */
    public function deleteTeamDetails(Team $team): bool
    {
        return $this->team->delete($team->id);
    }
}
