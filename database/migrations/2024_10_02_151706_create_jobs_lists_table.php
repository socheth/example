<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("jobs", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->onDelete("cascade");
            $table->foreignId("company_id")->constrained()->onDelete("cascade");
            $table->string("title");
            $table->string("slug");
            $table->string("salary")->default("Negotiable");
            $table->string("type")->default('Full Time')->comment("full_time, part_time, contract, internship");
            $table->string("category")->comment("IT, Marketing, HR");
            $table->string("location")->default('Remote')->comment("city, state, etc.");
            $table->string("status")->default('Open')->comment("open, closed");
            $table->string("experience")->default('1 year')->comment("1 year, 2 years, etc.");
            $table->string("deadline")->nullable();
            $table->string("apply_url")->nullable()->comment("link to apply for the job");
            $table->boolean("is_featured")->default(false);
            $table->boolean("is_active")->default(true);
            $table->text("benefits")->nullable();
            $table->text("requirements");
            $table->text("description");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("jobs");
    }
};