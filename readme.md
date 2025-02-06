# 🛡️ SISTEMA DE AUTENTICAÇÃO PHP + REACT

### 💬 Descrição

<p>Este projeto é um sistema de autenticação seguro desenvolvido com PHP no backend e React no frontend. Ele possui proteção contra ataques de força bruta, bloqueando o usuário após muitas tentativas de login falhas.</p>

## ⚙️ Funcionalidades

<p>
✅ Bloqueio após Múltiplas Tentativas: Sistema de proteção que bloqueia o IP de acesso após um número excessivo de tentativas falhas. Após o bloqueio, terá que aguardar um tempo minimo para tentar novamente <br/><br/>

✅ Autenticação com Token (JWT): Implementação de JSON Web Token para segurança e persistência da sessão. <br/><br/>

✅ Salvamento de Token no Navegador: Quando o usuário faz login, o sistema salva um token de autenticação no navegador (LocalStorage). Toda vez que ele acessa uma nova página, esse token é enviado para o backend para confirmar que a sessão ainda é válida. Se o token for inválido ou expirado, o usuário é deslogado automaticamente. <br/><br/>

✅ Interface Responsiva: Design adaptável para desktop, tablets e smartphones. <br/><br/>

</p>

### 🤖 Linguagens e Tecnologias Utilizadas

<p align="left">
  <a href="https://skillicons.dev">
    <img src="https://skillicons.dev/icons?i=git,html,css,react,php,mysql" />
  </a>
</p>

### 🚀 Como Instalar?

`Clone esse Repositorio`

```
git clone https://github.com/Borsatole/SistemaAutenticacao.git
```

`Acesse a pasta do projeto`

```
cd SistemaAutenticacao
```

<p> 
## 📁 Configuração do Backend

1. **Instale o Composer** (caso ainda não tenha instalado).
2. **Instale o XAMPP** ou outro servidor local de sua preferência.
3. **Mova a pasta `backend`** para dentro da pasta do seu servidor local.
4. **Acesse sua pasta `backend` pelo terminal e rode o comando .**

```
composer require firebase/php-jwt
```

5. **Acessando pelo localhost o endereço deve ser `http://localhost/Backend/Auth/login.php`**
6. **No seu MYSQL crie um database chamado `sistemacomauth` e depois importe o db.sql**

</p>

<p> 
## 📁 Configuração do FrontEnd

1. **Acesse a pasta FrontEnd** e rode o seguinte comando para instalar as dependencias.

```
npm install
```

2. **Apos a instalação de todas dependencias basta rodar o comando**

```
npm run dev

```

</p>
