// Retrieve products from localStorage or initialize an empty array
let products = JSON.parse(localStorage.getItem('products')) || [];

// Function to handle Add Product form
function addProduct(event) {
    event.preventDefault(); // Prevent the form from refreshing the page

    // Getting input values from the form 
    let productName = document.getElementById("productName").value;
    let category = document.getElementById("productCategory").value;
    let supplier = document.getElementById("productSupplier").value;
    let price = document.getElementById("productPrice").value;

    // Add the product to the array
    products.push({
        name: productName,
        category: category,
        supplier: supplier,
        price: price
    });

    // Save the updated products array to localStorage
    localStorage.setItem('products', JSON.stringify(products));

    // Clear the form fields
    document.getElementById("addProductForm").reset();

    alert("Product added successfully!");
}

// Function to update the Product table
function updateProductTable() {
    // Referencing the table
    let table = document.getElementById("productsTable");

    // Retrieve products from localStorage
    products = JSON.parse(localStorage.getItem('products')) || [];

    // Clear all rows except the header
    table.innerHTML = `
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Supplier</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    `;

    // Add a new row for each Product
    products.forEach((product, index) => {
        let row = table.insertRow(); // Create a new row

        // Add cells to the row
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${product.name}</td>
            <td>${product.category}</td>
            <td>${product.supplier}</td>
            <td>${product.price}</td>
            <td><button onclick="deleteProduct(${index})">Delete</button></td>
        `;
    });
}

// Function to delete a product
function deleteProduct(index) {
    // Remove the product from the array
    products.splice(index, 1);

    // Update localStorage
    localStorage.setItem('products', JSON.stringify(products));

    // Refresh the table
    updateProductTable();
}
