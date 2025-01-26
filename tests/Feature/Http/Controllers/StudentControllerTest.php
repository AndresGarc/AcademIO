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
            'email' => "test@gmail.com",
            'birthday' => "2000-01-01",
            'signed_up_the'  => "2000-01-01"
        ]);

        $this->json('get', 'api/student/1')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonFragment([
                "firstname" => "John",
                "lastname" => "Doe",
                'phone'  => "+34685215842",
                'email' => "test@gmail.com",
                'birthday' => "2000-01-01",
                'signed_up_the'  => "2000-01-01"
            ]);

    }

    public function test_can_add_a_new_student()
    {
        $this->json('post', 'api/student', [
            "firstname" => "Andres",
            "lastname" => "Garcia",
            'phone'  => "+34685215842",
            'email' => "test@gmail.com",
            'birthday' => "2000-01-01"
        ])
            ->assertStatus(Response::HTTP_CREATED);

        $student = Student::where('firstname', 'Andres')
            ->first();

        $this->assertNotEmpty($student);
    }

    public function test_email_student_validation_fails_for_invalid_email()
    {
        $this->json('post', 'api/student', [
            "firstname" => "Andres",
            "lastname" => "Garcia",
            'phone'  => "+34685215842",
            'email' => "test@gmail",
            'birthday' => "2000-01-01"
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_email_student_validation_fails_for_same_email()
    {
        Student::factory()->create([
            'email' => 'test@gmail.com'
        ]);

        $response = $this->json('post', 'api/student', [
            "firstname" => "Andres",
            "lastname" => "Garcia",
            'phone'  => "+34685215842",
            'email' => "test@gmail.com",
            'birthday' => "2000-01-01"
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_birthday_student_validation_fails_with_invalid_data()
    {

        $this->json('post', 'api/student', [
            "firstname" => "Andres",
            "lastname" => "Garcia",
            'phone'  => "+34685215842",
            'email' => "test@gmail.com",
            'birthday' => "2025-10-01"
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_signed_up_the_date_is_put_into_the_request_is_skipped()
    {

        $this->json('post', 'api/student', [
            "firstname" => "Andres",
            "lastname" => "Garcia",
            'phone'  => "+34685215842",
            'email' => "test@gmail.com",
            'birthday' => "2000-10-01",
            "signed_up_the" => "2000-02-10"
        ])->assertStatus(Response::HTTP_CREATED);

        $student = Student::first();

        $this->assertNotEquals("2000-02-10", $student->birthday);
    }

    public function test_student_info_is_updated_properly()
    {
        
    }

}