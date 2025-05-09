NGOConnectVolunteers

NGOConnectVolunteers is a platform that connects volunteers with Non-Governmental Organizations (NGOs) to help increase community engagement, track volunteer hours, and earn badges for their contributions. This project is built using PHP, MySQL, and HTML/CSS.

Features

- Volunteer Registration: Users can register as volunteers.
- NGO Listings: NGOs can post volunteer opportunities for different causes.
- Badges: Volunteers can earn badges based on the number of hours they contribute.
- Volunteer Tracking: Track the number of hours each volunteer has contributed.
- User Profiles: Each volunteer has a profile where they can see their earned badges and track their progress.

Requirements

- XAMPP: Download and install XAMPP (Apache, MySQL, PHP) to run the project locally.
- PHP: Version 7.0+.
- MySQL: For storing volunteer and NGO data.
- Bootstrap: For responsive front-end design.

Setting Up the Project

1. Clone the repository

Clone this repository to your local machine:

git clone https://github.com/Anaghaank/NGO-Connect-Volunteer.git

2. Install XAMPP

If you haven’t already, download and install XAMPP (https://www.apachefriends.org/download.html). XAMPP comes with Apache and MySQL, which are necessary for running the project.

3. Set up the project in XAMPP

- Move the `NGO-Connect-Volunteers` folder into the `htdocs` directory inside your XAMPP installation folder. The default location is typically `C:\xampp\htdocs`.
- Start the Apache and MySQL services from the XAMPP control panel.

4. Database Configuration

- Open your browser and go to `http://localhost/phpmyadmin` to open the MySQL database management tool.
- Create a new database, e.g., `ngo_platform`.
- Import any necessary `.sql` file that contains the schema for the database (if applicable).
- Edit the `db_connection.php` file (or other relevant configuration file) in the project folder to match your local database credentials:
  - Username: `root`
  - Password: (empty, unless you’ve set one)
  - Database name: `ngo_platform` (or whatever name you’ve chosen for the database).

5. Access the Platform

After setting up the project, navigate to the following URL in your browser to view the platform:
http://localhost/NGO-Connect-Volunteers/index.php
(Keep the folder name same throughtout)
Project Structure

- /assets: Contains images, CSS files, and JavaScript files.
- /php: Contains all the php files
- /index.php: Main entry point of the website.

Contributions

Feel free to fork this repository and contribute improvements. Please submit issues and pull requests if you find bugs or want to suggest new features.

License

This project is licensed under the MIT License - see the LICENSE.md file for details.

Contact

For questions or suggestions, feel free to contact me via LinkedIn (https://www.linkedin.com/in/anagha21).
