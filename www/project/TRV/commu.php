<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy tx-17 pt-3" id="tripArea">소통창고</td>
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
                        <td>소통창고 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">작성자</td>
                        <td class="w-10">조회수</td>
                    </tr>
                </thead>
                <tbody>
                <tbody>
                    <?
                    $where="";
                    if(@$_REQUEST['searchBar'] != ""){
                        $where = " where writeTitle like '%".$_REQUEST['searchBar']."%' ";
                    }
                    $que_commu = "select * from TcommuniTbl $where order by writeDateTime desc";

                    $res_commu = mysql_query($que_commu);
                    $cnt_commu = mysql_num_rows($res_commu);
                    $i = 1;
                    while($row_commu = mysql_fetch_array($res_commu)){
                    ?>
                    <tr class="c-pointer" onclick="location.href='commuView.php?seq=<?=$row_commu['seq']?>'">
                        <td class="text-center"><?=$i?></td>
                        <td><?=$row_commu['writeTitle']?></td>
                        <td class="text-center noWrap"><?=$row_commu['writeDateTime']?></td>
                        <td class="text-center"><?=getName($row_commu['joinSeq'])?></td>
                        <td class="text-center"><?=$row_commu['viewCnt']?></td>
                    </tr>
                    <?
                    $i++;
                    }
                    if($cnt_commu == 0){ ?>
                        <tr>
                            <td class="text-center" colspan="5">등록된 내용이 없습니다.</td>
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
    $(document).on("click","#search",function(){
        if($("#searchBar").val() == ""){
            pAlert("error","오류","검색어를 입력하세요.",true);
        }else{
            location.href='commu.php?searchBar='+$("#searchBar").val();
        }
    });

    $(document).on("click","#searchClear",function(){
        location.href='commu.php';
    });
</script>