# IIT e-Learning Platform

## Overview
“IIT e-Learning Platform’’ is an online platform designed to offer a wide range of courses and educational resources for students. This platform, tailored for the teachers and students of IIT, Jahangirnagar University, facilitates registration, information management, and educational content access in a structured and user-friendly manner.

## Features
### Main Features at a Glance
- **Data Management**: Storing all data and records in a MySQL database.
- **Registration**: Registration panel for both teachers and students.
- **Emergency Communication**: Receiving emergency messages from students and notifying the teacher via text message.
- **User Authentication**: Student and teacher login.
- **Search Functionality**: Search for any student (by first name, batch, skills, blood group) or teacher (by first name, designation, research interest) using specific categories in the classroom section.
- **Profile Management**: Edit own profile (profile photo, cover photo, name, etc.).
- **Course Management**: Create courses for students.
- **Admin Panel**: Various admin tasks including course addition and student list importing.
- **User Dashboard**: Contains classroom, view & update own data, search for teachers/students, etc.
- **Resource Management**: Upload and access materials in courses categorized automatically (books, slides, videos).
- **Assessment Management**: Manage exams and assignments.
- **Attendance Tracking**: Calculate each student's attendance for a particular course.

## Technology Stack
- **Backend**: Laravel, PHP, MySQL
- **Frontend**: HTML, CSS, JavaScript, JQuery, AJAX

## Project Structure
![Decomposition Chart](path/to/decomposition_chart_image)
*Decomposition chart of the system*

![Use Case Diagram](path/to/use_case_diagram_image)
*Use case diagram showcasing the interactions within the system*

## Sample Outputs
![Sample Output 1](path/to/sample_output_image1)
*Example of a user dashboard*

![Sample Output 2](path/to/sample_output_image2)
*Example of a course material upload section*

## Installation
1. Clone the repository:
   ```bash
   git clone [https://github.com/yourusername/IIT-eLearning-Platform.git](https://github.com/shawon-iitju-48/IIT-e-Learning-Platform.git)
   ```
2. Navigate to the project directory:
   ```bash
   cd IIT-eLearning-Platform
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Configure the environment file:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database and mail configurations.
5. Generate application key:
   ```bash
   php artisan key:generate
   ```
6. Run the migrations:
   ```bash
   php artisan migrate
   ```
7. Seed the database:
   ```bash
   php artisan db:seed
   ```
8. Serve the application:
   ```bash
   php artisan serve
   ```

## Usage
- **Registration**: Register as a teacher or student through the registration panel.
- **Login**: Log in using your credentials.
- **Dashboard**: Access your dashboard to view and update your information, search for other users, and access course materials.
- **Admin Panel**: Perform various admin tasks such as adding courses and importing student lists.
- **Course Management**: Create and manage courses, upload materials, and manage exams and assignments.
- **Attendance Tracking**: Track attendance for each student in a particular course.

## Contributions
Contributions are welcome! Please fork the repository and submit pull requests.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact
For any queries or support, please contact:
- Name: [Your Name]
- Email: [Your Email]

---

![Logo](path/to/logo_image)
*IIT e-Learning Platform - Simplifying education for everyone*
