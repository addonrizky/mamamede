<?php  
 //DEV
 $connect = mysqli_connect("178.128.208.156", "rizkyaddon", "Jakarta123!", "mede_mama"); 
 
 //PROD
 //$connect = mysqli_connect("localhost", "root", "Jakarta123!", "saham");  

 $query ="SELECT * FROM product";  
 $result = mysqli_query($connect, $query); 
print_r($result);

 while($row = mysqli_fetch_object($result)){
     $price_to_customer = $row->price + ($row->price * 10/100);
     $query = "UPDATE product SET price_to_customer = '$price_to_customer' WHERE id = $row->id";
     $update = mysqli_query($connect, $query); 
 }
 ?>  