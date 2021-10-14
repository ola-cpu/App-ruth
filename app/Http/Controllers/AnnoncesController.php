<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnoncesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $annonce = Annonce::latest()->get();

    // On transmet les Post à la vue
    return view("annonces.index", compact("annonce"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("annonces.edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // 1. La validation
    $this->validate($request, [
        'title' => 'bail|required|string|max:255',
        "picture" => 'bail|required|image|max:1024',
        "content" => 'bail|required',
        "price" => 'bail|required',
    ]);

    // 2. On upload l'image dans "/storage/app/public/annonces"
    $chemin_image = $request->picture->store("annonces");

    // 3. On enregistre les informations d'une annonces
    Annonce::create([
        "title" => $request->title,
        "picture" => $chemin_image,
        "content" => $request->content,
        "price" => $request->price,
    ]);

    // 4. On retourne vers tous les annonces
    return redirect(route("annonces.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {
        return view("annonces.show", compact("annonce"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function edit(Annonce $annonce)
    {
        return view("annocess.edit", compact("annonce"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        // 1. La validation

    // Les règles de validation pour "title" et "content"
    $rules = [
        'title' => 'bail|required|string|max:255',
        "content" => 'bail|required',
        "price" => 'bail|required',
    ];

    // Si une nouvelle image est envoyée
    if ($request->has("picture")) {
        // On ajoute la règle de validation pour "picture"
        $rules["picture"] = 'bail|required|image|max:1024';
    }

    $this->validate($request, $rules);

    // 2. On upload l'image dans "/storage/app/public/annonce"
    if ($request->has("picture")) {

        //On supprime l'ancienne image
        Storage::delete($annonce->picture);

        $chemin_image = $request->picture->store("annonce");
    }

    // 3. On met à jour les informations du Post
    $annonce->update([
        "title" => $request->title,
        "picture" => isset($chemin_image) ? $chemin_image : $annonce->picture,
        "content" => $request->content,
        "price" => $request->price
    ]);

    // 4. On affiche le Post modifié : route("posts.show")
    return redirect(route("annonces.show", $annonce));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
         // On supprime l'image existant
    Storage::delete($annonce->picture);

    // On les informations de l'annonces "
    $annonce->delete();

    // Redirection route 
    return redirect(route('annonces.index'));
    }
}
