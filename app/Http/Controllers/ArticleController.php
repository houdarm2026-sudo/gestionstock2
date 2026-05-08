<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles=Article::all();
        return response()->json($articles);
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
            'code_article'=>'required|unique:articles',
            'designation'=>'required',
            'quantite_en_stock_reel'=>'required|integer|min:0',
            'stock_min'=>'required|integer|min:0',
            'stock_max'=>'required|numeric|min:1',
            'prix'=>'required|numeric|min:0',
        ]);
        $article=Article::create([
            'code_article'=>$request->code_article,
            'designation'=>$request->designation,
            'quantite_en_stock_reel'=>$request->quantite_en_stock_reel,
            'stock_min'=>$request->stock_min,
            'stock_max'=>$request->stock_max,
            'prix'=>$request->prix,
        ]);
        return response()->json([
        'message'=>"Article ajouté avec succes",
        'article'=>$article],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article=Article::findOrFail($id);
        return response()->json($article);
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
         $request->validate([
            'code_article'=>'required|unique:articles,code_article,' .$id,
            'designation'=>'required',
            'quantite_en_stock_reel'=>'required|integer|min:0',
            'stock_min'=>'required|integer|min:0',
            'stock_max'=>'required|numeric|min:1',
            'prix'=>'required|numeric|min:0',
        ]);
        $article=Article::findOrFail($id);
        $article->update([
            'code_article'=>$request->code_article,
            'designation'=>$request->designation,
            'quantite_en_stock_reel'=>$request->quantite_en_stock_reel,
            'stock_min'=>$request->stock_min,
            'stock_max'=>$request->stock_max,
            'prix'=>$request->prix,
        ]);
        return response()->json([
            'message'=>"Article modifie avec success",
            'article'=>$article,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article=Article::findOrFail($id);
        $article->delete();
        return response()->json([
            'message'=>'Article supprime avec succes'
        ]);
    }
}
