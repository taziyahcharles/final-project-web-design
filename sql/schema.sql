-- Create schema and sample data for Pet Haven
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(150) UNIQUE,
  password VARCHAR(255),
  role VARCHAR(20) DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS animals (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  species VARCHAR(50),
  age INT,
  photo VARCHAR(255),
  description TEXT
);

CREATE TABLE IF NOT EXISTS messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150),
  email VARCHAR(150),
  message TEXT,
  animal_id INT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample admin user (password: adminpass)
INSERT INTO users (name,email,password,role) VALUES
('Admin','admin@example.com', '$2b$12$NzCfjBmiFVqF/tv1jr4r6eRLPxfiNxnbsVBQmM3Xd4mvPcTie3Tai', 'admin');

-- sample animals
INSERT INTO animals (name,species,age,photo,description) VALUES
('Bella','Dog',3,'images/dog1.jpg','Friendly medium-size dog. Good with kids.'),
('Milo','Cat',2,'images/cat1.jpg','Playful indoor cat. Litter trained.'),
('Luna','Rabbit',1,'images/rabbit.jpg','Calm rabbit, loves carrots.');
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,                    -- if logged in, store their ID
    donor_name VARCHAR(255) NULL,        -- if donating without an account
    donor_email VARCHAR(255) NULL,

    amount DECIMAL(10,2) NOT NULL,       -- donation amount
    donation_type ENUM('one-time', 'monthly') NOT NULL,

    donated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
