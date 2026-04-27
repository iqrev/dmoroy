<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('media') && ! Schema::hasTable('curator')) {
            Schema::rename('media', 'curator');
        }

        if (! Schema::hasTable('curator')) {
            Schema::create('curator', function (Blueprint $table) {
                $table->id();
                $table->string('disk');
                $table->string('directory')->nullable();
                $table->string('visibility')->default('public');
                $table->string('name');
                $table->string('path')->index();
                $table->unsignedInteger('width')->nullable();
                $table->unsignedInteger('height')->nullable();
                $table->unsignedInteger('size')->nullable();
                $table->string('type');
                $table->string('ext');
                $table->string('alt')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
                $table->text('caption')->nullable();
                $table->text('pretty_name')->nullable();
                $table->text('exif')->nullable();
                $table->longText('curations')->nullable();
                $table->unsignedBigInteger('tenant_id')->nullable();
                $table->timestamps();
            });
        } else {
            Schema::table('curator', function (Blueprint $table) {
                if (! Schema::hasColumn('curator', 'pretty_name')) {
                    $table->text('pretty_name')->nullable()->after('caption');
                }
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('curator');
    }
};
