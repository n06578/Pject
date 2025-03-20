<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?>
<form id="joinFrm">
    <div class="container-fluid h-95">
        <div class="contents-col col joinBox py-5 mt-5">
            <div class="row j-c w-100 my-4" id="joinLogo"></div>
            <div class="row j-c w-100 pt-5 mb-4">
                <div class="joinTbl py-3 px-5">
                    <div class="joinDiv"><i class="fas fa-user"></i><input type="text" class="joinInput t-navy noBorder" id="nickName" name="nickName" placeholder="닉네임"><input type="button" class="btn btn-sm btn-secondary" id="nickChkBtn" value="중복확인"></div>
                    <div class="joinDiv"><i class="fas fa-user"></i><input type="text" class="joinInput t-navy noBorder" id="userName" name="userName" placeholder="성명"></div>
                    <div class="joinDiv">
                        <div class="joinMailDiv">
                            <i class="fas fa-envelope"></i>
                            <input type="text" class="joinInput t-navy noBorder" id="eMail" name="eMail" placeholder="이메일" data-toggle="tooltip"  data-placement="bottom" title="메일 인증 후 가입이 완료됩니다.">
                        </div>
                    </div>
                    <div class="joinDiv"><i class="fas fa-unlock"></i><input type="password" class="joinInput t-navy noBorder" id="loginPW" name="loginPW" placeholder="비밀번호" data-toggle="tooltip"  data-placement="bottom" title="비밀번호: 8~16자의 영문 대/소문자, 숫자, 특수문자를 사용해 주세요."><i class="far fa-eye eyeI"></i></div><!--<i class="far fa-eye-slash eyeI"></i>-->
                    <div class="joinDiv"><i class="fas fa-phone"></i><input type="tel" class="joinInput t-navy noBorder" id="phoneNum" name="phoneNum" placeholder="연락처"></div>
                    <div class="joinDiv"><i class="fas fa-globe-asia"></i><input type="text" class="joinInput t-navy noBorder" id="country" name="country" placeholder="국적"></div>
                    <div class="joinDiv">
                        <div class="radioDiv joinInput">
                            <div class="form-ul" id="divIdentityGender">
                                <ul class="ullist mr-3" id="listIdentityGender">
                                    <li class="radio_item">
                                        <input type="radio" id="identityGender1" name="gender" value="M" class="blind">
                                        <label for="men">남자</label>
                                    </li>
                                    <li class="radio_item">
                                        <input type="radio" id="identityGender2" name="gender" value="F" class="blind">
                                        <label for="girl">여자</label>
                                    </li>
                                </ul>
                                <ul class="ullist" id="listForeigner">
                                    <li class="radio_item">
                                        <input type="radio" id="foreigner1" name="foreign" value="K" checked="" class="blind">
                                        <label for="foreigner1">내국인</label>
                                    </li>
                                    <li class="radio_item">
                                        <input type="radio" id="foreigner2" name="foreign" value="F" class="blind">
                                        <label for="foreigner2">외국인</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row j-c w-100 mb-4">
                    <div class="joinBtm py-2 px-5">
                        <div class="joinDivb pb-5"><input type="checkbox" id="agreeChk" class="mr-2 mb-1"><label for="agreeChk" id="agreeTxt">약관에 동의합니다.</label></div>
                        <div class="joinDiv pt-2"><input type="button" class="btn btn-navy t-white w-100" id="loginBtn" value="가입"></div>
                        <div class="joinDiv pt-2">아이디가 존재합니까? <input type="button" class="btn t-navy" value="로그인" onclick="location.href='login.php'"></div>
                    </div>
            </div>
        </div>
    </div>
</form>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script>

$(function() {    
    $('#phoneNum').mask('000-0000-0000');

    // 국적 관련 script
    let countryArr = new Array();
    fetch('https://restcountries.com/v3.1/all', {
        headers: { 'accept-language': 'ko' } // 한국어로 요청
    }).then(response => response.json())
    .then(data => {
        // const select = document.getElementById('country-select');
        data.sort((a, b) => a.name.common.localeCompare(b.name.common));
        data.forEach(country => { countryArr.push(country.translations.kor.common)});
    })
    .then(
        $("#country").autocomplete({  //오토 컴플릿트 시작
            source : countryArr,    // source 는 자동 완성 대상
            select : function(event, ui) {    //아이템 선택시
                console.log(ui.item);
            },
            focus : function(event, ui) {    //포커스 가면
                return false;//한글 에러 잡기용도로 사용됨
            },
            minLength: 1,// 최소 글자수
            autoFocus: true, //첫번째 항목 자동 포커스 기본값 false
            classes: {    //잘 모르겠음
                "ui-autocomplete": "highlight"
            },
            delay: 500,    //검색창에 글자 써지고 나서 autocomplete 창 뜰 때 까지 딜레이 시간(ms)
//            disabled: true, //자동완성 기능 끄기
            position: { my : "right top", at: "right bottom" },    //잘 모르겠음
            close : function(event){    //자동완성창 닫아질때 호출
                console.log(event);
            }
        })
    )
    .catch(error => console.error('Error fetching country data:', error));

    // 비밀번호 관련 script
    const tooltipTrigger = document.querySelector('#loginPW');
    const tooltip = new bootstrap.Tooltip(tooltipTrigger, {
        trigger: 'manual' // 수동으로 제어
    });

    // focusin 이벤트: 툴팁 표시
    tooltipTrigger.addEventListener('focusin', () => tooltip.show());

    // focusout 이벤트: 툴팁 숨기기
    tooltipTrigger.addEventListener('focusout', () => tooltip.hide());
    /* 메일 인증 안내 */
    const tooltipMailrigger = document.querySelector('#eMail');
    const tooltipMail = new bootstrap.Tooltip(tooltipMailrigger, {
        trigger: 'manual' // 수동으로 제어
    });

    // focusin 이벤트: 툴팁 표시
    tooltipMailrigger.addEventListener('focusin', () => tooltipMail.show());

    // focusout 이벤트: 툴팁 숨기기
    tooltipMailrigger.addEventListener('focusout', () => tooltipMail.hide());
});
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
    
    $(".eyeI").on("click",function(){
        $(".eyeI").toggleClass("fa-eye-slash");
        $(".eyeI").toggleClass("fa-eye");
        const input = $('#loginPW');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);

    })

    $("#loginBtn").on("click",function(){
        if($("#nickChkBtn").val() == "중복확인"){
            if( $("#nickName").val()==""){ 
                pAlert("error","인증실패","닉네임을 입력해주세요.",true); 
            }else{
                eqChk("info",$("#nickName").val());
            }
            // pAlert("error","가입실패","닉네임 중복확인이 필요합니다.",true); 
        }else{
            joinOk();
        }
    })
    $("#nickChkBtn").on("click",function(){
        if($(this).val() == "중복확인"){
            if( $("#nickName").val()==""){ 
                pAlert("error","인증실패","닉네임을 입력해주세요.",true); 
            }else{
                chkNick($("#nickName").val())
            }
        }else{
            $("#nickName").removeClass("txt-dis");
            $("#nickChkBtn").val("중복확인")
            $("#nickName").attr("readonly",false); 
        }
    })


    $("#eMail").on("input",function(){
        var thisVal = $(this).val();
        if(thisVal.indexOf("@") != -1){
            console.log("이메일 확인");
        }
    })

    function chkNick(text){
        $.ajax({
            type: "GET",
            url: "ajax/ajax_nickChk.php", // 데이터를 가져올 서버 URL
            data: "type=join&nick="+text,
            success: function(data) {
                console.log(data);
                if(data == "ok"){
                    pAlert("info","인증완료","사용가능한 닉네임입니다.",true);
                    $("#nickChkBtn").val("닉네임변경")
                    $("#nickName").attr("readonly",true); 
                    $("#nickName").addClass("txt-dis");
                }else{
                    pAlert("error","인증실패","사용불가능한 닉네임입니다.",true);
                }
            }
        });
    }

    function joinOk(){
        if($("#userName").val() == ""){
            pAlert("error","가입실패","성명을 입력해주세요.",true);
            return false;
        }
        if($("#eMail").val() == ""){
            pAlert("error","가입실패","이메일을 입력해주세요.",true);
            return false;
        }else{
            let email = $("#eMail").val();
            if((email.match(/@/g) || []).length != 1){
                pAlert("error","가입실패","올바른 메일 형식을 입력해주세요.",true);
                return false;
            }
        }
        if($("#phoneNum").val() == ""){
            pAlert("error","가입실패","연락처를 입력해주세요.",true);
            return false;
        }
        if($("#country").val() == ""){
            pAlert("error","가입실패","국적을 입력해주세요.",true);
            return false;
        }
        if($("#loginPW").hasClass("t-red")){
            pAlert("error","가입실패","비밀번호는 8~16자의 영문 대/소문자, 숫자, 특수문자가 포함되어야합니다..",true);
            return false;
        }
        $("#joinFrm").ajaxSubmit({
            url: 'ajax/ajax_join.php',
            type: 'post',
            success : function(val){
                if(val == "joinDone"){
                    joinLogin();
                }else{
                    pAlert("error","가입실패","이미 가입된 이메일입니다.",true);
                    $("#eMail").val("");
                    $("#eMail").focus();
                }
            }
        });
        
    }
</script>