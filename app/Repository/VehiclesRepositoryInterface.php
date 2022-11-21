<?php
namespace App\Repository;

use App\Models\Vehicles;
use Illuminate\Support\Collection;

interface VehiclesRepositoryInterface
{
   public function all(): Collection;
}