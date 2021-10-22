<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $login_failed = $this->session->flashdata('usersnotfound');
?>

<!DOCTYPE html>
<html lang="en" class="login_page">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login</title>
    
        <!-- Bootstrap framework -->
            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/bootstrap/css/bootstrap.min.css');?>" />
            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/css/jquery-ui.css');?>">
        <!-- theme color-->
            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/css/blue.css');?>" />
        <!-- tooltip -->    
            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/lib/qtip2/jquery.qtip.min.css');?>" />
        <!-- main styles -->
            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/css/style.css');?>" />

        <!-- favicon -->
            <link rel="shortcut icon" href="favicon.ico" />

            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/css/jquery-ui.css');?>">

            <link rel="stylesheet" href="<?php echo base_url('assets/theme/adm2/lib/datepicker/datepicker.css');?>" />
    
         <!-- <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>-->
    
        <!--[if lt IE 9]>
            <script src="js/ie/html5.js"></script>
            <script src="js/ie/respond.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
           
        
        <style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>

        <div class="login_box dev_theme_login" style="padding-top: 20px;">
            
            <div style="width: 100%;text-align: center;">
            <img src="<?php echo base_url('assets/theme/adm2/img/logo.jpg');?>" style="width: 50px">
            <br>
            <span style="font-weight: bold">MSAL GROUP</span>
            <br>
            <hr>
            </div>
       
            <form action="<?php echo base_url('login/authlogin'); ?>" method="post" id="login_form">
                <!--<div class="top_b">Sign in </div>-->  

                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" style="display: none">


                <?php echo $login_failed;?>

                <div style="text-align: center;padding:10px">

                    <div class="form-group ">
                        <div class="input-group">
                            <input class="form-control" required="" type="text" id="c_user" name="c_user" placeholder="Username" style="padding: 10px" />
                        </div>
                    </div>
                    <div class="form-group">
                            <input class="form-control" required="" type="password" id="c_pass" name="c_pass" placeholder="Password" style="padding: 10px"/>
                    </div>
                    <div class="form-group">
                            <input class="form-control input-sm fc-datepicker2" required="" type="text" id="c_periode" name="c_periode" placeholder="Periode" style="padding: 10px"/>
                    </div>


                    <div class="form-group">
                      <select class="form-control" name="c_pt" id="c_pt" style="width:230px;height:40px;
        line-height:30px;">
                        <option value="0">- Pilih PT -</option>
                        <option value="1">PT. MULIA SAWIT AGRO LESTARI</option>
                        <option value="2">PT. PERSADA ERA AGRO KENCANA</option>
                        <option value="3">PT. MITRA AGRO PERSADA ABADI</option>
                        <option value="4">PT. PERSADA SEJAHTERA AGRO MAKMUR</option>
                      </select>
                    </div> 

                    <!--<select class="form-control" name="c_pt" id="c_pt" style="width:230px;height:40px;
        line-height:30px;
        background:#f4f4f4;"></select>-->
                    
                </div>

                <div class="btm_b clearfix">
                    <button class="btn pull-right" type="submit">Sign In</button>
                    <span class="link_reg"><a href="#pass_form">Lupa Password ?</a></span>
                </div>  
            </form>
            
            <form action="index.php?uid=1&amp;page=dashboard" method="post" id="pass_form" style="display:none">
                <div class="top_b">Lupa Password ?</div>    

                <div class="cnt_b" style="padding:4px;margin: 4px">
                    <div class="formRow clearfix">
                        <div class="input-group">
                            <input type="text" placeholder="Your email address" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                <div class="btm_b tac">
                    <a href="<?php echo base_url('login');?>"><button class="btn btn-danger btn-sm" type="button">Kembali</button></a>
                    <button class="btn btn-primary btn-sm" type="submit">Kirim</button>
                    
                </div>  
            </form>
            
            
            <div class="links_b links_btm clearfix">
                 Copyright &copy; MIS MSALGROUP 2019 . Ver.01
            </div>
            
        </div>
         
        <script src="<?php echo base_url('assets/theme/adm2/js/jquery.min.js');?>"></script>
     
      <!-- datepicker -->
      <script src="<?php echo base_url('assets/theme/adm2/lib/datepicker/bootstrap-datepicker.min.js');?>"></script>

      <!-- ...  -->
      <script src="<?php echo base_url('assets/theme/adm2/lib/jquery-ui/jquery-ui-1.8.20.custom.min.js');?>"></script>
      <!-- touch events for jquery ui-->
      <script src="<?php echo base_url('assets/theme/adm2/js/forms/jquery.ui.touch-punch.min.js');?>"></script>
     
      
        <script src="<?php echo base_url('assets/theme/adm2/lib/validation/jquery.validate.js');?>"></script>
        <script src="<?php echo base_url('assets/theme/adm2/bootstrap/js/bootstrap.min.js');?>"></script>
        <script>
            $(document).ready(function(){
                
                var base_url    = "<?php echo base_url();?>";

                $.ajax({
                    type: 'POST',
                    url: base_url + 'login/get_pt',
                    data: {<?php echo $this->security->get_csrf_token_name(); ?>:'<?php echo $this->security->get_csrf_hash(); ?>'},
                    dataType  : 'json',
                    success: function (data) {
                        //$('#c_pt').empty();
                        var $kategori = $('#c_ptc');
                        $kategori.append('<option value=0>-Pilih PT-</option>');
                        for (var i = 0; i < data.length; i++) {
                            $kategori.append('<option value=' + data[i].id + '>'+ data[i].inisial +' - '+ data[i].nama + '</option>');
                        }
                    }
                });

                $('.fc-datepicker2').datepicker({
                  changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yymm',
                    onClose: function(dateText, inst) { 
                        $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
                    }
                });

                //* boxes animation
                form_wrapper = $('.login_box');
                function boxHeight() {
                    form_wrapper.animate({ marginTop : ( - ( form_wrapper.height() / 2) - 24) },400);   
                };
                form_wrapper.css({ marginTop : ( - ( form_wrapper.height() / 2) - 24) });
                $('.linkform a,.link_reg a').on('click',function(e){
                    var target  = $(this).attr('href'),
                        target_height = $(target).actual('height');
                    $(form_wrapper).css({
                        'height'        : form_wrapper.height()
                    }); 
                    $(form_wrapper.find('form:visible')).fadeOut(400,function(){
                        form_wrapper.stop().animate({
                            height   : target_height,
                            marginTop: ( - (target_height/2) - 24)
                        },500,function(){
                            $(target).fadeIn(400);
                            $('.links_btm .linkform').toggle();
                            $(form_wrapper).css({
                                'height'        : ''
                            }); 
                        });
                    });
                    e.preventDefault();
                });
                
                //* validation
                $('#login_form').validate({
                    onkeyup: false,
                    errorClass: 'error',
                    validClass: 'valid',
                    rules: {
                        username: { required: true, minlength: 3 },
                        password: { required: true, minlength: 3 }
                    },
                    highlight: function(element) {
                        $(element).closest('div').addClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    unhighlight: function(element) {
                        $(element).closest('div').removeClass("f_error");
                        setTimeout(function() {
                            boxHeight()
                        }, 200)
                    },
                    errorPlacement: function(error, element) {
                        $(element).closest('div').append(error);
                    }
                });
            });
        </script>
        
    </body>
</html>