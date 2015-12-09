<!DOCTYPE html>
<html lang="en">
<head>
    <title>traindataclient</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/tiles.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

    <!--Jquery Scripts -->
    <script>
      $(document).ready(function() {
        $("#del").click(function(){
            //alert("button");
            var id = $("#del").data('id');
            var col  = $("#del").data('col');
            //alert(temp);
            var url = "http://localhost:5000/deleteTweet/" + id + "&" + col;
            //alert(url);
            $.get(url,function(data){ });
            //var nextpage = "index.php?" + col;
            //alert(nextpage);
            //window.location.replace(nextpage);
        });
        $("#neg").click(function(){
            //alert("button");
            var id = $("#neg").data('id');
            var col  = $("#neg").data('col');
            var url = "http://localhost:5000/decideTweet/" + id + "&" + col +"&-" ;
            //alert(url);
            $.get(url,function(data){ });
        });
        $("#pos").click(function(){
            //alert("button");
            var id = $("#pos").data('id');
            var col  = $("#pos").data('col');
            var url = "http://localhost:5000/decideTweet/" + id + "&" + col +"&+" ;
            //alert(url);
            $.get(url,function(data){ });
        });
      });
    </script>



</head>
<body>
  <div class="container">
    <div class="header clearfix">
      <?php if (isset($_GET['col'])) {?>
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="index.php">Home</a></li>
            <li role="presentation"><a href="index.php?col=Adonis">Adonis</a></li>
            <li role="presentation"><a href="index.php?col=Meimar">Meimar</a></li>
            <li role="presentation"><a href="index.php?col=Mitso">Mitso</a></li>
            <li role="presentation"><a href="index.php?col=Tzitzi">Tzitzi</a></li>
            <li role="presentation"><a href="index.php?col=nd">ΝΔ</a></li>
          </ul>
        </nav>
        <?php }?>
        <h3 class="text-muted"><?php
         if (isset($_GET['col']))
          echo $_GET['col'];
         else {
           echo 'Train Data Client';
         }
         ?>
        </h3>
      </div>
<?php if (!isset($_GET['col'])){?>
    <div class="row">
      <div class="col-sm-4">
        <a href="index.php?col=Adonis"><div class="tile purple">
          <h3 class="title">Άδονις</h3>
          <p>#adonisforpresident</p>
        </div></a>
      </div>
      <div class="col-sm-4">
        <a href="index.php?col=Meimar"><div class="tile red">
          <h3 class="title">Μεϊμαράκης</h3>
          <p>#vforvaggelis</p>
        </div></a>
      </div>
      <div class="col-sm-4">
        <a href="index.php?col=Mitso"><div class="tile orange">
          <h3 class="title">Μητσοτάκης</h3>
          <p>#metonkyriako</p>
        </div></a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <a href="index.php?col=Tzitzi"><div class="tile green">
          <h3 class="title">Τζιτζικώστας</h3>
          <p>#tzitzi</p>
        </div></a>
      </div>
      <div class="col-sm-4">
        <a href="index.php?col=nd"><div class="tile blue">
          <h3 class="title">ΝέαΔημοκρατία</h3>
          <p>#nd_fun_park</p>
        </div></a>
      </div>
    </div>
    <?php }else {

      $url = "http://localhost:5000/getTweet/".$_GET['col'];

      $json = file_get_contents($url);
      $obj = json_decode($json);
      $table= json_decode($json,true);

      #$url = "http://localhost:5000/deleteTweet/".$table['id'].'&'.$table['collection'];
      #echo $url;
      #$json = file_get_contents($url);
      #echo $table['c'].'<br>';
      #echo $table['id'];

      echo '<div class="jumbotron">';
      if (isset($table)) {

        echo '<p class="lead">'.$table['text'].'</p>';

        echo '<a href="index.php?col='.$table['collection'].'"> <button type="button" data-id="'.$table['id'].'" data-col="'.$table['collection'].'" id="neg" class="btn btn-lg btn-info pull-left">Negative</button></a>';
        echo '<a href="index.php?col='.$table['collection'].'"> <button type="button" data-id="'.$table['id'].'" data-col="'.$table['collection'].'" id="del" class="btn btn-lg btn-danger">Delete</button></a>';
        echo '<a href="index.php?col='.$table['collection'].'"> <button type="button" data-id="'.$table['id'].'" data-col="'.$table['collection'].'" id="pos" class="btn btn-lg btn-success pull-right">Positive</button></a>';
      }else{
        echo '<p class="lead">There are no tweets in '.$_GET['col'].' collection :(</p>';
        echo '<a href="index.php"><button type="button" class="btn btn-primary">Select another collection</button></a>';
      }
      echo '</div>';
      }
      ?>



      <footer class="footer">
          <p>&copy;Distributed Knowledge and Media Systems Group © 2015</p>
      </footer>

  </div>



</body>
</html>
