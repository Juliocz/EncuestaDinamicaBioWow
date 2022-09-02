--
-- PostgreSQL database dump
--

-- Dumped from database version 10.22
-- Dumped by pg_dump version 14.2

-- Started on 2022-09-02 09:32:22

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 3 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO postgres;

--
-- TOC entry 2864 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'standard public schema';


SET default_tablespace = '';

--
-- TOC entry 196 (class 1259 OID 16394)
-- Name: encuesta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.encuesta (
    id_usuario integer,
    idencuesta integer NOT NULL,
    nombre_enc character varying,
    idun integer NOT NULL,
    estado integer DEFAULT 0 NOT NULL,
    creado timestamp without time zone DEFAULT now() NOT NULL,
    modificado timestamp without time zone DEFAULT now() NOT NULL,
    idencuesta_asign integer
);


ALTER TABLE public.encuesta OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16403)
-- Name: encuesta_idencuesta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.encuesta_idencuesta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.encuesta_idencuesta_seq OWNER TO postgres;

--
-- TOC entry 2865 (class 0 OID 0)
-- Dependencies: 197
-- Name: encuesta_idencuesta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.encuesta_idencuesta_seq OWNED BY public.encuesta.idencuesta;


--
-- TOC entry 198 (class 1259 OID 16405)
-- Name: opcion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.opcion (
    idopcion integer NOT NULL,
    idpregunta integer NOT NULL,
    descripcion character varying,
    orden integer DEFAULT 0 NOT NULL,
    estado integer DEFAULT 0 NOT NULL,
    url_iconr character varying,
    url_iconanimr character varying,
    creado timestamp without time zone DEFAULT now() NOT NULL,
    modificado timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.opcion OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16415)
-- Name: opcion_idopcion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.opcion_idopcion_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.opcion_idopcion_seq OWNER TO postgres;

--
-- TOC entry 2866 (class 0 OID 0)
-- Dependencies: 199
-- Name: opcion_idopcion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.opcion_idopcion_seq OWNED BY public.opcion.idopcion;


--
-- TOC entry 200 (class 1259 OID 16417)
-- Name: pregunta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pregunta (
    idpregunta integer NOT NULL,
    idencuesta integer NOT NULL,
    pregunta character varying,
    estado integer DEFAULT 0 NOT NULL,
    tipo character varying,
    creado timestamp without time zone DEFAULT now() NOT NULL,
    modificado timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.pregunta OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16426)
-- Name: pregunta_idpregunta_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.pregunta_idpregunta_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.pregunta_idpregunta_seq OWNER TO postgres;

--
-- TOC entry 2867 (class 0 OID 0)
-- Dependencies: 201
-- Name: pregunta_idpregunta_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.pregunta_idpregunta_seq OWNED BY public.pregunta.idpregunta;


--
-- TOC entry 202 (class 1259 OID 16428)
-- Name: respuesta; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.respuesta (
    idresp integer NOT NULL,
    idencuesta integer NOT NULL,
    idpregunta integer NOT NULL,
    idopcion integer NOT NULL,
    creado timestamp without time zone DEFAULT now() NOT NULL,
    modificado timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.respuesta OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16433)
-- Name: respuesta_idresp_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.respuesta_idresp_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.respuesta_idresp_seq OWNER TO postgres;

--
-- TOC entry 2868 (class 0 OID 0)
-- Dependencies: 203
-- Name: respuesta_idresp_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.respuesta_idresp_seq OWNED BY public.respuesta.idresp;


--
-- TOC entry 204 (class 1259 OID 16435)
-- Name: un_negocio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.un_negocio (
    idun integer NOT NULL,
    nombre character varying,
    direccion character varying,
    telefono integer,
    estado integer DEFAULT 0 NOT NULL,
    codigo character varying(32),
    creado timestamp without time zone DEFAULT now() NOT NULL,
    modificado timestamp without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.un_negocio OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16444)
-- Name: un_negocio_idun_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.un_negocio_idun_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.un_negocio_idun_seq OWNER TO postgres;

--
-- TOC entry 2869 (class 0 OID 0)
-- Dependencies: 205
-- Name: un_negocio_idun_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.un_negocio_idun_seq OWNED BY public.un_negocio.idun;


--
-- TOC entry 2701 (class 2604 OID 29713)
-- Name: encuesta idencuesta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.encuesta ALTER COLUMN idencuesta SET DEFAULT nextval('public.encuesta_idencuesta_seq'::regclass);


--
-- TOC entry 2706 (class 2604 OID 29714)
-- Name: opcion idopcion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opcion ALTER COLUMN idopcion SET DEFAULT nextval('public.opcion_idopcion_seq'::regclass);


--
-- TOC entry 2710 (class 2604 OID 29715)
-- Name: pregunta idpregunta; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregunta ALTER COLUMN idpregunta SET DEFAULT nextval('public.pregunta_idpregunta_seq'::regclass);


--
-- TOC entry 2713 (class 2604 OID 29716)
-- Name: respuesta idresp; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respuesta ALTER COLUMN idresp SET DEFAULT nextval('public.respuesta_idresp_seq'::regclass);


--
-- TOC entry 2717 (class 2604 OID 29717)
-- Name: un_negocio idun; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.un_negocio ALTER COLUMN idun SET DEFAULT nextval('public.un_negocio_idun_seq'::regclass);


--
-- TOC entry 2849 (class 0 OID 16394)
-- Dependencies: 196
-- Data for Name: encuesta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.encuesta (id_usuario, idencuesta, nombre_enc, idun, estado, creado, modificado, idencuesta_asign) FROM stdin;
642	65	SATISFACCION DEL CLIENTE	1	0	2022-09-01 10:29:46.017112	2022-09-01 10:29:46.017112	\N
\N	71	SATISFACCION DEL CLIENTE	315	1	2022-09-01 10:42:13.979976	2022-09-01 10:42:13.979976	65
\N	72	SATISFACCION DEL CLIENTE	120	1	2022-09-01 10:42:41.264976	2022-09-01 10:42:41.264976	65
\N	21	Captacion de cliente	1	0	2022-08-22 08:26:30.034709	2022-08-22 08:26:30.034709	\N
\.


--
-- TOC entry 2851 (class 0 OID 16405)
-- Dependencies: 198
-- Data for Name: opcion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.opcion (idopcion, idpregunta, descripcion, orden, estado, url_iconr, url_iconanimr, creado, modificado) FROM stdin;
174	80	No me gusta	1	0	res/IMG/bad-feedback.png		2022-09-01 10:42:41.268982	2022-09-01 10:42:41.268982
175	80	Me gusta	2	0	res/IMG/good.png	res/IMG/899-like.json	2022-09-01 10:42:41.270672	2022-09-01 10:42:41.270672
176	81	1 estrella	1	0	res/IMG/star1.png		2022-09-01 10:42:41.272381	2022-09-01 10:42:41.272381
177	81	2 estrella	2	0	res/IMG/star2.png		2022-09-01 10:42:41.27307	2022-09-01 10:42:41.27307
178	81	3 estrella	3	0	res/IMG/star3.png		2022-09-01 10:42:41.27378	2022-09-01 10:42:41.27378
179	81	4 estrella	4	0	res/IMG/star4.png		2022-09-01 10:42:41.274602	2022-09-01 10:42:41.274602
180	81	5 estrella	5	0	res/IMG/star5.png		2022-09-01 10:42:41.27585	2022-09-01 10:42:41.27585
181	82	Mala	1	0			2022-09-01 10:42:41.278451	2022-09-01 10:42:41.278451
182	82	Regular	2	0			2022-09-01 10:42:41.279812	2022-09-01 10:42:41.279812
183	82	Bien	3	0			2022-09-01 10:42:41.280702	2022-09-01 10:42:41.280702
184	82	Muy buena	4	0			2022-09-01 10:42:41.281453	2022-09-01 10:42:41.281453
19	7		1	0			2022-08-19 10:01:09.86542	2022-08-19 10:01:09.86542
20	7		2	0			2022-08-19 10:01:09.866602	2022-08-19 10:01:09.866602
21	7		3	0			2022-08-19 10:01:09.867671	2022-08-19 10:01:09.867671
22	8		1	0			2022-08-19 10:01:09.869014	2022-08-19 10:01:09.869014
23	8		2	0			2022-08-19 10:01:09.870038	2022-08-19 10:01:09.870038
24	9	Mal	1	0			2022-08-19 10:03:50.093616	2022-08-19 10:03:50.093616
25	9	Regular	2	0			2022-08-19 10:03:50.094589	2022-08-19 10:03:50.094589
26	9	Bien	3	0			2022-08-19 10:03:50.095198	2022-08-19 10:03:50.095198
27	10	Si	1	0			2022-08-19 10:03:50.096383	2022-08-19 10:03:50.096383
28	10	No	2	0			2022-08-19 10:03:50.09689	2022-08-19 10:03:50.09689
29	11	Si	1	0			2022-08-19 10:08:18.080545	2022-08-19 10:08:18.080545
30	11	No	2	0			2022-08-19 10:08:18.081356	2022-08-19 10:08:18.081356
31	12	Mal	1	0			2022-08-19 10:08:18.082619	2022-08-19 10:08:18.082619
32	12	Bien	2	0			2022-08-19 10:08:18.08316	2022-08-19 10:08:18.08316
33	13	Falso	1	0	res/IMG/decline.png		2022-08-22 08:26:30.045497	2022-08-22 08:26:30.045497
34	13	Verdadero	2	0	res/IMG/accept.png		2022-08-22 08:26:30.049393	2022-08-22 08:26:30.049393
35	14	Menos de 6 meses	1	0			2022-08-22 08:26:30.050553	2022-08-22 08:26:30.050553
36	14	6 meses a 1 año	2	0			2022-08-22 08:26:30.051121	2022-08-22 08:26:30.051121
37	14	1 año a 2 años	3	0			2022-08-22 08:26:30.051665	2022-08-22 08:26:30.051665
38	14	2 años a mas	4	0			2022-08-22 08:26:30.052604	2022-08-22 08:26:30.052604
185	82	Excelente	5	0			2022-09-01 10:42:41.282234	2022-09-01 10:42:41.282234
130	67	No me gusta	1	0	res/IMG/bad-feedback.png		2022-09-01 10:29:46.030499	2022-09-01 10:29:46.030499
131	67	Me gusta	2	0	res/IMG/good.png	res/IMG/899-like.json	2022-09-01 10:29:46.035027	2022-09-01 10:29:46.035027
132	68	1 estrella	1	0	res/IMG/star1.png		2022-09-01 10:29:46.038079	2022-09-01 10:29:46.038079
133	68	2 estrella	2	0	res/IMG/star2.png		2022-09-01 10:29:46.039354	2022-09-01 10:29:46.039354
134	68	3 estrella	3	0	res/IMG/star3.png		2022-09-01 10:29:46.040974	2022-09-01 10:29:46.040974
135	68	4 estrella	4	0	res/IMG/star4.png		2022-09-01 10:29:46.042994	2022-09-01 10:29:46.042994
136	68	5 estrella	5	0	res/IMG/star5.png		2022-09-01 10:29:46.044503	2022-09-01 10:29:46.044503
137	69	Mala	1	0			2022-09-01 10:29:46.047254	2022-09-01 10:29:46.047254
138	69	Regular	2	0			2022-09-01 10:29:46.048518	2022-09-01 10:29:46.048518
139	69	Bien	3	0			2022-09-01 10:29:46.049843	2022-09-01 10:29:46.049843
140	69	Muy buena	4	0			2022-09-01 10:29:46.051144	2022-09-01 10:29:46.051144
141	69	Excelente	5	0			2022-09-01 10:29:46.052923	2022-09-01 10:29:46.052923
162	77	No me gusta	1	0	res/IMG/bad-feedback.png		2022-09-01 10:42:13.990425	2022-09-01 10:42:13.990425
163	77	Me gusta	2	0	res/IMG/good.png	res/IMG/899-like.json	2022-09-01 10:42:13.992176	2022-09-01 10:42:13.992176
164	78	1 estrella	1	0	res/IMG/star1.png		2022-09-01 10:42:13.993649	2022-09-01 10:42:13.993649
165	78	2 estrella	2	0	res/IMG/star2.png		2022-09-01 10:42:13.994288	2022-09-01 10:42:13.994288
166	78	3 estrella	3	0	res/IMG/star3.png		2022-09-01 10:42:13.994953	2022-09-01 10:42:13.994953
167	78	4 estrella	4	0	res/IMG/star4.png		2022-09-01 10:42:13.995828	2022-09-01 10:42:13.995828
168	78	5 estrella	5	0	res/IMG/star5.png		2022-09-01 10:42:13.997297	2022-09-01 10:42:13.997297
169	79	Mala	1	0			2022-09-01 10:42:13.99922	2022-09-01 10:42:13.99922
170	79	Regular	2	0			2022-09-01 10:42:13.999921	2022-09-01 10:42:13.999921
171	79	Bien	3	0			2022-09-01 10:42:14.000553	2022-09-01 10:42:14.000553
172	79	Muy buena	4	0			2022-09-01 10:42:14.001289	2022-09-01 10:42:14.001289
173	79	Excelente	5	0			2022-09-01 10:42:14.003512	2022-09-01 10:42:14.003512
\.


--
-- TOC entry 2853 (class 0 OID 16417)
-- Dependencies: 200
-- Data for Name: pregunta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pregunta (idpregunta, idencuesta, pregunta, estado, tipo, creado, modificado) FROM stdin;
8	16	Encontraste lo que buscabas	0	check	2022-08-19 10:01:09.868227	2022-08-19 10:01:09.868227
10	17	Encontraste lo que buscabas	0	check	2022-08-19 10:03:50.095791	2022-08-19 10:03:50.095791
12	18	Como fue la atencion	0	check	2022-08-19 10:08:18.081954	2022-08-19 10:08:18.081954
13	21	¿Considera la atencion muy comoda?	0	click_t	2022-08-22 08:26:30.042298	2022-08-22 08:26:30.042298
14	21	¿Cuanto tiempo llevas haciendo nuestro servicio?	0	check	2022-08-22 08:26:30.049985	2022-08-22 08:26:30.049985
67	65	¿Que opinas de Biopetrol?	0	click	2022-09-01 10:29:46.025985	2022-09-01 10:29:46.025985
68	65	¿Califica la atencion de hoy?	0	click	2022-09-01 10:29:46.036198	2022-09-01 10:29:46.036198
69	65	¿Que opinas de la atencion de hoy?	0	check	2022-09-01 10:29:46.045929	2022-09-01 10:29:46.045929
77	71	¿Que opinas de Biopetrol?	0	click	2022-09-01 10:42:13.988673	2022-09-01 10:42:13.988673
78	71	¿Califica la atencion de hoy?	0	click	2022-09-01 10:42:13.992988	2022-09-01 10:42:13.992988
79	71	¿Que opinas de la atencion de hoy?	0	check	2022-09-01 10:42:13.998508	2022-09-01 10:42:13.998508
80	72	¿Que opinas de Biopetrol?	0	click	2022-09-01 10:42:41.268012	2022-09-01 10:42:41.268012
81	72	¿Califica la atencion de hoy?	0	click	2022-09-01 10:42:41.271612	2022-09-01 10:42:41.271612
82	72	¿Que opinas de la atencion de hoy?	0	check	2022-09-01 10:42:41.27743	2022-09-01 10:42:41.27743
\.


--
-- TOC entry 2855 (class 0 OID 16428)
-- Dependencies: 202
-- Data for Name: respuesta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.respuesta (idresp, idencuesta, idpregunta, idopcion, creado, modificado) FROM stdin;
1	1	1	1	2022-08-18 11:31:08.555246	2022-08-18 11:31:08.555246
2	1	2	6	2022-08-18 11:31:13.09652	2022-08-18 11:31:13.09652
3	1	3	9	2022-08-18 11:37:56.894283	2022-08-18 11:37:56.894283
4	2	4	15	2022-08-18 11:44:59.936322	2022-08-18 11:44:59.936322
5	1	1	1	2022-08-18 15:58:28.068727	2022-08-18 15:58:28.068727
6	1	2	7	2022-08-18 15:58:31.84665	2022-08-18 15:58:31.84665
7	1	3	9	2022-08-18 15:58:38.823598	2022-08-18 15:58:38.823598
8	1	1	1	2022-08-18 16:00:21.026784	2022-08-18 16:00:21.026784
9	1	2	7	2022-08-18 16:00:29.402961	2022-08-18 16:00:29.402961
10	1	3	9	2022-08-18 16:00:36.790706	2022-08-18 16:00:36.790706
11	1	1	1	2022-08-19 09:40:39.927984	2022-08-19 09:40:39.927984
12	1	2	7	2022-08-19 09:40:43.439154	2022-08-19 09:40:43.439154
13	1	1	1	2022-08-19 09:59:35.028855	2022-08-19 09:59:35.028855
14	1	2	5	2022-08-19 09:59:38.00122	2022-08-19 09:59:38.00122
15	1	3	10	2022-08-19 09:59:45.387912	2022-08-19 09:59:45.387912
16	17	9	25	2022-08-19 10:04:15.980663	2022-08-19 10:04:15.980663
17	17	10	28	2022-08-19 10:04:22.635472	2022-08-19 10:04:22.635472
18	18	11	29	2022-08-19 10:08:29.750407	2022-08-19 10:08:29.750407
19	18	12	32	2022-08-19 10:08:36.430584	2022-08-19 10:08:36.430584
20	18	11	29	2022-08-19 10:08:39.231675	2022-08-19 10:08:39.231675
21	18	12	32	2022-08-19 10:08:45.70916	2022-08-19 10:08:45.70916
22	18	11	29	2022-08-19 10:18:31.607727	2022-08-19 10:18:31.607727
23	18	12	32	2022-08-19 10:18:37.724631	2022-08-19 10:18:37.724631
24	1	1	1	2022-08-19 12:05:48.115003	2022-08-19 12:05:48.115003
25	1	2	7	2022-08-19 12:05:51.385353	2022-08-19 12:05:51.385353
26	1	3	9	2022-08-19 12:05:58.288275	2022-08-19 12:05:58.288275
27	1	1	1	2022-08-19 14:01:54.366837	2022-08-19 14:01:54.366837
28	1	2	7	2022-08-19 14:01:57.671473	2022-08-19 14:01:57.671473
29	1	1	1	2022-08-19 14:15:01.653793	2022-08-19 14:15:01.653793
30	1	2	7	2022-08-19 14:15:05.675408	2022-08-19 14:15:05.675408
31	1	1	1	2022-08-19 15:48:52.736507	2022-08-19 15:48:52.736507
32	1	2	7	2022-08-19 15:48:56.084848	2022-08-19 15:48:56.084848
33	21	13	34	2022-08-22 08:38:33.65014	2022-08-22 08:38:33.65014
34	21	13	34	2022-08-22 08:48:22.873106	2022-08-22 08:48:22.873106
35	24	21	62	2022-08-22 10:27:54.530768	2022-08-22 10:27:54.530768
36	24	22	66	2022-08-22 10:28:03.454038	2022-08-22 10:28:03.454038
68	24	21	62	2022-08-22 10:35:54.171735	2022-08-22 10:35:54.171735
69	24	22	65	2022-08-22 10:36:06.00052	2022-08-22 10:36:06.00052
70	1	1	1	2022-08-22 10:36:39.4017	2022-08-22 10:36:39.4017
71	1	2	7	2022-08-22 10:36:46.186574	2022-08-22 10:36:46.186574
72	1	3	8	2022-08-22 10:36:54.815907	2022-08-22 10:36:54.815907
73	57	54	95	2022-08-22 10:40:01.790712	2022-08-22 10:40:01.790712
74	63	63	119	2022-08-25 11:09:45.817882	2022-08-25 11:09:45.817882
75	63	63	118	2022-08-26 09:42:14.319048	2022-08-26 09:42:14.319048
76	1	1	1	2022-08-31 16:22:32.254387	2022-08-31 16:22:32.254387
77	1	2	7	2022-08-31 16:22:36.504499	2022-08-31 16:22:36.504499
78	1	3	8	2022-08-31 16:22:43.316994	2022-08-31 16:22:43.316994
79	1	1	1	2022-08-31 16:22:48.19457	2022-08-31 16:22:48.19457
80	1	2	6	2022-08-31 16:22:52.57876	2022-08-31 16:22:52.57876
81	1	3	8	2022-08-31 16:22:59.321531	2022-08-31 16:22:59.321531
82	1	1	2	2022-09-01 10:18:10.841036	2022-09-01 10:18:10.841036
83	1	2	6	2022-09-01 10:20:17.909593	2022-09-01 10:20:17.909593
84	72	80	174	2022-09-01 10:43:05.610702	2022-09-01 10:43:05.610702
85	72	81	180	2022-09-01 10:43:08.58215	2022-09-01 10:43:08.58215
86	72	82	183	2022-09-01 10:43:15.002232	2022-09-01 10:43:15.002232
87	72	80	174	2022-09-01 10:43:17.450353	2022-09-01 10:43:17.450353
88	72	81	179	2022-09-01 10:43:19.87428	2022-09-01 10:43:19.87428
89	72	82	183	2022-09-01 10:43:26.12389	2022-09-01 10:43:26.12389
90	72	80	175	2022-09-01 10:43:30.270343	2022-09-01 10:43:30.270343
91	72	81	180	2022-09-01 10:43:32.831959	2022-09-01 10:43:32.831959
92	72	82	185	2022-09-01 10:43:41.165224	2022-09-01 10:43:41.165224
93	72	80	174	2022-09-01 10:43:50.117107	2022-09-01 10:43:50.117107
94	72	81	176	2022-09-01 10:43:53.223116	2022-09-01 10:43:53.223116
95	72	82	183	2022-09-01 10:44:07.427078	2022-09-01 10:44:07.427078
96	72	80	174	2022-09-01 10:44:11.98008	2022-09-01 10:44:11.98008
97	72	81	180	2022-09-01 10:44:30.112363	2022-09-01 10:44:30.112363
98	72	82	185	2022-09-01 10:44:36.820844	2022-09-01 10:44:36.820844
99	71	77	162	2022-09-01 10:45:01.826841	2022-09-01 10:45:01.826841
100	71	78	168	2022-09-01 10:45:04.049024	2022-09-01 10:45:04.049024
101	71	79	173	2022-09-01 10:45:11.171632	2022-09-01 10:45:11.171632
102	71	77	162	2022-09-01 10:45:19.224915	2022-09-01 10:45:19.224915
103	71	78	168	2022-09-01 10:45:21.995589	2022-09-01 10:45:21.995589
104	71	79	173	2022-09-01 10:45:28.799917	2022-09-01 10:45:28.799917
105	71	77	163	2022-09-01 10:45:31.922473	2022-09-01 10:45:31.922473
106	71	78	167	2022-09-01 10:45:34.344403	2022-09-01 10:45:34.344403
107	71	79	173	2022-09-01 10:45:40.642355	2022-09-01 10:45:40.642355
108	71	77	162	2022-09-01 10:45:43.064665	2022-09-01 10:45:43.064665
109	71	78	168	2022-09-01 10:45:45.392848	2022-09-01 10:45:45.392848
110	71	79	173	2022-09-01 10:45:51.486124	2022-09-01 10:45:51.486124
111	71	77	162	2022-09-01 10:45:54.014143	2022-09-01 10:45:54.014143
112	71	78	168	2022-09-01 10:45:56.32985	2022-09-01 10:45:56.32985
113	71	79	173	2022-09-01 10:46:04.181494	2022-09-01 10:46:04.181494
114	71	77	162	2022-09-01 10:46:06.649823	2022-09-01 10:46:06.649823
115	71	78	168	2022-09-01 10:46:12.164702	2022-09-01 10:46:12.164702
116	71	79	173	2022-09-01 10:46:19.393024	2022-09-01 10:46:19.393024
117	71	77	162	2022-09-01 10:46:22.06712	2022-09-01 10:46:22.06712
118	71	78	168	2022-09-01 10:46:24.712845	2022-09-01 10:46:24.712845
\.


--
-- TOC entry 2857 (class 0 OID 16435)
-- Dependencies: 204
-- Data for Name: un_negocio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.un_negocio (idun, nombre, direccion, telefono, estado, codigo, creado, modificado) FROM stdin;
100	ALEMANIA	Av. Alemana esq Calle Totai casi 2do. anillo	3423052	1	123	2022-06-25 14:30:12	2022-08-11 12:55:10
105	CHACO	Av. Virgen de Cotoca esq. Saturnino Saucedo casi 2do. Anillo	3644358	1	44	2022-06-25 14:30:12	2022-08-11 13:48:09
110	ROYAL	Av. Roque Aguilera esq. Angel Sandoval 3er. Anillo Interno	3560747	1	111	2022-06-25 14:30:12	2022-08-11 12:55:26
115	EQUIPETROL	4to Anillo entre C/Maria Oliveira y Maria de Boland No. 77	3434635	1	1111	2022-06-25 14:30:12	2022-08-11 12:55:30
120	PARAGUA	Av. Paragua esq. 4to Anillo Nro. 3500	3644291	1	321	2022-06-25 14:30:12	2022-08-11 12:55:35
315	BEREA	Av. Doble Vía a La Guardia 8vo. Anillo	3556382	1	334	2022-06-25 14:30:13	2022-08-11 12:55:59
1	admin	Av.	\N	1	123456	2022-08-22 08:14:17.463132	2022-08-22 08:14:17.463132
130	LUCIFER	NA	\N	1	130	2022-09-01 15:38:45.291202	2022-09-01 15:38:45.291202
135	MONTECRISTO	NA	\N	1	135	2022-09-01 15:38:45.32202	2022-09-01 15:38:45.32202
200	SUR	NA	\N	1	200	2022-09-01 15:38:45.323886	2022-09-01 15:38:45.323886
205	BENI	NA	\N	1	205	2022-09-01 15:38:45.325757	2022-09-01 15:38:45.325757
210	LOPEZ	NA	\N	1	210	2022-09-01 15:38:45.326845	2022-09-01 15:38:45.326845
215	VIRU VIRU	NA	\N	1	215	2022-09-01 15:38:45.32797	2022-09-01 15:38:45.32797
220	PORANGUE	NA	\N	1	220	2022-09-01 15:42:54.329277	2022-09-01 15:42:54.329277
225	LA TECA	NA	\N	1	225	2022-09-01 15:42:54.330348	2022-09-01 15:42:54.330348
230	MONTEVERDE	NA	\N	1	230	2022-09-01 15:42:54.331339	2022-09-01 15:42:54.331339
300	PIRAI	NA	\N	1	300	2022-09-01 15:42:54.332205	2022-09-01 15:42:54.332205
305	CABEZAS	NA	\N	1	305	2022-09-01 15:42:54.33319	2022-09-01 15:42:54.33319
310	PARAPETI	NA	\N	1	310	2022-09-01 15:42:54.334045	2022-09-01 15:42:54.334045
400	GASCO	NA	\N	1	400	2022-09-01 15:42:54.334895	2022-09-01 15:42:54.334895
\.


--
-- TOC entry 2870 (class 0 OID 0)
-- Dependencies: 197
-- Name: encuesta_idencuesta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.encuesta_idencuesta_seq', 72, true);


--
-- TOC entry 2871 (class 0 OID 0)
-- Dependencies: 199
-- Name: opcion_idopcion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.opcion_idopcion_seq', 185, true);


--
-- TOC entry 2872 (class 0 OID 0)
-- Dependencies: 201
-- Name: pregunta_idpregunta_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.pregunta_idpregunta_seq', 82, true);


--
-- TOC entry 2873 (class 0 OID 0)
-- Dependencies: 203
-- Name: respuesta_idresp_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.respuesta_idresp_seq', 118, true);


--
-- TOC entry 2874 (class 0 OID 0)
-- Dependencies: 205
-- Name: un_negocio_idun_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.un_negocio_idun_seq', 1, true);


--
-- TOC entry 2719 (class 2606 OID 16452)
-- Name: encuesta encuesta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.encuesta
    ADD CONSTRAINT encuesta_pkey PRIMARY KEY (idencuesta);


--
-- TOC entry 2721 (class 2606 OID 16454)
-- Name: opcion opcion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.opcion
    ADD CONSTRAINT opcion_pkey PRIMARY KEY (idopcion);


--
-- TOC entry 2723 (class 2606 OID 16456)
-- Name: pregunta pregunta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.pregunta
    ADD CONSTRAINT pregunta_pkey PRIMARY KEY (idpregunta);


--
-- TOC entry 2725 (class 2606 OID 16458)
-- Name: respuesta respuesta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.respuesta
    ADD CONSTRAINT respuesta_pkey PRIMARY KEY (idresp);


--
-- TOC entry 2727 (class 2606 OID 16460)
-- Name: un_negocio un_negocio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.un_negocio
    ADD CONSTRAINT un_negocio_pkey PRIMARY KEY (idun);


-- Completed on 2022-09-02 09:32:22

--
-- PostgreSQL database dump complete
--

