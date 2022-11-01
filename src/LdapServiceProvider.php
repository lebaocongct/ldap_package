<?php
namespace LCong\Ldap;

use Illuminate\Support\ServiceProvider;

class LdapServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Load config
        $this->mergeConfigFrom(__DIR__ . '/config/ldap.php', 'ldap');

        $this->publishes(
        [
            __DIR__ . '/config/ldap.php' => config_path('ldap.php'),
        ]);
    }
    public function register()
    {

    }
}
