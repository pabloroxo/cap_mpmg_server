# cap_mpmg_server

Usei o Laravel 5.8 por familiaridade.

Escolhi usar MongoDB visando a vaga. Desta forma, como é um banco schema free, não foi necessário usar migrations. Mas, se não fosse por isso, teria sido da seguinte forma:

```php
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('balance', 15, 2)->default(0); //saldo da conta até 999.999.999.999.999,99 (1 quatrilhão menos 1 centavo) inicialmente com R$ 0,00
            $table->char('agency', 4); //agência bancária
            $table->string('account', 10); //conta bancária
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
```

Para a conexão com o banco de dados foi utilizada a lib **jenssegers/mongodb**.

Para a gerência da autenticação foi utlizada a lib **tymon/jwt-auth**. É necessário executar o comando:
```shell
php artisan jwt:secret
```
no terminal para criar o token secreto no .env.

Assim que o MongoDB estiver instalado, configurar o .env para:

```dotenv
DB_CONNECTION=mongodb
DB_HOST=127.0.0.1
DB_PORT=27017
DB_DATABASE=bancocap   #ou outro nome de banco
DB_USERNAME=           #ou algum usuário
DB_PASSWORD=           #ou alguma senha
```
E, por fim, rodar o comando:

```shell
php artisan db:seed
```

no terminal para criar um usuário de teste. Para fazer o login, o e-mail é **testador@cap.com** e a senha é **123456**.

As únicas rotas funcionais são as de API e redirecionam para os seguintes controllers:

* Auth\AuthController: controller de autenticação com métodos para login e logout.
* Auth\UserController: controller do usuário, com um método para se obter informações do mesmo.
* Auth\AccountController: controller para movimentação bancária, com métodos para realizar saques e depósitos.