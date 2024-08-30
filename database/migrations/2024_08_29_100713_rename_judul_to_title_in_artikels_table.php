<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameJudulToTitleInArtikelsTable extends Migration
{
    public function up()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->renameColumn('judul', 'title');
        });
    }

    public function down()
    {
        Schema::table('artikels', function (Blueprint $table) {
            $table->renameColumn('title', 'judul');
        });
    }
};
