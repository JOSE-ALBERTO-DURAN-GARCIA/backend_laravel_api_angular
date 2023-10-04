# comandos Git
- para comenzar con git 
## instalar Git
- Descargar e Instalar Git: https://git-scm.com/
## configurar Git
- nos presentamos con git
``` bash
git config --global user.email jose9708561@gmail.com
git config --global user.name "jose Duran Garcia"
```
## crear una cuenta en (Github), GitLab o BitBucket
----------------------------
## crear un repositorio Remoto (GitHub)
- identificar la direccion del repositorio remoto (github)
- https://github.com/JOSE-ALBERTO-DURAN-GARCIA/backend_laravel_api_angular.git

- ?? clonar el repositorio si ya existe el repositorio
```
git clone direccion_del_repositorio
```
- inicializar si es un nuevo repositorio de GIT (local)
```
git init
```
## relacionar el repositorio local con el
repositorio remoto
```
git remote add origin https://github.com/JOSE-ALBERTO-DURAN-GARCIA/backend_laravel_api_angular.git
```

--------
--------
```
git add .
git commit -m "Laravel Base + Api Auth"
git push origin master
```