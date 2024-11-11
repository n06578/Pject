<script>
    function Format_comma(val1){
        var newValue = val1+""; //숫자를 문자열로 변환
        var len = newValue.length;
        var ch="";
        var j=1;
        var formatValue="";

        // 콤마제거
        newValue = newValue.replace(/\,/gi, ' ');

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
</script>