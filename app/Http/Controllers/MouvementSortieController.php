<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\MouvementSortie;
class MouvementSortieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sorties=MouvementSortie::with('article')->get();
        return response()->json($sorties);
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
            'num_bon_sortie'=>'required|unique:mouvement_sorties',
            'date_sortie'=>'required|date',
            'qantite_sortie'=>'required|integer|min:1',
            'prix_sortie'=>'required|numeric|min:0',
            'article_id'=>'required|exists:articles,id',
        ]);
        $article=Article::findOrFail($request->article_id);
        if($article->quantite_en_stock_reel<$request->qantite_sortie){
            return response()->json([
                'message'=>"Stock insuffisant"
            ],400);
        }
        //create sortie
        $sortie=MouvementSortie::create([
            'num_bon_sortie'=>$request->num_bon_sortie,
            'date_sortie'=>$request->date_sortie,
            'qantite_sortie'=>$request->qantite_sortie,
            'prix_sortie'=>$request->prix_sortie,
            'article_id'=>$request->article_id,
        ]);
        //update stock 
        $article->quantite_en_stock_reel-=$request->qantite_sortie;
        $article->save();

        return response()->json([
            'message'=>'Sortie ajoutee avec succes',
            'sortie'=>$sortie,
            'nouveau_stock'=>$article->quantite_en_stock_reel
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return MouvementSortie::with('article')->findOrFail($id);
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
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $sortie=MouvementSortie::findOrFail($id);

        $article=Article::findOrFail($sortie->article_id);

        $article->quantite_en_stock_reel +=$sortie->qantite_sortie;
        
        $article->save();

        $sortie->delete();

        return response()->json([
            'message'=>"Sortie supprime avec stock restaure",
            'stock'=>$article->quantite_en_stock_reel
        ]);
    }
}
