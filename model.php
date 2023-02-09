<?php
class Model{
            private $server = "localhost";
            private $username = "root";
            private $password = "";
            private $db = "crud_ajax";
            private $conn;

        public function __construct()
        {
            try {
                $this->conn= new PDO("mysql:host=$this->server;dbname=$this->db", $this->username ,$this->password);
                // echo 'connex ok';
            } catch (PDOException $e){
                echo "Erreur:".$e->getMessage();
            }
        }
    public function insert()
    {
        if(isset($_POST['submit'])){
            // echo "Mande ny mande";
            if(isset($_POST['title']) && isset($_POST['description'])){
                // echo "Mande ny mande";
                if(!empty($_POST['title']) && !empty($_POST["description"])){
                     $title = $_POST['title'];
                     $description = $_POST['description'];

                    // var_dump($this->conn);
                    $query= "INSERT INTO records (title, description) VALUES (:title, :description)";
                    // var_dump($query);
                    $stmt = $this->conn->prepare($query);
                    if($stmt->execute([':title' => $title, ':description' => $description])){
                            echo '
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Saisie sauvegardé ! 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            ';
                            }else {
                            echo '
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Une errer est survenue !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                ';
                        }
                }else {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        les champs sont vide ! 
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                }
                
            }
        }
    }

    public function fetch(){
        $data = null;

        $stmt = $this->conn->prepare("SELECT * FROM records");

        $stmt->execute();

        $data = $stmt->fetchAll();

        return $data;
    }

    public function del($del_id){
        $query = "DELETE FROM records WHERE id='$del_id'";
        if($sql = $this->conn->exec($query)){
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Utilisateur bien supprimer
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            ';
        }else{
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                ne pas effacer
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }
    public function read($read_id){
        $data = null;

        $stmt = $this->conn->prepare("SELECT * FROM records WHERE id='$read_id'");
        $stmt->execute();

        $data = $stmt->fetch();

        return $data;
    }

    public function edit($edit_id){
        $data = null;
        $stmt = $this->conn->prepare("SELECT * FROM records WHERE id='$edit_id'");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }

    public function update($data){
        // var_dump($data);
        $query = "UPDATE records SET title='$data[edit_title]', description='$data[edit_description]' WHERE id='$data[edit_id]'";
        if($sql = $this->conn->exec($query)){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Modification effectué ! 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }else {
            echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                echec de la modification !
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
        }
    }

}

$ob = new Model();
?>