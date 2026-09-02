# Sistema de Ordem de Serviços - JM Informática

Este é o repositório do Sistema de Ordem de Serviços da **JM Informática**, desenvolvido em **PHP** e **MySQL**. O sistema permite que o gestor gerencie os serviços prestados pelos funcionários, visualizando métricas, calculando comissões e acompanhando o status das demandas.

Abaixo está a lista de tarefas baseada nos requisitos levantados no projeto agrupadas por requisitos funcionais (RF), requisitos não funcionais (RNF) e regras de negócios (RN):

## 📋 Requisitos Funcionais (RF)
- [x] **RF01** - **Autenticação**: Tela de login deve validar e-mail e senha: redireciona para o Dashboard se houver sucesso ou exibe mensagem "Ops, Email ou Senha inválido" se falhar.
- [x] **RF02** - **Dashboard**: Deve exibir dados do usuário logado e data atual.
- [ ] **RF03** - **Dashboard**: Deve exibir tabela de serviços prestados pelos funcionários contendo as colunas ID, Descrição, Status, Valor e Nome do Usuário.
- [x] **RF04** - **Dashboard**: Deve exibir coluna **Ações** na tabela com botões para **Excluir**, **Alterar** e **Finalizar** o registro do serviço.
- [ ] **RF05** - **Dashboard (Serviços Finalizados)**: Deve exibir de forma destacada uma pequena lista com os últimos serviços com status **"Finalizado"** e o **Valor Total** dos serviços prestados pelo usuário logado.
- [ ] **RF06** - **Dashboard (Serviços Pendentes)**: Deve exibir de forma destacada uma pequena lista com os últimos serviços com status **"Pendente"**.
- [ ] **RF07** - **Finalizar Serviço**: Ao clicar em finalizar, o sistema deve gravar a data de finalização, calcular a comissão gerada e disparar um e-mail para o usuário que realizou o serviço.
- [ ] **RF08** - **Filtros**: Deve permitir buscar serviços na tabela por **Período** (informando data inicial e/ou final).
- [ ] **RF09** - **Filtros**: Deve permitir buscar serviços na tabela pelo **Nome do serviço**.
- [ ] **RF10** - **Filtros**: Deve permitir buscar serviços na tabela por **Status**.
- [ ] **RF11** - **Filtros**: Deve permitir buscar serviços na tabela pelo **Nome do usuário**.
- [ ] **RF12** - **Adicionar Serviço**: Botão deve permitir abrir uma nova tela com formulário para cadastro de novos serviços contendo os campos necessários.
- [ ] **RF13** - **Adicionar Serviço**: Caso sucesso ao preencher (Descrição e Valor), deve salvar registro com mensagem de sucesso e redirecionar para tela inicial.
- [ ] **RF14** - **Adicionar Serviço**: Caso falha (falta de dados obrigatórios ou erro), deve barrar o cadastro, exibir mensagem de falha e redirecionar para a tela inicial.

## 💼 Regras de Negócio (RN)
- [ ] **RN01** - **Status do Serviço**: O sistema deve definir o status baseado na data de finalização: Serviços sem data de finalização deve ser igual a "Pendente" e serviços com data de finalização deve ser igual a "Finalizado".
- [ ] **RN02** - **Auto-atribuição**: Novos serviços cadastrados devem ser vinculados e pertencer automaticamente ao usuário que está logado no momento.
- [ ] **RN03** - **Status Inicial**: Todo novo serviço deve ser cadastrado obrigatoriamente com o status de "Pendente".
- [ ] **RN04** - **Campos Obrigatórios**: O cadastro deve ser efetuado apenas se "Descrição do serviço" e "Valor" estiverem preenchidos.
- [ ] **RN05** - **Comissão Faixa 1**: Para serviços com valor menor ou igual a R$ 1.000,00, a comissão gerada deve ser de **5%**.
- [ ] **RN06** - **Comissão Faixa 2**: Para serviços com valor maior que R$ 1.000,00 e até R$ 10.000,00, a comissão gerada deve ser de **10%**. *(Obs: limite superior inferido para não causar conflito com a Faixa 3)*.
- [ ] **RN07** - **Comissão Faixa 3**: Para serviços com valor maior que R$ 10.000,00, a comissão gerada deve ser de **20%**.

## 🛠️ Requisitos Não Funcionais (RNF)
- [x] **RNF01** - **Linguagem de Programação**: O sistema deve ser implementado na linguagem PHP.
- [x] **RNF02** - **Banco de Dados**: O sistema deve utilizar MySQL para gerenciar e salvar o banco de dados.
- [ ] **RNF03** - **Envio de Emails**: O sistema deve ter um serviço de SMTP ou biblioteca configurada em PHP para envio dos e-mails de finalização (ex: PHPMailer).
- [x] **RNF04** - **Interface (UI)**: A tela de Dashboard deve possuir elementos visuais que consigam destacar corretamente as seções de valor total financeiro e lista de serviços pendentes.