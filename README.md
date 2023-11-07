<br />
<div align="center">
  <a href="https://github.com/jeezusplays/IS212-G6T6">
    <img src="role-skill-match-app/public/favicon-32x32.png" alt="Logo">
  </a>

<h3 align="center">IS212-G6T6</h3>

  <p align="center">
    Software Project Management: Skill Based Role Portal Project
  </p>
</div>


## About The Project
Skill Based Role Portal (SBRP) is a web application developed to meet the growing need for an efficient and streamlined internal talent sourcing process within All-in-One, a leading Printing Solution Equipment Servicing company. This project aims to provide a platform where employees can easily apply for open positions and allow managers and directors to identify suitable candidates from within the company.

### Core Functionalities
For our first release, the team has identify 5 core features. The core features are as follows:

| Role | Function | Description |
| ----------- | ----------- | ----------- |
| Human Resources | CRU of Role Listings | Maintenance of Role listings <br> There is no delete for job listings but there would be an deadline for each listing |
| Human Resources | View skills of role applicants | View the skills of each staff |
| Staff | Browse and Filter Role Listing | List out the open roles and display the details |
| Staff | View Role-Skill Match | Display the match and gaps of the roles with current skill set |
| Staff | Apply for Role | Apply for the open role | 

## Built With
### Major Frameworks / Libraries 

#### Front-end frameworks and libraries
- ![html](https://img.shields.io/badge/HTML5-E34F26.svg?style=for-the-badge&logo=HTML5&logoColor=white)
- ![css](https://img.shields.io/badge/CSS3-1572B6.svg?style=for-the-badge&logo=CSS3&logoColor=white)
- ![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3.svg?style=for-the-badge&logo=Bootstrap&logoColor=white)

#### Back-end frameworks and libraries
- ![Laravel](https://img.shields.io/badge/Laravel-FF2D20.svg?style=for-the-badge&logo=Laravel&logoColor=white)
- ![MySQL](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=MySQL&logoColor=white)

#### Continuous Integration
- ![Codacy](https://img.shields.io/badge/Codacy-222F29.svg?style=for-the-badge&logo=Codacy&logoColor=white)
- ![GitHub Actions](https://img.shields.io/badge/GitHub%20Actions-2088FF.svg?style=for-the-badge&logo=GitHub-Actions&logoColor=white)

## Getting Started
### Prerequisites
* Install the following:
  * [![MySQL Workbench](https://img.shields.io/badge/MySQL-4479A1.svg?style=for-the-badge&logo=MySQL&logoColor=white)](https://dev.mysql.com/downloads/workbench/)
  * [![Composer](https://img.shields.io/badge/Composer-885630.svg?style=for-the-badge&logo=Composer&logoColor=white)](https://getcomposer.org/download/)
  * [![PHP](https://img.shields.io/badge/PHP-777BB4.svg?style=for-the-badge&logo=PHP&logoColor=white)](https://www.php.net/downloads)
  * [![npm](https://img.shields.io/badge/npm-CB3837.svg?style=for-the-badge&logo=npm&logoColor=white)](https://www.npmjs.com/get-npm)
  * [![node](https://img.shields.io/badge/Node.js-339933.svg?style=for-the-badge&logo=nodedotjs&logoColor=white)](https://nodejs.org/en/download/)

### Installation
1. Clone the repo
   ```sh
   git clone https://github.com/jeezusplays/IS212-G6T6
    ```
2. Navigate to the project directory.
    ```sh
    cd role-skill-match-app
    ```
3. Install npm and composer packages.
    ```sh
    npm install
    composer install
    ```
4. Create a copy of the `.env.example` file and rename it to `.env`. Edit `DB_DATABASE` `.env` file to `sbrp`. Change the necessary Mail and AWS SES credentials from our Google Drive's .env file as reference.
5. Create a database named `sbrp` in MySQL.
6. Migrate the database.
    ```sh
    php artisan migrate
    ```
7. Seed the database.
    ```sh
    php artisan db:seed
    ```
9. Generate artisan key
    ```sh
    php artisan key:generate
    ```
10. Start local laravel server.
    ```sh
    php artisan serve
    ```

## Usage
To use the application, follow these steps:
1. Open the application in a web browser.
2. Follow the on-screen instructions to navigate through the application's features.
3. If prompted, enter any required input values or select desired options.
4. When finished, exit the application or close the web browser.

## Team
|| <img src="https://avatars.githubusercontent.com/u/68149788?v=4" width="100"></img> | <img src="https://avatars.githubusercontent.com/u/111420736?v=4" width="100"></img> | <img src="https://avatars.githubusercontent.com/u/111410622?v=4" width="100"></img> | <img src="https://avatars.githubusercontent.com/u/144538254?v=4" width="100"></img> | <img src="https://avatars.githubusercontent.com/u/65487985?v=4" width="100"></img> | <img src="https://avatars.githubusercontent.com/u/140048767?v=4" width="100"></img> |
| ----------- | ----------- | ----------- | ----------- | ----------- | ----------- | ----------- | 
| Name | Tan Zuyi Joey | Liow Hong Xiang | Anthony | De Hou | Jeremy | Kaw Khin | 
| Role | Scrum Master | Product Owner | Developer | Developer | Developer | Developer | Developer |
| Github | [![jeezusplays](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/jeezusplays) | [![hx240](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/hx240) | [![anthonyckho](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/anthonyckho) | [![dehou](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/dehou37) | [![jeremy](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/jeremygmc) | [![kk](https://img.shields.io/badge/GitHub-181717.svg?style=for-the-badge&logo=GitHub&logoColor=white)](https://github.com/kantkawkhin3) |


