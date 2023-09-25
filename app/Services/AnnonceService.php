<?php

namespace App\Services;

use App\Models\Annonce;
use App\Models\AnnonceUser;

class AnnonceService
{
    public function store($userAutentificated, $input)
    {

        $input[] = collect($input)->merge([
            'user_id' => $userAutentificated->id,
        ]);

        $input['user_id'] = $userAutentificated->id;

        $state = Annonce::create($input);

        $data = new AnnonceUser();
        $data->user_id = $userAutentificated->id;
        $data->annonce_id = $state->id;
        $data->save();

        return $state;
    }
}
