<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class SyncTutorsFromUsersSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $users = User::where('role', 'tutor')->get();

        foreach ($users as $u) {
            $exists = DB::table('tutors')->where('tutor_id', $u->user_id)->exists();
            if (!$exists) {
                DB::table('tutors')->insert([
                    'tutor_id' => $u->user_id,
                    'pengalaman' => '',
                    'rating' => 0.00,
                    'is_active' => 1,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }
}
