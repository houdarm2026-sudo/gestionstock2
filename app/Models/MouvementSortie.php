<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MouvementSortie extends Model
{
    use HasFactory;

    protected $table = 'mouvement_sorties';

    protected $fillable = [
        'num_bon_sortie',
        'date_sortie',
        'qantite_sortie',
        'prix_sortie',
        'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}