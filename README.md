# This is a repository just to work things

## TOKEN: (Expires on Wed, Sep 3 2025) 

    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

🔒 NO tienes permisos de escritura (ni lectura, si es privado) en el repositorio remoto.

✅ POSIBLES CAUSAS Y SOLUCIONES
🚫 1. Repositorio privado y no estás autenticado
Si el repositorio es privado, necesitas autenticarte con un token personal o SSH.

✅ SOLUCIÓN: usar token (HTTPS)
Si ya tienes un token de acceso personal (PAT), debes clonar o hacer pull así:

        git remote set-url origin https://<TU_TOKEN>@github.com/JuanOsorner/practicasDeltrabajo.git

⚠️ ¡Sensible! Si haces esto en consola, el token queda guardado en texto plano en el historial.

✅ Recomendado: Guardar el token en Git Credential Manager
Ejecuta:

        git config --global credential.helper manager-core

Luego haz git pull origin main.

Git te pedirá:

Usuario: tu nombre de usuario de GitHub

Contraseña: el token (no tu contraseña real)

