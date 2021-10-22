<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
            <div class="sidebar">
        
        <div class="antiScroll">
          <div class="antiscroll-inner">
            <div class="antiscroll-content">
          
              <div class="sidebar_inner">
                <form action="index.php?uid=1&amp;page=search_page" class="input-append" method="post" >
                  <input autocomplete="off" name="query" class="search_query input-medium" size="16" type="text" placeholder="Search..." /><button type="submit" class="btn"><i class="icon-search"></i></button>
                </form>
                <div id="side_accordion" class="accordion">
                  
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a href="#collapseThree" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-user"></i> Pengguna
                      </a>
                    </div>
                    <div class="accordion-body collapse" id="collapseThree">
                      <div class="accordion-inner">
                        <ul class="nav nav-list">
                          <li><a href="javascript:void(0)" onclick="getcontents('users','<?php echo $this->session->userdata('sess_token');?>');">Data Pengguna</a></li>
                        </ul>
                        
                      </div>
                    </div>
                  </div>
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a href="#collapseFour" data-parent="#side_accordion" data-toggle="collapse" class="accordion-toggle">
                        <i class="icon-cog"></i> Pengaturan
                      </a>
                    </div>
                    <div class="accordion-body collapse" id="collapseFour">
                      <div class="accordion-inner">
                        <ul class="nav nav-list">
                          <li class="nav-header">Menu dan Role</li>
                          <li><a href="javascript:void(0)" onclick="getcontents('module','<?php echo $this->session->userdata('sess_token');?>');">Module</a></li>
                          <li><a href="javascript:void(0)" onclick="getcontents('role/index','<?php echo $this->session->userdata('sess_token');?>');">Role</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="push"></div>
              </div>
                 
              <div class="sidebar_info">
                <ul class="unstyled">
                  <li>
                    <span class="act act-warning">65</span>
                    <strong>New comments</strong>
                  </li>
                  <li>
                    <span class="act act-success">10</span>
                    <strong>New articles</strong>
                  </li>
                  <li>
                    <span class="act act-danger">85</span>
                    <strong>New registrations</strong>
                  </li>
                </ul>
              </div> 
            
            </div>
          </div>
        </div>
      
      </div>