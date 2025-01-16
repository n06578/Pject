<div class="search-container">
  <div class="search-header">
    <input type="text" placeholder="지역명 검색 예) 서울, 서초구" id="searchInput" />
    <button>초기화</button>
  </div>

  <div class="category-container">
    <div class="category" id="category1">
      <ul>
        <!-- 대분류 항목이 동적으로 생성 -->
      </ul>
    </div>
    <div class="category" id="category2">
      <ul>
        <!-- 중분류 항목이 동적으로 생성 -->
      </ul>
    </div>
    <div class="category" id="category3">
      <ul>
        <!-- 소분류 항목이 동적으로 생성 -->
      </ul>
    </div>
  </div>
</div>

<script> // Geonames API 사용자 이름 (여기에는 실제 사용자 이름을 입력하세요)
    const username = 'n06578';

    // Geonames API URL (countryInfo 엔드포인트)
    const url = `http://api.geonames.org/countryInfo?formatted=true&lang=eng&username=${username}&style=full`;

    // API 요청을 보내는 함수
    fetch(url)
        .then(response => response.json())  // JSON 형식으로 응답 받기
        .then(data => {
            // 데이터를 성공적으로 받아온 후, 처리할 코드
            const countries = data.geonames;
            // let output = '<ul>';

            // 국가 정보 출력
            countries.forEach(country => {
              console.log(country);
                // output += `
                //     <li>
                //         <strong>Country:</strong> ${country.countryName} <br>
                //         <strong>Code:</strong> ${country.countryCode} <br>
                //         <strong>Continent:</strong> ${country.continentName} <br>
                //         <strong>Capital:</strong> ${country.capital} <br>
                //         <strong>Population:</strong> ${country.population} <br>
                //         <strong>Currency:</strong> ${country.currencyName} <br>
                //         <strong>Timezone:</strong> ${country.timezone} <br>
                //     </li><br>
                // `;
            });

            // output += '</ul>';
            // document.getElementById('countryInfo').innerHTML = output;
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('countryInfo').innerHTML = 'Error fetching data.';
        });

  // DOM Elements
  const category1 = document.getElementById("category1");
  const category2 = document.getElementById("category2");
  const category3 = document.getElementById("category3");

  // 1. 대분류 항목을 동적으로 추가
  const addCategory1Items = () => {
    const ul = category1.querySelector("ul");
    const items = Object.keys(data);
    ul.innerHTML = items.map((item) => `<li data-value="${item}">${item}</li>`).join("");
  };
  
  // 2. 대분류 선택 시 중분류 업데이트
  category1.addEventListener("click", (e) => {
    if (e.target.tagName === "LI") {
      selectCategory(e.target, category1);
      const selected = e.target.dataset.value;
      updateCategory(category2, Object.keys(data[selected]));
      clearCategory(category3);
    }
  });

  // 3. 중분류 선택 시 소분류 업데이트
  category2.addEventListener("click", (e) => {
    if (e.target.tagName === "LI") {
      selectCategory(e.target, category2);
      const selected1 = document.querySelector("#category1 .selected").dataset.value;
      const selected2 = e.target.dataset.value;
      updateCategory(category3, data[selected1][selected2]);
    }
  });

  // 선택된 항목 스타일 적용
  function selectCategory(target, category) {
    category.querySelectorAll("li").forEach((li) => li.classList.remove("selected"));
    target.classList.add("selected");
  }

  // 카테고리 업데이트
  function updateCategory(category, items) {
    const ul = category.querySelector("ul");
    ul.innerHTML = items.map((item) => `<li data-value="${item}">${item}</li>`).join("");
  }

  // 하위 카테고리 초기화
  function clearCategory(category) {
    category.querySelector("ul").innerHTML = "";
  }

  // 초기화 시 대분류 항목 추가
  addCategory1Items();
</script>
