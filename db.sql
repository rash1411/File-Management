CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    subject VARCHAR(255),
    letter_number INT,
    letter_date DATE,
    received_from VARCHAR(255),
    remarks TEXT,
    file_name VARCHAR(255),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);