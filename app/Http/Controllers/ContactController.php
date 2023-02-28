<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // direct contact list page
    public function contactList()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.user.contact', compact('contacts'));
    }

    // contact detail page
    public function contactDetails($id)
    {
        $contact = Contact::where('id', $id)->first();
        return view('admin.user.contactDetail', compact('contact'));
    }

    // delete contact
    public function deleteContact($id)
    {
        Contact::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Delete Contact Success...']);
    }
}
