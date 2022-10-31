<?php

use App\Models\Ldap;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if(Schema::hasTable('users'))
        {
            Schema::table('users', function (Blueprint $table) {
                $table->foreignIdFor(Ldap::class)->unique()->constrained();
            });
        }
        else
        {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('user_name');
                $table->string('full_name');
                $table->string('password')->nullable();
                $table->string('phone');
                $table->string('email');
                $table->string('avatar')->nullable();
                $table->timestamps();
                $table->foreignIdFor(Ldap::class)->unique()->constrained();
                $table->integer('status')->default(1)->comment('status active = 1 (active), status = 0 (not active)');
                $table->enum('role',[0,1,2])->default(2)->comment('role = 0 (role super admin), role = 1 (role admin), role = 2 (role normal)');
                $table->rememberToken();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
