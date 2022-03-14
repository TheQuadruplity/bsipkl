<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0ca49d;">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
    <div class="sidebar-brand-icon mx-3"><img src="<?= base_url()?>/logo-bsi.png" height="125%" width="125%"></img></div>
    <div class="sidebar-brand-text mx-3">BSI Persekot</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<?php

foreach($data as $d){
    switch(sizeof($d)){
        case 0:
            echo '<hr class="sidebar-divider my-0">';
            break;
        case 1:
            echo "<div class='sidebar-heading mt-3'>$d[0]</div>";
            break;
        default:
            $pname = explode('\\', $page);
            $pname = $pname[2];
            if(!isset($d[2])) $d[2] = '';
            echo "<li class='nav-item".(strtolower($pname) == $d[0] ? ' active' : '')."'>";
            echo    "<a class='nav-link' href='".base_url()."/$d[0]'>";
            echo        "<i class='fa-fw $d[2]'></i><span>$d[1]</span></a></li>";
            break;
    }
    
}

?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->