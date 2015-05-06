use ercanbracks;
select student.firstname, student.lastname, registration.coursecode
from student,registration where registration.studentid = 1 and
student.studentid = 1;

