
-- Tạo bảng Account
CREATE TABLE account(
                        id INT PRIMARY KEY,
                        username VARCHAR(30),
                        password VARCHAR(30)
);

INSERT INTO account VALUES (1, 'admin', 'admin123');

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
