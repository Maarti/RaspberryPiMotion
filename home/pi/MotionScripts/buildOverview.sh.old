#!/bin/bash

#$1 = 20160120
path="/var/www/html/cam/$1"
mkdir -p "$path/ovr"

# Suppression des fichiers precedents s'ils existent
rm -f "$path/ovr/overview.mp4"
rm -f "$path/ovr/files.txt"
rm -f "$path/ovr/overview_long.mp4"

# Creation du fichier contenant la liste de toutes les videos
for f in $path/*.mp4; do echo "file '$f'" >> $path/ovr/files.txt; done

# Concatenation de toutes les videos
/usr/local/bin/ffmpeg -f concat -safe 0 -i $path/ovr/files.txt -c copy $path/ovr/overview_long.mp4

# Acceleration de la video (0.25 = x4) (-r 16 = framerate de sortie, doit etre multiplie pour ne pas dropframe) 
/usr/local/bin/ffmpeg -i $path/ovr/overview_long.mp4 -r 16 -filter:v "setpts=0.25*PTS" $path/ovr/overview.mp4

# Suppression des fichiers temporaires
rm -f "$path/ovr/overview_long.mp4"
rm -f "$path/ovr/files.txt"
