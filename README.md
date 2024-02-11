# Frontend Application

This project contains the frontend application for interacting with the Customer API.

## Features

- Add new customers
- Update existing customers
- Delete customers
- View a list of all customers
- Sorting customers by various criteria
- Filtering customers by name or other parameters

## Technologies Used

- HTML
- CSS
- JavaScript
- Fetch API for making HTTP requests
- Bootstrap for styling

## Usage

1. Clone this repository to your local machine.
2. Open `index.html` in your web browser.

## How to Use

1. **Adding a Customer**: Click on the "Add Customer" button and fill in the required information in the form. Click the "Submit" button to add the customer.
2. **Updating a Customer**: Click on the "Edit" button next to the customer you want to update. Update the customer information in the form and click the "Save Changes" button.
3. **Deleting a Customer**: Click on the "Delete" button next to the customer you want to delete.
4. **Viewing Customers**: Customers are displayed in a table format. You can sort the customers by clicking on the column headers. You can also filter the customers by typing in the search box.

## Screenshots

![Screenshot 1](/image.jpg)


# Backend API

This project contains the backend API for managing customers.

## Features

- Add new customers
- Update existing customers
- Delete customers
- Retrieve a list of all customers
- Sorting customers by various criteria
- Filtering customers by name or other parameters

## Technologies Used

- PHP
- MySQL or any other SQL database
- HTTP methods (GET, POST, PUT, DELETE) for handling CRUD operations
- JSON for data exchange

## Usage

1. Clone this repository to your local machine.
2. Ensure that you have a PHP environment set up with a MySQL or compatible database.
3. Import the provided SQL file to create the required database schema and populate it with sample data.
4. Configure the database connection in the PHP files according to your environment.
5. Start your local server.
6. Test the API endpoints using tools like Postman or by making HTTP requests from your frontend application.

## API Endpoints

### GET /api.php?action=get_all_customers

Retrieves a list of all customers.

Parameters:
- `sort`: Field to sort by (e.g., FirstName, LastName)
- `order`: Sorting order (ASC or DESC)
- `filter`: Filter criteria (e.g., name, username)

### POST /api.php

Adds a new customer to the database.

Parameters:
- `action=add_customer`
- Form data: firstName, lastName, dateOfBirth, username, password

### PUT /api.php

Updates an existing customer in the database.

Parameters:
- `action=update_customer`
- Form data: id, firstName, lastName, dateOfBirth, username, password

### DELETE /api.php

Deletes a customer from the database.

Parameters:
- `action=delete_customer`
- Form data: id

## Created by

This project is created by Shayan Shaikh. Email: shayanshaikh996@gmail.com
