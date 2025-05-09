<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
     // Déclare les champs autorisés à être remplis en masse
    protected $fillable = ['chapter_id', 'label', 'target_chapter_id'];

        /**
     * Relation : ce choix appartient à un chapitre.
     * C'est le chapitre où le choix est affiché à l'utilisateur.
     */
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
    /**
     * Relation : ce choix mène à un autre chapitre (le chapitre ciblé par le choix).
     * Exemple : "Aller à la grotte" → chapter_id = 1, target_chapter_id = 2
     */
    public function targetChapter()
    {
        return $this->belongsTo(Chapter::class, 'target_chapter_id');
    }
}
