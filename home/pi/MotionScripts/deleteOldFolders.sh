#!/bin/bash

# On ecrit la date pour les logs
date

# Recuperation de la date d'il y a un mois
minFolderToKeep=$(date -d 'now - 1 month' +%Y%m%d)
echo 'minFolderToKeep = '$minFolderToKeep

# Pour chaque dossier de /cam/ (pas les sous-dossiers, ni cam lui-meme)
for folderUrl in `find /var/www/html/cam/ -mindepth 1 -maxdepth 1 -type d`
do
	# Recuperation de la date du dossier
	folderName=$(basename $folderUrl)

	# On supprime le dossier et son contenu sil a plus dun mois
	if [ $folderName -lt $minFolderToKeep ]; then
		rm -rfv $folderUrl
	fi
done
