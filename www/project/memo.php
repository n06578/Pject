<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/main_header.php";
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-80">Blank Page</h1>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-2">
            <div class="card border-top-primary shadow h-100 py-">
                <div class="card-body pb-0 m-3">
                    <div id="demo-desktop-month-view" style="height:100%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row info-card d-none">
        <div class="col-xl-12 col-md-12 mb-2">
            <div class="card border-top-primary shadow h-100 py-">
                <div class="card-body pb-0 m-3 clicktitle">
					<form id="infoData">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<input type="hidden" name="dataMode" value="updateData">
								<input type="hidden" name="id" id="id">
								<input type="hidden" name="allDay" id="allDay">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">title</div>
								<input type="text" name="title" class="form-control" id="title">
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">startDate</div>
                                <div class="row no-gutters align-items-center">
                                    <input type="date" name="startDay" class="form-control px-3 col mr-3" id="startDay">
                                    <input type="time" name="startTime" class="form-control px-3 col" id="startTime">
                                </div>
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">endDate</div>
                                <div class="row no-gutters align-items-center">
                                    <input type="date" name="endDay" class="form-control px-3 col mr-3" id="endDay">
                                    <input type="time" name="endTime" class="form-control px-3 col" id="endTime">
                                </div>
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">color</div>
								<input type="color" name="color" class="form-control" id="color">
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">memo</div>
								<textarea type="text" name="memo" class="form-control" id="memo"></textarea>
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2 text-right">
								<a href="#" class="btn btn-sm btn-danger btn-icon-split btn-del">
									<span class="icon text-white-50">
										<i class="fas fa-trash"></i>
									</span>
									<span class="text">DELETE</span>
								</a>
								<a class="btn btn-sm btn-success btn-icon-split" id="btn-save">
									<span class="icon text-white-50">
										<i class="fas fa-check"></i>
									</span>
									<span class="text">SAVE</span>
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

<? include $_SERVER['DOCUMENT_ROOT']."/includes/main_bottom.php"?>
<script src="<?=$rootPath?>js/jquery.form.js"></script>
<script>
$(function () {
    mobiscroll.setOptions({
        locale: mobiscroll.localeKo,
        theme: 'windows',
        themeVariant: 'light' // or dark
    });
});

$(document).ready(function() {
    // 서버에서 데이터를 가져오기 (예시)
    $.ajax({
        type: "GET",
        url: "ajax/ajax_get_memo.php", // 데이터를 가져올 서버 URL
        dataType: "json", // 응답 형식은 JSON
        success: function(data) {
            if (Array.isArray(data)) {
                // 서버에서 받은 데이터를 Mobiscroll 캘린더 형식에 맞게 변환
                const eventsData = data.map(event => ({
                    start: new Date(event.start),  // start는 Date 객체로 변환
                    end: new Date(event.end),      // end도 마찬가지
                    title: event.title,
                    allDay: event.allDay === 'true', // "true"를 boolean으로 변환
                    color: event.color || ''  // color가 없으면 빈 문자열로 처리
                }));

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
                            args.event.dataMode = "insertChk";

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
									$(".info-card").removeClass("d-none")
                                    $("#title").val(data['title']);
                                    var startDate = data['startDate'];
                                    startDay = startDate.split(" ");
									$("#startDay").val(startDay[0]);
                                    $("#startTime").val(startDay[1]);

                                    var endDate = data['endDate'];
                                    endDay = endDate.split(" ");
                                    $("#endDay").val(endDay[0]);
                                    $("#endTime").val(endDay[1]);
									$("#color").val(data['color']);
									$("#memo").val(data['memo']);
									$("#id").val(args.event.id);
									$("#allDay").val(args.event.allDay);

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
	
});
  
</script>