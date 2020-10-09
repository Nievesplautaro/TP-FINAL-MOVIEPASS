<?php
    namespace DAO;

    use Models\Admin as Admin;

    class AdminDAO{

    private $adminList = array();
    private $fileName;


    public function Add(Admin $admin){
        $this->RetrieveData();
        foreach ($this->GetAll() as $value){
            if ($admin->getEmail() == $value->getEmail()){
                return 0;
            }
        }
        array_push($this->adminList,$admin);    
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->adminList;
    }

    public function CompareEmail($email){
        $adminList= $this->GetAll();
        foreach ($adminList as $admin){
            if ($admin->getEmail() == $email){
                return true;
            }
        }
        return false;

    }

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->adminList as $admin){
            $valuesArray["user"] = $admin->getEmail();
            $valuesArray["pass"] = $admin->getPassword();
            array_push($arrayToEncode,$valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/admin.json', $jsonContent);
    }

    private function RetrieveData(){
        
        $this->adminList = array();

        if(file_exists('Data/admin.json')){
            $jsonContent = file_get_contents('Data/admin.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arrayToDecode as $valuesArray){

                $admin = new admin();

                $admin->setEmail($valuesArray["user"]);
                $admin->setPassword($valuesArray["pass"]);
                array_push($this->adminList,$admin);
            }

        }
    }
}
?>