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

   /**    
    * Extract dealers data from file
    * 
    * @return Response String results
    */
   public function dealersExtractData(string $filename): string
   {    
      // Response after inserting data
      $dealersResponse = $this->dealersRepository->insertData("dealers",$filename);
      
      // Return the result as String
      return "Dealers response : ".$dealersResponse;
   }

   /**    
    * Extract vehicles data from file
    * 
    * @return Response String results
    */
   public function vehiclesExtractData(string $filename): string
   {    
      // Response after inserting data
      $vehiclesResponse = $this->vehiclesRepository->insertData("vehicles", $filename);

      // Return the result as String
      return "Vehicles response : ".$vehiclesResponse;
   }

   /**    
    * Extract vehicles data from file
    * 
    * @return Response String results
    */
   public function dealersListData(): string
   {    
      // Get dealers records
      $vehiclesResponse = $this->dealersRepository->listData();

      // Return the result as String
      return "Vehicles response : \n\n".$vehiclesResponse;
   }
   
}
