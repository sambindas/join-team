<?php
include 'db.php';
if (isset($_POST['export'])) {
  $m = $_POST['type'];

$product = "select username, team from joined ";
if ($m != 'all') {
  $product .= "where team = '$m'"; 
}
$productResult = mysqli_query($conn, $product);
    $filename = "Export_excel";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    $r = array('Username', 'Team');
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", $r) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
  }
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Creative Tim">
  <title>Join Teams</title>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="assets/css/argon.mine209.css?v=1.0.0" rel="stylesheet">
  <style type="text/css">
    .pull-right{
      float: right;
    }
    .pull-left{
      float: left;
    }
  </style>
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
                <p>Export Data To Excel</p>
              </div>
              <form role="form" method="POST" action="">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>
                    <select class="form-control" id="type" name="type">
                    </select>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="export" class="btn btn-primary my-4">Export</button><br>
                  <p id="info"></p>
                  <div id="change">
                    
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/argon.mine209.js?v=1.0.0"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $.ajax({
        type: 'post',
        url: 'process.php',
        data: {drop: 'drop'},
        success: function(response){
          $('#type').html(response);
        }
      });

      $('#join').click(function(){
        $(this).prop('disabled', true);
        let type = $('#type').val();
        $('#info').html('Exporting Data...');
         $.ajax({
            type: 'post',
            url: 'process.php',
            data: {type: type, export: 'export'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('An error occured. Please try again.');
              }
            }
        });
      });
    });
  </script>
</body>
</html>