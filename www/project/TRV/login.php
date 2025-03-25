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
                <input type="button" class="btn t-navy" id="searchPass" value="비밀번호 찾기">
            </td>
        </tr>
        <tr height="50px">
            <td>
                <!-- <input type="button" class="btn t-navy g-signin2" value="google" data-onsuccess="onSignIn"> -->
                
                <button type="button" class="btn t-navy" id="kakaoBtn"><i class="fab fa-kickstarter-k"></i> kakaO</button>
                <!-- <input type="button" class="btn t-navy" value="naver"> -->
            </td>
        </tr>
    </table>
</div>
<!-- /.container-fluid -->
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>

<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    window.Kakao.init("c37359dcd8b254cf080cb84e7c99e927");
    // 로그인된 토큰 초기화
    // Kakao.API.request({
    //     url: "/v1/user/unlink",
    //     success: function(response) {
    //         console.log("카카오 계정 연결 해제 완료", response);
    //     },
    //     fail: function(error) {
    //         console.error("연결 해제 실패", error);
    //     }
    // });


    $("#loginBtn").click(function(){
        loginOk("click");
    });

    function loginOk(type){
        if(window.event.keyCode == 13 || type == "click"){
            var id = $("#loginId").val();
            var pw = $("#loginPW").val();
            if(id == ""){
                pAlert("error","실패","아이디를 입력해주세요.",true);
                $("#loginId").focus();
                return;
            }
            if(pw == ""){
                pAlert("error","실패","비밀번호를 입력해주세요.",true);
                $("#loginPW").focus();
                return;
            }
            $.ajax({
                url: "ajax/trv_login_ok.php",
                type: "POST",
                data: {
                    id: id,
                    pw: pw,
                    type: "login"
                },
                success: function(data){
                    if(data == "success" || data == "manager"){
                        location.href = "trvmain2.php";
                    }else if(data == "fail_1"){
                        pAlert("error","실패","이메일 인증후 사용가능합니다.",true);
                    }else{
                        pAlert("error","실패","아이디 또는 비밀번호가 일치하지 않습니다.",true);
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

    $(document).on("click","#searchPass",function(){
        var width=500;
        var height=300;
        
        var posx = (screen.width - width)/2-1;
        var posy = (screen.height - height)/2-1;
        
        url = "popup/searchPass.php";
        newwin = window.open(url,"setting","width="+width+",height="+height+",toolbar=0,scrollbars=1,resizable=0,status=0");
        newwin.moveTo(posx,posy);
        newwin.focus();
    });

    $(document).on("click","#kakaoBtn",function(){
        kakaoLogin()
    });
    function kakaoLogin(){
        window.Kakao.Auth.login({
            scope:'profile_nickname, account_email',
            success:function(authObj){
                console.log(authObj);
                window.Kakao.API.request({
                    url:"/v2/user/me",
                    success:res=>{
                        const kakao_account = res.kakao_account;
                        console.log(kakao_account);
                        $.ajax({
                            url: "ajax/ajax_kakao_chk.php",
                            type: "POST",
                            data: kakao_account,
                            success: function(data){
                               console.log(data);
                                if(data == "noJoin"){
                                    // console.log(kakao_account.email,kakao_account.profile.nickname)
                                    let form = document.createElement("form");
                                    form.method = "POST";
                                    form.action = "join.php";
                                    let input = document.createElement("input");
                                    input.type = "hidden";
                                    input.name = "userName";
                                    input.value = kakao_account.profile.nickname;
                                    let input2 = document.createElement("input");
                                    input2.name = "userEmail";
                                    input2.value = kakao_account.email;
                                    form.appendChild(input);
                                    form.appendChild(input2);
                                    document.body.appendChild(form);
                                    form.submit();
                                }else{
                                    $.ajax({
                                        url: "ajax/trv_login_ok.php",
                                        type: "POST",
                                        data: {
                                            id: kakao_account.email,
                                            pw: data,
                                            type: "kakao"
                                        },
                                        success: function(data){
                                            if(data == "success" || data == "manager"){
                                                location.href = "trvmain2.php";
                                            }else if(data == "fail_1"){
                                                pAlert("error","실패","이메일 인증후 사용가능합니다.",true);
                                            }else{
                                                pAlert("error","실패","아이디 또는 비밀번호가 일치하지 않습니다.",true);
                                                $("#loginId").val("")
                                                $("#loginPW").val("")
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    }
                })

            }
        })
    }
</script>