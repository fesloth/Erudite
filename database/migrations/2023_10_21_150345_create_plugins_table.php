<?php

use App\Models\Conference;
use App\Models\ScheduledConference;
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
        Schema::create('plugin_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Conference::class)->default(0);
            $table->foreignIdFor(ScheduledConference::class)->default(0);
            $table->string('plugin');
            $table->string('key');
            $table->text('value')->nullable();
            $table->string('type');

            $table->unique(['conference_id', 'scheduled_conference_id', 'plugin', 'key'], 'plugin_settings_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
