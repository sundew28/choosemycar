<?php

namespace App\Repository\Eloquent;

use App\Models\Vehicles;
use App\Models\User;
use App\Repository\VehiclesRepositoryInterface;
use Illuminate\Support\Collection;


class VehiclesRepository extends BaseRepository implements VehiclesRepositoryInterface
{
   /**
    * VehiclesRepository constructor.
    *
    * @param Tickets $model
    */
   public function __construct(Vehicles $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   
    
}