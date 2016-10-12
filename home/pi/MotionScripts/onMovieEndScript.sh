# Convert .avi to .mp4 and move it to www folder
# $1 = Name of the source .avi file
sourcefilename=$(basename "$1")
echo sourcefilename = $sourcefilename
#extension="${filename##*.}"
sourcefilename="${sourcefilename%.*}"
year=${sourcefilename:0:4}
month=${sourcefilename:4:2}
day=${sourcefilename:6:2}

# Creation dossier
mkdir -p /var/www/html/cam/$year$month$day

# Encodage .mp4 et deplacement
ffmpeg -i $1 -c:v libx264 -c:a copy /var/www/html/cam/$year$month$day/$sourcefilename.mp4

# Déplacement de l'image
#mv /var/lib/motion/$sourcefilename.jpg /var/www/html/cam/$year$month$day/$sourcefilename.jpg
convert /var/lib/motion/$sourcefilename.jpg -interlace Plane -quality 80 /var/www/html/cam/$year$month$day/$sourcefilename.jpg

# Suppression de l'image / video source
rm /var/lib/motion/$sourcefilename.*
