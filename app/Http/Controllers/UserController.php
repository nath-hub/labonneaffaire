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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     *       @OA\Property(property="role", type="string", format="string", example="simple utilisateur", description ="votre role"),
     *       @OA\Property(property="state", type="string", format="string", example="actif/inactif", description ="votre etat"),
     *       @OA\Property(property="birth_date", type="date", format="string", example="12/09/2023", description ="votre date de naissance"),            
     *       @OA\Property(property="name_enterprise", type="string", format="string", example="santa lucia", description ="nom de votreentreprise"), 
     *       @OA\Property(property="siren", type="string", format="string", example="93984rhrfbdfn", description ="votre siren"),
     *       @OA\Property(property="commercial_register", type="string", format="string", example="RNNKNKD323", description ="votre RN"),  
     *       @OA\Property(property="address", type="string", format="string", example="54 rue saint augustin", description ="votre adresse"),
     *       @OA\Property(property="web_site", type="string", format="string", example="exemple.com", description ="votre site web"), 
     *       @OA\Property(property="description", type="string", format="string", example="information sur l'entreprise", description ="votre description"),
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
        $this->authorize('create', User::class);

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

        return response()->json([
            'code' => 201,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
