#!/usr/bin/env bash

#| Script Version (2019.1.10)
#| Script Author Jan Heil
#| Script Website www.byte-store.de


#
# Default example Script from center.byte-store.de
# Language English
#

SERVER_STARTBINARY_JAVA="DiscordBot.jar"
SERVER_STARTBINARY_JS="index.js"

for i in "$@"
do
case ${i} in
    -s=*|--screen=*)
		SCREEN="${i#*=}"
		shift # Server Screen Name
    ;;
    *)
          # Start script unknown option
    ;;
esac
done

if screen -list | grep -q ${SCREEN}; then
	screen -X -S ${SCREEN} quit
	echo "SERVER_STOPPING"
else
	echo "SERVER_OFFLINE"
fi