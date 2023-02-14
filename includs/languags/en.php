<?php //8
function lang($phrase){
  static $lang=array(
    'home'=>'home ',  //ss طرق التعديل الغات
    'CATEGORIES'=>'categories',
    'ITEMS'=>'items',
    'LOGS'=>'logs',
    'MEMBERS'=>'members',
  );
  return $lang [$phrase];
}
 ?>
