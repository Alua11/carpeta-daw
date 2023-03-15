<?php
class MyClass
{
    protected function myFunc()
    {
        echo "MyClass::myFunc()\n";
    }
}
class OtherClass extends MyClass
{
    // Sobrescritura de definición parent
    public function myFunc()
    {
        // Pero todavía se puede llamar a la función parent
        parent::myFunc();
        echo "OtherClass::myFunc()\n";
    }
}
$class = new OtherClass();
$class->myFunc();
/*
La salida por pantalla será:
MyClass::myFunc()
OtherClass::myFunc()
*/
?>