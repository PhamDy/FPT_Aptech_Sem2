
-- Tạo bảng employees
CREATE TABLE employees  (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            username VARCHAR(255) NOT NULL,
                            pwd VARCHAR(255) NOT NULL,
                            start_date DATE NOT NULL,
                            position VARCHAR(255) NOT NULL,
                            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Tạo bảng performances
CREATE TABLE performances (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              employee_id INT NOT NULL,
                              years YEAR NOT NULL,
                              months INT NOT NULL,
                              `days_off` INT NOT NULL,
                              `working_days` INT NOT NULL,
                              `efficiency_rate` DOUBLE NOT NULL,
                              FOREIGN KEY (employee_id) REFERENCES employees(id),
                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Tạo bảng time_sheets
CREATE TABLE time_sheets  (
                              id INT AUTO_INCREMENT PRIMARY KEY,
                              employee_id INT NOT NULL,
                              work_date DATE NOT NULL,
                              start_time TIME NOT NULL,
                              `end_time` TIME NOT NULL,
                              `late` TINYINT(1) DEFAULT 0,
                              `leave_early` TINYINT(1) DEFAULT 0,
                              `attendance` INT DEFAULT 0,
                              FOREIGN KEY (employee_id) REFERENCES employees(id),
                              created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                              updated_at TIMESTAMP NULL DEFAULT NULL
);

INSERT INTO employees (username, pwd, start_date, position)
VALUES ('nguyenduyhoang', '1', '2024-1-1', 'staff');

INSERT INTO time_sheets (employee_id, work_date, end_time, leave_early)
VALUES (1, '2024-02-20', '17:59:57', 1);

UPDATE time_sheets
SET end_time = '17:59:57' , leave_early = 1
WHERE employee_id = 1 AND work_date = '2024-02-20';


INSERT INTO performances (employee_id, years, months)
VALUES (1, '2024', 1),
       (1, '2024', 2),
       (1, '2024', 3),
       (1, '2024', 4),
       (1, '2024', 5),
       (1, '2024', 6),
       (1, '2024', 7),
       (1, '2024', 8),
       (1, '2024', 9),
       (1, '2024', 10),
       (1, '2024', 11),
       (1, '2024', 12);

