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
        <span>자기소개</span></a>
</li>


<!-- 개인 프로젝트 정리 중 -->

<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
    MyProject
</div>

<!-- Nav Item - Pages Collapse Menu -->
<?
// collapsed active
$que_active = "select * from projectList where doneDate <= '".date('Y-m-d')."' and projectSite = '".$_SESSION['left_menu_active']."' and projectSite !=''";
$res_active = mysql_query($que_active);
$cnt_active = mysql_num_rows($res_active);

$activeMainYn = $cnt_active > 0 ? "active" : "";
$activeSubYn = $cnt_active > 0 ? "active" : "collapsed";
$activeShow = $cnt_active > 0 ? "show" : "";
?>

<li class="nav-item active">
    <a class="nav-link  active" href="<?=$rootPath?>#" data-toggle="collapse" data-target="#collapsePro"
        aria-expanded="true" aria-controls="collapsePro">
        <i class="fas fa-clipboard-list"></i>
        <span>Project List</span>
    </a>
    <div id="collapsePro" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">younAh project:</h6>
        <?
            $que = "select * from projectList where doneDate <= '".date('Y-m-d')."' order by seq desc";
            $res = mysql_query($que);
            while($row = mysql_fetch_array($res)){
                $target = "";
                if($row['projectRole'] == "웹프로젝트"){$target = "target='_blank'";}
        ?>
                <a class="collapse-item <?=$_SESSION['left_menu_active'] == $row['projectSite'] ? "active":""?>" <?=$target?> href="<?=$rootPath?><?=$row['projectPath']?>/<?=$row['projectSite']?>.php"><?if($row['projectIcon'] !=""){?><i class="<?=$row['projectIcon']?>"></i> <?}?><?=$row['projectName']?></i></a><!--$row['projectRole']-->
        <?
            }
        ?>
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->

</ul>