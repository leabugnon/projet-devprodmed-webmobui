<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
        // Déclare les champs autorisés à être remplis en masse (via un formulaire ou une requête)
    protected $fillable = ['story_id', 'title', 'content', 'is_end'];
    /**
     * Relation avec l'histoire (Story) à laquelle ce chapitre appartient.
     * Un chapitre appartient à une seule histoire.
     */
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
    /**
     * Relation avec les choix (Choice) associés à ce chapitre.
     * Un chapitre peut avoir plusieurs choix possibles.
     */
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
