<?php
namespace Database\Seeders;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;
use Illuminate\Database\Seeder;

//seeder pour créer une histoire avec des chapitres et des choix
class StorySeeder extends Seeder
{
    public function run()
    {
        // Créer l'histoire
        $story = Story::create([
            'title' => 'Aventure en forêt',
            'description' => 'Une aventure où chaque choix compte...'
        ]);

        // Créer les chapitres
        $forest = Chapter::create([
            'story_id' => $story->id,
            'title' => 'La forêt mystérieuse',
            'content' => 'Tu es au milieu d’une forêt. Où veux-tu aller ?',
        ]);

        $well = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Le vieux puits',
            'content' => 'Tu trouves un vieux puits. Que fais-tu ?',
        ]);

        $cave = Chapter::create([
            'story_id' => $story->id,
            'title' => 'La caverne sombre',
            'content' => 'Une caverne semble t’inviter. Que fais-tu ?',
        ]);

        $bad_end = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Fin tragique',
            'content' => 'Tu tombes au fond du puits... Fin tragique.',
            'is_end' => true,
        ]);

        $good_end = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Trésor caché',
            'content' => 'Tu découvres un trésor caché ! Bravo !',
            'is_end' => true,
        ]);

        // Ajouter les choix du début
        Choice::create([
            'chapter_id' => $forest->id,
            'label' => 'Aller à gauche vers le puits',
            'target_chapter_id' => $well->id,
        ]);

        Choice::create([
            'chapter_id' => $forest->id,
            'label' => 'Aller à droite vers la caverne',
            'target_chapter_id' => $cave->id,
        ]);

        // Ajouter les choix du puits
        Choice::create([
            'chapter_id' => $well->id,
            'label' => 'Descendre dans le puits',
            'target_chapter_id' => $bad_end->id,
        ]);

        Choice::create([
            'chapter_id' => $well->id,
            'label' => 'Faire demi-tour',
            'target_chapter_id' => $forest->id,
        ]);

        // Ajouter les choix de la caverne
        Choice::create([
            'chapter_id' => $cave->id,
            'label' => 'Entrer dans la caverne',
            'target_chapter_id' => $good_end->id,
        ]);

        Choice::create([
            'chapter_id' => $cave->id,
            'label' => 'Revenir en arrière',
            'target_chapter_id' => $forest->id,
        ]);
    }
}
