<ul class="nav">
    <!--<li><a href="javascript:void(0)" onclick="getcontents('home','<?php echo $this->session->userdata('sess_token'); ?>');"><i class="icon-home icon-white"></i> Home</a></li>-->
    <?php
    foreach ($modules as $mod) {
        if ($mod['position'] == 1 and $mod['have_child'] == 'Y') {
    ?>
            <li class="dropdown">

                <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="icon-th icon-white"></i> <?php echo $mod['name']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <style type="text/css">
                        .line_menu_x {
                            border-bottom: 1px dashed #ccc;
                            line-height: 26px;
                        }
                    </style>
                    <?php
                    foreach ($modules as $d) {
                        if ($d['position'] == 2 and $d['have_child'] == 'Y' and $d['parent'] == $mod['id']) {

                            if (($d['name'] == 'Income Statement' or $d['name'] == 'Balance' or $d['name'] == 'Report PKRM' or $d['name'] == 'Financial Conditions') and ($this->session->userdata('sess_nama_lokasi') == 'ESTATE' or $this->session->userdata('sess_nama_lokasi') == 'PKS')) {
                            } else {

                                echo '<li class="dropdown">
                                <a class="line_menu" href="javascript:void(0)" onclick=getcontents("' . $d['controller'] . '","' . $this->session->userdata('sess_token') . '")>' . $d['name'] . '<b class="caret-right"></b></a>
                                <ul class="dropdown-menu">';
                                foreach ($modules as $ex) {
                                    if ($ex['position'] == 3 and $ex['parent'] == $d['id']) {
                                        echo '<li><a href="javascript:void(0)" onclick=getcontents("' . $ex['controller'] . '","' . $this->session->userdata('sess_token') . '");><span class="fa fa-dot-circle-o"></span> ' . $ex['name'] . '</a></li>';
                                    }
                                }
                                echo '</ul>
                                </li>';
                            }
                        } else if ($d['position'] == 2 and $d['have_child'] == 'N' and $d['parent'] == $mod['id']) {

                            if (($d['name'] == 'Income Statement' or $d['name'] == 'Balance' or $d['name'] == 'Report PKRM' or $d['name'] == 'Financial Conditions') and ($this->session->userdata('sess_nama_lokasi') == 'ESTATE' or $this->session->userdata('sess_nama_lokasi') == 'PKS')) {
                            } else {

                                if ($d['line'] == 1) {
                                    //ini bedasnya ditambah class line_menu
                                    echo '<li><a class="line_menu" href="javascript:void(0)" onclick=getcontents("' . $d['controller'] . '","' . $this->session->userdata('sess_token') . '")>' . $d['name'] . '</a></li>';
                                } else {
                                    echo '<li><a href="javascript:void(0)" onclick=getcontents("' . $d['controller'] . '","' . $this->session->userdata('sess_token') . '")>' . $d['name'] . '</a></li>';
                                }
                            }
                        }
                    }
                    ?>

                </ul>
            </li>

        <?php
        } else if ($mod['position'] == 1 and $mod['have_child'] == 'N') {
        ?>
            <li>
                <?php
                echo '<a class="line_menu" href="javascript:void(0)" onclick=getcontents("' . $mod['controller'] . '","' . $this->session->userdata('sess_token') . '")  class="sidebar-nav-link active"><i class="icon ion-' . $mod['icon'] . '"></i> ' . $mod['name'] . '</a>';
                ?>
            </li>
    <?php
        }
    }

    ?>


</ul>