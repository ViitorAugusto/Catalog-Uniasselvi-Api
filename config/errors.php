<?php

return [
    'codes' => [
        'AUTH_UNAUTHORIZED' => 1001,
        'AUTH_INVALID_CREDENTIALS' => 1002,
        'AUTH_ACCOUNT_LOCKED' => 1003,
        'AUTH_ACCOUNT_NOT_VERIFIED' => 1004,
        'AUTH_ACCOUNT_NOT_VERIFIED_BY_ADMIN' => 1005,
        'AUTH_TOKEN_REQUIRED' => 1006,
        'AUTH_TOKEN_INVALID' => 1007,
        'AUTH_WHITELIST_REQUIRED' => 1008,
        'REG_EMAIL_TAKEN' => 2001,
        'REG_USERNAME_TAKEN' => 2002,
        'REG_INVALID_DATA' => 2003,
        'REG_CPF_TAKEN' => 2004,
        'REG_CNPJ_TAKEN' => 2004,
        'USER_NOT_FOUND' => 3001,
        'USER_UPDATE_FAILED' => 3002,
        'VALIDATION_REQUIRED_EMAIL' => 3101,
        'VALIDATION_INVALID_EMAIL_FORMAT' => 3102,
        'VALIDATION_REQUIRED_PASSWORD' => 3103,
        'VALIDATION_PASSWORD_MIN_LENGTH' => 3104,
        'VALIDATION_REQUIRED_USERNAME' => 3105,
        'VALIDATION_USERNAME_MIN_LENGTH' => 3106,
        'VALIDATION_USERNAME_TAKEN' => 3107,
        'VALIDATION_REQUIRED_RESET_PASSWORD_TOKEN' => 3108,
        'VALIDATION_INVALID_RESET_PASSWORD_TOKEN' => 3109,
        'VALIDATION_INVALID_PASSWORD_FORMAT' => 3110,
        'VALIDATION_REQUIRED_FIELD' => 3111,
        'VALIDATION_INVALID_FIELD' => 3112,
        'SYS_DATABASE_ERROR' => 4001,
        'SYS_INTERNAL_ERROR' => 4002,
        'SYS_EXTERNAL_ERROR' => 4003,
        'INVALID_ACTION' => 5001
    ],
    'messages' => [
        1001 => 'O usuário não está autorizado, geralmente devido à falta de um token válido.',
        1002 => 'Credenciais fornecidas (geralmente e-mail/senha) são inválidas.',
        1003 => 'A conta do usuário foi bloqueada devido a tentativas de login falhadas.',
        1004 => 'A conta do usuário ainda não foi verificada. Cadastro incompleto.',
        1005 => 'A conta do usuário ainda não foi verificada por um administrador.',
        1006 => 'Um token de autenticação é necessário para esta operação.',
        1007 => 'O token de autenticação fornecido é inválido.',
        1008 => 'O usuário não está cadastrado na whitelist.',
        2001 => 'O e-mail fornecido já está em uso.',
        2002 => 'O nome de usuário fornecido já está em uso.',
        2003 => 'Dados fornecidos durante o registro são inválidos ou incompletos.',
        2004 => 'CPF já está cadastrado.',
        2005 => 'CNPJ já está cadastrado.',
        3001 => 'O usuário solicitado não foi encontrado no sistema.',
        3002 => 'A tentativa de atualizar os detalhes do usuário falhou.',
        3101 => 'E-mail é um campo obrigatório e não foi fornecido.',
        3102 => 'O e-mail fornecido não tem um formato válido.',
        3103 => 'Senha é um campo obrigatório e não foi fornecida.',
        3104 => 'A senha fornecida não atende ao comprimento mínimo requerido.',
        3105 => 'Nome de usuário é um campo obrigatório e não foi fornecido.',
        3106 => 'O nome de usuário fornecido não atende ao comprimento mínimo requerido.',
        3107 => 'O nome de usuário fornecido já está em uso.',
        3108 => 'Token de redefinição de senha é um campo obrigatório e não foi fornecido.',
        3109 => 'Token de redefinição de senha fornecido é inválido.',
        3110 => 'A senha fornecida não pode ser igual ao CPF e nem ter menos de 8 caracteres.',
        3111 => 'O campo é obrigatório.',
        3112 => 'O valor informado no campo é inválido.',
        4001 => 'Erro geral do banco de dados.',
        4002 => 'Erro interno do sistema.',
        4003 => 'Erro em alguma plataforma externa.',
        5001 => 'Ação inválida.'
    ]
];
