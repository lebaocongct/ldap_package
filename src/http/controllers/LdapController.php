<?php

namespace LCong\Ldap\http\controllers;

use App\Http\Controllers\Controller;
use App\Models\Ldap;
use App\Models\User;
use Exception;
use LCong\Ldap\models\LdapSync;
use LdapRecord\Auth\BindException;
use LdapRecord\Connection;
use LdapRecord\Container;
use LdapRecord\LdapRecordException;

class LdapController extends Controller
{

    /**
     * @param $user_name
     * @param $password
     * @param null $connection_name
     * @return Connection|string
     * Check connect Ldap
     */
    public function connectionLdap($user_name, $password, $connection_name = null): Connection|string
    {
        $connection = $connection_name ?: $this->getConnectionName();
        try
        {
            return (bool)Container::getConnection($connection)->connect($user_name, $password);
        } catch (BindException|LdapRecordException)
        {
            return 0;
        }
    }

    /**
     * @param $user_name
     * @param $password
     * @param null $connection_name
     * @param null $data_type
     * Return data type is json or array
     * @return array|string
     */
    public function getInfoLdap($user_name, $password, $connection_name = null, $data_type = null): array|string
    {
        try
        {
            if($this->connectionLdap($user_name, $password, $connection_name))
            {
                return match ($data_type) {
                    'json' => \App\Ldap\LdapSync::all()->where('company')->toJson(),
                    default => LdapSync::all()->where('company')->toArray(),
                };
            }else
            {
                return 0;
            }
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * @return array|string
     * Return configuration ldap
     */
    public function getInfoConnection($connection_name = null): array|string
    {
        try {
            $connection = $connection_name ?: $this->getConnectionName();
            return Container::getConnection($connection)->getConfiguration()->all();
        }
        catch (Exception $exception)
        {
            return $exception->getMessage();
        }
    }

    /**
     * @return string|null
     * Return connection name
     */
    public function getConnectionName(): ?string
    {
        $model = new LdapSync();
        return $model->getConnectionName() ?: 'default';
    }

    /**
     * @param $user_name
     * @param $password
     * @param $connection_name
     * @return string
     * Sync ldap to user
     */
    public function sync($user_name, $password, $connection_name = null): string
    {
        try
        {
            $info_connection = $this->getInfoConnection($connection_name);
            $ldap = $this->firstOrCreateLdap($info_connection);
            $ldap_id = $ldap['id'];
            $info_ldap = $this->getInfoLdap($user_name, $password, $connection_name);
            foreach ($info_ldap as $value)
            {
                $this->firstOrCreateUser($value, $ldap_id);
            }
            return 'Successful';
        }
        catch (Exception)
        {
            return 'Error';
        }

    }

    public function firstOrCreateUser($user,$ldap_id)
    {
        return User::firstOrCreate(
            ['user_name' =>  $user['userprincipalname'][0]],
            [
                'ldap_id' => $ldap_id,
                'full_name' => $user['displayname'][0],
                'user_name' => $user['userprincipalname'][0],
                'ldap_name' => $user['samaccountname'][0],
                'email' => $user['mail'][0],
                'avatar' => '/storage/media/avatars/blank.png',
                'phone' => fake()->phoneNumber(),
            ]
        );
    }

    public function firstOrCreateLdap($info_connection)
    {
        return Ldap::firstOrCreate(
            [
                'host_name' =>  $info_connection['hosts'][0],
                'base_dn' => $info_connection['base_dn']
            ],
            [
                $ldap['port'] = $info_connection['port'],
                $ldap['version'] = $info_connection['version'],
                $ldap['use_ssl'] = $info_connection['use_ssl'],
                $ldap['use_tls'] = $info_connection['use_tls'],
                $ldap['follow_referrals'] = $info_connection['follow_referrals'],
                $ldap['timeout'] = $info_connection['timeout'],
            ]
        );
    }

    protected function avatarDefault(): string
    {
        return '/storage/media/avatars/blank.png';
    }

    public function getLdapPersonal($user_name)
    {
        return LdapSync::all()->where('userprincipalname',[$user_name])->first();
    }
}
