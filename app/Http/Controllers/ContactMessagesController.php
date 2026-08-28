<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessagesController extends Controller
{
    public function index() {

        $contact_message = ContactMessage::all();

        $data = [
            "message" => "Show All Contact Message",
            "status" => 200,
            "data" => $contact_message,
        ];

        return response()->json($data,200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            "name" => "required|string|max:255",
            "email" => "required|email:dns",
            "phone" => "required|string",
            "subject" => "required|max:255",
            "message" => "required|string",
            "status" => "required|in:0,1",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Faild",
                "status" => 422,
                "data" => $validator->errors(),
            ];
            return response()->json($data,422);
        } else {
            $contact_message = ContactMessage::create([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "subject" => $request->subject,
                "message" => $request->message,
                "status" => $request->status,
            ]);

            $data = [
                "message" => "Created New Contact Message",
                "status" => 201,
                "data" => $contact_message,
            ];

            return response()->json($data,201);
        }
    }

      public function show($id) {
        try {
            $contact_message = ContactMessage::FindOrfail($id);
                $data = [
                    "message" => "Contact Message found",
                    "status" => 200,
                    "data" => $contact_message
                ];
            return response()->json($data,200);

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $error) {

            $data = [
                "message" => "Contact Message not found",
                "status" => 404,
            ];
            return response()->json($data,404);
        }
    }

    public function update(Request $request,$id) {

        $contact_message = ContactMessage::FindOrFail($id);

        $validator = Validator::make($request->all(),[
            "name" => "required|string|max:255",
            "email" => "required|email:dns",
            "phone" => "required|string",
            "subject" => "required|string|max:255",
            "message" => "required|string",
            "status" => "required|in:0,1",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Validation Faild",
                "status" => 422,
                "data" => $validator->errors(),
            ];
            return response()->json($data,422);
        } else {
            $contact_message->update([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "subject" => $request->subject,
                "message" => $request->message,
                "status" => $request->status,
            ]);
            $data = [
                "message" => "Updated SuccessFully",
                "status" => 200,
                "data" => $contact_message,
            ];
            return response()->json($data,200);
        }
    }

    public function destroy($id) {

    try {
            $contact_message = ContactMessage::FindOrfail($id);
                $contact_message->delete();
            $data = [
                "message" => "Contact Message Deleted Successfully",
                "status" => 200,
                "data" => $contact_message,
            ];
            return response()->json($data,200);

        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $error) {

            $data = [
                "message" => "Contact Message Deleted Not Found",
                "status" => 404,
                "data" => null,
            ];
            return response()->json($data,404);;
        }
    }
}
