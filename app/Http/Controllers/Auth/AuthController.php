<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"User"},
     *      summary="login",
     *      description="login",
     *      @OA\RequestBody(
     *      required=true,
     *      description="connexion d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="email", type="string", format="email", example="exmple@exemple.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="jdjfk3237&$#", description ="votre motde passe"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function login(AuthRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            $user = $request->user();

            if ($user->email_verified_at === null) {
                return response()->json([
                    'code' => 401,
                    'error' => 'Account not validate in email',
                    'message' => 'Account is not validate, verify your email',
                ], 401);
            } else {

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
        }

        return response()->json([
            'code' => 401,
            'error' => 'invalid_client',
            'message' => 'Client authenfication failed',
        ], 401);
    }

    /**
     * @OA\Post(
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"User"},
     *      summary="login",
     *      description="logout",
     *      @OA\RequestBody(
     *      required=true,
     *      description="déconnexion d'un utilisateur",
     *
     * 
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Connexion effectuée"),
     *        )
     *     ),
     *        @OA\Response(
     *      response=400,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="400"),
     *      @OA\Property(property="message", type="string", example="Erreur lors du traitement de la demande")
     *        )
     *     ),
     * @OA\Response(
     *      response=500,
     *      description="Bad Request",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="500"),
     *      @OA\Property(property="message", type="string", example="Erreur de connexion")
     *        )
     *     )
     * )
     *      
     * )
     */
    public function logout(Request $request, User $user)
    {

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            Auth::guard('web')->logout();

            $user->tokens()->delete();

            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'code' => 200,
                'data' => $user,
                'message' => 'vous êtes bien déconnecté'
            ]);
        }
    }
}
