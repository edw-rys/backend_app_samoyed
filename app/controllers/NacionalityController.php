<?php
include_once MODELS."NacionalityModel.php";
class NacionalityController
{
    private $nacionalityModel ;
    public function __construct(){
        $this->nacionalityModel = new NacionalityModel();
    }
    public function index(){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->nacionalityModel->get()
        ];
        echo json_encode($data);
    }
    public function getById($id){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->nacionalityModel->get([
                "condition"=> " id_nacionality=:id_nacionality",
                "params"=>["id_nacionality"=>$id],
                "fetch"=>"one"
            ])
        ];
        return $data["datos"];
    }
}