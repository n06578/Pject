<script>
    function Format_comma(val1){
        if(val1 == 0){
            return val1
        }else{
            var newValue = val1+""; //숫자를 문자열로 변환
            var len = newValue.length;
            var ch="";
            var j=1;
            var formatValue="";
    
            // 콤마제거
            newValue = newValue.replace(/[^0-9]/g, "");
            newValue = newValue.replace(/\,/gi, ' ');
            newValue = newValue.replace(/^0+/, "");
    
            // comma제거된 문자열 길이
            len = newValue.length;
    
            for(i=len ; i>0 ; i--){
                ch = newValue.substring(i-1,i);
                formatValue = ch + formatValue;
                if ((j%3) == 0 && i>1 ){
                    formatValue=","+formatValue;
                }
                j++
            }
    
            return formatValue;
        }
    }

    
    function makeShortURL($url) {
        // 네이버 단축URL Open API 예제
        $client_id = "dEiM5rnUs6GT0Mnjctfg"; // 네이버 개발자센터에서 발급받은 CLIENT ID (엔시드 소리시험 계정)
        $client_secret = "qGssdI8ASa";// 네이버 개발자센터에서 발급받은 CLIENT SECRET
        $encText = urlencode($url);
        $postvars = "url=".$encText;
        //$url = "https://openapi.naver.com/v1/util/shorturl";
        //$is_post = true;
        $url = "https://openapi.naver.com/v1/util/shorturl?url=".$encText ;
        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
        $headers = array();
        $headers = array_push("X-Naver-Client-Id: ".$client_id);
        $headers = array_push("X-Naver-Client-Secret: ".$client_secret);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //echo "status_code:".$status_code."<br>";
        curl_close ($ch);
        if($status_code == 200) {
            return json_decode($response,JSON_UNESCAPED_UNICODE);
        } else {
            return json_decode($response,JSON_UNESCAPED_UNICODE);
        }
    }
    
</script>