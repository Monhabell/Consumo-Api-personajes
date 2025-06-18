<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\personajes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PersonajesController extends Controller
{

    private function obtenerPersonajesApi($paginas = 5)
    {
        $personajes = [];
        for ($i = 1; $i <= $paginas; $i++) {
            $response = Http::get("https://rickandmortyapi.com/api/character/?page=$i");
            if ($response->successful()) {
                $personajes = array_merge($personajes, $response->json()['results']);
            }
        }
        return $personajes;
    }

    public function fetchApi(Request $request)
    {
        $personajes = $this->obtenerPersonajesApi();
        $perPage = 8;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = collect($personajes);
        $currentPageItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            count($items),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
        return view('personajes.api', ['personajes' => $paginator]);
    }

    public function storeToDatabase()
    {
        $personajes = $this->obtenerPersonajesApi();
        foreach ($personajes as $personaje) {
            personajes::updateOrCreate(
                ['id' => $personaje['id']], 
                [
                    'name' => $personaje['name'],
                    'status' => $personaje['status'],
                    'species' => $personaje['species'],
                    'type' => $personaje['type'], 
                    'sex' => $personaje['gender'], 
                    'origin_name' => $personaje['origin']['name'],
                    'origin_url' => $personaje['origin']['url'],
                    'image' => $personaje['image'],
                ]
            );
        }
        return redirect()->route('personajes.db')->with('success', 'personajes guardados y/o actualizados en la base de datos');
    }

    public function showFromDatabase()
    {
        $personajes = personajes::all();
        if ($personajes->isEmpty()) {
            return view('personajes.database')->with('mensaje', 'No hay personajes almacenados en la base de datos');
        }
        return view('personajes.database', compact('personajes'));
    }


    public function update(Request $request, $id)
    {
        $character = personajes::findOrFail($id);
        $character->update($request->all());
        return redirect()->route('personajes.db')->with('success', 'Personaje actualizado correctamente');
    }

}
