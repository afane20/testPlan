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
  document.getElementById("emptyError").style.display = "none";
  document.getElementById("amountError").style.display = "none";
  document.getElementById("errorZip").style.display = "none";
  document.getElementById("errorPhone").style.display = "none";
  document.getElementById("errorCard").style.display = "none";
  document.getElementById("errorDate").style.display = "none";

  // Set the focus on the first name field
  document.getElementById("First").focus();
  document.getElementById("First").select();
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
      if(((inputs[i].type == "radio")||(inputs[i].type == "text")) &&
          (inputs[i].id != "Total"))
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
  if((document.getElementById("Zip").value != "") &&
      (document.getElementById("Zip").value.search(/^\d{5}$/) < 0))
  {
    document.getElementById("errorZip").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorZip").style.display = "none";

  if((document.getElementById("Phone").value != "") &&
      (document.getElementById("Phone").value.search(/^\d{3}-\d{3}-\d{4}$/) < 0))
  {
    document.getElementById("errorPhone").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorPhone").style.display = "none";

  if((document.getElementById("CardNum").value != "") &&
      (document.getElementById("CardNum").value.search(/^\d{16}$/) < 0))
  {
    document.getElementById("errorCard").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorCard").style.display = "none";

  var cardDate = document.getElementById("CardDate").value;
  if((cardDate != "") &&
      (cardDate.search(/^\d{2}-\d{4}$/) < 0))
  {
    document.getElementById("errorDate").innerHTML = "Card date must be of form mm-yyyy.";
    document.getElementById("errorDate").style.display = "block";
    valid = false;
  }
  else if((cardDate != "") && ((cardDate.split("-")[1] < 2011) ||
      ((cardDate.split("-")[1] == 2011) && (cardDate.split("-")[0] < 11))))
  {
    document.getElementById("errorDate").innerHTML = "Card date must be after current date.";
    document.getElementById("errorDate").style.display = "block";
    valid = false;
  }
  else if((cardDate != "") && ((cardDate.split("-")[0] < 1) ||
      (cardDate.split("-")[0] > 12)))
  {
    document.getElementById("errorDate").innerHTML = "Invalid Date";
    document.getElementById("errorDate").style.display = "block";
    valid = false;
  }
  else
    document.getElementById("errorDate").style.display = "none";

  if(checkAll)
    valid = amountValid();

  showEmptyError();

  return valid;
}

function amountValid()
{
  var valid = true;
  // Check that purchase amount is not zero
  if(document.getElementById("Total").value*1 <= 0)
  {
    document.getElementById("amountError").style.display = "block";
    valid = false;
  }
  else
  {
    document.getElementById("amountError").style.display = "none";
  }

  return valid;
}

function addSubtract(checked,amount)
{
  var total = document.getElementById("Total").value;
  // Multiplication ensures conversion to numbers
  if(checked == true)
    total = (total*1) + (amount*1);
  else
    total = (total*1) - (amount*1);
  document.getElementById("Total").value = total.toFixed(2);

  // Clear Amount Error
  if(total > 0)
    amountValid();
}
