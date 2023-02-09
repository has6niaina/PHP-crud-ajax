<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Crud-ajax</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h1 class="text-center">PHP Crud AJAX</h1>
                <hr style="height: 1px;color: black; background-color: black;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <form action="" method="post" id="form">
                    <div id="result"></div>
                    <div class="form-group">
                        <label for="title">Titre</label>
                        <input name="title" type="text" class="form-control" id="title">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" type="text" cols="" rows="3" class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-outline-primary mt-3">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-1">
                <div id="show"></div>
                <div id="fetch"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">SImple donnée</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="read_data"></div>
        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
        </div>
        </div>
    </div>
<!-- editer -->
            <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <!-- exampleModal1 -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editer l'enregistement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <div id="edit_data"></div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update">Modifier</button>
                </div>
            </div>
        </div>
        </div>

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>

<script>
    $(document).on("click","#submit", function(e){
        e.preventDefault();

        var title = $("#title").val();
        var description = $("#description").val();
        var submit = $("#submit").val();

        // alert (title);
        $.ajax({
            url: "insert.php",
            type: "post",
            data: {
                title:title,
                description:description,
                submit:submit
                
            },
            success: function(data) {
                $("#result").html(data);
            }
        })
        //permet de reinitialiser le formulaire apres avoir cliequer sur ok de l'alert
        $("#form")[0].reset();

    });
        //fetch

        function fetch(){
            $.ajax({
                url:"fetch.php",
                type:"post",
                success: function(data){
                    $("#fetch").html(data);
                }
            });
        }
        fetch();

        // suppresion record

        $(document).on("click" , "#del", function(e){
            e.preventDefault();
            // alert('vofafa');
            if(window.confirm("Voulez vous effacer cette enregistrement ?")) {
                var del_id = $(this).attr("value");

                    // alert(del_id);
                    $.ajax({
                        url:"del.php",
                        type:"post",
                        data:{
                            del_id:del_id,
                        },
                        success: function(data){
                            fetch();
                            $("#show").html(data);
                        }
                    })
            }else {
                return false;
            }

 
        });

        //read  record
        $(document).on("click","#read", function(e){
            e.preventDefault();
            // alert('Read marche tres bien');

            var read_id = $(this).attr("value"); 
            // alert(read_id);
            $.ajax({
                url:"read.php",
                type:"post",
                data:{
                    read_id: read_id
                },
                    success:function(data){
                        fetch;
                        $("#read_data").html(data);
                    }
            });

        });
        //edit
        $(document).on("click", "#edit" , function(e) {
            e.preventDefault();
            // alert ("mande"); 
            var edit_id = $(this).attr("value");
            
            $.ajax({
                url:"edit.php",
                type:"post",
                data: {
                    edit_id : edit_id
                },
                success:function(data){
                    $("#edit_data").html(data);
                }
            })
        });

        //update

        $(document).on("click", "#update", function(e){
            e.preventDefault();
            // alert("dede");

            var edit_title = $("#edit_title").val();
            var edit_description = $("#edit_description").val();
            var update = $("#update").val();
            var edit_id = $("#edit_id").val();

            // alert (edit_id);

            $.ajax({
                url:"update.php",
                type:"post",
                data: {
                    edit_id:edit_id,
                    edit_description:edit_description,
                    edit_title:edit_title,
                    update:update
                },
                success : function(data) {
                    $("#show").html(data);
                }
            })
        })
</script>
</body>
</html>