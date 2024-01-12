<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Commande extends Model
{
    use HasFactory, Notifiable , HasUuids;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class,'commande_articles', 'num_commande', 'code_article');
    }

    public function commande_articles()
    {
        return $this->hasMany(Commande_article::class, 'num_commande');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'username',
        'user_id',
        'date_commande',
        'prixTTC',
        'date_livraison',
        'num_commande'
    ];


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'num_commande';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

}
