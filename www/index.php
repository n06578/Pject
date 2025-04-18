<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/main_header.php";
?>
<div class="container-fluid">
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div> -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-8 col-md-6 mb-4 h-100">
            <!-- 개인 자기소개 -->
            <div class="card shadow mb-4">
                <!-- 개인 자기소개 header 및 dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">자기소개 <small><b>(추가적인 정보는 우측 메뉴를 클릭해주세요.)</b></small></h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i> <font class="txt-secondary hoverNone">메뉴</font>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink" title="">
                            <div class="dropdown-header">개인 정보</div>
                            <a class="dropdown-item portItem itemAction" href="#">자기소개</a>
                            <a class="dropdown-item portItem" href="#">나이 및 학력</a>
                            <a class="dropdown-item portItem" href="#">경력 및 경험</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <div class="row h-100">
                            <div class="col-3 h-100">
                                <img src="img/pt/my.jpg" alt="" style="width: 100%;">
                            </div>
                            <div class="col-9">
                                <p class="txt-black lh-2 context1" >
                                현재 PHP 기반의 웹 풀스택 개발자로, 실무 경력은 2년 4개월입니다.<br>

                                고등학교 시절부터 일상생활의 불편함을 앱 개발적 측면에서 바라보는 관점을 자주 가졌습니다.<br>
                                이러한 경험이 쌓여 개발에 관심을 갖게되었습니다. <br>
                                초기에 목표로 둔 앱 개발을 통하여 자연스럽게 웹 개발에도 관심을 가지게 되었으며 이후 웹이 가진 실시간성, 빠른 배포 환경에 매력을 느껴
                                자연스럽게 웹 중심으로 커리어를 이어오게 되었습니다.<br><br>
                                저는 여러 시스템을 접하며 불편함을 느껴봤었던 사용자로 개발을 맡아 임할 때 사소한부분까지 고려하며 프로젝트를 진행시켰습니다.<br>
                                위 시각으로 단순히 주어진 기능만 구현하는 개발자가 아닌 끊임없이 아이디어를 고민하고 시스템을 발전시킬 수 있는 개발자로 성장하고 싶다는 목표를 갖게 되었습니다.
                                </p>
                                
                                <p class="txt-black lh-2 context2 d-none" >
                                    <strong>나이</strong>
                                    <br>
                                    &nbsp;27세
                                    <br>
                                    <strong>사는곳</strong>
                                    <br>
                                    &nbsp;인천광역시 부평구 삼산동
                                    <br>
                                    <strong>학력</strong> 
                                    <br>
                                    &nbsp;● 안산대학교 컴퓨터공학과 <small>( <strong>입학</strong> 2018년 3월 <strong>졸업</strong> 2022년 2월 )</small>
                                    <br>
                                    &nbsp;● 문일여고 <small>( <strong>입학</strong> 2015년 3월 <strong>졸업</strong> 2018년 2월 )</small>
                                    <br>
                                    &nbsp;● 만수여중 <small>( <strong>입학</strong> 2012년 3월 <strong>졸업</strong> 2015년 2월 )</small>

                                </p>
                                
                                <p class="txt-black lh-4 context3 d-none" >
                                    <strong>경력 ( 총 4년 )</strong>
                                    <br>
                                    &nbsp;● 2017.06 ~ 2018.02 <small class="ml-1 mr-2">9개월</small> &nbsp;&nbsp;교촌치킨<small>( <strong>알바</strong> )</small>
                                    <br>
                                    &nbsp;● 2018.08 ~ 2018.12 <small class="ml-1 mr-2">5개월</small> &nbsp;&nbsp;치킨대학교<small>( <strong>알바</strong> )</small>
                                    <br>
                                    &nbsp;● 2019.05 ~ 2019.10 <small class="ml-1 mr-2">6개월</small> &nbsp;&nbsp;곱창이야기<small>( <strong>알바</strong> )</small>
                                    <br>
                                    &nbsp;● 2022.04 ~ 2024.08 <small class="ml-1 mr-2">2.5년</small> &nbsp;&nbsp;제트핑거소프트<small>( <strong>개발팀</strong> )</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 개인 활동 상단 -->    
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 subdown-div">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        총 경력<br>(아르바이트+개발자)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">4년</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item pl-2 pr-1 py-2" href="#">
                            ●   2017.06 ~ 2018.02 9개월   교촌치킨 <br>
                            ●   2018.08 ~ 2018.12 5개월   치킨대학교 <br>
                            ●   2019.05 ~ 2019.10 6개월   곱창이야기 <br>
                            ●   2022.04 ~ 2024.08 2.5년   제트핑거소프트( 개발팀 )
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 subdown-div">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        개발자
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">2.5년</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item px-2" href="#">
                            Profile
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 subdown-div">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        포트폴리오
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">5개</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item px-2" href="#">
                            Profile
                        </p>
                    </div>
                </div>
            </div>
            <!-- 개인 활동 하단 -->
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 subdown-div">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        팀 프로젝트
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">1개</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item px-2" href="#">
                            Profile
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 subdown-div">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        개인 포트폴리오
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">4개</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-stopwatch fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item px-2">
                            Profile
                        </p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4 subdown">
                    <div class="card border-left-secondary shadow h-100 py-2 ">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold txt-secondary text-uppercase mb-1">
                                        총 포트폴리오 제작일수<br>(5개)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">11개월</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="subdown-menu">
                        <p class="subdown-item px-2">
                            Profile
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- 개인 기술 관련 card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold txt-darkgray"><i class="fas fa-cogs"></i> 기술</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">HTML<span
                            class="float-right">92%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 92%"
                            aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">PHP<span
                            class="float-right">95%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 95%"
                            aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">JAVASCRIPT<span
                            class="float-right">70%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">JQUERY <span
                            class="float-right">80%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">AJAX <span
                            class="float-right">82%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 82%"
                            aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">MYSQL <span
                            class="float-right">80%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">CSS 및 디자인툴(FIGMA, CANVA, PHOTOSHOP) <span
                            class="float-right">70%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                            aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">CORDOVA <span
                            class="float-right">92%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" style="width: 92%"
                            aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">GIT <span
                            class="float-right">84%</span></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 84%"
                            aria-valuenow="84" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">UBUNTU <span
                            class="float-right">54%</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 54%"
                            aria-valuenow="54" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 개인 성장 그래프 card 부분 
    <div class="row">
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">개인 성장 그래프</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>-->
                <!-- 개인 성장 그래프 
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>-->

    <div class="row">
        <div class="col-xl-3 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">freshO</h6>
                </div>
                <div class="card-body p-body">
                    <strong class="txt-black">제작기간 </strong> 2022.04 ~ 2022.08
                    <br>
                    <strong class="txt-black">제작인원 </strong> 2명
                    <br>
                    <strong class="txt-black">사용기술 </strong>
                    <p>HTML, CSS, JAVASCRIPT, PHP, MYSQL</p>
                    <strong class="txt-black">설명 </strong>
                    <p>
                        freshO는 신선식품을 판매하는 사이트입니다. <br>
                        선택 신선식품과 관련된 요리를 소개하면서 신선식품을 판매하는 사이트입니다. <br>
                    </p>    
                    <button class="btn btn-secondary linkBtn"><i class="fas fa-link"></i> 바로가기</button>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">계산기</h6>
                </div>
                
                <div class="card-body p-body">
                    <strong class="txt-black">제작기간 </strong> 2024.10 ~ 2024.10 ( 13일 )
                    <br>
                    <strong class="txt-black">제작인원 </strong> 1명
                    <br>
                    <strong class="txt-black">사용기술 </strong>
                    <p>HTML, CSS, JAVASCRIPT, PHP, JQUERY</p>
                    <strong class="txt-black">설명 </strong>
                    <p>
                        단순 계산기와는 다르게 결과값과 코멘트를 함께 저장할 수 있도록 하는 기능입니다. <br>
                        기록해놓은 값이 무슨 값인지 직접 입력하여 값들끼리 비교 및 혼동없이 기록할 수 있도록 하는 계산기 입니다. <br>
                    </p>    
                    <button class="btn btn-secondary linkBtn"><i class="fas fa-link"></i> 바로가기</button>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">월캘린더</h6>
                </div>
                
                <div class="card-body p-body">
                    <strong class="txt-black">제작기간 </strong> 2024.10 ~ 2024.10 ( 7일 )
                    <br>
                    <strong class="txt-black">제작인원 </strong> 1명
                    <br>
                    <strong class="txt-black">사용기술 </strong>
                    <p>HTML, CSS, JAVASCRIPT, PHP, JQUERY, MYSQL</p>
                    <strong class="txt-black">설명 </strong>
                    <p>
                        기존에 많이 존재하는 월별 캘린더와 동일한 일정을 추가하고 삭제할 수 있는 월별 캘린더입니다. <br>
                    </p>    
                    <button class="btn btn-secondary linkBtn"><i class="fas fa-link"></i> 바로가기</button>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold txt-darkgray">PRV</h6>
                </div>
                
                <div class="card-body p-body">
                    <strong class="txt-black">제작기간 </strong> 2024.12 ~ 2025.01
                    <br>
                    <strong class="txt-black">제작인원 </strong> 1명
                    <br>
                    <strong class="txt-black">사용기술 </strong>
                    <p>HTML, CSS, JAVASCRIPT, PHP, JQUERY, MYSQL</p>
                    <strong class="txt-black">설명 </strong>
                    <p>
                        TRV는 Travel View의 약자로 여행을 주제로 한 SNS 사이트입니다. <br>
                        인스타그램과 비슷한 형식의 SNS 사이트입니다. <br>
                        여행을 계획하거나 여행을 다녀온 후기를 공유할 수 있는 사이트입니다. <br>
                    </p>    
                    <button class="btn btn-secondary linkBtn"><i class="fas fa-link"></i> 바로가기</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
</div>
<!-- /.container-fluid -->
<? include $_SERVER['DOCUMENT_ROOT']."/includes/main_bottom.php"?>
<script>
$(document).ready(function(){
    // 제일 높이가 큰 card를 기준으로 나머지 card의 높이를 맞춤
    var max = 0;
    $(".p-body").each(function(){
        if(max < $(this).height()){
            max = $(this).height();
        }
    });
    $(".p-body").height(max);
});
$(".portItem").click(function(){
    $(".portItem").removeClass("itemAction");
    $(this).addClass("itemAction");
    var item = $(this).text();
    if(item == "자기소개"){
        $(".context1").removeClass("d-none");
        $(".context2").addClass("d-none");
        $(".context3").addClass("d-none");
    }else if(item == "나이 및 학력"){
        $(".context1").addClass("d-none");
        $(".context2").removeClass("d-none");
        $(".context3").addClass("d-none");
    }else if(item == "경력 및 경험"){
        $(".context1").addClass("d-none");
        $(".context2").addClass("d-none");
        $(".context3").removeClass("d-none");
    }
});
</script>