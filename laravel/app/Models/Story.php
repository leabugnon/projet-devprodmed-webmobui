<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    // Autorise le remplissage en masse des champs 'title' et 'description'
    protected $fillable = ['title', 'description'];
    /**
     * Relation : une histoire possède plusieurs chapitres.
     * Chaque chapitre appartient à une seule histoire.
     */
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    
}
