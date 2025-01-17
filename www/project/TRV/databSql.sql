
--
-- 테이블의 인덱스 `TjoinTbl`
--
CREATE TABLE `TjoinTbl` (
  `seq` int UNSIGNED NOT NULL,
  `userId` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자아이디',
  `userName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자명',
  `nickName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자닉네임',
  `joinType` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자닉네임',
  `userPassWord` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자비밀번호',
  `userCountry` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '사용자나라',
  `joinDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='회원가입테이블';


ALTER TABLE `TjoinTbl`
  ADD PRIMARY KEY (`seq`);


ALTER TABLE `TjoinTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TloginTbl`
--

CREATE TABLE `TloginTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `recentLoginIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '최근 로그인 아이피',
  `recentLoginDateTime` datetime NOT NULL COMMENT '최근 로그인 시간',
  `recentLogoutIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '최근 로그아웃 아이피',
  `recentLogoutDateTime` datetime NOT NULL COMMENT '최근 로그아웃 시간',
  `joinDateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='로그인테이블';


ALTER TABLE `TloginTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TloginTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TselfInfoTbl`
--

CREATE TABLE `TselfInfoTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `keyword` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '관심 키워드',
  `userAge` int UNSIGNED NOT NULL COMMENT '사용자 나이',
  `selfPresent` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '한줄 소개',
  `inTrvCnt` int UNSIGNED NOT NULL COMMENT '국내여행횟수',
  `outTrvCnt` int UNSIGNED NOT NULL COMMENT '국외여행횟수',
  `blackListYn` int UNSIGNED NOT NULL COMMENT '블랙리스트여부'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='개인정보테이블';


ALTER TABLE `TselfInfoTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TselfInfoTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TmoneTbl`
--
CREATE TABLE `TmoneTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `writeDateTime` datetime NOT NULL COMMENT '글작성일시',
  `writeContents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '글내용',
  `writePassWord` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '글비밀번호',
  `writeTitle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '글제목',
  `writeIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '글작성 아이피',
  `declareCnt` int UNSIGNED NOT NULL COMMENT '신고횟수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='문의사항테이블';

ALTER TABLE `TmoneTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TmoneTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TmoneAnswerTbl`
--
CREATE TABLE `TmoneAnswerTbl` (
  `seq` int UNSIGNED NOT NULL,
  `moneSeq` int UNSIGNED NOT NULL COMMENT '문의사항테이블 고유값',
  `answerDateTime` datetime NOT NULL COMMENT '답변일시',
  `answerContents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '답변내용',
  `answerTitle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '답변제목',
  `answerIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '답변장소 아이피'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='문의답변사항테이블';

ALTER TABLE `TmoneAnswerTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TmoneAnswerTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TgongjiTbl`
--
CREATE TABLE `TgongjiTbl` (
  `seq` int UNSIGNED NOT NULL,
  `writeDateTime` datetime NOT NULL COMMENT '글작성일시',
  `writeContents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '글내용',
  `writeTitle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '글제목',
  `writeIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '글작성 아이피',
  `likeCnt` int UNSIGNED NOT NULL COMMENT '좋아요횟수',
  `hateCnt` int UNSIGNED NOT NULL COMMENT '싫어요횟수',
  `viewCnt` int UNSIGNED NOT NULL COMMENT '조회수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='공지사항테이블';


ALTER TABLE `TgongjiTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TgongjiTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TcommuniTbl`
--
CREATE TABLE `TcommuniTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `writeDateTime` datetime NOT NULL COMMENT '글작성일시',
  `writeContents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '글내용',
  `country` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '국가',
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '도시',
  `likeCnt` int UNSIGNED NOT NULL COMMENT '좋아요횟수',
  `hateCnt` int UNSIGNED NOT NULL COMMENT '싫어요횟수',
  `viewCnt` int UNSIGNED NOT NULL COMMENT '조회수',
  `declareCnt` int UNSIGNED NOT NULL COMMENT '신고횟수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='커뮤니티테이블';

ALTER TABLE `TcommuniTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TcommuniTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TcommuniAnswerTbl`
--
CREATE TABLE `TcommuniAnswerTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `conSeq` int UNSIGNED NOT NULL COMMENT '커뮤니티테이블 고유값',
  `conType` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '커뮤니티타입',
  `answerDateTime` datetime NOT NULL COMMENT '답변일시',
  `answerContents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '답변내용',
  `answerIp` varchar(11) COLLATE utf8mb4_general_ci NOT NULL COMMENT '답변장소 아이피',
  `likeCnt` int UNSIGNED NOT NULL COMMENT '좋아요횟수',
  `hateCnt` int UNSIGNED NOT NULL COMMENT '싫어요횟수',
  `declareCnt` int UNSIGNED NOT NULL COMMENT '신고횟수'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='커뮤니티답변테이블';

ALTER TABLE `TcommuniAnswerTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TcommuniAnswerTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;

--
-- 테이블의 인덱스 `TlikeHateTbl`
--
CREATE TABLE `TlikeHateTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `conSeq` int UNSIGNED NOT NULL COMMENT '좋아요싫어요테이블 고유값',
  `conType` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '좋아요싫어요타입',
  `clickDateTime` datetime NOT NULL COMMENT '좋아요싫어요일시'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='좋아요싫어요테이블';


ALTER TABLE `TlikeHateTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TlikeHateTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;
--
-- 테이블의 인덱스 `TdeclareTbl`
--
CREATE TABLE `TdeclareTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `conSeq` int UNSIGNED NOT NULL COMMENT '커뮤니티테이블 고유값',
  `conType` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '커뮤니티 타입',
  `declareType` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT '신고타입',
  `clickDateTime` datetime NOT NULL COMMENT '신고일시'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='신고테이블';

ALTER TABLE `TdeclareTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TdeclareTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;
--
-- 테이블의 인덱스 `TcalanderTbl`
--
CREATE TABLE `TcalanderTbl` (
  `seq` int UNSIGNED NOT NULL,
  `joinSeq` int UNSIGNED NOT NULL COMMENT '회원가입테이블 고유값',
  `startDateTime` datetime NOT NULL COMMENT '일정시작일시',
  `endDateTime` datetime NOT NULL COMMENT '일정종료일시',
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '일정제목',
  `subTitle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT '일정소제목',
  `contents` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '일정내용',
  `color` text COLLATE utf8mb4_general_ci NOT NULL COMMENT '일정색상'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='내일정테이블';

ALTER TABLE `TcalanderTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TcalanderTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;
--
-- 테이블의 인덱스 `TcalanItemTbl`
--
CREATE TABLE `TcalanItemTbl` (
  `seq` int UNSIGNED NOT NULL,
  `calanSeq` int UNSIGNED NOT NULL COMMENT '내일정테이블 고유값',
  `itemSeq` int UNSIGNED NOT NULL COMMENT '아이템테이블 고유값',
  `addDateTime` datetime NOT NULL COMMENT '아이템추가일시'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='내일정아이템테이블';

ALTER TABLE `TcalanItemTbl`
  ADD PRIMARY KEY (`seq`);

ALTER TABLE `TcalanItemTbl`
  MODIFY `seq` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '고유값';
COMMIT;