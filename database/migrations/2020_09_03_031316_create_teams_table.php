<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('category', 30);
            $table->longText('description');
            $table->string('public', 100);
            $table->integer('beneficiaries');
            $table->mediumText('impact');
            $table->string('legal_representative', 100);
            $table->string('tax_number', 100);
            $table->string('office_address', 100);
            $table->mediumText('use_of_funds');
            $table->string('contact', 100);
            $table->string('contact_phone', 100);
            $table->string('contact_email', 64);
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('promotional_video')->nullable();
            $table->string('facebook_account')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('instagram_account')->nullable();
            $table->string('theme', 50)->nullable()->default('columns');
            $table->string('bank', 50);
            $table->string('account_number', 20);
            $table->string('country', 75);
            $table->string('plan', 10)->default('free');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
}
