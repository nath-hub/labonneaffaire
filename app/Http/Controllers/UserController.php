<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\Facades\UserFacade as UserService;

/**
 *
 *@OA\PathItem(
 *path="/users/{user}",
 *)
 */
class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/users",
     *      operationId="index",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function index()
    {
       
        return User::all();
    }

    /**
     * @OA\Post(
     *      path="/api/users",
     *      operationId="store",
     *      tags={"User"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'un nouvel utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="first_name", type="string", format="string", example="laporte", description ="votre nom"),
     *       @OA\Property(property="last_name", type="string", format="string", example="jean", description ="votre prenom"),
     *       @OA\Property(property="country", type="string", format="string", example="france", description ="votre pays"),
     *       @OA\Property(property="town", type="string", format="string", example="paris", description ="votre ville"),
     *       @OA\Property(property="type_account", type="string", format="string", example="INDIVIDUAL", description ="votre type de compte"),
     *       @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *       @OA\Property(property="password", type="string", format="string", example="sdms", description ="votre password"),
     *       @OA\Property(property="phone", type="string", format="string", example="123456", description ="votre telephone"),
     *       @OA\Property(property="role", type="string", format="string", example="USER", description ="votre role"),
     *       @OA\Property(property="state", type="string", format="string", example="ACTIF", description ="votre etat"),
     *       @OA\Property(property="birth_date", type="date", format="string", example="2023-09-11", description ="votre date de naissance"),            
     *       @OA\Property(property="name_enterprise", type="string", format="string", example="santa lucia", description ="nom de votreentreprise"), 
     *       @OA\Property(property="siren", type="string", format="string", example="93984rhrfbdfn", description ="votre siren"),
     *       @OA\Property(property="commercial_register", type="string", format="string", example="RNNKNKD323", description ="votre RN"),  
     *       @OA\Property(property="address", type="string", format="string", example="54 rue saint augustin", description ="votre adresse"),
     *       @OA\Property(property="web_site", type="string", format="string", example="exemple.com", description ="votre site web"), 
     *       @OA\Property(property="description", type="string", format="string", example="information sur l'entreprise", description ="votre description"),
     *      
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Utilisateur bien Creer."),
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
    public function store(StoreUserRequest $request)
    {
        $tt = $this->authorize('create', User::class);

        
        $input = $request->validated();

        $data = UserService::store($input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{id}",
     *      operationId="show",
     *      tags={"User"},
     *      summary="Get User",
     *      description="Get User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage d'un utilisateur."),
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
    public function show(User $user)
    {

        $this->authorize('view', $user);

        $data = UserService::view($user);

        if($data === ''){
            abort(400, "This data don't exists");
        }

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{id}",
     *      operationId="update",
     *      tags={"User"},
     *      summary="Update User",
     *      description="Update User",
     *      @OA\Parameter(
     *      name="id",
     *      in="path",
     *      required=true,
     *      description= "user id",
     *      example="10",
     *      @OA\Schema(
     *           type="integer"
     *      )
     * ),
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="reponse de la modification"),
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
    public function update(UpdateUserRequest $request, User $user)
    {
        // $this->authorize('update', $user);

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            $input = $request->validated();

            $data = UserService::update($user, $input);

            return response()->json([
                'code' => 201,
                'data' => $data
            ]);
        }
    }

    /**
     * @OA\Post(
     *      path="/api/users/send-email",
     *      operationId="sendEmail",
     *      tags={"User"},
     *      summary="send email for verify",
     *      description="verify email",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Verification de l'email d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *    @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Verification de l'email."),
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
    public function sendEmail(UpdateUserRequest $request, User $user)
    {
        //permet de recuperer l'adresse mail de l'utilisateur pour verifier si le compte 
        // l'appartient afin qu'il modifie sont mot de passe ou en cas de mot de passe oublier

        $this->authorize('sendEmail', $user);

        $input = $request->validated();

        $data = UserService::sendEmail($user, $input);

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * @OA\Put(
     *      path="/api/users/update-verification-email",
     *      operationId="verification",
     *      tags={"User"},
     *      summary="update state of user who verify her email",
     *      description="verify email",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Verification de l'email d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *    @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Verification de l'email."),
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
    public function verification(User $user)
    {

        //bouton modifier dans le compte de l'utilisateur 

        $this->authorize('sendCode', $user);

        UserService::verification($user);

        return view('welcome');
    }

      /**
     * @OA\Post(
     *      path="/api/users/avatar",
     *      operationId="uploadAvatar",
     *      tags={"User"},
     *      summary="upload avatar file",
     *      description="upload avatar file",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Telechargement du profil utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *      @OA\Property(property="avatar", type="file", format="image", example="https://image.png", description ="votre photos de profil"),   
     *  )
     *        ),
     *      ),
     *    @OA\Response(
     *      response=200,
     *      description="success",
     *      @OA\JsonContent(
     *      @OA\Property(property="avatar_path", type="string", example="users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg"),
     * @OA\Property(property="avatar_url", type="string", example="http://labonneaffaire.test/users/avatar/ghRfjbiJHOvnMBaeerGTwCbYxV0WEnRuRPFod9N3.jpg",
     *
     *        
     * )
     *     ),
     *    @OA\Response(
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
    public function uploadAvatar(StoreUserRequest $request, User $user)
    {
        $this->authorize('uploadAvatar', $user);

        $data = UserService::uploadAvatar($request->file('avatar'));

        return response()->json($data, 200);
    }

    /**
     * @OA\Put(
     *      path="/api/users/update-password",
     *      operationId="updatePassword",
     *      tags={"User"},
     *      summary="update password",
     *      description="update password",
     *      @OA\RequestBody(
     *      required=true,
     *      description="modification du mot de passe d'un utilisateur",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *    @OA\Property(property="email", type="string", format="string", example="examples@gmail.com", description ="votre email"),
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
    public function updatePassword(UpdateUserRequest $request, User $user)
    {

        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {

            $input = $request->validated();

            return UserService::updatePassword($input, $user);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/users/users",
     *      operationId="destroy",
     *      tags={"User"},
     *      summary="delete password",
     *      description="delete password",
     *      
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="modification du mot de passe."),
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
    public function destroy(User $user)
    {
        if ($user->email_verified_at === null) {
            return response()->json([
                'code' => 401,
                'error' => 'Account not validate in email',
                'message' => 'Account is not validate, verify your email',
            ], 401);
        } else {
           return response()->json([
                'message' => 'users successfull delete'
            ], 202);
        }
    }
}
