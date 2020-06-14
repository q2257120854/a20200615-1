#!/bin/bash
ROOT=/Library/WebServer/Documents
cd ${ROOT}/work/[work]
tar xvf old.ipa
cd Payload/*.app
cp ../../[cert].mobileprovision embedded.mobileprovision
cd ../../
find -d Payload \( -name "*.app" -o -name "*.appex" -o -name "*.framework" -o -name "*.dylib" -o -name "*.nib"[replace] \) > directories.txt
while IFS='' read -r line || [[ -n "$line" ]]; do
/usr/bin/codesign --continue -f -s "iPhone Distribution: [name]" --entitlements "[cert].plist" "$line"
done < directories.txt
zip -r -q new.ipa Payload
rm -rf Payload
rm -f old.ipa