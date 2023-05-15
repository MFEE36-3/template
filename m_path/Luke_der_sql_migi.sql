-- 創建資料表:
CREATE TABLE `mytest`.`address_book` (
    `sid` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `mobile` VARCHAR(20) NOT NULL,
    `line_id` VARCHAR(255) NULL,
    `birthday` DATE NULL,
    `address` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`sid`),
    UNIQUE (`email`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;

-- 新增資料: 欄位名與對應的值都要正確 CURRENT_TIMESTAMP = NOW()
-- 要一次新增多筆的話，上面的格式只要打一次，下面的值那區要打多筆，（）之間要加逗號
INSERT INTO
    `address_book` (
        `sid`,
        `name`,
        `email`,
        `mobile`,
        `line_id`,
        `birthday`,
        `address`,
        `created_at`
    )
VALUES
    (
        NULL,
        '林小華',
        'dsfgs@sfs.com',
        '0918123456',
        '@abcd',
        '1996-04-01',
        '台北市',
        CURRENT_TIMESTAMP
    );

--刪除
DELETE FROM
    address_book
WHERE
    `sid` = 2;

--更新: WHERE不打就是更新所有的資料
UPDATE
    `address_book`
SET
    `email` = 'dsfgs@12sfs.com'
WHERE
    `sid` = 13;

--JOIN語法: 把副資料表透過外鍵合併到主資料表，再呈現新的合併資料
--ON語法: 接在JOIN後面，代表兩張表的什麼欄位是相等的
--AS語法: 類似變數，JOIN時先把兩張表名用簡單的字母代替，也可以空一格來省略AS
SELECT
    P.*,
    C.`name`
FROM
    `products` p
    JOIN `categories` C ON P.category_sid = C.sid;

--IN語法: 想觀測同個資料表的多列資料可以用IN()
SELECT
    P.sid,
    P.bookname,
    P.price,
    C.name
FROM
    products P
    JOIN categories C ON P.category_sid = C.sid
WHERE
    P.sid IN (1, 2);

-- GROUP BY: 選一個欄位作為排序資料的順序
SELECT
    od.product_sid,
    p.bookname,
    p.price
FROM
    orders o
    JOIN order_details od ON o.sid = od.order_sid
    JOIN products p ON p.sid = od.product_sid
WHERE
    o.member_sid = 1
GROUP BY
    od.product_sid;

-- SUM(): 在裡面進行運算，或是計算聚合後的資料某欄位的數值總和
SELECT
    SUM(12 * 5);

-- COUNT(): 計算聚合後的資料行數
-- LIKE: 通常會配合*，放在WHERE的後面，列出符合特定文字的資料
--會員資料庫
CREATE TABLE `project-3`.`member_data` (
    `member_sid` INT NOT NULL AUTO_INCREMENT,
    `account` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `nickname` VARCHAR(20) NOT NULL,
    `mobile` VARCHAR(20) NOT NULL,
    `address` VARCHAR(255) NULL,
    `birthday` DATE NULL,
    `level` VARCHAR(20) NOT NULL,
    `wallet` INT NOT NULL,
    `creat_at` DATETIME NOT NULL,
    PRIMARY KEY (`member_sid`),
    UNIQUE (`account`),
    UNIQUE (`mobile`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;

--儲值資料庫
CREATE TABLE `project-3`.`add_value` (
    `sid` VARCHAR(255) NOT NULL AUTO_INCREMENT,
    `member_id` INT NOT NULL,
    `amount` INT NOT NULL,
    `add_time` DATETIME NOT NULL,
    PRIMARY KEY (`sid`),
    UNIQUE (`member_id`)
) ENGINE = InnoDB CHARSET = utf8mb4 COLLATE utf8mb4_general_ci;