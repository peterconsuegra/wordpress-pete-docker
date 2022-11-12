#!/bin/bash 

echo "inside mod_security sscript"
echo "MOD_SECURITY: $1"
MOD_SECURITY=$1

if [ "${MOD_SECURITY}" = "On" ]; then
echo "MOD_SECURITY is on";
find /etc/modsecurity/modsecurity.conf -type f -exec sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/g' {} \;
fi