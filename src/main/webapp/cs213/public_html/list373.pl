#!/usr/bin/perl

print "Content-type: text/html\n\n";

chdir ("/home/ercanbracks/public_html/cs373/assign03");
@htmlFiles = <*.html>;
print "<OL>\n";
foreach $file (@htmlFiles)
{
   print "<LI><A HREF=\"/~ercanbracks/cs373/", $file, '">';
   print "$file</A>\n"
}
print "</OL>\n";
