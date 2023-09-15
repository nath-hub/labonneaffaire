<?php

namespace App\Services;


use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Mail;

class UserService
{
    /**
     * Create a user
     * 
     * @param array $input The user data
     * 
     * @return string The newly created data of the user
     */
    public function store(array $input)
    {

        $input['password'] = Hash::make($input['password']);

        $state = User::create($input);

        Mail::send('mail', ['code' => $state->id], function ($message) use ($input) {
            $message->to($input['email']);
            $message->subject("E-mail de validation");
        });

        return $state;
    }

    /**
     * show a user
     * 
     * @param array $user The user data
     * 
     */
    public function view($user)
    {
        return $user;
    }

    /**
     * update a user
     * 
     * @param array $user The user data
     * 
     */
    public function update($user, $input)
    {
        $state = $user->update($input);

        return $state;
    }
}
