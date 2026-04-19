<?php
// session_start();
include 'db.php';



$q = "SELECT * from categories";
$stmt = $pdo->prepare($q);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC); 


if($categories){

// var_dump($categories);

  $cat = $categories;
  // var_dump($cat);
  // echo json_encode($cat);



}

else{

    echo "No category found!";

}










?>