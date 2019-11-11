<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\NoticeBoard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use TunnelConflux\DevCrud\Helpers\DevCrudHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NoticeTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    /** @test */
    public function aNoticeCanBeAdd()
    {
        $this->markTestSkipped('must be revisited.');
        $user = factory(User::class)->create();
        $notice = factory(NoticeBoard::class)->create();

        $this->assertCount(1, NoticeBoard::all());
        $this->assertEquals($notice->slug, DevCrudHelper::makeSlug($notice, $notice->title));
        $this->assertNotNull($notice->title);
        $this->assertNotNull($notice->message);
        $this->assertEquals(now()->format('Y-m-d'), $notice->created_at->format('Y-m-d'));
        $this->assertEquals($notice->user->toArray(), $user->toArray());

        Auth::logout();
    }

    /** @test */
    public function aNoticeCanBeUpdated()
    {
        $this->markTestSkipped('must be revisited.');
        $user   = factory(User::class)->create();
        $notice = factory(NoticeBoard::class)->create();
        $data = [
            'title'   => $this->faker->sentence(rand(3, 5)),
            'message' => $this->faker->sentence,
        ];

        $notice->update($data);

        $this->assertCount(1, NoticeBoard::whereId($notice->id)->get());
        $this->assertEquals($notice->slug, DevCrudHelper::makeSlug($notice, $data['title']));
        $this->assertNotNull($notice->title);
        $this->assertNotNull($notice->message);
        $this->assertNotNull($notice->created_at);
        $this->assertNotNull($notice->updated_at);
        $this->assertEquals($data, $notice->get(['title', 'message'])->first()->toArray());
        $this->assertEquals($notice->user->toArray(), $user->toArray());
    }

    /** @test */
    public function onlyUserCanAddNotice()
    {
        $this->markTestSkipped('must be revisited.');
    }
}