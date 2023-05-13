<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_home_with_en_locale(): void
    {
        $this->get('/en')
            ->assertStatus(200)
            ->assertSee('Actors');
    }

    public function test_get_home_with_de_locale(): void
    {
        $this->get('/de')
            ->assertStatus(200)
            ->assertSee('Schauspieler');
    }

    public function test_store_method_with_valid_data()
    {
        // Set up the request data
        $data = [
            'full_name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'password123*',
            'confirm_password' => 'password123*',
            'birthdate' => '1990-01-01',
            'phone' => '1234567890',
            'address' => '123 Main Street',
        ];

        // Call the store method with the request data
        $controller = new UserController();
        $request = new Request($data);
        $response = $controller->store($request);

        // Assert that the user was saved to the database
        $this->assertDatabaseHas('users', [
            'full_name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'birthdate' => '1990-01-01',
            'phone' => '1234567890',
            'address' => '123 Main Street',
        ]);

        // Assert that a success view is returned
        $this->assertEquals('success', $response->getName());
    }}
