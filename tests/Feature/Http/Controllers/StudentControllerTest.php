<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Response;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{

    public function test_can_get_the_list_of_all_students() : void
    {
        Student::factory(5)->create();

        dd($this->json('get', 'api/students'));
        $this->json('get', 'api/students')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                    '*' => [
                        'id',
                        'firstname',
                        'lastname',
                        'phone',
                        'email',
                        'birthday',
                        'signed_up_the'
                    ]
                ]
            ]
        );

    }    

}