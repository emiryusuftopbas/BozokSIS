# BozokSIS
BozokSIS is student information system for universities. BozokSIS is written using php, javascript and jquery.

I coded it for the final project of web programming course given in Bozok University computer engineering program.

My project has been graded 85 / 100.

## Used programming languages , frameworks and libraries

### Used back-end technologies
- PHP programming language with MVC design pattern.

- MariaDB.

### Used front-end technologies

- Bulmacss html&css framework for this project.Because it is lightweight and open source and css only html&css framework.

- Jquery for ajax technology.

- Sweetalert for sweet success , error and warning messages.

## How to run BozokSIS

- Clone this project

```git
git clone https://github.com/emiryusuftopbas/BozokSIS.git
```

- Create new database and import bozoksis.sql file.

- Change configuration file config.php in the app folder

![Config.php file](https://user-images.githubusercontent.com/58172827/76758231-595b4680-679a-11ea-9381-7d6e0445f6d2.png)
	
- You are ready to run BozokSIS :)

### Test login credentials.

| User Type     	|   Username   	|   Password 	|
|---------------	|:------------:	|:-----------:	|
| Administrator 	|     admin    	|  admin123  	|
| Academician   	| craig.hilliard |    ac123   	|
| Student       	|  16008118012 	| student123 	|

- Login screen
![Login screen](https://user-images.githubusercontent.com/58172827/76758330-8871b800-679a-11ea-924f-3a8dd37b2839.png)

- Login BozokSIS and enjoy it.


## How BozokSIS Works

### Login and Signup

There are 3 tables for users in the database.

- admins

	Administrator stored in this table.
- academicians

	Academicians stored in this table.
- students

	Students stored in this table.

When signing up , only email addresses with the extension bozok.edu.tr yobu.edu.tr and ogr.bozok.edu.tr are accepted.
If the e-mail address ends with ogr.bozok.edu.tr, the system automatically registers to the students table.

Student e-mails at Bozok University are in format **studentnumber@ogr.bozok.edu.tr** .

Student number contains the students faculty and program information.
Example 16008118009 , first four digits are the faculty code and the next 3 digits are the department code.
By using this scheme, the system adds the faculty and department code match from the faculties and departments table to the automatic student registration.

If the e-mail address is bozok.edu.tr or yobu.edu.tr, the system automatically registers to the academicians table.

Academicians and students cannot log in to the system immediately after they are registered to the system, an administrator must approve them.

![Unapproved user warning](https://user-images.githubusercontent.com/58172827/76758379-a3dcc300-679a-11ea-9d01-d812785311d0.png)

![Admin dashboard students](https://user-images.githubusercontent.com/58172827/76758421-b525cf80-679a-11ea-83a4-ba4aa3e20c48.png)

- Login and signup system use ajax technology and sweetalert library.

### Dashboards
- Administrator Dashboard

![Admin Dashboard](https://user-images.githubusercontent.com/58172827/76758479-cc64bd00-679a-11ea-9edc-07f3800415c3.png)

- Academician Dashboard

![Admin Dashboard](https://user-images.githubusercontent.com/58172827/76758516-df778d00-679a-11ea-9b40-32a96a739c41.png)

- Student Dashboard

![Student Dashboard](https://user-images.githubusercontent.com/58172827/76758556-f918d480-679a-11ea-8238-738f23c5f119.png)

### Academic years , academic terms and course selection

Only can administrator add or modify academic years and terms.

Database tables listed below.

**academic_years**

In this table academic years are stored.
- **academic_year_id :** The id column is the primary key and increases automatically when the record is added.
- **academic_year :** name of the academic year , example : 2019-2020.
- **academic_year_start_date :**  academic year start date in date format.
- **academic_year_end_date :** academic year end date in date format.
- **academic_year_status :** academic year status 2 for active 1 for passive.

**academic_terms**

In this table academic terms are stored
- **academic_term_id :** The id column is the primary key and increases automatically when the record is added.
- **academic_term :** name of the academic term , example : spring semester.
- **academic_term_start_date :** academic term start date in date format. 
- **academic_term_end_date :** academic term end date in date format.
- **academic_year :**  is the id of the academic year that the academic period depends on.There is a foreign key relationship with the academic_year_id column in the academic_year table.

**course_selection_dates**

In this table course selection dates are stored.
- **course_selection_date_id :** The id column is the primary key and increases automatically when the record is added.
- **course_selection_start_date :** course selection start date in date format.
- **course_selection_end_date :** course selection end date in date format.
- **course_selection_date_status :** course selection date status 2 for active 1 for passive.
- **academic_term :** is the id of the academic term to choose the course.There is a foreign key relationship with the academic_term_id column in the academic_term table.

![Academic year and term operations](https://user-images.githubusercontent.com/58172827/76758592-0c2ba480-679b-11ea-9326-c07cc860b7da.png)

![Course selection operations](https://user-images.githubusercontent.com/58172827/76758655-32e9db00-679b-11ea-8569-7f4b3f2533a7.png)

### Departments and faculties

**faculties**

In this table faculties are stored.
- **faculty_id :** The id column is the primary key and increases automatically when the record is added.
- **faculty_code :** four digit number that represents the faculty also this number is the first four digit of the student number.
- **faculty_name :** name of the faculty , example : faculty of engineering and architecture.
- **faculty_dean :** dean of the faculty.There is foreign key relationship with the academician_id column in the academicians table.

**departments**

In this table departments are stored.
- **department_id :** The id column is the primary key and increases automatically when the record is added.
- **department_code :** three digit number that represents the department.In addition, this number is the 3-digit number after the first four numbers in the school number.
- **department_name :** name of the department , example : computer engineering
- **faculty_id :** Id of the faculty to which the department is affiliated. There is foreign key relationship with the faculty_id column in the faculties table.
- **department_head :** is the id of the department head.There is foreign key relationship with the academician_id column in the academicians table.

![Admin dashboard faculties](https://user-images.githubusercontent.com/58172827/76758787-7e03ee00-679b-11ea-8cd3-52287c87fdec.png)

![Admin dashboard departments](https://user-images.githubusercontent.com/58172827/76758842-94aa4500-679b-11ea-9eb4-81af3909c59d.png)

### Grade status and attendance

Only academicians can add or modify grades and attendance status.

![Academician my lessons page](https://user-images.githubusercontent.com/58172827/76758903-ae4b8c80-679b-11ea-948d-85380f0c3360.png)

![Academician add grade page](https://user-images.githubusercontent.com/58172827/76758942-c15e5c80-679b-11ea-8079-2090befc6d15.png)

![Academician add attendance page](https://user-images.githubusercontent.com/58172827/76758999-d89d4a00-679b-11ea-8790-e9cf557ee0bc.png)


**grades**

In this table grades are stored.
- **grade_id :** The id column is the primary key and increases automatically when the record is added.	
- **grade_student :** is the id of the student. There is foreign key relationship with the student_id column in the students table.
- **grade_grader :** is the id of the academician who entered the grade. There is foreign key relationship with the academician_id column in the academicians table.
- **midterm_grade :** midterm grade.
- **final_grade :**	final grade.
- **grade_lesson :** is the id of the lesson. There is foreign key relationship with the lesson_id column in the lessons table.

**attendance**

In this table attendance are stored
- **attendance_id :** The id column is the primary key and increases automatically when the record is added.
- **attendance_student :** is the id of the student. There is foreign key relationship with the student_id column in the students table. 
- **attendance_lesson :** is the id of the lesson. There is foreign key relationship with the lesson_id column in the lessons table.
- **attendance_time	:** attendance time as week.

How students see their grades and attendance status.

![Student dashboard grade status](https://user-images.githubusercontent.com/58172827/76759034-efdc3780-679b-11ea-80be-558be8e85ff4.png)

![student dashboard attendance status](https://user-images.githubusercontent.com/58172827/76759063-01bdda80-679c-11ea-9c19-b49d7fc4d28d.png)


### Database entity relation diagram

![Database entity relation diagram](https://user-images.githubusercontent.com/58172827/76759109-1601d780-679c-11ea-8a83-6e84f94f5a6c.png)

## Contributors

 - Emir Yusuf Topbaş <emiryusuftopbas@gmail.com>

## License & copyright
Licensed under the [GNU General Public License v3.0](LICENSE)
