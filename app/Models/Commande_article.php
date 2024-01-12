<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande_article extends Model
{
    use HasFactory;

    public function article()
    {
        return $this->belongsTo(Article::class, 'code_article');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_article',
        'num_commande',
        'quantite',
        'prixTotal'
    ];




}
