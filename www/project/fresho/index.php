<?php	
	session_start();
	
?>

 <?php

	error_reporting(E_ALL);

	ini_set("display_errors",1);

	
	#ini_set("include_path='.:/usr/share/pear:/usr/share/php'",1);
	require_once ( 'php/config.php');
	require_once ( 'php/mysql.lib.php');
	#require_once '../php/config.php';

	#require_once '../php/mysql.lib.php';

	$link = getNewsConn();

?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="UTF-8">
	<title>freshO(식자재)</title>
	<link rel="shortcut icon" type="image/x-icon" href="main(image)/logo(finish).png" />
	<link rel ="stylesheet" type="text/css" href="css/index.css">
	<meta property="og:locale" content="ko" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="freshO(식자재)" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="Fresho" />
	<meta property="og:image" src="main(image)/logo(finish).png" />
	<link href="css/index.css" rel="stylesheet" type="text/css" >
	<link href="css/flexslider.css" rel="stylesheet" type="text/css" >
	
	

	
</head>
	
<body class="home page">
	<script type="text/javascript">
		<!-- alert('어서오세요. 우측 상단의 회원가입 버튼을 눌러주세요.');  -->
		var result = confirm('어서오세요. 우측 상단의 회원가입 버튼을 눌러주세요. \n 취소를 누르면 로그인창으로 이동합니다.');
		if(result) {
			<!-- alert("성공"); -->
			<!-- window.location.href = "login.html"; -->
		
		}
		else {
		<!-- alert("취소"); -->
			window.location.href ="login.html";
		}
		<!-- alert(returnValue); -->
		
	</script>
	
		<header class="header">

					<div class="join">  
					<img id="modal_open_btn" class="join-btn" src="main(image)/join.png" alt=""></button> 
					<img id="serch2" src="main(image)/serch2.png" alt="serch2"/>
					<div class = "hello">
					<?php 
					if(!isset($_SESSION['phone']) || !isset($_SESSION['pwd'])) {
					echo "<p>회원가입 후 로그인을 해 주세요. </p>";
					} else {
					$username = $_SESSION['phone'];
					echo "<p><strong><font size=4>$username</strong>님 환영합니다.";
					echo "<a href=\"logout.php\">[로그아웃]</a></p>";
						}
					?>
					</div>
					<input type="text" class="cookse2" />
					<img class="serch2" id="ok2" src="main(image)/ok.png" alt="ok2"/>
					</div>
	
					
	
					
			<div class="header-box">
				<div class="header-left">
					<div class="logo">
						<a href="http://fresho.dothome.co.kr">
							<img class="logo-static" src="main(image)/logo(finish).png" alt="freshO"/>
						</a>
						
					</div>
				</div>
				
				
				
				
					<div class="nav-box">
						<ul class="menu-box">
							<li><a href="list.html"/>
								<img class="menu" src="main(image)/fresh.png" alt="fresh"/></a></li>
							<li><a href="cook.html"/>
								<img class="menu" src="main(image)/cook.png" alt="cook"/></a></li>
							<li><a href="cafe.html"/>
								<img class="menu" src="main(image)/cafe.png" alt="cafe"/></a></li>
							<li><a href="mypage.html"/>
								<img class="menu" src="main(image)/mypage.png" alt="mypage"/></a></li>
							<li><a href="QnA.html"/> 
							<!-- 예시 -->
								<img class="menu" src="main(image)/QnA.png" alt="QnA"/></a></li>
							<li><a class="btn" href="login.html" target="self"> 
								<img class="login-btn" src="main(image)/login.png" alt="login"/></a></li></a> 
						</ul>
					</div>
				
					
			</div>
			
			
			

	</header>
	
	
	<div class="poket">
				<legend>총가격</legend> 
	</div>
	
	
					<div class = "first-box">								
							<div class ="flexslider">
							

									<img class="left" src="main(image)/left.png" alt="left"/></a></li>
									<ul class="slides">
										<li><img class="ad" src="main(image)/456_.png" alt="login"/></a></li>
										<li><img class="ad" src="main(image)/123.png" alt="login"/></a></li>

									</ul>
									<img class="right" src="main(image)/right.png" alt="right"/></a></li>
							</div>
					</div>
					
					<div id="modal">
					<script>
					function check_pw() 
					{
						var pw = document.getElementById('pw').value;
						var SC = ["!","@","#","$","%"];
						var check_SC = 0; //특수문자 체크변수. 특수문자 발견 시 1, 발견되지 않을 시 0
						
						 if(pw.length < 5 || pw.length>16){
							window.alert('비밀번호는 5글자 이상, 16글자 이하만 이용 가능합니다.');
							document.getElementById('pw').value='';
						}
						  for(var i=0;i<SC.length;i++){
							if(pw.indexOf(SC[i]) != -1){ //사용자가 입력한 pw에 SC[i]가 있는지 확인. 존재하면 존재위치 반환. 그렇지 않으면 -1반환.
							check_SC = 1; //SC에 들어있는 문자열이 존재하면 check_SC를 1로 만들어줌.
								}	
							}
						 if(check_SC == 0){  //SC가 0이면 비밀번호 초기화
							window.alert('!,@,#,$,% 의 특수문자가 들어가 있지 않습니다.')
							document.getElementById('pw').value='';
						} 
							
						 if(document.getElementById('pw').value !='' && document.getElementById('pw2').value!=''){  //pw칸이 빈칸이 아닐 경우에
						 
							if(document.getElementById('pw').value==document.getElementById('pw2').value){
								document.getElementById('check').innerHTML='비밀번호가 일치합니다.'
								document.getElementById('check').style.color='blue';
							}
							else{
							document.getElementById('check').innerHTML='비밀번호가 일치하지 않습니다.';
							document.getElementById('check').style.color='red';
							}
						}
						
					}
					</script>
					<div class="modal_content">
						<img class="fojoin" src="main(image)/join.png" alt=""><br />
					    <form method="post" action="join.php" enctype="multipart/form-data">
							<fieldset>
								<legend>정보를 입력해주세요.</legend>
								이름  <input type="text" name ="name"  /><br />
								전화번호 <input type="tel" name ="phone"  placeholder="010-0000-0000"><br />
								주소 <input type="text" name ="address" /><br />
								연령 <input type="number" name ="age"  /><br />
								비밀번호 <input type="password" name ="pass" id="pw" onchange="check_pw()" /><br />
								비밀번호 확인 <input type="password" name ="checkpass" id="pw2" onchange="check_pw()" >&nbsp;<span id="check"></span>
								
								
						</fieldset>
						<button type="submit" id="submit_btn" >가입완료</button><br />
						<p>가입한 적이 있으신 분은 로그인버튼을 눌러주세요.</p>
						<button type="button" id="login2_btn" onClick="location.href='login.html'" >로그인</button>
						</form>
						
					    												
						<button type="button" id="modal_close_btn">닫기</button>       
					</div>     
					<div class="modal_layer"></div>
					</div>
					
					<script>
					
					document.getElementById("modal_open_btn").onclick = function() {
						document.getElementById("modal").style.display="block";
					}
				   
					document.getElementById("modal_close_btn").onclick = function() {
						document.getElementById("modal").style.display="none";
					}   
					
					</script>
					
					<script src="js/jquery.js"> </script>
					<script src="js/jquery.flexslider.js"></script>
					<script>
						$(window)
						.load(function () {
							$('.flexslider')
							.flexslider({
								animation : "slide"
								});
							});
					</script>
					
					</body>

</html>	


				