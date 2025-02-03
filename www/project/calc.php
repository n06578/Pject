<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/main_header.php";

?>
<style>
    .textView{
        min-height: 33.583px !important;
    }
    .calcTitle{
        background-color:#f8f9fc !important;
        border-color:#f8f9fc !important;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <!-- Total Card -->
        <div class="col-md-5">
            <div class="card border-left-primary shadow py-0 mb-2">
                <div class="card-body pb-0 mb-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-1 text-sm font-weight-bold text-primary text-uppercase mt-0 mb-2">total</div>
                        <div class="col-11 text-sm font-weight-bold text-secondery text-right text-uppercase mt-0 mb-2 calc"></div>
                        <div class="col-12 mr-2">
                            <div class="h3 text-right mb-3 font-weight-bold text-gray-800">
                                <input type="text" class="form-control form-control-lg textView text-right">
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">7</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">8</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">9</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-warning m-1">*</button>                   
                    </div>
                    <div class="row">
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">4</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">5</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">6</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-warning m-1">-</button>
                    </div>
                    <div class="row">
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">1</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">2</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">3</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-warning m-1">+</button>
                    </div>
                    <div class="row">
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">000</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">00</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-info m-1">0</button>
                        <button type="button" class="col btn eb btn-xl border border-light-subtle border-bottom-danger m-1">=</button>
                    </div>
                </div>
                <div class="col text-right pb-2 pr-2">
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm textViewDel">
                        <i class="fas fa-download fa-sm text-white-50"></i> del
                    </a>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm calcDel">
                        <i class="fas fa-download fa-sm text-white-50"></i> clear
                    </a>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm calcRecord">
                        <i class="fas fa-download fa-sm text-white-50"></i> Record
                    </a>
                </div>
            </div>
        </div>

        <!-- Record Section -->
        <div class="col-md-7 calcBody">
            <div class="card shadow mb-2">
                <div class="card-header py-1 px-2 d-ruby">
                    <input type="text" class="m-0 p-0 form-control font-weight-bold text-primary calcTitle py-0" value="알수없음">
                    <input type="button" class="btn btn-sm btn-danger calMemoDel" value="삭제">
                </div>
                <div class="card-body calcMemo py-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/main_bottom.php"?>
<script>
    $(document).ready(function(){

        /* 연산에 포함시킬 숫자 한글자씩 지우기  */
        $(".textViewDel").click(function(){
            var textView = $(".textView").val();
            /* 숫자가 존재할 경우에만 삭제하도록 처리  */
            if($(".textView").val() != "" ){
                $(".textView").val(Format_comma(textView.replace(/\,/gi, '').slice(0, -1)));
            }
        })



        /* 연산에 포함시킬 숫자 전체 삭제  */
        $(".calcDel").click(function(){
            $(".calc").text("");
            $(".textView").val("");
        })



        // 자판 클릭 시
        $(".eb").click(function(){
            calc(this,"button");
        })

        $(document).on("input", ".textView",function(e){    
            let oldValue = $(this).data("oldValue") || ""; // 이전 값 저장 (초기값은 빈 문자열)

            var thisval = $(this).val();
            if (thisval !== oldValue) { // 값이 변경된 경우에만 실행
                $(this).data("oldValue", thisval); // 이전 값을 현재 값으로 업데이트
                $(this).val(thisval.slice(0,-1));
                calc(thisval.slice(-1),"keyboard");
            }
        })

        /*  수식 기록 */
        $(".calcRecord").click(function(){
            var calc = $(".calc").text();
            var result = $(".textView").text();
            // 수식이 존재하지 않을 경우 메모에 미추가 처리
            if(calc != ""){
                if($(".calcMemo").text() != ""){
                    // 메모에 수식이 존재할경우 card 추가
                    $(".calcBody").append('<div class="card shadow mb-2"><div class="card-header p-1 px-2 d-ruby"><input type="text" class="m-0 p-0 form-control font-weight-bold text-primary calcTitle w-80" value="알수없음"><input type="button" class="btn btn-sm btn-danger calMemoDel" value="삭제"></div><div class="card-body calcMemo py-2">'+calc+'</div></div>');


                }else{
                    $(".calcMemo").text(calc);
                    // 알수없음 전체 선택
                    $(".calcTitle").select();
                }
                $(".calc").text("");
                $(".textView").val("");
            }else{
                alert("수식이 존재하지 않습니다.");
            }
        });

        function calc(thisval,type){
            if(type == "button"){
                var thisText = $(thisval).text();
            }else{
                var thisText = thisval;
            }
            /* 수식 연산을 클릭했을 경우 */
            if(thisText.replace(/[\,.0-9]/g,'') != ""){ 
                var calcAppend = $(".textView").val();
                /* 연산 클릭 전 숫자가 존재하는지 판단하기 위한 조건 처리 */
                if(calcAppend != ""){
                    if ($(".calc").text().indexOf('=') == -1) {
                        $(".calc").append(calcAppend+thisText);
                    }
                }
                var calc = $(".calc").text();
                /* 등호를 클릭 했을 경우 단, 이미 수식에 등호가 포함되어있지 않아야함 */
                if(calc.slice(-1) == "="){
                    var resultVal = eval(calc.replace(/\,/gi, '').slice(0,-1));
                    console.log(calc.slice(0,-1),resultVal)
                    $(".calc").append(Format_comma(resultVal));
                    $(".textView").val(Format_comma(resultVal));
                }else{
                    /* 등호가 아닐 경우 연산기호를 선택한 것으로 숫자값 상단으로 이동 처리 */
                    $(".textView").val("");
                }
            }else{
                /* 단순 숫자 클릭으로 숫자 이어서 붙히기 */
                if ($(".calc").text().indexOf('.') == -1) {
                    /* 소숫점은 하나만 포함 가능하므로 하나라도 삽입되어있을 경우 미추가 처리 */
                    $(".textView").val($(".textView").val()+thisText);
                    var textNum = $(".textView").val();
                    $(".textView").val(Format_comma(textNum.replace(/\,/gi, '')));
                }
            }
        }
    });


    $(document).on("click", ".calMemoDel",function(e){
        var calcMemoCnt = $(".calcMemo").length;
        console.log(calcMemoCnt);
        if(calcMemoCnt > 1){
            $(this).parent().parent().remove();
        }else{
            $(this).parent().parent().find(".calcMemo").text("");
            $(this).parent().parent().find("calcTitle").val("알수없음");
        }
    });

</script>