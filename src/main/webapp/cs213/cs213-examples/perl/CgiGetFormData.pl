#!/usr/bin/perl

#
#  This function reads the form "query string"
#  It returns a hash consisting of the form elements "name/value" pairs.
#  This function handles both an http "get" or "post" method.

sub CgiGetFormData
{     
   my $formData;
   if ($ENV{'REQUEST_METHOD'} eq "GET")
   {
       $formData = $ENV{'QUERY_STRING'};
   }
   else
   {
       read (STDIN, $formData, $ENV{'CONTENT_LENGTH'});
   }
   @keyValuePairs = split (/&/, $formData);
   foreach $keyValue (@keyValuePairs)
   {
	($key, $value) = split (/=/, $keyValue);
	$value =~ tr/+/ /;
	$value =~ s/%([\dA-Fa-f][\dA-Fa-f])/pack ("C", hex ($1))/eg;
	if (defined ($form{$key}))
	{
	    $form{$key} = join ("\0", $form{$key}, $value);
	}
	else
	{
	    $form{$key} = $value;
	}
    }
   return %form;
}

%formdata = CgiGetFormData;

print "Content-type: text/html\n\n";
print "<html>";
print "<title>Read Form!</title>\n";
print "<body>";
print "<h3>";
print "\nThis is  data:\n ";
print "</h3>";

foreach $keyValue (keys %formdata)
{
    print "$keyValue = $formdata{$keyValue} <br/>";
}

print "<br/>";
print "</body>";
print "</html>";

