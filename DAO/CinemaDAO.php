<?php
    namespace DAO;

    use Models\Cinema as Cinema;

    class CinemaDAO{

    private $CinemaList = array();
    private $fileName;

    public function Add(Cinema $Cinema){
        $this->RetrieveData();
        foreach ($this->GetAll() as $value){
            if ($Cinema->getName() == $value->getName()){
                return 0;
            }
        }
        array_push($this->CinemaList,$Cinema);    
        $this->SaveData();
    }

    public function GetAll(){
        $this->RetrieveData();
        return $this->CinemaList;
    }

    public function CompareName($name){
        $CinemaList= $this->GetAll();
        foreach ($CinemaList as $Cinema){
            if ($Cinema->getName() == $name){
                return true;
            }
        }
        return false;

    }

    private function SaveData(){
        $arrayToEncode = array();

        foreach($this->CinemaList as $Cinema){
            $valuesArray["name"] = $Cinema->getName();
            $valuesArray["phoneNumber"] = $Cinema->getPhoneNumber();
            $valuesArray["ticketPrice"] = $Cinema->getTicketPrice();
            $valuesArray["address"] = $Cinema->getAddress();
            $valuesArray["capacity"] = $Cinema->getCapacity();
            $valuesArray["show"] = $Cinema->getShow();
            array_push($arrayToEncode,$valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        file_put_contents('Data/Cinema.json', $jsonContent);
    }

    private function RetrieveData(){
        
        $this->CinemaList = array();

        if(file_exists('Data/Cinema.json')){
            $jsonContent = file_get_contents('Data/Cinema.json');
            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent,true) : array();
            
            foreach($arrayToDecode as $valuesArray){

                $Cinema = new Cinema();

                $Cinema->setName($valuesArray["name"]);
                $Cinema->setPhoneNumber($valuesArray["phoneNumber"]);
                $Cinema->setTicketPrice($valuesArray["ticketPrice"]);
                $Cinema->setAddress($valuesArray["address"]);
                $Cinema->setCapacity($valuesArray["capacity"]);
                $Cinema->setShow($valuesArray["show"]);
                array_push($this->CinemaList,$Cinema);
            }

        }
    }
}
?>