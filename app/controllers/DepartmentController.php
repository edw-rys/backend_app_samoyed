<?php
include_once MODELS."DepartmentModel.php";
class DepartmentController
{
    private $departmentModel ;
    public function __construct(){
        $this->departmentModel = new DepartmentModel();
    }
    public function index(){
        $data=[
            "title"=>"Departamento",
            "datos"=> $this->departmentModel->get()
        ];
        echo json_encode($data);
    }
    public function getById($id){
        $data=[
            "title"=>"Departamento",
            "datos"=> $this->departmentModel->get([
                "condition"=> " id_department=:id_department",
                "params"=>["id_department"=>$id],
                "fetch"=>"one"
            ])
        ];
        return $data["datos"];
    }
}
