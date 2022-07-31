<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Player;
use App\Repositories\PlayerRepository;

class PlayerService {
    /**
     * @var
     */
    protected $session;
    /**
     * @var
     */
    protected $instance;
    /**
     * @var PlayerRepository
     */
    private $player;

    /**
     * @param PlayerRepository $player
     */
    public function __construct(PlayerRepository $player)
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
        return $this->player->getTeamPlayers($team, $request);
    }

    /**
     * @param array $input
     * @return Player
     */
    public function storePlayerDetails(array $input): Player
    {
        if ($image = $input['playerImageURL']) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['playerImageURL'] = "$profileImage";
        }

        return $this->player->create($input);
    }

    /**
     * @param Player $player
     * @param array $input
     * @return player
     */
    public function updatePlayerDetails(Player $player, array $input): Player
    {
        if(isset($input['playerImageURL']) && !empty($input['playerImageURL'])){
            if ($image = $input['playerImageURL']) {
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['playerImageURL'] = "$profileImage";
            }else{
                unset($input['playerImageURL']);
            }
        }
        $this->player->update($player,$input);

        return $player;
    }

    /**
     * @param player $player
     * @return boolean
     */
    public function deletePlayerDetails(Player $player): bool
    {
        return  $this->player->delete($player->id);
    }
}
