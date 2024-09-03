<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\UpdateManyContactRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $service,
    ) {
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if($request->has('show_id')){
            $this->service->markAsRead($request->get('show_id'));
        }
        
        if ($request->has('query')) {
            $contacts = $this->service->query($request->get('query'), true);
        } else {
            $contacts = $this->service->paginate(10);
        }

        return Inertia::render('dashboard/contact/index', [
            'contacts' => new ContactCollection($contacts->withQueryString()),
            'activeRow' => $request->get('show_id') ?? null,
            'query'=> $request->get('query')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
        $contact->update(['read'=> true]);

        return Inertia::render('dashboard/contact/show', [
            'contact' => new ContactResource($contact),
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
        $this->service->update($contact, $request);
        return redirect()->back();
    }

    /**
     * Update several resources.
     */
    public function updateMany(UpdateManyContactRequest $request)
    {
        //
        $this->service->updateMany($request);
        return redirect()->back();
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
        $this->service->destroy($contact);
        return redirect()->route('admin.contacts.index');
    }
}
