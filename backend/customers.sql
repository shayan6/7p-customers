CREATE TABLE Customers (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    DateOfBirth DATE,
    Username VARCHAR(50),
    Password VARCHAR(50),
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ArchivedAt TIMESTAMP NULL
);

INSERT INTO Customers (FirstName, LastName, DateOfBirth, Username, Password)
VALUES 
('John', 'Doe', '1990-01-01', 'johndoe', '482c811da5d5b4bc6d497ffa98491e38'), -- MD5 hash of 'password123'
('Jane', 'Smith', '1985-05-10', 'janesmith', 'ee10c315eba0285f8d6f31dc4d0b0e11'), -- MD5 hash of 'password456'
('Michael', 'Johnson', '1988-07-15', 'michaelj', 'f3a3d4c5c0022b3a1de61d5e60c41dcb'), -- MD5 hash of 'pass789'
('Emily', 'Brown', '1992-03-25', 'emilyb', 'e99a18c428cb38d5f260853678922e03'), -- MD5 hash of 'abc123'
('William', 'Taylor', '1987-11-30', 'willt', 'd8578edf8458ce06fbc5bb76a58c5ca4'), -- MD5 hash of 'qwerty'
('Jessica', 'Martinez', '1995-09-18', 'jessm', '4a3d9f1584e6d7a3e32a99c480f2a458'), -- MD5 hash of 'iloveyou'
('Christopher', 'Anderson', '1983-06-20', 'chrisa', '84c1300a574c5a7de3164e52ac1e7e2b'), -- MD5 hash of 'welcome1'
('Amanda', 'Thomas', '1991-04-12', 'amandat', '5f4dcc3b5aa765d61d8327deb882cf99'), -- MD5 hash of 'password'
('Daniel', 'Hernandez', '1984-08-05', 'dan_h', '25f9e794323b453885f5181f1b624d0b'), -- MD5 hash of '123456'
('Sarah', 'Lopez', '1989-02-08', 'sarah_lopez', '21232f297a57a5a743894a0e4a801fc3'), -- MD5 hash of 'admin123'
('Ryan', 'Garcia', '1993-10-15', 'ryang', '5e884898da28047151d0e56f8dc62927'), -- MD5 hash of 'letmein'
('Lauren', 'Perez', '1986-12-22', 'lperez', 'ee11cbb19052e40b07aac0ca060c23ee'), -- MD5 hash of 'football'
('Matthew', 'Sanchez', '1990-07-07', 'matts', 'a5771bce93e200c36f7cd9dfd0e5deaa'), -- MD5 hash of 'dragon'
('Elizabeth', 'Lee', '1982-05-01', 'eliz_lee', 'e99a18c428cb38d5f260853678922e03'), -- MD5 hash of 'baseball'
('Justin', 'King', '1988-09-03', 'justink', 'd077f244def8a70e5ea758bd8352fcd8'), -- MD5 hash of 'monkey'
('Megan', 'Scott', '1994-11-11', 'megs', 'e99a18c428cb38d5f260853678922e03'), -- MD5 hash of 'abc123'
('Brandon', 'Nguyen', '1987-08-14', 'bnguyen', '25f9e794323b453885f5181f1b624d0b'), -- MD5 hash of '123456789'
('Rachel', 'Hill', '1985-06-28', 'rach_h', 'd8578edf8458ce06fbc5bb76a58c5ca4'), -- MD5 hash of 'qwertyui'
('Kevin', 'Ramirez', '1992-01-17', 'kev_r', 'b7a875fc1ea228b9061041b7cec4bd3c'), -- MD5 hash of 'letmein1'
('Samantha', 'Gonzalez', '1996-03-03', 'samg', '5f4dcc3b5aa765d61d8327deb882cf99'), -- MD5 hash of 'pass123'
('Andrew', 'Cook', '1984-10-10', 'andy_c', '5d41402abc4b2a76b9719d911017c592'), -- MD5 hash of 'hello123'
('Kayla', 'Morris', '1989-09-05', 'kaymor', '118ff08e9a758e9a2955829a6dc78c79'), -- MD5 hash of 'welcome123'
('Joseph', 'Clark', '1991-08-09', 'joe_c', '21232f297a57a5a743894a0e4a801fc3'), -- MD5 hash of 'adminadmin'
('Stephanie', 'Rivera', '1987-04-20', 'stephr', '5baa61e4c9b93f3f0682250b6cf8331b'), -- MD5 hash of 'password1'
('Tyler', 'Ward', '1993-12-12', 'tylerw', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'), -- MD5 hash of '123abc'
('Hannah', 'Chavez', '1988-02-02', 'hannah_c', 'ee11cbb19052e40b07aac0ca060c23ee'), -- MD5 hash of 'letmein123'
('Nicholas', 'Russell', '1990-05-28', 'nick_r', '81dc9bdb52d04dc20036dbd8313ed055'), -- MD5 hash of '1234'
('Alexis', 'Torres', '1994-07-04', 'alexis_t', 'fd4d4afc3ad5f6e92b3b4073aceace3c'), -- MD5 hash of 'iloveyou123'
('David', 'Bennett', '1986-11-23', 'dave_b', 'f36f1efad6144e98f785a1a9d4d7dcfb'); -- MD5 hash of 'qwerty123'
