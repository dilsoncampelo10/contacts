<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function store(array $data)
    {
        $contact = Contact::create($data);

        return $contact;
    }

    public function findById(string $id)
    {
        $contact = Contact::findOrFail($id);

        return $contact;
    }

    public function update(array $data, string $id)
    {
        $contact = $this->findById($id);

        return $contact->update($data);
    }
    public function delete(string $id)
    {
        $contact = $this->findById($id);
        $contact->delete();
    }
}
