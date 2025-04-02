<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy tx-17 pt-3" id="tripArea">공지사항</td>
                <td class="w-75"><input type="text" class="form-control noBorder mr-4" id="searchBar" placeholder="제목을 검색하세요." value="<?=@$_REQUEST['searchBar']?>"></td>
                <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="검색"></td>
                <?if(@$_REQUEST['searchBar'] != ""){?>
                    <td class="w-10"><input type="button" class="btn btn-warning w-100 mr-4 text-blg t-white" id="searchClear" value="초기화"></td>
                <?}?>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5">
            <table class="table table-border table-hover tx-13">
                <thead>
                    <tr class="text-center">
                        <td class="w-10">No.</td>
                        <td>공지사항 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">조회수</td>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $where ="";
                    if(@$_REQUEST['searchBar'] != ""){
                        $where = " where writeTitle like '%".$_REQUEST['searchBar']."%' ";
                    }
                    $que_gongji = "select * from TgongjiTbl $where order by writeDateTime desc";
                    $res_gongji = mysql_query($que_gongji);
                    $cnt_gongji = mysql_num_rows($res_gongji);
                    $i = 1;
                    while($row_gongji = mysql_fetch_array($res_gongji)){
                    ?>
                    <tr class="c-pointer" onclick="location.href='gongjiView.php?seq=<?=$row_gongji['seq']?>'">
                        <td class="text-center"><?=$i?></td>
                        <td><?=$row_gongji['writeTitle']?></td>
                        <td class="text-center noWrap"><?=$row_gongji['writeDateTime']?></td>
                        <td class="text-center"><?=$row_gongji['viewCnt']?></td>
                    </tr>
                    <?
                    $i++;
                    }
                    if($cnt_gongji == 0){ ?>
                        <tr>
                            <td class="text-center" colspan="4">등록된 공지가 없습니다.</td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?if($_SESSION['loginYn'] == "Y" && $_SESSION['loginNum'] == "0"){?>
    <div class="text-center" id="writeBtn" onclick="location.href='gongJiWrite.php'"><i class="fas fa-pen"></i> 작성하기</div>
<?}?>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    
    $(document).on("click","#search",function(){
        if($("#searchBar").val() == ""){
            pAlert("error","오류","검색어를 입력하세요.",true);
        }else{
            location.href='gongji.php?searchBar='+$("#searchBar").val();
        }
    });

    $(document).on("click","#searchClear",function(){
        location.href='gongji.php';
    });

</script>