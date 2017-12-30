<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->tinyInteger('status')->default(0);
            $table->unsignedInteger('max_cpu_utilizatio_rate')->default(1);
            $table->unsignedInteger('max_mem')->default(1024);
            $table->unsignedInteger('max_hard_disk_capacity')->default(0);
            $table->unsignedInteger('max_hard_disk_read_speed')->default(50);
            $table->unsignedInteger('max_hard_disk_write_speed')->default(50);
            $table->unsignedInteger('max_unused_up_bandwidth')->default(100);
            $table->unsignedInteger('max_using_up_bandwidth')->default(100);
            $table->unsignedInteger('expire');
            $table->unsignedInteger('host_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();


            // 怕服务器数量过多影响性能 以后再考虑加
            /* $table->foreign('host_id')
            ->references('id')
            ->on("hosts")->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on("users")->onDelete('cascade'); */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
