<?php

class dbConn
{
    protected static $db;

    //Hyperphp
    /*public function __construct()
    {
        try{
            self::$db = new PDO("mysql:host=sql205.hyperphp.com;dbname=hp_30205122_bathos;charset=utf8", "hp_30205122", "132465798Bb");
        }
        catch (PDOException $exception)
        {
            print $exception->getMessage();
        }
    }*/

    //veritabanına bağlanan fonksiyon
    public function __construct()
    {
        try{
            self::$db = new PDO("mysql:host=localhost;dbname=emlakveritabani;charset=utf8", "root", "");
        }
        catch (PDOException $exception)
        {
            print $exception->getMessage();
        }
    }

    //İlleri getiren fonksiyon
    public function getIlList(){
        $data=array();
        $query = self::$db->query("SELECT DISTINCT il FROM ilveilceler");
        if($query->rowCount())
        {
            foreach ($query as $row)
            {
                $data[]=$row["il"];
            }
        }
        echo json_encode($data);
    }


    //İlçeleri getiren fonksiyon
    public function getIlceList($il){
        $data=array();
        $query = self::$db->prepare("SELECT DISTINCT ilce FROM ilveilceler WHERE il=:il");
        $query->execute(array(":il"=>$il));
        if($query->rowCount())
        {
            foreach ($query as $row)
            {
                $data[]=$row["ilce"];
            }
        }
        echo json_encode($data);
    }

    //Hastahaneleri getiren fonksiyon
    public function getMahalleList($ilce){
        $data=array();
        $query = self::$db->prepare("SELECT DISTINCT mahalle FROM ilveilceler WHERE ilce=:ilce");
        $query->execute(array(":ilce"=>$ilce));
        if($query->rowCount())
        {
            foreach ($query as $row)
            {
                $data[]=$row["mahalle"];
            }
        }
        echo json_encode($data);
    }
}
?>