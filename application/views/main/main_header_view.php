<header>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <!--<div class="container-fluid dev_theme">-->
            <div class="container-fluid">
                <!-- production-->
                <a class="brand" href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>');"><i class="icon-home icon-white"></i> <b>MIPS - <?php echo $namamodul['nama']; ?></b></a>
                <ul class="nav user_menu pull-right">
                    <li class="hidden-phone hidden-tablet">
                        <div class="nb_boxes clearfix" style="margin-right: 3px">
                            <a href="javascript:void(0)" class="label ttip_b"><i class="splashy-star_boxed_full"></i> <?php echo $namapt['inisial']; ?></a>
                        </div>
                    </li>
                    <li class="hidden-phone hidden-tablet">
                        <div class="nb_boxes clearfix" style="margin-right: 3px">
                            <a href="javascript:void(0)" class="label ttip_b"><i class="splashy-marker_rounded_green"></i><?php echo $this->session->userdata('sess_nama_lokasi'); ?></a>
                        </div>
                    </li>
                    <li class="hidden-phone hidden-tablet">
                        <div class="nb_boxes clearfix">
                            <a href="javascript:void(0)" id="tx_periode" class="label ttip_b"><i class="splashy-calendar_week"></i> <?php echo $this->session->userdata('sess_periode'); ?></a>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/theme/adm2/img/user_avatar.png'); ?>" alt="" class="user_avatar" /> Hi, <?php echo $sess_nama; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="javascrip:void(0)">My Profile</a></li>
                            <li><a href="javascrip:void(0)">Another action</a></li>
                            <li class="divider"></li>
                            <li><a style="cursor: pointer;" id="logouts">Log Out</a></li>



                        </ul>
                    </li>
                </ul>
                <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu">
                    <span class="icon-align-justify icon-white"></span>
                </a>
                <nav>
                    <div class="nav-collapse">

                        <?php include "main_menu_view.php"; ?>

                    </div>
                </nav>
            </div>
        </div>
    </div>
    <div class="modal hide fade" id="myMail">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>New messages</h3>
        </div>
        <div class="modal-body">
            <div class="alert alert-info">In this table jquery plugin turns a table row into a clickable link.</div>
            <table class="table table-condensed table-striped" data-rowlink="a">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Declan Pamphlett</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>23/05/2012</td>
                        <td>25KB</td>
                    </tr>
                    <tr>
                        <td>Erin Church</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>24/05/2012</td>
                        <td>15KB</td>
                    </tr>
                    <tr>
                        <td>Koby Auld</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2012</td>
                        <td>28KB</td>
                    </tr>
                    <tr>
                        <td>Anthony Pound</td>
                        <td><a href="javascript:void(0)">Lorem ipsum dolor sit amet</a></td>
                        <td>25/05/2012</td>
                        <td>33KB</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="btn">Go to mailbox</a>
        </div>
    </div>

</header>