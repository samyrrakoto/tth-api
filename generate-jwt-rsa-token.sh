#!/bin/bash
PASS=$(cat /dev/urandom | tr -dc 'a-zA-Z0-9' | fold -w 8 | head -n 1)
echo "Generating rsa key pair for JWT with passphrase : "${PASS}
$(openssl genrsa -out config/jwt/private.pem -passout pass:$PASS 2048)
$(openssl rsa -in config/jwt/private.pem -pubout -out config/jwt/public.pem)
echo -e "\n"
echo -e 'Replacing in .env file : JWT_PASSPHRASE=tobeset with JWT_PASSPHRASE='${PASS}
echo -e "\n"
$(sed -i 's/JWT_PASSPHRASE=tobeset/JWT_PASSPHRASE='$PASS'/g' .env)