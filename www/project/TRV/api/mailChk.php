<?
// mail을 통해 접근하는 페이지 
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/function.php';

include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>

<script src="/rams/_assets/js/mail_page.js?v=<?=time();?>"></script>

<?
/** switch($mode)
 *  mainUser : 사업장 관리자 회원등록 페이지
 *  subUser : 사업장의 사원 회원등록 페이지
 *  passchgUser : 비밀번호 변경 페이지
 *  filePartner : 업체등록 정보 확인 및 자료 등록 요청 페이지
 *  workderPartner : 업체의 작업자 등록 페이지
 */

$action = "yes";
$mode= $_GET['sendMode'];
$mailChk = getCnt("select * from mail_hash where hash_key = '".$_GET['hash']."'");


// 최초 열람인 경우 mh_dt_read 에 현재시간을 기록
if($mailChk > 0){
    setResult("update mail_hash set mh_dt_read = now() where hash_key = '".$_GET['hash']."' AND mh_dt_read = '0000-00-00 00:00:00'");
}
if($mailChk > 0){
    $url ="";
    switch($mode){

    /* 사업장 관리자 회원등록 페이지 */
        case "mainUser" :
            $sql = "SELECT * FROM `user` WHERE `user_ref_seq` = 0  and user_use ='N' and hash_key='".$_GET['hash']."'";
            $userCnt = getCnt($sql);
            if($userCnt <= 0){
                $action = "no";
            }else{
                $user = getRow($sql);
                setResult("update user set user_use = 'Y', hash_key ='', user_level = '100' where user_email = '".$user['user_email']."' and hash_key='".$_GET['hash']."'");
            }
        break;

    /*사업장의 사원 회원등록 페이지 */
        case "subUser":
           //
           $signCnt = getCnt("select * from user where user_pass = '".$_GET['hash']."' and user_use = 'N' and user_del = '0' ");
           if($signCnt == 0){
                $action ="no";
            }else{
                $signData = getRow("select * from user where user_pass = '".$_GET['hash']."' and user_use = 'N' and user_del = '0' ");
                $mailCnt = getCnt("select * from user where user_del = '0' and user_use = 'Y' and user_email = '".$signData['user_email']."' ");
                if($mailCnt > 0){
                    // 이미 등록된 이메일 주소로 회원등록을 시도한 경우
                    $action = "copy";
                    $url ='/rams/auth/agree.php?'.$_SERVER['QUERY_STRING']."&action=copy";
                }else{
                    // 관리자와 사원에 계정정보가 없는경우
                    $url ='/rams/auth/agree.php?'.$_SERVER['QUERY_STRING'];
                }
            }
        break;
    /* 그 외는 모두 잘못된 접근 */
        default:
            $action ="no";
        break;

    }
}else{
    $action ="no";
}

?>


<div class="main-container container-fluid mt-5 pt-5 p-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom-card ">
                    <div class="card-body p-0">
                        <div class="tab-content text-center m-5 p-5">
                            <h1 class="fw-bolder" id="contentsTitle">
                            </h1>
                            <h3 class="mt-3" id="contents">
                            </h3>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                    <? if($mode == "mainUser" && $action =="yes"){ ?>
                            <button class="btn btn-green m-1" id="btn-login" onclick="location.href='/rams/auth/login.php'"><i class="fa fa-check"></i> 로그인하기</button>
                    <? }?>
                            <button class="btn btn-primary m-1" id="btn-close" onclick="self.close();"><i class="fa fa-close"></i> 닫기</button>
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
    $sub_title = "이제부터 안전보건관리 솔루션 이용이 가능합니다.";
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

require_once $_SERVER['DOCUMENT_ROOT'].'/rams/_common/rms_footer.php'; 
?>