<?php
// database/migrations/xxxx_xx_xx_create_choices_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoicesTable extends Migration
{
    public function up()
    {
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained()->onDelete('cascade');
            $table->string('label'); // Le texte du choix affiché
            $table->foreignId('target_chapter_id')->nullable()->constrained('chapters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('choices');
    }
}
