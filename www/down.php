
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
include "includes/main_header.php";

?>
<div class="container-fluid">
    <section class="content">
        <form action="down_add.php" method="post" enctype="multipart/form-data">
            <label>초중종기준서</label><br>
            <input type="file" name="upimg1" id="upimg1" class="form-control">
            <input type="hidden" name="exist1" value="">
            <span id="currImg1">
                <?
                $que = "select * from fileList";
                $res = mysql_query($que);
                while($row = mysql_fetch_array($res)){
                    if($row['filename'] != "" && strpos($row['filename'],"pdf")===false){?>
                    <a href='/file/<?=$row['filename']?>' target='_blank'><?=$row['realName']?></a>&nbsp;<a href='javascript:delImg1()'>삭제</a>";
                        <img src='/file/<?=$row['filename']?>' width='260'>&nbsp;<a href='javascript:delImg1()'>삭제</a>
                    <?}else{
                        
                        if (strpos($row['filename'],"pdf")!==false) {
                            ?>
                            <a href='/file/<?=$row['filename']?>' target='_blank'><?=$row['realName']?></a>&nbsp;<a href='javascript:delImg1()'>삭제</a>";
                            <?
                        }
                        else {
                            echo "등록된 파일이 없습니다";
                        }
                    }
                }
                ?>
            </span>
            <button type="submit">업로드</button>
        </form>
    </section>
</div>
<? include "includes/main_bottom.php"?>

<script language="javascript">

$(document).ready(function($) {
    $('#multiselect').multiselect({
		sort: false,
		submitAllRight:true
	});
});
										
window.onload = function() {
	var fileInput = document.getElementById('upimg');
	var fileDisplayArea = document.getElementById('currImg');
	fileInput.addEventListener('change', function(e) {
		var file = fileInput.files[0];
		var imageType = /image.*/;

		if (file.type.match(imageType)) {
			var reader = new FileReader();

			reader.onload = function(e) {
				fileDisplayArea.innerHTML = "";

				var img = new Image();
				img.src = reader.result;
				img.style.width = '260px';   //이미지 width
				
				fileDisplayArea.appendChild(img);
			}

			reader.readAsDataURL(file);
		}
	});


	var fileInput2 = document.getElementById('upimg2');
	var fileDisplayArea2 = document.getElementById('currImg2');


	fileInput2.addEventListener('change', function(e) {
		var file = fileInput2.files[0];
		var imageType = /image.*/;

		if (file.type.match(imageType)) {
			var reader = new FileReader();

			reader.onload = function(e) {
				fileDisplayArea2.innerHTML = "";

				var img = new Image();
				img.src = reader.result;
				img.style.width = '260px';   //이미지 width
				fileDisplayArea2.appendChild(img);
			}

			reader.readAsDataURL(file);
		}
	});
}

$(function() {
	$(".select2").select2();
	var goods_gubun = $("select[name='goods_gubun']");
	goods_gubun.select2("val",goods_gubun.data("gubun"));
	
	$("#img_chk").change(function(e){
		if($(this).is(":checked")) {
			modifyInput("없음",true,"#eee");
		} else {
			modifyInput("",false,"white");
		}
	});
});

function delImg(v){
	$("#currImg").text("");
	$("input[name=exist]").val("Y");
}

function delImg1(){
	$("#currImg1").text("");
	$("input[name=exist1]").val("Y");
}

function delImg2(){
	$("#currImg2").text("");
	$("input[name=exist2]").val("Y");
}

function delImg3(){
	$("#currImg3").text("");
	$("input[name=exist3]").val("Y");
}
function submitForm() {
	
	var frm = document.forms[0];
	
	if (trim(frm.pnum.value)=="") {
		alert("품번을 입력하세요");
		frm.pnum.focus();
		return false;
	}
	
	if (trim(frm.pname.value)=="") {
		alert("품명을 입력하세요");
		frm.pname.focus();
		return false;
	}
	$("#multiselect_to option").prop("selected","selected");
	frm.submit();
}

$("#useBox").click(function(){
	if($(this).is(":checked")) {
		$("#box_unit").val("0");
	}else{
		$("#box_unit").val("<?=$row['box_unit']?>");
	}
});

$(".client").change(function(){
	var cs_seq = $(this).find("option:selected").data("seq");
	$("input[name=cs_seq]").val(cs_seq);
});
</script>