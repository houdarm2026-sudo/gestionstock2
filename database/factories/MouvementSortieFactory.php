<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MouvementSortie>
 */
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
