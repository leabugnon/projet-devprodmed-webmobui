<?php

namespace Database\Seeders;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\Choice;
use Illuminate\Database\Seeder;

class StorySeeder2 extends Seeder
{
    public function run()
    {
        // Créer une nouvelle histoire avec un titre et une description
        $story = Story::create([
            'title' => 'L\'Appel du Dragon',
            'description' => 'Une aventure légendaire où tu devras choisir entre peur et courage, feu et destin.'
        ]);

        // Créer les chapitres associés à l'histoire
        $start = Chapter::create([
            'story_id' => $story->id, // Associe le chapitre à l'histoire
            'title' => 'Le village en flammes',
            'content' => 'Tu ouvres les yeux dans un vacarme assourdissant : ton village est en feu. Des cris, des cendres, et au loin, un rugissement terrifiant. Un dragon. Les anciens disaient qu’il était revenu. Tu as deux options : fuir dans la forêt voisine ou te rendre au vieux sanctuaire au sommet de la colline.',
        ]);

        $forest = Chapter::create([
            'story_id' => $story->id,
            'title' => 'La forêt maudite',
            'content' => 'Tu cours dans la forêt, les branches te griffent le visage. L’obscurité y est presque totale. Tu entends un souffle… mais ce n’est pas le vent. Une créature étrange t’observe. Tu peux continuer à courir ou te cacher sous les racines d’un vieil arbre.',
        ]);

        $sanctuary = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Le sanctuaire du ciel',
            'content' => 'Le sanctuaire est silencieux, recouvert de mousse et de symboles oubliés. Une lumière bleutée émane d’un cercle au sol. En y entrant, tu entends une voix : "Le feu et le ciel te jugeront." Tu peux répondre à l’appel ou fuir par les escaliers.',
        ]);

        $creature = Chapter::create([
            'story_id' => $story->id,
            'title' => 'La créature du bois',
            'content' => 'Une créature aux yeux d’ambre s’approche. Elle semble ancienne, presque divine. Elle te murmure que tu portes un fragment d’âme draconique. Elle te propose un pacte. Vas-tu l’accepter ?',
        ]);

        $ritual = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Le rituel du feu',
            'content' => 'Tu entres dans le cercle de lumière. Ton corps s’élève, entouré de flammes douces. Une vision t’envahit : un dragon t’attend, enchaîné sous une montagne. Tu ressens sa douleur comme si c’était la tienne. Tu peux jurer de le libérer, ou briser le lien et revenir.',
        ]);

        $dragon_fight = Chapter::create([
            'story_id' => $story->id,
            'title' => 'Le duel céleste',
            'content' => 'Guidé par la créature ou le rituel, tu te retrouves face au dragon ancestral. Il t’attend, immense, entouré de chaînes magiques. Ses yeux brillent de fureur… ou de désespoir. Tu peux tenter de l’affronter ou chercher à le comprendre.',
        ]);

        $ending = Chapter::create([
            'story_id' => $story->id,
            'title' => 'L’héritier du feu',
            'content' => 'Tu tends la main au dragon. Un pacte ancien se réveille. Les chaînes tombent. Une lumière t’enveloppe. Tu ne seras plus jamais le même : désormais, tu es lié au feu et aux cieux. Le monde tremblera devant ton destin.',
            'is_end' => true,
        ]);

        // Créer les choix pour le chapitre de départ
        Choice::create([
            'chapter_id' => $start->id, // Associe le choix au chapitre de départ
            'label' => 'Fuir dans la forêt', // Texte du choix
            'target_chapter_id' => $forest->id, // Chapitre cible lorsque ce choix est sélectionné
        ]);

        Choice::create([
            'chapter_id' => $start->id,
            'label' => 'Grimper vers le sanctuaire',
            'target_chapter_id' => $sanctuary->id,
        ]);

        // Créer les choix pour les autres chapitres
        Choice::create([
            'chapter_id' => $forest->id,
            'label' => 'Te cacher sous l’arbre',
            'target_chapter_id' => $creature->id,
        ]);

        Choice::create([
            'chapter_id' => $forest->id,
            'label' => 'Continuer à courir',
            'target_chapter_id' => $sanctuary->id,
        ]);

        Choice::create([
            'chapter_id' => $sanctuary->id,
            'label' => 'Répondre à l’appel magique',
            'target_chapter_id' => $ritual->id,
        ]);

        Choice::create([
            'chapter_id' => $sanctuary->id,
            'label' => 'Fuir par les escaliers',
            'target_chapter_id' => $forest->id,
        ]);

        Choice::create([
            'chapter_id' => $creature->id,
            'label' => 'Accepter le pacte',
            'target_chapter_id' => $dragon_fight->id,
        ]);

        Choice::create([
            'chapter_id' => $ritual->id,
            'label' => 'Jurer de libérer le dragon',
            'target_chapter_id' => $dragon_fight->id,
        ]);

        Choice::create([
            'chapter_id' => $dragon_fight->id,
            'label' => 'Essayer de le comprendre',
            'target_chapter_id' => $ending->id,
        ]);

        Choice::create([
            'chapter_id' => $dragon_fight->id,
            'label' => 'L’affronter',
            'target_chapter_id' => $ending->id,
        ]);
    }
}
