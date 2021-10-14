# Trabajo práctico integrador

### Sistema de postulación de alumnos a propuestas laborales

1) Requisitos funcionales:
Se ha decidido implementar una aplicación web en donde los distintos alumnos de la  Universidad Tecnológica Nacional podrán postularse a propuestas laborales. Estas propuestas  están relacionadas a las distintas carreras que brinda la universidad.

Los Alumnos de la universidad pueden ingresar a la aplicación ingresando su email dentro de la aplicación. Esto se debe a que la universidad ha creado una base de datos sobre la 
información de los alumnos registrados dentro de la universidad.

Una vez dentro de la aplicación, los alumnos podrán realizar las siguientes actividades:

- Ver su información y estado académico.
- Consultar el listado de empresas registradas en la aplicación. 
- Consultar las diversas propuestas laborales de las empresas.
- Podrá aplicar a un puesto laboral. Esto significa que queda seleccionado para que la 
empresa se comunique con el alumno y tener una futura entrevista.
- Consultar el historial de propuestas que un alumno se ha postulado.

Por otro lado, dentro de la aplicación, también existe el rol de usuario “Administrador”. 
Estos administradores son parte del personal académico de la universidad y son los encargados de publicar las distintas propuestas dentro de la aplicación.

Un administrador puede:

- Administrar la información de las empresas. Puede ingresar nuevas empresas a la 
aplicación, modificarlas o eliminar una empresa.
- Cargar nuevas propuestas laborales en la plataforma.
- Ver el alumno propuesto para una oferta laboral
- Crear nuevos usuarios dentro de la aplicación.

2) Requisitos no funcionales: 
Programación en capas de la aplicación respetando la arquitectura de 3 capas lógicas vista  durante la cursada. Esto implica el desarrollo de las clases que representen las entidades del modelo y controladoras de los casos de uso, las vistas y la capa de acceso a datos.
La información personal de los distintos alumnos será por medio del uso de una API pública creada específicamente para este trabajo práctico. Para poder acceder a la información de esta API utilizaremos el siguiente link:

https://utn-students-api.herokuapp.com/index.html

3) Implementación mínima para la aprobación de la primer entrega:

● Cuando un Alumno ingrese a la aplicación por medio del login, se deberá obtener toda 
la información de este alumno desde la API
● El sistema deberá permitir que un usuario de tipo Administrador pueda: crear, modificar 
y eliminar Empresas.
● La persistencia de las empresas será por medio de archivos JSON.
● Un Alumno puede consultar la lista de empresas dentro de la aplicación. También, 
puede consultar la información específica de una empresa.

4) Implementación extra para aumentar la nota de la primer entrega:

● Un alumno puede filtrar la lista de empresas a través de su nombre
