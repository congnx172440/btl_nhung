<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        DB::table('vi_tris')->insert([
           ['vi_tri'=>'Admin'],
           ['vi_tri'=>'Quản lý'],
           ['vi_tri'=>'Lãnh đạo'],
           ['vi_tri'=>'Nhân viên']
        ]);
        $time_in = new Carbon('8:30:00');
        $time_out = new Carbon('17:00:00');
        DB::table('cong_ties')->insert([
                ['ten_cong_ty'=>'Set',
                    'dia_chi_cong_ty'=>'C9_BKHN',
                    'gio_vao'=>$time_in,
                    'gio_ra'=>$time_out,
                ]
        ]);
        DB::table('users')->insert([
            ['name'=>'Admin',
                'ten_hien_thi'=>'admin',
                'email'=>'admin@hust.edu.vn',
                'password'=>bcrypt('12345'),
                'id_vi_tri'=>1,
                'id_cong_ty'=>1,
                'id_rfid'=>'0',]
        ]);
    }
}
