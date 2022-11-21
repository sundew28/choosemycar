<?php
namespace App\Repository;

use App\Models\Dealers;
use Illuminate\Support\Collection;

interface DealersRepositoryInterface
{
   public function all(): Collection;

   public function listData(): string;   
}