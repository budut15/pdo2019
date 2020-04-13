
            <nav id="mainnav-container">
                <div id="mainnav">
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">
                                <div id="mainnav-profile" class="mainnav-profile">
                                    <div class="profile-wrap text-center">
                                        <div class="pad-btm">
											<img class="img-circle img-md" src="<?= base_url('assets/img/') .$about['LOGO_STRUK']?>" alt="<?= $this->session->userdata('NAMA_APK')?>"/>
                                        </div>
                                        <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                            <p class="mnp-name"><?= $this->session->userdata('NAMA_APK')?></p>
                                            <span class="mnp-desc"><?= getTANGGAL($this->session->userdata('TANGGAL_APK'),6)?></span>
                                        </a>
                                    </div>
                                    <div id="profile-nav" class="collapse list-group bg-trans">
                                        <a href="#" class="list-group-item">
                                            <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                        </a>
                                        <a href="<?= base_url('Auth/Logout')?>" class="list-group-item">
                                            <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                        </a>
                                    </div>
                                </div>
                               
								<ul id="mainnav-menu" class="list-group">
						            <li class="list-header">Navigation</li>
									<li <?php if($title == $this->uri->segment(1)) : ?> class='active-link' <?php endif;?> >
						                <a href="<?= base_url('Dashboard')?>">
						                    <i class="demo-pli-home text-teal"></i>
						                    <span class="menu-title">
												Dashboard
											</span>
						                </a>
						            </li>
									
									<?php 
									$this->db->cache_on();
									$queryMenu = "SELECT a.`ID_MENU`,a.`TITTLE`,a.`URL_CI`,a.`ICON`,GROUP_CONCAT(b.`ID`,'#',b.`TITTLE`,'#',b.`URL_CI`,'#',b.`ICON` order by b.`TITTLE` SEPARATOR '|') submenu FROM `m_menu` a JOIN `m_menu_sub` b ON a.`ID_MENU`=b.`ID_MENU` WHERE a.`IS_ACTIVE`=1 AND b.`IS_ACTIVE`=1 GROUP BY a.`ID_MENU`";
									$Menu = $this->db->query($queryMenu)->result_array();
									$this->db->cache_off();
									foreach ($Menu as $m) : 
									if($m['URL_CI']=='#'){
										$submenu=explode('|',$m['submenu']);
										$jml=count($submenu); ?>
										
						<li <?php if($this->uri->segment(1) == $m['TITTLE']) : ?> class="active-sub" <?php endif;?> >
						                <a href="#">
						                    <i class="<?= $m['ICON']?>"></i>
						                    <span class="menu-title"><?= $m['TITTLE']?></span>
											<i class="arrow"></i>
						                </a>
						                <ul class="collapse <?php if($this->uri->segment(1) == $m['TITTLE']) echo 'in'; ?>">
										<?php for($i=0;$i<$jml;$i++){
						 $sb=explode('#',$submenu[$i]); ?>
						                    <li <?php if($title == $sb[1]) : ?> class='active-link' <?php endif;?> >
											
											<a href="<?= base_url().$sb[2]?>"><i class="<?= $sb[3]?>"></i> <?= $sb[1]?></a></li>
											<?php }?>
						                </ul>
						</li>		
						
						<?php }else{ ?>
						
						<li <?php if($title == $m['TITTLE']) : ?> class='active-link' <?php endif;?> >
                        <a href="<?= base_url(). $m['URL_CI']?>" > <i class="<?= $m['ICON']?>" ></i><span class="menu-title"><?= $m['TITTLE']?></span></a>                        
						</li> 
						
						<?php } endforeach; ?>
						</ul>
                                <div class="mainnav-widget">

                                    <!-- Show the button on collapsed navigation -->
                                    <div class="show-small">
                                        <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                            <i class="demo-pli-monitor-2 text-orange"></i>
                                        </a>
                                    </div>

                                    <!-- Hide the content on collapsed navigation -->
                                    <div id="demo-wg-server" class="hide-small mainnav-widget-content">
                                        <ul class="list-group">
                                            <li class="list-header pad-no mar-ver">Status</li>
                                            <li class="mar-btm">
                                                <span class="label label-primary pull-right">{elapsed_time} sc</span>
                                                <p>Page rendered in</p>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
								
								
								
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
