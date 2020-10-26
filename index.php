<?php
class Wall
{
    public $name;
    public $sideA;
    public $sideB;
    public $sideC; // ширина
    public $density; // плотность материала

    public function __construct($name = null, $sideA = null, $sideB = null, $sideC = null, $density = null)
    {
        $this->name = $name;
        $this->sideA = $sideA;
        $this->sideB = $sideB;
        $this->sideC = $sideC;
        $this->density = $density;
    }

    public function Volume()
    {
        $size = $this->sideA * $this->sideB * $this->sideC;
        return $size;
    }
    public function calcMass()
    {
        $mass = $this->density * $this->Volume();
        return $mass;
    }
    public function showInfo()
    {
        echo "<h1>{$this->name}</h1>
        <h3>Высота стены: {$this->sideA} м.</h3>
        <h3>Длина стены: {$this->sideB} м.</h3>
        <h3>Ширина стены: {$this->sideC} м.</h3>
        <h3>Плотность материала: {$this->density} т/м3.</h3>
        <h3>Объем стены: {$this->Volume()} м3.</h3>
        <h3>Масса стены: {$this->calcMass()} т.</h3>";
    }
}

class WallWithWindow extends Wall
{
    public function __construct($name = null, $sideA = null, $sideB = null, $sideC = null, $density = null, $windowHeight, $windowWidth)
    {
        parent::__construct($name, $sideA, $sideB, $sideC, $density);
        $this->windowHeight = $windowHeight;
        $this->windowWidth = $windowWidth;
    }
    public function calcWindowArea()
    {
        $area = $this->windowHeight * $this->windowWidth;
        return $area;
    }
    public function calcMass()
    {
        $mass = parent::calcMass() - $this->calcWindowArea() * $this->sideC * $this->density;
        return $mass;
    }
  
    public function showInfo()
    {
        parent::showInfo();
        echo "<h3>Высота окна: {$this->windowHeight} м.</h3>
        <h3>Ширина окна: {$this->windowWidth} м.</h3>
        <h3>Площадь остекления : {$this->calcWindowArea()} м2</h3>";
    }
}

$betonWall = new Wall("Бетонная стена", 4, 7, 0.5, 2.2);
//(new Block("Деревянная стена", 4, 7, 0.5, 0.85))->showInfo();
$woodWall = new Wall("Деревянная стена", 4, 7, 0.5, 0.85);
$wallWithWindow = new wallWithWindow("Бетонная стена с окном", 4, 7, 0.5, 2.2, 2, 1.2);

function showInfo(Wall $wall){
    $wall->showInfo();
}
showInfo($betonWall);
showInfo($woodWall);
showInfo($wallWithWindow);

/*
// 5. Дан код:
// Что он выведет на каждом шаге? Почему?

class A
{
    public function foo() // метод остаеться для всех экземпляров общим (единственным)
    {
        static $x = 0; // статическая переменная ее значение будет сохраняться после окончания работы функции
        echo ++$x;
    }
}
$a1 = new A(); //создаем экземпляр класса А
$a2 = new A(); // и еще один экземпляр класса А
$a1->foo(); //вызываем метод, получаем 1 и инкрементируем переменную х
$a2->foo(); //2
$a1->foo(); //3
$a2->foo(); //4


// Немного изменим п.5:
//6. Объясните результаты в этом случае.

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A { // класс B наследует от А
}
$a1 = new A(); // создаем эеземпляр класса А
$b1 = new B();  //// создаем эеземпляр класса В у него создаеться свой метод foo
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2 (вызываеться метод класса А)
$b1->foo(); // 2 (вызываеться метод класса В)
*/


//7. *Дан код:
//Что он выведет на каждом шаге? Почему?
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A; // нет скобок, значение не определено, не передаются данные в конструктор?
$b1 = new B;
$a1->foo(); //1
$b1->foo(); //1
$a1->foo(); //2
$b1->foo(); //2
