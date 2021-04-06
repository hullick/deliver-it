<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceRunnerResultTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_runner_result', function (Blueprint $table) {
            $table->id();
            $table->foreignId('race_subscription_id')
                ->constrained("race_subscription")
                ->onUpdate('cascade')
                ->nullable(false);
            $table->datetime("start_time")->nullable(false);
            $table->datetime("finish_time")->nullable(false);
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
        Schema::dropIfExists('race_runner_result');
    }
}
