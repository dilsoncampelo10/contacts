<?php

namespace Tests\Feature\App\Http\Requests\Contact;

use App\Http\Requests\Contact\CreateContactRequest;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class CreateContactRequestTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_authorize_returns_true_when_user_is_authenticated()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = new CreateContactRequest();

        $this->assertTrue($request->authorize());
    }

    public function test_validation_rules_pass_with_valid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => 'Dilson Campelo',
            'email' => 'dilson@example.com',
            'contact' => '123456789',
        ];

        $request = new CreateContactRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }

    public function test_validation_fails_with_invalid_data()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => 'Di',
            'email' => 'not-an-email',
            'contact' => 'abc123',
        ];

        $request = new CreateContactRequest();
        $rules = $request->rules();

        $validator = Validator::make($data, $rules);

        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('name', $validator->errors()->messages());
        $this->assertArrayHasKey('email', $validator->errors()->messages());
        $this->assertArrayHasKey('contact', $validator->errors()->messages());
    }

    public function test_email_and_contact_are_unique_except_for_current_contact()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create([
            'user_id' => $user->id,
            'email' => 'existing@example.com',
            'contact' => '123456789',
        ]);

        $request = CreateContactRequest::create('/fake-url', 'POST', [
            'name' => 'Updated Name',
            'email' => 'existing@example.com',
            'contact' => '123456789',
            'id' => $contact->id
        ]);

        $rules = $request->rules();

        $validator = Validator::make($request->all(), $rules);

        $this->assertTrue($validator->passes());
    }
}
