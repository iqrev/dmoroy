<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create pivot table
        Schema::create('post_post_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // 2. Migrate existing data
        $posts = DB::table('posts')->whereNotNull('category_id')->get();
        foreach ($posts as $post) {
            DB::table('post_post_category')->insert([
                'post_id' => $post->id,
                'post_category_id' => $post->category_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Drop existing category_id from posts
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('post_categories')->onDelete('set null');
        });

        // Migrate data back (optional, only takes first category)
        $pivots = DB::table('post_post_category')->get();
        foreach ($pivots as $pivot) {
            DB::table('posts')->where('id', $pivot->post_id)->update(['category_id' => $pivot->post_category_id]);
        }

        Schema::dropIfExists('post_post_category');
    }
};
