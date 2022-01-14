<?php
if ($this->session->userdata('sess_level') == 1) {
?>

  <div class="span2">
    <span style="color:white">&nbsp;</span>
  </div>
  <div class="span8">
    <div class="section-wrapper">
      <h3 class="heading">Hi, Administrator<b></b></h3>
      <div class="row-fluid">
        <span class="alert alert-info">Selamat Datang di <b>MIPS - <?php echo $namapt['nama']; ?>.</b></span>

        <!--<br>
            <br>

              <ul class="dshb_icoNav tac" style="padding: 0px">
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/multi-agents.png'); ?>"><span class="label label-info">+10</span> Pengguna</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/world.png'); ?>)">Map</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/configuration.png'); ?>)">Settings</a></li>
    
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/van.png'); ?>)"><span class="label label-success">$2851</span> Delivery</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/pie-chart.png'); ?>)">Charts</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/edit.png'); ?>)">Add New Article</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
              </ul>

          -->

      </div>
    </div>
  </div>

<?php
} else {
?>
  <div class="span2">
    <span style="color:white">&nbsp;</span>
  </div>
  <div class="span8">
    <div class="section-wrapper">
      <h3 class="heading">Hi, <?php echo $ses_nama; ?> &nbsp; <b>
          <?php
          //                echo substr($this->session->userdata('sess_periode'), 0, 4);
          //                echo "<br>";
          //                echo substr($this->session->userdata('sess_periode'), 4, 6);
          //                echo "<br>";
          //                echo substr($this->session->userdata('sess_periode'), 0, 4).'-'.substr($this->session->userdata('sess_periode'), 4, 6);
          //            
          ?></b></h3>
      <div class="row-fluid">
        <span class="alert alert-info">Selamat Datang di <b>MIPS - <?php echo $namamodul['nama']; ?> - <?php echo $namapt['nama']; ?> - <?= $this->session->userdata('sess_nama_pt') ?></b></span>
        <!-- <input type="text" name="" id="" value="<?= $this->session->userdata('sess_level') ?>"> -->
        <br>
        <br>
        <?php if ($this->session->userdata('sess_level') == 3) { ?>

          <div class="span12">
            <ul class="dshb_icoNav tac">
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/multi-agents.png)"><span class="label label-info">+10</span> Users</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/world.png)">Map</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/configuration.png)">Settings</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/lab.png)">Lab</a>
              </li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/van.png)"><span class="label label-success">$2851</span> Delivery</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/pie-chart.png)">Charts</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/edit.png)">Add New Article</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/add-item.png)"> Add New Page</a></li>
              <li><a href="javascript:void(0)" style="background-image: url(img/gCons/chat-.png)"><span class="label label-important">26</span> Comments</a></li>
            </ul>
          </div>
        <?php } ?>
        <!--<br>
            <br>

              <ul class="dshb_icoNav tac" style="padding: 0px">
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/multi-agents.png'); ?>"><span class="label label-info">+10</span> Pengguna</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/world.png'); ?>)">Map</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/configuration.png'); ?>)">Settings</a></li>
    
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/van.png'); ?>)"><span class="label label-success">$2851</span> Delivery</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/pie-chart.png'); ?>)">Charts</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/edit.png'); ?>)">Add New Article</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/add-item.png'); ?>)"> Add New Page</a></li>
                <li><a href="javascript:void(0)" style="background-image: url(<?php echo base_url('assets/theme/adm2/img/gCons/chat-.png'); ?>)"><span class="label label-important">26</span> Comments</a></li>
              </ul>

          -->

      </div>
    </div>
  </div>


<?php
}
?>