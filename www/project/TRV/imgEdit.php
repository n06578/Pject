<?php
include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header.php";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<link href="<?=$rootPath?>css/cropper.css?v=<?=time()?>" rel="stylesheet" />
<script src="<?=$rootPath?>js/cropper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<div class="main-box item-box h-90">
    <div class="h-100 p-3" id="mainCardDiv">
        <!-- cropper-image 내부의 img 태그를 사용 -->
        <cropper-canvas background style="height: 80vh;">
            <cropper-shade></cropper-shade>
            <cropper-image id="cropperImage" src="../../img/trv/listItem/item1.jpg" alt="Picture" initialCenterSize="cover" rotatable scalable skewable translatable></cropper-image>

            <cropper-handle action="move" plain></cropper-handle>
            <cropper-selection id="cropperSelection" initial-coverage="0.5" aspect-ratio="1" movable resizable>
                <cropper-grid role="grid" covered></cropper-grid>
                <cropper-crosshair centered></cropper-crosshair>
                <cropper-handle action="move" theme-color="rgba(255, 255, 255, 0.35)"></cropper-handle>
            </cropper-selection>
        </cropper-canvas>
    </div>
    <div class="cropper-viewers">
        <cropper-viewer id="screen" selection="#cropperSelection" style="width: 320px;"></cropper-viewer>
    </div>
    <input type="button" class="btn btn-white txt-8" id="ansAdd" value="저장">
    <div id="chkImg"></div>
</div>

<style>
.cropper-viewers {
  margin-top: 0.5rem;
}

.cropper-viewers > cropper-viewer {
  border: 1px solid var(--vp-c-divider);
  display: inline-block;
  margin-right: 0.25rem;
}
</style>

<script>
    document.getElementById("ansAdd").addEventListener("click", function() {
        var screenElement = document.getElementById('screen');
    
    // <cropper-viewer> 구역을 캡처하여 PNG로 변환
    domtoimage.toPng(screenElement, { useCanvas: true })
    .then(function(dataUrl) {
        var formData = new FormData();
        formData.append('image', dataUrl);

        // 서버에 이미지를 전송
        fetch('save_file.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log('이미지가 서버에 저장되었습니다!');
        })
        .catch(error => {
            console.error('이미지 전송 중 오류 발생:', error);
        });
    })
    .catch(function(error) {
        console.error('캡처 중 오류 발생:', error);
    });
    });


</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/includes/trv_bottom.php" ?>
