## Contents
- [Website Integration](#websiteintegration)
- [Scenario](#additional-information)
- [Tools Used](#tools-used)
- [Prototype](#prototype)
- [Set-up Instructions](#set-up-instructions)
- [Additional Information](#additional-information)
- [Website Screenshots](#website-screenshots)

# Introduction

This project covers the development of a small commercial website.
Mainly covering the integration of a database and how CRUD operations and user authentication is performed using PHP. 

## Scenario

> You are employed by Uptown IT’s Creative Department as a Web Developer. Your manager has given you a new project to design and develop. The client is The Mobile Hour. The company specialises in selling top brand mobile phones online. The Mobile Hour had a website developed by a friend a few years back but it needs to be replaced. The design is not appealing to today’s customers; it also lacks functionality and security. Your task is to design and develop a completely new website. Security and an attractive design are high on the client’s list of expectations.

> Project requirements are as follows:

> - Develop a responsive website (multiple devices)
> - Integrate a database with the website
> - Provide admin users access to manage the product by being able to:
> - Securely log in to admin area
> - Add new admin users (only manager can create new user)
> - Modify user accounts
> - Add new products
> - Update products
> - Delete products
> - Keep track of stock on hand
> - Keep track of changes made. A change log to identify the what, when and who made the changes.
>   In terms of display reports or outputs from the database, the Client has outlined the following requirements:
> - Display all mobile phones (available to all website visitors)
> - Display by brand (available to all website visitors)
> - Display by price (available to all website visitors)
> - Display stock on hand by product and by brand (accessible by admin users only)
> - Display current users (accessible by admin users only)
> - Display change log (accessible by admin users only):
>   - by product
>   * by date and date range
>   * by user

## Tools Used

**Design**

- Figma - Use case diagram, site map and prototype
- Balsamiq - Wireframes

**Frontend:**

- HTML5
- CSS
- Bootstrap
- JavaScript

**Serverside and Backend**

- MySQL - MySQL Workbench
- PHP

**Testing**

- XAMPP

## Prototype

Website Prototype can be accessed [here](https://www.figma.com/proto/x9EwlLbqn5IsAUZWyMM9xy/Prototype?page-id=0%3A1&type=design&node-id=1-2&viewport=573%2C652%2C0.54&t=iLKkC5wKCi0q2CnK-1&scaling=min-zoom&mode=design).

## Set-up Instructions

### Prerequisites 
* [Download and Install XAMPP](https://www.apachefriends.org/index.html) 
* [Clone this Repository](https://github.com/3thanpowell/website-integration) or Download the ZIP File

### Setup
1. **Move project to XAMPP's `htdocs` directory**
2. **Start Xampp**
    - Start the Apache and MySQL services
3. **Create and Import the Database:**
   - Open your web browser and go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
   - Create a new database:
     - Click on "New" in the left sidebar.
     - Name your database `the-mobile-hour` and click "Create".
   - With your new database selected, click on the "Import" tab.
   - Click "Choose File" and navigate to the `populated_database` folder within your project directory.
   - Select the provided SQL files and click "Go" to import.
4. **Configure Database Connection:**
   - Open the project folder in a text editor.
   - Locate the configuration file where database connection settings are defined (`model/db.php`).
   - Update the database connection settings to match your local environment. For example:
     ```php
     <?php
     $host = 'localhost';
     $db = 'the_mobile_hour_db'; // The name of the database you created
     $user = 'root';
     $pass = ''; // Default MySQL root password is empty
     
     ```
5. **Access the Project:**
   - Open your web browser and navigate to [http://localhost/website-integration](http://localhost/website-integration).
   - You should see the homepage of your project if everything is set up correctly.
   
## Additional Information

For further information on setting up and using XAMPP, refer to the [XAMPP FAQ](https://www.apachefriends.org/faq_windows.html) and the [phpMyAdmin documentation](https://www.phpmyadmin.net/docs/).


## Website Screenshots

###Landing Page
![Landing Page](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/landing.png?raw=true)

###Products Page
![Products Page](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/products.png?raw=true)

###Product Page
![Product Page](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/product.png?raw=true)

###Login
![Login](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/login.png?raw=true)

###Customer Dashboard
![Customer Dashboard](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/customer_dash.png?raw=true)

###Staff Dashboard
![Staff Dashboard](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/staff_dash.png?raw=true)

###Modify Product
![Modify Product](https://github.com/3thanpowell/website-integration/blob/main/documentation/screenshots/modify_product.png?raw=true)

