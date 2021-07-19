<?php

namespace Tests\Unit\Events;

use App\Events\UserSaved;
use App\Listeners\SaveUserBackgroundInformation;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class SaveUserBackgroundInformationTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function it_can_listen_to_user_saved_event()
    {
        Event::fake();
        Event::assertListening(
            UserSaved::class,
            SaveUserBackgroundInformation::class
        );
    }
}
