
<?php
// require_once $_SERVER['DOCUMENT_ROOT'].'/lib/configure.php';
// include $_SERVER['DOCUMENT_ROOT']."/includes/trv_header_nologo.php";
?><style>
    .category > ul > li > img {
        width: 16px;
        margin: 0px 3px 2px 0px;
    }
    .category > ul > li {
      font-size: 13px;
	  text-align: left;
  }
</style>
<div class="search-container">
  <div class="search-header">
    <!-- <input type="text" placeholder="지역명 검색 예) 서울, 서초구" id="searchInput" /> -->
	<button id="chooseBtn">선택</button>
    <button id="searchClose">닫기</button>
  </div>

  <div class="category-container">
    <div class="category" >
      <ul id="category1">
        <!-- 대분류 항목이 동적으로 생성 -->
      </ul>
    </div>
    <div class="category">
      <ul id="category2">
        <!-- 중분류 항목이 동적으로 생성 -->
      </ul>
    </div>
    <div class="category">
      <ul id="category3">
        <!-- 소분류 항목이 동적으로 생성 -->
      </ul>
    </div>
  </div>
</div>

<script> // Geonames API 사용자 이름 (여기에는 실제 사용자 이름을 입력하세요)
    let countryArr = new Array();
    fetch('https://restcountries.com/v3.1/all', {
        headers: { 'accept-language': 'ko' } // 한국어로 요청
    }).then(response => response.json())
    .then(data => {
        // const select = document.getElementById('country-select');
        data.sort((a, b) => a.translations.kor.common.localeCompare(b.translations.kor.common));
        data.forEach(country => { 
            $("#category1").append("<li class='li1' data-code='"+country.cca2+"' data-lng='"+country.latlng[1]+"' data-lat='"+country.latlng[0]+"'><img src='"+country.flags.png+"'>"+country.translations.kor.common+"</li>");
        });
    })
    .catch(error => console.error('Error fetching country data:', error));
	// 나라 클릭 → 해당 나라의 도시 불러오기
	$(document).on("click", ".li1", function() {
		let countryCode = $(this).data("code"); 
		$("#category2").empty();
		$("#category3").empty();
		getCities(countryCode);
		$(".li1").not(this).removeClass("chkAck");
		$(this).addClass("chkAck");
	});

	function getCities(countryCode) {
		fetch(`http://api.geonames.org/searchJSON?country=${countryCode}&featureClass=P&maxRows=1000&lang=ko&username=n06578`)
		.then(response => response.json())
		.then(data => {
			data.geonames.forEach(city => {
				// 영어인지 체크 (단순히 영어 알파벳인지 확인)
				const isEnglish = /^[A-Za-z]+$/.test(city.name);
				var cityName = city.name; 
				if (isEnglish) { 
				// cityName = trans(city.name); 
			}
			$("#category2").append("<li class='li2' data-id='"+city.geonameId+"' data-lng='"+city.lng+"' data-lat='"+city.lat+"'>"+cityName+"</li>");
		});
	})
	.catch(error => console.error('도시 데이터를 가져오는 중 오류 발생:', error));
	}

	// 도시 클릭 → 해당 도시의 행정구역 불러오기
	$(document).on("click", ".li2", function() {
		let cityId = $(this).data("id");
		$("#category3").empty();
		getRegions(cityId);
		$(".li2").not(this).removeClass("chkAck");
		$(this).addClass("chkAck");
	});

	function getRegions(cityId) {
		fetch(`http://api.geonames.org/childrenJSON?geonameId=${cityId}&accept-language=ko&username=n06578`)
		.then(response => response.json())
		.then(data => {
			if (data.geonames.length === 0) {
				$("#category3").html("");
				$("#category3").append("<li>행정구역 정보 없음</li>");
			} else {
				data.geonames.forEach(region => {
					$("#category3").append("<li class='li3' data-lng='"+region.lng+"' data-lat='"+region.lat+"'>"+region.name+"</li>");
				});
			}
		})
		.catch(error => console.error('행정구역 데이터를 가져오는 중 오류 발생:', error));
	}

	// 도시 클릭 → 해당 도시의 행정구역 불러오기
	$(document).on("click", ".li3", function() {
		$(".li3").not(this).removeClass("chkAck");
		$(this).addClass("chkAck");
	});

	$(document).on("click","#chooseBtn",function(){
		var area1 = $("#category1").find(".chkAck").text();
		var area2 = $("#category2").find(".chkAck").text();
		var area3 = $("#category3").find(".chkAck").text();
		var inputTxt = "";
		if(area1 == ""){
			pAlert("error","","항목을 선택하세요.","choose");
		}else{
			inputTxt = area1;
			var lng = $("#category1").find(".chkAck").data('lng');
			var lat = $("#category1").find(".chkAck").data('lat');
			if(area2 != ""){ 
				inputTxt += " > "+ area2; 
				lng = $("#category2").find(".chkAck").data('lng');
				lat = $("#category2").find(".chkAck").data('lat');
			}
			if(area3 != ""){ 
				inputTxt += " > "+ area3; 
				lng = $("#category3").find(".chkAck").data('lng');
				lat = $("#category3").find(".chkAck").data('lat');
			}
			$(".searchInput").val(inputTxt);
			$("#searchModal").modal("hide");

			$.ajax({
            type: "GET",
            url: "ajax/ajax_search.php", // 데이터를 가져올 서버 URL
            data: "area1="+area1+"&area2="+area2+"&area3="+area3+"&lat="+lat+"&lng="+lng,
            success: function(data) {
				console.log(data);
            }
        });
		}
	})

	function trans(regionName){
		// return regionName+"번역필요";
		const apiKey = 'AIzaSyB88QEAuQKDndORu1G9r_Ht7Xy4Lqd99lw';
		// 영어일 경우 번역 API 호출
		fetch(`https://translation.googleapis.com/language/translate/v2?key=${apiKey}`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify({
				q: regionName,   // 번역할 텍스트
				target: 'ko',         // 번역할 언어 (한국어)
			}),
		})
		.then(response => response.json())
		.then(data => {
			const translatedText = data.data.translations[0].translatedText;
			return translatedText;
		})
		.catch(error => console.error('번역 오류:', error));
	}
</script>
