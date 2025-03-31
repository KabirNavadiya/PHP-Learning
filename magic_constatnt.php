<?php

echo __LINE__; // output : 3

echo __FILE__; // output : /home/kabir.navadiya@simform.dom/Learnings/PHP-Learning/tempCodeRunnerFile.php

echo __DIR__; // output : /home/kabir.navadiya@simform.dom/Learnings/PHP-Learning

function magicConstant()  {
    echo __FUNCTION__; // output : magicConstant
}
magicConstant();

class Magic_constatnt{
    public function magicConstant() {
        echo "__FUNCTION__ : ",__FUNCTION__,"\n";  // output : __FUNCTION__ : magicConstant
        echo "__CLASS__ : ",__CLASS__,"\n"; // output : __CLASS__ : Magic_constatnt
        echo "__METHOD__ : ",__METHOD__,"\n"; // output : __METHOD__ : Magic_constatnt::magicConstant
        echo "ClassName::class :",Magic_constatnt::class,"\n"; // output : ClassName::class :Magic_constatnt
    }
}
$Magic_constatnt = new Magic_constatnt();
$Magic_constatnt -> magicConstant();


?>