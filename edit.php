<?php
include 'model.php';

 $edit_id = $_POST['edit_id'];

$model = new Model();

$row = $model->edit($edit_id);

// var_dump($row);
if(!empty($row)){
    ?>
    <form action="" method="post" id="form">
            <div>
                <input type="hidden" id="edit_id" value="<?php echo $row['id']; ?>">
            </div>
            <div class="form-group">
                <label for="title">Titre</label>
                <input name="title" type="text" class="form-control" id="edit_title" value="<?php echo $row['title']; ?>">
                </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" type="text" cols="" rows="3" class="form-control" id="edit_description"><?php echo $row['description']; ?></textarea>
            </div>
    </form>

    <?php
}

?>