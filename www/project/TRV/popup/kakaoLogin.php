<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<a href="javascript:kakaoLogin()">카카오로 로그인</a>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<!-- c37359dcd8b254cf080cb84e7c99e927 -->
 <script>
    $(function(){
        kakaoLogin();
    })
    window.Kakao.init("c37359dcd8b254cf080cb84e7c99e927");
    function kakaoLogin(){
        window.Kakao.Auth.login({
            scope:'profile_nickname, account_email',
            success:function(authObj){
                console.log(authObj);
                window.Kakao.API.request({
                    url:'/V2/user/me',
                    success:res=>{
                        const kakao_account = res.kakao_account;
                        console.log(kakao_account);
                    }
                })

            }
        })
    }
 </script>