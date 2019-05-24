<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LogsInAndSeesDashboardTest extends DuskTestCase
{
    /**
     * @test
     */
    public function it_logs_in_with_seeded_credentials_and_sees_messages_in_dashboard_to_trigger_xss_injection_exploit()
    {
        $user = User::where('email', 'boss@hacking-laravel-inc.com')->first();
        if (!$user) {
            throw Exception('Required user hasn\'t been seeded to the DB properly in beforehand');
        }

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'l4r4c0nm4dr1d337')
                ->press('Login')
                ->assertPathIs('/home')
                ->assertSee('Dashboard');
        });
    }
}
