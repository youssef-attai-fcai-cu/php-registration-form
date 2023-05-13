<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Mail\UserRegistered;


class UserController extends Controller
{
    // register function
    public function store(Request $request)
    {
        // validate the request
        $formFields = request()->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'confirm_password' => 'required|same:password',
            'birthdate' => 'required|date',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        // create new user
        $user = new User($formFields);
        $user->save();

         Mail::to('lewolfje@gmail.com')->send(new UserRegistered($user->username));

        // return response
        return view('success');
    }
}
