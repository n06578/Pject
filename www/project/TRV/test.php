<?

$mail  = "";
$mail .= "
            <div>
                <img src='http://34.231.136.110/img/trv/TRV.PNG' style='width:125px; margin:15px;'>
                <div style='padding: 30px 0px;border-radius: 10px;min-height: 50px;border: 1px solid rgba(36, 50, 128, 0.75);width: 500px;text-align:center;color: #1a1a1ac4 ;'>
                    " . nl2br("버튼을 눌러 메일 인증을 완료해주세요") . "
                </div>
                <br>
                <a href=\"test\">
                    <button style='text-align: center;padding: 10px 15px;background-color: #3042a7bf;color: #FFFFFF;font-size:16px;width: 500px;border-radius: 10px; border:0px;'>
                        <b>접속하기</b>
                    </button>
                </a>
            </div>
                <br>
                ";
$mail .= "";

echo $mail;
    ?>