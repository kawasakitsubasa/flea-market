<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('comments', function (Blueprint $table) {
        $table->foreignId('product_id')
              ->after('user_id')
              ->constrained()
              ->onDelete('cascade');
      });
    }

    public function down()
    {
    Schema::table('comments', function (Blueprint $table) {
        $table->dropConstrainedForeignId('product_id');
      });
    }
}
