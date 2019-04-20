<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {		
        $users = [
		[ 
			'name'	=> 'Rudi, A.Md.',
			'username'	=> 'admin',
			'email'	=> 'Rudi@gmail.com',
			'password'	=> bcrypt('rahasia'),
			'remember_token'	=> '',
			'created_at'	=> '2018-01-11 16:00:00',
			'updated_at'	=> '2018-01-11 16:00:00',
			'level'	=> '11',
		],
		[
			'name'	=> 'Eva Susanti, S.E',
			'username'	=> '111',
			'email'	=> 'arman@gmail.com',
			'password'	=> bcrypt('rahasia'),
			'remember_token'	=> '',
			'created_at'	=> '2018-01-11 16:00:00',
			'updated_at'	=> '2018-01-11 16:00:00',
			'level'	=> '12',
		],
		[
			'name'	=> 'Muhammad Arman Sayekti',
			'username'	=> '13312233',
			'email'	=> 'sayekti@gmail.com',
			'password'	=> bcrypt('rahasia'),
			'remember_token'	=> '',
			'created_at'	=> '2018-01-11 16:00:00',
			'updated_at'	=> '2018-01-11 16:00:00',
			'level'	=> '13',
		],
		[
			'name'	=> 'Ahmad Salsabil',
			'username'	=> '13312232',
			'email'	=> 'Salsabil@gmail.com',
			'password'	=> bcrypt('rahasia'),
			'remember_token'	=> '',
			'created_at'	=> '2018-01-12 16:00:00',
			'updated_at'	=> '2018-01-12 16:00:00',
			'level'	=> '13',
		]	
		];    

		DB::table('users')->insert($users);
    }
}
