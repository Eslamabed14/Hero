<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactResource;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::paginate(5);
        if (count($contact) > 0) {
            return ContactResource::collection($contact);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'No contacts yet'
            ],200);
        }   
    }
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'success' => true,
                'message' => 'CONTACT DELETED SUCCESSFULLY'
            ],200);
        }else {
            return response()->json([
                'success' => false,
                'message' => 'No contacts yet'
            ],404);
        }
    }
}
