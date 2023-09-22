<?php

namespace App\Services;


use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
 

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

        $lieu = asset('/api/update-verification-email/');

        Mail::send('mail', ['code' => $state->id, "lieu" => $lieu], function ($message) use ($input) {
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

    public function verification($user){
        
       $user->email_verified_at = Carbon::now();

       $user->update();

    }

    public function sendEmail($user, $input){

        $user = User::where('email', $input['email'])->get();

        if (isset($user)) {

            $email = $user[0]->email;

            Mail::send('mailVerification', ['verify' => $user[0]->id], function ($message) use ($email) {
                $message->to($email);
                $message->subject("E-mail de verification");
            });

            return [
                "statut" => 200, "data" => $user
            ];
        }

        return [];
    }

      /**
     * Update a user
     * 
     * @param User $user the a user who updates his data
     * @param array $input The user data
     * 
     */
    public function updatePassword($dataToUpdate, $user)
    {

        if (isset($dataToUpdate['password'])) {
            $dataToUpdate['password'] = Hash::make($dataToUpdate['password']);
        }

        $user->update($dataToUpdate);

        return response()->json([], 204);
    }

    /**
     * Delete a user
     * 
     * @param array $input The user id
     * 
     * @return void
     */
    public function delete($userToDelete)
    {
        $userToDelete->delete();
    }

}
