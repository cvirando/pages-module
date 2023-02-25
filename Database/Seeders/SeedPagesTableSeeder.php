<?php

/**
 * Made by CV. IRANDO
 * https://irando.co.id ©2023
 * info@irando.co.id
 */

namespace Modules\Pages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pages\Entities\Page;
use Carbon\Carbon;
use DB;

class SeedPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::table('pages')->delete();
        $page = Page::create([
            'name' => 'Default Page',
            'slug' => 'default-page',
            'photo' => null,
            'description' => '<p>This is your default page, feel free to edit or remove it.</p>',
            'active' => true,
        ]);

        // $this->call("OthersTableSeeder");
    }
}
