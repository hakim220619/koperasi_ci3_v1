<?php
$apl = $this->db->get_where('aplikasi')->row_array();

// dead($apl);
?>
<div class="main-header">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="blue" style="font-size: 30px;">

        <a href="<?= base_url('dashboard') ?>" class="logo">
            <img src="<?php echo base_url(); ?>assets/foto/logo/<?php echo $apl['logo']; ?>" alt="navbar brand" style="height: 20px;" class="navbar-brand">
            <span class="brand-text font-weight-light" style="font-weight: 999!important; color: white;"><?php echo  $apl['title']; ?></span>
        </a>

        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="icon-menu"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
        <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
                <i class="icon-menu"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

        <div class="container-fluid">
            <!-- <div class="collapse" id="search-nav">
                <form class="navbar-left navbar-form nav-search mr-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button type="submit" class="btn btn-search pr-1">
                                <i class="fa fa-search search-icon"></i>
                            </button>
                        </div>
                        <input type="text" placeholder="Search ..." class="form-control">
                    </div>
                </form>
            </div> -->

            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                    <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
                <li class="nav-item dropdown hidden-caret">

                </li>
                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg"><img src="<?php echo base_url(); ?>assets/foto/user/<?php echo $this->session->userdata['image']; ?>" alt="image profile" class="avatar-img rounded"></div>
                                    <div class="u-text">
                                        <h4></h4>
                                        <a href="profil" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" style="text-align:center" href="<?= base_url('login/logout') ?>"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</a>
                                </a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>