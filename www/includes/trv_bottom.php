
<? include $rootPath."project/TRV/modal.php"; ?>

</div> <!-- End of Main Content -->
<?if($baseName[0] == "login" || $baseName[0] == "join"){ // 로그인 회원가입 bottom?>
    <div class="text-center" id="homeBtn" onclick="location.href='trvmain2.php'"><i class="fas fa-home"></i> 홈으로</div>
<?}else if($baseName[0] == "myHome"){ // 내 프로필 bottom?>
    <div class="text-center <?=$cardChkShow?> position2" id="cardDelBtn"><i class="fas fa-trash-alt"></i> 삭제</div>
    <div class="text-center" id="writeBtn" onclick="location.href='write.php'"><i class="fas fa-pen"></i> 등록하기</div>
<?}?>
<?
if($showFooter){
?>
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<?}?>
</div>
</div>

<!-- <div id="showTrvInfo"></div> -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.php">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?=$rootPath?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?=$rootPath?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?=$rootPath?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?=$rootPath?>vendor/datatables/dataTables.bootstrap4.min.js"></script>


<? include $rootPath."lib/function.php"; ?>
</body>
</html>
<script>
    <?if($baseName[0] == "trvmain2") {?>
    $(function(){
        setTimeout(function() {
            $("#roadingImg").addClass("d-none");
            $(".trvMainTop").removeClass("d-none");
            $(".main-box").removeClass("d-none");
        }, 1000);
    })
    <?}else{?>
        $(".trvMainTop").removeClass("d-none");
        $(".main-box").removeClass("d-none");
    <?}?>
</script>