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
        Schema::table('users', function(Blueprint $table){
            if(!Schema::hasColumn('users', 'first_name')){
                $table->string('first_name')->after('id')->nullable();
            }
            if(!Schema::hasColumn('users', 'last_name')){
                $table->string('last_name')->after('first_name')->nullable();
            }

            if(!Schema::hasColumn('users', 'dob')){
                $table->date('dob')->after('phone')->nullable();
            }

            if(!Schema::hasColumn('users', 'gender')){
                $table->enum('gender', ['Male', 'Female', 'Others'])->after('dob')->nullable();
            }

            if(!schema::hasColumn('users', 'newsletter')){
                $table->enum('newsletter', ['Yes', 'No'])->after('gender')->default('Yes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (Schema::hasColumn('users', 'newsletter')) {
                $table->dropColumn('newsletter');
            }

            if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }

            if (Schema::hasColumn('users', 'dob')) {
                $table->dropColumn('dob');
            }

            if (Schema::hasColumn('users', 'last_name')) {
                $table->dropColumn('last_name');
            }

            if (Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }

};
