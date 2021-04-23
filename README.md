# Auto-evaluation of SQL request
## Introduction
This web site has been built in 5 weeks by 4 students for an enginnering project at ISEN Lille :
-ERAUD-BERTHAUD Hugo,
-CHOUKHI Imane,
-GOEDERT Thibault,
-TCHAYEM ERWIN.

The site needs php (at least v7), and MySQL to be run. 
The host is "localhost".

The aim of this web site is to be a learning plateforme for student in third year of enginnering school.It will be used to give the possibility to teachers to
give to groups of students exercices concerning SQL and database management.

Student will have to complete exercice by answering a set of question with SQL request. This will be corrected and the student will have acces to all his result and several       graph to follow his progress with a dashboard.

The site has an admin management part. indeed admin can add/delete exercice, teams or groups ( team contains groups, and a group contains students). He can as well see the         dashboard of a given student.
  
## Configuration
If the project is hosted, it will need some modification.
In the file Controller/bddManagement.php ligne 57, there is an absolute path :"D:\\programme\\wamp\\bin\\mysql\\mysql5.7.31\\bin\\mysqldump.exe". it has to be replace by the    path to mysqldump.exe on the server

## Import Files (for admin only): 
As an admin, you will maybe need to add exercice or team/groups :

To add an exercice 3 files needed :
-An image of the database model.
-A SQL file of the database of th exercice.
-A CSV file, each line containing : [Question_Name];[Question_text];[Question_Answer];;[Optional : score];

To add a student/group/team (1file needed) :

-A CSV file, each line containing : [team];[group];[lastname];[firstname;[Optional : role] - role : 0 =admin, 1= student( if the team, group or student dosen't exist it will be added,if not everything will just be updated).
