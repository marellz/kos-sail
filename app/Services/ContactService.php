<?php

namespace App\Services;

use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\UpdateManyContactRequest;
use App\Models\Contact;

class ContactService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function fields()
    {
        return [
            'name',
            'user_id',
            'email',
            'phone',
            'subject',
            'message',
            'reply_to',
            'read'
        ];
    }

    public function getById(int $id)
    {
        return Contact::findOrFail($id);
    }

    public function all()
    {
        return Contact::all();
    }

    public function query(string $query, $paginate = true)
    {
        $contacts =  Contact::where(
            function ($builder) use ($query) {
                $builder->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%')
                    ->orWhere('phone', 'LIKE', '%' . $query . '%')
                    ->orWhere('subject', 'LIKE', '%' . $query . '%')
                    ->orWhere('message', 'LIKE', '%' . $query . '%');
            }
        );

        return $paginate ? $contacts->paginate(15) : $contacts->get();
    }

    public function paginate()
    {
        return Contact::paginate(15);
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->safe($this->fields()));
        return $contact;
    }

    public function markAsRead(int $id)
    {
        $contact = $this->getById($id);
        return $contact->update(['read' => true]);
    }

    public function update(Contact $contact, UpdateContactRequest $request)
    {
        return $contact->update($request->safe([
            'resolved',
            'read',
        ]));
    }

    public function updateMany(UpdateManyContactRequest $request)
    {
        $contacts = Contact::whereIn('id', (array) $request->get('contacts'))->get();

        foreach ($contacts as $contact) {
            $contact->update([$request->get('action') => true]);
        }
    }

    public function destroy(Contact $contact)
    {
        return $contact->delete();
    }
}
