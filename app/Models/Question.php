<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image_url'];

    // Relation avec les réponses
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Récupérer les réponses publiées
    public function publishedAnswers()
    {
        return $this->hasMany(Answer::class)->where('is_published', true);
    }

    // Compter le nombre de réponses
    public function answersCount()
    {
        return $this->answers()->count();
    }

    // Recherche par titre
    public static function searchByTitle($keyword)
    {
        return self::where('title', 'like', '%' . $keyword . '%')->get();
    }

    // Casts pour des champs spécifiques
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
