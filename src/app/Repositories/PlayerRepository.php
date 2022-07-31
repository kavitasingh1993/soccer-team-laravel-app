<?php

namespace App\Repositories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PlayerRepository
{

    /**
     * @var Player
     */
    protected $player;

    /**
     * @param Player $player
     */
    public function __construct(Player $player)
    {
        $this->player = $player;
    }


    /**
     * @param Team $team
     * @param Request $request
     * @return Collection
     */
    public function getTeamPlayers(Team $team, Request $request): Collection
    {
          $players = $team->players();

          if ($request->searchPlayer){
              $players->where('firstName', 'Like', '%' .trim($request->searchPlayer) . '%')
              ->orWhere('lastName', 'Like', '%' .trim($request->searchPlayer) . '%');
          }

          return $players->get();
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->player->create($attributes);
    }

    /**
     * @param $player
     * @param array $attributes
     * @return mixed
     */
    public function update($player, array $attributes)
    {
        return $this->player->find($player->id)->update($attributes);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->player->find($id)->delete();
    }
}
