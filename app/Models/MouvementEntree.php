<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementEntree extends Model
{
    use HasFactory;
    protected $fillable=[
        'num_bon_entree',
        'date_entree','qantite_entree','prix_entree','article_id'
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
