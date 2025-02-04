<?
// mail을 통해 접근하는 페이지 
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/function.php';

include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";


$que = "select * from TjoinTbl where seq = '".$_REQUEST['seq']."' and joinAgreeChk = 0";
$res = mysql_query($que);
$row = mysql_fetch_array($res);
$cnt = mysql_num_rows($res);

$action = $cnt>0? "yes" : "no";
if($action == "yes"){
    $que_ok = " update TjoinTbl set joinAgreeChk=1 where seq = '".$_REQUEST['seq']."'";
    mysql_query($que_ok);
}
?>
<style>
    #content{
        background-image: url('../../../img/trv/trvBackgroundNoWord.PNG') !important;
        width: 100vw;
        height: 100vh;
        background-size: cover; /* 이미지를 화면에 맞게 조절 */
        background-position: center; /* 이미지를 중앙에 위치 */
        background-repeat: no-repeat; 
        position: fixed;
        opacity: 0.6;
    }
    .main-container{
        width: 100vw;
        height: 100vh;
    }
    #btn-login{
        background-color: #7770a6;
    }
    hr{
        color:#7770a6b2;
        margin : 0px 20px;
    }
    #contents{
        color:rgb(11 4 53 / 74%);
    }
    .card{
        border: 1px solid #b2b2b2
    }
    
</style>
</div>
<div class="main-container container-fluid mt-5 pt-5 p-5" >
    <div class="row justify-content-center">
        <div class="col-md-12 w-50">
            <div class="card custom-card " >
                <div class="card-body p-0">
                        <img src='http://34.231.136.110/img/trv/TRV.PNG' style='width:125px; margin:15px;'>
                        <hr>
                        <div class="tab-content text-center m-5 p-5">
                            <h2 class="fw-bolder" id="contentsTitle">
                            </h2>
                            <h4 class="mt-4" id="contents">
                            </h4>
                        </div>
                        <div class="float-end mr-3 mb-2">
                            <?if($action == "yes"){?>
                                <button class="btn btn-navy t-white" id="btn-login" onclick="location.href='/project/TRV/login.php'"><i class="fa fa-check"></i> 로그인</button>
                            <?}else{?>
                                문의센터 : 1999-0903
                            <?}?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?    
if($action == "no"){
    $title = "유효하지 않은 접근입니다.";
    $sub_title = "관리자에게 문의해주세요.";
}else{
    $title = "이메일 인증이 완료되었습니다.";
    $sub_title = $row['userName']."님 환영합니다.";
    $url = "/project/TRV/login.php";
}

if($title !="" || $sub_title != ""){ 
?>
    <script>
        $('#contentsTitle').html('<?=$title?>');
        $('#contents').html('<?=$sub_title?>');
    </script>
<?
}
?>