<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
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
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Test Name',
            'email' => 'test@example.com',
        ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Boston, MA',
        //     'email' => 'email1@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Here is where you can register web routes for your application. These
        //     | routes are loaded by the RouteServiceProvider within a group which
        //     | contains the "web" middleware group. Now create something great!'
        //     ]);
        // Listing::create([
        //     'title' => 'Python Senior Developer',
        //     'tags' => 'python, javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Georgia, LA',
        //     'email' => 'email2@email.com',
        //     'website' => 'https://www.py.acme.com',
        //     'description' => 'Here is where you can register web routes for your application. These
        //     | routes are loaded by the RouteServiceProvider within a group which
        //     | contains the "web" middleware group. Now create something great!'
        // ]);
        Listing::factory(10)->create([
            'user_id' => $user->id,
            'email' => $user->email,
        ]);
    }
}
