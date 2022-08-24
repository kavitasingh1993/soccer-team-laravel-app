<?php

namespace Tests\Http\Api;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PlayerControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @return void
     */
    public function testGetTeamPlayers(){
        $team = Team::factory()->count(1)->create();
        $player = Player::factory()->count(1)->create();
        $player_id= $player->toArray()[0]['id'];
        $this->withoutExceptionHandling();
        $payload = [
            'firstName' => "team",
            'lastName'  => "india",
            'playerImageURL' => "testing.png",
            'team_id' => 1,
        ];
        $this->json('GET', 'api/teams/'. $player_id . '/players', $payload)->assertStatus(200);
    }

    /**
     * @return void
     */
    public function testStorePlayerDetails(){
        Storage::fake('local');
        $file = UploadedFile::fake()->create('testing.jpg');
        $payload = [
            'firstName' => "test demo",
            'lastName'  => "india",
            'playerImageURL' => $file,
            'team_id' => 1,
        ];
        $this->json('POST', 'api/players', $payload)->assertStatus(201)
            ->assertJson(['message'=>'Player created successfully']);
    }

    /**
     * @return void
     */
    public function testUpdatePlayerDetails(){
        Storage::fake('local');
        $file = UploadedFile::fake()->create('testing.jpg');
        $player = Player::factory()->count(1)->create();
        $player_id= $player->toArray()[0]['id'];
        $this->withoutExceptionHandling();
        $payload = [
            'firstName' => "test",
            'lastName'  => "india",
            'playerImageURL' => $file,
            'team_id' => 1,
        ];
        $this->json('PUT', 'api/players/'.$player_id, $payload)->assertStatus(204);
    }

    /**
     * @return void
     */
    public function testDeletePlayerDetails(){
        $player = Player::factory()->count(1)->create();
        $player_id= $player->toArray()[0]['id'];
        $this->json('DELETE', 'api/players/' . $player_id, [])
            ->assertStatus(204);
    }
}
