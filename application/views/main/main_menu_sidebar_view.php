<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
<div class="sidebar">

  <div class="antiScroll">
    <div class="antiscroll-inner">
      <div class="antiscroll-content">

        <div class="sidebar_inner">
          <form action="index.php?uid=1&amp;page=search_page" class="input-append" method="post">
            <!-- <input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Search..." /><button type="submit" class="btn"><i class="icon-search"></i></button> -->
          </form>
          <div id="side_accordion" class="accordion">

            <?php
            foreach ($modules as $mod) {
              if ($mod['position'] == 1 and $mod['have_child'] == 'Y') {
            ?>

                <div class="accordion-group">
                  <div class="accordion-heading">
                    <a href="#<?php echo $mod['name']; ?>" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                      <i class="icon-th"></i> <?php echo $mod['name']; ?>
                    </a>
                  </div>
                  <div class="accordion-body collapse" id="<?php echo $mod['name']; ?>">
                    <div class="accordion-inner">
                      <ul class="nav nav-list">
                        <li class="nav-header"><?php echo $mod['name']; ?></li>
                        <?php
                        foreach ($modules as $d) {
                          if ($d['position'] == 2 and $d['have_child'] == 'Y' and $d['parent'] == $mod['id']) {

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
                          } else if ($d['position'] == 2 and $d['have_child'] == 'N' and $d['parent'] == $mod['id']) {

                            if ($d['line'] == 1) {
                              //ini bedasnya ditambah class line_menu
                              echo '<li><a class="line_menu" href="javascript:void(0)" onclick=getcontents("' . $d['controller'] . '","' . $this->session->userdata('sess_token') . '")>' . $d['name'] . '</a></li>';
                            } else {
                              echo '<li><a href="javascript:void(0)" onclick=getcontents("' . $d['controller'] . '","' . $this->session->userdata('sess_token') . '")>' . $d['name'] . '</a></li>';
                            }
                          }
                        }
                        ?>
                      </ul>
                    </div>
                  </div>
                </div>

            <?php }
            } ?>

          </div>

          <div class="push"></div>
        </div>



      </div>
    </div>
  </div>

</div>