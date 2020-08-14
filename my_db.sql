-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `my_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `article`
--

CREATE TABLE `article` (
  `id` int(10) NOT NULL COMMENT '文章id',
  `title` varchar(100) NOT NULL COMMENT '標題',
  `category` varchar(50) NOT NULL COMMENT '分類',
  `content` text NOT NULL COMMENT '內文',
  `publish` tinyint(1) NOT NULL DEFAULT 1 COMMENT '發佈與否 1=發佈,0=不發佈',
  `create_datetime` datetime NOT NULL COMMENT '建立日期時間',
  `modify_datetime` datetime DEFAULT NULL COMMENT '修改日期時間',
  `edit_count` int(10) NOT NULL DEFAULT 0 COMMENT '編輯次數'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `article`
--

INSERT INTO `article` (`id`, `title`, `category`, `content`, `publish`, `create_datetime`, `modify_datetime`, `edit_count`) VALUES
(1, 'NBA／台灣之光！林書豪成首位在總冠軍賽出戰的華人', '運動', 'NBA總冠軍系列賽第3戰，暴龍今(6)天作客甲骨文球場，反客為主一路壓著三巨頭僅剩一哥「咖哩小子」Stephen Curry的勇士打，華裔球星林書豪也在最後51.7秒、暴龍領先13分的情況下，生涯首度在總冠軍賽登場，結束4場冷板凳。<br />\n<br />\n<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://media.nownews.com/nn_media/thumbnail/2019/03/1552613050-85fcf2b2a41cc1177815e926341f0fef-696x391.jpg\" class=\"img-thumbnail\"><br />\n<br />\n<br />\n<br />\n暴龍隊史首度進軍總冠軍賽，也讓林書豪生涯首度摸到總冠軍賽地板，儘管出賽時間不多，今天之前還連續4場被冰凍在板凳，此前只出賽7場，上場時間不到30分鐘，讓不少人大呼可惜，頻頻向暴龍主帥喊話。<br />\n<br />\n<br />\n<br />\n今天總冠軍賽第3戰，林書豪終於在最後第四節51.7秒，獲得上場機會，換下主控Kyle Lowry，不過暴龍領先多達13分，兩隊也都換下先發主力，所以都沒有繼續進攻，林書豪因此沒有得分或出手數據。<br />\n<br />\n<br />\n<br />\n過去，中國球員巴特爾隨馬刺奪得總冠軍，成為首位拿到NBA冠軍金戒的華人，之後中國球員孫悅效力洛杉磯湖人也拿到一只總冠軍金戒，不過兩人都沒在總冠軍賽登場。', 1, '2019-06-06 21:19:54', '2020-08-14 02:55:08', 19),
(2, '騷擾他人？實況主超負荷遭 Twitch 停權七天', '娛樂', '真的被 BAN 了！今 (16) 日 twitch 實況主 NL 開台時表示原訂於今日的工商活動因為另一位合作的實況主超負荷遭到 Twitch 停權而取消，而就在今日下午超負荷也透過粉絲團證實了這項消息，確認遭到 Twitch 官方停權 7 天。對此許多網友紛紛猜測是因為超負荷實況台的聊天室機器人指令而遭到 Ban 台，不過目前 Twitch 與超負荷本人均尚未對此事作出更進一步的回應。', 1, '2019-06-06 21:21:45', '2020-08-13 21:24:11', 5),
(4, '《學園奶爸》公開第4卷光碟詳情 8月將舉辦特別活動 ', '動漫', '根據漫畫家時計野針創作漫畫改編的TV動畫《學園奶爸》於今年冬季播出，深受女性好評，日前該動畫的第4卷光碟封面和詳情得到了公開。<br />\r\n<br />\r\n動畫《學園奶爸》的藍光和DVD第4卷將於2018年6月22日發售收錄，第7集和第8集動畫。特典有廣播劇CD、原作者時計野針新繪製的插畫的卡片、收錄了聲優訪談的小冊子，其中時計野針新繪製的卡片的插畫以及光碟封面得到了公開。映像特典則為主演聲優西山宏太朗與梅原裕一郎的奶爸體驗前篇。第4卷藍光碟售價為不含稅6800日元(約合人民幣408元)，DVD光碟售價為不含稅5800日元(約合人民幣348元)。<br />\r\n<br />\r\n(《學園奶爸》光碟第4卷封面以及特典插畫卡片)<br />\r\n<br />\r\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://i.ytimg.com/vi/s_lVGi8kPBk/maxresdefault.jpg\" class=\"img-thumbnail\"><br />\r\n另外，動畫《學園奶爸》還宣布將於2018年8月26日舉辦動畫特別活動「森之宮學園祭」，為動畫配音的聲優西山宏太朗、古木望、梅原裕一郎、三瓶由布子、前野智昭等將出席。該活動的門票先行抽選申請券將附帶在第4卷光碟中。<p><p><br />\r\n<br />\r\nTV動畫《學園奶爸》由Brains Base製作TV動畫，森下柊聖擔任導演，柿原優子負責系列構成，大澤美奈負責角色設計，本山哲擔任音響導演。曾為《請問您今天要來點兔子嗎?》《黃金拼圖》等動畫製作背景音樂的川田瑠夏將擔任該動畫的配樂。聲優陣容方面主要聲優陣容為鹿島龍一CV：西山宏太朗、鹿島虎太郎CV：古木望狼谷隼CV：梅原裕一郎、狼谷鷹CV：三瓶由布子、熊冢奇凜CV：小原好美、狸冢拓馬CV：齊藤彩夏、狸冢數馬CV：種崎敦美、猿渡美鳥CV：本渡楓、兔田義仁CV：前野智昭、犀川惠吾CV：小野大輔、森之宮羊子(理事長)CV：宮寺智子。', 1, '2019-11-30 22:25:26', '2020-02-02 04:23:46', 3),
(5, 'JOJO的奇妙冒險：歷代主角能力性格盤點！網友：越來越變態！', '動漫', '《JOJO的奇妙冒險》現在動漫已經更新到了第五部：《JOJO的奇妙冒險 黃金之風》，雖然這部動漫不看前幾部也是沒有問題的，但估計很多想看這部動漫的同學都已經把前幾部都刷完了，也是從前幾部了解了了不少JOJO梗，前幾部的動漫講的都是喬納森家族的故事，但這一部喬魯諾 喬巴納的身份卻是dio和喬納森共同的產物，但從口頭禪上來講，顯然他和他爸是一個dio樣，喬巴納的能力是賦予無意識的東西生命，其他JOJO又有什麼逆天能力呢？讓我們來複習一下歷代JOJO的能力吧。<br />\n<br />\n<br />\n一至六部主角，第六部尚未有動畫<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://miro.medium.com/max/2560/1*VQ8_pWX7j-bBmxiCqJGdKA.jpeg\" class=\"img-thumbnail\"><br />\n<br />\n幻影之血：喬納森·喬斯達<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://img1.ak.crunchyroll.com/i/spire4-tmb/7227471a4c33412610489ce0d30c74e51397182569_full.jpg\" class=\"img-thumbnail\"><br />\n<br />\n第一部的主角是沒有替身使者的能力的，喬納森·喬斯達作為喬家唯一的紳士，也揭開了喬家與dio戰鬥的序幕，dio為了獲得力量與JOJO家族的財產，戴上鬼面具，JOJO為了與打敗dio，學習波紋氣功，這種波紋氣功有著和太陽一樣的能力，能重創吸血鬼，這部的JOJO不像後幾部的JOJO有著很多的智斗場面，但喬納森優秀的紳士品格也給眾多jo廚留下了深刻印象，但也正因為他的紳士性格，喬納森最終還是敗倒在了dio手中。<br />\n<br />\n<br />\n戰鬥潮流：喬瑟夫·喬斯達<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://pbs.twimg.com/media/B-iOZhhCQAE2P1z.jpg\" class=\"img-thumbnail\"><br />\n<br />\n第二部的主角是替身最沒用的老頭喬瑟夫·喬斯達，當然這只是開玩笑，正是第二部將JOJO的智鬥風格發揚光大，喬瑟夫雖然沒有喬納森出色的波紋氣功，但他一直靠自己的聰明才智與敵人戰鬥，喬瑟夫不是一個紳士，但正是宛如流氓的戰鬥風格他才能打敗柱之男，柱之男可以說是五部里最強的敵人了，連地球都無法將他消滅，但喬瑟夫利用火山將他轟出地球，喬瑟夫或許不是最強的JOJO，但他是最聰明的JOJO。<br />\n<br />\n<br />\n星塵鬥士：空條·承太郎<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://geekandsundry.com/wp-content/uploads/2015/11/PNG-Promo-4-Copy4.png\" class=\"img-thumbnail\"><br />\n<br />\n從星塵鬥士開始，荒木飛呂彥引入了替身使者的戰鬥系統，毋庸置疑，空條承太郎是最強的JOJO，承太郎的戰鬥風格是熱血與機智並存的，但他不像年輕的喬瑟夫那樣狡詐，他的聰明向來是正大光明的，替身白金之星除了戰鬥距離短之外，沒有任何缺點，此外還擁有時間停止的能力，這也讓他在面對dio時能有一戰之力，沉默但是溫柔的性格，也讓他成為了歷代JOJO中最有魅力的一個。<br />\n<br />\n<br />\n不滅鑽石：東方·仗助<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://i.ytimg.com/vi/34McNneyJkk/maxresdefault.jpg\" class=\"img-thumbnail\"><br />\n<br />\n東方仗助是喬瑟夫·喬斯達的私生子，相比於其他喬納森的子孫，仗助雖然只是個孩子，但他更像喬納森的性格，待人接物都很溫柔，更像一位紳士，當然頭髮是一定不能評論的，他的替身能力也體現出他溫柔的性格，修復物體和人體，但不能復活，力量上比得上白金之星，但精密度不如白金之星，能進行修復的替身看起來雞肋，但除了修復傷勢，也能進行追蹤和召回。<br />\n<br />\n<br />\n黃金之風：喬魯諾·喬巴納<br />\n<br />\n<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"https://vignette.wikia.nocookie.net/61383d11-1b40-43c7-a287-565cc9901dea/scale-to-width-down/800\" class=\"img-thumbnail\"><br />\n<br />\n擁有這能賦予生命的能力的茸茸，黃金體驗也是一個看起來雞肋，但是卻大有妙用的替身，不僅可以用來修復，追蹤，而且能召回靈魂，這也是茸茸性格的體現，茸茸是追求希望和正義的，雖然生活的環境烏煙瘴氣，黑幫橫行，但他沒有像他的父親dio那樣性格扭曲，反而嘗試著去改變這一切，賦予生命的能力正是他賦予夥伴希望的體現，喬魯諾性格謹慎，做事細心，但不乏勇氣與智慧，這也是喬魯諾一直能化險為夷的原因。<br />\n<br />\n<br />\n<br />\n《JOJO的奇妙冒險》五部主角性格迥異，但每位JOJO都拿出勇氣與智慧來保護身邊的人，與邪惡鬥爭，正如動漫中所說：人類的讚歌就是勇氣的讚歌！你最喜歡哪位JOJO呢？', 1, '2019-11-30 22:30:30', '2020-02-02 04:27:47', 2),
(6, '北斗神拳十大最強人物戰鬥力指數排行榜', '動漫', '第十名 法魯哥<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://nerditis.files.wordpress.com/2014/02/falco.jpg\" class=\"img-thumbnail\"><br />\n<br />\n人稱帝都金色將軍。其是元斗皇拳最強男及繼承人，有血有肉的好男兒。其在面對拳王雷奧甘願以自己一條腿換回所有元斗村民的生命，連雷奧也為之動容而放棄攻擊。法魯哥是元斗皇拳五將軍之首，也是《北斗神拳之天帝傳》中的最強男，對天帝更是忠心耿耿。如果不是因為有一隻腿是斷的，使用義肢，其實力絕對不在三羅將之中的漢和豹之下。<br />\n<br />\n第九名 漢<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"data:image/jpeg;base64,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\" class=\"img-thumbnail\"><br />\n<br />\n修羅島第三羅將。漢的拳法以速度和切割為主，幾乎與點穴無關，從他的兩大絕招：魔舞紅臊和白羅滅精就可以一目了然！可以說漢的存在是北斗琉拳的BUG，他的招式屬性更接近南斗聖拳——從外部破壞而不是從內部破壞。<br />\n<br />\n第八名 黑夜叉<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://vignette.wikia.nocookie.net/hokuto/images/4/4c/Kuroyasha.jpg/revision/latest?cb=20100718152811\" class=\"img-thumbnail\"><br />\n<br />\n北斗宗家最強僕從，負責保護北斗宗家血脈，消滅已入魔的琉拳武者，羅聖殿中健次郎與雄武對決前出現，並主動提出與雄武交手，戰鬥過程中一度占到上風，卻不慎被雄武布下的陷阱切斷一條手臂，危險時刻被健次郎救下，並目睹了健次郎與雄武交戰的全過程，最後與身受重傷的雄武聯手對付百多名精英級修羅，但由於自己也傷勢過重，不敵而亡。<br />\n<br />\n第七名 豹<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"data:image/jpeg;base64,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\" class=\"img-thumbnail\"><br />\n<br />\n修羅國第二羅將，健次郎的親兄長。豹的實力，在劇中是最難定位的，因為他有三種形態：正常態，入魔態，斗神態，而這三種形態的實力都在完全不同的檔次。斗神態是豹最可怕的狀態，此狀態的豹所施展的絕招已經不是北斗琉拳，而是北斗宗家拳，只有北斗宗家血脈之人才可能施展的終極武術。<br />\n<br />\n第六名 撒奧瑟<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://i.ytimg.com/vi/7x42n26f7HU/maxresdefault.jpg\" class=\"img-thumbnail\"><br />\n<br />\n南斗六聖之一，南斗聖拳最強男子，屬星為極星帝王星，故號稱聖帝。從官方評定結合原著表現來看，撒奧瑟是AA級里，實力最接近AAA級的角色，甚至憑藉其特殊身體，一度凌駕於北斗三兄弟之上，毫無疑問已榮登「本劇頂級高手」之列。<br />\n<br />\n第五名 托奇<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"http://p4.qhimg.com/t014b1adf34a696f90f.jpg?size=480x270\"><br />\n<br />\n拳王拉奧的親弟弟，北斗神拳兩千年最具天賦且擁有最華麗招式的男子，以柔拳著稱，但因核戰爭保護健次郎和尤莉婭而中了核毒身患重病。在托奇的教導下健次郎終於知道如何把北斗神拳發揮至極限與拳王抗衡。他最終在與拉奧的戰鬥中點擊秘穴（剎活孔）用盡全力使出剛拳挑戰拉奧，但終因身體之故不敵拉奧，而拉奧則念兄弟之情未下殺手，托奇最終與為了驗證健次郎北斗繼承人身份並使其覺醒的龍牙一起去世。<br />\n<br />\n第四名 龍拳<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://i.ytimg.com/vi/VYd5jLYTNWM/hqdefault.jpg\" class=\"img-thumbnail\"><br />\n<br />\n北斗掌門人，是他一手開創了北斗最強一代。北斗神拳造詣登峰造極的一代宗師，從他與拉歐一戰使出的奧義【七星點心】，我們可以一目了然他的強悍。北斗史上最強三人組全是他一手教導出來，如果說他自己的實力不過硬，那是絕對不可能的，而且龍拳的武學資歷相當長，幾乎練武練了一輩子，到了老年時，除了究極奧義【無想轉生】，其他所有招式應該都早已爐火純青了。<br />\n<br />\n第三名 拉奧<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"http://i.imgur.com/nqfao.jpg\" class=\"img-thumbnail\"><br />\n<br />\n世紀末霸主－北斗長兄，人稱拳王， 是托奇、サヤカ的哥哥，加奧的弟弟，健次郎、賈基的義兄，北斗神拳中大佬級人物，所向無敵。拉歐用他那戰無不勝的北斗神拳實現他的「霸業」，組建了自己的軍隊，並不斷擴張領土，天下人談之色變。後來他的師弟健次郎為解救百姓幾經波折擊敗了拉歐。被打敗了的拉歐散盡了自己的鬥氣從容死去。<br />\n<br />\n第二名 加奧<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://i1.wp.com/i2.hdslb.com/bfs/archive/186814167d471e5208e1ad003991221859eee04e.jpg?fit=320,200\" class=\"img-thumbnail\"><br />\n<br />\n修羅國第一羅將，自稱新世紀創造主。北斗琉拳最強者。加奧的實力按理來說與拉奧不相上下。想當初拳四郎與拉奧初次交手能打成平手，可到後來拳四郎與加奧初次交手之時卻在根本沒有還手餘地的情況下被打敗，加奧甚至輕易破解了拳四郎所使出的北斗神拳究極奧義無想轉生，其根本原因在於琉拳招式性質的特殊。而且加奧的聰明城府也非一般人所能比擬，謀略過人。<br />\n<br />\n第一名 健次郎<br />\n<br />\n<img style=\"display:block; margin:0 auto; height=50%; width=50%;\" src=\"https://5.share.photo.xuite.net/vscinemas/15982a9/3220541/121134188_m.jpg\" class=\"img-thumbnail\"><br />\n<br />\n他是最強拳法「北斗神拳」的繼承人，胸前有像北斗七星排列形狀的七個傷疤。在文明幾乎毀滅殆盡的世紀末，秉承著「北斗神拳」不滅的精神，以世紀末救世主的身份掃除邪惡與不公，同時也不斷追尋著自己的愛人尤利婭。這是一個強大但不自持、堅韌並且善良、溫情卻不外露的男人，暴力只是他剷除世上罪惡的手段，真正重要的是他那顆永遠不被這亂世所左右的心。', 1, '2019-11-30 22:37:57', '2020-02-02 04:17:44', 12),
(18, '《武漢肺炎》籲美挺台加入WHO 民眾連署向白宮請願', '政治', '<img style=\"display:block; margin:0 auto; hight:50%; width:50%;\" src=\"upload_files/images/phpavtKAt.jpg\" class=\"img-thumbnail\"><br />\n武漢肺炎疫情延燒，全球確診超過1.2萬例，台灣卻因中國不斷阻撓而被拒於世界衛生組織（WHO）防疫體系之外。近日就有民眾在美國白宮連署請願網站發起連署，呼籲美國支持台灣加入世衛組織。<br />\n<br />\n美國白宮「WE the PEOPLE」網站1月30日經署名「C.C」的民眾發起連署，提案內容指出，台灣擁有高品質醫療科技和豐富醫療的經驗，也不斷對醫療問題作出貢獻，卻因中國的反對與施壓，導致台灣始終被排除在世衛組織外，以致當年爆發SARS疫情時，台灣無法從世衛組織獲得即時的防疫資訊。<br />\n<br />\n連署文章強調，如今武漢肺炎疫情持續蔓延，全球防疫工作不應有任何缺口，身處防疫第一線的台灣，為保護台灣2300萬人以及全球安全，「台灣不應再因為政治干預而被排除在WHO之外」。<br />\n<br />\n該連署需要在2月29日前獲得10萬人連署，若達成目標，美國政府須依法在60天內，公開回應此請願內容。截至1日晚間11點30分，連署已有4萬9000人響應。', 1, '2020-02-02 04:34:39', '2020-02-02 04:42:15', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `id` int(10) NOT NULL COMMENT '留言id',
  `content` text NOT NULL COMMENT '內容',
  `create_datetime` datetime NOT NULL COMMENT '建立日期時間',
  `modify_datetime` datetime DEFAULT NULL COMMENT '修改日期時間',
  `create_user_id` int(10) NOT NULL COMMENT '上傳的使用者id',
  `article_id` int(10) DEFAULT NULL COMMENT '所屬文章id',
  `work_id` int(10) DEFAULT NULL COMMENT '所屬相簿id',
  `edit_count` int(10) NOT NULL DEFAULT 0 COMMENT '編輯次數'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`id`, `content`, `create_datetime`, `modify_datetime`, `create_user_id`, `article_id`, `work_id`, `edit_count`) VALUES
(5, '小圈圈板手,nmsl', '2020-01-14 16:19:27', '2020-01-24 01:35:54', 28, 2, NULL, 7),
(9, '獸人進攻', '2020-01-17 01:40:08', NULL, 26, 2, NULL, 0),
(14, '台灣之光,讚!', '2020-01-17 03:15:59', '2020-01-19 15:20:22', 26, 1, NULL, 1),
(35, '還我超負荷= =', '2020-01-19 15:18:01', '2020-01-19 15:19:26', 26, 2, NULL, 4),
(37, '樂色圖奇', '2020-01-26 23:00:24', '2020-08-12 02:04:45', 28, 2, NULL, 9);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL COMMENT '使用者id',
  `username` varchar(50) NOT NULL COMMENT '登入帳號',
  `password` varchar(50) NOT NULL COMMENT '使用者密碼',
  `nickname` varchar(30) NOT NULL COMMENT '暱稱',
  `contact_number` varchar(10) DEFAULT NULL COMMENT '聯絡電話',
  `email_address` varchar(100) NOT NULL COMMENT '電子郵件地址',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `gender` char(1) DEFAULT NULL COMMENT '性別 M=男性,F=女性,T=第三性',
  `registered_datetime` datetime NOT NULL COMMENT '註冊日期時間',
  `modify_datetime` datetime DEFAULT NULL COMMENT '修改日期時間',
  `manager` tinyint(1) NOT NULL DEFAULT 0 COMMENT '管理員為1,使用者為0',
  `validation_code` varchar(6) DEFAULT NULL COMMENT '認證碼',
  `validation` tinyint(1) NOT NULL DEFAULT 0 COMMENT '驗證與否,1為是,0為否'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nickname`, `contact_number`, `email_address`, `birthday`, `gender`, `registered_datetime`, `modify_datetime`, `manager`, `validation_code`, `validation`) VALUES
(26, 'test', '098f6bcd4621d373cade4e832627b4f6', '測試', NULL, 'test@gmail.com', NULL, NULL, '2019-11-28 03:22:36', NULL, 0, NULL, 1),
(28, '123', 'c6f057b86584942e415435ffb1fa93d4', 'Richard黎', '0908693936', 'richardli@gmail.com', '1995-10-28', 'M', '2020-01-18 18:56:44', '2020-08-15 02:57:33', 1, NULL, 1),
(155, '12345678', 'dd4b21e9ef71e1291183a46b913ae6f2', '測試2', NULL, 's4040345678@gmail.com', '1997-07-20', NULL, '2020-08-13 20:57:05', '2020-08-13 21:02:52', 0, NULL, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `work`
--

CREATE TABLE `work` (
  `id` int(10) NOT NULL COMMENT '作品id',
  `title` varchar(100) NOT NULL COMMENT '標題',
  `intro` text NOT NULL COMMENT '簡介',
  `video_path` text DEFAULT NULL COMMENT '影片路徑',
  `youtube_link` text DEFAULT NULL COMMENT 'YOUTUBE連結',
  `publish` tinyint(1) NOT NULL DEFAULT 1 COMMENT '發佈與否 1=發佈,0=不發佈',
  `create_datetime` datetime NOT NULL COMMENT '建立日期時間',
  `modify_datetime` datetime DEFAULT NULL COMMENT '編輯日期時間',
  `create_user_id` int(10) NOT NULL COMMENT '上傳的使用者id',
  `edit_count` int(10) NOT NULL DEFAULT 0 COMMENT '編輯次數'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `work`
--

INSERT INTO `work` (`id`, `title`, `intro`, `video_path`, `youtube_link`, `publish`, `create_datetime`, `modify_datetime`, `create_user_id`, `edit_count`) VALUES
(14, '【愛心片】成為外送人員一起去外送！- 無家者尾牙', '這次受 星展銀行 以及 人生百味邀請參與無家者尾牙的公益活動<br />\n讓我們思考與感受到社會上還有更多需要幫助的人！<br />\n如果未來還有這樣的活動，也希望大家能多多響應跟支持<br />\n也許只是一頓飯，只是一雙鞋<br />\n但對於需要的人來說，都是非常重要的。', NULL, 'https://www.youtube.com/embed/3AEl2Kf2T1w', 1, '2020-02-03 02:06:58', NULL, 0, 0),
(19, 'Justin Bieber - Yummy (Tik Tok Compilation Video)', 'Make sure to watch the Super Bowl tonight. During each commercial break after a team calls timeout, TikTok stars will create content to go along with “Yummy” by Justin Bieber. Participating TikTok personalities include Greg Auerbach, Brittany Broski, David Dobrik, Avani Gregg, Zach King, Joshua Sadowski, Kyle Shaffer, Nick Uhas and Zahra. Join them', 'upload_files/videos/Justin Bieber - Yummy (Tik Tok Compilation Video).mp4', NULL, 1, '2020-02-03 03:16:34', '2020-02-03 04:18:34', 0, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`create_user_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `work_id` (`work_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `article`
--
ALTER TABLE `article`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文章id', AUTO_INCREMENT=28;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '留言id', AUTO_INCREMENT=70;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '使用者id', AUTO_INCREMENT=160;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `work`
--
ALTER TABLE `work`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '作品id', AUTO_INCREMENT=27;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `article_id` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `work_id` FOREIGN KEY (`work_id`) REFERENCES `work` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
