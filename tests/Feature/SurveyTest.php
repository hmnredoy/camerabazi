<?php

namespace Tests\Feature;

use App\Models\TMR;
use Tests\TestCase;
use App\Models\Survey;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SurveyTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function a_user_can_submit_a_survey()
    {
        $this->withoutExceptionHandling();

        $demo = [
            ['id' => 1, 'feedback' => true],
            ['id' => 2, 'feedback' => false],
        ];

        $data = [
            'outlet_id' => 1,
            'answers' => json_encode($demo)
        ];
        $survey = create(Survey::class);
        $tmr = create(TMR::class);
        $this->actingAs($tmr, 'api');
        
        $this->post(route('survey.store'), $data)
            ->assertStatus(201);
        
        $this->assertDatabaseHas('survey_reports', [
            'survey_id' => $survey->id,
            'outlet_id' => $data['outlet_id'],
            'tmr_id' => auth()->id()
        ]);

        $this->assertDatabaseHas('survey_answers', [
            'question_id' => 1, 
            'feedback' => 1
        ]);
    }
}












