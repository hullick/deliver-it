<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceSubscriptionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_subscription', function (Blueprint $table) {
            $table->id();
            $table->foreignId('runner_id')
                ->constrained("runner")
                ->onUpdate('cascade')
                ->nullable(false);
            $table->foreignId('race_id')
                ->constrained("race")
                ->onUpdate('cascade')
                ->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_subscription');
    }
}
