<?php

namespace LCong\Ldap\models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use LdapRecord\Models\Concerns\CanAuthenticate;
use LdapRecord\Models\Model;

class LdapSync extends Model implements Authenticatable
{
    use CanAuthenticate;
    /**
     * Ldap Connection type
     * @var string
     */
    protected $connection = 'AD';
    protected $guidKey = 'uuid';

    /**
     * List users in organization
     * @var string[]
     */
    public static $objectClasses =
    [
        'organizationalPerson',
    ];

    /**
     * @var string[]
     */
    protected $attributes = ['department'];

    /**
     * @var string[]
     */
    protected $appends = ['login_name'];

    /**
     * Determine admin role
     * @return Attribute
     */
    protected function loginName(): Attribute
    {
        $array = explode("@", $this->userprincipalname);
        return new Attribute(
            get: fn () => array_shift($array),
        );
    }

    /**
     * The attributes that should be visible in arrays.
     * @var string[]
     */
    protected $visible =
    [
        'sn'  ,
        'givenname',
        'title',
        'physicaldeliveryofficename',
        'displayname',
        'company',
        'mail',
        'samaccountname',
        'userprincipalname',
        'memberof',
        'department'
    ];


}
