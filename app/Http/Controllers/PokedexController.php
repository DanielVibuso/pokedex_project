<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PokedexApiService;
use Illuminate\Support\Facades\View;

class PokedexController extends Controller
{
    public function listAll(PokedexApiService $pokedexApi, $page = null){
        $list = $pokedexApi->listAllPokemons($page);
        return view('list', compact('list'));
    }

    public function getDetail(PokedexApiService $pokedexApi, $id){
        $detail = $pokedexApi->getDetail($id);
        $localAreaEncountersURL = $detail['location_area_encounters'];
        $encountersDetail = $pokedexApi->getLocalAreaEncounters($localAreaEncountersURL);
        $formDetail = $pokedexApi->getFormDetail($id);
        return view('detail', compact('detail', 'formDetail', 'encountersDetail'));
    }

}
