<?php

function dd(...$vars){
    var_dump(...$vars);
    die();
}


class Asus {
    protected $backpack = null;
    protected $ssd = null;
    protected $webcam = null;

    public function price(){
        $price =  5000;
        if(!empty($this->backpack))
            $price += $this->backpack;
        if(!empty($this->ssd))
            $price += $this->ssd;
        if(!empty($this->webcam))
            $price += $this->webcam;
        return $price;
    }

    public function review(){
        $review =  'Asus laptop';
        if(!empty($this->backpack))
            $review .= ' | backpack';
        if(!empty($this->ssd))
            $review .= ' | ssd';
        if(!empty($this->webcam))
            $review .= ' | webcam';
        return $review;
    }

    /**
     * @return null
     */
    public function getBackpack()
    {
        return $this->backpack;
    }

    /**
     * @param null $backpack
     */
    public function setBackpack($backpack)
    {
        $this->backpack = $backpack;
    }

    /**
     * @return null
     */
    public function getSsd()
    {
        return $this->ssd;
    }

    /**
     * @param null $ssd
     */
    public function setSsd($ssd)
    {
        $this->ssd = $ssd;
    }

    /**
     * @return null
     */
    public function getWebcam()
    {
        return $this->webcam;
    }

    /**
     * @param null $webcam
     */
    public function setWebcam($webcam)
    {
        $this->webcam = $webcam;
    }



}


class Hp {

}

$asus1 = new Asus();
$asus1->setBackpack(200);
$asus1->setWebcam(800);
$asus1->setSsd(1500);


$asus2 = new Asus();
$asus2->setBackpack(200);

dd($asus2->price() , $asus2->review());
//dd($asus1->price() , $asus1->review());