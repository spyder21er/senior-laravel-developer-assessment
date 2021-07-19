<?php

namespace Tests\Feature\Events;

use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use App\Models\Detail;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SaveUserBackgroundInformationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase, WithFaker;

    /**
     * @test
     * @return void
     */
    public function test_user_saved_event_is_dispatch_when_creating_user()
    {
        Event::fake();

        User::factory()->create();

        Event::assertDispatched(UserSaved::class);
    }

    /**
     * @test
     * @return void
     */
    public function test_user_saved_event_is_dispatch_when_updating_user()
    {
        Event::fake();

        $user = User::factory()->create();
        $user->update([
            'email' => 'newemail@example.com',
        ]);

        Event::assertDispatched(UserSaved::class);
    }

    /**
     * @test
     * @return void
     */
    public function test_save_user_backgound_information_is_handled_when_user_save_event_is_dispatched()
    {
        $previous_detail_count = Detail::all()->count();
        User::factory()->create();

        $this->assertTrue(Detail::all()->count() > $previous_detail_count);
    }
}
