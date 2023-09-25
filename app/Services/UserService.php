<?php

namespace App\Services;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDelete;
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
     * Upload user avatar
     * 
     * @param UploadedFile $avatarFile The avatar file
     * 
     * @return array
     */
    public function uploadAvatar(UploadedFile $avatarFile): array
    {

        $avatarPath = $avatarFile->store('users/avatar', 'public');

        return [
            'avatar_path' => $avatarPath,
            'avatar_url' => asset($avatarPath),
        ];
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
        
        $user = new UserDelete();
        $user->first_name = $userToDelete['first_name'];
        $user->last_name = $userToDelete['last_name'];
        $user->email = $userToDelete['email'];
        $user->town = $userToDelete['email'];
        $user->code = $userToDelete['code'];
        $user->country = $userToDelete['country'];
        $user->phone = $userToDelete['phone'];
        $user->avatar = $userToDelete['avatar'];
        $user->birth_date = $userToDelete['birth_date'];
        $user->role = $userToDelete['role'];
        $user->type_account = $userToDelete['type_account'];
        $user->siren = $userToDelete['siren'];
        $user->commercial_register = $userToDelete['commercial_register'];
        $user->name_enterprise = $userToDelete['name_enterprise'];
        $user->address = $userToDelete['address'];
        $user->web_site = $userToDelete['web_site'];
        $user->description = $userToDelete['description'];
        $user->password = $userToDelete['password'];
        $user->state = $userToDelete['state'];
        $user->email_verified_at = $userToDelete['email_verified_at'];
        $user->date_delete = Carbon::now();

        $user->save();

        return $userToDelete->delete();
    }

}
