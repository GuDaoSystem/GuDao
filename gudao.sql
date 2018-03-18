-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2018-03-18 09:51:26
-- 服务器版本： 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gudao`
--

-- --------------------------------------------------------

--
-- 表的结构 `attend`
--

CREATE TABLE IF NOT EXISTS `attend` (
`attend_id` int(10) NOT NULL COMMENT '参加ID',
  `band_id` int(10) NOT NULL COMMENT '乐队ID',
  `show_id` int(10) NOT NULL COMMENT '演出ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- 转存表中的数据 `attend`
--

INSERT INTO `attend` (`attend_id`, `band_id`, `show_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 18, 4),
(11, 19, 4),
(12, 3, 5),
(13, 20, 4),
(14, 21, 5),
(15, 22, 5),
(16, 23, 5),
(17, 9, 5),
(18, 41, 6),
(19, 40, 6),
(20, 42, 6),
(21, 43, 6),
(22, 39, 7),
(23, 38, 7),
(24, 33, 8),
(25, 34, 8),
(26, 3, 8),
(27, 44, 8),
(28, 28, 9),
(29, 11, 9),
(30, 7, 9),
(31, 27, 9),
(32, 29, 9),
(33, 30, 9),
(34, 31, 9),
(35, 45, 9),
(36, 32, 8),
(37, 35, 11),
(38, 24, 11),
(39, 1, 11),
(40, 36, 11),
(41, 37, 11),
(42, 45, 11),
(43, 33, 11),
(44, 38, 11),
(45, 46, 12),
(46, 47, 12),
(47, 48, 12),
(48, 27, 10),
(49, 28, 10),
(50, 29, 10),
(52, 10, 3),
(53, 11, 3),
(54, 12, 3),
(55, 13, 3),
(56, 14, 3),
(57, 15, 3),
(58, 16, 3),
(59, 17, 3);

-- --------------------------------------------------------

--
-- 表的结构 `band`
--

CREATE TABLE IF NOT EXISTS `band` (
`band_id` int(10) NOT NULL COMMENT '乐队ID',
  `band_name` tinytext NOT NULL COMMENT '乐队名称',
  `band_intro` longtext NOT NULL COMMENT '乐队介绍（默认为“孤岛乐队没有介绍“）',
  `band_cover` mediumtext COMMENT '乐队封面',
  `band_initial` char(1) NOT NULL COMMENT '乐队名称首字母'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `band`
--

INSERT INTO `band` (`band_id`, `band_name`, `band_intro`, `band_cover`, `band_initial`) VALUES
(1, '冷气机吹底裤', '冷气机吹底裤乐队，成立于2015年秋。\r\n粤语独立流行新生命乐队，共发布demo专辑两张。\r\n\r\n代表作：《讯号》、《百态人生》、《多么》、《这世界就是这样》、《一抹清凉》等。', 'cover.jpg', 'L'),
(2, '小笼包', '来自广州的独立乐队, 成立于2013年明媚的春天。\r\n你能从他们的音乐里听到很多招牌式的元素：日系数学摇滚律动，受粤地Emo浪潮影响的痕迹，Telecaster吉他水果硬糖般的音色和附点八分音符tap的delay音色。', 'cover.jpg', 'X'),
(3, 'Hyper Slash', '一支燃烧着的宅核、电子核、另类摇滚乐队。 融合青春、魔性與狂暴的新世以 極為狂熱的舞臺表演，向大家呈獻獨壹無二的異次元世界觀。\r\n\r\n乐队成员 \r\nVocal：Soon \r\nGuitar&Program：Folder \r\nBass：Kool  \r\nDrum：Jason Z  \r\n新浪微博：HyperSlash_Official\r\n微信日常号：Hyperslash_Daily', 'cover.jpg', 'H'),
(4, '真军', '一支来自广州电子核乐队\r\n真軍的“真”代表真实\r\n“軍”代表军队勇士\r\n乐队的每一个人都有属于自己的假面，用Electronic core表达属于他们的真实，反映被遮盖的勇气。\r\n他们希望通过音乐卸下自己的假面，表达自己真实的内心！', 'cover.jpg', 'Z'),
(5, 'The Face Haze', '迷糊脸（The Face Haze）乐队成立于2016年的广州。\r\n他们向往上世纪八九十年代The Stone Roses，The Verve，Oasis等曼彻斯特浪潮乐队的情怀，音乐中带着源自于英式吉他摇滚简单而明快的吉他旋律。\r\n他们内心深处想要表达的也许是一种被称为跟不上时代潮流的态度。', 'cover.jpg', 'T'),
(6, 'Cherry', '光鲜亮丽的外表下，是一颗颗苦涩的心。', 'cover.jpg', 'C'),
(7, 'Random Forest', '成军于2016/9/25 \r\n穿行于各种风格的乐队\r\n致力于发出不一样的声音', 'cover.jpg', 'R'),
(8, 'Loading', '尝试着在各路pop，日摇，punk等风格中徘徊，试图创造出自己的嘶吼。', 'cover.jpg', 'L'),
(9, 'Mover', 'Move為感動 Mover即為搬運感動的人\r\n愿望是 将我们的音乐传达给更多的人 感受到我们的声音\r\n终有一日会让人们知道\r\n粤语歌 从未死过\r\n\r\nVocal：吹神\r\nGuitar：丁丁\r\nGuitar：阿聰\r\nBass：医师\r\nKeyboard：樂樂\r\nDrum：啊壹', 'cover.jpg', 'M'),
(10, 'F.I.L', '在新时代以新信念拥抱新生命开创新天地\r\n\r\n乐队风格：新金属\r\n\r\n主唱：Jiu\r\n吉他：Yuan\r\n贝斯：Qujam\r\n鼓：FQMZ', '', 'F'),
(11, '中心南大街', '一些不被在乎的人组成的乐队，就像大学城那条默默无闻的中心南大街一样，2017年6月，乐队成员大换血后重新出发\r\n\r\n风格：流行朋克\r\n\r\n主唱：彦铭\r\n鼓手：一轮\r\n吉他：曾昱\r\n吉他：阿聪\r\n贝斯：阿深', 'cover.jpg', 'Z'),
(12, 'DEVADATTA', 'DEVADATTA乐队成立于2017夏，来自广州，源于热爱。\r\n繁杂尘世，碌碌众生几百万张嘴讲出来几百万个故事\r\n故事当中，故事之外\r\n勇士、懦夫或者是愚蠢、明智\r\n儒生、放荡或者是迂腐、洒脱\r\n有人会在恐惧，恐惧故事中的自己\r\n或者那根本不是他\r\n那只是在社会舆论下成就的一个不甘平庸的木偶\r\n害怕众人的谈论害怕被群体抛弃，明白自己的路该怎么走却不敢踏出一步，最后在彳亍行程中虚耗自己的一生，平淡无奇最终消失在茫茫人海\r\n可是不甘平庸的木偶还是木偶，木偶就是废柴 \r\n那不是我们 \r\n\r\n风格：金属核\r\n\r\n主唱 AD  \r\n吉他 冠希 \r\n吉他 Whale\r\n鼓手 香蕉粤\r\n贝斯 阿发', 'cover.jpg', 'D'),
(13, '丛林法则', '丛林法则（Jungle Rules）于2017年三月份成立于广州大学城\r\n\r\n风格：主要基于英式朋克与独立摇滚\r\n\r\nVocal：李梓彬\r\nGuitar：Jin/浩\r\nBass：陈明煜\r\nDrum：67', 'cover.jpg', 'C'),
(14, '末日儿童', '世界无末日，儿童无未来。\r\n当同学们都在课堂里朗诵课文时\r\n我们蹲在阴暗的厕所里\r\n憋一泡令人窒息的朋克狗屎......\r\n\r\n风格：朋克\r\n\r\n吉他/主唱 反骨\r\n吉他 阿水\r\n貝斯 lison \r\n鼓 一輪', 'cover.jpg', 'M'),
(15, 'SUCCUBUS', '真实，在浮躁虚华的世界里格格不入。\r\n他人无法消化的情绪，溶解在音乐中\r\n寻回真实的自我。\r\nSo simple to be afraid, so simple when you know who we are.\r\n极度情绪化的青年，\r\n迷途后几经波折，\r\n寻找到新的方向，\r\n重新向世人发声。\r\n风格   Emo 情绪硬核   Alternative metal另类金属  Progressive metal 前卫金属\r\nVocal: Moe\r\nGuitar: illumi/嘉欣\r\nBass: 志霖\r\nDrum: Bang', 'cover.jpg', 'S'),
(16, 'RELIC', '成立于2007年，风格为HardRock / Heavy Metal。从某种程度上讲，Relic乐队是当代摇滚乐的异类，不仅因为其一向的低调气质，更主要的是在这个新派摇滚大行其道的时代，Relic乐队一直坚持着80 ''s Old School路线。这些充满力量与激情的作品为听者带来的不仅是感官的刺激，更是在输出一种正常的价值观和自我批判的人生态度，这恰恰就是Relic乐队所拥有的能量，这也正是乐队的与众不同之处。\r\n\r\n风格：HardRock / Heavy Metal\r\n\r\n吉他  高剑锋 吴飞涛 \r\n贝斯  周麟 \r\n主唱  戴维\r\n鼓  王亮\r\n\r\n\r\n乐队主页及作品试听  http://www.douban.com/artist/relic/', 'cover.jpg', 'R'),
(17, '异国人', '异国人 The Foreigners\r\n——来自广州，成立于2016年。\r\n        风格以英式摇滚为基调，但我们也并不惧怕来自流行音乐和其他风格的影响。\r\n歌曲中能听见源于90年代英式摇滚浪潮中的英式吉他乐句，带有迷幻色彩的扫弦，朗朗上口的旋律，以及主唱极具特点的嗓音。同时来自日本的贝斯手有川又让他们的低音部分增添了一些日系摇滚的色彩。在重型音乐盛行的广州算是为数不多不随大流的独立乐队。\r\n       在英式摇滚早已退潮的今天，我们认为，“英式摇滚”是一种态度。\r\n\r\n风格：英伦\r\n\r\n主唱／吉他：木下\r\n吉他：田桑\r\n贝斯：震宇\r\n鼓：楷皓', 'cover.jpg', 'Y'),
(18, 'EMPTY', '在这个貌似物资丰裕的年代，人们缺少自我思维而过着死板沉闷的生活，生无目标，浮夸堕落。佛曰：万物皆空，我们追随着这种理念，抛开一切枷锁，一切由零开始进行创作。风格以：metal core为基础，在该基础上我们将会加入前卫元素和post hardcore的元素。', 'cover.jpg', 'E'),
(19, 'Black Plague', '患上黑死病的无名之徒，只能够在黑暗中默默等待死亡的来临，无论如何怎样绝望地吼叫终是徒劳，黑暗至死的病将会传染至世界的每一处角落，带来灭绝。', 'cover.jpg', 'B'),
(20, 'Human Betrayer', '我們在2015年尾成立,音樂類型是Melodic Death Core ,\r\n歌曲偏重於旋律 ; 爆炸力 ; 壓迫感.\r\n現今的社會一直在沖積著虛假,不平衡 ; 不公平 ; 墮落 ; 貪婪及無理,人性的社會人類已被同化甚久所以我們就以Human Betrayer 作為我們的樂團名字.這名字裡包括了背叛人類當下的體制,抵抗現今所有的不公平,以重型音樂的方式帶給大家我們心中的訊息.', 'cover.jpg', 'H'),
(21, 'toa-T', '我们记录日常，我们刻画细微\r\n我们倾听呢喃私语，热闹喧嚣\r\n 我们诉说心底最深的声音   予你 \r\n不掩埋 不隐藏\r\n \r\n乐队成员\r\n主唱：金鱼\r\n主音：大斐\r\n节奏：阿榜\r\n贝斯：阿蚊\r\n鼓手：飞仔\r\n\r\n作品风格：Emo/Indie Rock \r\n新浪微博：http://weibo.com/toatband\r\n原创作品：http://music.163.com/#/artist?id=12020128\r\n微信公众号：toaT樂隊', 'cover.jpg', 'T'),
(22, 'THE MUFF', '“MUFF”有“笨拙的人，失败”的意思，甚至还有某种不可描述的引申义，据说起这个名字，好像与著名吉他效果器Big Muff有关。这四个平均颜值不低的青年却并不嫌弃“MUFF”，还被音译出了诡异的中文名“大马夫”。车库独立摇滚乐队THE MUFF由此结成。\r\n2015年乐队受邀参加瑞典Getaway RockFestival音乐节，成为第一支登上瑞典音乐节的中国乐队，并在瑞典斯德哥尔摩、耶夫勒等多地演出。\r\n“摇滚乐有太多的噱头，我们只为取悦自己。”', 'cover.jpg', 'T'),
(23, 'Miss Future', 'Vocal:小五\r\nBass：JoJo\r\nDrum:小超\r\nGutiar:猫腿\r\n    \r\n国内新生日式流朋乐队Miss Future成立于2015年初，成员都各自拥有鲜明的特点：少女、横跨次元的正太们、组团经验丰富的轻熟男。成军尚轻，他们年轻的声音早已响彻南粤各大Livehouse和音乐节。\r\n正如他们的名字一样，是“迷失未来”或者“未来小姐”，不确定性的两者都传递着他们的信念：与其迷失逃避，不如向前触摸未来所蕴藏的独特性。', 'cover.jpg', 'M'),
(24, '穷辛', '即使生活不易，但我们仍热爱这音乐。\r\n情谊和热血伴随着我们，\r\n在音乐的道路上，坚持自己的信念。\r\n\r\n穷辛乐队组建于2016年初，来自广东顺德。\r\n由顺德三队核队组成的核噪联盟音乐团体成员之一。\r\n\r\n音乐风格：少女初恋情感疗伤核\r\n原创作品：【躯壳】/【叛逃】/【重生】', 'cover.jpg', 'Q'),
(25, '未能接通', '"唔好意思，您所打既电话暂时未能接通..."\r\n（不好意思，您拨打的电话暂时无法接通）\r\n\r\n四个本地音乐人拼命在做音乐，\r\n将他们的音乐透过不同媒体Dial Out。\r\n而他们，正在等待你拿起话筒Pick Up Call，\r\n细听本土创作的音乐。\r\nPlease Call Back As Soon As Possible.\r\n\r\n【未能接通 Call Back ASAP】，新晋香港90后乐队，\r\n以Funky歌和幽默手法为90后讲出作为社会新鲜人心声。\r\n\r\n曾获奖项：\r\n2014 ⾹港⻘年乐队⼤赛公开组季军\r\n2015 Music Army！乐队⽐赛季军\r\n2016 主唱刘卓轩 【中国好声⾳3】 ⾹港赛区冠军\r\n2017 “我要上迷笛”粤港澳大湾赛区冠军\r\n\r\n音乐风格：Funk、流行\r\n原创作品：【Nothing to Celebrate】、【找籍口是失败者的习惯】、【暂时未能接通】 等', 'cover.jpg', 'W'),
(26, 'KOLOR', '来自香港的摇滚乐队KOLOR组建于2005年，历经十二年磨炼，四位铁汉继续前行。KOLOR目前已发行3张大碟，7张EP，在香港及内地举行过7场专场及4场大型演唱会，在各大音乐节也是重磅的压轴乐队。\r\n\r\n2010-2013年，KOLOR实行Law of 14计划，是近年来乐队少有的音乐作品高产计划。歌曲多以贴近当下时事，获得极大的共鸣。\r\n\r\n2016年全新大碟《TWISTED》，收录多首新歌，传达出“有病就要认，不开心就不要笑”的新概念。\r\n\r\n作为乐坛前辈，KOLOR更是肩负起推动香港独立音乐发展的重担，扶植一代又一代新生独立乐队的歌曲出品和推广。\r\n\r\n音乐风格：流行摇滚\r\n代表作：【围城】、【时差】、【大吟酿】 等', 'cover.jpg', 'K'),
(27, 'Lost Rivers', '欧阳静纯 - Vocal\r\n李昌臻 - Rap/Vocal\r\n张熠檀 - Guitar/Beatbox\r\n张毅 - Keyboard\r\n韦杰汶 - Bass\r\n梁宝鸣 - Drum\r\n\r\n即兴伴奏为主要编曲特色，\r\n风格偏向流行 轻电子乐 民谣 爵士 Bytheway\r\n过阵子会准备尝试剧院金属', '', 'L'),
(28, 'PM7', '这是一支让你会面难忘的新生乐队。\r\n由五个截然不同性格的人从广外五个不同的学院组成，\r\n但是音乐并不会划分这些界限，相遇相知相识的过程就算在这时间短短的一个月来也足以孕育出这支\r\n外表冷酷实则内面热乎的流行摇滚乐队。\r\n请你跟着我们的执着，一起躁动！\r\n成员：\r\n主唱 - 满满\r\n主音 - Jason\r\n节奏 - 康宇\r\n贝斯 - 达泉\r\n鼓手 – Rejec', '', 'P'),
(29, '白洞', '拒绝偏执，拒绝平庸。\r\n演出经历\r\n广外大2016校迎新晚会\r\n广外大2015会计学院迎新晚会\r\nEncore liveclub高校摇滚节\r\n广外大2016暖冬音乐会\r\n2017苏打粉演唱会开场嘉宾等\r\n风格\r\n原创 / 流行 / 摇滚\r\n主唱：杰西\r\n吉他手：Hui,瑞雯\r\n鼓手：可恩\r\n贝斯手：淞锋', 'cover.jpg', 'B'),
(30, 'Red Widows', '是一支来自广外北成立了已经有一年的摇滚乐队，乐队风格主要是硬摇滚以及流行摇滚。这次将是这支年轻的学生乐队最后一次参加暖冬音乐会，带来的是硬摇滚代表乐队AC/DC、Rage Against the Machine以及Guns N’ Roses的代表作。\r\n\r\n风格：硬摇\r\n\r\n主唱：威廉\r\n吉他手：Glenn、日天、阿强\r\n贝斯：呵呵\r\n鼓手：甜甜\r\n键盘：彪姐', 'cover.jpg', 'R'),
(31, 'CHOPS', 'CHOPS乐队成立于2015年10月\r\n乐队成员来自广外、星海\r\n怀着同样的执着和热爱\r\n六个性格迥异的人走到了一起\r\n开始用自己的音乐感染别人\r\n狂热自由躁动释放\r\n我们一起把打不死的摇滚精神唱给世界听\r\n\r\n风格：Pop－punk和 Emo\r\n\r\n主唱：ceci\r\n吉他手：恩全、阿余\r\n贝斯手：轩爷\r\n键盘：欧阳', '', 'C'),
(32, 'ININK', 'ININK，一支来自山城重庆的新派BEATDOWN—HARDCORE乐队。乐队成立于2014年底，其成员均来自重庆本土老牌乐队。他们直接硬朗的表达方式、躁动的重型现场极具张力。MOSH-PIT，CIRCLE-PIT充斥着他们的现场！乐队全新的阵容、歌曲编排带给你前所未有的冲击。CNHC、迷笛音乐节和西南巡演的洗礼让他们更加成熟凶猛。乐队在2017年10月发行了他们的首张EP《以牙还牙》，并展开乐队组建三年以来的首次全国巡演。', 'cover.jpg', 'I'),
(33, 'PROTON', '乐队成立于2017年3月，主要风格为重型/金属，而乐队名 proton 来源于希腊文“第一”，意思是我们希望在重型的基础上加入更多新的元素,每首歌都是一次新的尝试。', 'cover.jpg', 'R'),
(34, '南国起义', '', 'cover.jpg', 'N'),
(35, '蟹老板', '蟹老板（Thanks Cboss）是一支独立乐队，於2015年组成。横着走的螃蟹不做最好的乐队，只为感谢每一位认真聆听我们音乐的老板，因此命名“蟹老板（Thanks Cboss）”。蟹老板乐队曾荣获2016年鼎湖山音乐节高校乐队大赛冠军。', 'cover.jpg', 'X'),
(36, 'SPACE MONKEY', 'space monkey 是成立于2015年的朋克乐队，时刻都是一脸没睡醒除了演出的时候。一位明天艺术家，一位朋克帝，一位南亭国际纹身师，他们承载着广州美术学院一直都有的朋克传统，Space Monkey会告诉你学画画的人很朋克，来让猴子一棒子打醒你的瞌睡！', 'cover.jpg', 'S'),
(37, 'RESELECTION', 'RESELECTION（重新选择）是来自深圳的一支多元素摇滚乐队，以情绪摇滚风格为基础。乐队雏形追朔至2013年，经过几次大换血，在2015年底终于正式成立，并且在成立不久乐队就带着单曲《BREAK DOWN》参加数十场的演出，收获一众粉丝的喜爱。\r\n2000年代初大量的EMO乐队迸发出来，影响了一批玩音乐的80，90后，RESELECTION也不例外，在原有的EMO基础上，混合了日式的旋律，美式的编曲，硬核的节奏型还有暴力的SCREAMO，一口气尝遍摇滚乐中各种让人热血沸腾的元素！', 'cover.jpg', 'R'),
(38, '中环黑的', '风格：硬摇滚 流行金属 布鲁斯摇滚\r\n中环黑的 \r\n在瞬间让你抽离这个现实\r\n用最本质的躁动带你重回80年代\r\n原创作品一直坚持着\r\n80’s old school硬摇滚路线\r\n述说内心世界', 'cover.jpg', 'Z'),
(39, '阿童木乐队', '成军九年，狂噪十年，\r\n参加各大小战役上千场，\r\n流汗不止，泪湿无数！摇滚，何止于此？', 'cover.jpg', 'A'),
(40, '逆向发条', '广州独立摇滚乐队，\r\n在当今社会用正常的逻辑很难去明白一件事，\r\n五个普通的年轻人想用另一种思维\r\n来表达我们内心的一些想法。', 'cover.jpg', 'N'),
(41, 'WANDER', '始于2015年，\r\n一队喜欢氛围的小清新半重型乐队，\r\n最近处于乐队的转型阶段。\r\n\r\n风格：emo/ alternative metal', 'cover.jpg', 'W'),
(42, '幽闭猫', '我们如同一只懵逼的猫\r\n跟致幻剂一起被薛定谔幽闭在人生这个狭小的盒子里\r\n有时磕多了槟榔狂躁四溢\r\n有时幽闭到抑郁垂死呻吟\r\n生死未卜的叠加状态，致死之前先致幻一把\r\nI’m the cat\r\nand UbCat', 'cover.jpg', 'Y'),
(43, '好风水', '从前华立有个不知名的小样乐队，\r\n后来因为风水不好，改名了。\r\n为了乐队以后能有长期的好风水，\r\n大家都在一直努力中。\r\n希望为普罗大众带去好风水，好运气。', 'cover.jpg', 'H'),
(44, 'Shameless', '', 'cover.jpg', 'S'),
(45, '5WAG', '我们可能是一个车祸乐队，也可能因为主唱没来演出，所以不会车祸。\r\n主唱是ODDope，他说唱很厉害，我们要陪他玩，要怪就怪他。', 'cover.jpg', ''),
(46, 'ALPACA', 'Alpaca是来自上海的Sludge Metal乐队，成立于2015年末，成员分别来自四个不同的地区(加拿大、塞尔维亚、台湾、秘鲁)。风格深受Down、Eyehategod、Crowbar、Corrosion of Conformity、Red Fang、Mastodon与Melvins的影响，沉重的降调蓝调是Alpaca的标识。乐队同时负责主导组织一年一度的SHANGHELLFEST音乐节与两个月一次的SHANGHORRORFEST音乐节。', '', 'A'),
(47, 'HEXFIRE', 'HEXFIRE是广州的敲击金属乐队，成立于2012年底。\r\n2015年11月HEXFIRE发行了同名EP。\r\n\r\n成员：\r\n陈穗彬 - 吉他&主唱\r\n林嘉豪 - 吉他\r\n金石开 - 贝斯&主唱', 'cover.jpg', 'H'),
(48, '堆填区', '堆填区 Landfills\r\n[我们在虚浮年代里分泌出病态的喜怒哀乐,\r\n过份得意地瑟缩在这座巨大的堆填区狂欢.]\r\n \r\n乐队诞生于2013年中,最初的开端是由贝斯手方舟、鼓手暐潇与吉他手思帆组成的一支不成形的朋克乐队。\r\n \r\n正式成立于2014年初,继主唱泽荣加入了其中后,乐队风格及阵容再次正式改变及确立。我们不断地尝试着去延伸属于九十年代最真实的噪音,并重新孕育出属于当今时代却又截然不同的风格与思想。\r\n \r\n风格:Alternative Rock(另类摇滚)/Garage punk(车库朋克)/ Post-Grunge(后垃圾)为主。', 'cover.jpg', 'D'),
(49, '玛丽·简', '玛丽·简，Mary Jane，名字源于美国独立民谣创作人Rodriguez “sugar man”中的一句“sweet mary jane”。一个肤浅的女性名字、万花筒般的迷。\r\n\r\n玛丽·简的音乐有SKA的舞动，也有oldschool的直接纯粹。\r\n\r\n没有复兴的妄想，没有改变的奢望。\r\n不论你是psychobilly、skinhead、punk or hardcore kids，同在一起举起拳头大汗淋漓，这就是我们认为玩朋克的所有意义。\r\n\r\nStop to sing, \r\nStop to drink, \r\nAll you want is Mary Jane! ', 'cover.jpg', 'M');

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`comment_id` int(10) NOT NULL COMMENT '评论ID',
  `comment_content` mediumtext NOT NULL COMMENT '评论内容',
  `user_id` int(10) NOT NULL COMMENT '评论者ID',
  `comment_time` datetime NOT NULL COMMENT '评论时间',
  `comment_target` int(1) NOT NULL COMMENT '评论目标（1为演出，2为乐队）',
  `target_id` int(10) NOT NULL COMMENT '目标ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_content`, `user_id`, `comment_time`, `comment_target`, `target_id`) VALUES
(1, '1评论演出2', 1, '2017-12-01 00:00:00', 1, 2),
(2, '1评论乐队2', 1, '2017-12-07 00:00:00', 2, 2),
(10, '1评论演出1', 1, '2017-12-19 00:00:00', 1, 1),
(11, '5评论乐队5', 5, '2017-12-25 00:00:00', 2, 5),
(13, '1324', 1, '2018-03-08 16:07:55', 1, 1),
(14, '牛逼！', 1, '2018-03-08 16:09:46', 1, 1),
(15, 'Encore牛逼！', 1, '2018-03-08 16:10:25', 1, 1),
(16, '正啊！！！！', 1, '2018-03-08 16:11:27', 1, 1),
(17, '测试测试测试测试', 1, '2018-03-08 16:13:42', 1, 1),
(18, 'test', 1, '2018-03-08 16:14:35', 1, 1),
(19, '啊啊啊啊啊啊', 1, '2018-03-08 16:16:09', 1, 1),
(20, '你最牛逼！', 1, '2018-03-08 16:35:37', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
`notice_id` int(10) NOT NULL COMMENT '通知ID',
  `notice_type` int(1) NOT NULL DEFAULT '1' COMMENT '通知类型（1为预售，2为取消，3为变更）',
  `notice_time` date NOT NULL COMMENT '通知时间',
  `notice_content` longtext NOT NULL COMMENT '通知内容',
  `show_id` int(10) NOT NULL COMMENT '演出ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- 转存表中的数据 `notice`
--

INSERT INTO `notice` (`notice_id`, `notice_type`, `notice_time`, `notice_content`, `show_id`) VALUES
(1, 3, '2017-10-18', '[未来现场Future Live 2017 广州站]延期/玛丽简退出', 1),
(2, 1, '2017-12-09', '[“音宴”音乐节]预告', 2),
(3, 1, '2017-10-26', '[11.11光棍重型夜]开始预售啦！', 4),
(4, 1, '2017-12-28', '[中国硬核猛军ININK PAYBACK TOUR CHINA 2017 广州站]预告', 8),
(5, 1, '2017-12-26', '[中国硬核猛军ININK PAYBACK TOUR CHINA 2017 广州站]开始预售啦', 8),
(6, 1, '2017-12-22', '[2018广东跨年嘉年华-高校乐队联合预演] 就在今天！', 11),
(7, 1, '2017-12-21', '[2018广东跨年嘉年华-高校乐队联合预演]预热', 11),
(8, 3, '2017-12-07', '[阿童木乐队2017年“皮外伤”全国十九城巡演广州站]新增嘉宾：中环黑的', 7),
(9, 1, '2017-12-03', '[阿童木乐队2017年“皮外伤”全国十九城巡演广州站]赠票福利：你们的阿童木长大了', 7),
(11, 1, '2017-11-06', '[阿童木乐队2017年“皮外伤”全国十九城巡演广州站]开始预售', 7),
(12, 1, '2017-11-02', '[TO BE WHO YOU ARE]廣州超霸收宮之戰！', 6),
(13, 1, '2017-09-26', '[ALPACA 巡演广州站]预售', 12),
(14, 1, '2017-12-14', '[“音宴”音乐会]就是今天！', 2),
(15, 1, '2017-12-09', '[“音宴”音乐节]预告：听说会长砸锅卖铁才找来了他们……', 2),
(16, 1, '2017-12-10', '[“音宴”音乐会]门票获取/摊宣', 2),
(17, 1, '2017-05-11', '[薄荷音乐节]内有猛料：薄荷音乐节阵容大剧透', 10),
(18, 3, '2017-05-14', '[薄荷音乐节]紧急，今日不宜...', 10),
(19, 1, '2017-05-06', '[薄荷音乐节](霏阳+绿洲) x 音乐节 = 你来了就知道！', 10),
(20, 1, '2016-11-30', '[暖冬音乐会]预告', 9),
(21, 1, '2016-12-10', '[暖冬音乐会]阵容', 9),
(22, 1, '2017-12-15', '[广工大地三校联演]来袭！', 3),
(23, 1, '2017-11-16', '[未来现场Future Live 2017 广州站]赠票', 1),
(24, 1, '2017-10-14', '[WA!WA!WASABI!!音楽祭]今晚！', 5),
(25, 1, '2017-10-03', '[未来现场Future Live 2017 广州站]21蚊睇成晚', 1),
(26, 1, '2017-09-26', '[WA!WA!WASABI!!音楽祭]2.0開SHOW決定 ！校园大暴走始動！', 5);

-- --------------------------------------------------------

--
-- 表的结构 `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
`picture_id` int(10) NOT NULL COMMENT '图片ID',
  `picture_url` mediumtext NOT NULL COMMENT '图片链接',
  `band_id` int(10) NOT NULL COMMENT '乐队ID'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

--
-- 转存表中的数据 `picture`
--

INSERT INTO `picture` (`picture_id`, `picture_url`, `band_id`) VALUES
(1, '20180317210035.jpg', 1),
(2, '20180317210047.jpg', 1),
(3, '20180317210052.jpg', 1),
(4, '20180317210205.jpg', 2),
(5, '20180317211502.jpg', 3),
(6, '20180317210422.jpg', 4),
(7, '20180317210545.jpg', 5),
(8, '20180317213154.jpg', 11),
(9, '20180317214256.jpg', 7),
(10, '20180317213230.jpg', 8),
(11, '20180317212114.jpg', 9),
(12, '20180317212433.jpg', 1),
(13, '20180317212406.jpg', 1),
(14, '20180317220443.jpg', 1),
(15, '20180317220434.jpg', 1),
(16, '20180317210219.jpg', 2),
(17, '20180317210214.jpg', 2),
(18, '20180317210326.jpg', 3),
(19, '20180317210334.jpg', 3),
(20, '20180317210342.jpg', 3),
(21, '20180317210337.jpg', 3),
(22, '20180317211511.jpg', 3),
(23, '20180317210433.jpg', 4),
(24, '20180317210429.jpg', 4),
(25, '20180317210511.jpg', 4),
(26, '20180317213254.jpg', 11),
(27, '20180317213243.jpg', 11),
(28, '20180317214803.jpg', 12),
(29, '20180317214810.jpg', 12),
(30, '20180317214815.jpg', 12),
(31, '20180317214843.jpg', 15),
(32, '20180317214725.jpg', 16),
(33, '20180317214734.jpg', 16),
(34, '20180317214738.jpg', 16),
(35, '20180317215006.jpg', 17),
(36, '20180317211004.jpg', 20),
(37, '20180317212020.jpg', 23),
(38, '20180317212547.jpg', 24),
(39, '20180317212601.jpg', 24),
(40, '20180317220415.jpg', 24),
(41, '20180317212643.jpg', 25),
(42, '20180317212740.jpg', 26),
(43, '20180317214141.jpg', 27),
(44, '20180317214124.jpg', 28),
(45, '20180317214433.jpg', 30),
(46, '20180317214538.jpg', 31),
(47, '20180317215930.jpg', 32),
(48, '20180318102313.jpg', 32),
(49, '20180317220659.jpg', 33),
(50, '20180317220353.jpg', 35),
(51, '20180317220525.jpg', 36),
(52, '20180317220603.jpg', 37),
(53, '20180317221148.jpg', 38),
(54, '20180317221202.jpg', 38),
(55, '20180318105233.jpg', 39),
(56, '20180317221058.jpg', 39),
(57, '20180317221108.jpg', 39),
(58, '20180318103301.jpg', 45),
(59, '20180318110732.jpg', 46),
(60, '20180318110745.jpg', 46),
(61, '20180318110829.jpg', 47),
(62, '20180318110841.jpg', 47),
(63, '20180318110938.jpg', 48),
(64, '20180318110943.jpg', 48),
(65, '20180318150137.jpg', 49),
(66, '20180318150143.jpg', 49),
(67, '20180318150156.jpg', 49),
(68, '20180318150201.jpg', 49),
(69, '20180318150206.jpg', 49);

-- --------------------------------------------------------

--
-- 表的结构 `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
`reply_id` int(10) NOT NULL COMMENT '回复ID',
  `comment_id` int(10) NOT NULL COMMENT '评论ID',
  `reply_content` mediumtext NOT NULL COMMENT '回复内容',
  `reply_time` datetime NOT NULL COMMENT '回复时间',
  `user_id` int(10) NOT NULL COMMENT '回复用户ID',
  `target_id` int(10) NOT NULL COMMENT '被回复用户ID',
  `isRead` int(1) NOT NULL DEFAULT '0' COMMENT '是否已读（0为未读，1为已读）'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `reply`
--

INSERT INTO `reply` (`reply_id`, `comment_id`, `reply_content`, `reply_time`, `user_id`, `target_id`, `isRead`) VALUES
(1, 1, '5回复1', '2017-12-01 00:09:00', 5, 1, 1),
(2, 1, '1回复5', '2017-12-01 00:12:00', 1, 5, 0),
(4, 15, '你最牛逼！', '2018-03-08 16:41:48', 1, 1, 1),
(5, 14, '你最牛逼！', '2018-03-08 16:42:09', 1, 1, 1),
(6, 15, '你也牛逼！', '2018-03-08 16:48:16', 1, 1, 1),
(7, 1, '555555555', '2018-03-16 11:49:15', 1, 5, 0);

-- --------------------------------------------------------

--
-- 表的结构 `show`
--

CREATE TABLE IF NOT EXISTS `show` (
`show_id` int(10) NOT NULL COMMENT '演出ID',
  `show_name` tinytext NOT NULL COMMENT '演出名称',
  `show_time` datetime NOT NULL COMMENT '演出时间',
  `show_place` tinytext NOT NULL COMMENT '演出地点',
  `show_address` mediumtext NOT NULL COMMENT '演出具体地址',
  `show_message` longtext COMMENT '演出信息',
  `show_ticket` int(3) NOT NULL DEFAULT '0' COMMENT '演出门票',
  `show_poster` mediumtext COMMENT '演出海报',
  `show_state` int(1) NOT NULL DEFAULT '1' COMMENT '演出状态（1为预售，2为取消，3为变更，4为结束）'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `show`
--

INSERT INTO `show` (`show_id`, `show_name`, `show_time`, `show_place`, `show_address`, `show_message`, `show_ticket`, `show_poster`, `show_state`) VALUES
(1, '未来现场Future Live 2017 广州站', '2017-11-18 19:00:00', 'Encore LiveClub', '广州大学城南亭商业区南亭大道35号顶层', '闪耀而糜烂，自由又迷失\r\n宏伟而扭曲，脆弱且纯粹\r\n\r\n首先跟大家说声抱歉！这场演出因不可抗力必须延期。玛丽简因档期问题无法继续参演。很痛心玛丽简的退出！为表诚意，我们另外邀请了2支优秀乐队参演。由4队变5队，票价不变，酒水不变！11月18日晚7点 ，依然在Encore！一场肤浅的演出，带来流行/宅核/摇滚/英伦/电子核五种万花筒般的迷！预售：¥21(不含酒)¥30（含1支啤酒） 现场：¥40（含1支啤酒）', 40, '1.jpg', 3),
(2, '“音宴”音乐会', '2017-12-14 19:30:00', '广东外语外贸大学', '学生活动中心二楼', '既然你有勇气点开\r\n我们的故事就开始了\r\n\r\n\r\n门票获取\r\n\r\n想来吗？\r\n可是，老规矩，\r\n门票！！！\r\n门票领取途径？\r\n悄咪咪告诉你\r\n\r\n一、刷脸\r\n各种狂撩霏阳管理层大佬\r\n卖萌，请奶茶，请宵夜，\r\n软磨硬泡，\r\n最终取得门票\r\n\r\n二、成为霏阳会员\r\n（一入霏阳深似海）\r\n即可享有赠票特权\r\n可无条件获得门票\r\n\r\n三、玩游戏\r\n去霏阳的摊宣玩游戏拿呗\r\n\r\n\r\n摊宣\r\n\r\n12.13  \r\n中午 11：30-13：00  \r\n下午 17：00-18：30  \r\n隧道口  \r\n霏阳摊宣 等你来咯', 0, '2.jpg', 1),
(3, '广工大地三校联演', '2017-12-16 17:00:00', 'Encore LiveClub', '广州大学城南亭商业区南亭大道35号顶层', '大地卅载之际，三校区再次聚首用最震撼的音符，撼动这土地这一年的大地专场是你的专场也是每一个人的专场', 0, '3.jpg', 1),
(4, '11.11光棍重型夜', '2017-11-11 20:00:00', 'Encore LiveClub', '广州大学城南亭商业区南亭大道35号顶层', '继周年重型专场系列-毁灭音场-之后，我们在重型道路上再接再厉，将更好的音乐带给大家。HILLTOP三大巨头乐队将在11.11与你一起high！这个光棍节没有光棍，因为，你已经被我们的音乐包围啦~~！！这个光棍节我们在ENCORE live house！！等着你！！预售：￥40现场：￥60', 60, '4.jpg', 1),
(5, 'WA!WA!WASABI!!音楽祭', '2017-10-14 19:30:00', 'Encore LiveClub', '广州大学城南亭商业区南亭大道35号顶层', '敬启！各位在校学子，你是否刚经历了一次大学教导员和系院主任不明所以的开学校园守则等各种教科书式宣讲？*此处已默默看到大家略显尴尬而又不失礼貌的微笑*——所以我们决定要搞点热血的事情来个《真の開学式》预售50  现场70', 70, '5.jpg', 1),
(6, 'TO BE WHO YOU ARE', '2017-11-10 19:00:00', 'NT Livehouse', '广州大学城穗石村东门广场一楼涂鸦墙处', '原于10.20舉辦的十月份的第二场！被推遲到了11.10！！但是不影響我們要和大家pogo的熱情！如果你是核狗、emo党等等等等等，我们繼續撩倒你！！！预售40 现场50', 50, '6.jpg', 1),
(7, '阿童木乐队2017年“皮外伤”全国十九城巡演广州站', '2017-12-08 20:30:00', 'NT Livehouse', '广州大学城穗石村东门广场一楼涂鸦墙处', '时间回到十多年前的树村，那时的摇滚乐孤独、贫穷，但那时的摇滚乐也是最热血、最纯粹的。就在那时，阿童木就已经存在。2000年，阿童木乐队的主唱兼吉他手黑狼（也叫黑锅）在南宁组建了阿童木乐队，随后他带着他的梦想带着他的阿童木来到了北京。十多年过去，乐队走过很多地方，中间换了很多的乐手，而黑狼是唯一一个从当初走到现在的成员。说起黑狼这个名字的由来，他说“因为当时玩乐队很多人都起个狼啊、虎啊的名字，我皮肤比较黑，所以就叫黑狼了”离开北京后，黑狼辗转去了厦门，广州，宁夏，浙江等地游唱。生活依旧坎坷不平，但心情逐渐波澜不惊，音乐在这一路一步一步走来，都成了积淀。 05年底，黑狼来到东莞，行走的乐队终于找到了一个安定的地方，在东莞扎下了根。一边商演、驻唱、受邀参加各类音乐节，一边开始创作。        阿童木乐队经受了层层考验，逐渐取得了认可。终于在10年阿童木乐队第一次参加东莞第七届摇滚乐队先锋大赛并荣获冠军，12年参加贝塔斯瑞音响工程全国第七届摇滚乐队大赛获全国总决赛季军，16年获“华晨乐势力in乐乐队大赛“全国总决赛季军，同年参加我要上迷笛获得冠军。虽然十多年来大小的演出经历了千余场，而他更迫切的希望是，能做出第一张完整的专辑，把自己对音乐的理解和诠释，掏心掏肺地和更多的人分享。     所谓十年磨一剑，今年阿童木终于发行了自己的第一张专辑，并且即将带着它进行全国巡演。希望在巡演的路上遇到更多的你们，与你分享属于阿童木的故事。（以上部分内容摘自“有格Yoge”）预售/50 现场/70', 70, '7.jpg', 3),
(8, '中国硬核猛军ININK PAYBACK TOUR CHINA 2017 广州站', '2017-12-30 20:00:00', 'NT Livehouse', '广州大学城穗石村东门广场一楼涂鸦墙处', '我们选择了地下，选择了用强硬的态度面对这个世界。这是硬核音乐应该传达的精神，是我们所认可的一种执著的信念文化。”ININK于2017年10月正式签约上海独立音乐厂牌星团音乐，首张EP「以牙还牙」也在同月发行。11月ININK 将携 EP 从昆明开始乐队组建三年以来的首次全国巡演。无论在哪个城市，ININK 都将回报给喜欢硬核音乐的人最强劲、炸裂的现场。预售60 / 现场80', 80, '8.jpg', 1),
(9, '暖冬音乐会', '2016-12-11 18:00:00', '广东外语外贸大学', '学生活动中心二楼', '霏阳吉他协会暖冬音乐会将于12月11日晚上在学生活动中心二楼举办届时有乐队/弹唱/指弹等多种形式音乐演出免门票欢迎大家# 这 是 个 暖 冬 #', 0, '9.jpg', 1),
(10, '薄荷音乐节', '2017-05-31 19:00:00', '广东外语外贸大学', '学生活动中心多功能厅', '霏阳+绿洲+薄荷音乐节=@#￥%*？\r\n\r\n霏阳在那儿了\r\n咦\r\n绿洲也在那儿了\r\n\r\n我就懵逼了\r\n我走错薄荷音乐节的片场了吧\r\n\r\n这究竟是谁的舞台？\r\n\r\n别猜\r\n\r\n必须是\r\n\r\n大家来 大家来\r\n大家一起来\r\n的舞台\r\n\r\n所以音乐的魔药一股脑瞎搅和\r\n能爆炸吗\r\n\r\n广外两大玩音乐社团\r\n音乐化学中的强碱遇上强酸\r\n\r\n霏阳 & 绿洲\r\n\r\n首次联手\r\n一起操刀\r\n带你一起嗨翻天\r\n\r\n还有\r\n薄荷味的音乐节和夏天交汇\r\n\r\n# 薄 荷 音 乐 节 #\r\n这事打算搞多大\r\n\r\n(霏阳+绿洲)x音乐节=@#￥%&*？\r\n\r\n\r\n怎么解\r\n你来了就知道', 0, '10.jpg', 3),
(11, '2018广东跨年嘉年华-高校乐队联合预演', '2017-12-22 16:00:00', 'NT Livehouse', '广州大学城穗石村东门广场一楼涂鸦墙处', '这段时间，我们见了许多有趣风格各异的乐队，他们都充满活力，青春四溢！在经历一番角逐后，我们选出了8支手速超群 错了手艺超群的乐队！', 0, '11.jpg', 1),
(12, 'ALPACA 巡演广州站', '2017-10-08 20:00:00', 'NT Livehouse', '广州大学城穗石村东门广场一楼涂鸦墙处', '10.08号来自上海的ALPACA乐队还有两支广州的乐队HEXFIRE堆填区 Landfills将在广州NT livehouse一起噪翻大学城门票：预售50  现场60', 60, '12.jpg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `support`
--

CREATE TABLE IF NOT EXISTS `support` (
`support_id` int(10) NOT NULL COMMENT '支持ID',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `band_id` int(10) NOT NULL COMMENT '乐队ID',
  `support_time` date NOT NULL COMMENT '支持时间'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `support`
--

INSERT INTO `support` (`support_id`, `user_id`, `band_id`, `support_time`) VALUES
(1, 1, 2, '2017-11-01'),
(2, 1, 8, '2017-12-01'),
(4, 5, 1, '2017-10-17'),
(5, 5, 2, '2017-12-12'),
(7, 5, 4, '2017-12-22');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(10) NOT NULL COMMENT '用户ID',
  `email` tinytext NOT NULL COMMENT '邮箱',
  `password` tinytext NOT NULL COMMENT '密码',
  `username` tinytext NOT NULL COMMENT '用户名（默认为“孤岛没有名字”）',
  `gender` char(1) NOT NULL DEFAULT 'M' COMMENT '性别',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `headshot` mediumtext COMMENT '头像链接',
  `intro` longtext NOT NULL COMMENT '简介（默认为“孤岛没有简介”）',
  `token` tinytext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `username`, `gender`, `birthday`, `headshot`, `intro`, `token`) VALUES
(1, 'ng.winglam@qq.com', '3049a1f0f1c808cdaa4fbed0e01649b1', 'NgWingLam', 'F', '1996-06-06', '1.jpg', '我是吴颖琳。', '6700803f95f17d2443d81a0e5e55fd2b'),
(5, 'test@test.com', '2a04fb82ed0892fb753d00b6812aa63c', '孤岛没有名字', 'M', NULL, NULL, '孤岛没有简介', '3be0faa3f3d2e2cb15daa51f30dfb718');

-- --------------------------------------------------------

--
-- 表的结构 `want`
--

CREATE TABLE IF NOT EXISTS `want` (
`want_id` int(10) NOT NULL COMMENT '想看ID',
  `user_id` int(10) NOT NULL COMMENT '用户ID',
  `show_id` int(10) NOT NULL COMMENT '演出ID',
  `want_time` date NOT NULL COMMENT '想看时间'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `want`
--

INSERT INTO `want` (`want_id`, `user_id`, `show_id`, `want_time`) VALUES
(5, 5, 1, '2018-03-14'),
(16, 1, 1, '2018-03-08'),
(17, 1, 2, '2018-03-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attend`
--
ALTER TABLE `attend`
 ADD PRIMARY KEY (`attend_id`), ADD UNIQUE KEY `attend_id` (`attend_id`);

--
-- Indexes for table `band`
--
ALTER TABLE `band`
 ADD PRIMARY KEY (`band_id`), ADD UNIQUE KEY `band_id` (`band_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`comment_id`), ADD UNIQUE KEY `comment_id` (`comment_id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
 ADD PRIMARY KEY (`notice_id`), ADD UNIQUE KEY `notice_id` (`notice_id`);

--
-- Indexes for table `picture`
--
ALTER TABLE `picture`
 ADD PRIMARY KEY (`picture_id`), ADD UNIQUE KEY `picture_id` (`picture_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
 ADD PRIMARY KEY (`reply_id`);

--
-- Indexes for table `show`
--
ALTER TABLE `show`
 ADD PRIMARY KEY (`show_id`), ADD UNIQUE KEY `show_id` (`show_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
 ADD PRIMARY KEY (`support_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `want`
--
ALTER TABLE `want`
 ADD PRIMARY KEY (`want_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attend`
--
ALTER TABLE `attend`
MODIFY `attend_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '参加ID',AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `band`
--
ALTER TABLE `band`
MODIFY `band_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '乐队ID',AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论ID',AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
MODIFY `notice_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '通知ID',AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `picture`
--
ALTER TABLE `picture`
MODIFY `picture_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '图片ID',AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
MODIFY `reply_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '回复ID',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `show`
--
ALTER TABLE `show`
MODIFY `show_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '演出ID',AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
MODIFY `support_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '支持ID',AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `want`
--
ALTER TABLE `want`
MODIFY `want_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '想看ID',AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
