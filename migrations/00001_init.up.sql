BEGIN;

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = ON;
SET check_function_bodies = FALSE;
SET client_min_messages = WARNING;
SET search_path = public, extensions;
SET default_tablespace = '';
SET default_with_oids = FALSE;

-- EXTENSIONS --

CREATE EXTENSION IF NOT EXISTS pgcrypto;

-- TABLES --

CREATE TABLE public.user
(
    id     INT PRIMARY KEY,
    uuid   UUID UNIQUE,
    is_registered BOOLEAN NOT NULL,
    username TEXT,
    first_name TEXT,
    last_name TEXT,
    is_bot BOOLEAN NOT NULL,
    language_code TEXT
);

CREATE TABLE public.auth_history
(
    id            SERIAL PRIMARY KEY,
    user_id   INT REFERENCES public.user (id),
    last_auth_at    TIMESTAMPTZ,
    created_at    TIMESTAMPTZ
);

COMMIT;
