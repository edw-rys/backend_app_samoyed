<?php 

class NacionalityModel extends Model
{
    public function __construct() {
    }
    /**
     * Método para retornar un producto
     * @return ["class" || "object anonimus" || Index ASSOC]
     */
    public function get($params =null){
        $params = parent::clearData($params);
        $sql="SELECT ".$params["_sql_params"]." from nacionality ";
        if( !is_null($params["condition"]) ){
            $sql  = $sql ." where ". $params["condition"];
        }
        try{
            return parent::sql([
                "sql"           => $sql,
                "params"        => $params["params"],
                "type"          => "query",
                "fetch"         => isset($params["fetch"])?$params["fetch"]:null,
                "fetch_type"    => isset($params["fetch_type"])?$params["fetch_type"]:null,
                "class"         => (isset($params["fetch_type"]) && $params["fetch_type"]=="class")?"Product":null,
            ]);
        }catch(Exception $ex){
            die($ex);
        }
    }
}