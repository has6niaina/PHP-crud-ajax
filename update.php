<?php
include 'model.php';
if (isset($_POST['update'])) {
    // echo "Mande ny mande";
    if (isset($_POST['edit_title']) && isset($_POST['edit_description']) && isset($_POST['edit_id'])) {
        // echo "Mande ny mande";
        if (!empty($_POST['edit_title']) && !empty($_POST["edit_description"]) && !empty($_POST['edit_id'])) {
            $data['edit_id'] = $_POST['edit_id'];
            $data['edit_title'] = $_POST['edit_title'];
            $data['edit_description'] = $_POST['edit_description'];

            // var_dump($data);
            $model = new Model();

            $update = $model->update($data);

        } else {
            echo "<script>alert('empty fields');</script>"
            ;
        }

    }
}
?>