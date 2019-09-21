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
                <p>Input Your Slack Username To Join A Team</p>
              </div>
              <form role="form" method="POST" action="javascript:;">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="Slack Username" id="username" name="username" type="text" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" id="join" class="btn btn-primary my-4">Join Random Team</button><br>
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
      $('#join').click(function(){
        $(this).prop('disabled', true);
        let username = $('#username').val();
        $('#info').html('Verifying '+username+'...');
         $.ajax({
            type: 'post',
            url: 'process.php',
            data: {username: username, first: 'first'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#change').html('<span class="alert alert-danger">'+username+' already belongs in another team</span>');
              } else if (response == 1) {
                ajaxCall2();
              }
            }
        });
         function ajaxCall2() {
          $('#info').html('Assigning '+username+' to a team...');
          $.ajax({
            type: 'post',
            url: 'process.php',
            dataType: 'json',
            data: {username: username, second: 'second'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#change').html('<span class="alert alert-danger">An error occured! Please try again</span>');
              } else if (response == 3){
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#info').html('');
                $('#change').html('<span class="alert alert-danger">Teams are full! Contact Mentors</span>');
              } else {
                $('#username').val('');
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#change').html('');
                $('#info').html(username+' has been assigned to team '+response[0]+'! <br> <a target="blank" href="'+response[1]+'">Click here</a> to join channel');
              }
            }
          });
         }
      });
    });
  </script>
</body>
</html>