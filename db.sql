--
-- PostgreSQL database dump
--

-- Dumped from database version 13.9 (Raspbian 13.9-0+deb11u1)
-- Dumped by pg_dump version 13.9 (Raspbian 13.9-0+deb11u1)

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: barcode; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.barcode (
    id integer NOT NULL,
    names character varying(100) NOT NULL,
    bartext character varying(25) NOT NULL,
    phone character varying(25) NOT NULL
);


ALTER TABLE public.barcode OWNER TO postgres;

--
-- Name: barcode_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.barcode_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.barcode_id_seq OWNER TO postgres;

--
-- Name: barcode_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.barcode_id_seq OWNED BY public.barcode.id;


--
-- Name: payment; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.payment (
    id integer NOT NULL,
    sender character varying(100),
    route character varying(100),
    receiver character varying(100),
    amount real,
    issuetime character varying(100)
);


ALTER TABLE public.payment OWNER TO postgres;

--
-- Name: payment_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.payment_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.payment_id_seq OWNER TO postgres;

--
-- Name: payment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.payment_id_seq OWNED BY public.payment.id;


--
-- Name: permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permiso (
    idpermiso integer NOT NULL,
    nombre_permiso character varying(45) NOT NULL,
    estado_permiso integer NOT NULL
);


ALTER TABLE public.permiso OWNER TO postgres;

--
-- Name: permiso_id_Permiso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."permiso_id_Permiso_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."permiso_id_Permiso_seq" OWNER TO postgres;

--
-- Name: permiso_id_Permiso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."permiso_id_Permiso_seq" OWNED BY public.permiso.idpermiso;


--
-- Name: routes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.routes (
    id integer NOT NULL,
    rname character varying(150),
    rowner character varying(150)
);


ALTER TABLE public.routes OWNER TO postgres;

--
-- Name: routes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.routes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.routes_id_seq OWNER TO postgres;

--
-- Name: routes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.routes_id_seq OWNED BY public.routes.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    idusuario integer NOT NULL,
    name character varying(60) NOT NULL,
    username character varying(100) NOT NULL,
    email character varying(150) NOT NULL,
    pass character varying(525) NOT NULL,
    images character varying(150),
    phone character varying(150),
    status integer NOT NULL,
    idpermiso integer,
    token integer,
    barcode integer,
    money real,
    employerboss character varying(150)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: usuario_idusuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_idusuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_idusuario_seq OWNER TO postgres;

--
-- Name: usuario_idusuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_idusuario_seq OWNED BY public.usuario.idusuario;


--
-- Name: barcode id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barcode ALTER COLUMN id SET DEFAULT nextval('public.barcode_id_seq'::regclass);


--
-- Name: payment id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment ALTER COLUMN id SET DEFAULT nextval('public.payment_id_seq'::regclass);


--
-- Name: permiso idpermiso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permiso ALTER COLUMN idpermiso SET DEFAULT nextval('public."permiso_id_Permiso_seq"'::regclass);


--
-- Name: routes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.routes ALTER COLUMN id SET DEFAULT nextval('public.routes_id_seq'::regclass);


--
-- Name: usuario idusuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN idusuario SET DEFAULT nextval('public.usuario_idusuario_seq'::regclass);


--
-- Data for Name: barcode; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.barcode (id, names, bartext, phone) FROM stdin;
2	Andres Rodriguez	AJRJUDEX60	73387625
\.


--
-- Data for Name: payment; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.payment (id, sender, route, receiver, amount, issuetime) FROM stdin;
7	Papas	Route 35	gerardog	0.3	2023-07-14 04:07
\.


--
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permiso (idpermiso, nombre_permiso, estado_permiso) FROM stdin;
1	Administrador	1
4	Driver	1
3	User	1
2	Employeer	1
\.


--
-- Data for Name: routes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.routes (id, rname, rowner) FROM stdin;
1	Route 35	gerardog
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (idusuario, name, username, email, pass, images, phone, status, idpermiso, token, barcode, money, employerboss) FROM stdin;
128	Gerardo Dog	gerardog	gerardoggergoddog@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	75420900	2	2	\N	20232036	1	\N
105	José Cabañas	supreme_j	supr.emej20@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	76057513	2	2	\N	20235293	\N	\N
108	Cesar Adrian Figueroa	Cesar312	Pablo17@gmail.com	db21205d9198c090bb994bac82baf34e7150ed461ac0f7bb5b1918506fa29f27671c2968be8993cedf0eb4d4cfe9b99dcbb4f58235cccef654240be8f3f5a371	user_icon.png	77859961	2	4	79404	20232284	12.69	\N
97	HOLA	yeah2	aaaaaa@aaaaaaaaaaa.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	12312312	2	3	\N	20231534	\N	\N
122	Gabriel Corvera	Corve	gabriel.corvera2005@gmail.com	c4e960552b9102293b1b6a9a72172740dab6ff4cdd0e155f37adb2917c6a5637f169cb2471b7ea766f34602a3cee0ba9d383899d2e805ecbf26d9ffcf9bba062	user_icon.png	74851236	1	3	82300	20238057	1	\N
131	sdfjnsfsdfkjlsklf	maklen2222	jilososercercanaldeoswaldo@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1687561497_8735,jpg	+503 3248-9432	2	3	14482	20232902	1	  
120	Juan Diego Rodriguez Somoza	Juandiegox	qaz@gmail.com	673d4b1d7deabe33d0037d3a39927ec3d56397a45f5eb9ac0512c75808c293f0d022e04adc5555cd3644d18cf79e9e9ebaea7e3a8e96744b0c49312a7f8af398	user_icon.png	78745632	2	3	\N	20232370	0.7	\N
106	Don Toño	Polez	lopezzzzz@gmail.com	d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db	user_icon.png	12345678	2	1	94122	20236253	\N	\N
109	Latte_Maklen	maklen89	ostercercanaldeoswaldo222@gmail.com	d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db	user_icon.png	21312312	1	3	34865	20236523	0	\N
110	Caste	Caste123	castellanos@gmail.com	3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79	user_icon.png	12345678	1	3	22807	20234131	0	\N
121	Wilfredo Rodriguez	Andres1234	Wilfredo@gmail.com	3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79	user_icon.png	87654321	2	2	71801	20231360	\N	\N
114	Mario Alejandro Lopez Lopez	Luigi	qwerty@gmail.com	db21205d9198c090bb994bac82baf34e7150ed461ac0f7bb5b1918506fa29f27671c2968be8993cedf0eb4d4cfe9b99dcbb4f58235cccef654240be8f3f5a371	user_icon.png	73387625	0	3	62651	20239358	\N	\N
115	Ulises Tesedo	UlisesT	ulisest.esedo@gmail.com	d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db	user_icon.png	12312313	2	3	80161	20233612	\N	\N
63	Christian	Chris	christianmaklen@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	123123	2	1	\N	20239346	100	\N
103	Rodolfo Guzman	FitoGuss	aaaaaaa@bbbbbb.com	33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e	user_icon.png	88542159	2	4	18752	20233404	\N	\N
44	Andrés Wilfredo Rodríguez Somoza	Pofu	andressomoza23@gmail.com	d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db	user_icon.png	13123122	2	1	\N	20236960	219.1	\N
133	idusfisidfksdfkds	Chris2233232	ostercercana3242342342ldeoswaldo@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689357669_7463.png	+503 2342-3424	2	3	40109	20234030	1	\N
123	Gustavo Pacheco Mancia	Flare	rpacheco220406@gmail.com	57ae717813b34de5df7397ed941aeef57a69f49b28d41498c8093b9ff39444fb353c5e0ee72c754df0cd766ed668de37d139c5dbb1c931fb63eb866af40a4387	user_icon.png	75488851	2	3	\N	20239347	0.7	\N
119	Andres Somoza	Pofito	pofu@gmail.com	3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79	user_icon.png	12345678	2	4	45218	20232931	\N	\N
125	Christian222	maklen222	ostercercanaldeoswaldo2222@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	+503 7605-7513	2	3	\N	20233631	0.7	\N
124	Wilfredo Andres	Wilfredo1234	wil@gmail.com	3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79	user_icon.png	70356724	2	2	64377	20235718	\N	\N
94	Andrés Wilfredo Rodríguez Somoza	Boris	borisgamer1433@gmail.com	b4afdb91f5e526952a2bdf5055f6897e9dcb70bc0485a9dd79981e4751c03bd6b350c2af7152b026525bf1bc5fb4c2b0374f18112be24a0c51fd467e06024271	user_icon.png	73387625	2	2	\N	20236605	4.7	\N
130	YAAAAA	maklen22222222	ostercercanalde2222oswaldo@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689356108_6626.png	+503 7889-9999	2	3	99536	20239535	\N	\N
132	Latte_Maklen	Chris22222222222	ostercercanald2323232eoswaldo@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689369287_4881.png	+503 2382-8349	2	1	31116	20238119	\N	\N
134	LOREM IPSUM	Chris234892489249234	ostercercanaldeoswaldo@gmail.com22222222222	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689358692_4355.png	+503 9328-2032	2	3	48372	20233226	1	\N
135	sfsdfsfsdf	heyyy	ostercercanaldeoswaldo@gmail.comefyuhfhy2uyr32	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	user_icon.png	+503 2342-3423	2	3	83818	20233668	1	\N
129	Latte_Maklen	maklen22222	ostercerca2222naldeoswaldo@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689369796_7182.jpg	+503 7674-8983	2	1	89248	20239853	\N	\N
136	sdijfjsdjfskdjfjsfjs	maklen3242234df	ostercercanaldeoswaldo@gmail.comsfdgdgdfg	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689361677_3101.png	+503 2342-3423	2	3	89535	20238458	1	\N
137	9ooooo	Oswaldo	oswaldoc2803@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689361920_9976.png	+503 7123-1312	2	3	82027	20237023	1	\N
138	sdfnkjsjhfkjdsfjksd	ilost	ostercercanaldeoswaldo@gmail.com22222232wdsf	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689362111_7472.png	+503 7834-8773	2	3	75330	20239806	1	\N
99	Rodrigo Lopez	Chopez	rodrigolopezlopez2006@gmail.com	d404559f602eab6fd602ac7680dacbfaadd13630335e951f097af3900e9de176b6db28512f2e000b9d04fba5133e8b1c6e8df59db3a8ab9d60be4b97cc9e81db	1687561497_8735.jpg	12212121	2	3	\N	20236356	88	gerardog
139	Appitas	Papas	papitas.papaspap@gmail.com	b66f91437d85f726506c3e14b56b3ef474f9e8e5af623f110775d999cc3a46150e20d307201d696a40fe39347576d51d229e8661cef8aa70aa6d45d5b3e49aef	1689362230_2607.gif	+503 1231-2414	2	3	56868	20238904	5.4	\N
\.


--
-- Name: barcode_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.barcode_id_seq', 17, true);


--
-- Name: payment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.payment_id_seq', 7, true);


--
-- Name: permiso_id_Permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."permiso_id_Permiso_seq"', 1, true);


--
-- Name: routes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.routes_id_seq', 1, false);


--
-- Name: usuario_idusuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_idusuario_seq', 139, true);


--
-- Name: barcode barcode_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.barcode
    ADD CONSTRAINT barcode_pkey PRIMARY KEY (id);


--
-- Name: payment payment_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.payment
    ADD CONSTRAINT payment_pkey PRIMARY KEY (id);


--
-- Name: permiso permiso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT permiso_pkey PRIMARY KEY (idpermiso);


--
-- Name: routes routes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.routes
    ADD CONSTRAINT routes_pkey PRIMARY KEY (id);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (idusuario);


--
-- Name: usuario usuario_idpermiso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_idpermiso_fkey FOREIGN KEY (idpermiso) REFERENCES public.permiso(idpermiso);


--
-- PostgreSQL database dump complete
--

