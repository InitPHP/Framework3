<?php

namespace App\Database\Models;

use App\Database\Entities\User;
use InitPHP\Framework\Database\Model;

class Users extends Model
{

    protected string $schema = 'users';

    protected string $schemaId = 'id';

    protected string $entity = User::class;

}
