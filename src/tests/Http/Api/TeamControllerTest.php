<?php

namespace Tests\Http\Api;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testGetAllTeams(){
        $payload = [
            'id' => "1",
            'name'  => "team india",
            'logoURL'      => "testing.png"
        ];
        $response = $this->json('GET', 'api/teams', $payload)->assertStatus(200);
        $this->assertArrayHasKey('data',$response->json());
    }

    /**
     * @return void
     */
    public function testStoreTeamDetails(){
        Storage::fake('local');
        $file = UploadedFile::fake()->create('testing.jpg');
        $payload= ['name'=>'John Doe','logoURL'=>$file];
        $this->json('POST','api/teams',$payload)
            ->assertStatus(201)
            ->assertJson(['message'=>'Team has been created successfully']);
    }
    /**
     * @return void
     */
    public function testUpdateTeamDetails(){
        Storage::fake('local');
        $file = UploadedFile::fake()->create('testing.jpg');
        $team = Team::factory()->count(1)->create();
        $team_id= $team->toArray()[0]['id'];
        $payload= ['name'=>'John Doe','logoURL'=>$file,'_method'=>'put','team_id'=>1];
        $this->json('PUT', 'api/teams/' . $team_id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson(["message" => "Team has been updated successfully"]);
    }

    /**
     * @return void
     */
    public function testDeleteTeamDetails(){
        $team = Team::factory()->count(1)->create();
        $team_id= $team->toArray()[0]['id'];
        $this->json('DELETE', 'api/teams/' . $team_id, [])
            ->assertStatus(201)
            ->assertJson(['message'=>'Team has been deleted successfully']);
    }
}
