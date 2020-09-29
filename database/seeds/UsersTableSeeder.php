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
    	/**
    	 *times 生成多少条数据 
    	 *make 为模型创建一个集合
    	 */
        $users = factory(User::class)->times(100)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        // 更新管理员状态
        $user = User::find(1);
        $user->is_admin = true;
        $user->save();
    }
}
