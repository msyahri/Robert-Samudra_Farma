<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Validasi Ijazah</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/barcodescaner/va/css/font-awesome.css' ?>">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/barcodescaner/va/css/bootstrap.min.css' ?>">
<script src="<?php echo base_url() . 'assets/barcodescaner/va/js/jquery.min.js' ?>"></script>
<script src="<?php echo base_url() . 'assets/barcodescaner/va/js/bootstrap.min.js' ?>"></script>
<link rel="icon"  href="../assets/img/logo.png">
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./">Validasi Ijazah dengan QR Code</a>
      
    </div>
  </div>
</nav>

<div class="container">
<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <div class="panel panel-danger">
      <div class="panel-heading">
        <h3 class="panel-title">Arahkan Kode QR Ke Kamera!</h3>
      </div>
      <div class="panel-body text-center" >
        <canvas></canvas>
        <hr>
        <input type="text" id="hasil"/>
        <button title="Play" class="btn btn-success btn-sm"  onclick="playcam()" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"></span></button>
     
        <button title="Stop" class="btn btn-danger btn-sm"  onclick="stopcam()" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-trash"></span></button>
      </div>
      <div class="panel-footer">
        
      </div>
    </div>
  </div>

</div>
</div>

<!-- Js Lib -->
<script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/jquery.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/qrcodelib.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/webcodecamjquery.js' ?>"></script>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!-- <script type="text/javascript" src="js/qrcodelib.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/webcodecamjs.js' ?>"></script>
        <script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/main.js' ?>"></script>
<script type="text/javascript">
   
    function playcam() {
  var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
  decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
}

 function stopcam() {
  var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
  decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).stop();
}

     var arg = {
        resultFunction: function(result) {
         document.getElementById("hasil").value = result.code;
           alert(result.code);
          // decoder.stop();
        }
    };
    
    
    // decoder.buildSelectMenu("select");
    // decoder.play();
     // Without visible select menu
        
    
    // $('select').on('change', function(){
    //     decoder.stop().play();
    // });

    // jquery extend function
  

</script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/barcodescaner/va/js/lacak.php' ?>"></script>
</body>
</html>