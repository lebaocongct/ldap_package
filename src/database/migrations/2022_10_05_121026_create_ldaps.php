<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ldaps', function (Blueprint $table) {
            $table->id();
            $table->string('ldap_name')->default('PLOTT_AD');
            $table->string('ldap_type')->default(1);
            $table->string('upn_suffix')->default('plott.local');
            $table->string('base_dn');
            $table->string('host_name');
            $table->string('port');
            $table->string('version');
            $table->string('use_ssl');
            $table->string('use_tls');
            $table->string('follow_referrals');
            $table->string('timeout');
            $table->string('filter')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ldaps');
    }
};
