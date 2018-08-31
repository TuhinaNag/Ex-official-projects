<?php

use Illuminate\Database\Seeder;
use App\Api;

class ApiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apis = [
            [
                'api_name' => 'Clear attribute',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/clear-attribute',
                'description' => 'This api sets the values of the entered attributes to NULL for a specific bot.  
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "Set attributes" : From application according the attributes we set in our bot.
		We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Show Day',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/today/day',
                'description' => 'This api shows the current day of the week.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Show Date',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/today/date',
                'description' => 'This api shows the current date.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Set global variable',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/setglobalvariable',
                'description' => 'This api sets the current value of the passed attribute in order to be used globally in future.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Get global variable',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/getglobalvariable',
                'description' => 'This api gets back the current value of the passed attribute in order to be used globally in future.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Reset global variable',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/resetglobalvariable',
                'description' => 'This api resets back the current value with the passed value of the global attribute in order to be used globally in future.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Increment variable',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/incrementglobalvariable',
                'description' => 'This api increments the current value with the passed value of the global attribute in order to be used globally in future.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
            [
                'api_name' => 'Decrement variable',
                'api_url' => 'api.chatfueljsonapi.com/api/v1/bot/{bot_id}/token/{broadcast_api_token}/decrementglobalvariable',
                'description' => 'This api decrements the current value with the passed value of the global attribute in order to be used globally in future.
                    "bot name" : from chatfuel bot, fed into the chatfueljsonapi application, 
                    "bot id" : from chatfuel bot, fed into the chatfueljsonapi application,
                    "broadcast api token" : from chatfuel bot, fed into the chatfueljsonapi application,
                    We need all these details in order to return the api response back to messenger.'
            ],
        ];

        DB::table('apis')->insert($apis);
    }
}
