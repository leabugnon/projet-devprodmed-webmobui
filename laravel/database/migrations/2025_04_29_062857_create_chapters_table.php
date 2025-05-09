<?php
// database/migrations/xxxx_xx_xx_create_chapters_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('story_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->boolean('is_end')->default(false); // Pour marquer si c’est un chapitre final
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
