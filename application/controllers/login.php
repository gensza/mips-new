<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('cipasswordhash');
        $this->load->model('main_model');
        $this->load->helper('captcha');
        $this->mips_center  = $this->load->database('mips_center', TRUE);
    }

    public function index()
    {
        if ($this->session->userdata('sess_id') != 0) {
            # code...
            $id = $this->session->userdata('sess_id');
            $result = $this->db->query("SELECT * FROM users WHERE id = '$id'")->row();
            $token = $result->token;
            $id_users = $result->id;
            $aktif = $result->aktif;
            redirect(base_url("index.aspx?TokEn=$token&IdUs=$id_users&AkTif=$aktif"));
        } else {
            # code...
            $rand = random_string('numeric', 6);

            // Captcha configuration
            $config = array(
                'img_path'      => 'captcha_images/',
                'img_url'       => base_url() . 'captcha_images/',
                'img_width'     => '150',
                'img_height'    => 50,
                'word_length'   => 8,
                'font_size'     => 30,
                'word'         => $rand,
            );
            $captcha = create_captcha($config);

            // Unset previous captcha and store new captcha word
            $this->session->unset_userdata('captchaCode');
            $this->session->set_userdata('captchaCode', $captcha['word']);

            // Send captcha image to view
            $data['captchaImg'] = $captcha['image'];
            $data['num'] = $rand;

            $this->load->view('login/login_view', $data);
        }
    }

    public function ubah_password()
    {

        $tokens = $this->input->post('tokens', TRUE);
        $result = $this->main_model->check_token($tokens);
        $data['tokens'] = $tokens;
        if ($result == '1') {
            $this->load->view('login/reset_password_view', $data);
        } else {
            echo "<script> window.location = 'main/logout' </script>";
        }
    }

    public function resetpassword()
    {
        $this->load->view('login/reset_password_view');
    }

    public function ubah_password_simpan()
    {
        $key = $this->config->item('encryption_key');
        $password = $this->input->post('password_baru', TRUE);
        $password_baru  =  $this->cipasswordhash->create_hash($password, $key);
        $result_data    = $this->login_model->ubah_password_simpan($password_baru);
        echo json_encode($result_data);
    }

    public function authlogin()
    {

        $key = $this->config->item('encryption_key');

        //ini input dari form login
        $username = $this->input->post('c_user', TRUE);
        $password = $this->input->post('c_pass', TRUE);
        $periode  = $this->input->post('c_periode', TRUE);
        $pt       = $this->input->post('c_pt', TRUE);
        $kodept = ltrim($pt, '0');

        $recaptcha = $this->input->post('nama_tanggal', TRUE);
        $captcha = $this->input->post('kodecpt', TRUE);



        if ($recaptcha <> $captcha) {
            $this->session->set_flashdata('usersnotfound', '<div class="alert alert-danger"><i class="la la-warning"></i> Kode Captcha tidak sesuai !</div>');
            redirect(base_url('login'));
        } else {

            //inputan dibuat ke array
            $where = array(
                'username' => $username,
                'pt'       => $kodept,
                'password' => $this->cipasswordhash->verify_hash($password, $key)
            );

            // var_dump($where);
            // exit();

            //fungsi login , filter username dan password ke model
            $result_data = $this->login_model->authlogin($where)->row_array();

            $lok = $this->db->query("SELECT nama as nama_lokasi FROM codegroup WHERE value='$result_data[id_lokasi]' AND group_n='LOKASI_USERS'")->row_array();
            $getpt = $this->mips_center->query("SELECT nama_pt, logo, alias FROM tb_pt WHERE kode_pt='$pt'")->row_array();
            $setup = $this->db->query("SELECT txtperiode FROM tb_setup WHERE id_modul='$result_data[id_module_role]' AND id_pt='$pt' AND lokasi='$result_data[id_lokasi]'")->row_array();
            // var_dump($setup) . die();
            // var_dump($result_data) . die();
            //ini fungsi cek query, jika ada
            if ($result_data) {

                if (isset($result_data)) {
                    $sf_id          = $result_data['id'];
                    $sf_nama        = $result_data['nama'];
                    $sf_token       = $result_data['token'];
                    $sf_aktif       = $result_data['aktif'];
                    $level          = $result_data['id_module_role'];
                    $lokasi         = $result_data['id_lokasi'];
                    $namalokasi     = $lok['nama_lokasi'];
                    $namapt     = $getpt['nama_pt'];
                    $logo     = $getpt['logo'];
                    $inis_db        = $getpt['alias'];
                    $txtperiode = $setup['txtperiode'];
                }

                if ($sf_id == null && $sf_token == null && $sf_aktif == '0') {
                    //jika tidak ada id_users dan username tidak sama maka redirect logout
                    redirect(base_url('main/logout'));
                } else {
                    //ini kode random untuk token
                    $token = "";
                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                    $codeAlphabet .= "0123456789";

                    $max = strlen($codeAlphabet) - 1;
                    for ($i = 0; $i < 15; $i++) {
                        $token .= $codeAlphabet[mt_rand(0, $max)];
                    }
                    //ini kode random untuk token

                    //ini fungsi update token ke model
                    $result_data = $this->login_model->update_token($sf_id, $token);

                    $sf_id;
                    $sf_nama;
                    $sf_token;
                    $sf_aktif;
                    $level;
                    $lokasi;
                    $namalokasi;
                    $namapt;
                    $logo;
                    $txtperiode;
                    $inis_db;

                    // $data['get_tb_pt_central'] = $this->db->get_where('tb_pt', array('kode_pt' => $pt))->row_array();
                    $pt_login = FALSE;
                    if ($inis_db == 'MSAL') {
                        $pt_login = 'msal';
                    } else if ($inis_db == 'MAPA') {
                        $pt_login = 'mapa';
                    } else if ($inis_db == 'PEAK') {
                        $pt_login = 'peak';
                    } else if ($inis_db == 'PSAM') {
                        $pt_login = 'psam';
                    } else if ($inis_db == 'KPP') {
                        $pt_login = 'kpp';
                    }

                    // ini session login
                    $data_session = array(
                        'sess_nama'         => $sf_nama,
                        'sess_id'           => $sf_id,
                        'sess_token'        => $token,
                        'sess_aktif'        => $sf_aktif,
                        'sess_level'        => $level,
                        'sess_periode'      => $txtperiode,
                        'sess_pt'           => $pt,
                        'sess_nama_pt'      =>  $namapt,
                        'sess_logo'      =>  $logo,
                        'sess_id_lokasi'    => $lokasi,
                        'sess_nama_lokasi'  => $namalokasi,
                        'sess_db'           => $pt_login,
                        'sess_login'        => "1",
                        'sess_pw_cb'        => "0"
                    );
                    // var_dump($data_session['sess_id']) . die();

                    $this->session->set_userdata($data_session);
                    //?u=aHR0cDovL2RldGlrLmNvbS8

                    redirect(base_url("index.aspx?TokEn=$token&IdUs=$sf_id&AkTif=$sf_aktif"));
                }

                //redirect(base_url("dps/main/page?uscod=$uscod&token=$token"));

            } else {

                $this->session->set_flashdata('usersnotfound', '<div style="text-align: center;padding:10px"><span style="color:red;font-weight:bold">Login Failed !</span></div>');
                redirect(base_url('login'));
            }
        }
    }

    public function buatpass()
    {
        $key = $this->config->item('encryption_key');
        echo $this->cipasswordhash->create_hash('13687', '$key');
    }

    public function get_pt()
    {
        $res = $this->login_model->get_pt()->result_array();
        echo json_encode($res);
    }

    //    public function createpass(){
    //        $key = $this->config->item('encryption_key');
    //        //ini untuk buat
    //        //echo $this->cipasswordhash->create_hash('@password123','$key');

    //        //$password = '@password123';
    //        //$salt1 = hash('sha256',$password);
    //      
    //        //echo $salt1;
    //        //$hash = hash('sha256', $hash);
    //
    //
    //        //ini untuk cek
    //        //echo $this->cipasswordhash->verify_hash('8212e836bff077583dd009f17519e6d53d26b589f65e2cb873987d0188c6ff4f80b29be45799f8a42e31032ae1ac8ea68dc927636b6152f35cf01792f5e9034d','$key');
    //        
    //    }

    public function reset_password()
    {
        $this->load->view('login/reset_password_view.php');
    }

    public function reset_password_info()
    {
        $this->load->view('login/reset_password_info_view.php');
    }

    public function reset_password_aksi()
    {

        $email = $this->input->post('c_email', TRUE);

        //ini kode random untuk token
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";

        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < 70; $i++) {
            $token .= $codeAlphabet[mt_rand(0, $max)];
        }
        //ini kode random untuk token

        //cek email dulu, ada atau tidak
        $eml        = $this->login_model->check_email($email);
        $data_users = $this->login_model->users_detail($email);

        if ($eml == 1) {

            $password = "";
            $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
            $codeAlphabet .= "9876543210123456789";

            $max = strlen($codeAlphabet) - 1;
            for ($i = 0; $i < 6; $i++) {
                $password .= $codeAlphabet[mt_rand(0, $max)];
            }


            //aksi reset password
            $key = $this->config->item('encryption_key');
            $password_baru  =  $this->cipasswordhash->create_hash($password, '$key');
            $result_data    = $this->login_model->reset_password($email, $password_baru);

            if (json_encode($result_data) == true) {



                $this->load->library('MY_PHPMailer');
                $mail = new PHPMailer();
                $mail->IsSMTP();                       // set mailer to use SMTP
                $mail->Host     = "mail.sistemku.id";  // specify main and backup server
                $mail->SMTPAuth = false;     // turn off SMTP authentication
                $mail->Username = "cs@sistemku.id";  // SMTP username
                $mail->Password = "@password2017"; // SMTP password

                $mail->From = "noreply@kementrian-lhk.go.id";
                $mail->FromName = 'Kementrian Lingkungan Hidup dan Kehutanan';
                $mail->AddAddress($data_users['email'], $data_users['fullname']);
                $mail->IsHTML(true);
                $mail->Subject = "Reset Password e-Monitoring";

                $mail->Body = '<table cellpadding="0" cellspacing="0" style="border:1px #dceaf5 solid;" border="0" align="center" id="">';
                $mail->Body .= '<tbody id="">';
                $mail->Body .= '<tr><td colspan="3" height="52"></td></tr>';
                $mail->Body .= '<tr style="line-height:0px;" id="">';
                $mail->Body .= '<td width="100%" style="font-size:0px;" align="center" height="1" id="">';
                $mail->Body .= '</td></tr>';
                $mail->Body .= '<tr id=""><td id="">';
                $mail->Body .= '<table cellpadding="0" cellspacing="0" style="line-height:25px;" border="0" align="center" id="">';
                $mail->Body .= '<tbody id="">';
                $mail->Body .= '<tr id=""><td width="36"></td>';
                $mail->Body .= '<td width="454" align="left" style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:\'Open Sans\', \'Lucida Grande\', \'Segoe UI\', Arial, Verdana, \'Lucida Sans Unicode\', Tahoma, \'Sans Serif\';max-width:454px;" valign="top" id="">Hai , <strong>' . $data_users['fullname'] . '</strong><br>';
                $mail->Body .= 'Password Anda telah direset , Berikut adalah Informasi Akun Baru Anda : <br> ';
                $mail->Body .= 'Username : ' . $this->input->post('c_email', TRUE) . '<br> ';
                $mail->Body .= 'Password : ' . $password . '<br> ';
                $mail->Body .= '<br><br> Silahkan login : <a href=' . base_url('login') . '>Login</a> <br><br></td><td width="36" id=""></td></tr>';
                $mail->Body .= '</table></td></tr></tbody></table><br><br>';

                //send the message, check for errors
                if (!$mail->send()) {
                    //echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    $mail->send();
                    //echo "Message sent!";
                }

                redirect(base_url('reset-password-info'));
            }
        } else {
            $this->session->set_flashdata('usersnotfound', 'Email tidak terdaftar !!');
            redirect(base_url('reset-password'));
        }
    }
}
