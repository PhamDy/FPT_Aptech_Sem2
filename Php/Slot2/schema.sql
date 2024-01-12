-- Tạo database
CREATE DATABASE fptaptechdb
    use fptaptechdb;

-- Tạo bảng Account
CREATE TABLE account(
    id INT PRIMARY KEY,
    username VARCHAR(30),
    password VARCHAR(30)
);

INSERT INTO account VALUES (1, 'admin', 'admin123');
SELECT * FROM account WHERE username =  'admin' AND password = 'admin123';

-- Tạo bảng Students
CREATE TABLE students (
    id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    address VARCHAR(255)
);

-- Tạo bảng Subject
CREATE TABLE subjects (
     id INT AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(255) NOT NULL
);

-- Tạo bảng Marks
CREATE TABLE marks(
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    subject_id INT,
    mark FLOAT,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (subject_id) REFERENCES subjects(id)
);

-- Dữ liệu mẫu
INSERT INTO students (id, name, address) VALUES
    (1, 'John Doe', '123 Main Street'),
    (2, 'Jane Smith', '456 Oak Avenue'),
    (3, 'John Doe', '789 Elm Lane'),
    (4, 'John Doe', '987 Pine Road'),
    (5, 'John Doe', '654 Birch Street');

-- Dữ liệu bảng Subject
INSERT INTO subjects (name) VALUES
    ('Mathematics'),
    ('Physics'),
    ('Chemistry'),
    ('Biology'),
    ('History');

-- Dữ liệu bảng Marks
INSERT INTO marks (student_id, subject_id, mark) VALUES
    (1, 1, 9.5),
    (2, 2, 8.0),
    (3, 1, 9.3),
    (4, 3, 8.7),
    (5, 2, 9.2);