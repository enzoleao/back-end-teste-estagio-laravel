<h1 align="center">Back end do aplicativo Registro de Empresas</h1>
<p align="center">API em Laravel para um aplicativo de gerenciamento de Empresas</p>
<img src="https://img.shields.io/badge/PHP-WORK-green">

# Lista de conteúdos

<!--ts-->

- [Lista de conteúdos](#lista-de-conteúdos)
    - [💻 Sobre](#-sobre)
      - [Start](#start)
      - [Rotas](#rotas)
        - [Companies](#companies)
        - [Sectors](#sectors)
      - [Funcionalidades](#funcionalidades)
    - [Tecnologias](#tecnologias)
    - [Autor](#autor)
<!--te-->

---

### 💻 Sobre

API em PHP / Laravel para o desenvolvimento do aplicativo de gerencimaneto de Empresas

---
#### Start
```bash
composer install

php artisan migrate

php artisan db:seed --class=SectorsStart

php artisan dev

```

#### Rotas

##### Companies

- [x] GET /companies  
- [x] GET /companies/{companyId} 
- [x] POST /companies 

##### Sectors
- [x] GET /sectors 
- [x] POST /sectors 


#### Funcionalidades
- [x] Integração com banco de dados MySQL
- [x] Registro de Empresas e os setores que a mesma atua.
- [x] Retorno de todas as empresas e seus respectivos setores cadastradas.


### Tecnologias

- [Laravel](https://laravel.com)

---


### Autor

[Enzo Gabriel Pinheiro de Leão](https://www.linkedin.com/in/enzo-le%C3%A3o-976270202/)

Em busca do próximo nível 🚀 - Never stop learning. 🧑‍🎓

<h4 align="center"> 
	🧑‍🔧 Em construção! 🚧
</h4>
