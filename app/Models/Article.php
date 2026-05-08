<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
   protected $fillable=[
    'code_article','designation','quantite_en_stock_reel','stock_min','stock_max','prix'
   ];
   public function sorties(){

    return $this->hasMany(MouvementSortie::class);

   }
   public  function entrees(){

    return $this->hasMany(MouvementEntree::class);

   }
}
