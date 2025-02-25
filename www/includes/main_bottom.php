
            </div> <!-- End of Main Content -->

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>포트폴리오 사이트 참고 &copy; startbootstrap.com</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
    <!-- Page level custom scripts -->
    <script src="<?=$rootPath?>js/demo/chart-area-demo.js"></script>
    <script src="<?=$rootPath?>js/demo/chart-pie-demo.js"></script>
    <script src="<?=$rootPath?>js/demo/chart-bar-demo.js"></script>
    <script src="<?=$rootPath?>js/demo/datatables-demo.js"></script>



    <!-- Bootstrap core JavaScript-->
    <script src="<?=$rootPath?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=$rootPath?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=$rootPath?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?=$rootPath?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=$rootPath?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?=$rootPath?>js/demo/datatables-demo.js"></script>
    
    <? include $rootPath."lib/function.php"; ?>
</body>
</html>
