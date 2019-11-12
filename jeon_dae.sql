-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 19-11-12 02:41
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='게시판 생성관리 테이블';

--
-- 테이블의 덤프 데이터 `board_config`
--

INSERT INTO `board_config` (`idx`, `board_code`, `board_title`, `file1_org`, `file1_chg`, `file2_org`, `file2_chg`, `cate1`, `cate2`, `cate3`, `board_info`, `board_principle`, `board_master_idx`, `list_auth`, `view_auth`, `write_auth`, `reply_auth`, `is_comment`, `is_notice`, `entry_age`, `entry_gender`, `board_cate`, `file_cnt`, `board_align`, `is_del`, `close_ok`, `wdate`) VALUES
(1, 'adreview', '광고리뷰', '', '', '', '', '', '', '', '', '', '0', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 0, 1, 'N', 'N', '2018-06-12 21:14:15'),
(2, 'adidea', '광고아이디어', '', '', '', '', '', '', '', '', '', '', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 0, 1, 'N', 'N', '2018-06-12 21:14:54'),
(3, 'exprv1', '기대리뷰', '', '', '', '', '', '', '', '', '', '', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 0, 1, 'N', 'N', '2018-06-12 21:19:49'),
(4, 'exprv2', '체험리뷰', '', '', '', '', '', '', '', '', '', '0', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 4, 1, 'N', 'N', '2018-06-12 21:19:59'),
(5, 'proqna', '상품문의', '', '', '', '', '', '', '', '', '', '', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 0, 4, 'N', 'N', '2018-06-15 15:31:05'),
(6, 'proafter', '상품평', '', '', '', '', '', '', '', '', '', '', 'NM', 'NM', 'NM', 'NM', 'N', 'N', '', '', '', 0, 4, 'N', 'N', '2018-06-15 15:31:32'),
(7, 'notice', '공지사항', '', '', '', '', '', '', '', '', '', '0', 'chlev1', 'chlev1', 'AD', 'AD', 'N', 'Y', '', '', '', 0, 0, 'N', 'N', '2018-10-28 21:52:34'),
(8, 'faq', '자주묻는질문', '', '', '', '', '', '', '', '', '', '', 'chlev1', 'chlev1', 'AD', 'AD', 'N', 'Y', '', '', '', 0, 9, 'N', 'N', '2019-01-06 22:27:55');

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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='커뮤니티 게시판 테이블';

--
-- 테이블의 덤프 데이터 `board_content`
--

INSERT INTO `board_content` (`idx`, `p_no`, `member_idx`, `product_idx`, `after_point`, `view_idx`, `user_id`, `view_id`, `gender`, `age`, `bbs_code`, `bbs_sect`, `bbs_tag`, `scrap_ok`, `pay_bak`, `ref`, `step`, `depth`, `subject`, `writer`, `passwd`, `content`, `cnt`, `down_cnt`, `reco`, `ip`, `write_time`, `is_html`, `email`, `is_secure`, `is_popup`, `is_del`, `del_sect`, `status`, `auth_url`, `1vs1_cate`, `1vs1_cell`, `re_YN`) VALUES
(1, '', '5', '3', '4', '5', 'gelila2@naver.com', 'gelila2@naver.com', '', '1', 'adreview', '', '', '', 0, 1, 0, 0, '', '최창환', 'af8f9dffa5d420fbc249141645b962ee', '프로그램 후기 작성 테스트\r\n\n테스트 중입니다.', 0, 0, 0, '211.227.88.137', '2018-12-30 18:28:46', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(2, '', '15', '2', '5', '15', 'tpskek92@hanmail.net', 'tpskek92@hanmail.net', '', '1', 'adreview', '', '', '', 0, 2, 0, 0, '', '홍세나', 'd41d8cd98f00b204e9800998ecf8427e', '후기 작성해봄', 0, 0, 0, '211.36.133.43', '2019-01-02 14:04:39', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(3, '', '1', '', '', '1', 'chunad', 'chunad', '', '', 'notice', 'GEN', '', '', 0, 3, 0, 0, '공지사항 등록 테스트', '운영자', '1e1b8ec62755ad7b5e245a39b3665415', '<p>공지사항 등록 테스트</p><p>테스트 중입니다.</p><p><br></p><p><font color=\"#3a32c3\">확인</font></p><p><font color=\"#3a32c3\">수정확인</font></p>', 30, 0, 0, '211.227.88.137', '2019-01-06 22:50:29', 'Y', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(4, '', '1', '', '', '1', 'chunad', 'chunad', '', '', 'faq', '', '', '', 0, 4, 0, 0, '자주묻는 질문 테스트', '운영자', '1e1b8ec62755ad7b5e245a39b3665415', '<p>자주묻는 질문 테스트</p><p>테스트 중입니다.</p>', 12, 0, 0, '211.227.88.137', '2019-01-06 22:56:02', 'Y', '', '', 'Y', 'N', '', 'pre', '', '', '', 'N'),
(5, '', '5', '3', '3', '5', 'gelila2@naver.com', 'gelila2@naver.com', '', '1', 'adreview', '', '', '', 0, 5, 0, 0, '', '최창환', 'af8f9dffa5d420fbc249141645b962ee', '멋진 후기를 써봅니다\r\n\n화이팅', 0, 0, 0, '211.227.88.137', '2019-01-07 00:46:49', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(13, '', '33', '20', '5', '33', 'wifo@hanmail.net', 'wifo@hanmail.net', '', '1', 'adreview', '', '', '', 0, 13, 0, 0, '', '핏뿌리기', 'd41d8cd98f00b204e9800998ecf8427e', '아주 좋아요!!\r\n\n\r\n\n다음에 또 하면 좋을 거 같습니다:)', 0, 0, 0, '180.182.20.170', '2019-02-20 14:16:51', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(7, '', '17', '3', '', '17', 'babogio74@hanmail.ne', 'babogio74@hanmail.ne', '', '1', 'adreview', '', '', '', 0, 7, 0, 0, '', '이은미', 'd41d8cd98f00b204e9800998ecf8427e', '좋아요\r\n\n또 기회가 되면 참여하고 싶어요', 0, 0, 0, '117.111.19.43', '2019-01-08 16:30:42', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(8, '', '17', '3', '4', '17', 'babogio74@hanmail.ne', 'babogio74@hanmail.ne', '', '1', 'adreview', '', '', '', 0, 8, 0, 0, '', '이은미', 'd41d8cd98f00b204e9800998ecf8427e', '굳', 0, 0, 0, '117.111.19.43', '2019-01-08 16:33:07', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(9, '', '12', '10', '5', '12', 'js709256@naver.com', 'js709256@naver.com', '', '1', 'adreview', '', '', '', 0, 9, 0, 0, '', '정솔', 'd41d8cd98f00b204e9800998ecf8427e', '야호 ㅎ.ㅎ', 1, 0, 0, '223.38.23.218', '2019-01-08 18:01:42', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(10, '', '12', '9', '5', '12', 'js709256@naver.com', 'js709256@naver.com', '', '1', 'adreview', '', '', '', 0, 10, 0, 0, '', '정솔', 'd41d8cd98f00b204e9800998ecf8427e', '이야~ 이런 게 댓글이로다', 0, 0, 0, '180.182.20.170', '2019-02-13 11:12:58', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(11, '', '28', '1', '5', '28', '988321779', '988321779', '', '1', 'adreview', '', '', '', 0, 11, 0, 0, '', '홍세나_Loopy', 'd41d8cd98f00b204e9800998ecf8427e', 'xkzxjd', 0, 0, 0, '211.36.141.58', '2019-02-13 12:54:51', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(12, '', '28', '1', '5', '28', '988321779', '988321779', '', '1', 'adreview', '', '', '', 0, 12, 0, 0, '', '홍세나_Loopy', 'd41d8cd98f00b204e9800998ecf8427e', 'ㅏㅡㅡㅡㅡ', 0, 0, 0, '211.36.141.58', '2019-02-13 13:35:44', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(15, '', '37', '9', '5', '37', 'tpskek92@naver.com', 'tpskek92@naver.com', '', '1', 'adreview', '', '', '', 0, 14, 0, 0, '', '홍세나', 'd41d8cd98f00b204e9800998ecf8427e', 'ㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇ', 0, 0, 0, '119.149.165.2', '2019-02-21 16:07:02', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(16, '', '34', '26', '4', '34', '999825660', '999825660', '', '1', 'adreview', '', '', '', 0, 15, 0, 0, '', '김현석', 'd41d8cd98f00b204e9800998ecf8427e', '음', 0, 0, 0, '223.38.33.149', '2019-02-27 10:10:04', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(17, '', '34', '26', '4', '34', '999825660', '999825660', '', '1', 'adreview', '', '', '', 0, 16, 0, 0, '', '김현석', 'd41d8cd98f00b204e9800998ecf8427e', '음', 0, 0, 0, '223.38.33.149', '2019-02-27 10:10:09', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(18, '', '34', '21', '4', '34', '999825660', '999825660', '', '1', 'adreview', '', '', '', 0, 17, 0, 0, '', '김현석', 'd41d8cd98f00b204e9800998ecf8427e', '후기', 0, 0, 0, '223.38.33.237', '2019-02-28 06:27:03', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N'),
(19, '', '5', '9', '4', '5', 'gelila2@naver.com', 'gelila2@naver.com', '', '1', 'adreview', '', '', '', 0, 18, 0, 0, '', '최창환', 'af8f9dffa5d420fbc249141645b962ee', '후기작성\r\n\n테스트', 0, 0, 0, '117.111.10.47', '2019-03-15 17:26:41', 'N', '', '', '', 'N', '', 'pre', '', '', '', 'N');

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='게시판 첨부파일 테이블';

--
-- 테이블의 덤프 데이터 `board_file`
--

INSERT INTO `board_file` (`idx`, `board_tbname`, `board_code`, `board_idx`, `file_org`, `file_chg`, `file_content`, `down_cnt`) VALUES
(1, 'ad_info', 'photo', 1, 'section01_sample_img.jpg', '1548609653-BINHT.jpg', '', 0),
(2, 'ad_info', 'photo', 1, 'section03_sample_img.jpg', '1548609653-CQGRN.jpg', '', 0),
(3, 'ad_info', 'docu', 1, 'ico_1.png', '1544974126-IHVWS.png', '', 0),
(4, 'ad_info', 'docu', 1, 'ico_2.png', '1544974126-TQQBY.png', '', 0),
(35, 'ad_info', 'photo', 9, '혼밥용 이미지3png.png', '1552558727-LYVWB.png', '', 0),
(6, 'ad_info', 'photo', 2, 'section05_sample_img.jpg', '1548609632-OKYKF.jpg', '', 0),
(7, 'ad_info', 'docu', 2, 'ico_8.png', '1544974565-VENYU.png', '', 0),
(9, 'ad_info', 'photo', 3, '1536634850-EFDHM.jpg', '1548609669-QJETE.jpg', '', 0),
(10, 'ad_info', 'photo', 3, '아쿠아맨.jpg', '1548609359-CTKUO.jpg', '', 0),
(37, 'ad_info', 'photo', 25, 'KakaoTalk_20190214_180602222.jpg', '1552559594-RIRXI.jpg', '', 0),
(36, 'ad_info', 'photo', 24, 'KakaoTalk_20190219_171333378.jpg', '1552559546-NYOXO.jpg', '', 0),
(16, 'ad_info', 'photo', 10, '20181231_011427.jpg', '1548609550-BYAHO.jpg', '', 0),
(17, 'ad_info', 'photo', 11, '20181230_163556.jpg', '1548609710-SBDTU.jpg', '', 0),
(18, 'ad_info', 'photo', 12, '20181230_163556.jpg', '1547177325-KPDTA.jpg', '', 0),
(19, 'ad_info', 'photo', 13, '20181230_163556.jpg', '1547177326-SVXRS.jpg', '', 0),
(20, 'ad_info', 'photo', 14, '20181230_163556.jpg', '1547177328-GOGIU.jpg', '', 0),
(21, 'ad_info', 'photo', 15, '20181230_163556.jpg', '1547177330-YUZUN.jpg', '', 0),
(22, 'ad_info', 'photo', 16, '20181230_163556.jpg', '1547177331-ZOZHM.jpg', '', 0),
(23, 'ad_info', 'photo', 17, 'KakaoTalk_20181218_123648837.jpg', '1548609743-DOPBL.jpg', '', 0),
(24, 'delv_guide', 'jehu', 6, 'main_visual (1).jpg', '1549373881-TEAZH.jpg', '', 0),
(25, 'delv_guide', 'host1', 1, 'main_visual (1).jpg', '1549375040-AMZFH.jpg', '', 0),
(42, 'delv_guide', 'hostin', 3, 'main_visual (1).jpg', '1550733678-PTSTQ.jpg', '', 0),
(27, 'ad_info', 'photo', 18, 'cake-pops-693645_1920.jpg', '1550239643-DXQPE.jpg', '', 0),
(28, 'ad_info', 'photo', 18, 'ice-cream-1209239_1920.jpg', '1550239643-GRRVK.jpg', '', 0),
(29, 'ad_info', 'photo', 20, '캘리그라피600.png', '1552559463-GYKOA.png', '', 0),
(32, 'ad_info', 'photo', 21, '1550640167.JPG', '1552558688-JGBSK.JPG', '', 0),
(31, 'ad_info', 'photo', 22, 'KakaoTalk_20190219_124059355.jpg', '1552558542-CLPYV.jpg', '', 0),
(33, 'ad_info', 'photo', 21, '1550640167.JPG', '1552558688-TSFAU.JPG', '', 0),
(34, 'ad_info', 'photo', 23, '이미지.JPG', '1552559498-FUMNV.JPG', '', 0),
(38, 'ad_info', 'photo', 26, 'KakaoTalk_20190213_161252227.jpg', '1552559676-UZRFP.jpg', '', 0),
(39, 'ad_info', 'photo', 26, 'KakaoTalk_20190213_161305478.jpg', '1552559676-UUZRP.jpg', '', 0),
(40, 'ad_info', 'photo', 26, 'KakaoTalk_20190213_161324368.jpg', '1552559676-XRXAA.jpg', '', 0),
(41, 'ad_info', 'photo', 26, 'KakaoTalk_20190213_161343277.jpg', '1552559676-KPPTY.jpg', '', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COMMENT='게시판 추천수 관리 테이블';

--
-- 테이블의 덤프 데이터 `board_reco_cnt`
--

INSERT INTO `board_reco_cnt` (`idx`, `board_tbname`, `board_code`, `board_idx`, `member_idx`, `reco`, `wdate`) VALUES
(1, 'ad_info', 'zzim', 2, 5, 1, '2018-12-26 02:41:14'),
(2, 'member_bisut_info', 'like', 11, 5, 1, '2018-12-30 17:12:07'),
(3, 'ad_info', 'zzim', 3, 5, 1, '2018-12-30 17:29:37'),
(4, 'board_content', 'adreview', 1, 5, 1, '2018-12-30 18:30:07'),
(5, 'ad_info', 'zzim', 1, 15, 1, '2019-01-02 14:00:51'),
(6, 'board_content', 'adreview', 1, 15, 1, '2019-01-02 14:04:15'),
(7, 'member_bisut_info', 'like', 5, 5, 1, '2019-01-07 01:13:47'),
(8, 'board_content', 'adreview', 7, 17, 1, '2019-01-08 16:30:52'),
(9, 'board_content', 'adreview', 5, 17, 1, '2019-01-08 16:33:17'),
(10, 'board_content', 'adreview', 1, 17, 1, '2019-01-08 16:33:23'),
(11, 'ad_info', 'zzim', 3, 16, 1, '2019-01-08 16:33:38'),
(12, 'member_bisut_info', 'like', 5, 18, 1, '2019-01-08 16:38:56'),
(13, 'ad_info', 'zzim', 1, 17, 1, '2019-01-08 16:46:34'),
(14, 'board_content', 'adreview', 2, 17, 1, '2019-01-08 16:50:17'),
(15, 'member_bisut_info', 'like', 17, 17, 1, '2019-01-11 12:40:00'),
(16, 'ad_info', 'zzim', 9, 19, 1, '2019-01-11 15:57:05'),
(17, 'ad_info', 'zzim', 3, 19, 1, '2019-01-11 16:07:10'),
(18, 'ad_info', 'zzim', 10, 5, 1, '2019-01-28 02:49:28'),
(19, 'ad_info', 'zzim', 17, 5, 1, '2019-01-28 02:50:55'),
(20, 'ad_info', 'zzim', 9, 5, 1, '2019-01-28 02:52:00'),
(21, 'ad_info', 'zzim', 1, 5, 1, '2019-01-28 02:52:18'),
(22, 'ad_info', 'zzim', 9, 12, 1, '2019-02-13 11:12:17'),
(23, 'ad_info', 'zzim', 1, 28, 1, '2019-02-13 12:53:08'),
(24, 'ad_info', 'zzim', 9, 28, 1, '2019-02-15 23:32:58'),
(25, 'ad_info', 'zzim', 3, 31, 1, '2019-02-16 00:28:41'),
(26, 'ad_info', 'zzim', 21, 32, 1, '2019-02-20 14:26:08'),
(27, 'ad_info', 'zzim', 20, 32, 1, '2019-02-20 14:26:38'),
(28, 'board_content', 'adreview', 13, 32, 1, '2019-02-20 15:35:11'),
(29, 'ad_info', 'zzim', 20, 34, 1, '2019-02-20 15:48:01'),
(30, 'ad_info', 'zzim', 24, 33, 1, '2019-02-20 16:55:42'),
(31, 'board_content', 'adreview', 10, 34, 1, '2019-02-20 17:44:36'),
(32, 'ad_info', 'zzim', 20, 35, 1, '2019-02-21 13:28:06'),
(33, 'ad_info', 'zzim', 20, 12, 1, '2019-02-21 13:37:10'),
(34, 'member_bisut_info', 'like', 33, 12, 1, '2019-02-21 13:38:46'),
(35, 'ad_info', 'zzim', 9, 37, 1, '2019-02-21 13:58:36'),
(36, 'board_content', 'adreview', 10, 37, 1, '2019-02-21 14:22:50'),
(37, 'board_content', 'adreview', 15, 37, 1, '2019-02-21 16:09:23'),
(38, 'ad_info', 'zzim', 9, 34, 1, '2019-02-25 16:43:14'),
(39, 'ad_info', 'zzim', 23, 5, 1, '2019-03-14 14:49:38'),
(40, 'ad_info', 'zzim', 26, 34, 1, '2019-03-15 08:46:11'),
(41, 'board_content', 'adreview', 17, 10, 1, '2019-03-16 00:35:07'),
(42, 'ad_info', 'zzim', 1, 27, 1, '2019-03-17 16:51:36');

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
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COMMENT='게시판 조회수 관리 테이블';

--
-- 테이블의 덤프 데이터 `board_view_cnt`
--

INSERT INTO `board_view_cnt` (`idx`, `board_tbname`, `board_code`, `board_idx`, `member_idx`, `cnt`, `wdate`) VALUES
(1, 'ad_info', '', 3, 5, 1, '2018-12-26 02:49:17'),
(2, 'ad_info', '', 1, 13, 1, '2018-12-26 15:37:12'),
(3, 'ad_info', '', 2, 15, 1, '2019-01-02 12:54:14'),
(4, 'ad_info', '', 3, 15, 1, '2019-01-02 12:56:53'),
(5, 'ad_info', '', 1, 15, 1, '2019-01-02 14:00:24'),
(6, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:31:56'),
(7, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:32:55'),
(8, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:33:20'),
(9, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:34:31'),
(10, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:35:58'),
(11, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:36:29'),
(12, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:37:06'),
(13, 'board_content', 'notice', 3, 0, 1, '2019-01-06 23:37:31'),
(14, 'board_content', 'faq', 4, 0, 1, '2019-01-06 23:56:54'),
(15, 'board_content', 'faq', 4, 0, 1, '2019-01-06 23:57:37'),
(16, 'board_content', 'faq', 4, 0, 1, '2019-01-08 14:19:15'),
(17, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:16:07'),
(18, 'board_content', 'notice', 3, 14, 1, '2019-01-08 16:27:16'),
(19, 'ad_info', '', 3, 17, 1, '2019-01-08 16:28:11'),
(145, 'board_content', 'notice', 3, 0, 1, '2019-02-25 17:50:40'),
(144, 'board_content', 'notice', 3, 0, 1, '2019-02-21 21:19:40'),
(143, 'ad_info', '', 24, 16, 1, '2019-02-21 17:23:33'),
(142, 'ad_info', '', 21, 16, 1, '2019-02-21 16:02:18'),
(141, 'ad_info', '', 9, 16, 1, '2019-02-21 16:00:16'),
(140, 'ad_info', '', 20, 37, 1, '2019-02-21 15:30:32'),
(139, 'board_content', 'notice', 3, 0, 1, '2019-02-21 15:06:19'),
(138, 'board_content', 'notice', 3, 37, 1, '2019-02-21 15:03:12'),
(136, 'ad_info', '', 9, 37, 1, '2019-02-21 13:58:27'),
(135, 'ad_info', '', 23, 12, 1, '2019-02-21 13:38:53'),
(134, 'ad_info', '', 25, 12, 1, '2019-02-21 13:38:39'),
(133, 'ad_info', '', 9, 35, 1, '2019-02-21 13:38:32'),
(132, 'ad_info', '', 20, 12, 1, '2019-02-21 13:37:10'),
(131, 'ad_info', '', 26, 16, 1, '2019-02-21 13:36:40'),
(130, 'ad_info', '', 20, 35, 1, '2019-02-21 13:25:37'),
(129, 'board_content', 'notice', 3, 0, 1, '2019-02-21 10:50:50'),
(128, 'ad_info', '', 23, 32, 1, '2019-02-20 17:47:51'),
(127, 'ad_info', '', 25, 16, 1, '2019-02-20 17:46:40'),
(126, 'ad_info', '', 26, 34, 1, '2019-02-20 17:41:26'),
(125, 'ad_info', '', 25, 29, 1, '2019-02-20 17:13:40'),
(124, 'ad_info', '', 25, 34, 1, '2019-02-20 17:13:33'),
(123, 'ad_info', '', 24, 34, 1, '2019-02-20 17:00:16'),
(122, 'ad_info', '', 23, 34, 1, '2019-02-20 16:32:07'),
(121, 'board_content', 'faq', 4, 0, 1, '2019-02-20 16:30:28'),
(120, 'ad_info', '', 23, 29, 1, '2019-02-20 16:30:18'),
(119, 'board_content', 'notice', 3, 33, 1, '2019-02-20 16:21:12'),
(118, 'ad_info', '', 9, 34, 1, '2019-02-20 16:12:00'),
(117, 'ad_info', '', 9, 33, 1, '2019-02-20 16:10:05'),
(116, 'board_content', 'faq', 4, 0, 1, '2019-02-20 15:47:59'),
(51, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:43'),
(52, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:45'),
(53, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:45'),
(54, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:46'),
(55, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:46'),
(56, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:46'),
(57, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:46'),
(58, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:46'),
(59, 'board_content', 'notice', 3, 0, 1, '2019-01-08 16:28:47'),
(115, 'ad_info', '', 21, 34, 1, '2019-02-20 15:42:22'),
(61, 'ad_info', '', 3, 16, 1, '2019-01-08 16:33:37'),
(62, 'ad_info', '', 2, 17, 1, '2019-01-08 16:40:00'),
(63, 'board_content', 'faq', 4, 14, 1, '2019-01-08 16:44:48'),
(64, 'ad_info', '', 1, 17, 1, '2019-01-08 16:46:07'),
(114, 'ad_info', '', 21, 29, 1, '2019-02-20 15:41:38'),
(66, 'ad_info', '', 10, 18, 1, '2019-01-08 16:54:24'),
(67, 'ad_info', '', 10, 12, 1, '2019-01-08 18:00:30'),
(113, 'ad_info', '', 20, 34, 1, '2019-02-20 15:19:03'),
(69, 'board_content', 'faq', 4, 0, 1, '2019-01-08 22:37:03'),
(70, 'ad_info', '', 3, 12, 1, '2019-01-08 22:43:12'),
(71, 'ad_info', '', 9, 19, 1, '2019-01-11 15:57:03'),
(72, 'ad_info', '', 3, 19, 1, '2019-01-11 16:07:08'),
(73, 'ad_info', '', 2, 19, 1, '2019-01-11 16:10:02'),
(112, 'ad_info', '', 22, 32, 1, '2019-02-20 14:31:48'),
(75, 'ad_info', '', 10, 5, 1, '2019-01-13 01:42:41'),
(111, 'ad_info', '', 21, 32, 1, '2019-02-20 14:25:36'),
(110, 'ad_info', '', 20, 32, 1, '2019-02-20 14:10:28'),
(109, 'ad_info', '', 1, 29, 1, '2019-02-16 01:53:27'),
(79, 'board_content', 'adreview', 9, 1, 1, '2019-01-21 01:44:16'),
(108, 'ad_info', '', 3, 31, 1, '2019-02-16 00:28:38'),
(81, 'board_content', 'faq', 4, 0, 1, '2019-01-21 11:17:07'),
(82, 'ad_info', '', 11, 16, 1, '2019-01-23 17:47:57'),
(83, 'ad_info', '', 17, 5, 1, '2019-01-28 02:50:52'),
(84, 'ad_info', '', 9, 5, 1, '2019-01-28 02:51:50'),
(107, 'ad_info', '', 1, 31, 1, '2019-02-15 23:48:21'),
(106, 'ad_info', '', 1, 30, 1, '2019-02-15 23:10:26'),
(87, 'ad_info', '', 9, 12, 1, '2019-01-29 17:53:08'),
(105, 'ad_info', '', 18, 28, 1, '2019-02-15 23:09:00'),
(89, 'board_content', 'faq', 4, 0, 1, '2019-01-30 22:21:20'),
(104, 'ad_info', '', 9, 28, 1, '2019-02-15 18:28:18'),
(103, 'ad_info', '', 10, 29, 1, '2019-02-14 19:59:39'),
(92, 'board_content', 'faq', 4, 0, 1, '2019-02-01 13:45:25'),
(102, 'ad_info', '', 9, 29, 1, '2019-02-14 17:26:22'),
(94, 'board_content', 'notice', 3, 0, 1, '2019-02-04 21:24:44'),
(95, 'board_content', 'faq', 4, 0, 1, '2019-02-04 21:24:51'),
(96, 'ad_info', '', 2, 10, 1, '2019-02-10 22:32:43'),
(97, 'ad_info', '', 3, 10, 1, '2019-02-10 22:33:31'),
(98, 'ad_info', '', 11, 10, 1, '2019-02-10 22:33:48'),
(99, 'ad_info', '', 1, 28, 1, '2019-02-13 12:52:56'),
(101, 'board_content', 'notice', 3, 0, 1, '2019-02-14 17:24:22'),
(146, 'board_content', 'notice', 3, 34, 1, '2019-02-27 20:47:23'),
(147, 'ad_info', '', 22, 34, 1, '2019-02-27 20:52:16'),
(148, 'ad_info', '', 25, 35, 1, '2019-02-28 13:49:40'),
(149, 'ad_info', '', 24, 17, 1, '2019-02-28 17:48:58'),
(150, 'ad_info', '', 23, 17, 1, '2019-02-28 17:49:13'),
(151, 'board_content', 'notice', 3, 0, 1, '2019-03-06 14:36:45'),
(152, 'board_content', 'notice', 3, 0, 1, '2019-03-13 13:39:06'),
(153, 'ad_info', '', 23, 5, 1, '2019-03-14 14:31:35'),
(154, 'ad_info', '', 24, 5, 1, '2019-03-14 14:42:16'),
(155, 'ad_info', '', 26, 5, 1, '2019-03-14 16:12:09'),
(156, 'ad_info', '', 9, 27, 1, '2019-03-15 13:44:50'),
(157, 'ad_info', '', 1, 27, 1, '2019-03-15 17:49:04'),
(158, 'ad_info', '', 1, 34, 1, '2019-03-15 18:13:08'),
(159, 'board_content', 'faq', 4, 0, 1, '2019-03-15 19:34:43'),
(160, 'ad_info', '', 26, 10, 1, '2019-03-16 00:34:18');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `clean_index`
--

INSERT INTO `clean_index` (`idx`, `category_idx`, `clean_content_cnt`, `mid_content_cnt_start`, `mid_content_cnt_end`, `content_standard`, `wdate`) VALUES
(1, 7, 3, 3, 16, 15, '2019-11-04 14:13:48'),
(2, 8, 55, 23, 28, 5, '2019-11-06 09:32:47'),
(3, 10, 10, 10, 14, 14, '2019-11-11 13:59:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `direct_msg`
--

INSERT INTO `direct_msg` (`idx`, `member_idx`, `msg_txt`, `wdate`) VALUES
(1, 47, 'yfyufyujfjfj', '2019-11-08 10:18:02');

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
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='회원정보 테이블';

--
-- 테이블의 덤프 데이터 `member_info`
--

INSERT INTO `member_info` (`idx`, `ipin_code`, `ipin_code_dup`, `push_key`, `member_type`, `member_gubun`, `user_id`, `user_pwd`, `user_name`, `clean_filter`, `real_name`, `gender`, `user_nick`, `chuchun_id`, `ssn_num`, `birthday`, `birthday_tp`, `local`, `sns`, `email`, `tel`, `cell`, `post`, `addr1`, `addr2`, `mail_ok`, `sms_ok`, `newsletter_ok`, `file_org`, `file_chg`, `admin_memo`, `login_ok`, `ad_mem_sect`, `memout_yn`, `memout_sect`, `memout_memo`, `wdate`, `mdate`, `out_s_date`, `out_m_date`, `del_yn`) VALUES
(38, NULL, NULL, NULL, 'AD', 'NOR', 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, 0, '관리자', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, NULL, 'N'),
(47, NULL, NULL, NULL, 'GEN', 'NOR', 'tester', '21232f297a57a5a743894a0e4a801fc3', NULL, 1, '대리기사3', 'F', NULL, NULL, NULL, '2011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1572426664-DBPJJ.png', NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, NULL, 'N');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='인기피드 설정';

--
-- 테이블의 덤프 데이터 `popular_feeds`
--

INSERT INTO `popular_feeds` (`idx`, `category_idx`, `view_cnt`, `comment_cnt`, `like_cnt`, `wdate`) VALUES
(3, 7, 11, 22, 33, '2019-11-04 14:39:25');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `report_additional_files`
--

INSERT INTO `report_additional_files` (`idx`, `report_idx`, `report_file_name`) VALUES
(4, 14, '1573195102-RUXEM.png');

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `report_categories`
--

INSERT INTO `report_categories` (`idx`, `category_name`, `profile_img`, `cover_img`, `app_id`, `app_secret`, `page_id`, `w_date`) VALUES
(7, '내가 알려드릴게1', '1572396739-SDDCS.png', '1572396739-DOLLC.png', '1147736882281604', '12ad8a4e860db5b2571c91d2cbde05ed', '100413944738398', '2019-10-30 09:52:19'),
(6, '내가 알려드릴게2', '1572396690-CWNDC.png', '1572396690-VIGUF.png', '1147736882281604', '12ad8a4e860db5b2571c91d2cbde05ed', '100413944738398', '2019-10-30 09:51:30'),
(8, '내가 알려드릴게3', '', '', '1147736882281604', '12ad8a4e860db5b2571c91d2cbde05ed', '100413944738398', '2019-11-01 16:22:39'),
(9, '내가 알려드릴게4', '', '', '1147736882281604', '12ad8a4e860db5b2571c91d2cbde05ed', '100413944738398', '2019-11-01 17:11:41'),
(10, '내가 알려드릴게5', '', '', '1147736882281604', '12ad8a4e860db5b2571c91d2cbde05ed', '100413944738398', '2019-11-01 17:12:06');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='제보 댓글';

--
-- 테이블의 덤프 데이터 `report_comments`
--

INSERT INTO `report_comments` (`idx`, `report_idx`, `member_idx`, `comment_txt`, `del_yn`, `wdate`) VALUES
(1, 3, 47, '3번째 제보 댓글', 'N', '2019-11-07 14:16:40');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='좋아요 클릭 정보 테이블';

--
-- 테이블의 덤프 데이터 `report_likes`
--

INSERT INTO `report_likes` (`idx`, `report_idx`, `member_idx`, `wdate`) VALUES
(1, 1, 47, '2019-11-07 15:22:31');

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `report_list`
--

INSERT INTO `report_list` (`idx`, `member_idx`, `category`, `sub_category`, `content_text`, `report_hashtag`, `likes`, `bad_report`, `published_yn`, `del_yn`, `publish_time`, `publish_interval`, `wdate`, `mdate`) VALUES
(1, 47, 7, 3, '제보합니다요', '', 0, 0, 'Y', 'N', 4, 2, '2019-10-31 10:58:35', '2019-10-31 10:58:35'),
(2, 47, 7, 2, '새로운 제보 이것좀 올려주세열', '', 0, 0, 'Y', 'N', 4, 2, '2019-10-31 12:31:30', '2019-10-31 12:31:30'),
(3, 38, NULL, NULL, '강북구 테스트 제보중', '#테스트', 0, 0, 'N', 'N', 0, 0, '2019-11-01 16:26:47', '2019-11-01 16:26:47'),
(4, 38, NULL, NULL, '테스트 제보', '#테스트', 0, 0, 'N', 'N', 0, 0, '2019-11-01 17:12:25', '2019-11-01 17:12:25'),
(5, 38, NULL, NULL, 'ㅇㅇㅁㄻㅇㄹ롬ㄷㅈ려ㅑㅐㅁㄴㅇㄻㄴㅇㄻㄴㄱ', '#ㅁㅁㅁ', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:14:54', '2019-11-08 11:14:54'),
(6, 38, NULL, NULL, 'ㄷㄹㄷㄻㅁㅁ머뇨ㅓ쇼엉쇼ㅓ너먻머ㅗ모쇼ㅗ묘몸', '#ㅁ너너넌섯ㄴ거', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:15:17', '2019-11-08 11:15:17'),
(7, 38, NULL, NULL, '모모모모모솟논누누ㅠ뉴뉴ㅠ몸둄ㄷ교ㅜㅡ뉴ㅗㄴ뮷', '#너ㅗ으ㅜ', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:15:29', '2019-11-08 11:15:29'),
(8, 38, NULL, NULL, '야ㅏ오두읓아포야두으머ㅏㅣ', '#아이', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:15:40', '2019-11-08 11:15:40'),
(9, 38, NULL, NULL, '제보제조봊보ㅔ조베제제보제배ㅗ재보재조배ㅗ', '#재재재', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:16:05', '2019-11-08 11:16:05'),
(10, 38, NULL, NULL, '아드레날린 한번에날린', '#카피추', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:16:32', '2019-11-08 11:16:32'),
(11, 38, NULL, NULL, '그땐 나도 깡패가 되는거야', '#곽철용', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:16:56', '2019-11-08 11:16:56'),
(12, 38, NULL, NULL, '마포대교는 무너졌냐', '#곽철용', 0, 0, 'N', 'N', 0, 0, '2019-11-08 11:50:22', '2019-11-08 11:50:22'),
(13, 38, NULL, NULL, '난 있잖아', '#하니', 0, 0, 'N', 'N', 0, 0, '2019-11-08 12:01:29', '2019-11-08 12:01:29'),
(14, 38, NULL, NULL, 'ㅇㅇfff', 'ㄹㄷㄱㄹ111', 0, 0, 'N', 'N', 0, 0, '2019-11-08 14:22:34', '2019-11-08 14:22:34');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `report_sub_categories`
--

INSERT INTO `report_sub_categories` (`idx`, `report_idx`, `sub_name`, `del_yn`, `w_date`) VALUES
(2, 7, '중고차', 'N', '2019-10-30 13:36:53'),
(3, 7, '스키', 'N', '2019-10-30 13:37:00'),
(4, 7, '외국어', 'N', '2019-10-30 13:37:06'),
(5, 7, '여행', 'N', '2019-10-30 13:37:11'),
(6, 6, '은평', 'N', '2019-10-30 15:25:49'),
(7, 6, '응암동', 'Y', '2019-10-30 15:25:56'),
(8, 6, '나의 살던고향', 'N', '2019-11-11 13:45:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `subscribe_list`
--

INSERT INTO `subscribe_list` (`idx`, `member_idx`, `category_idx`, `sub_category_idx`, `w_date`) VALUES
(154, 47, 6, 7, '2019-11-06 09:31:38'),
(153, 47, 6, 6, '2019-11-06 09:31:38'),
(152, 47, 7, 5, '2019-11-06 09:31:38'),
(151, 47, 7, 4, '2019-11-06 09:31:38'),
(150, 47, 7, 3, '2019-11-06 09:31:38'),
(149, 47, 7, 2, '2019-11-06 09:31:38');

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
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `user_hashtags`
--

INSERT INTO `user_hashtags` (`idx`, `member_idx`, `hash_tag`) VALUES
(87, 47, ' #알바'),
(86, 47, '#라면');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
