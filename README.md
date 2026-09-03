# Sistema de Ordem de Serviços - JM Informática

Este é o repositório do Sistema de Ordem de Serviços da **JM Informática**, desenvolvido em **PHP** e **MySQL**. O sistema permite que o gestor gerencie os serviços prestados pelos funcionários, visualizando métricas, calculando comissões e acompanhando o status das demandas.

Abaixo está a lista de tarefas baseada nos requisitos levantados no projeto agrupadas por requisitos funcionais (RF), requisitos não funcionais (RNF) e regras de negócios (RN):

## 📋 Requisitos Funcionais (RF)
- [x] **RF01** - **Autenticação**: Tela de login deve validar e-mail e senha: redireciona para o Dashboard se houver sucesso ou exibe mensagem "Ops, Email ou Senha inválido" se falhar.
- [x] **RF02** - **Dashboard**: Deve exibir dados do usuário logado e data atual.
- [x] **RF03** - **Dashboard**: Deve exibir tabela de serviços prestados pelos funcionários contendo as colunas ID, Descrição, Status, Valor e Nome do Usuário.
- [x] **RF04** - **Dashboard**: Deve exibir coluna **Ações** na tabela com botões para **Excluir**, **Alterar** e **Finalizar** o registro do serviço.
- [x] **RF05** - **Dashboard (Serviços Finalizados)**: Deve exibir de forma destacada uma pequena lista com os últimos serviços com status **"Finalizado"** e o **Valor Total** dos serviços prestados pelo usuário logado.
- [x] **RF06** - **Dashboard (Serviços Pendentes)**: Deve exibir de forma destacada uma pequena lista com os últimos serviços com status **"Pendente"**.
- [x] **RF07** - **Finalizar Serviço**: Ao clicar em finalizar, o sistema deve gravar a data de finalização, calcular a comissão gerada e disparar um e-mail para o usuário que realizou o serviço.
- [x] **RF08** - **Filtros**: Deve permitir buscar serviços na tabela por **Período** (informando data inicial e/ou final).
- [x] **RF09** - **Filtros**: Deve permitir buscar serviços na tabela pelo **Nome do serviço**.
- [x] **RF10** - **Filtros**: Deve permitir buscar serviços na tabela por **Status**.
- [x] **RF11** - **Filtros**: Deve permitir buscar serviços na tabela pelo **Nome do usuário**.
- [x] **RF12** - **Adicionar Serviço**: Botão deve permitir abrir uma nova tela com formulário para cadastro de novos serviços contendo os campos necessários.
- [x] **RF13** - **Adicionar Serviço**: Caso sucesso ao preencher (Descrição e Valor), deve salvar registro com mensagem de sucesso e redirecionar para tela inicial.
- [x] **RF14** - **Adicionar Serviço**: Caso falha (falta de dados obrigatórios ou erro), deve barrar o cadastro, exibir mensagem de falha e redirecionar para a tela inicial.
- [x] **RF15** - **Editar Serviço**: Deve ser possivel editar as informações de um serviço.
- [x] **RF16** - **Excluir Serviço**: Deve ser possivel excluir um serviço.


## 💼 Regras de Negócio (RN)
- [x] **RN01** - **Status do Serviço**: O sistema deve definir o status baseado na data de finalização: Serviços sem data de finalização deve ser igual a "Pendente" e serviços com data de finalização deve ser igual a "Finalizado".
- [x] **RN02** - **Auto-atribuição**: Novos serviços cadastrados devem ser vinculados e pertencer automaticamente ao usuário que está logado no momento.
- [x] **RN03** - **Status Inicial**: Todo novo serviço deve ser cadastrado obrigatoriamente com o status de "Pendente".
- [x] **RN04** - **Campos Obrigatórios**: O cadastro deve ser efetuado apenas se "Descrição do serviço" e "Valor" estiverem preenchidos.
- [x] **RN05** - **Comissão Faixa 1**: Para serviços com valor menor ou igual a R$ 1.000,00, a comissão gerada deve ser de **5%**.
- [x] **RN06** - **Comissão Faixa 2**: Para serviços com valor maior que R$ 1.000,00 e até R$ 10.000,00, a comissão gerada deve ser de **10%**. *(Obs: limite superior inferido para não causar conflito com a Faixa 3)*.
- [x] **RN07** - **Comissão Faixa 3**: Para serviços com valor maior que R$ 10.000,00, a comissão gerada deve ser de **20%**.

## 🛠️ Requisitos Não Funcionais (RNF)
- [x] **RNF01** - **Linguagem de Programação**: O sistema deve ser implementado na linguagem PHP.
- [x] **RNF02** - **Banco de Dados**: O sistema deve utilizar MySQL para gerenciar e salvar o banco de dados.
- [x] **RNF03** - **Envio de Emails**: O sistema deve ter um serviço de SMTP ou biblioteca configurada em PHP para envio dos e-mails de finalização (ex: PHPMailer).
- [x] **RNF04** - **Interface (UI)**: A tela de Dashboard deve possuir elementos visuais que consigam destacar corretamente as seções de valor total financeiro e lista de serviços pendentes.

## 🚀 Como Configurar e Executar o Projeto

### 1. Pré-requisitos
* **PHP** (versão 7.4 ou superior)
* **MySQL**
* Servidor Web (Pode ser Apache via XAMPP/WAMP, Nginx, ou o servidor embutido do PHP)

### 2. Instalação e Configuração do Banco de Dados
1. Clone este repositório.
2. Acesse o seu gerenciador de banco de dados e crie um banco de dados.
3. Crie as tabelas necessárias `user` e `service` e certifique-se de que a tabela `service` possui uma chave estrangeira apontando para `user`.

### 3. Configuração do Ambiente (.env)
1. Na raiz do projeto, localize o arquivo `.env.example`.
2. Duplique este arquivo e renomeie a cópia para `.env`.
3. Abra o arquivo `.env` e preencha com as credenciais do seu banco de dados local:
```env
DB_HOST=localhost
DB_NAME=seu_banco
DB_USER=seu_usuario_do_banco
DB_PASS=sua_senha_do_banco
```

## Melhorias Futuras (Roadmap)

**Validação**: Implementar uma classe Request para interceptar os dados da requisição antes que cheguem no controller e aplicar validação completa.

**Paginação de Resultados:** Implementar paginação na tabela do Dashboard para evitar lentidão quando o volume de serviços cadastrados for muito alto.

**Controle de Níveis de Acesso**: Criar a distinção entre "Usuário Padrão" (só vê seus próprios serviços) e "Administrador" (vê e gerencia os serviços de todos).

**Recuperação de Senha**: Implementar um fluxo de "Esqueci minha senha" disparando um token de recuperação via e-mail.

**Relatórios **: Adicionar botões para exportar a tabela de serviços filtrada para PDF ou Excel.

**Gráficos Visuais**: Exibir a evolução das comissões e dos serviços finalizados ao longo do mês.

**Perfil do Usuário**: Criar uma tela onde o usuário possa alterar seu nome, e-mail, senha e foto de perfil.