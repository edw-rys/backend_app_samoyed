<?php
include_once MODELS."EmployeeModel.php";
include_once CONTROLLERS."NacionalityController.php";
include_once CONTROLLERS."CargoController.php";
include_once CONTROLLERS."DepartmentController.php";
class EmployeeController
{
    private $nacC;
    private $cargoC;
    private $depC;
    private $employeeModel ;
    public function __construct(){
        $this->employeeModel = new EmployeeModel();
        $this->nacC = new NacionalityController();
        $this->cargoC = new CargoController();
        $this->depC = new DepartmentController();
    }
    public function index(){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->getEmployees()
        ];
        echo json_encode($data["datos"]);
    }
    public function getByDNI($id){
        $data=[
            "title"=>"Nacionalidad",
            "datos"=> $this->employeeModel->get([
                "condition"=> " id_employee=:id_employee",
                "params"=>["id_employee"=>$id],
                "fetch"=>"one"
            ])
        ];
        return $data["datos"];
    }

    public function save(){
        // en caso de la ausencia de algún campo, retornar =>faltan campos
        if(!(isset($_REQUEST['name']) && isset($_REQUEST['last_name']) && 
            isset($_REQUEST['dni']) && isset($_REQUEST['telf']) && 
            isset($_REQUEST['birthDate']) && isset($_REQUEST['gender']) && 
            isset($_REQUEST['id_nacionality']) && isset($_REQUEST['tipo_de_pago']) && 
            isset($_REQUEST['salary']) && isset($_REQUEST['level_academic']) && 
            isset($_REQUEST['title_academic']) && isset($_REQUEST['id_cargo']) && 
            isset($_REQUEST['date_of_admission']) && isset($_REQUEST['id_department']) )){
                $data=[
                    "title"=>"Registro",
                    "message"=>"Compelte todos los campos, por favor!",
                    "code"=>400,
                    "status"=>"error"
                ];
        }else{

            $verify=$this->employeeModel->get(
                [
                    "condition" =>"dni=:dni",
                    "params"    =>["dni"=>$_POST['dni']]
                ]
            );
            if(!empty( $verify)){
                $data=[
                    "title"=>"Registro",
                    "message"=>"Número de cédula ya está registrado.",
                    "code"=>400,
                    "status"=>"error"
                ];
            }else{
                $this->employeeModel->name = $_POST['name'];
                $this->employeeModel->last_name = $_POST['last_name'];
                $this->employeeModel->dni = $_POST['dni'];
                $this->employeeModel->date_of_admission = $_POST['date_of_admission'];
                $this->employeeModel->id_department = $_POST['id_department'];
                $this->employeeModel->id_cargo = $_POST['id_cargo'];
                $this->employeeModel->title_academic = $_POST['title_academic'];
                $this->employeeModel->level_academic = $_POST['level_academic'];
                $this->employeeModel->salary = $_POST['salary'];
                $this->employeeModel->tipo_de_pago = $_POST['tipo_de_pago'];
                $this->employeeModel->id_nacionality = $_POST['id_nacionality'];
                $this->employeeModel->gender = $_POST['gender'];
                $this->employeeModel->birthDate = $_POST['birthDate'];
                $this->employeeModel->telf = $_POST['telf'];
                $num = $this->employeeModel->add();
                if($num>0){
                    $data=[
                        "title"=>"Registro",
                        "message"=>"Usuario Registrado",
                        "code"=>200,
                        "status"=>"success"
                    ];
                }else{
                    $data=[
                        "title"=>"Registro",
                        "message"=>"Error al guardar",
                        "code"=>400,
                        "status"=>"error"
                    ];
                }
            }
        }
        echo json_encode($data);      
    }

    public function getEmployees(){
        $datos = $this->employeeModel->get();
        foreach($datos as $data ) { 
            $data->nacionality = $this->nacC->getById($data->id_nacionality);
            $data->cargo =  $this->cargoC->getById($data->id_cargo);
            $data->department =  $this->depC->getById($data->id_department);
            
        }
        return $datos ;
    }
}