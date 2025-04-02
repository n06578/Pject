<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";

?>
<div class="main-box container-fluid h-90">
    <div class="contents-col col pt-2 text-lg h-100" id="mainCardDiv">
        <table class="table noTable">
            <tr>
                <td class="w-15 text-blg text-right t-navy tx-17 pt-3" id="tripArea">문의사항</td>
                <td class=""><input type="text" class="form-control noBorder mr-4" id="searchBar" placeholder="제목을 검색하세요." value="<?=@$_REQUEST['searchBar']?>"></td>
                <td class="w-10"><input type="button" class="btn btn-navy w-100 mr-4 text-blg t-white" id="search" value="검색"></td>
                <?if(@$_REQUEST['searchBar'] != ""){?>
                    <td class="w-10"><input type="button" class="btn btn-warning w-100 mr-4 text-blg t-white" id="searchClear" value="초기화"></td>
                <?}?>
            </tr>
        </table>
        <hr class="hr-navy">
        <div class="card mx-5">
            <?
            $checked = "";
            $where = "";
            if(@$_REQUEST['searchBar'] != ""){
                $where = " where a.writeTitle like '%".$_REQUEST['searchBar']."%' ";
            }
            if($login == "yes"){
                if(@$_REQUEST['ansOk'] == "on"){
                    $checked = "checked";
                    $where =" , a.joinSeq = '".$_SESSION['loginNum']."' ";
                }
            ?>
            <form id="sForm">
                <div class="text-right">
                    <input type="checkbox" id="ansOk" name="ansOk" <?=$checked?>><label for="myUpload" class="txt-8 px-1">답변 미등록</label>
                </div>
            </form>
            <?}?>
            <table class="table table-border table-hover tx-13">
                <thead>
                    <tr class="text-center">
                        <td class="w-5">No.</td>
                        <td>공지사항 제목</td>
                        <td class="w-15">등록일시</td>
                        <td class="w-15">작성자</td>
                    </tr>
                </thead>
                <tbody>
                    <?
                    $que_mone = "select a.*,b.nickName from TmoneTbl a 
                                    left join TjoinTbl b on a.joinSeq = b.seq
                                    left join TmoneAnswerTbl c on a.seq = c.moneSeq
                                    where ifnull(c.seq,0) = 0 $where order by writeDateTime desc";
                    $res_mone = mysql_query($que_mone);
                    $cnt_mone = mysql_num_rows($res_mone);
                    $i = 1;
                    while($row_mone = mysql_fetch_array($res_mone)){
                    ?>
                    <tr class="c-pointer" onclick="location.href='manageMoneWrite.php?seq=<?=$row_mone['seq']?>'">
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
    $(document).on("change","#myUpload",function(){
        $("#sForm").submit();
    })

    $(document).on("click","#search",function(){
        if($("#searchBar").val() == ""){
            pAlert("error","오류","검색어를 입력하세요.",true);
        }else{
            location.href='monE.php?searchBar='+$("#searchBar").val();
        }
    });
    
    $(document).on("click","#searchClear",function(){
        location.href='monE.php';
    });

    $(document).on("click","#monePwBtn",function(){
        if($("#monePWInput").val() == ""){
            pAlert("error","오류","비밀번호를 입력하세요.",true);
        }else{
            $.ajax({
                url: "ajax/trv_monE_pass.php",
                type: "POST",
                data: {
                    seq : $("#mSeq").val(),
                    monePWInput: $("#monePWInput").val()
                },
                success: function(data){
                    if(data > 0){location.href='moneView.php?seq='+$("#mSeq").val()}
                    else{
                        $("#monePWModal").modal("hide");
                        pAlert("error","실패","비밀번호가 틀렸습니다.",true);
                    }
                }
            });
        }
    });

    function loginChk(seq,writer){
        if("<?=$login?>" == "no"){
            $("#mSeq").val(seq);
            $("#monePWInput").val("");
            $("#monePWModal").modal("show");
        }else{
            if(writer == '<?=$_SESSION['loginNum']?>'){
                pAlert("error","경고","작성자만 열람가능합니다.",true);
            }else{
                location.href='moneView.php?seq='+seq;
            }
        }
    }
</script>