<?php

namespace Tests\Feature\Api;

use App\Models\Skill;
use Tests\ApiTest;

class SkillTest extends ApiTest
{
    public function test_fetching_all_skills_successfully()
    {
        $response = $this->getJson("{$this->path_prefix}/skills");
        $response->assertOk();
        $response->assertJsonStructure(['data', 'message']);
        $response->assertJsonCount(6, 'data');
    }

    public function test_fetching_all_skills_when_none_exist()
    {
        $this->flushSkills();
        $response = $this->getJson("{$this->path_prefix}/skills");
        $response->assertNotFound();
        $response->assertJson([
            'data' => [],
            'message' => "Could not fetch any skills as the table is empty"
        ]);
    }

    public function test_fetching_a_specific_skill_successfully()
    {
        $skill = Skill::first();
        $response = $this->getJson("{$this->path_prefix}/skills/{$skill->key}");

        $response->assertOk();
        $response->assertJson([
            'data'      => [
                'id'            => $skill->id,
                'key'           => $skill->key,
                'name'          => $skill->name,
                'colour'        => $skill->colour,
            ],
            'message'   => "Successfully fetched matching skill"
        ]);
        $response->assertJsonCount(6, 'data');
    }

    public function test_fetching_a_skill_with_an_invalid_parameter()
    {
        $param = 1337;
        $response = $this->getJson("{$this->path_prefix}/skills/{$param}");

        $response->assertStatus(400);
        $response->assertJson([
            'data'      => null,
            'message'   => "The key parameter should be of type string"
        ]);
    }

    public function test_fetching_a_skill_where_matching_skill_does_not_exist()
    {
        $param = "noskill";
        $response = $this->getJson("{$this->path_prefix}/skills/{$param}");

        $response->assertNotFound();
        $response->assertJson([
            'data'      => null,
            'message'   => "Could not find skill matching key {$param}"
        ]);
    }
}
