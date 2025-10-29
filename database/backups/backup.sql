--
-- PostgreSQL database dump
--

\restrict eTLm2oTMeaaGofqJfCiOdO6voH8tBRphaqIPz98xgpgJFfWb7zj8HBAPpvZYYe2

-- Dumped from database version 17.6
-- Dumped by pg_dump version 17.6

-- Started on 2025-10-28 23:31:05

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.prtut DROP CONSTRAINT prtut_rut_supervisor_fkey;
ALTER TABLE ONLY public.prtut DROP CONSTRAINT prtut_rut_empresa_fkey;
ALTER TABLE ONLY public.prtut DROP CONSTRAINT prtut_id_habilitacion_fkey;
ALTER TABLE ONLY public.prinv DROP CONSTRAINT prinv_id_habilitacion_fkey;
ALTER TABLE ONLY public.pring DROP CONSTRAINT pring_id_habilitacion_fkey;
ALTER TABLE ONLY public.habilitacion_profesional DROP CONSTRAINT habilitacion_profesional_rut_alumno_fkey;
ALTER TABLE ONLY public.asigna DROP CONSTRAINT fk_asigna_profesor;
ALTER TABLE ONLY public.asigna DROP CONSTRAINT fk_asigna_habilitacion;
ALTER TABLE ONLY public.supervisor DROP CONSTRAINT supervisor_pkey;
ALTER TABLE ONLY public.prtut DROP CONSTRAINT prtut_pkey;
ALTER TABLE ONLY public.profesor DROP CONSTRAINT profesor_pkey;
ALTER TABLE ONLY public.prinv DROP CONSTRAINT prinv_pkey;
ALTER TABLE ONLY public.pring DROP CONSTRAINT pring_pkey;
ALTER TABLE ONLY public.habilitacion_profesional DROP CONSTRAINT habilitacion_profesional_pkey;
ALTER TABLE ONLY public.empresa DROP CONSTRAINT empresa_pkey;
ALTER TABLE ONLY public.autentificacion_de_usuarios DROP CONSTRAINT autentificacion_de_usuarios_pkey;
ALTER TABLE ONLY public.asigna DROP CONSTRAINT asigna_pkey;
ALTER TABLE ONLY public.alumno DROP CONSTRAINT alumno_pkey;
DROP TABLE public.supervisor;
DROP TABLE public.prtut;
DROP TABLE public.profesor;
DROP TABLE public.prinv;
DROP TABLE public.pring;
DROP TABLE public.habilitacion_profesional;
DROP TABLE public.empresa;
DROP TABLE public.autentificacion_de_usuarios;
DROP TABLE public.asigna;
DROP TABLE public.alumno;
DROP TYPE public.tipo_rol;
DROP SCHEMA public;
--
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 4972 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 855 (class 1247 OID 42084)
-- Name: tipo_rol; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.tipo_rol AS ENUM (
    'Profesor_Guia',
    'Profesor_Co_Guia',
    'Profesor_Comison',
    'Profesor_Tutor'
);


ALTER TYPE public.tipo_rol OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 217 (class 1259 OID 42427)
-- Name: alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumno (
    rut_alumno bigint NOT NULL,
    nombre_alumno character varying(100),
    correo_alumno character varying(255)
);


ALTER TABLE public.alumno OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 42539)
-- Name: asigna; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.asigna (
    id_habilitacion character varying(20) NOT NULL,
    rut_profesor bigint NOT NULL,
    rol public.tipo_rol
);


ALTER TABLE public.asigna OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 42528)
-- Name: autentificacion_de_usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.autentificacion_de_usuarios (
    rut_profesor bigint NOT NULL,
    "contraseña" character varying(100),
    correo_profesor character varying(255)
);


ALTER TABLE public.autentificacion_de_usuarios OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 42437)
-- Name: empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.empresa (
    rut_empresa bigint NOT NULL,
    nombre_empresa character varying(100)
);


ALTER TABLE public.empresa OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 42452)
-- Name: habilitacion_profesional; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.habilitacion_profesional (
    id_habilitacion character varying(20) GENERATED ALWAYS AS ((((((rut_alumno)::text || '_'::text) || ("año_semestre")::text) || '-'::text) || (numero_semestre)::text)) STORED NOT NULL,
    rut_alumno bigint,
    "año_semestre" integer,
    numero_semestre integer,
    descripcion_habilitacion character varying(500),
    nota_final numeric(3,2),
    fecha_nota date,
    CONSTRAINT "habilitacion_profesional_año_semestre_check" CHECK ((("año_semestre" >= 2025) AND ("año_semestre" <= 2050))),
    CONSTRAINT habilitacion_profesional_nota_final_check CHECK (((nota_final >= 1.00) AND (nota_final <= 7.00))),
    CONSTRAINT habilitacion_profesional_numero_semestre_check CHECK ((numero_semestre = ANY (ARRAY[1, 2])))
);


ALTER TABLE public.habilitacion_profesional OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 42468)
-- Name: pring; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pring (
    id_habilitacion character varying(20) NOT NULL,
    titulo_proy character varying(500)
);


ALTER TABLE public.pring OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 42480)
-- Name: prinv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prinv (
    id_habilitacion character varying(20) NOT NULL,
    titulo_proy character varying(500)
);


ALTER TABLE public.prinv OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 42432)
-- Name: profesor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profesor (
    rut_profesor bigint NOT NULL,
    nombre_profesor character varying(100)
);


ALTER TABLE public.profesor OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 42492)
-- Name: prtut; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.prtut (
    id_habilitacion character varying(20) NOT NULL,
    rut_empresa bigint,
    rut_supervisor bigint
);


ALTER TABLE public.prtut OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 42442)
-- Name: supervisor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.supervisor (
    rut_supervisor bigint NOT NULL,
    nombre_supervisor character varying(100),
    rut_empresa bigint
);


ALTER TABLE public.supervisor OWNER TO postgres;

--
-- TOC entry 4957 (class 0 OID 42427)
-- Dependencies: 217
-- Data for Name: alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.alumno VALUES (21472631, 'Nicolas Alvarado', 'nalvarado@ing.ucsc.cl');
INSERT INTO public.alumno VALUES (21598739, 'Pablo Peña', 'ppenaj@ing.ucsc.cl');


--
-- TOC entry 4966 (class 0 OID 42539)
-- Dependencies: 226
-- Data for Name: asigna; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4965 (class 0 OID 42528)
-- Dependencies: 225
-- Data for Name: autentificacion_de_usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4959 (class 0 OID 42437)
-- Dependencies: 219
-- Data for Name: empresa; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4961 (class 0 OID 42452)
-- Dependencies: 221
-- Data for Name: habilitacion_profesional; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.habilitacion_profesional VALUES (DEFAULT, 21472631, 2025, 1, 'AAAAADJFKDFG', NULL, NULL);
INSERT INTO public.habilitacion_profesional VALUES (DEFAULT, 21598739, 2025, 1, 'lskdjgskldfgjskfg', NULL, NULL);


--
-- TOC entry 4962 (class 0 OID 42468)
-- Dependencies: 222
-- Data for Name: pring; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.pring VALUES ('21472631_2025-1', 'a');


--
-- TOC entry 4963 (class 0 OID 42480)
-- Dependencies: 223
-- Data for Name: prinv; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4958 (class 0 OID 42432)
-- Dependencies: 218
-- Data for Name: profesor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4964 (class 0 OID 42492)
-- Dependencies: 224
-- Data for Name: prtut; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4960 (class 0 OID 42442)
-- Dependencies: 220
-- Data for Name: supervisor; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4785 (class 2606 OID 42431)
-- Name: alumno alumno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno
    ADD CONSTRAINT alumno_pkey PRIMARY KEY (rut_alumno);


--
-- TOC entry 4803 (class 2606 OID 42543)
-- Name: asigna asigna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asigna
    ADD CONSTRAINT asigna_pkey PRIMARY KEY (id_habilitacion, rut_profesor);


--
-- TOC entry 4801 (class 2606 OID 42532)
-- Name: autentificacion_de_usuarios autentificacion_de_usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.autentificacion_de_usuarios
    ADD CONSTRAINT autentificacion_de_usuarios_pkey PRIMARY KEY (rut_profesor);


--
-- TOC entry 4789 (class 2606 OID 42441)
-- Name: empresa empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY (rut_empresa);


--
-- TOC entry 4793 (class 2606 OID 42462)
-- Name: habilitacion_profesional habilitacion_profesional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.habilitacion_profesional
    ADD CONSTRAINT habilitacion_profesional_pkey PRIMARY KEY (id_habilitacion);


--
-- TOC entry 4795 (class 2606 OID 42474)
-- Name: pring pring_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pring
    ADD CONSTRAINT pring_pkey PRIMARY KEY (id_habilitacion);


--
-- TOC entry 4797 (class 2606 OID 42486)
-- Name: prinv prinv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prinv
    ADD CONSTRAINT prinv_pkey PRIMARY KEY (id_habilitacion);


--
-- TOC entry 4787 (class 2606 OID 42436)
-- Name: profesor profesor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profesor
    ADD CONSTRAINT profesor_pkey PRIMARY KEY (rut_profesor);


--
-- TOC entry 4799 (class 2606 OID 42496)
-- Name: prtut prtut_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prtut
    ADD CONSTRAINT prtut_pkey PRIMARY KEY (id_habilitacion);


--
-- TOC entry 4791 (class 2606 OID 42446)
-- Name: supervisor supervisor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.supervisor
    ADD CONSTRAINT supervisor_pkey PRIMARY KEY (rut_supervisor);


--
-- TOC entry 4810 (class 2606 OID 42544)
-- Name: asigna fk_asigna_habilitacion; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asigna
    ADD CONSTRAINT fk_asigna_habilitacion FOREIGN KEY (id_habilitacion) REFERENCES public.habilitacion_profesional(id_habilitacion);


--
-- TOC entry 4811 (class 2606 OID 42549)
-- Name: asigna fk_asigna_profesor; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.asigna
    ADD CONSTRAINT fk_asigna_profesor FOREIGN KEY (rut_profesor) REFERENCES public.profesor(rut_profesor);


--
-- TOC entry 4804 (class 2606 OID 42463)
-- Name: habilitacion_profesional habilitacion_profesional_rut_alumno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.habilitacion_profesional
    ADD CONSTRAINT habilitacion_profesional_rut_alumno_fkey FOREIGN KEY (rut_alumno) REFERENCES public.alumno(rut_alumno);


--
-- TOC entry 4805 (class 2606 OID 42475)
-- Name: pring pring_id_habilitacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pring
    ADD CONSTRAINT pring_id_habilitacion_fkey FOREIGN KEY (id_habilitacion) REFERENCES public.habilitacion_profesional(id_habilitacion);


--
-- TOC entry 4806 (class 2606 OID 42487)
-- Name: prinv prinv_id_habilitacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prinv
    ADD CONSTRAINT prinv_id_habilitacion_fkey FOREIGN KEY (id_habilitacion) REFERENCES public.habilitacion_profesional(id_habilitacion);


--
-- TOC entry 4807 (class 2606 OID 42497)
-- Name: prtut prtut_id_habilitacion_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prtut
    ADD CONSTRAINT prtut_id_habilitacion_fkey FOREIGN KEY (id_habilitacion) REFERENCES public.habilitacion_profesional(id_habilitacion);


--
-- TOC entry 4808 (class 2606 OID 42502)
-- Name: prtut prtut_rut_empresa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prtut
    ADD CONSTRAINT prtut_rut_empresa_fkey FOREIGN KEY (rut_empresa) REFERENCES public.empresa(rut_empresa);


--
-- TOC entry 4809 (class 2606 OID 42507)
-- Name: prtut prtut_rut_supervisor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.prtut
    ADD CONSTRAINT prtut_rut_supervisor_fkey FOREIGN KEY (rut_supervisor) REFERENCES public.supervisor(rut_supervisor);


-- Completed on 2025-10-28 23:31:06

--
-- PostgreSQL database dump complete
--

\unrestrict eTLm2oTMeaaGofqJfCiOdO6voH8tBRphaqIPz98xgpgJFfWb7zj8HBAPpvZYYe2

