<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->longText('address_one')->nullable();
            $table->longText('address_two')->nullable();
            $table->integer('province_id')->unsigned()->nullable();
            $table->integer('regency_id')->unsigned()->nullable();
            $table->string('zipcode')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('store_name')->nullable();
            $table->integer('store_status')->default(0);
            $table->foreignId('category_id');
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address_one');
            $table->dropColumn('address_two');
            $table->dropColumn('province_id');
            $table->dropColumn('regency_id');
            $table->dropColumn('zipcode');
            $table->dropColumn('phone_number');
            $table->dropColumn('store_name');
            $table->dropColumn('store_status');
            $table->dropColumn('category_id');
            $table->dropSoftDeletes();

            $table->dropForeign(['category_id']);
        });
    }
}
