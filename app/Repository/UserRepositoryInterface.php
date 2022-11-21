<?php
namespace App\Repository;

use App\Model\User;
use Illuminate\Support\Collection;

/*
 * The user repository interface
 */

interface UserRepositoryInterface
{
   public function all(): Collection;
}