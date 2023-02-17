<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

		/** client_details table seeding ***/

	  /**$faker=Faker::create();
    	foreach (range(1,100) as $index) {
	        DB::table('client_details')->insert([
                'resellerid'=>$faker->randomDigit,
                'username'=>$faker->name,
                'client_type'=>$faker->randomDigit,
                'validity'=>$faker->randomDigit,
                'sms_credit'=>$faker->randomDigit,
                'industry_type'=>$faker->randomDigit,
                 'product_type'=>$faker->randomDigit,
                 'price_slab'=>$faker->randomDigit,
                 'city'=>$faker->asciify('*********'),
                'locality'=>$faker->asciify('**************'),
                'call_rate'=>$faker->randomDigit,
                'sms_rate'=>$faker->randomDigit,
	            'name' => $faker->name,
	            'email' => $faker->email,
	            'contact' => $faker->e164PhoneNumber,
                'stdcode'=> $faker->optional()->randomDigit,
                'landline'=> $faker->optional()->e164PhoneNumber,
                'companyname'=>$faker->company,


	        ]);
    } **/

		/**  client_logins table seed  **/
		/**$faker=Faker::create();
    	foreach (range(1,100) as $index) {
	        DB::table('client_logins')->insert([
                'username'=>$faker->asciify('*****'),
				'password'=>bcrypt('123456'),
                'is_active'=>1,
                'user_id'=>1,
                'client_type'=>'client',
	            'name' => $faker->userName,
                'api_token'=> $faker->lexify('????????????????????????????????????????????????????????????'),
                'ip_address'=> $faker->ipv4,
				'user_agent'=>$faker->userAgent,
				'created_at'=>$faker->dateTime,
				'updated_at'=>$faker->dateTime,



	        ]);


}*/

        /** CallReports table seed **/
       /* $faker=Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('call_reports')->insert([
                'caller_number'=>'',
				'source_number'=>xx',
                'user_id'=>1,
                'start_time'=>$faker->dateTime,
                'answer_time'=>$faker->dateTime,
	            'end_time' => $faker->dateTime,
                'duration'=> $faker->time($format = 'H:i:s'),
                'agent_number'=>'',
				'priority'=>'interested',
				'add_remark'=>'callers problem has been resolved. Next call will be done b our agent xyz.',
				'save_caller'=>0,



	        ]);


}*/
}
}
