-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- 생성 시간: 19-11-12 02:54
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
