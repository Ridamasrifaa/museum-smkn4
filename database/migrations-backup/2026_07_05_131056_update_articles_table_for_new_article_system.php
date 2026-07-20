<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {

            // Ganti nama kolom lama
            // $table->renameColumn('user_id', 'author_id');
            // $table->renameColumn('thumbnail', 'cover');

            // Kolom baru
            $table->foreignId('category_id')
                ->nullable()
                ->after('author_id')
                ->constrained('article_categories')
                ->nullOnDelete();

            $table->text('excerpt')
                ->nullable()
                ->after('slug');

            $table->boolean('is_featured')
                ->default(false);

            $table->timestamp('published_at')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {

            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id',
                'excerpt',
                'is_featured',
                'published_at'
            ]);

            $table->renameColumn('author_id', 'user_id');
            $table->renameColumn('cover', 'thumbnail');
        });
    }
};