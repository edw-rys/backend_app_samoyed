<?php 
require_once MODELS."PersonaModel.php";
class PersonaController{
    private $userModel ;
    public function __construct(){
        $this->userModel= new PersonaModel();
    }
    public function index(){}
    public function query(){
        echo "<pre>";
        echo "Index uiser";
        echo "</pre>";
    }
    public function new()
    {

        if (isset($_REQUEST['name']) && isset($_REQUEST['last_name'])) {
            $this->userModel->name=$_REQUEST['name'];
            $this->userModel->last_name=$_REQUEST['last_name'];
            $id = $this->userModel->add();
            if ($id) {
                $data= [
                    "id"=> $id,
                    "status"=>"success",
                    "code"=>200
                ];
            }else{
                $data= [
                    "status"=>"error",
                    "code"=>400,
                    "message"=>"no insertado"
                ];
            }
        }elseif(isset($_POST['name']) && isset($_POST['last_name'])){
            $this->userModel->name=$_POST['name'];
            $this->userModel->last_name=$_POST['last_name'];
            $id = $this->userModel->add();
            if ($id) {
                $data= [
                    "id"=> $id,
                    "status"=>"success",
                    "code"=>200
                ];
            }else{
                $data= [
                    "status"=>"error",
                    "code"=>400,
                    "message"=>"no insertado"
                ];
            }
        }else
        {
            $data= [
                    "status"=>"error",
                    "code"=>400,
                    "message"=>"faltan datos"
            ];  
        }
        echo json_encode($data);
    }
}