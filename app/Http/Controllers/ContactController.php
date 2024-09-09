<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $service,
    ) {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        //

        $this->service->store($request);
        $request->session()->put('contact_message_sent', true);

        return redirect()->route('home');
        
    }
   
}
