<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";

$que = " select * from TjoinTbl where seq = '".$_REQUEST['seq']."'";
$res = mysql_query($que);
$row = mysql_fetch_array($res);

if($row['userPassWord'] !="990903userPassWordChangeChk"){?>
    <script>
        location.href = "api/mailChk.php?hash=&sendMode=passFindChk&seq=<?=$_REQUEST['seq']?>";
    </script>
<?}?>

<div class="container-fluid h-95">
    <form id="changePassFrm">
        <div class="contents-col col joinBox py-5 mt-5">
            <div class="row j-c w-100 my-4" id="trvLogo"></div>
            <div class="row j-c w-100 pt-5 mb-4">
                <div class="joinTbl py-3 px-5">
                    <input type="hidden" name="seq" value="<?=$_REQUEST['seq']?>">
                    <div class="joinDiv"><i class="fas fa-user"></i><input type="text" class="joinInput mb-4 t-navy readonly noBorder" name="userName" id="userName" readonly value="<?=$row['userName']?>"></div>
                    <div class="joinDiv"><i class="fas fa-envelope"></i><input type="text" class="joinInput mb-4 t-navy readonly noBorder" name="userEmail" id="userEmail" readonly value="<?=$row['userId']?>"></div>
                    <div class="joinDiv"><i class="fas fa-unlock"></i><input type="password" class="joinInput t-navy noBorder" name="userPassWord"  id="loginPW" placeholder="비밀번호" onkeypress="loginOk(event)"></div>
                    <div class="joinDiv text-center mt-5"><input type="button" class="btn btn-navy t-white w-100" id="changeBtn" value="변경"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>
    $(document).on("input","#loginPW",function(){
        var user_pass = $("#loginPW").val();

        var num = user_pass.search(/[0-9]/g); // 숫자
        var eng = user_pass.search(/[a-zA-Z]/ig); // 영문 대소문자
        var spe = user_pass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi); // 특수문자

        if ((user_pass).length < 8 || num < 0 || eng < 0 || spe < 0 ) {
            $(this).addClass("t-red")
            $(this).removeClass("t-navy")
        }else{
            $(this).removeClass("t-red")
            $(this).addClass("t-navy")
        }
    })
    $(document).on("click","#changeBtn",function(){
        if($("#loginPW").hasClass("t-red") || $("#loginPW").val()==""){
            pAlert("error","가입실패","비밀번호는 8~16자의 영문 대/소문자, 숫자, 특수문자가 포함되어야합니다.",true);
            $("#loginPW").focus();
            return false;
        }
        $("#changePassFrm").ajaxSubmit({
            url: 'ajax/ajax_change_pass.php',
            type: 'post',
            success : function(val){
                console.log(val);
                if(val == "changeDone"){
                    pAlert("success","변경 성공","비밀번호가 변경되었습니다.",true);
                    location.href="login.php"
                }
            }
        });
    })
</script>