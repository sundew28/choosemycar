<?php

namespace App\Repository\Eloquent;

use App\Models\Dealers;
use App\Models\User;
use App\Repository\DealersRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DealersRepository extends BaseRepository implements DealersRepositoryInterface
{  

   /**
    * DealersRepository constructor.
    *
    * @param Tickets $model
    */
   public function __construct(Dealers $model)
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
    * Get list of dealers with status on their inventory
    * 
    * @return String Response
    */
   public function listData(): string
   {
        $data = $this->model->select('dealers.dealer_id', 'dealers.name AS Name', 'vehicles.mark', 'vehicles.colour', 'vehicles.status', 'vehicles.vehicle_dealer_id')
            ->join('vehicles', 'vehicles.vehicle_dealer_id', '=', 'dealers.dealer_id')            
            ->where('vehicles.deleted_at', '=', null)
            ->orderBy('vehicles.status')
            ->get();            

        // Grab unique dealers array
        $dealersArray = [];
        foreach($data as $dealerData) {
            if(!in_array($dealerData->dealer_id, $dealersArray))
                $dealersArray[] = $dealerData->dealer_id;
        }

        // Vehicle array variable
        $vehicleArray = [];
        foreach($dealersArray as $dealerData) {

            $sold = 0;
            $active = 0;
            $reserved = 0;
            
            foreach($data as $vehicleData) {
 
                if($dealerData === $vehicleData->vehicle_dealer_id) {
                    
                    $vehicleArray[$dealerData]['Name'] = $vehicleData->Name;

                    if($vehicleData->status == 'Sold'){
                        $sold = $sold+1;
                        $vehicleArray[$dealerData]['Sold'] = $sold;
                    } else {
                        $vehicleArray[$dealerData]['Sold'] = $sold;
                    }

                    if($vehicleData->status == 'Active'){
                        $active = $active+1;
                        $vehicleArray[$dealerData]['Available'] = $active;
                    } else {
                        $vehicleArray[$dealerData]['Available'] = $active;
                    }

                    if($vehicleData->status == 'Processing'){
                        $reserved = $reserved+1;
                        $vehicleArray[$dealerData]['Reserved'] = $reserved;
                    } else {
                        $vehicleArray[$dealerData]['Reserved'] = $reserved;
                    }
                }
            }
        }

        $response = "";

        foreach($vehicleArray as $vechicleData) {
            $response .= $vechicleData['Name']." : Available ".$vechicleData['Available']." Reserved ".$vechicleData['Reserved']." Sold ".$vechicleData['Sold']."\n\n";            
        }
        
        // return a string response
        return $response;
   }
}