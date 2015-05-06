SELECT timeslot.building,timeslot.room,timeslot.time,registration.studentId,student.first
FROM registration,timeslot,student WHERE registration.timeslotId = timeslot.timeslotId AND timeslot.building = "SNOW"
                                         AND registration.studentId = student.studentId AND registration.festivalId = 8
                                         AND timeslot.room = "103";
