<?php

use App\Facades\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Schema::dropIfExists('settings');

        Schema::create('settings', function (Blueprint $table) {
            $table->String('key', 256);
            $table->text('value');
            $table->timestamps();

            $table->primary('key');
            
        });

        $this->setDefaultSettings();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }


    public function setDefaultSettings(){
        Setting::set('register', true);
    }
}
