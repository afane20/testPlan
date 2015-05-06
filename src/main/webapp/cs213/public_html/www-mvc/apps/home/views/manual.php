<h1>Manual</h1>
<hr />
<h2>Setup</h2>
<div style="margin: 2px 35px; text-align: left;">
   You need to edit a few files to get your simple mvc working.<br />
   <br />
   <i>mvc/config.php</i><br />
   Change to your database and directory settings.<br />
   <br />
   <i>.htaccess</i><br />
   Change to your directory settings.<br />
   <br />
   <i>html/open.html</i><br />
   Change this to your html template.<br />
   <br />
   <i>html/close.html</i><br />
   Change this to your html template.<br />
   <br />
</div>
<hr />

<h2>Directories</h2>
<div style="margin: 2px 35px; text-align: left;">
   <b>apps:</b>
   Put your applications in here.<br />
   <br />

   <b>html:</b>
   This is the only directory that is visible to the web. All html, css, images, etc. should go here.<br />
   <br />

   <b>model:</b>
   This directory contains the model classes for database access.<br />
   <br />

   <b>mvc:</b>
   Guts of the system. Do not touch.<br />
   <br />
</div>
<hr />

<h2>Command Line Tool</h2>
<div style="margin: 2px 35px; text-align: left;">
While inside the mvc base directory run the command:<br /><i>./mvc.php &lt;table name&gt;</i><br />
it will generate an application with the same name as the table.
</div>
