<?php
include_once MODELS."CargoModel.php";

class CargoController
{
    private $cargoModel ;
    public function __construct(){
        $this->cargoModel = new CargoModel();
    }
    public function index(){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->cargoModel->get()
        ];
        echo json_encode($data);
    }
    public function getById($id){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->cargoModel->get([
                "condition"=> " id_cargo=:id_cargo",
                "params"=>["id_cargo"=>$id],
                "fetch"=>"one"
            ])
        ];
        return $data["datos"];
    }
}