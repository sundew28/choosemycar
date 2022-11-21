<?php

namespace App\Repository\Eloquent;

use App\Models\Vehicles;
use App\Models\User;
use App\Repository\VehiclesRepositoryInterface;
use Illuminate\Support\Collection;
use Faker\Generator as Faker;

class VehiclesRepository extends BaseRepository implements Dealers
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

   /**
    * @return string 
    */
   public function createTickets()
   {
       $user = User::inRandomOrder()->limit(1)->get();
       $ticket = ['name' => $user[0]['name'], 
                  'email' => $user[0]['email'], 
                  'subject' => $this->faker->sentence(10), 
                  'content' => $this->faker->realText($maxNbChars = 300, $indexSize = 2),
                  'created_by' => $user[0]['id'],
                  'status' => 0
              ];
       
       return $this->model->create($ticket);    
   }   
}