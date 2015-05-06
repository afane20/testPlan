function formSetup()
{
  // Clear Errors
  var divs = document.getElementsByTagName("div");
  for(var i = 0; i < divs.length; i++)
  {
    if(divs[i].className == "empty")
    {
      divs[i].className = "";
    }
  }
  document.getElementById("errorAPR").style.display = "none";
  document.getElementById("errorTerm").style.display = "none";
  document.getElementById("errorAmount").style.display = "none";
  document.getElementById("emptyError").style.display = "none";

  // Set the focus on the first name field
  document.getElementById("APR").focus();
  document.getElementById("APR").select();
}

function showEmptyError()
{
  var divs = document.getElementsByTagName("div");
  var show = false;
  for(var i = 0; i < divs.length; i++)
  {
    if(divs[i].className == "empty")
    {
      show = true;
      break;
    }
  }

  if(show)
    document.getElementById("emptyError").style.display = "block";
  else
    document.getElementById("emptyError").style.display = "none";
}

function validate(checkAll,currField)
{
  var valid = true;

  // Mark all empty fields (used to verify the whole form)
  if(checkAll == true)
  {
    var inputs = document.getElementsByTagName("input");
    for(var i = 0; i < inputs.length; i++)
    {
      if((inputs[i].type == "text") && (inputs[i].id != "Total"))
      {
        if(inputs[i].value == "")
        {
          inputs[i].parentNode.className = "empty";
          valid = false;
        }
        else
          inputs[i].parentNode.className = "";
      }
    }
  }
  // Called from onchange for a field
  else
  {
    if(currField.value == "")
    {
      currField.parentNode.className = "empty";
      valid = false;
    }
    else
      currField.parentNode.className = "";
  }

  // Ensure valid inputs
  if((document.getElementById("APR").value != "") &&
      (isNaN(document.getElementById("APR").value) ||
          (document.getElementById("APR").value <= 0)))
  {
    document.getElementById("errorAPR").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorAPR").style.display = "none";

  if((document.getElementById("Term").value != "") &&
      (isNaN(document.getElementById("Term").value) ||
          (document.getElementById("Term").value <= 0)))
  {
    document.getElementById("errorTerm").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorTerm").style.display = "none";

  if((document.getElementById("Amount").value != "") &&
      (isNaN(document.getElementById("Amount").value) ||
          (document.getElementById("Amount").value < 0)))
  {
    document.getElementById("errorAmount").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorAmount").style.display = "none";

  showEmptyError();

  return valid;
}
