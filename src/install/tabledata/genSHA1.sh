#!/bin/bash

######################################################################
# SHA1 Checksum Generator
# Using this will re-generate all checksums for all SQL queries.
#
# @package src/install
# @author Brian Turchyn
######################################################################

shopt -s nullglob

clear

echo '===================================================================='
echo '=                                                                  ='
echo '=                         !!! WARNING !!!                          ='
echo '=                                                                  ='
echo '=  This will re-generate all SHA1 checksums for your SQL install   ='
echo '=   queries. Doing this will defeat the purpose of the checksums   ='
echo '=                         being in place.                          ='
echo '=                                                                  ='
echo '=          Only use this if you know what you are doing!           ='
echo '=                                                                  ='
echo '===================================================================='
echo
echo
echo "Press Ctrl+C NOW if you want to back out of this."

read -n 1 -s

echo
echo

for f in *.sql
do
  echo "Generating SHA1 checksum for $f..."
  sha1 -q $f > $f.sha1
done

echo
echo 'Done!'
