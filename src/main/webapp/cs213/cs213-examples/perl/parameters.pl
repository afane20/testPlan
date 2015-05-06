#!/usr/bin/perl

sub test1
{
    @_[0] += 10;  # add's 10 to the array element
    print @_[0];
    print "\n";
    print @_[1];
    print "\n";
}
sub test2
{
    print @_[0];  # @_[0]  or  $_[0]   both seem to work?
    print "\n";
    print $_[1];
    print "\n";
}

$a=6;
$b=500;
test1($a, $b);
test2($a+5, $b+5);

@list = (2,4,6);

print @list[0];
print "\n";
print $list[1];
print "\n";

%hash = ("steve" => 3.5, "john" => 2.5, "dave" => 6.5);
print $hash{"steve"};
print "\n";
print $hash{"john"};
print "\n";
