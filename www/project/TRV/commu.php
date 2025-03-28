<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy tx-17 pt-3" id="tripArea">소통창고</td>
                <td><input type="text" class="form-control noBorder mr-4"></td>
                <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="검색"></td>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5">
            <table class="table table-border table-hover tx-13">
                <thead>
                    <tr class="text-center">
                        <td class="w-10">No.</td>
                        <td>소통창고 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">작성자</td>
                        <td class="w-10">조회수</td>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?
                    // $que_gongji = "select * from TcommuniTbl order by writeDateTime desc";
                    $que_gongji = "select a.*,b.nickName from TcommuniTbl a left join TjoinTbl b on a.joinSeq = b.seq order by writeDateTime desc";

                    $res_gongji = mysql_query($que_gongji);
                    $cnt_gongji = mysql_num_rows($res_gongji);
                    $i = 1;
                    while($row_gongji = mysql_fetch_array($res_gongji)){
                    ?>
                    <tr class="c-pointer" onclick="location.href='commuView.php?seq=<?=$row_gongji['seq']?>'">
                        <td class="text-center"><?=$i?></td>
                        <td><?=$row_gongji['writeTitle']?></td>
                        <td class="text-center noWrap"><?=$row_gongji['writeDateTime']?></td>
                        <td class="text-center"><?=$row_gongji['nickName']?></td>
                        <td class="text-center"><?=$row_gongji['viewCnt']?></td>
                    </tr>
                    <?
                    $i++;
                    }
                    if($cnt_gongji == 0){ ?>
                        <tr>
                            <td class="text-center" colspan="4">등록된 내용이 없습니다.</td>
                        </tr>
                    <? } ?>
                </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?if($_SESSION['loginNum'] != '-' && $_SESSION['loginYn'] == "Y"){?>
<div class="text-center" id="writeBtn" onclick="location.href='commuWrite.php'"><i class="fas fa-pen"></i> 작성하기</div>
<?}?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
</script>