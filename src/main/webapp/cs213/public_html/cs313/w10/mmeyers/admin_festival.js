
function remove_slot()
{
   Dialog.alert("Not implemented yet", {className: "alphacube", buttonClass: "button", width:300, height:100, okLabel: "Close"});
}

function load_location_schedule()
{
   new Ajax.Updater("location_schedule", "actions.php", 
      { method: "post", parameters: { action: "load_location_schedule", location_id: $F('which_location')}});
}

function clear_location_times()
{
   Dialog.confirm("Are you sure you want to clear all the times?  This will unregister the students in these slots.", { className: "alphacube", width: 450, okLabel: "Yes", cancelLabel: "No", buttonClass: "button", onOk: function(win){
      new Ajax.Request("actions.php", 
         { method: "post", parameters: { action: "clear_location_times", location_id: $F('which_location')},
         onSuccess: function() 
         {
            load_location_schedule();
            show_message("The times were cleared");
         }});
      return true;
   }}
   );
}

function create_slots(location_id)
{
    Dialog.confirm({url: "create_time_slots.php", options: {method: 'get', parameters: { location_id: location_id}}},
            {className: "alphacube", width:450, okLabel: "Add", cancelLabel: "Cancel", onOk: 
               function(win) 
               {
                  document.add_time_slot.submit();
               }, 
             buttonClass: "button"});
}

function edit_festival()
{
    Dialog.confirm({url: "edit_festival.php", options: {method: 'get'}},
            {onShow: function() {
                new Control.DatePicker('start', {icon: 'calendar.png'});
                new Control.DatePicker('end', {icon: 'calendar.png'});
            },className: "alphacube", width:450, okLabel: "Save", cancelLabel: "Cancel", onOk: submit_edit_festival, buttonClass: "button"});
}

function submit_edit_festival()
{
    document.edit_festival.submit();
}

function toggle_paid_dues(teacher_id)
{
    new Ajax.Request(site_url+"actions.php", {
        parameters: {action: "toggle_paid_dues", teacher_id: teacher_id}
    });
}

function load_festivals()
{
    $('festival_list').innerHTML = ajax_loader;
    new Ajax.Updater("festival_list", "actions.php", {parameters:{action: "load_festivals"}});
}

function load_locations()
{
    $('locations').innerHTML = ajax_loader;
    new Ajax.Updater("locations", "actions.php", {parameters:{action: "load_locations"}});
}

function load_teachers()
{
    $('teacher_dues').innerHTML = ajax_loader;

    new Ajax.Updater("teacher_dues", "actions.php", {parameters:{action: "load_teachers"}});
}

function show_add_teacher()
{
    Dialog.confirm({url: "add_teacher.php", options: {method: 'get'}},
            {className: "alphacube", width:450, okLabel: "Add", cancelLabel: "Cancel", onOk: submit_add_teacher, buttonClass: "button"});
}

function show_add_location()
{
    Dialog.confirm({url: "add_location.php", options: {method: 'get'}},
            {className: "alphacube", width:450, okLabel: "Add", cancelLabel: "Cancel", onOk: submit_add_location, buttonClass: "button"});
}

function remove_location(location)
{
   Dialog.confirm("Are you sure you want to remove this location?", { className: "alphacube", okLabel: "Yes", cancelLabel: "Cancel", 
      onOk: function(win) {
         new Ajax.Request("actions.php", 
            { method: "post", parameters: { action: "remove_location", location_id: location}, onSuccess: load_locations});
         return true;
   }, buttonClass: "button", width: 350});
}

function submit_add_location()
{
    document.add_location.submit();
}


function submit_add_teacher()
{
    document.add_teacher.submit();
}

function register_student(location_time_id)
{
    Dialog.alert(
         {url: "admin_register_student.php", options: {method: 'get', parameters: { location_time_id: location_time_id}}},
         {className: "alphacube", width:450, okLabel: "Cancel",
          buttonClass: "button",
          onShow: function(win) { $('search_student').focus(); }});
}

function search_students(location_time_id)
{
    new Ajax.Updater("student_seach_result", "actions.php", 
      { method: "post", parameters: { action: "search_students", location_time_id: location_time_id, name: $F("search_student")}});
}

function select_student(student_id, location_time_id)
{
   new Ajax.Request("actions.php", { medhot: "post", parameters: 
      { action: "register_student", student_id: student_id, location_time_id: location_time_id },
       onSuccess: function(transport) {
         load_location_schedule();
         show_message("The student was registered");
       }});
   Dialog.closeInfo();
}

function unregister(performance_id)
{
   new Ajax.Request("actions.php", { method: "post", parameters: 
      { action: "unregister", performance_id: performance_id },
       onSuccess: function(transport) {
         load_location_schedule();
         show_message("The student was unregistered");
       }});
}


