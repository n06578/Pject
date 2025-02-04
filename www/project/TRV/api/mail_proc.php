<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/function.php';

include $document_root . '/project/TRV/plugin/PHPMailer/src/Exception.php';
include $document_root . '/project/TRV/plugin/PHPMailer/src/PHPMailer.php';
include $document_root . '/project/TRV/plugin/PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


/**
 * 메일 전송 함수
 * @param string $title 메일 제목
 * @param string $receiveMan 받는 사람 이름
 * @param string $mailText 메일 내용
 * @param string $user_email 받는 사람 이메일
 * @param string $sendMode 메일 발송 모드
 * @param string $addUrl 추가 URL
 */

function mailSend($title, $receiveMan, $mailText, $user_email, $sendMode, $addUrl=""){
    global $hash;
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://");

    /*********************************************************************
     * 아래 부분은 수정하지 마세요.
     * 조건에 따라서 메일 발송을 하거나 하지 않도록 처리하기위해 분리
     ********************************************************************/
    $mail = new PHPMailer(); // 새로운 PHPMailer 객체를 생성합니다.
    // 메일 설정
    $mail->isSMTP();
    $mail->Host = "smtp.naver.com";
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    $mail->Username   = "yoyajo";
    $mail->Password   = "Nyoun003310..4";
    $mail->CharSet = "utf-8";
    $mail->SetFrom('yoyajo@naver.com', 'Pject TRV 인증 서비스');


    $org_url = $protocol . $_SERVER['HTTP_HOST'] . "/project/TRV/api/mailChk.php?hash=$hash&sendMode=".$sendMode.$addUrl;
    // $make_surl = makeShortURL($org_url);
    // $surl = $make_surl['result']['url'];


    $mail->Subject = $title;
    $mail->isHTML(true);
    $mail->Body  = "<h4 style='text-align: center;padding: 25px 15px;background-color: #0c6c9e;color: #FFFFFF;font-size:16px;width:90%;border-radius: 10px;'>
                        ".$title."
                    </h4><br>";
    $mail->Body .= "<br>
                    <div style='background-color: #EDEFF2;padding:30px 15px;border-radius:10px;min-height:50px;width:90%;'>
                        " . nl2br($mailText) . "
                    </div><br>
                    <br>
                    <a href=\"$org_url\">
                        <button style='text-align: center;padding: 10px 15px;background-color: #8BC34A;color: #FFFFFF;font-size:16px;border-radius: 10px;'>
                            <b>접속하기</b>
                        </button>
                    </a>
                    <br>
                    ";
    $mail->Body .= "";

    $mail->AddAddress($user_email, $receiveMan);
    $mail->send();


    // sendHistory($hash,$user_email,"mail",$mail->Body);
    
}

function ATagNoSend($title, $receiveMan, $mailText, $user_email, $sendMode, $addUrl=""){
    global $hash;
    $mail = new PHPMailer(); // 새로운 PHPMailer 객체를 생성합니다.
    // 메일 설정
    $mail->isSMTP();
    $mail->Host = "smtp.naver.com";
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";
    $mail->Username   = "yoyajo";
    $mail->Password   = "Nyoun003310..";
    $mail->CharSet = "utf-8";
    $mail->SetFrom('yoyajo@naver.com', 'Pject TRV 인증 서비스');


    $mail->Subject = $title;
    // $mail->MsgHTML($mailText);
    $mail->isHTML(true);
    $mail->Body  = "<h4 style='text-align: center;padding: 25px 15px;background-color: #0c6c9e;color: #FFFFFF;font-size:16px;width:90%;border-radius: 10px;'>
                        ".$title."
                    </h4><br>";
    $mail->Body .= "<br><div style='background-color: #EDEFF2;padding:30px 15px;border-radius:10px;min-height:50px;width:90%;'>
                        " . nl2br($mailText) . "
                    </div><br>";
    $mail->AddAddress($user_email, $receiveMan);
    $mail->send();


    // sendHistory($hash,$user_email,"mail",$mail->Body);
}

function sendHistory($hash,$user_email,$type="mail",$log_msg=""){

    $log_msg = strip_tags($log_msg);

    $query = "insert into mail_hash set 
            hash_key = '".$hash."',
            send_type = '".$type."',
            user_email = '".$user_email."',
            mh_message = '".$log_msg."',
            mh_dt_read = '0000-00-00 00:00:00',
            data_dt_reg = '".date('Y-m-d H:i:s')."'
    ";
    // $result = setResult($query);
}
/*******************************************************************************************
 *  사용법 -> 메일 전송하는 페이지에서 작성
 * 
 * 1. 현재 페이지를 include [ include($document_root . '/rams/_api/mail_proc.php'); ]
 * 2. 전송할 내용 작성 
 *    └>( 제목, 받는사람, 내용 , 메일 보내는 용도 확인 변수-> 메일 받는 페이지에서 판단 )
 * 3. 메일 전송 함수 호출
 ******************************************************************************************/