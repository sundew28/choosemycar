<?php   

namespace App\Repository\Eloquent;   

use App\Repository\EloquentRepositoryInterface; 
use Illuminate\Database\Eloquent\Model;   

class BaseRepository implements EloquentRepositoryInterface 
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(Model $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
    * @return string 
    */
   public function insertData(string $model_type, string $filename): string
   {
       // Get the file type XML or JSON
       $infoPath = pathinfo(public_path('/files/'.$filename));
       $extension = $infoPath['extension'];

       // based on extension type extract data
        //dd($model_type);
       switch ($extension) {

        case 'xml':
            $xmlFile = file_get_contents(public_path('/files/'.$filename));
        
            $xmlObject = simplexml_load_string($xmlFile);
        
            $jsonFormatData = json_encode($xmlObject);

            $results = json_decode($jsonFormatData, true); 
             
            // Insert or update data based on the model type
            foreach($results as $result) {
                foreach($result as $res){
                    switch ($model_type) {
                        // For dealers
                        case 'dealers':
                            $this->model->updateOrCreate([
                                "dealer_id" => $res['id'],
                                "name" => $res['name'],
                                "phone_number" => $res['phone_number']
                            ]);
                        break;
                        // For vehicles
                        case 'vehicles':
                            $this->model->updateOrCreate([
                                "vehicle_id" => (isset($res['id'])?$res['id']:null),
                                "status" => (isset($res['status'])?$res['status']:null),
                                "mark" => (isset($res['mark'])?$res['mark']:null),
                                "color" => (isset($res['color'])?$res['color']:null),
                                "fuel" => (isset($res['fuel'])?$res['fuel']:null),
                                "vehicle_dealer_id" => (isset($res['vehicle_dealer_id'])?$res['vehicle_dealer_id']:null),
                                "images" => (isset($res['images'])?$res['images']:null)
                            ]);
                        break;
                    }
                }
            }

        break;

        case 'json':

            $results = json_decode(file_get_contents(public_path('/files/'.$filename)), true);
            
            // Insert or update data based on the model type
            foreach($results as $result) {
                switch ($model_type) {
                        // For dealers
                        case 'dealers':
                            $this->model->updateOrCreate([
                                "dealer_id" => $result['id'],
                                "name" => $result['name'],
                                "phone_number" => $result['phone_number']
                            ]);
                        break;
                        // For vehicles
                        case 'vehicles':                        
                            $this->model->updateOrCreate([
                                "vehicle_id" => (isset($result['id'])?$result['id']:null),
                                "status" => (isset($result['status'])?$result['status']:null),
                                "mark" => (isset($result['mark'])?$result['mark']:null),
                                "colour" => (isset($result['colour'])?$result['colour']:null),
                                "fuel" => (isset($result['fuel'])?$result['fuel']:null),
                                "vehicle_dealer_id" => (isset($result['vehicle_dealer_id'])?$result['vehicle_dealer_id']:null),
                                "images" => (isset($result['images'])?$result['images']:null)
                            ]);
                        break;
                    }
            }
       
        break;

       }      
       
       return "Records inserted or updated successfully";
   }  

}