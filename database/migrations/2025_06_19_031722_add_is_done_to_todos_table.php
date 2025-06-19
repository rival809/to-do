<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDoneToTodosTable extends Migration
{
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->boolean('is_done')->default(false)->after('updated_at');
        });
    }

    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn('is_done');
        });
    }
}
