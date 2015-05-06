#!/usr/bin/perl

$ref_sum = \$sum;
$sum = 100;
print "$sum\n";
print "$ref_sum\n";       # print the address
print "$$ref_sum\n";      # dereference

$ref_list = [2,4,6,8];    # create a reference list
print "$ref_list\n";
print "$$ref_list[0]\n";  
print "$$ref_list[1]\n";
print $ref_list->[3], "\n";;

sub test1
{
    @_[0] += 10;
    print @_[0];
    print "\n";
    print @_[1];
    print "\n";
}
$a=6;
$b=500;
test1($a, $b);
