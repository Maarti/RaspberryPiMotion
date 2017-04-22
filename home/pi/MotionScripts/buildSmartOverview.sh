#!/bin/bash
# Param : $1 = 20160120

echo "____________________BEGIN________________________"
date
path="/var/www/html/cam/$1"

# On verifie quil y a des fichiers a traiter, sinon on ne fait rien
count=`ls -1 $path/*.mp4 2>/dev/null | wc -l`
echo $count " fichier(s) .mp4 trouve(s)"

if [ $count != 0 ]
then
	mkdir -pv $path/ovr

	# Suppression des fichiers precedents s'ils existent
	rm -fv $path/ovr/*.txt
	rm -fv $path/ovr/overview_*.mp4

	# Creation du fichier contenant la liste de toutes les videos
	for f in $path/*.mp4; do echo "file '$f'" >> $path/ovr/files.txt; done

	# Concatenation de toutes les videos
	ffmpeg -f concat -safe 0 -i $path/ovr/files.txt -c copy $path/ovr/overview_long.mp4

	# Acceleration de la video (0.25 = x4) (-r 16 = framerate de sortie, doit etre multiplie pour ne pas dropframe) 
	ffmpeg -i $path/ovr/overview_long.mp4 -r 16 -filter:v "setpts=0.25*PTS" $path/ovr/overview_to_append.mp4

	# On concatene l'overview creee a celle existante s'il en existe une
	if [ -f $path/ovr/overview.mp4 ]
	then
		#/usr/local/bin/ffmpeg -f concat -safe 0 -i "file $path/ovr/overview.mp4\n file $path/ovr/overview_to_append" -c copy $path/ovr/new_overview.mp4
		#/usr/local/bin/ffmpeg -f concat -safe 0 -i <(printf "file '$path/ovr/overview.mp4'\nfile '$path/ovr/overview_to_append.mp4'\n") -c copy $path/ovr/new_overview.mp4
		cp -v /home/pi/MotionScripts/ovr_concat.txt $path/ovr/
		ffmpeg -f concat -safe 0 -i $path/ovr/ovr_concat.txt -c copy $path/ovr/overview_new.mp4
		cp -v $path/ovr/overview_new.mp4 $path/ovr/overview.mp4
	else
		cp -v $path/ovr/overview_to_append.mp4 $path/ovr/overview.mp4
	fi

	# Suppression des videos/img qui ont ete fusionnees
	file=$path/ovr/files.txt
	while IFS= read -r line
	do
	#$line = 		file '/var/www/html/cam/20161015/20161015hhmmss.mp4'
		fileToMove=$(echo $line | cut -c7-47)
		mv -v $fileToMove.* /tmp/
	done <"$file"

	# Suppression des fichiers temporaires
	rm -fv $path/ovr/overview_*.mp4
	rm -fv $path/ovr/*.txt
fi
echo "_____________________END_________________________"
