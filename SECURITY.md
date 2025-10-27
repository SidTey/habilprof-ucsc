# Política de Seguridad

## 🛡️ Versiones Soportadas

Actualmente estamos dando soporte de seguridad a las siguientes versiones:

| Versión | Soportada          |
| ------- | ------------------ |
| 1.x.x   | :white_check_mark: |
| < 1.0   | :x:                |

## 🚨 Reportar una Vulnerabilidad

La seguridad de HabilProf es una prioridad. Si descubres una vulnerabilidad de seguridad, por favor repórtala de manera responsable.

### Cómo reportar

**NO** abras un issue público en GitHub para vulnerabilidades de seguridad.

En su lugar, por favor:

1. **Envía un correo electrónico** a: [seguridad@ejemplo.com] (reemplazar con correo real)
2. **Incluye la siguiente información**:
   - Descripción detallada de la vulnerabilidad
   - Pasos para reproducirla
   - Impacto potencial
   - Sugerencias de mitigación (si las tienes)
   - Tu información de contacto

### Qué esperar

1. **Acuse de recibo**: Recibirás confirmación en 24-48 horas
2. **Evaluación**: Evaluaremos la vulnerabilidad en 3-5 días hábiles
3. **Actualización**: Te mantendremos informado del progreso
4. **Resolución**: Trabajaremos en un parche y lo publicaremos
5. **Crédito**: Te daremos crédito por el descubrimiento (si lo deseas)

## 🔒 Buenas Prácticas de Seguridad

Si contribuyes al proyecto, por favor:

### Variables de Entorno
- **NUNCA** commitees el archivo `.env`
- **NUNCA** incluyas credenciales en el código
- Usa `.env.example` como plantilla sin valores reales

### Dependencias
- Mantén las dependencias actualizadas
- Revisa alertas de seguridad de GitHub Dependabot
- Ejecuta `composer audit` y `npm audit` regularmente

### Datos Sensibles
- **NO** incluyas:
  - Contraseñas
  - Claves API
  - Tokens de acceso
  - Información personal
  - Datos de producción

### Código
- Valida TODAS las entradas de usuario
- Usa prepared statements para consultas SQL
- Implementa CSRF protection (Laravel lo hace por defecto)
- Sanitiza salidas para prevenir XSS
- Implementa rate limiting en APIs

## 🔐 Configuraciones de Seguridad Recomendadas

### Para Producción

En tu archivo `.env`:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=<generar-con-php-artisan-key-generate>

# Usar HTTPS en producción
APP_URL=https://tu-dominio.com

# Configurar base de datos segura
DB_CONNECTION=pgsql
DB_HOST=<host-seguro>
DB_PORT=5432
DB_DATABASE=<nombre-db>
DB_USERNAME=<usuario-limitado>
DB_PASSWORD=<contraseña-fuerte>

# Configurar sesiones seguras
SESSION_SECURE_COOKIE=true
SESSION_SAME_SITE=strict
```

### Headers de Seguridad

Configura estos headers en tu servidor web:

```
X-Content-Type-Options: nosniff
X-Frame-Options: DENY
X-XSS-Protection: 1; mode=block
Strict-Transport-Security: max-age=31536000; includeSubDomains
Content-Security-Policy: default-src 'self'
```

## 📋 Checklist de Seguridad

Antes de desplegar a producción:

- [ ] `APP_DEBUG=false` en `.env`
- [ ] `APP_ENV=production` en `.env`
- [ ] Clave `APP_KEY` generada y única
- [ ] Credenciales de BD seguras y limitadas
- [ ] HTTPS habilitado
- [ ] Cookies seguras habilitadas
- [ ] CORS configurado correctamente
- [ ] Rate limiting implementado
- [ ] Logs configurados apropiadamente
- [ ] Backup de base de datos configurado
- [ ] Firewall configurado
- [ ] Dependencias actualizadas
- [ ] Permisos de archivos correctos (755/644)

## 🔄 Actualizaciones de Seguridad

Nos comprometemos a:

- Publicar parches de seguridad lo antes posible
- Notificar a los usuarios de vulnerabilidades críticas
- Mantener un changelog de seguridad
- Seguir las mejores prácticas de la industria

## 📚 Recursos

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security](https://laravel.com/docs/security)
- [PHP Security Guide](https://www.php.net/manual/en/security.php)
- [React Security](https://react.dev/learn/keeping-components-pure)

## 🙏 Agradecimientos

Agradecemos a todos los investigadores de seguridad que reportan vulnerabilidades de manera responsable.

---

Última actualización: Octubre 2025
