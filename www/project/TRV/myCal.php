<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
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
        <div class="col-xl-4 col-md-4 mb-2">
            <div class="card border-top-primary shadow h-100">
                <div class="card-body pb-0 m-3 clicktitle">
					<form id="infoData">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<input type="hidden" name="dataMode" value="updateData">
								<input type="hidden" name="id" id="id">
								<input type="hidden" name="allDay" id="allDay">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">일정명</div>
								<input type="text" name="title" class="form-control" id="title">
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">여행시작</div>
                                <div class="row no-gutters align-items-center">
                                    <input type="date" name="startDay" class="form-control px-3 col mr-3" id="startDay">
                                    <input type="time" name="startTime" class="form-control px-3 col" id="startTime">
                                </div>
							</div>
						</div>
						<div class="row no-gutters align-items-center">
							<div class="col mr-2 my-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">여행종료</div>
                                <div class="row no-gutters align-items-center">
                                    <input type="date" name="endDay" class="form-control px-3 col mr-3" id="endDay">
                                    <input type="time" name="endTime" class="form-control px-3 col" id="endTime">
                                </div>
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
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">해당일정 게시물</div>
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
								<a href="#" class="btn btn-sm btn-danger btn-icon-split btn-del">
									<span class="icon text-white-50">
										<i class="fas fa-trash"></i>
									</span>
									<span class="text">삭제</span>
								</a>
								<a class="btn btn-sm btn-success btn-icon-split" id="btn-save">
									<span class="icon text-white-50">
										<i class="fas fa-check"></i>
									</span>
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
    
    mobiscroll.setOptions({
  locale: mobiscroll.localeKo,
  theme: 'windows',
  themeVariant: 'dark'
});

$(function () {
    mobiscroll.setOptions({
  locale: mobiscroll.localeKo,
  theme: 'windows',
  themeVariant: 'light'
});

//https://mobiscroll.com/docs/jquery/eventcalendar/api 참고,Eventcalendar API 
$(function () {
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
        $(".clicktitle").text(args.event.title);
        mobiscroll.toast({
          message: args.event.title,
        });
      },
      data: [
        {
            start: new Date(2024, 10, 18),
            end: new Date(2024, 10, 18),
            title: 'Conference',
            allDay: true,
            color: 'red'
        }
        ]
    })
    .mobiscroll('getInst');
});
  
});
  

$(function () {
    mobiscroll.setOptions({
        locale: mobiscroll.localeKo,
        theme: 'windows',
        themeVariant: 'light' // or dark
    });
});

  
</script>