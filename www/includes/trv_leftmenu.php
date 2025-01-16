<div id="wrapper">
        <div class="topbar" style="position: absolute; top:0;">
            <!-- 왼쪽 서브 메뉴 -->
            <div class="left_sub_menu d-none">
                <div class="sub_menu">
                    <!-- <input type="search" name="SEARCH" placeholder="SEARCH">
                    <br> -->
                    <div class="topDiv">
                            <a href="trvmain2.php" class="btn">
                                <i class="fas fa-home"></i>
                                <br>
                                <span class="text">홈</span>
                            </a>

                            <a href="myCal.php" class="btn">
                                <i class="far fa-calendar-alt"></i>
                                <br>
                                <span class="text">일정</span>
                            </a>
                        <br>
                        <a href="myHome.php" class="btn">
                            <i class="fas fa-plane"></i>
                            <br>
                            <span class="text">프로필</span>
                        </a>
                    <? if($_SESSION['loginYn'] == "Y" ) {?>
                        <a href="logout.php" class="btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <br>
                            <span class="text">logout</span>
                        </a>
                    <?}else{?>
                        <a href="login.php" class="btn">
                            <i class="fas fa-sign-out-alt"></i>
                            <br>
                            <span class="text">login</span>
                        </a>
                    <?}?>
                    </div>
                    <h2></h2>
                    <ul class="big_menu">
                        <li>내 게시물 <i class="arrow fas fas2 fa-angle-right"></i></li>
                        <ul class="small_menu">
                            <li><a href="myHome.php">게시물</a></li>
                            <li><a href="myHome.php">최근 본 게시물</a></li>
                            <li><a href="myHome.php">찜한 게시물</a></li>
                            <li><a href="myHome.php">일정에 추가된 게시물</a></li>
                        </ul>
                    </ul>
                    <!-- <ul class="big_menu">
                        <li>MENU 2 <i class="arrow fas fas2 fa-angle-right"></i></li>
                        <ul class="small_menu">
                            <li><a href="#">소메뉴2-1</a></li>
                            <li><a href="#"></a>소메뉴2-2</a></li>
                        </ul>
                    </ul> -->
                    <ul class="big_menu">
                        <li><a href="monE.php">문의사항</a></li>
                    </ul>
                    <ul class="big_menu">
                        <li><a href="gongJi.php">공지사항</a></li>
                    </ul>
                </div>
            </div>
            <div class="overlay"></div>
        </div>

<div class="modal " id="imgModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-body _modalBody p-0" ng-switch="invitationStep" >
        <div class="modal-content" >
                   <textarea name="editor1"></textarea>

            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        $(".left_sub_menu").hide();
        $(".left_sub_menu").removeClass("d-none");
        $(".has_sub").click(function () {
            $(".left_sub_menu").fadeToggle(300);
        });
        // 왼쪽메뉴 드롭다운
        $(".sub_menu ul.small_menu").hide();
        $(".sub_menu ul.big_menu").click(function () {
            $("ul", this).slideToggle(300);
        });
        // 외부 클릭 시 좌측 사이드 메뉴 숨기기
        $('.overlay').on('click', function () {
            $('.left_sub_menu').fadeOut();
            $('.hide_sidemenu').fadeIn();
        });
    });
</script>