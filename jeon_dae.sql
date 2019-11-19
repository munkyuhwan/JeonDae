-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 19-11-12 02:46
-- 서버 버전: 5.7.26
-- PHP 버전: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `jeon_dae`
--
CREATE DATABASE IF NOT EXISTS `jeon_dae` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `jeon_dae`;

-- --------------------------------------------------------

--
-- 테이블 구조 `board_comment`
--

DROP TABLE IF EXISTS `board_comment`;
CREATE TABLE IF NOT EXISTS `board_comment` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_tbname` varchar(40) DEFAULT NULL COMMENT '콘텐츠 등록 테이블 이름',
  `board_code` varchar(20) DEFAULT NULL COMMENT '콘텐츠 등록 게시판 코드',
  `board_sect` varchar(20) DEFAULT NULL COMMENT '강의과목',
  `board_idx` int(11) DEFAULT '0' COMMENT '콘텐츠 등록 테이블 pk',
  `member_idx` varchar(20) DEFAULT NULL COMMENT '글쓴이 회원테이블 PK',
  `p_no` varchar(11) DEFAULT '0' COMMENT '원글의 pk',
  `ref` int(9) DEFAULT '0' COMMENT '정렬순서',
  `step` int(9) DEFAULT '0' COMMENT '계층표시',
  `depth` int(9) DEFAULT '0' COMMENT '계층단계',
  `writer` varchar(20) DEFAULT '' COMMENT '작성자 명',
  `passwd` varchar(200) DEFAULT NULL COMMENT '비밀번호',
  `subject` varchar(255) DEFAULT '' COMMENT '한줄댓글 제목',
  `file_org` varchar(60) DEFAULT NULL COMMENT '첨부한 이미지 원본명',
  `file_chg` varchar(60) DEFAULT NULL COMMENT '첨부한 이미지 서버명',
  `content` text COMMENT '한줄댓글 내용',
  `after_point` int(11) DEFAULT '0' COMMENT '후기등록시 평점',
  `cnt` int(11) DEFAULT '0' COMMENT '조회수',
  `reco` int(11) DEFAULT '0' COMMENT '추천받은 수',
  `is_del` char(2) DEFAULT 'N' COMMENT '삭제:Y/삭제안됨:N',
  `del_sect` char(2) DEFAULT NULL COMMENT '관리자삭제:AD/본인직접삭제:DD',
  `write_time` datetime DEFAULT NULL,
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `board_idx` (`board_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 한줄댓글 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_config`
--

DROP TABLE IF EXISTS `board_config`;
CREATE TABLE IF NOT EXISTS `board_config` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_code` varchar(20) DEFAULT NULL COMMENT '게시판 코드',
  `board_title` varchar(40) DEFAULT NULL COMMENT '게시판 명',
  `file1_org` varchar(60) DEFAULT NULL COMMENT '게시판 타이틀 이미지 원본명',
  `file1_chg` varchar(60) DEFAULT NULL COMMENT '게시판 타이틀 이미지 서버명',
  `file2_org` varchar(60) DEFAULT NULL COMMENT '게시판 서브타이틀 이미지 원본명',
  `file2_chg` varchar(60) DEFAULT NULL COMMENT '게시판 서브타이틀 이미지 서버명',
  `cate1` varchar(20) DEFAULT NULL COMMENT '대분류 코드',
  `cate2` varchar(20) DEFAULT NULL COMMENT '중분류 코드',
  `cate3` varchar(20) DEFAULT NULL COMMENT '소분류 코드',
  `board_info` text COMMENT '게시판 설명',
  `board_principle` text COMMENT '게시판 운영원칙',
  `board_master_idx` varchar(11) DEFAULT '0' COMMENT '커뮤니티 관리자(부운영자) PK',
  `list_auth` varchar(20) DEFAULT NULL COMMENT '리스트 보기권한. 비회원:NM, 회원등급 코드',
  `view_auth` varchar(20) DEFAULT NULL COMMENT '글내용 보기권한. 비회원:NM, 회원등급 코드',
  `write_auth` varchar(20) DEFAULT NULL COMMENT '본문쓰기권한. 관리자:AD,게시판관리자:BA,비회원:NM,회원등급 코드',
  `reply_auth` varchar(20) DEFAULT NULL COMMENT '덧글쓰기권한. 관리자:AD,게시판관리자:BA,비회원:NM,회원등급 코드',
  `is_comment` varchar(2) DEFAULT NULL COMMENT '한줄댓글 가능여부. 가능:Y,불가능:N',
  `is_notice` varchar(2) DEFAULT NULL COMMENT '공지글 가능여부. 가능:Y,불가능:N',
  `entry_age` varchar(11) DEFAULT NULL COMMENT '참여나이제한, 기재된 나이 이상만 참여가능',
  `entry_gender` varchar(2) DEFAULT NULL COMMENT '참여성별제한, 남성전용:M,여성전용:F',
  `board_cate` varchar(20) DEFAULT NULL COMMENT '게시판 형태. 일반:normal,자료실:pds,갤러리:gal,FAQ:faq',
  `file_cnt` int(11) DEFAULT NULL COMMENT '한번에 등록가능한 첨부파일갯수',
  `board_align` int(11) DEFAULT '0' COMMENT '게시판 정렬 출력순서',
  `is_del` char(2) DEFAULT 'N' COMMENT '삭제:Y/삭제안됨:N',
  `close_ok` char(2) DEFAULT 'N' COMMENT '폐쇄형:Y/일반형:N',
  `wdate` datetime DEFAULT NULL COMMENT '등록일자',
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `board_code` (`board_code`),
  KEY `board_code_2` (`board_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 생성관리 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_content`
--

DROP TABLE IF EXISTS `board_content`;
CREATE TABLE IF NOT EXISTS `board_content` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `p_no` varchar(11) DEFAULT '0' COMMENT '원글의 pk',
  `member_idx` varchar(20) DEFAULT '0' COMMENT '글쓴이 회원테이블 PK',
  `product_idx` varchar(11) DEFAULT NULL COMMENT '광고/체험/상품 PK',
  `after_point` varchar(10) DEFAULT NULL COMMENT '후기평점',
  `view_idx` varchar(20) DEFAULT '0' COMMENT '내가쓴글만 열람시 열람가능한 회원테이블 PK',
  `user_id` varchar(40) DEFAULT NULL COMMENT '작성자ID',
  `view_id` varchar(40) DEFAULT NULL COMMENT '1:1작성자ID',
  `gender` varchar(10) DEFAULT NULL COMMENT '작성자 성별',
  `age` varchar(10) DEFAULT NULL COMMENT '작성자 나이대',
  `bbs_code` varchar(20) DEFAULT '' COMMENT '게시판코드',
  `bbs_sect` varchar(20) DEFAULT NULL COMMENT '게시판 분류, 정보:info,질문:quest,자유:free,불만:comp,홍보:add,공지:notice',
  `bbs_tag` varchar(255) DEFAULT NULL COMMENT '게시판 태그',
  `scrap_ok` varchar(2) DEFAULT NULL COMMENT '스크랩 허용:Y/허용안함:N',
  `pay_bak` int(11) DEFAULT '0' COMMENT '원고료 지급할 박',
  `ref` int(9) DEFAULT '0' COMMENT '정렬순서',
  `step` int(9) DEFAULT '0' COMMENT '계층표시',
  `depth` int(9) DEFAULT '0' COMMENT '계층단계',
  `subject` varchar(255) DEFAULT '' COMMENT '제목',
  `writer` varchar(100) DEFAULT '' COMMENT '작성자',
  `passwd` varchar(200) DEFAULT NULL COMMENT '비밀번호',
  `content` longtext COMMENT '내용',
  `cnt` int(9) DEFAULT '0' COMMENT '조회수',
  `down_cnt` int(11) DEFAULT '0' COMMENT '첨부파일다운횟수',
  `reco` int(9) DEFAULT '0' COMMENT '추천수 ',
  `ip` varchar(20) DEFAULT '' COMMENT '글쓴이IP',
  `write_time` datetime DEFAULT NULL COMMENT '작성일',
  `is_html` char(2) DEFAULT '' COMMENT '태그사용여부',
  `email` varchar(60) DEFAULT '' COMMENT '이메일',
  `is_secure` char(2) DEFAULT 'N' COMMENT '비밀글여부',
  `is_popup` char(2) DEFAULT 'N' COMMENT '공지글여부',
  `is_del` char(2) DEFAULT 'N' COMMENT '삭제:Y/삭제안됨:N',
  `del_sect` char(2) DEFAULT NULL COMMENT '관리자삭제:AD/본인직접삭제:DD',
  `status` varchar(20) DEFAULT 'pre' COMMENT '1:1문의상태',
  `auth_url` varchar(200) DEFAULT NULL COMMENT '글 출처 URL',
  `1vs1_cate` varchar(10) DEFAULT NULL COMMENT '1:1문의 카테고리',
  `1vs1_cell` varchar(20) DEFAULT NULL COMMENT '1:1 휴대전화',
  `re_YN` char(1) DEFAULT 'N' COMMENT '상담 완료 여부',
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `member_idx` (`member_idx`),
  KEY `bbs_code` (`bbs_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='커뮤니티 게시판 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_file`
--

DROP TABLE IF EXISTS `board_file`;
CREATE TABLE IF NOT EXISTS `board_file` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_tbname` varchar(40) DEFAULT NULL COMMENT '콘텐츠 등록 테이블 이름',
  `board_code` varchar(20) DEFAULT NULL COMMENT '콘텐츠 등록 게시판 코드',
  `board_idx` int(11) DEFAULT '0' COMMENT '콘텐츠 등록 테이블 pk',
  `file_org` varchar(60) DEFAULT NULL COMMENT '첨부파일 원본명',
  `file_chg` varchar(60) DEFAULT NULL COMMENT '첨부파일 서버명',
  `file_content` text COMMENT '첨부 이미지 내용',
  `down_cnt` int(11) DEFAULT '0' COMMENT '첨부파일다운횟수',
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `board_idx` (`board_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 첨부파일 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_reco_cnt`
--

DROP TABLE IF EXISTS `board_reco_cnt`;
CREATE TABLE IF NOT EXISTS `board_reco_cnt` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_tbname` varchar(40) DEFAULT NULL COMMENT '콘텐츠 등록 테이블 이름',
  `board_code` varchar(20) DEFAULT NULL COMMENT '콘텐츠 등록 게시판 코드',
  `board_idx` int(11) DEFAULT '0' COMMENT '콘텐츠 등록 테이블 pk',
  `member_idx` int(11) DEFAULT '0' COMMENT '추천한 회원 테이블 PK',
  `reco` int(11) DEFAULT '1' COMMENT '추천수',
  `wdate` datetime DEFAULT NULL COMMENT '추천일자',
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`),
  KEY `board_idx` (`board_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 추천수 관리 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_view_cnt`
--

DROP TABLE IF EXISTS `board_view_cnt`;
CREATE TABLE IF NOT EXISTS `board_view_cnt` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_tbname` varchar(40) DEFAULT NULL COMMENT '콘텐츠 등록 테이블 이름',
  `board_code` varchar(20) DEFAULT NULL COMMENT '콘텐츠 등록 게시판 코드',
  `board_idx` int(11) DEFAULT '0' COMMENT '콘텐츠 등록 테이블 pk',
  `member_idx` int(11) DEFAULT '0' COMMENT '조회한 회원 테이블 PK',
  `cnt` int(9) DEFAULT '0' COMMENT '조회수',
  `wdate` datetime DEFAULT NULL COMMENT '조회일자',
  PRIMARY KEY (`idx`),
  KEY `ix_board_idx` (`board_idx`),
  KEY `idx` (`idx`),
  KEY `board_idx` (`board_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='게시판 조회수 관리 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `board_view_conf`
--

DROP TABLE IF EXISTS `board_view_conf`;
CREATE TABLE IF NOT EXISTS `board_view_conf` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `board_tbname` varchar(40) DEFAULT NULL COMMENT '콘텐츠 등록 테이블 이름',
  `board_code` varchar(20) DEFAULT NULL COMMENT '콘텐츠 등록 게시판 코드',
  `board_idx` int(11) DEFAULT '0' COMMENT '콘텐츠 등록 테이블 pk',
  `member_idx` int(11) DEFAULT '0' COMMENT '조회한 회원 테이블 PK',
  `cnt` int(9) DEFAULT '0' COMMENT '조회수',
  `wdate` datetime DEFAULT NULL COMMENT '조회일자',
  PRIMARY KEY (`idx`),
  KEY `ix_board_idx` (`board_idx`),
  KEY `idx` (`idx`),
  KEY `board_idx` (`board_idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='광고시청 확인 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `clean_index`
--

DROP TABLE IF EXISTS `clean_index`;
CREATE TABLE IF NOT EXISTS `clean_index` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category_idx` int(11) DEFAULT NULL COMMENT '메인 카테고리 id',
  `clean_content_cnt` int(11) DEFAULT NULL COMMENT '클린 게시물 기준',
  `mid_content_cnt_start` int(11) DEFAULT NULL COMMENT '중간 ㄱ게시물 기준 시작',
  `mid_content_cnt_end` int(11) DEFAULT NULL COMMENT '중간 ㄱ게시물 기준 끝',
  `content_standard` int(11) DEFAULT NULL COMMENT '게시물 기준',
  `wdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `direct_msg`
--

DROP TABLE IF EXISTS `direct_msg`;
CREATE TABLE IF NOT EXISTS `direct_msg` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idx',
  `member_idx` int(11) NOT NULL COMMENT '사용자',
  `msg_txt` text NOT NULL COMMENT '메세지',
  `wdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `member_info`
--

DROP TABLE IF EXISTS `member_info`;
CREATE TABLE IF NOT EXISTS `member_info` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `ipin_code` varchar(10) DEFAULT NULL COMMENT '인증수단 , cell : 휴대폰 인증, ipin : 아이핀인증',
  `ipin_code_dup` varchar(100) DEFAULT NULL COMMENT '인증 중복확인값',
  `push_key` varchar(500) DEFAULT NULL COMMENT '푸시 수신 키',
  `member_type` varchar(10) DEFAULT NULL COMMENT '회원종류 , AD : 관리자, PAT : 지점, GEN : 회원',
  `member_gubun` varchar(10) DEFAULT 'NOR' COMMENT 'NOR : 일반회원, SPE : VIP 회원',
  `user_id` varchar(20) DEFAULT NULL COMMENT '회원 ID',
  `user_pwd` varchar(60) DEFAULT NULL COMMENT '회원비밀번호',
  `user_name` varchar(30) DEFAULT NULL COMMENT '회원성명',
  `clean_filter` int(1) NOT NULL COMMENT '클린필터',
  `real_name` varchar(20) NOT NULL COMMENT '본명',
  `gender` char(1) DEFAULT NULL COMMENT '성별',
  `user_nick` varchar(40) DEFAULT NULL COMMENT '회원 닉네임',
  `chuchun_id` varchar(20) DEFAULT NULL COMMENT '추천인 아이디',
  `ssn_num` varchar(20) DEFAULT NULL COMMENT '주민번호',
  `birthday` varchar(20) DEFAULT NULL COMMENT '생년월일',
  `birthday_tp` varchar(10) DEFAULT NULL COMMENT '생일 양/음력',
  `local` varchar(40) DEFAULT NULL COMMENT '지역',
  `sns` varchar(20) DEFAULT NULL COMMENT '사용하는 SNS',
  `email` varchar(60) DEFAULT NULL COMMENT '이메일',
  `tel` varchar(20) DEFAULT NULL COMMENT '자택전화',
  `cell` varchar(20) DEFAULT NULL COMMENT '휴대전화',
  `post` varchar(7) DEFAULT NULL COMMENT '우편번호',
  `addr1` varchar(40) DEFAULT NULL COMMENT '주소',
  `addr2` varchar(40) DEFAULT NULL COMMENT '상세주소',
  `mail_ok` char(1) DEFAULT NULL COMMENT '메일수신 여부, 수신 : Y',
  `sms_ok` char(1) DEFAULT NULL COMMENT 'SMS수신 여부, 수신 : Y',
  `newsletter_ok` char(1) DEFAULT NULL COMMENT '쪽지수신 여부, 수신 : Y',
  `file_org` varchar(60) DEFAULT NULL COMMENT '회원사진 첨부파일 원본명',
  `file_chg` varchar(60) DEFAULT NULL COMMENT '회원사진 첨부파일 서버명',
  `admin_memo` text COMMENT '관리자 메모사항',
  `login_ok` char(1) DEFAULT NULL COMMENT '로그인 가능여부',
  `ad_mem_sect` char(1) DEFAULT NULL COMMENT '관리자입력여부',
  `memout_yn` varchar(10) DEFAULT 'N' COMMENT '회원 탈퇴신청 여부, 탈퇴시 : Y',
  `memout_sect` varchar(60) DEFAULT NULL COMMENT '탈퇴신청시 어떤점이 불편하셨나요?',
  `memout_memo` text COMMENT '탈퇴신청시 탈퇴상세이유',
  `wdate` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '등록일자',
  `mdate` datetime DEFAULT NULL COMMENT '최근 정보수정일자',
  `out_s_date` datetime DEFAULT NULL COMMENT '탈퇴 신청일',
  `out_m_date` datetime DEFAULT NULL COMMENT '탈퇴 완료일',
  `del_yn` varchar(2) NOT NULL DEFAULT 'N' COMMENT '삭제시 Y',
  PRIMARY KEY (`idx`),
  KEY `idx` (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='회원정보 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `popular_feeds`
--

DROP TABLE IF EXISTS `popular_feeds`;
CREATE TABLE IF NOT EXISTS `popular_feeds` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idx',
  `category_idx` int(11) DEFAULT NULL COMMENT '카테고리 아이디엑스',
  `view_cnt` int(11) DEFAULT NULL COMMENT '조회수',
  `comment_cnt` int(11) DEFAULT NULL COMMENT '댓글기준 개수',
  `like_cnt` int(11) DEFAULT NULL COMMENT '좋아요 기준 개수',
  `wdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='인기피드 설정';

-- --------------------------------------------------------

--
-- 테이블 구조 `report_additional_files`
--

DROP TABLE IF EXISTS `report_additional_files`;
CREATE TABLE IF NOT EXISTS `report_additional_files` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDX',
  `report_idx` int(11) NOT NULL COMMENT '제보 인덱스',
  `report_file_name` varchar(50) NOT NULL COMMENT '파일명',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `report_categories`
--

DROP TABLE IF EXISTS `report_categories`;
CREATE TABLE IF NOT EXISTS `report_categories` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `category_name` varchar(100) NOT NULL COMMENT '카테고리 이름',
  `profile_img` varchar(100) DEFAULT NULL COMMENT '프로필 이미지',
  `cover_img` varchar(100) DEFAULT NULL COMMENT '커버이미지',
  `app_id` varchar(30) NOT NULL COMMENT '앱 아이디',
  `app_secret` varchar(50) NOT NULL COMMENT '엡 시크릿',
  `page_id` varchar(50) NOT NULL COMMENT '페이지 아이디',
  `w_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '작성일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `report_comments`
--

DROP TABLE IF EXISTS `report_comments`;
CREATE TABLE IF NOT EXISTS `report_comments` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idx',
  `report_idx` int(11) NOT NULL COMMENT '제보 idx',
  `member_idx` int(11) NOT NULL COMMENT '작성자 idx',
  `comment_txt` text NOT NULL COMMENT '내용',
  `del_yn` varchar(1) NOT NULL DEFAULT 'N' COMMENT '삭제 여부 Y:삭제 N:미삭제',
  `wdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='제보 댓글';

-- --------------------------------------------------------

--
-- 테이블 구조 `report_likes`
--

DROP TABLE IF EXISTS `report_likes`;
CREATE TABLE IF NOT EXISTS `report_likes` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'idx',
  `report_idx` int(11) NOT NULL COMMENT '제보 idx',
  `member_idx` int(11) NOT NULL COMMENT '회원 idx',
  `wdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='좋아요 클릭 정보 테이블';

-- --------------------------------------------------------

--
-- 테이블 구조 `report_list`
--

DROP TABLE IF EXISTS `report_list`;
CREATE TABLE IF NOT EXISTS `report_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '번호',
  `member_idx` int(11) NOT NULL DEFAULT '0' COMMENT '등록자',
  `category` int(11) DEFAULT NULL COMMENT '메인 카테고리',
  `sub_category` int(11) DEFAULT NULL COMMENT '서브 카테고리',
  `content_text` text NOT NULL COMMENT '작성 내용',
  `report_hashtag` text NOT NULL COMMENT '제보 해시태그',
  `likes` int(11) NOT NULL DEFAULT '0' COMMENT '좋아요 수',
  `bad_report` int(11) NOT NULL DEFAULT '0' COMMENT '신고횟수',
  `published_yn` varchar(1) NOT NULL DEFAULT 'N' COMMENT '발행 여부 Y/N',
  `del_yn` varchar(1) NOT NULL DEFAULT 'N' COMMENT '삭제 여부  삭제:Y 미삭제;N',
  `publish_time` int(2) NOT NULL DEFAULT '0' COMMENT '발행시간 1: 지금, 2: 5분후, 3: 30분후, 4: 1시간후',
  `publish_interval` int(2) NOT NULL DEFAULT '0' COMMENT '발행 간격 1: 동시, 2: 5분간격, 3: 30분간격',
  `wdate` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '작성일',
  `mdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '수정일',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `report_sub_categories`
--

DROP TABLE IF EXISTS `report_sub_categories`;
CREATE TABLE IF NOT EXISTS `report_sub_categories` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `report_idx` int(11) NOT NULL COMMENT '제보함 카테고리(report_categories) 아이디',
  `sub_name` varchar(100) NOT NULL COMMENT '이름',
  `del_yn` varchar(1) NOT NULL DEFAULT 'N' COMMENT '삭제 여부',
  `w_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `subscribe_list`
--

DROP TABLE IF EXISTS `subscribe_list`;
CREATE TABLE IF NOT EXISTS `subscribe_list` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `member_idx` int(11) NOT NULL COMMENT '멤버 아이디',
  `category_idx` int(11) NOT NULL COMMENT '구독 (report_categories)아이디',
  `sub_category_idx` int(11) NOT NULL COMMENT '카테고리 구독',
  `w_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '등록일시',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `user_hashtags`
--

DROP TABLE IF EXISTS `user_hashtags`;
CREATE TABLE IF NOT EXISTS `user_hashtags` (
  `idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `member_idx` int(11) NOT NULL COMMENT '사용자 id',
  `hash_tag` varchar(50) NOT NULL COMMENT '태그명',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
