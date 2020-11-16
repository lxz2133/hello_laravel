<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(50)->create();

        $user = User::find(1);
        $user->name = 'lxz2133';
        $user->email = 'lxz2133@gmail.com';
        $user->password = bcrypt('Lxz_19920107');
        $user->is_admin = true;
        $user->save();
    }
}
