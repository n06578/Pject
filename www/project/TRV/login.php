<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<div class="loginBox h-90">
    <table class="noBorder text-center w-40">
        <!-- <tr height="50px"><td id="trvNavyLogo"></td></tr>
        <tr height="90px"><td></td></tr> -->
        <tr><td id="loginLogo"></td></tr>
        
        <tr>
            <td id="loginBack" class="text-center">
                <input type="text" class="loginInput mb-4 t-navy noBorder" id="loginId" placeholder="아이디" onkeypress="loginOk(event)">
                <br>
                <input type="password" class="loginInput t-navy noBorder" id="loginPW" placeholder="비밀번호" onkeypress="loginOk(event)">
            </td>
        </tr>
        <tr height="50px">
            <td><input type="button" class="btn btn-navy t-white" id="loginBtn" value="로그인"></td>
        </tr>
        <tr height="30px"><td></td></tr>
        <tr height="50px">
            <td>
                <input type="button" class="btn t-navy" value="회원가입" onclick="location.href='join.php'">
                <input type="button" class="btn t-navy" value="아이디 찾기">
                <input type="button" class="btn t-navy" value="비밀번호 찾기">
            </td>
        </tr>
        <tr height="50px">
            <td>
                <input type="button" class="btn t-navy" value="google">
                <input type="button" class="btn t-navy" value="kakaO">
                <input type="button" class="btn t-navy" value="naver">
            </td>
        </tr>
    </table>
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    $("#loginBtn").click(function(){
        loginOk("click");
    });

    function loginOk(type){
        if(window.event.keyCode == 13 || type == "click"){
            var id = $("#loginId").val();
            var pw = $("#loginPW").val();
            if(id == ""){
                alert("아이디를 입력해주세요.");
                return;
            }
            if(pw == ""){
                alert("비밀번호를 입력해주세요.");
                return;
            }
            $.ajax({
                url: "ajax/trv_login_ok.php",
                type: "POST",
                data: {
                    id: id,
                    pw: pw
                },
                success: function(data){
                    if(data == "success"){
                        location.href = "trvmain2.php";
                    }else{
                        alert("아이디 또는 비밀번호가 일치하지 않습니다.");
                        $("#loginId").val("")
                        $("#loginPW").val("")
                    }
                }
            });
        }
    }
</script>