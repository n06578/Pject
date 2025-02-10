<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy txt-17 pt-3" id="tripArea">문의사항</td>
                <td class="w-75"><input type="text" class="form-control noBorder mr-4"></td>
                <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="검색"></td>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5">
            <table class="table table-border table-hover">
                <thead>
                    <tr class="text-center">
                        <td class="w-10">No.</td>
                        <td>공지사항 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">작성자</td>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $que_mone = "select a.*,b.nickName from TmoneTbl a left join TjoinTbl b on a.joinSeq = b.seq order by writeDateTime desc";
                    $res_mone = mysql_query($que_mone);
                    $cnt_mone = mysql_num_rows($res_mone);
                    $i = 1;
                    while($row_mone = mysql_fetch_array($res_mone)){
                    ?>
                    <tr class="c-pointer" onclick="location.href='moneView.php?seq=<?=$row_mone['seq']?>'">
                        <td class="text-center"><?=$i?></td>
                        <td><?=$row_mone['writeTitle']?></td>
                        <td class="text-center noWrap"><?=$row_mone['writeDateTime']?></td>
                        <td class="text-center"><?=$row_mone['nickName']?></td>
                    </tr>
                    <?
                    $i++;
                    }
                    if($cnt_mone == 0){ ?>
                        <tr>
                            <td class="text-center" colspan="4">등록된 문의가 없습니다.</td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?
if($_SESSION['loginNum'] != '-' && $_SESSION['loginYn'] == "Y"){?>
    <div class="text-center" id="writeBtn" onclick="location.href='monEWrite.php'"><i class="fas fa-pen"></i> 작성하기</div>
<?}?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
</script>