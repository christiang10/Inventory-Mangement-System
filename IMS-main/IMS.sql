-- SQLBook: Code

CREATE DATABASE ims;
-- Product Table
CREATE TABLE Product (
    ProductID INT AUTO_INCREMENT PRIMARY KEY, -- Unique product id
    ProductName VARCHAR(255) NOT NULL,        -- Name of the product
    CategoryID INT,                           -- Foreign key to Category table
    SupplierID INT,                           -- Foreign key to Supplier table
    Price DECIMAL(10, 2) NOT NULL             -- Price of the product
);

-- Supplier Table
CREATE TABLE Supplier (
    SupplierID INT AUTO_INCREMENT PRIMARY KEY, -- Unique supplier id
    ContactInformation TEXT                    -- Contact info of the supplier
);

-- Customers Table
CREATE TABLE Customers (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY, -- Unique customer id
    ContactInformation TEXT                    -- Contact info of the customer
);

-- Orders Table
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,    -- Unique order id
    CustomerID INT NOT NULL,                   -- Foreign key to Customers table
    OrderDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Date and time of the order
);

-- Order Details Table
CREATE TABLE OrderDetails (
    OrderDetailID INT AUTO_INCREMENT PRIMARY KEY, -- Unique id for the order detail
    OrderID INT NOT NULL,                          -- Foreign key to Orders table
    ProductID INT NOT NULL,                        -- Foreign key to Product table
    Quantity INT NOT NULL,                         -- Quantity of the product ordered
    Price DECIMAL(10, 2) NOT NULL                  -- Price of the product at the time of the order
);

-- Category Table
CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY,    -- Unique category 
    CategoryName VARCHAR(100) NOT NULL            -- Name of the category
);