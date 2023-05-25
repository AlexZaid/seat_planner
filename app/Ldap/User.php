<?php

namespace App\Ldap;

use LdapRecord\Models\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use LdapRecord\Models\Concerns\CanAuthenticate;

class User extends Model implements Authenticatable
{
    use CanAuthenticate;

    protected static $objectClasses = ['user'];

}

