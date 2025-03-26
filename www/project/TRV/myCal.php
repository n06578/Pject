<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>
<div class="main-box container-fluid h-85">
    <div class="row h-100">
        <div class="col-xl-8 col-md-8 mb-2">
            <div class="card border-top-primary shadow h-100 py-">
                <div class="card-body pb-0 m-3">
                    <div id="demo-desktop-month-view" style="height:100%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-2" id="list-card">
            <div class="card border-top-primary shadow h-100">
                <div class="card-body pb-0 m-3 clicktitle">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>시작일</th>
                                <th>종료일</th>
                                <th>일정명</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-2 d-none" id="info-card">
            <div class="card border-top-primary shadow h-100">
                <div class="card-body pb-0 m-3 clicktitle">
					<form id="infoData">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<input type="hidden" name="dataMode" value="updateData">
                                <input type="hidden" name="seq" id="seq">
								<input type="hidden" name="id" id="id">
								<input type="hidden" name="allDay" id="allDay">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">일정명</div>
								<input type="text" name="title" class="form-control" id="title">
							</div>
						</div>
                        <div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">일정소명</div>
								<input type="text" name="subTitle" class="form-control" id="subTitle">
							</div>
						</div>
                        
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">여행시작</div>
                                <input type="date" name="startDay" class="form-control px-3 col mr-3" id="startDay" value="<?=date('Y-m-d')?>">
                                <input type="time" name="startTime" class="form-control px-3 col d-none" id="startTime">
                            </div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">여행종료</div>
                                <input type="date" name="endDay" class="form-control px-3 col mr-3" id="endDay" value="<?=date('Y-m-d')?>">
                                <input type="time" name="endTime" class="form-control px-3 col d-none" id="endTime">
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">일정표 색상</div>
								<input type="color" name="color" class="form-control" id="color">
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">일정메모</div>
								<textarea type="text" name="memo" class="form-control" id="memo"></textarea>
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
                                <div class="row">
                                    <div class="col text-xs font-weight-bold text-primary text-uppercase mb-1">해당일정 게시물</div>
                                    <div class="col text-xs  text-primary text-uppercase mb-1 text-right c-pointer">
                                        <input type="button" class="btn btn-xs btn-white font-weight-bold text-primary showMore" value="더보기">
                                    </div>
                                </div>
                                <div class="card miniCard h-500 py-2 c-pointer">
                                    <div class="card-body listItem p-2">
                                        <div class="listItemBox modal-open" data-bs-toggle="modal" data-bs-target="#imgModal">
                                            <img class="calItemImg" src="../../img/trv/listItem/item1.jpg">
                                            
                                            <div class="itemBigView text-right txt-7 d-none">
                                                크게보기
                                            </div>
                                        </div>
                                        <div class="calItemCon pt-2" title="내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?">
                                            내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?내용이 아마도 이곳에?
                                            <div class="calItemWrt text-right txt-6 d-none">
                                                작성자
                                            </div>
                                            <div class="showDetail text-right txt-6 d-none">
                                                자세히보기
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
						<div class="row no-gutters align-items-center float-bottom bottom-div text-right">
							<div class="col mr-2 my-2 text-right">
								<a href="#" class="btn btn-sm btn-danger btn-icon-split" id="btn-del">
									<span class="icon text-white-50">
										<i class="fas fa-trash"></i>
									</span>
									<span class="text">삭제</span>
								</a>
								<a class="btn btn-sm btn-success btn-icon-split" id="btn-save">
										<i class="fas fa-check"></i>
									<span class="text">저장</span>
								</a>
							</div>
						</div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<? include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php"?>
<script src="<?=$rootPath?>js/jquery.form.js"></script>
<script>
    $(document).ready(function() {
        $(".listItemWrt").addClass("d-none");
        $(".showDetail").addClass("d-none");
        $(".itemBigView").addClass("d-none");
        
        $(".modal-open").on("click", function() {
            var imgSrc = $(this).find("img").attr("src");
            $(".modal-title").text("이미지");
            $(".modal-body").html("<img src='"+imgSrc+"' class='modalImg' style='height: 90vh;'>");
            $("#imgModal").modal("show");
        });
    });

    $(".listItemBox").on({
        "mouseover":function() {
            $(this).find(".itemBigView").removeClass("d-none").addClass("d-flex");
        },
        "mouseout":function() {
            $(this).find(".itemBigView").removeClass("d-flex").addClass("d-none");
        }
    });

    $(".listItem").on({
        "mouseover":function() {
            $(this).find(".listItemWrt").removeClass("d-none").addClass("d-flex");
            $(this).find(".showDetail").removeClass("d-none").addClass("d-flex");
            
        },
        "mouseout":function() {
            $(this).find(".listItemWrt").removeClass("d-flex").addClass("d-none");
            $(this).find(".showDetail").removeClass("d-flex").addClass("d-none");
        }
    });
    

    $(function () {
        mobiscroll.setOptions({
        locale: mobiscroll.localeKo,
        theme: 'windows',
        themeVariant: 'light'
    });

    /* 달력 데이터 가져오기 및 클릭 이벤트 활성화 */
    $.ajax({
        type: "GET",
        url: "ajax/ajax_cal_list.php", // 데이터를 가져올 서버 URL
        data:{type:"calander"},
        dataType: "json", // 응답 형식은 JSON
        success: function(data) {
            console.table(data);
            $("#dataTable").append("<tbody>");
            if (Array.isArray(data)) {
                // 서버에서 받은 데이터를 Mobiscroll 캘린더 형식에 맞게 변환
                const eventsData = data.map(event => ({
                    seq: event.seq,
                    start: new Date(event.start),  // start는 Date 객체로 변환
                    end: new Date(event.end),      // end도 마찬가지
                    title: event.title,
                    subTitle:event.subTitle,
                    momo:event.momo,
                    allDay: event.allDay === 'true', // "true"를 boolean으로 변환
                    color: event.color || '#0078D7'  // color가 없으면 빈 문자열로 처리
                    
                }));
                var i = 0;
                data.map(event => {
                    $("#dataTable").append("<tr onclick='infoDataTr(this)' data-date="+event.start.substr(0, 10)+" data-info='Event 1'>"+"<td>"+event.start.substr(0, 10)+"</td>"+"<td>"+event.end.substr(0, 10)+"</td>"+"<td>"+event.title+"</td>"+"</tr>");
                    i++;
                });
                if(i == 0){
                    $("#dataTable").append("<tr><td class='text-center' colspan=3>등록된 일정이 없습니다.</td></tr>")
                }
                $("#dataTable").append("</tbody>");

                
                console.log(eventsData);

                // Mobiscroll 캘린더 설정 및 데이터 추가
                var inst = $('#demo-desktop-month-view')
                    .mobiscroll()
                    .eventcalendar({
                        clickToCreate: true,
                        dragToCreate: true,
                        dragToMove: true,
                        dragToResize: true,
                        eventDelete: true,
                        view: {
                            calendar: { labels: true },
                        },
                        onEventClick: function (args) {
                            args.event.subTitle = '';
                            // UI 차단: 로딩 표시
                            mobiscroll.toast({
                                message: "Loading...",
                                display: "center",
                                color: "gray",
                                closeButton: false
                            });
                            
                            // AJAX 요청 최적화
                            $.ajax({
                                type: "POST",
                                url: "ajax/ajax_memo.php",
                                data: args.event,
								dataType : "json",
                                success: function (data) {
                                    $("#title").val(data['title']);
                                    var startDate = data['startDate'];
                                    startDay = startDate.split(" ");
									$("#startDay").val(startDay[0]);
                                    $("#startTime").val(startDay[1]);

                                    var endDate = data['endDate'];
                                    endDay = endDate.split(" ");
                                    if(data['color'] == "" ){
                                        data['color'] = "#0078D7";
                                    }
									$("#id").val(args.event.id);
                                    $("#seq").val(data['seq']);
                                    $("#endDay").val(endDay[0]);
                                    $("#endTime").val(endDay[1]);
									$("#color").val(data['color']);
                                    $("#subTitle").val(data['subTitle']);
									$("#memo").val(data['memo']);
									$("#allDay").val(args.event.allDay);
                                    $("#list-card").addClass("d-none");
                                    $("#info-card").removeClass("d-none");
                                    // 로딩 표시 제거 후 결과 토스트
                                    mobiscroll.toast({
                                        message: args.event.title,
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // 오류 처리
                                    mobiscroll.toast({
                                        message: "Error occurred!",
                                        color: "red",
                                    });
                                }
                            });
                        },
                        data: eventsData
                    })
                    .mobiscroll('getInst');
            }
        },
        error: function(xhr, status, error) {
            console.error("이벤트 데이터를 가져오는 중 오류 발생:", error);
        }
    });

    /* 일정 내용 저장 버튼 */
	$("#btn-save").click(function(){
		$("#infoData").ajaxSubmit({
			url: 'ajax/ajax_memo.php',
			type: 'post',
			success : function(val){
				mobiscroll.toast({
					message: "저장되었습니다.",
					display: "center",
					color: "gray",
					closeButton: false
				});
				location.reload();
			}
		});
	})
	
    /* 달력 일정 삭제 버튼 */
    $('#btn-del').click(function(){
        calDataDel();
    })
    
    /* 일정 삭제 함수 */
    function calDataDel(){
        const notice = PNotify.info({
            title: '삭제 후 복구가 불가능합니다.',
            text: '삭제하시겠습니까?',
            icon: 'fa fa-exclamation-triangle',
            hide: false, // 자동으로 닫히지 않도록 설정
            closer: false, // 닫기 버튼 비활성화
            sticker: false, // 스티커 버튼 비활성화
            destroy: true, // 알림을 클릭으로 제거 가능하도록 설정
            stack: new PNotify.Stack({
                dir1: 'down',
                modal: true,
                firstpos1: 25,
                overlayClose: false
            }),
            modules: new Map([
                ...PNotify.defaultModules,
                [PNotifyConfirm, {
                    confirm: true,
                    buttons: [
                        {
                            text: '확인',
                            click: (notice) => {
                                $.ajax({
                                    type: "POST",
                                    url: "ajax/ajax_memo.php",
                                    data: "seq="+$("#seq").val()+"&dataMode=delData",
                                    success: function (data) {
                                        console.log("action");
                                        location.reload();
                                    }
                                })  
                            }
                        },
                        {
                            text: '취소',
                            click: notice => notice.close()
                        }
                    ]
                }]
            ])
        });
    }
});

  
    function infoDataTr(thisval){

        var selectedDate = $(thisval).data('date');  // 클릭한 날짜를 data-attribute에서 가져옴
        var additionalInfo = $(thisval).data('info');  // 추가 정보 가져오기

        // 달력 입력 필드에 날짜 값 설정
        $('#calendar').val(selectedDate);

        // MobiScroll에서 해당 날짜 선택
        $('#calendar').mobiscroll('setVal', selectedDate);

        // 추가 정보를 콘솔에 출력 (예시로 추가 정보 표시)
        console.log('Selected Date: ' + selectedDate + ', Info: ' + additionalInfo);

        // 추가적인 로직을 여기에 삽입 가능 (예: 날짜에 관련된 이벤트 표시 등)
    }

    $(document).on("click",".showMore",function(){
        location.href='myCalItem.php?seq='+$("#seq").val();
    })
</script>