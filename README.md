Não adicionei autenticação por uma questão de comodidade. <br/>
O front-end todo funciona baseado no id que foi utilizado pra logar. <br/>
Utilizando direto pela api é necessário inserir todos os ids em cada requisição, sem puxar automaticamente do token. <br/>

---

Preferi utilizar apenas uma classe User, com os relacionamentos sendo alterados pelo tipo de usuário, mas entendo que em um ambiente de produção fosse melhor classes separadas, e as informações de login em uma outra tabela pro login ser unificado. 

---

Sendo o seeder a primeira execução, os dados criados serão: <br/>
3 UBS. Ids: ```[1,2,3]``` <br/>
3 Pacientes. Ids: ```[1,2,3] ```<br/>
5 Doutores. Ids: ```[4,5,6,7,8]``` <br/>
1 Recepcionista. Id: ```9``` <br/>
Atribui 9 agendamentos aos médicos da UBS 1 ```[4,5]``` <br/>
Atribui 9 agendamentos aos médicos da UBS 2 ```[6,7]``` <br/>
Atribui 2 agendamentos aos médicos da UBS 3 ```[8]``` <br/>

Dados necessários para ver todos os filtros, e funcionalidades do front-end. <br/>
Como não estava especificado não fiz uma tela para criar usuários e ubs, mas as rotas estão disponíveis. Ou pode utilizar o seeder para gerar o inicial, e dar continuidade <br/>

---
São necessários 2 terminais para rodar o projeto. <br/>
Deixei o sqlite pronto só sendo necessário instalar as dependências e fazer as migrações. <br/>

## ./backend
```
composer install
php artisan migrate:fresh //Limpa o db e faz a nova migração
php artisan db:seed //Insere dados pra conferir todo o funcionamento
php artisan serve
```

## ./frontend
```
npm install
npm run serve
```
---
Coleção usada no postman também na raiz do projeto.

---

<strong>(WSL) <br/>
PHP 8.3.7 <br/>
Composer version 2.7.6 <br/> <br/>

(Windows) <br/>
Node v22.2.0 <br/>
Npm 10.8.1 <br/></strong>