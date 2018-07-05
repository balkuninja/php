<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>test</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
  <?php
    include_once('pdoClass'.".php");

    $obj=new oopPDO;

    if(isset($_REQUEST['insert'])) {
      extract($_REQUEST);
      date_default_timezone_set('Europe/Kiev');
      $utime = date('l jS \of F Y h:i:s A');
      $obj->insertData($name, $news, $utime, "posts");
    }

    echo @<<<show
       <div class="container">
        <h3>Insert</h3>
        <form method="post">
          <table width="100%">
            <tr>
              <th width=5%>Name</th>
              <td><input class="form-control" type="text" name="name" value="$name"></td>
            </tr>
            <tr>
              <th width=5%>News</th>
              <td><textarea class="form-control" rows="3" name="news" value="$news"></textarea></td>
            </tr>
            <tr>
              <th scope="row">&nbsp;</th>
              <td><input type="submit" name="insert" value="Insert" class="btn float-right"></td>
            </tr>
         </table>
        </form>
      </div>
show;
  ?>


  <div class="container">
    <br><br><h3>Posts</h3>
    <?php
      foreach($obj->showData("posts") as $value){
        extract($value);
        echo <<<show
          <div class="border">
            Name: $name. Date: $utime <br>
            News: <ul>$news</ul>
          </div>
show;
      }
    ?>
  </div>


</body>
</html>
