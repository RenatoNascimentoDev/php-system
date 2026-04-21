# PHP System

Sistema web para gestão de pedidos e transportadoras de uma loja de informática, com foco em controle operacional, visão gerencial e integração por API.

A aplicação permite cadastrar, consultar, editar e remover pedidos e transportadoras, acompanhar indicadores do negócio no dashboard, exportar pedidos em CSV e consumir dados por meio de uma API documentada.

## Visão Geral

O PHP System foi desenvolvido para centralizar a operação comercial de uma loja de informática, organizando o fluxo de pedidos e o relacionamento com transportadoras responsáveis pela entrega.

O sistema oferece uma interface administrativa simples e objetiva, baseada em AdminLTE, além de recursos que apoiam tanto o uso interno da equipe quanto integrações futuras com outros sistemas por meio de API.

## Principais Módulos

- Dashboard
- Pedidos
- Transportadoras
- API de pedidos
- Documentação da API

## Requisitos Funcionais

### Dashboard
- Exibir o total de pedidos cadastrados.
- Exibir o total vendido em reais.
- Apresentar os indicadores principais da operação de forma visual.

### Pedidos
- Permitir cadastrar pedidos.
- Permitir listar pedidos.
- Permitir editar pedidos existentes.
- Permitir excluir pedidos.
- Permitir buscar pedidos por nome do cliente.
- Permitir paginação de 10 registros por página.
- Permitir exportar os pedidos em arquivo CSV.
- Calcular automaticamente o valor total do pedido com base em preço e quantidade.

### Transportadoras
- Permitir cadastrar transportadoras.
- Permitir listar transportadoras.
- Permitir editar transportadoras existentes.
- Permitir excluir transportadoras.
- Permitir preenchimento automático de endereço a partir do CEP.
- Consultar dados de endereço utilizando a API ViaCEP.

### API
- Disponibilizar endpoint para listar pedidos.
- Disponibilizar endpoint para consultar um pedido por ID.
- Disponibilizar endpoint para cadastrar novos pedidos.
- Disponibilizar documentação navegável da API.

## Requisitos Não Funcionais

- Interface administrativa baseada em AdminLTE.
- Aplicação desenvolvida com PHP e Laravel.
- Persistência de dados em banco relacional.
- Paginação com navegação consistente na interface.
- Respostas da API em JSON.
- Documentação OpenAPI gerada automaticamente.
- Estrutura organizada para evolução futura da aplicação.
- Código preparado para manutenção e expansão de funcionalidades.

## Regras de Negócio

- O total do pedido deve ser calculado automaticamente com base em `preço x quantidade`.
- O preço do pedido não pode ser negativo.
- A quantidade do pedido deve ser no mínimo 1.
- O nome do cliente é obrigatório no cadastro do pedido.
- A descrição do pedido é obrigatória.
- O produto do pedido é obrigatório.
- O cadastro de transportadora exige nome, CNPJ e endereço.
- O CNPJ da transportadora deve ser único.
- O CEP deve ser utilizado para apoiar o preenchimento automático do endereço.
- O estado da transportadora deve ser armazenado com sigla de 2 caracteres.
- A listagem de pedidos deve manter paginação de 10 itens por página.
- A exportação CSV deve considerar os pedidos cadastrados no sistema.

## Tecnologias Utilizadas

- PHP 8
- Laravel
- MySQL
- AdminLTE
- JavaScript
- ViaCEP
- Scramble
- Scalar

## API e Documentação

A aplicação possui uma API para consumo dos dados de pedidos.

### Endpoints disponíveis
- `GET /api/orders`
- `GET /api/orders/{order}`
- `POST /api/orders`

### Documentação
- `GET /docs/api`
- `GET /docs/api.json`
- `GET /scalar`

## Funcionalidades Já Implementadas

- Dashboard com total de pedidos.
- Dashboard com total vendido.
- CRUD de pedidos.
- Busca de pedidos por nome do cliente.
- Paginação de pedidos com 10 registros por página.
- Exportação de pedidos em CSV.
- CRUD de transportadoras.
- Integração com ViaCEP para preenchimento automático de endereço.
- Campo de CEP com máscara e busca manual por ícone de pesquisa.
- API para listagem, consulta por ID e criação de pedidos.
- Documentação automática da API com Scramble.
- Visualização moderna da referência da API com Scalar.
- Seeders e factories para geração de dados fictícios.

## Melhorias Planejadas

- Exibir o total do pedido de forma automática também no formulário, em tempo real.
- Padronizar a experiência de busca por CEP também na edição de transportadoras.
- Criar páginas de visualização detalhada para pedidos e transportadoras.
- Adicionar autenticação e controle de acesso ao painel administrativo.
- Adicionar filtros mais avançados para pedidos e transportadoras.
- Criar testes automatizados para fluxos críticos da aplicação.
- Melhorar mensagens de feedback e validação para o usuário final.
- Evoluir a API com versionamento e recursos adicionais.
- Preparar o sistema para integração com novos módulos operacionais.

## Estrutura do Sistema

### Dashboard
Painel inicial com visão consolidada da operação, exibindo indicadores principais do negócio.

### Pedidos
Módulo responsável por gerenciar os pedidos da loja, desde o cadastro até a exportação dos dados.

### Transportadoras
Módulo responsável pelo cadastro e manutenção das transportadoras, incluindo preenchimento automático de endereço via CEP.

### API
Camada de integração para consumo externo dos pedidos, com documentação gerada automaticamente.

## Objetivo do Sistema

O PHP System foi pensado para apoiar a operação de uma loja de informática de forma simples, clara e escalável, centralizando o controle de pedidos, transportadoras e indicadores de negócio em um único ambiente.

A proposta do sistema é reduzir retrabalho, organizar informações operacionais e facilitar tanto o uso interno quanto futuras integrações com outros serviços.
