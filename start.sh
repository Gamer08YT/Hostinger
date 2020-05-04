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
    -l=*|--language=*)
		LANGUAGE="${i#*=}"
		shift # Server Language
    ;;
	-b=*|--binary=*)
		BIN="${i#*=}"
		shift # Server Path
    ;;
    *)
          # Start script unknown option
    ;;
esac
done

if ! screen -list | grep -q ${SCREEN}; then
	if [ ${LANGUAGE} == "java" ]; then
		if test -f "$BIN$SERVER_STARTBINARY_JAVA"; then
			screen -SL ${SCREEN} -Logfile ./triox-server.log java -jar "$BIN$SERVER_STARTBINARY_JAVA"
			else 
				echo "SERVER_BINARY"
				exit 1
		fi
	else
		if test -f "$BIN$SERVER_STARTBINARY_JS"; then
				screen -SL ${SCREEN} -Logfile ./triox-server.log node "$BIN$SERVER_STARTBINARY_JS"
			else 
				echo "SERVER_BINARY"
				exit 1
		fi
	fi
echo "SERVER_STARTING"
else
	echo "SERVER_ONLINE"
fi