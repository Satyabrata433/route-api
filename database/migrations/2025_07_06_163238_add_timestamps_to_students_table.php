<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddTimestampsToStudentsTable extends Migration
{
    public function up()
    {
        DB::statement('ALTER TABLE students ADD created_at TIMESTAMP NULL, ADD updated_at TIMESTAMP NULL');
    }

    public function down()
    {
        DB::statement('ALTER TABLE students DROP COLUMN created_at, DROP COLUMN updated_at');
    }
}