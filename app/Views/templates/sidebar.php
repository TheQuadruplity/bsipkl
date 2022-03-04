<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">BSI Persekot</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<?php

foreach($data as $d){
    switch(sizeof($d)){
        case 0:
            echo '<hr class="sidebar-divider">';
            break;
        case 1:
            echo "<div class='sidebar-heading'>$d[0]</div>";
            break;
        default:
            $pname = explode('\\', $page);
            $pname = $pname[2];
            if(!isset($d[2])) $d[2] = '';
            echo "<li class='nav-item".($pname == $d[0] ? ' active' : '')."'><a class='nav-link' href='$d[0]'><i class='$d[2]'></i><span>$d[1]</span></a></li>";
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