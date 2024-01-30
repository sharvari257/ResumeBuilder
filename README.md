#ResumeBuilder
#Overview
This web application empowers users to quickly create or upload their resumes for easy management and download. Its features:
1. User-friendly login and signup system
2. Pre-built resume template for effortless creation of resume(s)
3. Option to upload existing resumes (if any) then store + view the same on web page
4. Database integration to save the resume data securely
5. Download functionality to save resumes on user’s local computer.

#Technologies Used
Frontend: HTML, CSS, Bootstrap
Backend: PHP
Database: MySQL

#Getting Started
1. Clone the Repository:
                git clone https://github.com/sharvari257/ResumeBuilder.git
2. Set up the database:
        I. Create a database with a name matching the configuration “config.php”. This file would have the database connection.
        II. Import the database.sql file(s) to create tables and initial data.
3. Start the local server:
        Place the project file in web server’s root directory [path to save file to: xampp/htdocs/<project_file>]
4. Alternatively, use XAMPP to create local server environment.

#Usage
1. Access the application in your web browser (e.g., http://localhost/resume-builder).
2. Login or register if you don't have an account.
3. After successful login, choose either:
4. Use pre-built resume template: Fill in your information and customize the template.
5. Upload existing resume: Select your resume file to upload and save it in the database.
6. Download your resume in PDF format (or another supported format) to your local machine.
