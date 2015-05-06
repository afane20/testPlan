function submit_add_student()
{
    document.add_student.submit();
}

function load_students()
{
    new Ajax.Updater("student_list", "actions.php", {parameters:{action: "load_students"}});
}

function show_add_student()
{
    Dialog.confirm({url: "add_student.php", options: {method: 'get'}},
            {className: "alphacube", width:350, okLabel: "Add", cancelLabel: "Cancel", onOk: submit_add_student, buttonClass: "button"});
}

function remove_student(student_id)
{
    Dialog.confirm("Are you sure you want to remove this student?",
            {className: "alphacube", width:250, okLabel: "Yes", cancelLabel: "No", onOk: function(win) {
                   new Ajax.Request("actions.php", {
                     parameters: {action: "remove_student", student_id: student_id},
                     onSuccess: function() {load_students(); show_message("The student was removed");}});
                   return true;
            }, buttonClass: "button"});
}

function register_student(student_id)
{
    Dialog.confirm({url: "teacher_register_student.php", options: {method: 'get', parameters: {student_id: student_id}}},
            {className: "alphacube", width:350, height: 500, okLabel: "Add", cancelLabel: "Cancel", onOk: function(win) { document.register_student.submit()}, buttonClass: "button"});
}

function unregister(performance_id)
{
   new Ajax.Request("actions.php", { method: "post", parameters: 
      { action: "unregister", performance_id: performance_id },
       onSuccess: function(transport) {
         load_schedule();
         show_message("The student was unregistered");
       }});
}

function load_schedule()
{
   new Ajax.Updater("schedule", "actions.php", { method: "post", parameters: { action: "load_teacher_schedule"}});
}

function search_times()
{
   new Ajax.Updater("possible_times", "actions.php", { method: "post", 
      parameters: {
         action: "search_times",
         performance_type: $F('performance_type'),
         skill_level: $F('skill_level'),
         instrument: $F('instrument'),
         date: $F('date')
      }});
}

function select_time(location_time_id)
{
   $('location_time_id').value = location_time_id; 
}
