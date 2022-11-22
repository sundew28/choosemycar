<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
* Interface EloquentRepositoryInterface
* @package App\Repositories
*/
interface EloquentRepositoryInterface
{
   /**
    * @param array $attributes
    * 
    * @return Model
    */
   public function create(array $attributes): Model;

   /**
    * @param $id
    * 
    * @return Model
    */
   public function find($id): ?Model;

   /**
    * @param string $model_type
    * 
    * @param string $filename    
    */
   public function insertData(string $model_type, string $filename): string;
}
