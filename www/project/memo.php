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
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-2">
            <div class="card border-top-primary shadow h-100 py-">
                <div class="card-body pb-0 m-3 clicktitle">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<? include $_SERVER['DOCUMENT_ROOT']."/includes/main_bottom.php"?>
<script>
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
  
</script>