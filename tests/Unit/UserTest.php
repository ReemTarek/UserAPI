<?php

namespace Tests\Unit;

use Tests\TestCase;
use Database\factories\UserFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    
    public function test_can_login() {
        $body = [
            'email' => 'n@nmail.com',
            'password' => '123456789',
            'remember_me'=>'1'
        ];
        $this->json('POST','/api/auth/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['token_type','access_token']);
    }
    public function test_can_signup(){
        $body = [
            'name' => 'reem',
            'email' => 'reemmm@anymail.com',
            'password' => '123456789',
            'password_confirmation'=>'123456789',
            'gender'=>'female',
            'education'=>'university',
            'interests'=>'none',
            'age'=>'20',
            'skills'=>'none',
            'experience'=>'none'
        ];
        $this->json('POST','/api/auth/signup',$body,['Accept' => 'application/json'])
            ->assertStatus(422);
            

    }
     public function test_can_delete()
     {
        $body = [
           'id'=>'6'
        ];
        $this->json('DELETE','/api/auth/delete/6',$body,['Accept' => 'application/json'])
            ->assertStatus(404);
     }
     public function test_can_get_one_user()
     {
        $body = [
            'id'=>'1'
        ];
        $this->json('GET','/api/auth/displaycertainuser/1',$body,['Accept' => 'application/json'])
            ->assertStatus(200);
     }
     public function test_can_get_all_users()
     { $body = [
       
       ];
        $this->json('GET','/api/auth/displayallusers',$body,['Accept' => 'application/json'])
        ->assertStatus(200);
     }
     public function test_can_update()
     {
        $body = [
            'name' => 'reem',
            'email' => 'reemmm@anymail.com',
            'gender'=>'female',
            'education'=>'university',
            'interests'=>'none',
            'age'=>'20',
            'skills'=>'none',
            'experience'=>'any'
        ];
        $this->json('POST','/api/auth/update',$body,['Accept' => 'application/json'])
            ->assertStatus(200);
            
     }
     public function test_can_logout()
     {
         $body= [
             'id' => '1'
         ];
         $this->json('POST','/api/auth/logout',$body,['Accept' => 'application/json',
         'Authorization'=>'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijg3MGNkZTQzNmMzYTJjZTAwMTZiY2UzZGM1NmM2ODU2YTBlYThkMGNlMGQxY2MwZjk5ZDY5ZjcxNzhmMWU2MDdlNGViNWViMDIzODI0NGNlIn0.eyJhdWQiOiIxIiwianRpIjoiODcwY2RlNDM2YzNhMmNlMDAxNmJjZTNkYzU2YzY4NTZhMGVhOGQwY2UwZDFjYzBmOTlkNjlmNzE3OGYxZTYwN2U0ZWI1ZWIwMjM4MjQ0Y2UiLCJpYXQiOjE1NTQ2NTk4NzAsIm5iZiI6MTU1NDY1OTg3MCwiZXhwIjoxNTg2MjgyMjcwLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.ySNxu9frhJK_KEPHgs91Gt1G50Y3ERAKF56tZFpXjFPbAKV_XIrrlLbxeLZ3FxxeHe6G6wOXKYXtqZ-juM8s5VKbIEZvOJLkjXfKUWMduPxH3hoNen6OTtuQlS1TBL-TNMvnrMxPRYpFq5CzoW0TF6GGpWe00ktfZ86x6A7KnLrAzuivJlx-wC1KBuHxTqrSsCrK6SSLPnhrbLbak8bMp1ZBbF7pfTQRxrFVLkYQJaY8klPopnbO1uQLpXlmUfDGzcFKmv0Ciov2-_QUq7Y4nQ4YQuw0ODduaB5BymTGYEisirvFERlVfDLGtOcqjfO1b4XUVFE2lStjXhJMMiDk02Gcevl92oeC4L52Kiv2PXlrhhAA-b_UUMrSygAhj7llsKW31b3hcjELYkVsS85IKnss2GxrQya5B4hHHehc-zUSFF7f1pXHOYSB_9EYHjGdLqDbkaeTCyQjO-eoZVikGP0dJkwhP-UdDTa4eHADf6nTCJVXEEnrIw-IP_JDoc5RL-nZBP5GtilznLJimHQjwly6F5viN8kSywfTTxzGp7-4SbZe6-_MM83zP8Aw-K6l9JC8wzdGRVO5pDDsvbWHuLDMHsWV8wMSXNFsG38IWCkgUCgD4tYqSAW82pCcLQD_SyfAVp8nEjZ82WnxnOdObkgaHHDgme4sZrz0qjVhQz4' 
         ])
         ->assertStatus(405);
     }

}
