<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$con = new mysqli('localhost', 'root', '', 'ims');

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Debugging: Check what is being received
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = null; // Initialize statement variable

    // Add Product
    if (isset($_POST['addProduct'])) {
        $stmt = $con->prepare("INSERT INTO Product (ProductName, CategoryID, SupplierID, Price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siid", $_POST['productName'], $_POST['productCategory'], $_POST['productSupplier'], $_POST['productPrice']);
    } 
    // Add Supplier
    elseif (isset($_POST['addSupplier'])) {
        $stmt = $con->prepare("INSERT INTO Supplier (ContactInformation) VALUES (?)");
        $stmt->bind_param("s", $_POST['supplierContact']);
    } 
    // Add Customer
    elseif (isset($_POST['addCustomer'])) {
        $stmt = $con->prepare("INSERT INTO Customers (ContactInformation) VALUES (?)");
        $stmt->bind_param("s", $_POST['customerContact']);
    } 
    // Add Order
    elseif (isset($_POST['addOrder'])) {
        $stmt = $con->prepare("INSERT INTO Orders (CustomerID, OrderDate) VALUES (?, ?)");
        $stmt->bind_param("is", $_POST['orderCustomerId'], $_POST['orderDate']);
    } 
    // Add Order Details
    elseif (isset($_POST['addOrderDetails'])) {
        $stmt = $con->prepare("INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $_POST['orderId'], $_POST['productId'], $_POST['quantity'], $_POST['price']);
    } 
    // Add Category
    elseif (isset($_POST['addCategory'])) {
        $stmt = $con->prepare("INSERT INTO Category (CategoryName) VALUES (?)");
        $stmt->bind_param("s", $_POST['categoryName']);
    }
    // Delete Product
    elseif (isset($_POST['deleteProduct'])) {
        $stmt = $con->prepare("DELETE FROM Product WHERE ProductID = ?");
        $stmt->bind_param("i", $_POST['productId']);
    }
    // Delete Supplier
    elseif (isset($_POST['deleteSupplier'])) {
        $stmt = $con->prepare("DELETE FROM Supplier WHERE SupplierID = ?");
        $stmt->bind_param("i", $_POST['supplierId']);
    }
    // Delete Customer
    elseif (isset($_POST['deleteCustomer'])) {
        $stmt = $con->prepare("DELETE FROM Customers WHERE CustomerID = ?");
        $stmt->bind_param("i", $_POST['customerId']);
    }
    // Delete Order
    elseif (isset($_POST['deleteOrder'])) {
        $stmt = $con->prepare("DELETE FROM Orders WHERE OrderID = ?");
        $stmt->bind_param("i", $_POST['orderId']);
    }
    // Delete Order Detail
    elseif (isset($_POST['deleteOrderDetail'])) {
        $stmt = $con->prepare("DELETE FROM OrderDetails WHERE OrderDetailID = ?");
        $stmt->bind_param("i", $_POST['orderDetailId']);
    }

    // Execute the prepared statement
    if ($stmt) {
        if ($stmt->execute()) {
            echo "Record successfully processed.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Close connection
$con->close();
?>
