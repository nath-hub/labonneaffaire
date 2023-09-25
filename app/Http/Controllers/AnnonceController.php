<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnnonceRequest;
use App\Http\Requests\UpdateAnnonceRequest;
use App\Models\Annonce;
use App\Services\Facades\AnnonceFacade as AnnonceService;

class AnnonceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/annonces",
     *      operationId="inde",
     *      tags={"Annonce"},
     *      summary="Get all annonces",
     *      description="Get all annonces",
     *
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="affichage des annonces."),
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
        return Annonce::all();
    }

      /**
     * @OA\Post(
     *      path="/api/annonces",
     *      operationId="stores",
     *      tags={"Annonce"},
     *      summary="Register",
     *      description="Register",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Enregistrement d'une annonce",
     *
     *      @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *       @OA\Property(property="title", type="string", format="string", example="la porte", description ="votre title *"),
     *       @OA\Property(property="size", type="string", format="string", example="M", description ="votre size"),
     *       @OA\Property(property="images", type="string", format="images", example="image.png", description ="images de vos produits *"),
     *       @OA\Property(property="description", type="string", format="string", example="long texte", description ="votre description *"),
     *       @OA\Property(property="state_product", type="string", format="string", example="NEUF", description ="l'etat de votre produits *"),
     *       @OA\Property(property="color", type="string", format="string", example="bleu", description ="color de votre produit"),
     *       @OA\Property(property="localization", type="string", format="string", example="yaounde", description ="votre localization *"),
     *       @OA\Property(property="price", type="string", format="string", example="16000", description ="votre price *"),
     *       @OA\Property(property="option_discutable", type="string", format="string", example="OUI", description ="votre option *"),
     *       @OA\Property(property="date_publish", type="date", format="string", example="date_publish", description ="date publication *"),
     *       @OA\Property(property="job_type", type="string", format="string", example="pantalon", description ="type de votre produit"),            
     *       @OA\Property(property="categorie_id", type="int", format="string", example="1", description ="nom de categorie *"), 
     *       @OA\Property(property="availability", type="string", format="string", example="INDISPONIBLE", description ="votre availability *"),
     *       @OA\Property(property="state_annonce", type="string", format="string", example="VALIDATE", description ="etat de votre annonce *"),  
     *      
     *  )
     *        ),
     *      ),
     *       @OA\Response(
     *      response=201,
     *      description="Success response",
     *      @OA\JsonContent(
     *      @OA\Property(property="status", type="number", example="200"),
     *      @OA\Property(property="message", type="string", example="Annonce bien Creer."),
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
    public function store(StoreAnnonceRequest $request)
    {
        $this->authorize('create', Annonce::class);

        $input = $request->validated();

        $userAuthenticated = $request->user();

        $state = AnnonceService::store($userAuthenticated, $input);

        return $state;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnnonceRequest  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnnonceRequest $request, Annonce $annonce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        //
    }
}
