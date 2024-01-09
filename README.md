# NSIGN TEST SYMFONY

Este proyecto consiste en una API construida en Symfony que interactúa con la API de Stack Exchange para extraer datos específicos de Stack Overflow. Proporciona tres endpoints principales para consultar preguntas, publicaciones y respuestas, ofreciendo varias opciones de filtrado.

## Requisitos Previos

- Asegúrate de tener Composer instalado.
- (Opcional) Si estás utilizando Docker, asegúrate de tenerlo instalado y configurado correctamente.

## Instalación y Configuración

1. Ejecuta `composer update` para instalar todas las dependencias necesarias.
2. Inicia el servidor Symfony con el comando `symfony server:start`.

## Uso de la API

Para probar y utilizar la API, sigue los siguientes pasos:

### Importar en Postman

1. Importa el archivo `nsign-test-symfony.postman_collection.json` que se encuentra en `storage/postman` a tu cliente Postman.

### Endpoints Disponibles

El servicio estará disponible en las siguientes rutas:

- Consultar publicaciones de Stack Overflow: `http://127.0.0.1:8000/api/stackoverflow_posts`
- Consultar preguntas de Stack Overflow: `http://127.0.0.1:8000/api/stackoverflow_questions`
- Consultar respuestas de Stack Overflow: `http://127.0.0.1:8000/api/stackoverflow_answers`

#### Detalles de los Endpoints

- **Publicaciones de Stack Overflow**: Proporciona una lista de publicaciones de Stack Overflow con opciones de filtrado basadas en diferentes parámetros.
  
- **Preguntas de Stack Overflow**: Ofrece una lista de preguntas de Stack Overflow, permitiendo ciertas opciones de filtrado como etiquetas, fecha, entre otros.

- **Respuestas de Stack Overflow**: Retorna una lista de respuestas de Stack Overflow, con opciones de filtrado similares a las preguntas.

### Ejemplos y Consideraciones

- Al hacer solicitudes a cualquiera de los endpoints, asegúrate de proporcionar los parámetros necesarios según la documentación de la API.
- Consulta la documentación adicional o los comentarios en el código fuente para obtener más detalles sobre cada endpoint y sus parámetros.

## Configuración de Docker Symfony




