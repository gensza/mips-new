<?php 
if(!isset($_SESSION)){ 
    session_start(); 
}

$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
$this->output->set_header('Pragma: no-cache');

//LOGIN SESSION
$sess_nama          = $this->session->userdata('sess_nama');
$sess_username      = $this->session->userdata('sess_username');
$sess_token         = $this->session->userdata('sess_token');
$sess_aktif         = $this->session->userdata('sess_aktif');
$sess_login         = $this->session->userdata('sess_login');
$sess_id_admin      = $this->session->userdata('sess_id_admin');
$sess_periode       = $this->session->userdata('sess_periode');
$sess_id_lokasi     = $this->session->userdata('sess_id_lokasi');
$sess_nama_lokasi   = $this->session->userdata('sess_nama_lokasi');
$inis_db            = $this->session->userdata('sess_inis_db');

/* session kcfinder */
$_SESSION['KCFINDER']=array();
$_SESSION['KCFINDER']['disabled'] = false;
$_SESSION['KCFINDER']['uploadURL'] = base_url('assets/plugins/editor/files/');
$_SESSION['KCFINDER']['uploadDir'] = "";
/* session kcfinder */

//$this->session->sess_expiration = '14400'; // expires in 4 hours

if($sess_login==0){
    redirect(base_url("main/logout"));
}
else{
if (empty($sess_username) AND empty($sess_token) AND $login ==0 && $sess_aktif == 1){
    redirect(base_url("main/logout"));
}
else{
   
    
?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>MIPS - <?php echo $namamodul['nama'];?></title>
    
        <?php include "main_css.php";?>
  
        <!-- Favicon -->
        <link rel="shortcut icon" href="favicon.ico" />
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/ie.css" />
            <script src="js/ie/html5.js"></script>
      <script src="js/ie/respond.min.js"></script>
      <script src="lib/flot/excanvas.min.js"></script>
        <![endif]-->
    
    <script>
      //* hide all elements & show preloader
      document.documentElement.className += 'js';
    </script>
    </head>
    <body>



<style type="text/css">
  
  .dev_theme{
    background-color:#0c7509; 
  }

  .prod_theme{
    background-color:#00758f; 
  }

</style>

    

    <div id="loading_layer" style="display:none"><img src="<?php echo base_url('assets/theme/adm2/img/ajax_loader.gif');?>" alt="" /></div>

    <?php include "main_setting_view.php";?>

    <?php 
      if($this->session->userdata('sess_level') == 1){
    ?>

    <div id="contentwrapperx">

      <?php include "main_header_view.php";?>

                <div class="main_contentx" style="padding:10px;padding-top:50px">

                  <div id="content-containers"></div>
                  <div id="content-modals"></div>

                </div>
              </div>
    <?php 
     // include "main_menu_sidebar_view.php";
    }else{
    ?>
    
    <div id="contentwrapperx">

      <?php include "main_header_view.php";?>

                <div class="main_contentx" style="padding:10px;padding-top:50px">

                  <div id="content-containers"></div>
                  <div id="content-modals"></div>

                </div>
              </div>


    <?php
    }
    ?>


            
            
      
      <?php include "main_js.php";?>

    
    </div>
  </body>
</html>







<?php 
}
}
?>