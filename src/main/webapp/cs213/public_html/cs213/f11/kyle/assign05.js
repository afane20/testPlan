function formSetup()
{
  var fields = document.getElementsByTagName("input");
  for (var i=0;i<fields.length;i++)
  {
    fields[i].onfocus = setHints;
    fields[i].onchange = update;
  }

  // Clear errors
  document.getElementById('hints').className = "hint";
  document.getElementById('Amount').style.borderColor = '';
  document.getElementById('Term').style.borderColor = '';
  document.getElementById('APR').style.borderColor = '';

  document.getElementById("APR").focus();
  document.getElementById("APR").select();
}

function getError(fieldID)
{
  var errorTxt = "";
  switch(fieldID)
  {
    case "APR":
      errorTxt = "Error: APR input must be a number!";
      break;
    case "Term":
      errorTxt = "Error: Loan Term input must be a number!";
      break;
    case "Amount":
      errorTxt = "Error: Loan Amount input must be a number!";
      break;
  }

  return errorTxt;
}

function calculate()
{
  var hintText = "";
  var APR = document.getElementById('APR').value;
  var Term = document.getElementById('Term').value;
  var Amount = document.getElementById('Amount').value;
  var PowerValue;
  var Payment;

  // Check for Valid Inputs
  if(isNaN(Amount) || Amount=="")
  {
    hintText = getError("Amount");
    document.getElementById('Amount').style.borderColor = 'red';
  }
  else
  {
    document.getElementById('Amount').style.borderColor = '';
  }

  if(isNaN(Term) || Term=="")
  {
    hintText = getError("Term");
    document.getElementById('Term').style.borderColor = 'red';
  }
  else
  {
    document.getElementById('Term').style.borderColor = '';
  }

  if(isNaN(APR) || APR=="")
  {
    hintText = getError("APR");
    document.getElementById('APR').style.borderColor = 'red';
  }
  else
  {
    document.getElementById('APR').style.borderColor = '';
  }

  // If there is an error, post it
  if (hintText != "")
  {
    document.getElementById('hints').innerHTML = hintText;
    document.getElementById('hints').className = "error";
  }
  else
  {
    // Calculate Fixed Monthly Payment
    //http://en.wikipedia.org/wiki/Mortgage_calculator#Monthly_payment_formula
    // Math.round used to prevent NaN output from Math.pow
    PowerValue = Math.pow(1+(APR/100/12),Math.round(-Term*12));
    Payment = ((APR/100/12)*Amount)/(1-PowerValue);

    Payment = Math.round(Payment*100)/100;
    document.getElementById('Payment').value = Payment.toFixed(2);
    
    // Clear errors
    document.getElementById('hints').className = "hint";
  }

  return false;
}

function update()
{
  // Check for Valid Inputs
  if(isNaN(this.value))
  {
    hintText = getError(this.id);
    document.getElementById('hints').innerHTML = hintText;
    document.getElementById('hints').className = "error";
    this.style.borderColor = 'red';
  }
  else
  {
    this.style.borderColor = '';
  }

  if(document.getElementById('hints').className != "error")
  {
    if (document.getElementById('Payment').value != "")
    {
      calculate();
    }
  }
}

function setHints()
{
  var hintText = "";
  switch (this.id)
  {
    case 'Payment':
      this.blur();
      document.getElementById('Calculate').focus();
      break;
    case 'APR':
      hintText = "APR (Annual Percentage Rate) - The percent interest ";
      hintText += "accumulated over one year.";
      break;
    case 'Term':
      hintText = "Loan Term - The length of the loan in years.";
      break;
    case 'Amount':
      hintText = "Loan Amount - The amount loaned in dollars.";
      break;
    case 'Clear':
      hintText = "Clear - Empty the input fields";
      break;
    case 'Calculate':
      hintText = "Calculate - Calculate the monthly payment with ";
      hintText += "the given APR, Loan Term, and Loan Amount.";
      break;
  }
  // Don't overwrite error messages
  if ((hintText != "") && (document.getElementById('hints').className != "error"))
  {
    document.getElementById('hints').innerHTML = hintText;
    document.getElementById('hints').className = "hint";
  }
}