<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<div class="loginBox h-90">
    <table class="noBorder text-center w-40">
        <!-- <tr height="50px"><td id="trvNavyLogo"></td></tr>
        <tr height="90px"><td></td></tr> -->
        <tr><td id="joinLogo"></td></tr>
        <tr>
            <td id="joinBack" class="text-center">
                <input type="text" class="loginInput mb-4 t-navy noBorder" id="loginId" placeholder="아이디">
                <input type="password" class="loginInput mb-4 t-navy noBorder" id="loginPW" placeholder="비밀번호">
                <input type="password" class="loginInput mb-4 t-navy noBorder" id="loginPW" placeholder="비밀번호확인">
                <input type="text" class="loginInput mb-4 t-navy noBorder" id="loginPW" placeholder="연락처">
                <input type="text" class="loginInput mb-4 t-navy noBorder" id="loginPW" placeholder="주소">
                <input type="text" class="loginInput mb-4 t-navy noBorder" id="loginPW" placeholder="상세주소">
                <br>
                <input type="checkbox" id="agreeChk" class="mr-2 mb-2"><label for="agreeChk">동의합니다.</label>
            </td>
        </tr>
        <tr height="50px">
            <td><input type="button" class="btn btn-navy t-white" id="loginBtn" value="로그인"></td>
        </tr>
        <tr height="30px"><td></td></tr>
        <tr height="50px">
            <td>
                아이디가 존재합니까?
                <input type="button" class="btn t-navy" value="로그인" onclick="location.href='login.php'">
            </td>
        </tr>
    </table>
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>