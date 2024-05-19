# RAIL EASE - A Train Ticket Booking Website

A web application for booking train tickets. The application allows users to search for train schedules, book tickets, and manage reservations. Also present is an admin panel for an admin to add, modify and remove trains details.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Technologies Used](#technologies-used)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Features

- Search for trains based on departure and arrival locations.
- View train schedules and availability.
- Book train tickets.
- Manage and cancel reservations.
- Admin dashboard to manage trains and schedules.

## Installation

1. Clone the repository:

    bash
    git clone https://github.com/SupratitDatta/Rail-Ease.git
    

2. Navigate to the project directory:

    bash
    cd rail-ease
    

3. Set up your web server (e.g., XAMPP, WAMP) and place the project directory in the server's root directory.

4. Create a MySQL database named Railway and create all the required tables to set up the necessary features and authentications.

5. Configure the database connection in all the php files :

    ```php
    <?php
    $servername = "localhost";
    $username = "your-username";
    $password = "your-password";
    $dbname = "train_booking_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```


6. Start your web server and navigate to your localhost server in your browser.

## Usage

1. *User*: 
    - Search for trains by entering departure and arrival locations.
    - Select a train and book a ticket.
    - View and manage your reservations.

2. *Admin*:
    - Access the admin dashboard to manage trains and schedules.
    - Add, update, or delete train details.

## Technologies Used

- HTML5
- CSS
- PHP
- MySQL
- JavaScript
  
## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (git checkout -b feature-branch).
3. Make your changes.
4. Commit your changes (git commit -am 'Add new feature').
5. Push to the branch (git push origin feature-branch).
6. Open a pull request.

## License

This project is created by Supratit Datta in 2023. All rights reserved.

## Contact

For any inquiries, please contact:

- *Email ID* - supratitdatta@gmail.com
- *GitHub* - https://github.com/SupratitDatta
