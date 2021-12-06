<?php

function dd(...$vars)
{
    var_dump(...$vars);
    die();
}


interface ILaptopOption
{
    public function price();

    public function review();
}

class Asus implements ILaptopOption
{
    public function price()
    {
        return 5000;
    }

    public function review()
    {
        return 'Asus laptop';
    }
}

class Hp implements ILaptopOption
{
    public function price()
    {
        return 7000;
    }

    public function review()
    {
        return 'Hp laptop';
    }
}

class WithSsd implements ILaptopOption {


    public function __construct(
       protected ILaptopOption $laptop
    )
    {}

    public function price()
    {
       return $this->laptop->price() + 1500;
    }

    public function review()
    {
        return $this->laptop->review() . ' | ssd';
    }
}

class WithBackpack implements ILaptopOption {


    public function __construct(
        protected ILaptopOption $laptop
    )
    {}

    public function price()
    {
        return $this->laptop->price() + 200;
    }

    public function review()
    {
        return $this->laptop->review() . ' | backpack';
    }
}

class WithWebcam implements ILaptopOption {


    public function __construct(
        protected ILaptopOption $laptop
    )
    {}

    public function price()
    {
        return $this->laptop->price() + 400;
    }

    public function review()
    {
        return $this->laptop->review() . ' | webcam';
    }
}


$asus = new Asus();
$asus = new WithSsd($asus);
$asus = new WithBackpack($asus);
$asus = new WithWebcam($asus);

$asus2 = new Asus();
$asus2 = new WithBackpack($asus2);

$hp = new Hp();
$hp = new WithBackpack($hp);
$hp = new WithSsd($hp);

dd(
    $hp->price(),
    $hp->review(),
);