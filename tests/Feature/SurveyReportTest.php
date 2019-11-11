<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Outlet;
use App\Models\SurveyReport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SurveyReportTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_view_all_survey_report()
    {
        $report = create(SurveyReport::class);

        $response = $this->get(route('survey_report.index'))->assertStatus(200);

        $response->assertSee($report->outlet->name);
        $response->assertSee($report->tmr->name);
        $response->assertSee($report->survey->name);
        $response->assertSee($report->score);
    }

    /** @test */
    public function admin_can_view_all_survey_of_a_outlet()
    {
        $outlet = create(Outlet::class);
        $report = create(SurveyReport::class, ['outlet_id' => $outlet->id]);
        
        $response = $this->get(route('survey_report.outlet', $outlet->id))->assertStatus(200);

        $response->assertSee($report->outlet->name);
        $response->assertSee($report->tmr->name);
        $response->assertSee($report->survey->name);
        $response->assertSee($report->score);
        $response->assertSee($report->totalMark);
    }
}
