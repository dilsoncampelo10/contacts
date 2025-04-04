<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function findAll(array $data)
    {
        if (!auth()->check()) {
            return new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        }

        $query = auth()->user()->contacts();

        if (!empty($data['search'])) {
            $search = $data['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('contact', 'LIKE', "%{$search}%");
            });
        }

        return $query->paginate(10);
    }


    public function store(array $data)
    {
        $data['user_id'] = auth()->user()->id;
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
