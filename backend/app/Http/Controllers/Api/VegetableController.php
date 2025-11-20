<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vegetable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VegetableController extends Controller
{
    public function index() {
        return Vegetable::all();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $original = $request->file('image')->getClientOriginalName();
            // Stocke correctement dans storage/app/public/images
            $request->file('image')->storeAs('images', $original, 'public');
            $data['image'] = $original;
        }

        $veg = Vegetable::create($data);

        return response()->json($veg, 201);
    }


    public function update(Request $request, Vegetable $vegetable)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $original = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('images', $original, 'public');
            $data['image'] = $original;
        }

        $vegetable->update($data);

        return response()->json($vegetable, 200);
    }


    public function show(Vegetable $vegetable) {
        return $vegetable;
    }

    public function destroy(Vegetable $vegetable)
    {
        // Supprimer l'image si elle existe
        if ($vegetable->image && Storage::disk('public')->exists('images/' . $vegetable->image)) {
            Storage::disk('public')->delete('images/' . $vegetable->image);
        }

        // Supprimer l'enregistrement BD
        $vegetable->delete();

        return response()->json([
            "message" => "Supprimé avec succès"
        ], 200);
    }

    public function like(Vegetable $vegetable)
    {
        Vegetable::where('id', $vegetable->id)->increment('likes'); // ajoute +1
        $vegetable->refresh(); // pour obtenir la valeur mise à jour
        return response()->json($vegetable, 200);
    }


}
