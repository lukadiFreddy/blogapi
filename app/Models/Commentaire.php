<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'contenu',
        'like',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class);
    }
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    
}
