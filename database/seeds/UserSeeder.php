<?php
use App\Model\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$userCount = User::count();
    	if($userCount==0){
        	factory(User::class)->times(1)->create();
    	}
    }
}
