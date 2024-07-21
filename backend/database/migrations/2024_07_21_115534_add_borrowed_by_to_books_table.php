<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('books', function (Blueprint $table) {
        $table->unsignedBigInteger('borrowed_by')->nullable()->after('is_borrowed');
        $table->foreign('borrowed_by')->references('id')->on('users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->dropForeign(['borrowed_by']);
        $table->dropColumn('borrowed_by');
    });
}

};
