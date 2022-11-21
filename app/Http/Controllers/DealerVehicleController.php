<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\DealersRepositoryInterface;
use App\Repository\VehiclesRepositoryInterface;

/*
| The purpose of this class DealerVehicleController is to set a single entry point for creating and processing records for dealers 
| and vehicles and making API calls.
| The repository pattern design is used here as example to show case keeping in mind the S.O.L.I.D principles
| You create the required class interface and register them with the RepositoryServiceProvider
*/

class DealerVehicleController extends Controller
{
    /**
     * @var private $dealersRepository
     */
    private $dealersRepository;
    
    /**
     * @var private $vehiclesRepository
     */
    private $vehiclesRepository;

   /**
    * The Dependency Inversion Principle
    * 
    * @param  DealersRepositoryInterface  $dealersRepository
    * 
    * @param  VehiclesRepositoryInterface  $vehiclesRepository
    */
   public function __construct(DealersRepositoryInterface $dealersRepository, VehiclesRepositoryInterface $vehiclesRepository)
   {
      $this->dealersRepository = $dealersRepository;
      $this->vehiclesRepository = $vehiclesRepository;
   }
   
}
