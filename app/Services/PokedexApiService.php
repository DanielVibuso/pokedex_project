<?php

namespace App\Services;

use App\Helpers\PokedexHelper;
use Illuminate\Support\Facades\Http;

class PokedexApiService{

    private $itemsPerPage = 10;
    private $options      = ['path'=>'list'];


    public function listAllPokemons($page){
        $data = $this->getData("https://pokeapi.co/api/v2/pokedex/1/");
        $pokemonsList = $data['pokemon_entries'];

        $data = PokedexHelper::paginateResponse(
                                $pokemonsList,
                                $this->itemsPerPage,
                                $page,
                                $this->options
                            );
        return $data;
    }

    public function getDetail($id){
        $url  = "https://pokeapi.co/api/v2/pokemon/{$id}/";
        $data = $this->getData($url);
        return $data;
    }

    public function getFormDetail($id){
        $url  = "https://pokeapi.co/api/v2/pokemon-form/{$id}/";
        $data = $this->getData($url);
        return $data;
    }

    public function getLocalAreaEncounters($url){
        // $url  = "https://pokeapi.co/api/v2/pokemon/{$id}/encounters";
        $data = $this->getData($url);
        return $data;
    }

    public function getData($url){
        $response  = Http::get($url);
        if(!$response->status(200)){
            return json()->respose(['status'=>'erro']);
        }

        return $response->json();
    }
}


?>