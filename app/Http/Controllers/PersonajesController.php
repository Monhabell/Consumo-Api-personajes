<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Personajes;

class PersonajesController extends Controller
{
    public function fetchApi()
    {
        $Personajes = [];
        for ($i = 1; $i <= 5; $i++) {
            $response = Http::get("https://rickandmortyapi.com/api/character/?page=$i");
            if ($response->successful()) {
                $Personajes = array_merge($Personajes, $response->json()['results']);
            }
        }
        return view('personajes.api', ['Personajes' => $Personajes]);
    }

    public function storeToDatabase()
    {
        $Personajes = [];
        for ($i = 1; $i <= 5; $i++) {
            $response = Http::get("https://rickandmortyapi.com/api/character/?page=$i");
            if ($response->successful()) {
                $Personajes = array_merge($Personajes, $response->json()['results']);
            }
        }

        foreach ($Personajes as $char) {
            Personajes::updateOrCreate(
                ['id' => $char['id']], 
                [
                    'name' => $char['name'],
                    'status' => $char['status'],
                    'species' => $char['species'],
                    'type' => $char['type'], 
                    'sex' => $char['gender'], 
                    'origin_name' => $char['origin']['name'],
                    'origin_url' => $char['origin']['url'],
                    'image' => $char['image'],
                ]
            );
        }
        return redirect()->route('personajes.db')->with('success', 'Personajes guardados y/o actualizados en la base de datos');
    }

    public function showFromDatabase()
    {
        $Personajes = Personajes::all();
        return view('personajes.database', compact('Personajes'));
    }

    public function update(Request $request, $id)
    {
        $character = Personajes::findOrFail($id);
        $character->update($request->all());
        return redirect()->route('personajes.db')->with('success', 'Personaje actualizado correctamente');
    }

}
