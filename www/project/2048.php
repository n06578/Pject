<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include $_SERVER['DOCUMENT_ROOT']."/includes/main_header.php";
?>
<style>
    #dataTable tr{
        height:113px;
    }
    .table-bordered td, .table-bordered th {
        border: 10px solid #e3e6f0;
        width:100px;
        height:113px;
    }
    .card.cardIndex {
        border: 0px solid #e3e6f0;
        width: 100%;
        height: 100%;
        font-size: xx-large;
        align-items: center;
        text-align: center;
        font-weight: 700;
        line-height: 77px;
        backdrop-filter: blur(4px);
    }
    .bgA{background-color: #ffffff; color:#000000}
    .bgB{background-color: #e6e6e6; color:#000000}
    .bgC{background-color: #cccccc; color:#000000}
    .bgD{background-color: #b3b3b3; color:#000000}
    .bgE{background-color: #999999; color:#000000}
    .bgF{background-color: #808080; color:#000000}
    .bgG{background-color: #666666; color:#ffffff}
    .bgH{background-color: #4d4d4d; color:#ffffff}
    .bgI{background-color: #333333; color:#ffffff}
    .bgJ{background-color: #1a1a1a; color:#ffffff}
    .bgK{background-color: #0d0d0d; color:#ffffff}
    .bgL{background-color: #000000; color:#ffffff}
    
</style>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-80">2048</h1>
    <div class="row">
        <div class="col-xl-12 col-md-12 mb-2">
            <div class="card border-top-primary shadow h-100 py-">
                <div class="card-body pb-0 m-3">
                    <div class="row mb-2">
                        <div class="text-left col-6">
                            <a href="#" class="btn btn-light btn-icon-split">
                                <span class="icon text-gray-600">
                                    now Score
                                </span>
                                <span class="text scoreText">0</span>
                            </a>
                        </div>
                        <div class="text-right col-6">
                            <button class="btn btn-sm btn-secondary mr-2 btn-back">back</button>
                            <button class="btn btn-sm btn-light btn-restart">restart</button>
                        </div>
                    </div>
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0" height="80">
                        <? for($i = 0; $i<4; $i++){ ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <? } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/includes/main_bottom.php"?>
<script>
    let tableHtml = "";
    let resetDone = false; // 플래그 변수 초기화
    $(document).ready(function(){
        newNum();
        saveTableState();

        $(document).keydown(function(e) {
            const $table = $("#myTable");
            const $rows = $table.find("tr");
            const numCols = $rows.first().find("td").length;
            const numRows = $rows.length;
            var nowScore = parseInt($(".scoreText").html().replace(/\,/gi, ''));
            saveTableState();

            

            // 좌
            if (e.keyCode == 37) {
                $rows.each(function() {
                    let $cells = $(this).find("td");
                    let values = [];
                    $cells.each(function() {
                        let cellValue = extractNumber(this);
                        if (cellValue) {
                            values.push(cellValue);
                            setCellValue(this, null); // 기존 값 삭제
                        }
                    });

                    // 같은 값 합치기
                    for (let i = 0; i < values.length - 1; i++) {
                        if (values[i] === values[i + 1]) {
                            values[i] *= 2;
                            nowScore += values[i];
                            values.splice(i + 1, 1); // 중복 값 제거
                        }
                    }

                    // 합친 값을 다시 할당
                    values.forEach((value, index) => {
                        setCellValue($cells.eq(index), value);
                    });
                });
                if(tableHtml == $table.html()){var type = "noAdd";}
                newNum(type);
            }

            // 상
            if (e.keyCode == 38) {
                for (let col = 0; col < numCols; col++) {
                    let values = [];
                    $rows.each(function() {
                        let cellValue = extractNumber($(this).find("td").eq(col));
                        if (cellValue) {
                            values.push(cellValue);
                            setCellValue($(this).find("td").eq(col), null); // 기존 값 삭제
                        }
                    });

                    // 같은 값 합치기
                    for (let i = 0; i < values.length - 1; i++) {
                        if (values[i] === values[i + 1]) {
                            values[i] *= 2;
                            nowScore += values[i];
                            values.splice(i + 1, 1);
                        }
                    }

                    // 합친 값을 다시 할당
                    values.forEach((value, index) => {
                        setCellValue($rows.eq(index).find("td").eq(col), value);
                    });
                }
                if(tableHtml == $table.html()){var type = "noAdd";}
                newNum(type);
            }

            // 우
            if (e.keyCode == 39) {
                $rows.each(function() {
                    let $cells = $(this).find("td");
                    let values = [];
                    $cells.each(function() {
                        let cellValue = extractNumber(this);
                        if (cellValue) {
                            values.push(cellValue);
                            setCellValue(this, null); // 기존 값 삭제
                        }
                    });

                    // 같은 값 합치기
                    for (let i = values.length - 1; i > 0; i--) {
                        if (values[i] === values[i - 1]) {
                            values[i] *= 2;
                            nowScore += values[i];
                            values.splice(i - 1, 1);
                        }
                    }

                    // 합친 값을 다시 할당
                    let startCol = numCols - values.length;
                    values.forEach((value, index) => {
                        setCellValue($cells.eq(startCol + index), value);
                    });
                });
                if(tableHtml == $table.html()){var type = "noAdd";}
                newNum(type);
            }

            // 하
            if (e.keyCode == 40) {
                for (let col = 0; col < numCols; col++) {
                    let values = [];
                    $rows.each(function() {
                        let cellValue = extractNumber($(this).find("td").eq(col));
                        if (cellValue) {
                            values.push(cellValue);
                            setCellValue($(this).find("td").eq(col), null); // 기존 값 삭제
                        }
                    });

                    // 같은 값 합치기
                    for (let i = values.length - 1; i > 0; i--) {
                        if (values[i] === values[i - 1]) {
                            values[i] *= 2;
                            nowScore += values[i];
                            values.splice(i - 1, 1);
                        }
                    }

                    // 합친 값을 다시 할당
                    let startRow = numRows - values.length;
                    values.forEach((value, index) => {
                        setCellValue($rows.eq(startRow + index).find("td").eq(col), value);
                    });
                }
                if(tableHtml == $table.html()){var type = "noAdd";}
                newNum(type);
            }
            $(".scoreText").html(Format_comma(nowScore));
        });

        $(".btn-back").click(function(){
            restoreTableState();
        })

        $(".btn-restart").click(function(){
            if(confirm("다시 시작하시겠습니까?")){
                $("table td").text('');
                newNum();
            }
        })

        function newNum(type) {
            const emptyCells = [];
            $("#myTable").find("tr").each(function() {
                $(this).find("td").each(function() {
                    if ($(this).html().trim() === "") {
                        emptyCells.push($(this));
                    }
                });
            });

            if (emptyCells.length > 0) {
                if(type != "noAdd" ){
                    const randomIndex = Math.floor(Math.random() * emptyCells.length);
                    const randomValue = Math.random() < 0.7 ? 2 : 4; // 2가 70%, 4가 30% 확률로 생성
                    setCellValue(emptyCells[randomIndex], randomValue);
                }
            } else {
                let isGameOver = true; // 게임 종료 여부를 추적

                $('#myTable td').each(function () {
                    const currentText = $(this).text().trim();
                    const currentValue = parseInt(currentText, 10);
                    const neighborValues = [];

                    // Get current cell's position
                    const colIndex = $(this).index();
                    const row = $(this).parent();

                    // Check above
                    if (row.prev().length > 0) {
                    const aboveText = row.prev().children().eq(colIndex).text().trim();
                    const aboveValue = parseInt(aboveText, 10);
                    neighborValues.push(aboveValue);
                    }

                    // Check below
                    if (row.next().length > 0) {
                    const belowText = row.next().children().eq(colIndex).text().trim();
                    const belowValue = parseInt(belowText, 10);
                    neighborValues.push(belowValue);
                    }

                    // Check left
                    if ($(this).prev().length > 0) {
                    const leftText = $(this).prev().text().trim();
                    const leftValue = parseInt(leftText, 10);
                    neighborValues.push(leftValue);
                    }

                    // Check right
                    if ($(this).next().length > 0) {
                    const rightText = $(this).next().text().trim();
                    const rightValue = parseInt(rightText, 10);
                    neighborValues.push(rightValue);
                    }

                    // If any neighbor has the same value, the game is not over
                    const canMerge = neighborValues.some(value => value === currentValue);

                    if (canMerge) {
                    isGameOver = false; // 근처에 합칠 수 있는 셀이 있다면 게임은 종료되지 않음
                    }
                });

                // If no mergeable cells are found, alert game over
                if (isGameOver) {
                    var nowScore = parseInt($(".scoreText").html().replace(/\,/gi, ''));
                    if (!resetDone) { // 아직 초기화가 안 되었을 때만 실행
                        resetDone = true; // 플래그를 true로 설정하여 재실행 방지
                        $.ajax({
                            type: "POST",
                            url: "ajax/ajax_2048.php", // 데이터를 가져올 서버 URL
                            data: "scrore="+nowScore,
                            success: function(data) {
                                if(confirm("다시 시작하시겠습니까?")){
                                    $("table td").text('');
                                    newNum();
                                }
                                resetDone = false; // 플래그를 true로 설정하여 재실행 방지
                            }
                        });
                    }
                }
            }
        }
        // 숫자 추출 함수 (div 안에서 숫자만 가져오기)
        function extractNumber(cell) {
            const html = $(cell).html();
            const match = html.match(/\d+/); // 숫자만 추출
            return match ? parseInt(match[0], 10) : null;
        }

        // 테이블 HTML을 저장하는 함수
        function saveTableState() {
            const $table = $("#myTable");
            tableHtml = $table.html();  // 테이블 HTML 상태를 저장
        }

        // 뒤로가기 버튼 이벤트 처리
        function restoreTableState() {
            const $table = $("#myTable");
            if (tableHtml) {
                $table.html(tableHtml);  // 저장된 HTML로 테이블을 복원
            }
        }


        // 값 설정 함수 (div로 감싸기)
        function setCellValue(cell, value) {

            // 숫자와 색상 매핑
            const colorValue = [2, 4, 8, 16, 32, 64, 128, 256, 512, 1024, 2048, 4096];
            const color = ["bgA","bgB","bgC","bgD","bgE","bgF","bgG","bgH","bgI","bgJ","bgK","bgL" ];

            if (value) {
                const index = colorValue.indexOf(value);
                const bgColor = index !== -1 ? color[index] : "bgL"; // 기본 색상 설정
                $(cell).html(`<div class="card cardIndex ${bgColor}">${value}</div>`);
            } else {
                $(cell).html(""); // 값이 없으면 빈 셀
            }
        }
    })
</script>