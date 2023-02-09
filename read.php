<?php
include 'model.php';

$read_id = $_POST['read_id'];
$model = new Model();

$row = $model->read($read_id);

// var_dump($row);

if(!empty($row)){
     ?>
     <p>Titre - <?php echo $row['title']; ?></p>
     <p>Description - <?php echo $row['description']; ?></p>

     <?php

}
?>