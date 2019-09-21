<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Creative Tim">
  <title>Add Teams</title>
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
                <p>Input Team/Channel Name and Slack URL</p>
              </div>
              <form role="form" method="POST" action="javascript:;">
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></i></span>
                    </div>
                    <input class="form-control" placeholder="Team Name" id="team" type="text" required>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"></i></span>
                    </div>
                    <input class="form-control" placeholder="Channel URL" id="url" type="text" required>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" id="join" class="btn btn-primary my-4">Add</button><br>
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
        let team = $('#team').val();
        let url = $('#url').val();
        $('#info').html('Verifying '+team+'...');
         $.ajax({
            type: 'post',
            url: 'process.php',
            data: {team: team, tea: 'tea'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#info').html(team+' Exists. <a href="javascript:;" onCLick="edit('+url+')">Update URL Instead?</a>');
              } else if (response == 1) {
                ajaxCall2();
              }
            }
        });

         function ajaxCall2() {
          $('#info').html('Adding '+team);
          $.ajax({
            type: 'post',
            url: 'process.php',
            data: {team: team, url: url, teamm: 'team'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#change').html('<span class="alert alert-danger">An error occured! Please try again</span>');
              } else {
                $('#team').val('');
                $('#join').prop('disabled', false);
                $('#url').val('');
                $('#change').html('');
                $('#info').html(team+' added successfully.');
              }
            }
          });
         }
      });

        function edit(urll) {
          $('#info').html('Updating URL...');
          $.ajax({
            type: 'post',
            url: 'process.php',
            data: {team: teamn, url: urll, uurl: 'team'},
            success: function(response){
              if (response == 0) {
                $('#join').prop('disabled', false);
                $('#info').html('');
                $('#change').html('<span class="alert alert-danger">An error occured! Please try again</span>');
              } else {
                $('#team').val('');
                $('#url').val('');
                $('#join').prop('disabled', false);
                $('#change').html('');
                $('#info').html(team+' added successfully.');
              }
            }
          });
         }
    });
  </script>
</body>
</html>