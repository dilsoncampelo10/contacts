<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_user_can_register_with_valid_data()
    {
        $response = $this->post(route('register'), [
            'name' => 'Dilson Campelo',
            'email' => 'dilson@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('contacts.index'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'dilson@gmail.com']);
    }

    public function test_registration_requires_fields()
    {
        $response = $this->post(route('register'), []);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function test_password_confirmation_must_match()
    {
        $response = $this->post(route('register'), [
            'name' => 'Maria',
            'email' => 'maria@example.com',
            'password' => 'password',
            'password_confirmation' => 'different_password',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertGuest();
    }

    public function test_email_must_be_unique()
    {
        User::factory()->create(['email' => 'duplicate@example.com']);

        $response = $this->post(route('register'), [
            'name' => 'Teste',
            'email' => 'duplicate@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_registered_event_is_dispatched()
    {
        Event::fake();

        $this->post(route('register'), [
            'name' => 'Novo Usuário',
            'email' => 'novo@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        Event::assertDispatched(Registered::class);
    }
}
