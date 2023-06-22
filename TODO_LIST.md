Em falta:
 - Requests & Policies!!!
 - Upload de Estampas Personalizadas
 - Cart
 - Add to Cart
 - Dashboard
 - Tabelas e Gráficos com users e estatísticas
 - Fix colunas "Actions" em todas as views dentro do "Dashboard"
 - Fix dropdown menu dentro do "Dashboard"
 - Perfil - Editar Foto
 - Perfil - Editar Perfil
 - Adicionar paginação na view "Camisolas"
 - Adicionar paginação na view "Cart"
 - Passar "quantity" dos catálogos para opção dentro do carrinho
 - Fix ao Filtro e Pesquisa

 - Acabar Ficha 9 (a partir da pagina 26)
 - Ver ficha 8
 - Ver enunciado e verificar o que falta



Configurações iniciais:
- alterar DB_DATABASE dentro do ficheiro .env de acordo com o ficheiro de base de dados fornecidos (linha 15)
- alterar APP_NAME dentro do .env (opcional)
- ou alterar ficheiro app.php (linha 18)
- ver bootstrap com side menus
  

### BOOTSTRAP
composer require laravel/ui
php artisan ui bootstrap
npm install
npm run dev

### AUTHENTICATION
php artisan ui bootstrap --auth
npm install
npm run dev

### MAIL TRAP CONFIGURATIONS
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1f072986ddbe71
MAIL_PASSWORD=778de07c5e8862
MAIL_ENCRYPTION=tls

https://mailtrap.io/inboxes/2190065/messages
