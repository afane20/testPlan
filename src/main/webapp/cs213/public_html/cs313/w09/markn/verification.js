function checkFields()
{
   
   if(checkPassword() == true && checkUsername() == true)
   {
      return true;
   }
   else
   {
      return false;
   }
}

function checkPassword()
{
   password = document.getElementById("password").value;
    if (password != "")
    {
       document.getElementById("hidPass").style.visibility = "hidden";
       return true;
    }
    else
    {
       document.getElementById("hidPass").style.visibility = "visible";
       return false;
    }
}

function checkUsername()
{
   username = document.getElementById("username").value;
    if (username != "")
    {
       document.getElementById("hidUser").style.visibility = "hidden";
       return true;
    }
    else
    {
       document.getElementById("hidUser").style.visibility = "visible";
       return false;
    }
}