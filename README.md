# Sicredi-Api

Arquivo PHP único com funções de integração à API de Cobrança Online do Sicredi (boleto): `solicitaToken`, `registraBoleto`, `alteraBoleto`, `segundaVia`, `monitoraTitulo`, `testeConexao`.

> **Projeto legado, mantido só como referência.** Sem manutenção nem deploy; não usar como base de código novo sem revisão.

## Status

**Legado.** Único commit em 28/10/2019.

## Stack

- PHP + cURL

## Estrutura

- `sicredi_api.php`

## Como rodar

Incluir o arquivo e chamar as funções passando a chave master do Sicredi. Não mantido: a API do Sicredi pode ter mudado.

## Configuração

A chave é passada por parâmetro (`$chave_master`), não há variável de ambiente.

## Branches

Default atual: `master` · proposta: `main`. Comparação ahead/behind contra a default atual (`master`), estado de 30/10/2026.

| Branch | Último commit | Ahead | Behind | Mergeada na default | Sugestão |
|---|---|---|---|---|---|
| `master` ★ | 2019-10-28 | 0 | 0 | sim | manter |

## Origem

Importado do GitHub [`lucas-freitas00/Sicredi-Api`](https://github.com/lucas-freitas00/Sicredi-Api) em 30/10/2026 para o GitLab self-hosted ([`legado/Sicredi-Api`](https://gitlab.194-163-171-140.sslip.io/legado/Sicredi-Api), projeto id 54), com todas as branches, tags e MRs/PRs. A partir da migração o GitLab é a origem; o GitHub passa a ser espelho somente-leitura (não fazer push direto lá).
