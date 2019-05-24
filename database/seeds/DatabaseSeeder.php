<?php

use App\Company;
use App\Job;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creating the target company & user for our exploitation demonstrations
        $target = factory(Company::class)->create([
            'id'       => 1,
            'name'     => 'Hacking Laravel Inc.',
            'email'    => 'jobs@hacking-laravel-inc.pwn',
            'location' => 'Luchana, 38, 28010 - Madrid',
        ]);
        factory(User::class)->create([
            'name'       => 'John Smith',
            'email'      => 'boss@hacking-laravel.pwn',
            'password'   => bcrypt('l4r4c0nm4dr1d337'),
            'company_id' => $target->id,
        ]);

        // Passing in a random password from SecLists so that you can't bypass the password attack step <3
        $password = exec('curl -s https://raw.githubusercontent.com/danielmiessler/SecLists/master/Passwords/darkweb2017-top10000.txt | shuf -n 1');
        factory(User::class)->create([
            'name'       => 'Administrator',
            'email'      => 'admin@laracon-madrid.pwn',
            'password'   => bcrypt($password),
            'company_id' => $target->id,
            'is_admin'   => true,
        ]);

        // Creating some more dummy data to make the app feel more lively
        factory(Company::class, 5)->create();

        Company::each(function (Company $company) {
            factory(Job::class, 10)->create([
                'company_id' => $company->id,
            ]);
        });
    }
}
