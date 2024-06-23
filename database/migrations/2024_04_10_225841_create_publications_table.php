<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->longText('title')->nullable();
            $table->longText('title_truncate')->nullable();
            $table->longText('slug')->nullable();
            $table->string('date_name');
            $table->string('date_name_default')->default('ALL');
            $table->longText('content')->nullable();
            $table->longText('truncate_content')->nullable();
            $table->longText('truncate_content_max')->nullable();
            $table->boolean('deja_citer')->default(0);
            $table->string('category_name')->nullable();
            $table->string('category_id')->nullable();
            $table->string('category_slug')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_slug')->nullable();
            $table->integer('author_id')->nullable();
            $table->bigInteger('views_count')->default(0);
            $table->bigInteger('likes_count')->default(0);
            $table->bigInteger('shares_count')->default(0);
            $table->string('og_file_url')->nullable();
            $table->integer('type_publication_id')->nullable();
            $table->string('type_publication_name')->nullable();
            $table->string('type_publication_slug')->nullable();
            $table->integer('wp_article_id')->nullable();
            $table->integer('status')->default(0);
            $table->integer('presently')->default(0);
            $table->boolean('comment_status')->default(1);
            $table->integer('comment_count')->default(0);
            $table->dateTime('date_publish')->nullable();
            $table->dateTime('date_publish_end')->nullable();
            $table->integer('user_id')->default(1);
            $table->string('source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
