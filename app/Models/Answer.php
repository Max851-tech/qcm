<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // Colonnes remplies via formulaire ou requête
    protected $fillable = ['question_id', 'content', 'is_correct'];

    // Conversion automatique des types
    protected $casts = [
        'is_correct' => 'boolean',
    ];

    /**
     * Relation inverse : une réponse appartient à une question.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * Récupérer uniquement les réponses correctes pour une question donnée.
     *
     * @param int $questionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function correctAnswersForQuestion($questionId)
    {
        return self::where('question_id', $questionId)->where('is_correct', true)->get();
    }

    /**
     * Récupérer toutes les réponses pour une question donnée.
     *
     * @param int $questionId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function allAnswersForQuestion($questionId)
    {
        return self::where('question_id', $questionId)->get();
    }

    /**
     * Règles de validation pour les réponses.
     *
     * @return array
     */
    public static function validationRules()
    {
        return [
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string|max:255',
            'is_correct' => 'nullable|boolean',
        ];
    }
}
