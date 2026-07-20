<?php

namespace App\Http\Controllers;
use App\Models\Film;
use Illuminate\Http\Request;

class filmController extends Controller
{
    //Funcion usada para ver las peliculas de forma paginada con filtros
    public function index(Request $request)
    {
        $camposPermitidos = ['film_id', 'title', 'rating', 'release_year'];
        $camposNumericos = ['film_id', 'release_year']; // estos se comparan exacto por eso el array apartado
        $campo = $request->query('campo');
        $valor = $request->query('valor');

        $query = Film::query();

        if ($campo && $valor && in_array($campo, $camposPermitidos)) {
            if (in_array($campo, $camposNumericos)) {
                // comparación exacta para ID y año
                $query->where($campo, '=', $valor);
            } else {
                // "contiene" para título y categoría
                $query->where($campo, 'like', '%' . $valor . '%');
            }
        }

        return $query->paginate(10)->appends($request->query());
    }

    public function id()
    {
        return Film::select('film_id')->get();
    }

    public function show($id)
    {
        return Film::find($id);
    }
   
    //Funcion que lleva a la pestaña principal de películas
    public function showFilms()
    {
        return view('films');
    }


    //Funcion que lleva a la pestaña de administracion de películas
     public function adminFilms()
    {
        return view('filmsAdmin');
    }

     //Funcion que lleva a la pestaña para añadir películas
     public function editFilms()
    {
        return view('filmsEdit');
    }

    public function showAddForm()
    {
        return view('filmsAdd');
    }

    // Validación reutilizable + Crear
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1901|max:2155',
            'language_id' => 'required|integer',
            'rental_duration' => 'required|integer|min:1',
            'rental_rate' => 'required|numeric|min:0',
            'length' => 'nullable|integer|min:1',
            'replacement_cost' => 'required|numeric|min:0',
            'rating' => 'nullable|string|max:10',
        ]);

        $film = Film::create($validated);

        return response()->json(['message' => 'Película creada correctamente', 'film' => $film]);
    }

    // Editar
    public function update(Request $request, $id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'release_year' => 'nullable|integer|min:1901|max:2155',
            'language_id' => 'required|integer',
            'rental_duration' => 'required|integer|min:1',
            'rental_rate' => 'required|numeric|min:0',
            'length' => 'nullable|integer|min:1',
            'replacement_cost' => 'required|numeric|min:0',
            'rating' => 'nullable|string|max:10',
        ]);

        $film->update($validated);

        return response()->json(['message' => 'Película actualizada correctamente', 'film' => $film]);
    }
    //Borar perlis
    public function destroy($id)
    {
        $film = Film::find($id);

        if (!$film) {
            return response()->json(['message' => 'Película no encontrada'], 404);
        }

        $film->delete();

        return response()->json(['message' => 'Película eliminada correctamente']);
    }
}
