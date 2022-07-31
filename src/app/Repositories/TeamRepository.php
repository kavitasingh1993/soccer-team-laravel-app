<?php

namespace App\Repositories;

use App\Models\Team;

class TeamRepository
{

    /**
     * @var Team
     */
    protected $team;

    /**
     * @param Team $team
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return mixed
     */
    public function getAllTeamDetails(){
        return $this->team::oldest()->paginate(5);
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->team->create($attributes);
    }

    /**
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes)
    {
        return $this->team->find($id)->update($attributes);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function delete(int $id)
    {
        return $this->team->find($id)->delete();
    }
}
