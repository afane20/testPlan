#!/usr/bin/perl

$count = 1;
open(QFILE, "quotes.txt");
while(<QFILE>)
{
  $_;
  print "Quote $count    $_";
  $count++;
}
