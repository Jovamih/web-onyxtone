# Pagina web de la Boutique D'KAR

### Realizar tus primeros pasos
* Para clonar este repositorio en tu maquina local usa **git clone**
 
```
git clone https://github.com/Jovamih/web-dkar.git <nombre_carpeta>
```

 ***<nombre_carpeta>** es el nombre de la carpeta donde guardaras el repositorio clonado en tu computadora.*
 
* Cuando modificas el codigo y deseas agregar los nuevos cambios en tu repositorio local.
 
```
git add .
git commit -am"my first commit"
```

 ***"my first commit"** es la descripcion del cambio que has realizado*
 
 * Para subir los cambios de tu repostorio local a tu repositorio en la nube usa **git push**
 
```
git push origin main
```

 ***main** es el nombre de la rama por defecto donde se encuentre el codigo principal, en caso haya creado otra rama diferente al **main**, debera reemplazar este por el nombre de la rama desde donde desea subir los cambios*.
 
 ### Contribuir al proyecto
 
 * **Para contribuir en el proyecto has los siguientes pasos que se muestran en la imagen de a continuacion**
![Pasos a seguir](https://i.ibb.co/3mTRC7v/show-contribute.png)

1)   Ve a github y sincroniza tu repositorio con el repositorio remoto.
2)  Ve a github y realiza un pull request

### Actualizar tu proyecto con los cambios actuales de los demas integrantes

Existen **dos maneras diferentes** para que nuestro proyecto tenga los cambios de los demas integrantes en tiempo real.

1)   Ve a github y sincroniza tu repositorio con el repositorio remoto (Este es el paso que se exploró enteriormente)
2)   Abre tu terminal de Git y siga los siguientes pasos:

a)Ingresa el comando **git remote add** para enlazar tu proyecto local con el respositorio remoto de tu equipo
```
git remote add upstream https://github.com/Jovamih/web-dkar.git
```
* **https://github.com/Jovamih/web-dkar.git** : Es la URL del proyecto padre, es de suponer que todos los integrantes del equipo haran sus pull requests en ese repositorio para unir sus codigos, por ello necesitas agregar la URL de ese proyecto principal, porque de esa manera obtendras los cambios que han aportando los demas integrantes.

* Esta configuracion solo se agrega una vez

b) Ingresa el comando **git pull** para actualizar tu proyecto con el del repositorio remoto donde trabaja tu equipo.

```
git pull upstream main
```

Luego de ello tu repositorio local se actualiza a la ultima version. Y listo esos serian todos los pasos.

#### Desarrolladores:
* @jeffcaco
* @tanque
* @jovamih

