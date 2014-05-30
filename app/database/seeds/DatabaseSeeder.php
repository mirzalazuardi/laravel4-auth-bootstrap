<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}
class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new \DateTime;

		DB::table('users')->delete();

        DB::table('users')->insert(['username'=>'admin', 'email'=>'admin@mail.com', 'password'=>Hash::make('admin'),'created_at'=>$date,'updated_at'=>$date]);
        DB::table('users')->insert(['username'=>'mirza', 'email'=>'mirza@mail.com', 'password'=>Hash::make('mirza'),'created_at'=>$date,'updated_at'=>$date]);
	}
	public function down()
    {
            DB::table('users')->delete();
    }

}