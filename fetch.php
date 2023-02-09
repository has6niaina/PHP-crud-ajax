<?php

include 'model.php';
$model = new Model();

$rows = $model->fetch();

?>
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>Titre</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;

            if(!empty($rows)){
                foreach($rows as $row){ ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <a id="read" href="#" value="<?php echo $row['id']; ?>" class="btn btn-info" 
                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Lire</a>

                        <a href="#" value="<?php echo $row['id']; ?>"  class="btn btn-danger" id="del"> Effacer</a>

                        <a href="#" value="<?php echo $row['id']; ?>"  class="btn btn-warning" id="edit"
                        data-bs-toggle="modal" data-bs-target="#exampleModal1">Modifier</a>
                    </td>
                </tr>
            <?php
                }
            }  else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Pas de données enregistrer
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
            }
        ?>
    </tbody>
</table>