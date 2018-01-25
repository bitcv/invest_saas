-- CREATE DATABASE IF NOT EXISTS `bit_cv`;
-- USE `bit_cv`;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '用户ID',
    `nickname` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '用户昵称',
    `avatar` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '头像',
    `mobile` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '手机号',
    `email` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '邮箱',
    `passwd` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '密码',
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS `currency_price`;
CREATE TABLE `currency_price` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `from_currency_symbol` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '货币名称',
    `to_currency_symbol` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '货币符号',
    `exchange_rate` FLOAT(20,10) NOT NULL DEFAULT 0 COMMENT '汇率',
    `utime` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '更新时间',
    PRIMARY KEY(id)
);
INSERT INTO currency_price(from_currency_symbol, to_currency_symbol, exchange_rate, utime) VALUES('eth', 'rmb', 6333.66, 1516255860);
INSERT INTO currency_price(from_currency_symbol, to_currency_symbol, exchange_rate, utime) VALUES('eth', 'eth', 1, 1516255860);
INSERT INTO currency_price(from_currency_symbol, to_currency_symbol, exchange_rate, utime) VALUES('btc', 'eth', 11.134617, 1516255860);
INSERT INTO currency_price(from_currency_symbol, to_currency_symbol, exchange_rate, utime) VALUES('ltc', 'eth', 0.18440, 1516255860);
INSERT INTO currency_price(from_currency_symbol, to_currency_symbol, exchange_rate, utime) VALUES('dash', 'eth', 0.79353, 1516255860);

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '项目ID',
    `url` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '项目主页地址',
    `user_id` INT NULL NULL DEFAULT 0 COMMENT '用户ID',
    `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '项目名称',
    `intro` VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '项目简介',
    `white_paper` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '项目白皮书',

    `token_name` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '货币全称',
    `token_symbol` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '货币符号',
    `token_address` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '货币钱包地址',
    `token_public_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '货币钱包公钥',
    `token_private_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '货币钱包公钥',
    `token_wif` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '货币钱包wif',

    `plan_money` FLOAT(20, 5) NOT NULL DEFAULT 0 COMMENT '预计融资数',
    `total_money` FLOAT(20, 5) NOT NULL DEFAULT 0 COMMENT '已募集总金额',
    `start_time` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '开始募集时间戳',
    `end_time` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '结束募集时间戳',

    `company_name` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '公司名称',
    `company_logo` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司Logo',
    `company_address` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司地址',
    `company_email` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '公司邮箱',

    `status` TINYINT NOT NULL DEFAULT 0 COMMENT '项目状态1=审核中;2审核通过',
    `ctime` VARCHAR(20) NOT NULL DEFAULT 0 COMMENT '创建时间',
    PRIMARY KEY(id)
);

INSERT INTO project(title, token_name, plan_money, total_money, intro, white_paper, status, company_name, company_logo, company_address, company_email, ctime, start_time, end_time, url, token_symbol, token_address, token_public_key, token_private_key, token_wif) VALUES('超越时空的虞美人', '达世币', '1000000', '800000', '春花秋月何时了？往事知多少。小楼昨夜又东风，故国不堪回首月明中。雕栏玉砌应犹在，只是朱颜改。问君能有几多愁？恰似一江春水向东流。', 'demo.pdf', 1, '优才创智科技有限公司', 'demo.jpg', '北京海淀区知春路紫金数码园5号楼', 'ucaichuangzhi@email.com', '1515966348', '1515945600', '1518624000', 'localhost:8888/project.php?page=home&projId=1&projSign=003789002404947cd61bfb48987c3307', 'dash', 'Xrk3GEBd3V3ptp5R1H5TxauWT522HBnrke', '035def487521e9b1b3b5b55e601a3386f7899018fe704460ea02c4183d4f2df8be', '41f39a88f9c39ad08b92c84c28e504807cd14cc17be884bdff6db32529b57e32', 'XDVqJvE56kLT4erqwnAKTA6484KjKE8bpiDvC2rXf9WY5RhrfK7q');

DROP TABLE IF EXISTS `proj_wallet`;
CREATE TABLE `proj_wallet` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `currency_symbol` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '货币符号',
    `address` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '钱包地址',
    PRIMARY KEY(id)
);
INSERT INTO proj_wallet(proj_id, currency_symbol, address) VALUES(1, 'eth', '3b7ea3d050786ab4b334a321867c3e7fa90eb4a3');
INSERT INTO proj_wallet(proj_id, currency_symbol, address) VALUES(1, 'btc', '1WaRUehxnH4U7BrZmYhUpf7QYRVkqENDE');

DROP TABLE IF EXISTS `proj_advantage`;
CREATE TABLE `proj_advantage` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `title` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '项目亮点',
    `detail` VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '亮点细节',
    PRIMARY KEY(id)
);

INSERT INTO proj_advantage(proj_id, title, detail) VALUES(1, '交易账本必须是公开的，不可篡改和撤销', '区块链是分布式，在公有链上，等于每个人手上都有一份完整账本，并且由于区块链计算余额、验证交易有效性等等都需要追溯每一笔账，因此交易数据都是公开透明的，如果我知道某个人的账户，我就能知道他的所有财富和每一笔交易，没有隐私可言。');

DROP TABLE IF EXISTS `proj_milestone`;
CREATE TABLE `proj_milestone` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `timestamp` VARCHAR(20) NOT NULL DEFAULT 0 COMMENT '里程碑时间',
    `title` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '里程碑标题',
    `detail` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '里程碑细节',
    PRIMARY KEY(id)
);

INSERT INTO proj_milestone(proj_id, timestamp, title, detail) VALUES(1, 1515966348, '开始网上公开售卖代币', '壬戌之秋，七月既望，苏子与客泛舟游于赤壁之下。清风徐来，水波不兴。举酒属客，诵明月之诗，歌窈窕之章。少焉，月出于东山之上，徘徊于斗牛之间。白露横江，水光接天。纵一苇之所如，凌万顷之茫然。浩浩乎如冯虚御风，而不知其所止；飘飘乎如遗世独立，羽化而登仙。');

DROP TABLE IF EXISTS `proj_member`;
CREATE TABLE `proj_member` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `name` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '成员姓名',
    `photo` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '成员照片',
    `position` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '成员职称',
    `intro` VARCHAR(1000) NOT NULL DEFAULT '' COMMENT '成员简介',
    PRIMARY KEY(id)
);

INSERT INTO proj_member(proj_id, name, photo, position, intro) VALUES(1, '王羲之', 'demo.jpg', 'CEO', '时维九月，序属三秋。潦水尽而寒潭清，烟光凝而暮山紫。俨骖騑于上路，访风景于崇阿；临帝子之长洲，得天人之旧馆。层峦耸翠，上出重霄；飞阁流丹，下临无地。鹤汀凫渚，穷岛屿之萦回；桂殿兰宫，即冈峦之体势。');

DROP TABLE IF EXISTS `proj_report`;
CREATE TABLE `proj_report` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `logo` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '媒体logo',
    `url` VARCHAR(100) NOT NULL DEFAULT '' COMMENT '媒体链接',
    PRIMARY KEY(id)
);
INSERT INTO proj_report(proj_id, logo, url) VALUES(1, 'demo.jpg', 'www.baidu.com');

DROP TABLE IF EXISTS `proj_investor`;
CREATE TABLE `proj_investor` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `nickname` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '投资人昵称',
    `account` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '账号',
    `passwd` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '密码',
    `token_symbol` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '代币符号',
    `token_balance` FLOAT(10,5) NOT NULL DEFAULT 0 COMMENT '持有代币数',
    `token_address` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '代币钱包地址',
    `token_public_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '代币钱包公钥',
    `token_private_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '代币钱包私钥',
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS `investor_wallet`;
CREATE TABLE `investor_wallet` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `investor_id` INT NOT NULL DEFAULT 0 COMMENT '投资人ID',
    `currency_symbol` TINYINT NOT NULL DEFAULT 0 COMMENT '货币符号',
    `private_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '私钥',
    `public_key` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '公钥',
    `address` VARCHAR(200) NOT NULL DEFAULT '' COMMENT '钱包地址',
    `balance` FLOAT(100, 5) NOT NULL DEFAULT 0 COMMENT '钱包余额',
    `ctime` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '创建时间',
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS `investor_purchase_record`;
CREATE TABLE `investor_purchase_record` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `investor_id` INT NOT NULL DEFAULT 0 COMMENT '投资人ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `pay_currency_symbol` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '支付的货币符号',
    `pay_amount` FLOAT(20, 10) NOT NULL DEFAULT 0 COMMENT '支付金额',
    `buy_token_symbol` VARCHAR(10) NOT NULL DEFAULT '' COMMENt '用户购买的代币符号',
    `buy_amount` FLOAT(20, 10) NOT NULL DEFAULT 0 COMMENT '购买数量',
    `purchase_time` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '成交时间戳',
    `ctime` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '创建时间',
    PRIMARY KEY(id)
);

DROP TABLE IF EXISTS `proj_admin`;
CREATE TABLE `proj_admin` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT '自增ID',
    `proj_id` INT NOT NULL DEFAULT 0 COMMENT '项目ID',
    `nickname` VARCHAR(30) NOT NULL DEFAULT '' COMMENT '投资人昵称',
    `account` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '账号',
    `passwd` VARCHAR(50) NOT NULL DEFAULT '' COMMENT '密码',
    PRIMARY KEY(id)
);
INSERT INTO proj_admin(proj_id, nickname, account, passwd) VALUES(1, 'JunderKing', 'junderking@163.com', '87073df84e2f87bd3e705e6874316d4b');
