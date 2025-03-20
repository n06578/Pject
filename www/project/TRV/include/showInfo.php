<?php

if(@$_REQUEST['dbType']=="add"){
    session_start();
    require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
}
$que_home = "select * from TjoinTbl where seq = '".$_SESSION['goUserNum']."'";
$res_home = mysql_query($que_home);
$row_home = mysql_fetch_array($res_home);

$que_self= "select * from TselfInfoTbl where joinSeq = '".$_SESSION['loginNum']."'";
$res_self = mysql_query($que_self);
$row_self = mysql_fetch_array($res_self);
$num_self = mysql_num_rows($res_self);
if($num_self > 0){
    $inTrvCnt=$row_self['inTrvCnt'];
    $outTrvCnt=$row_self['outTrvCnt'];
    $selfPresent=$row_self['selfPresent'];
}else{
    $inTrvCnt=0;
    $outTrvCnt=0;
    $selfPresent="";
}

if(@$_REQUEST['showType']=="edit"){
?>
    <form id="infoFrm">
        <input type="hidden" name="joinSeq" value="<?=$_SESSION['loginNum']?>">
        <input type="hidden" name="seq" value = "<?=@$row_self['seq']?>">
        <table class="table noTable tx-14">
            <tr>
                <td class="w-30" rowspan="5">
                    <div class="card ">
                        <div class="card-body listItem p-2">
                            <div class="profileBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                                <img class="listItemImg" src="../../img/trv/listItem/item1.jpg">
                                
                                <div class="itemBigView text-right txt-7 d-none">
                                    크게보기
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="w-30 d-table-cell">
                    <span class="fw-800">닉네임</span>
                    <input type="text" name="nickName" class="form-control" id="nickName" value="<?=$row_home['nickName']?>">
                </td>
                <td class="w-35 text-left d-table-cell">
                    <span class="fw-800">국내여행횟수</span>
                    <span><input type="number" class="form-control" name="inTrvCnt" value="<?=$inTrvCnt?>"></span>
                </td>
                <td class="w-35 text-left pl-4 d-table-cell">
                    <span class="fw-800">국외여행횟수</span>
                    <span><input type="number" class="form-control" name="outTrvCnt" value="<?=$outTrvCnt?>"></span>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="fw-800">
                    한줄소개
                    <input type="text" class="form-control" name="selfPresent" value="<?=$selfPresent?>">
                </td>
            </tr>
            <tr>
                <td colspan="3" class="fw-800">추구하는 여행 스타일</td>
            </tr>
            <?
            if($_SESSION['goUserNum'] == $_SESSION['loginNum']) {
            ?>
            <tr>
                <td colspan="3" class="text-right">
                    <a href="#" class="btn btn-sm btn-warning" id="infoReload">
                        <span class="text">변경내용 초기화</span>
                    </a>
                    <a href="#" class="btn btn-sm btn-success" id="infoSave">
                        <span class="text">저장</span>
                    </a>
                </td>
            </tr>
            <?}?>
        </table>
    </form>
    
<?}else{?>
    <table class="table noTable tx-14">
        <tr>
            <td class="w-30" rowspan="5">
                <div class="card ">
                    <div class="card-body listItem p-2">
                        <div class="profileBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                            <img class="listItemImg" src="../../img/trv/listItem/item1.jpg">
                            
                            <div class="itemBigView text-right txt-7 d-none">
                                크게보기
                            </div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="fw-800 tx-18 w-30"><?=$row_home['nickName']?></td>
            <td class="w-35 text-right">
                <span class="fw-800">국내여행횟수 : </span>
                <span><?=$inTrvCnt?></span>
            </td>
            <td class="w-35 text-left pl-4">
                <span class="fw-800">국외여행횟수 : </span>
                <span><?=$outTrvCnt?></span>
            </td>
        </tr>
        <tr>
            <td colspan="3">
                <text class="fw-800">한줄소개</text>
                <p class="p-1"><?=$selfPresent?></p>
                
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3" class="fw-800">추구하는 여행 스타일</td>
        </tr>
        <?
        if($_SESSION['goUserNum'] == $_SESSION['loginNum']) {
        ?>
        <tr>
            <td colspan="3" class="text-right">
                <input type="button" class="btn btn-sm btn-white" id="changInfo" value="변경">
            </td>
        </tr>
        <?}?>
    </table>
<?}?>