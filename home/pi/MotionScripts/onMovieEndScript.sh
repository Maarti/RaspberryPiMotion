# Convert .avi to .mp4 and move it to www folder
# $1 = Name of the source .avi file
# $2 = year
# $3 = month
# $4 = day
# $5 = hour
# $6 = min
# $7 = sec
sourcefilename=$(basename "$1")
echo sourcefilename = $sourcefilename
#extension="${filename##*.}"
sourcefilename="${sourcefilename%.*}"
year=${sourcefilename:0:4}
month=${sourcefilename:4:2}
day=${sourcefilename:6:2}
#mkdir /var/www/html/cam/$2$3$4 >/tmp/mkDir.log 2>&1
mkdir /var/www/html/cam/$year$month$day
ffmpeg -i $1 -c:v libx264 -c:a copy /var/www/html/cam/$year$month$day/$sourcefilename.mp4
touch /tmp/onMovieEndScriptExecuted.tmp
mv /var/lib/motion/$sourcefilename.jpg /var/www/html/cam/$year$month$day/$sourcefilename.jpg
