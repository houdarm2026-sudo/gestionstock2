<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MouvementEntree;
use App\Models\Article;
class MouvementEntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrees=MouvementEntree::with('article')->get();
        return response()->json($entrees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'num_bon_entree'=>'required|unique:mouvement_entrees',
           'date_entree'=>'required|date',
           'qantite_entree'=>'required|integer|min:1',
           'prix_entree'=>'required|numeric|min:0',
           'article_id'=>'required|exists:articles,id',
    //recuperation des articles
        ]);
        $article=Article::findOrFail($request->article_id);
        //creer un mouvement entree
        $entree=MouvementEntree::create([
           'num_bon_entree'=>$request->num_bon_entree,
           'date_entree'=>$request->date_entree,
           'qantite_entree'=>$request->qantite_entree,
           'prix_entree'=>$request->prix_entree,
           'article_id'=>$request->article_id,
        ]);
        //mise a jour du stock
        $article->quantite_en_stock_reel+=$request->qantite_entree;
        $article->save();
        return response()->json([
            'message'=>'Entree ajoutee avec succes',
            'entree'=>$entree,
            'nouveau_stock'=>$article->quantite_en_stock_reel
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entree=MouvementEntree::with('article')->findOrFail($id);
        return response()->json($entree);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // récupérer entree
    $entree = MouvementEntree::findOrFail($id);

    // récupérer article lié
    $article = Article::findOrFail($entree->article_id);

    // retirer la quantité de stock
    $article->quantite_en_stock_reel -= $entree->qantite_entree;

    // éviter stock négatif
    if ($article->quantite_en_stock_reel < 0) {
        $article->quantite_en_stock_reel = 0;
    }

    $article->save();

    // supprimer entree
    $entree->delete();

    return response()->json([
        'message' => 'Entree supprimée avec succès',
        'nouveau_stock' => $article->quantite_en_stock_reel
    ]);
}
}
