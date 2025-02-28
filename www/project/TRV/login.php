<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="611069435508-9qc4jsebjvbqg1s0v23lvinfj4ae97dr.apps.googleusercontent.com">


<div class="loginBox h-90">
    <table class="noBorder text-center w-40">
        <!-- <tr height="50px"><td id="trvNavyLogo"></td></tr>
        <tr height="90px"><td></td></tr> -->
        <tr><td id="loginLogo"></td></tr>
        
        <tr>
            <td id="loginBack" class="text-center">
                <input type="email" class="loginInput mb-4 t-navy noBorder" id="loginId" placeholder="아이디" onkeypress="loginOk(event)">
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
                <input type="button" class="btn t-navy g-signin2" value="google" data-onsuccess="onSignIn">
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
                    if(data == "success" || data == "manager"){
                        location.href = "trvmain2.php";
                    }else if(data == "fail_1"){
                        alert("이메일 인증후 사용가능합니다.");
                    }else{
                        alert("아이디 또는 비밀번호가 일치하지 않습니다.");
                        $("#loginId").val("")
                        $("#loginPW").val("")
                    }
                }
            });
        }
    }
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
        }
</script>