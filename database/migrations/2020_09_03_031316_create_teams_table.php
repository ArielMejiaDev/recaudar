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
            $table->string('name');
            $table->string('slug');
            $table->string('category');
            $table->longText('description');
            $table->string('public');
            $table->integer('beneficiaries');
            $table->longText('impact');
            $table->string('legal_representative');
            $table->string('tax_number');
            $table->string('office_address');
            $table->longText('use_of_funds');
            $table->string('contact');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('promotional_video')->nullable();
            $table->string('facebook_account')->nullable();
            $table->string('twitter_account')->nullable();
            $table->string('instagram_account')->nullable();
            $table->string('theme')->nullable()->default('columns');
            $table->string('bank');
            $table->string('account_number');
            $table->string('country');
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
