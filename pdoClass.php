<?php
  class oopPDO
  {
    private $host="localhost";
    private $user="root";
    private $db="book";
    private $pass="";
    private $connect;

    public function __construct() {
     try {
       $this->connect = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);

     } catch (PDOException $error) {
        die ('Can\'t connectect to DB!<br>'.$error);
      }
    }

    public function showData($table){
      $sql="SELECT * FROM $table";
      if( !($this->connect->query($sql)) ){
        $this->createTable();
      }

      $query = $this->connect->query($sql);
      $posts = [];
      while($result = $query->fetch(PDO::FETCH_ASSOC)){
        $posts[]=$result;
      }
      return $posts;
   }

   public function insertData($name, $news, $utime, $table){
     $sql = "INSERT INTO $table SET name=:name,news=:news,utime=:utime";
     $query = $this->connect->prepare($sql);
     $query->execute(array(':name' => $name, ':news' => $news, ':utime' => $utime));
     return true;
   }

   public function createTable() {
     $sql = "CREATE TABLE posts (
             id int(11) AUTO_INCREMENT PRIMARY KEY,
             name varchar(30) NOT NULL,
             news varchar(500) NOT NULL,
             utime varchar(50) NOT NULL)";
     $query = $this->connect->prepare($sql);
     $query->execute();
   }
 }

?>
