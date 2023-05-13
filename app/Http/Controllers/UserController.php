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
        $formFields = $this->validate($request, [
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
            'phone' => 'required|numeric|digits:10',
            'address' => 'required',
        ]);

        // create new user
        $user = new User($formFields);

        try {
            $user->save();
        } catch (\Exception $e) {
            $error = $e->getMessage();
            if (strpos($error, 'users_email_unique') !== false) {
                return view('home', ['error' => __('strings.emailtaken')]);
            } else if (strpos($error, 'users_username_unique') !== false) {
                return view('home', ['error' => __('strings.usernametaken')]);
            } else {
                return view('home', ['error' => __('strings.smthwrong')]);
            }
        }

        Mail::to('husseinessa855@gmail.com')->send(new UserRegistered($user->username));

        // return response
        return view('success');
    }
}
