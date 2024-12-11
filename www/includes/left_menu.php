<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=$rootPath?>index.php">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Pject<sup>Y</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="<?=$rootPath?>index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>


<!-- 개인 프로젝트 정리 중 -->

<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    MyProject
</div>

<!-- Nav Item - Pages Collapse Menu -->
<?
//collapsed active
$que_active = "select * from projectList where doneDate <= '".date('Y-m-d')."' and projectSite = '".$_SESSION['left_menu_active']."' and projectSite !=''";
$res_active = mysql_query($que_active);
$cnt_active = mysql_num_rows($res_active);

$activeMainYn = $cnt_active > 0 ? "active" : "";
$activeSubYn = $cnt_active > 0 ? "active" : "collapsed";
$activeShow = $cnt_active > 0 ? "show" : "";
?>

<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link  <?=$activeSubYn?>" href="<?=$rootPath?>#" data-toggle="collapse" data-target="#collapsePro"
        aria-expanded="true" aria-controls="collapsePro">
        <i class="fas fa-clipboard-list"></i>
        <span>Project List</span>
    </a>
    <div id="collapsePro" class="collapse <?=$activeShow?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
        <?
            $que = "select * from projectList where doneDate <= '".date('Y-m-d')."' order by seq desc";
            $res = mysql_query($que);
            while($row = mysql_fetch_array($res)){
        ?>
                <a class="collapse-item <?=$_SESSION['left_menu_active'] == $row['projectSite'] ? "active":""?>" href="<?=$rootPath?><?=$row['projectPath']?>/<?=$row['projectSite']?>.php"><?if($row['projectIcon'] !=""){?><i class="<?=$row['projectIcon']?>"></i> <?}?><?=$row['projectName']?></i></a>
        <?
            }
        ?>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<!-- Nav Item - Pages Collapse Menu -->
<?
$liArray1 = array("buttons","cards");
$activeMainYn = in_array($_SESSION['left_menu_active'],$liArray1) ? "active" :""; // 메인명 굵게 표시
$activeSubYn = in_array($_SESSION['left_menu_active'],$liArray1) ? "active" :"collapsed"; // 메인명 화살표 하단으로 변경
$activeShow = in_array($_SESSION['left_menu_active'],$liArray1) ? "show" : ""; // 하위리스트 보여주기
?>
<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link <?=$activeSubYn?>" href="<?=$rootPath?>#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse <?=$activeShow?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "buttons" ? "active":""?>" href="<?=$rootPath?>buttons.php">Buttons</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "cards" ? "active":""?>" href="<?=$rootPath?>cards.php">Cards</a>
        </div>
    </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<?
$liArray2 = array("utilities-color","utilities-border","utilities-animation","utilities-other");
$activeMainYn = in_array($_SESSION['left_menu_active'],$liArray2) ? "active" :""; // 메인명 굵게 표시
$activeSubYn = in_array($_SESSION['left_menu_active'],$liArray2) ? "active" :"collapsed"; // 메인명 화살표 하단으로 변경
$activeShow = in_array($_SESSION['left_menu_active'],$liArray2) ? "show" : ""; // 하위리스트 보여주기
?>
<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link  <?=$activeSubYn?>" href="<?=$rootPath?>#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse <?=$activeShow?>" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "utilities-color" ? "active":""?>" href="<?=$rootPath?>utilities-color.php">Colors</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "utilities-border" ? "active":""?>" href="<?=$rootPath?>utilities-border.php">Borders</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "utilities-animation" ? "active":""?>" href="<?=$rootPath?>utilities-animation.php">Animations</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "utilities-other" ? "active":""?>" href="<?=$rootPath?>utilities-other.php">Other</a>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Addons
</div>

<!-- Nav Item - Pages Collapse Menu -->
<?
$liArray3 = array("login","register","forgot-password","404","blank");
$activeMainYn = in_array($_SESSION['left_menu_active'],$liArray3) ? "active" :""; // 메인명 굵게 표시
$activeSubYn = in_array($_SESSION['left_menu_active'],$liArray3) ? "active" :"collapsed"; // 메인명 화살표 하단으로 변경
$activeShow = in_array($_SESSION['left_menu_active'],$liArray3) ? "show" : ""; // 하위리스트 보여주기
?>
<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link <?=$activeSubYn?>" href="<?=$rootPath?>#" data-toggle="collapse" data-target="#collapsePages"
        aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse <?=$activeShow?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "login" ? "active":""?>" href="<?=$rootPath?>login.php">Login</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "register" ? "active":""?>" href="<?=$rootPath?>register.php">Register</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "forgot-password" ? "active":""?>" href="<?=$rootPath?>forgot-password.php">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "404" ? "active":""?>" href="<?=$rootPath?>404.php">404 Page</a>
            <a class="collapse-item <?=$_SESSION['left_menu_active'] == "blank" ? "active":""?>" href="<?=$rootPath?>blank.php">Blank Page</a>
        </div>
    </div>
</li>

<!-- Nav Item - Charts -->
<?
$liArray4 = array("charts");
$activeMainYn = in_array($_SESSION['left_menu_active'],$liArray4) ? "active" :""; // 메인명 굵게 표시
$activeSubYn = in_array($_SESSION['left_menu_active'],$liArray4) ? "active" :"collapsed"; // 메인명 화살표 하단으로 변경
$activeShow = in_array($_SESSION['left_menu_active'],$liArray4) ? "show" : ""; // 하위리스트 보여주기
?>
<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link" href="<?=$rootPath?>charts.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Charts</span></a>
</li>

<!-- Nav Item - Tables -->
<?
$liArray5 = array("tables");
$activeMainYn = in_array($_SESSION['left_menu_active'],$liArray5) ? "active" :""; // 메인명 굵게 표시
$activeSubYn = in_array($_SESSION['left_menu_active'],$liArray5) ? "active" :"collapsed"; // 메인명 화살표 하단으로 변경
$activeShow = in_array($_SESSION['left_menu_active'],$liArray5) ? "show" : ""; // 하위리스트 보여주기
?>
<li class="nav-item <?=$activeMainYn?>">
    <a class="nav-link" href="<?=$rootPath?>tables.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->

</ul>