#!/bin/bash

if [[ $# -ne 5 ]]
  then
    echo -e "$0\tYEAR(2017)\tFOLDER(10-Winnie.CC.in.Czech)\tPICTURE(2017-10-00_Winnie.CC.in.Czech.469.jpg)\t\tMove to: TYEAR\tTFOLER"
    exit 1
fi

PHOTO='/var/nginx/html/photo'
THUMB='/var/nginx/html/pub/photo/thumb'

YEAR=$1
FOLDER=$2
PICTURE=$3
TYEAR=$4
TFOLDER=$5

if [ `ls -1 $PHOTO/$YEAR/$FOLDER/$PICTURE 2>/dev/null | wc -l` -gt 0 ]
  then
    echo "Moving $PHOTO/$YEAR/$FOLDER/$PICTURE and the thumbnail to $PHOTO/$TYEAR/$TFOLDER/$PICTURE ..."
    mv $PHOTO/$YEAR/$FOLDER/$PICTURE $PHOTO/$TYEAR/$TFOLDER/$PICTURE
    mv $THUMB/$YEAR/$FOLDER/$PICTURE $THUMB/$TYEAR/$TFOLDER/$PICTURE
  else
    echo "$PHOTO/$YEAR/$FOLDER/$PICTURE DOESN'T EXIST"
  fi

