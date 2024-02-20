-- Tạo bảng customer
CREATE TABLE customer (
                          id INT PRIMARY KEY,
                          username VARCHAR(255) NOT NULL,
                          pwd VARCHAR(255) NOT NULL,
                          address VARCHAR(255) NOT NULL,
                          phone VARCHAR(255) NOT NULL
);
-- Tạo bảng product
CREATE TABLE product (
                         id INT AUTO_INCREMENT PRIMARY KEY,
                         name VARCHAR(255) NOT NULL,
                         img VARCHAR(255) NOT NULL,
                         price DOUBLE NOT NULL,
                         product_desc TEXT NULL
);

-- Tạo bảng order
CREATE TABLE orders(
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       customer_id INT NOT NULL,
                       order_date TIMESTAMP NULL,
                       FOREIGN KEY (customer_id) REFERENCES customer(id)
);

-- Tạo bảng order_details
CREATE TABLE order_details (
                               id INT AUTO_INCREMENT PRIMARY KEY,
                               product_id INT NOT NULL,
                               order_id INT NOT NULL,
                               price DOUBLE NOT NULL,
                               quantity INT NOT NULL,
                               order_details_date TIMESTAMP,
                               FOREIGN KEY (product_id) REFERENCES product(id),
                               FOREIGN KEY (order_id) REFERENCES orders(id)
);

-- Add dữ liệu
INSERT INTO product (id, name, img, price, product_desc) VALUES
                                                             (1, 'adidas1', 'https://img.upanh.tv/2024/01/07/adidas1.1.jpg' ,50, 'ok1'),
                                                             (2, 'adidas2','https://img.upanh.tv/2024/01/07/adidas1.2.jpg' ,100, 'ok2'),
                                                             (3, 'adidas3',' https://img.upanh.tv/2024/01/07/adidas1.3.jpg' ,150, 'ok3'),
                                                             (4, 'adidas4',' https://img.upanh.tv/2024/01/07/adidas2.2.jpg' ,200, 'ok4'),
                                                             (5, 'adidas5', 'https://img.upanh.tv/2024/01/07/adidas2.1.jpg', 250 ,'ok5'),
                                                             (6, 'adidas6', 'https://img.upanh.tv/2024/01/07/adidas2.3.jpg', 300 ,'ok6');

INSERT INTO customer (id, username, pwd, address, phone) VALUES
    (1, 'nampham','1', 'Ha Noi', '0396123456');

INSERT INTO orders (id, customer_id, order_date) VALUES
                                                     (1, 1,'2023-01-12'),
                                                     (2, 2,'2023-02-12'),
                                                     (3, 2,'2023-05-02');

INSERT INTO order_details (id, product_id, order_id, price, quantity, order_details_date) VALUES
                                                                                              (1, 1, 1, 50, 2, '2023-01-11'),
                                                                                              (2, 2, 1, 60, 3, '2023-01-13'),
                                                                                              (3, 2, 2, 70, 4, '2023-01-14');
