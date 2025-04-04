<?php

namespace Tests\Feature\App\Services;

use App\Models\Contact;
use App\Models\User;
use App\Services\ContactService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();


        $this->user = User::factory()->create();
        $this->contactService = new ContactService();
    }
    public function test_can_create_contact()
    {
        $contactData = [
            'user_id' => $this->user->id,
            'name' => 'Dilson Campelo',
            'email' => 'dilson@example.com',
            'contact' => '123456789',
        ];

        Contact::create($contactData);

        $this->assertDatabaseHas('contacts', [
            'email' => 'dilson@example.com',
        ]);
    }

    public function test_it_can_find_a_contact_by_id()
    {
        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $found = $this->contactService->findById($contact->id);

        $this->assertEquals($contact->id, $found->id);
    }

    public function test_it_can_update_a_contact()
    {
        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $updatedData = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'contact' => '987654321'
        ];

        $updated = $this->contactService->update($updatedData, $contact->id);

        $this->assertTrue($updated);
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'contact' => '987654321'
        ]);
    }

    public function test_it_can_delete_a_contact()
    {
        $contact = Contact::factory()->create(['user_id' => $this->user->id]);

        $this->contactService->delete($contact->id);

        $this->assertSoftDeleted('contacts', ['id' => $contact->id]);
    }

    public function test_it_can_list_contacts_with_pagination()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Contact::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);

        $service = new ContactService();

        $result = $service->findAll([]);

        $this->assertCount(10, $result);
    }

    public function test_it_can_search_contacts()
    {
        $this->actingAs($user = User::factory()->create());

        Contact::factory()->create([
            'name' => 'Dilson Teste',
            'email' => 'dilson@example.com',
            'contact' => '123456789',
            'user_id' => $user->id,
        ]);

        $service = new ContactService();
        $results = $service->findAll(['search' => 'Dilson']);

        $this->assertCount(1, $results);
    }
}
