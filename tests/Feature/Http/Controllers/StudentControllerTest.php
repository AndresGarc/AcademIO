<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Response;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{

    public function test_can_get_proper_structure_of_the_list_of_all_students() : void
    {
        Student::factory(5)->create();

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

    public function test_returns_all_the_students() : void
    {
        Student::factory(5)->create();

        $this->json('get', 'api/students')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonCount(5, "data");

    } 


    public function test_returns_proper_information() : void
    {
        Student::factory()->create([
            "firstname" => "John",
            "lastname" => "Doe"
        ]);
        Student::factory(4)->create();

        $this->json('get', 'api/students')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonFragment([
            "id" => 1,
            "firstname" => "John",
            "lastname" => "Doe"
        ]);

    } 

    public function test_student_data_structure_is_correct()
    {
        Student::factory()->create();

        $this->json('get', 'api/student/1')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure(
            [
                'data' => [
                        'id',
                        'firstname',
                        'lastname',
                        'phone',
                        'email',
                        'birthday',
                        'signed_up_the'
                    ]
            ]
        );
    }

    public function test_returns_proper_information_of_a_student()
    {
        Student::factory()->create([
            "firstname" => "John",
            "lastname" => "Doe",
            'phone'  => "+34685215842",
            'email' => "johndoe@gmail.com",
            'birthday' => "2000-01-01",
            'signed_up_the'  => "2000-01-01"
        ]);

        $this->json('get', 'api/student/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                "firstname" => "John",
                "lastname" => "Doe",
                'phone'  => "+34685215842",
                'email' => "johndoe@gmail.com",
                'birthday' => "2000-01-01",
                'signed_up_the'  => "2000-01-01"
            ]);

    }

    public function test_can_add_a_new_student()
    {
        $this->json('post', 'api/student')
            ->assertStatus(Response::HTTP_CREATED);

        $student = Student::where('firstname', 'Andres')
            ->first();

        $this->assertNotEmpty($student);
    }

}