<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<div class="loginBox h-90">
    
    <table class="noBorder text-center w-40">
        <tr>
            <td colspan=2 class="text-left tx-14 pb-2"><div class="row j-c w-100 my-1" id="trvLogoPopUp"></div></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="text" class="form-control tx-12" id="userName" name="userName" placeholder="성명"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="text" class="form-control tx-12" id="userEmail" name="userEmail" placeholder="이메일"></td>
        </tr>
        <tr>
            <td colspan=2>
                <input type="button" class="btn btn-sm btn-navy w-100" id="passSearch" value="찾기">
            </td>
        </tr>
    </table>
</div>

<script>
    $(document).on("click","#passSearch",function(){
        if($("#userName").val() == ""){
            pAlert("error","실패","성명을 입력해주세요.",true);
            $("#userName").focus();
            return false;
        }
        if($("#userEmail").val() == ""){
            pAlert("error","실패","이메일을 입력해주세요.",true);
            $("#userEmail").focus();
            return false;
        }
        $.ajax({
            type: "GET",
            url: "../ajax/ajax_search_pass.php", // 데이터를 가져올 서버 URL
            data: "userName="+$("#userName").val()+"&userEmail="+$("#userEmail").val(),
            success: function(data) {
                if(data == "error1"){ pAlert("error","실패","해당 정보가 없습니다.",true); }
                else{ pAlert("error","성공","이메일을 확인해주세요.",true); }
            }
        });
    })
</script>