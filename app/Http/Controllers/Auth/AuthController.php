<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return 
     */
    public function login(AuthRequest $request)
    {
        $data = $request->validated();

        if(Auth::attempt($data)){
            $user = $request->user();

            $token = $user->createToken('API TOKEN');

            return response()->json([
                'code' => 200,
                'data' => [
                    'token' => [
                        'type' => 'Bearer',
                        'expires_at' =>  Carbon::parse($token->accessToken->expires_at),
                        'access_token' => $token->plainTextToken
                    ],
                    'user' => [
                        'first_name' => $user->first_name,
                        'last_name' => $user->last_name,
                        'town' => $user->town,
                        'country' => $user->country,
                        'phone' => $user->phone,
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'birth_date' => $user->birth_date,
                        'role' => $user->role,
                        'type_account' => $user->type_account,
                        'siren' => $user->siren,
                        'commercial_register' => $user->commercial_register,
                        'name_enterprise' => $user->name_enterprise,
                        'address' => $user->address,
                        'web_site' => $user->web_site,
                        'description' => $user->description,
                        'state' => $user->state
                    ]
                ]
            ]);
        }

        return response()->json([
            'code' => 401,
            'error' => 'invalid_client',
            'message' => 'Client authenfication failed',
        ], 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

  
}
