#!/usr/bin/perl -w
use warnings;
use CGI qw(:standard);
#! must use 'my' to define a variable
print header;
my $now_string = localtime();
print "<b>Hello, CGI using Perl!</b><br/>It's $now_string NOW!<br />";