<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>

            <aside class="main-sidebar">
                <section class="sidebar">
<?php if ($admin_prefs['user_panel'] == TRUE): ?>
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo base_url($avatar_dir . '/m_001.png'); ?>" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $user_login['firstname'].$user_login['lastname']; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo lang('menu_online'); ?></a>
                        </div>
                    </div>

<?php endif; ?>
<?php if ($admin_prefs['sidebar_form'] == TRUE): ?>
                    <!-- Search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="<?php echo lang('menu_search'); ?>...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

<?php endif; ?>
                    <!-- Sidebar menu -->
                    <ul class="sidebar-menu">
                        <li>
                            <a target="_blank" href="<?php echo site_url('/'); ?>">
                                <i class="fa fa-home text-primary"></i> <span><?php echo lang('menu_access_website'); ?></span>
                            </a>
                        </li>

                        <li class="header text-uppercase"><?php echo lang('menu_main_navigation'); ?></li>
                        <li class="<?=active_link_controller('dashboard')?>">
                            <a href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i> <span><?php echo lang('menu_dashboard'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('orders')?>">
                            <a href="<?php echo site_url('admin/orders'); ?>">
                                <i class="fa fa-list"></i> <span><?php echo lang('menu_orders'); ?></span>
                            </a>
                        </li>
                          <li class="<?=active_link_controller('customer')?>">
                            <a href="<?php echo site_url('admin/customer'); ?>">
                                <i class="fa fa-list"></i> <span><?php echo lang('menu_customer'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('slider')?>">
                            <a href="<?php echo site_url('admin/slider'); ?>">
                                <i class="fa fa-list"></i> <span><?php echo lang('menu_slider'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('page')?>">
                            <a href="<?php echo site_url('admin/page'); ?>">
                                <i class="fa fa-list"></i> <span><?php echo lang('menu_page'); ?></span>
                            </a>
                        </li>

                        <li class="<?=active_link_controller('category')?>">
                            <a href="<?php echo site_url('admin/category'); ?>">
                                <i class="fa fa-list"></i> <span><?php echo lang('menu_category'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('products')?>">
                            <a href="<?php echo site_url('admin/products'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_products'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('combo')?>">
                            <a href="<?php echo site_url('admin/combo'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_combo'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('contest')?>">
                            <a href="<?php echo site_url('admin/contest'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_contest'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('brands')?>">
                            <a href="<?php echo site_url('admin/brands'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_brand'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('menu')?>">
                            <a href="<?php echo site_url('admin/menu'); ?>">
                                <i class="fa fa-cubes"></i> <span><?php echo lang('menu_menu'); ?></span>
                            </a>
                        </li>
                        
                        <li class="<?=active_link_controller('theme')?>">
                            <a href="<?php echo site_url('admin/theme'); ?>">
                                <i class="fa fa-cog"></i> <span><?php echo lang('menu_theme_options'); ?></span>
                            </a>
                        </li>
                        <li class="<?=active_link_controller('signups')?>">
                            <a href="<?php echo site_url('admin/signups'); ?>">
                                <i class="fa fa-cog"></i> <span><?php echo lang('menu_signup'); ?></span>
                            </a>
                        </li>
                        
                    </ul>
                </section>
            </aside>
