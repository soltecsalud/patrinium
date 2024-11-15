--
-- PostgreSQL database dump
--

-- Dumped from database version 12.8
-- Dumped by pg_dump version 12.8

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
-- Name: archivo_adjunto; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.archivo_adjunto (
    id_archivo_adjunto integer NOT NULL,
    nombre_archivo character varying(200),
    descripcion character varying(64000),
    id_solicitud integer,
    create_at date,
    sociedad_uuid character(36)
);


ALTER TABLE public.archivo_adjunto OWNER TO postgres;

--
-- Name: archivo_adjunto_id_archivo_adjunto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.archivo_adjunto_id_archivo_adjunto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.archivo_adjunto_id_archivo_adjunto_seq OWNER TO postgres;

--
-- Name: archivo_adjunto_id_archivo_adjunto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.archivo_adjunto_id_archivo_adjunto_seq OWNED BY public.archivo_adjunto.id_archivo_adjunto;


--
-- Name: bancos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bancos (
    id_banco integer NOT NULL,
    nombre_banco character varying(300),
    tipo_banco character varying(300)
);


ALTER TABLE public.bancos OWNER TO postgres;

--
-- Name: bancos_consignaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bancos_consignaciones (
    id_banco integer NOT NULL,
    nombre_banco character varying(255),
    nombre_cuenta character varying(255),
    numero_cuenta character varying(255),
    routing_ach character varying(255),
    aba character varying(255),
    swift character varying(255),
    ciudad character varying(255),
    sucursal character varying(255),
    fecha_ingreso date
);


ALTER TABLE public.bancos_consignaciones OWNER TO postgres;

--
-- Name: bancos_consignaciones_id_banco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bancos_consignaciones_id_banco_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bancos_consignaciones_id_banco_seq OWNER TO postgres;

--
-- Name: bancos_consignaciones_id_banco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bancos_consignaciones_id_banco_seq OWNED BY public.bancos_consignaciones.id_banco;


--
-- Name: bancos_id_bancos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bancos_id_bancos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bancos_id_bancos_seq OWNER TO postgres;

--
-- Name: bancos_id_bancos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bancos_id_bancos_seq OWNED BY public.bancos.id_banco;


--
-- Name: ciudades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ciudades (
    id_ciudad integer,
    cod_iso character varying(500),
    ciudad character varying(500),
    estado character varying(500)
);


ALTER TABLE public.ciudades OWNER TO postgres;

--
-- Name: datos_adicionales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datos_adicionales (
    id_datos_adicionales integer NOT NULL,
    nombre_cliente character varying(255),
    sr_numero character varying(100),
    date_organization date,
    state_organization character varying(100),
    principal_business character varying(255),
    managing_members character varying(255),
    bank_account character varying(100),
    fiscal_year character varying(50),
    ein character varying(50),
    date_annual_meeting date,
    secretary character varying(100),
    treasurer character varying(100),
    members character varying(255),
    initial_manager character varying(255),
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fk_solicitud integer,
    createat timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.datos_adicionales OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.clientes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.clientes_id_seq OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.clientes_id_seq OWNED BY public.datos_adicionales.id_datos_adicionales;


--
-- Name: datos_bancarios_sociedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.datos_bancarios_sociedad (
    id_bancos_sociedad integer NOT NULL,
    id_banco integer,
    cuenta_banco character varying(300),
    tipo_cuenta character varying(300),
    titular_cuenta character varying(300),
    fecha_de_creacion character varying(300),
    usuario_creacion integer
);


ALTER TABLE public.datos_bancarios_sociedad OWNER TO postgres;

--
-- Name: datos_bancarios_sociedad_id_bancos_sociedad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.datos_bancarios_sociedad_id_bancos_sociedad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.datos_bancarios_sociedad_id_bancos_sociedad_seq OWNER TO postgres;

--
-- Name: datos_bancarios_sociedad_id_bancos_sociedad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.datos_bancarios_sociedad_id_bancos_sociedad_seq OWNED BY public.datos_bancarios_sociedad.id_bancos_sociedad;


--
-- Name: documentos_adjuntos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documentos_adjuntos (
    id_tipo_documento_adjunto integer NOT NULL,
    nombre_documento_adjunto character varying(255) NOT NULL,
    create_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.documentos_adjuntos OWNER TO postgres;

--
-- Name: documentos_adjuntos_id_tipo_documento_adjunto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documentos_adjuntos_id_tipo_documento_adjunto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.documentos_adjuntos_id_tipo_documento_adjunto_seq OWNER TO postgres;

--
-- Name: documentos_adjuntos_id_tipo_documento_adjunto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documentos_adjuntos_id_tipo_documento_adjunto_seq OWNED BY public.documentos_adjuntos.id_tipo_documento_adjunto;


--
-- Name: egresos_sociedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.egresos_sociedad (
    id_egresos_sociedad integer NOT NULL,
    fk_tercero integer,
    valor numeric(10,2) NOT NULL,
    create_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    consecutivo_egreso integer,
    fk_sociedad character(360),
    anticipo numeric(10,2),
    factura character varying
);


ALTER TABLE public.egresos_sociedad OWNER TO postgres;

--
-- Name: egresos_sociedad_id_egresos_sociedad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.egresos_sociedad_id_egresos_sociedad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.egresos_sociedad_id_egresos_sociedad_seq OWNER TO postgres;

--
-- Name: egresos_sociedad_id_egresos_sociedad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.egresos_sociedad_id_egresos_sociedad_seq OWNED BY public.egresos_sociedad.id_egresos_sociedad;


--
-- Name: estados; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.estados (
    id_estado integer,
    cod_estado character varying(20),
    estado character varying(500)
);


ALTER TABLE public.estados OWNER TO postgres;

--
-- Name: factura; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.factura (
    id integer NOT NULL,
    datos jsonb,
    created_at date,
    id_solicitud integer,
    estado integer,
    ruta_pago character varying(500),
    tipo_consignacion character varying(100),
    nota_pago character varying(2000)
);


ALTER TABLE public.factura OWNER TO postgres;

--
-- Name: COLUMN factura.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.factura.estado IS '0=facturada, 1=pagada, 2=orden servicio';


--
-- Name: factura_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.factura_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.factura_id_seq OWNER TO postgres;

--
-- Name: factura_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.factura_id_seq OWNED BY public.factura.id;


--
-- Name: pais; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.pais (
    id_pais integer,
    cod_iso character varying(500),
    pais character varying(500),
    contin character varying(500),
    localizacion character varying(500),
    cod_ita character varying(500)
);


ALTER TABLE public.pais OWNER TO postgres;

--
-- Name: permisos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permisos (
    id uuid NOT NULL,
    nombre character varying NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);


ALTER TABLE public.permisos OWNER TO postgres;

--
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona (
    id_persona integer NOT NULL,
    nombres character varying(255),
    apellidos character varying(255),
    cedula character varying(50),
    pais character varying(255),
    ciudad character varying(255),
    cliente character varying(255),
    oficina_envia character varying(255),
    estadousa character varying(255),
    pasaporte_numero character varying(50),
    pasaporte_fecha_expedicion date,
    pasaporte_fecha_caducidad date,
    tipo_visa character varying(50),
    fecha_expedicion_visa date,
    fecha_caducidad_visa date,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    usuario_createat character varying(255)
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- Name: persona_id_persona_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.persona_id_persona_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_id_persona_seq OWNER TO postgres;

--
-- Name: persona_id_persona_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.persona_id_persona_seq OWNED BY public.persona.id_persona;


--
-- Name: personas_sociedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.personas_sociedad (
    id_personas_sociedad integer NOT NULL,
    nombre_sociedad character varying(255),
    fk_persona integer,
    porcentaje numeric(5,2),
    create_at timestamp without time zone DEFAULT now(),
    create_user character varying(255),
    fk_solicitud integer,
    uuid character(36)
);


ALTER TABLE public.personas_sociedad OWNER TO postgres;

--
-- Name: personas_sociedad_id_personas_sociedad_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.personas_sociedad_id_personas_sociedad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_sociedad_id_personas_sociedad_seq OWNER TO postgres;

--
-- Name: personas_sociedad_id_personas_sociedad_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.personas_sociedad_id_personas_sociedad_seq OWNED BY public.personas_sociedad.id_personas_sociedad;


--
-- Name: plantillas_save_html; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.plantillas_save_html (
    id_plantillas_save integer NOT NULL,
    contenido_html text,
    createat date,
    usuario character varying(100),
    fk_solicitud integer
);


ALTER TABLE public.plantillas_save_html OWNER TO postgres;

--
-- Name: plantillas_save_html_id_plantillas_save_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.plantillas_save_html_id_plantillas_save_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.plantillas_save_html_id_plantillas_save_seq OWNER TO postgres;

--
-- Name: plantillas_save_html_id_plantillas_save_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.plantillas_save_html_id_plantillas_save_seq OWNED BY public.plantillas_save_html.id_plantillas_save;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id uuid NOT NULL,
    rol character varying,
    inicio_ruta boolean,
    entrega_resultados boolean,
    resultados_entregados boolean,
    impresion_resultados boolean,
    laboratorio boolean,
    vph boolean,
    integracion_viper boolean,
    seguimientos boolean,
    colposcopia boolean,
    pacientes boolean,
    informacion boolean,
    informes boolean,
    config_general boolean,
    seguridad boolean,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- Name: roles_has_permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles_has_permiso (
    id_rol uuid NOT NULL,
    id_permiso uuid NOT NULL
);


ALTER TABLE public.roles_has_permiso OWNER TO postgres;

--
-- Name: servicios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servicios (
    id_servicio integer NOT NULL,
    nombre_servicio character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    servicio_name character varying
);


ALTER TABLE public.servicios OWNER TO postgres;

--
-- Name: servicios_adicionales; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.servicios_adicionales (
    id_servicios_adicionales integer NOT NULL,
    servicios jsonb,
    servicios_adicionales jsonb,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    usuario_creacion character varying(255),
    fk_solicitud integer NOT NULL
);


ALTER TABLE public.servicios_adicionales OWNER TO postgres;

--
-- Name: servicios_adicionales_id_servicios_adicionales_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicios_adicionales_id_servicios_adicionales_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicios_adicionales_id_servicios_adicionales_seq OWNER TO postgres;

--
-- Name: servicios_adicionales_id_servicios_adicionales_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.servicios_adicionales_id_servicios_adicionales_seq OWNED BY public.servicios_adicionales.id_servicios_adicionales;


--
-- Name: servicios_id_tabla_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.servicios_id_tabla_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.servicios_id_tabla_seq OWNER TO postgres;

--
-- Name: servicios_id_tabla_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.servicios_id_tabla_seq OWNED BY public.servicios.id_servicio;


--
-- Name: sociedad; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sociedad (
    id_sociedad integer NOT NULL,
    nombre character varying(255),
    apellido character varying(255),
    fecha_nacimiento date,
    estado_civil character varying(50),
    pais_origen character varying(255),
    pais_residencia_fiscal character varying(255),
    pais_domicilio character varying(255),
    numero_pasaporte character varying(255),
    pais_pasaporte character varying(255),
    tipo_visa character varying(255),
    direccion_local character varying(255),
    telefonos character varying(255),
    emails character varying(255),
    industria character varying(255),
    nombre_negocio_local character varying(255),
    ubicacion_negocio_principal character varying(255),
    tamano_negocio character varying(255),
    contacto_ejecutivo_local character varying(255),
    numero_empleados integer,
    numero_hijos integer,
    razon_consultoria character varying(255),
    requiere_registro_corporacion character varying(255),
    observaciones text,
    fk_solicitud integer,
    createdat date
);


ALTER TABLE public.sociedad OWNER TO postgres;

--
-- Name: sociedad_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sociedad_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sociedad_id_seq OWNER TO postgres;

--
-- Name: sociedad_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sociedad_id_seq OWNED BY public.sociedad.id_sociedad;


--
-- Name: solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud (
    id_solicitud integer NOT NULL,
    nombre_cliente character varying(300) NOT NULL,
    referido_por character varying(300) NOT NULL,
    necesidad text NOT NULL,
    created_at date,
    servicios json,
    servicios_adicionales jsonb,
    fk_persona integer
);


ALTER TABLE public.solicitud OWNER TO postgres;

--
-- Name: solicitudes_id_solicitudes_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitudes_id_solicitudes_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitudes_id_solicitudes_seq OWNER TO postgres;

--
-- Name: solicitudes_id_solicitudes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitudes_id_solicitudes_seq OWNED BY public.solicitud.id_solicitud;


--
-- Name: terceros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.terceros (
    id_terceros integer NOT NULL,
    nombre_tercero character varying(255) NOT NULL,
    create_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    nombre_comercial character varying(255),
    tipo_entidad character varying(50),
    direccion character varying(255),
    ciudad character varying(100),
    estado character varying(50),
    codigo_postal character varying(20),
    tin character varying(20),
    firma character varying(255),
    fecha date
);


ALTER TABLE public.terceros OWNER TO postgres;

--
-- Name: terceros_id_terceros_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.terceros_id_terceros_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.terceros_id_terceros_seq OWNER TO postgres;

--
-- Name: terceros_id_terceros_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.terceros_id_terceros_seq OWNED BY public.terceros.id_terceros;


--
-- Name: tipo_pago; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_pago (
    id_tipo_pago integer NOT NULL,
    tipo_pago character varying(200)
);


ALTER TABLE public.tipo_pago OWNER TO postgres;

--
-- Name: tipo_pago_id_tipo_pago_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_pago_id_tipo_pago_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_pago_id_tipo_pago_seq OWNER TO postgres;

--
-- Name: tipo_pago_id_tipo_pago_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_pago_id_tipo_pago_seq OWNED BY public.tipo_pago.id_tipo_pago;


--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id_usuario uuid NOT NULL,
    identificacion bigint NOT NULL,
    usuario character varying NOT NULL,
    password character varying(10485760) NOT NULL,
    tipo_doc character varying,
    primer_nombre character varying NOT NULL,
    segundo_nombre character varying,
    primer_apellido character varying NOT NULL,
    segundo_apellido character varying,
    correo character varying NOT NULL,
    telefono character varying,
    id_sede bigint,
    id_especialidad bigint,
    id_servicio bigint,
    rol character varying NOT NULL,
    id_eps bigint,
    estado character varying NOT NULL,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    delete_at timestamp without time zone,
    usuario_add character varying,
    update_at timestamp without time zone,
    update_by character varying,
    delete_by character varying
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: archivo_adjunto id_archivo_adjunto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.archivo_adjunto ALTER COLUMN id_archivo_adjunto SET DEFAULT nextval('public.archivo_adjunto_id_archivo_adjunto_seq'::regclass);


--
-- Name: bancos id_banco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bancos ALTER COLUMN id_banco SET DEFAULT nextval('public.bancos_id_bancos_seq'::regclass);


--
-- Name: bancos_consignaciones id_banco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bancos_consignaciones ALTER COLUMN id_banco SET DEFAULT nextval('public.bancos_consignaciones_id_banco_seq'::regclass);


--
-- Name: datos_adicionales id_datos_adicionales; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datos_adicionales ALTER COLUMN id_datos_adicionales SET DEFAULT nextval('public.clientes_id_seq'::regclass);


--
-- Name: datos_bancarios_sociedad id_bancos_sociedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datos_bancarios_sociedad ALTER COLUMN id_bancos_sociedad SET DEFAULT nextval('public.datos_bancarios_sociedad_id_bancos_sociedad_seq'::regclass);


--
-- Name: documentos_adjuntos id_tipo_documento_adjunto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentos_adjuntos ALTER COLUMN id_tipo_documento_adjunto SET DEFAULT nextval('public.documentos_adjuntos_id_tipo_documento_adjunto_seq'::regclass);


--
-- Name: egresos_sociedad id_egresos_sociedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.egresos_sociedad ALTER COLUMN id_egresos_sociedad SET DEFAULT nextval('public.egresos_sociedad_id_egresos_sociedad_seq'::regclass);


--
-- Name: factura id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factura ALTER COLUMN id SET DEFAULT nextval('public.factura_id_seq'::regclass);


--
-- Name: persona id_persona; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona ALTER COLUMN id_persona SET DEFAULT nextval('public.persona_id_persona_seq'::regclass);


--
-- Name: personas_sociedad id_personas_sociedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas_sociedad ALTER COLUMN id_personas_sociedad SET DEFAULT nextval('public.personas_sociedad_id_personas_sociedad_seq'::regclass);


--
-- Name: plantillas_save_html id_plantillas_save; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plantillas_save_html ALTER COLUMN id_plantillas_save SET DEFAULT nextval('public.plantillas_save_html_id_plantillas_save_seq'::regclass);


--
-- Name: servicios id_servicio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios ALTER COLUMN id_servicio SET DEFAULT nextval('public.servicios_id_tabla_seq'::regclass);


--
-- Name: servicios_adicionales id_servicios_adicionales; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_adicionales ALTER COLUMN id_servicios_adicionales SET DEFAULT nextval('public.servicios_adicionales_id_servicios_adicionales_seq'::regclass);


--
-- Name: sociedad id_sociedad; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sociedad ALTER COLUMN id_sociedad SET DEFAULT nextval('public.sociedad_id_seq'::regclass);


--
-- Name: solicitud id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud ALTER COLUMN id_solicitud SET DEFAULT nextval('public.solicitudes_id_solicitudes_seq'::regclass);


--
-- Name: terceros id_terceros; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terceros ALTER COLUMN id_terceros SET DEFAULT nextval('public.terceros_id_terceros_seq'::regclass);


--
-- Name: tipo_pago id_tipo_pago; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_pago ALTER COLUMN id_tipo_pago SET DEFAULT nextval('public.tipo_pago_id_tipo_pago_seq'::regclass);


--
-- Data for Name: archivo_adjunto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.archivo_adjunto (id_archivo_adjunto, nombre_archivo, descripcion, id_solicitud, create_at, sociedad_uuid) FROM stdin;
44	Formato005_84447.pdf	DOCUMENTO DE IDENTIFICACION LOCAL	13	2024-11-07	f1255464-eacd-4713-92c5-274359ef0893
42	JORGE MANDUJANO - PASAPORTE.pdf	PASAPORTE	13	2024-10-18	f1255464-eacd-4713-92c5-274359ef0893
43	Formato005_84447.pdf	VISA AMERICANA	13	2024-11-07	f1255464-eacd-4713-92c5-274359ef0893
45	Formato005_84447.pdf	2	13	2024-11-11	3670447a-0f07-489f-aa14-5446a9e40f05
46	QR-EEJsLYwqmJdkbXhm6.jpeg	3	14	2024-11-12	0a46f31d-7777-424e-9f11-145ea36e39df
\.


--
-- Data for Name: bancos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bancos (id_banco, nombre_banco, tipo_banco) FROM stdin;
1	davivienda	corporacion
2	bancolombia	banco
\.


--
-- Data for Name: bancos_consignaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bancos_consignaciones (id_banco, nombre_banco, nombre_cuenta, numero_cuenta, routing_ach, aba, swift, ciudad, sucursal, fecha_ingreso) FROM stdin;
1	JPMORGAN CHASE BANK NA	JAIRO VARGAS	567528552	267084131	021000021	CHASUS33XXX	MIAMI, FLORIDA, USA	4451 NW 36 ST MIAMI SPRING 33166	2024-05-09
2	TD Bank NA	Jairo Vargas	4387112976	067014822	031101266	NRTUHS33XXX	Miami, Florida, USA	1103 Brickell Ave, Miami FL, 33131	2024-05-11
3	TD Bank NA	LAMVA INVESTMENTS	4369922608	067014822	031101266	NRTHUS33	Miami, Florida, USA	1103 Brickell Ave, Miami FL, 33131	2024-05-11
4	Bank of America	Vargas & Associates Internacional Group	1596446524	063000047	063000047	BOFAUS3N	Miami	El Doral	2024-05-11
5	Wells Fargo Bank, N.A.	Universal Investment and Development Corp.	6587828986	063107513	063107513	WFBIUS6S	Miami Springs	4299 NW 36 ST, Miami Springs, FL, 33166	2024-05-11
6	Wells Fargo	Jairo Vargas	1685304852925	067006432	067006432	WFBIUS6S	Miami	4299 NW 36 Street, Miami Springs, FL, 33166	2024-05-11
7	JPMorgan Chase Bank NA	Tandem International Business Services LLC	588380363	267084131	021000021	CHASUS33XXX	Miami, Florida, USA	1103 Brickell Ave, Miami FL, 33131	2024-05-11
9	cuenta santiago 	santiago erazo	12345678	123	2131	8182jsj	Miami	south beach	2024-06-10
10	cuetna Jairo vargas prueba	Jairo vargas prueba	72612521512	812812	jshry6	hgjty27	Miami	miami 17yh	2024-06-10
11	bancolombia	prueba junio 15 	124566	123455	17272	123321312	pasto	pasto	2024-06-15
\.


--
-- Data for Name: ciudades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ciudades (id_ciudad, cod_iso, ciudad, estado) FROM stdin;
1	ABW	ORANJESTAD	Ï¿½
1	AFG	KABUL	KABOL
2	AFG	QANDAHAR	QANDAHAR
3	AFG	HERAT	HERAT
4	AFG	MAZAR-E-SHARIF	BALKH
1	AGO	LUANDA	LUANDA
2	AGO	HUAMBO	HUAMBO
3	AGO	LOBITO	BENGUELA
4	AGO	BENGUELA	BENGUELA
5	AGO	NAMIBE	NAMIBE
1	AIA	SOUTH HILL	Ï¿½
2	AIA	THE VALLEY	Ï¿½
1	ALB	TIRANA	TIRANA
1	AND	ANDORRA LA VELLA	ANDORRA LA VELLA
1	ANT	WILLEMSTAD	CURAÏ¿½AO
1	ARE	DUBAI	DUBAI
2	ARE	ABU DHABI	ABU DHABI
3	ARE	SHARJA	SHARJA
4	ARE	AL-AYN	ABU DHABI
5	ARE	AJMAN	AJMAN
1	ARG	BUENOS AIRES	DISTRITO FEDERAL
2	ARG	LA MATANZA	BUENOS AIRES
3	ARG	CORDOBA	CORDOBA
4	ARG	ROSARIO	SANTA FE
5	ARG	LOMAS DE ZAMORA	BUENOS AIRES
6	ARG	QUILMES	BUENOS AIRES
7	ARG	ALMIRANTE BROWN	BUENOS AIRES
8	ARG	LA PLATA	BUENOS AIRES
9	ARG	MAR DEL PLATA	BUENOS AIRES
10	ARG	SAN MIGUEL DE TUCUMAN	TUCUMAN
11	ARG	LANIS	BUENOS AIRES
12	ARG	MERLO	BUENOS AIRES
13	ARG	GENERAL SAN MARTIN	BUENOS AIRES
14	ARG	SALTA	SALTA
15	ARG	MORENO	BUENOS AIRES
16	ARG	SANTA FE	SANTA FE
17	ARG	AVELLANEDA	BUENOS AIRES
18	ARG	TRES DE FEBRERO	BUENOS AIRES
19	ARG	MORIN	BUENOS AIRES
20	ARG	FLORENCIO VARELA	BUENOS AIRES
21	ARG	SAN ISIDRO	BUENOS AIRES
22	ARG	TIGRE	BUENOS AIRES
23	ARG	MALVINAS ARGENTINAS	BUENOS AIRES
24	ARG	VICENTE LOPEZ	BUENOS AIRES
25	ARG	BERAZATEGUI	BUENOS AIRES
26	ARG	CORRIENTES	CORRIENTES
27	ARG	SAN MIGUEL	BUENOS AIRES
28	ARG	BAHIA BLANCA	BUENOS AIRES
29	ARG	ESTEBAN ECHEVERRIA	BUENOS AIRES
30	ARG	RESISTENCIA	CHACO
31	ARG	JOSE C. PAZ	BUENOS AIRES
32	ARG	PARANA	ENTRE RIOS
33	ARG	GODOY CRUZ	MENDOZA
34	ARG	POSADAS	MISIONES
35	ARG	GUAYMALLIN	MENDOZA
36	ARG	SANTIAGO DEL ESTERO	SANTIAGO DEL ESTERO
37	ARG	SAN SALVADOR DE JUJUY	JUJUY
38	ARG	HURLINGHAM	BUENOS AIRES
39	ARG	NEUQUIN	NEUQUÏ¿½N
40	ARG	ITUZAINGI	BUENOS AIRES
41	ARG	SAN FERNANDO	BUENOS AIRES
42	ARG	FORMOSA	FORMOSA
43	ARG	LAS HERAS	MENDOZA
44	ARG	LA RIOJA	LA RIOJA
45	ARG	SAN FERNANDO DEL VALLE DE CATA	CATAMARCA
46	ARG	RIO CUARTO	CORDOBA
47	ARG	COMODORO RIVADAVIA	CHUBUT
48	ARG	MENDOZA	MENDOZA
49	ARG	SAN NICOLÏ¿½S DE LOS ARROYOS	BUENOS AIRES
50	ARG	SAN JUAN	SAN JUAN
51	ARG	ESCOBAR	BUENOS AIRES
52	ARG	CONCORDIA	ENTRE RIOS
53	ARG	PILAR	BUENOS AIRES
54	ARG	SAN LUIS	SAN LUIS
55	ARG	EZEIZA	BUENOS AIRES
56	ARG	SAN RAFAEL	MENDOZA
57	ARG	TANDIL	BUENOS AIRES
1	ARM	YEREVAN	YEREVAN
2	ARM	GJUMRI	IRAK
3	ARM	VANADZOR	LORI
1	ASM	TAFUNA	TUTUILA
2	ASM	FAGATOGO	TUTUILA
1	ATG	SAINT JOHNÏ¿½S	ST JOHN
1	AUS	SYDNEY	NEW SOUTH WALES
2	AUS	MELBOURNE	VICTORIA
3	AUS	BRISBANE	QUEENSLAND
4	AUS	PERTH	WEST AUSTRALIA
5	AUS	ADELAIDE	SOUTH AUSTRALIA
6	AUS	CANBERRA	CAPITAL REGION
7	AUS	GOLD COAST	QUEENSLAND
8	AUS	NEWCASTLE	NEW SOUTH WALES
9	AUS	CENTRAL COAST	NEW SOUTH WALES
10	AUS	WOLLONGONG	NEW SOUTH WALES
11	AUS	HOBART	TASMANIA
12	AUS	GEELONG	VICTORIA
13	AUS	TOWNSVILLE	QUEENSLAND
14	AUS	CAIRNS	QUEENSLAND
1	AUT	WIEN	WIEN
2	AUT	GRAZ	STEIERMARK
3	AUT	LINZ	NORTH AUSTRIA
4	AUT	SALZBURG	SALZBURG
5	AUT	INNSBRUCK	TIROLI
6	AUT	KLAGENFURT	KÏ¿½RNTEN
1	AZE	BAKU	BAKI
2	AZE	GÏ¿½NCÏ¿½	GÏ¿½NCÏ¿½
3	AZE	SUMQAYIT	SUMQAYIT
4	AZE	MINGÏ¿½Ï¿½EVIR	MINGÏ¿½Ï¿½EVIR
1	BDI	BUJUMBURA	BUJUMBURA
1	BEL	ANTWERPEN	ANTWERPEN
2	BEL	GENT	EAST FLANDERI
3	BEL	CHARLEROI	HAINAUT
4	BEL	LIÏ¿½GE	LIÏ¿½GE
5	BEL	BRUXELLES [BRUSSEL]	BRYSSEL
6	BEL	BRUGGE	WEST FLANDERI
7	BEL	SCHAERBEEK	BRYSSEL
8	BEL	NAMUR	NAMUR
9	BEL	MONS	HAINAUT
1	BEN	COTONOU	ATLANTIQUE
2	BEN	PORTO-NOVO	OUÏ¿½MÏ¿½
3	BEN	DJOUGOU	ATACORA
4	BEN	PARAKOU	BORGOU
1	BFA	OUAGADOUGOU	KADIOGO
2	BFA	BOBO-DIOULASSO	HOUET
3	BFA	KOUDOUGOU	BOULKIEMDÏ¿½
1	BGD	DHAKA	DHAKA
2	BGD	CHITTAGONG	CHITTAGONG
3	BGD	KHULNA	KHULNA
4	BGD	RAJSHAHI	RAJSHAHI
5	BGD	NARAYANGANJ	DHAKA
6	BGD	RANGPUR	RAJSHAHI
7	BGD	MYMENSINGH	DHAKA
8	BGD	BARISAL	BARISAL
9	BGD	TUNGI	DHAKA
10	BGD	JESSORE	KHULNA
11	BGD	COMILLA	CHITTAGONG
12	BGD	NAWABGANJ	RAJSHAHI
13	BGD	DINAJPUR	RAJSHAHI
14	BGD	BOGRA	RAJSHAHI
15	BGD	SYLHET	SYLHET
16	BGD	BRAHMANBARIA	CHITTAGONG
17	BGD	TANGAIL	DHAKA
18	BGD	JAMALPUR	DHAKA
19	BGD	PABNA	RAJSHAHI
20	BGD	NAOGAON	RAJSHAHI
21	BGD	SIRAJGANJ	RAJSHAHI
22	BGD	NARSINGHDI	DHAKA
23	BGD	SAIDPUR	RAJSHAHI
24	BGD	GAZIPUR	DHAKA
1	BGR	SOFIJA	GRAD SOFIJA
2	BGR	PLOVDIV	PLOVDIV
3	BGR	VARNA	VARNA
4	BGR	BURGAS	BURGAS
5	BGR	RUSE	RUSE
6	BGR	STARA ZAGORA	HASKOVO
7	BGR	PLEVEN	LOVEC
8	BGR	SLIVEN	BURGAS
9	BGR	DOBRIC	VARNA
10	BGR	Ï¿½UMEN	VARNA
1	BHR	AL-MANAMA	AL-MANAMA
1	BHS	NASSAU	NEW PROVIDENCE
1	BIH	SARAJEVO	FEDERAATIO
2	BIH	BANJA LUKA	REPUBLIKA SRPSKA
3	BIH	ZENICA	FEDERAATIO
1	BLR	MINSK	HORAD MINSK
2	BLR	GOMEL	GOMEL
3	BLR	MOGILJOV	MOGILJOV
4	BLR	VITEBSK	VITEBSK
5	BLR	GRODNO	GRODNO
6	BLR	BREST	BREST
7	BLR	BOBRUISK	MOGILJOV
8	BLR	BARANOVITÏ¿½I	BREST
9	BLR	BORISOV	MINSK
10	BLR	PINSK	BREST
11	BLR	ORÏ¿½A	VITEBSK
12	BLR	MOZYR	GOMEL
13	BLR	NOVOPOLOTSK	VITEBSK
14	BLR	LIDA	GRODNO
15	BLR	SOLIGORSK	MINSK
16	BLR	MOLODETÏ¿½NO	MINSK
1	BLZ	BELIZE CITY	BELIZE CITY
2	BLZ	BELMOPAN	CAYO
1	BMU	SAINT GEORGE	SAINT GEORGEÏ¿½S
2	BMU	HAMILTON	HAMILTON
1	BOL	SANTA CRUZ DE LA SIERRA	SANTA CRUZ
2	BOL	LA PAZ	LA PAZ
3	BOL	EL ALTO	LA PAZ
4	BOL	COCHABAMBA	COCHABAMBA
5	BOL	ORURO	ORURO
6	BOL	SUCRE	CHUQUISACA
7	BOL	POTOSÏ¿½	POTOSÏ¿½
8	BOL	TARIJA	TARIJA
1	BRA	SAO PAULO	SAO PAULO
2	BRA	RIO DE JANEIRO	RIO DE JANEIRO
3	BRA	SALVADOR	BAHIA
4	BRA	BELO HORIZONTE	MINAS GERAIS
5	BRA	FORTALEZA	CEARÏ¿½
6	BRA	BRASÏ¿½LIA	DISTRITO FEDERAL
7	BRA	CURITIBA	PARANÏ¿½
8	BRA	RECIFE	PERNAMBUCO
9	BRA	PORTO ALEGRE	RIO GRANDE DO SUL
10	BRA	MANAUS	AMAZONAS
11	BRA	BELÏ¿½M	PARÏ¿½
12	BRA	GUARULHOS	SAO PAULO
13	BRA	GOIÏ¿½NIA	GOIÏ¿½S
14	BRA	CAMPINAS	SAO PAULO
15	BRA	SÏ¿½O GONÏ¿½ALO	RIO DE JANEIRO
16	BRA	NOVA IGUAÏ¿½U	RIO DE JANEIRO
17	BRA	SÏ¿½O LUÏ¿½S	MARANHÏ¿½O
18	BRA	MACEIÏ¿½	ALAGOAS
19	BRA	DUQUE DE CAXIAS	RIO DE JANEIRO
20	BRA	SÏ¿½O BERNARDO DO CAMPO	SAO PAULO
21	BRA	TERESINA	PIAUÏ¿½
22	BRA	NATAL	RIO GRANDE DO NORTE
23	BRA	OSASCO	SAO PAULO
24	BRA	CAMPO GRANDE	MATO GROSSO DO SUL
25	BRA	SANTO ANDRÏ¿½	SAO PAULO
26	BRA	JOÏ¿½O PESSOA	PARAÏ¿½BA
27	BRA	JABOATÏ¿½O DOS GUARARAPES	PERNAMBUCO
28	BRA	CONTAGEM	MINAS GERAIS
29	BRA	SÏ¿½O JOSÏ¿½ DOS CAMPOS	SAO PAULO
30	BRA	UBERLÏ¿½NDIA	MINAS GERAIS
31	BRA	FEIRA DE SANTANA	BAHIA
32	BRA	RIBEIRÏ¿½O PRETO	SAO PAULO
33	BRA	SOROCABA	SAO PAULO
34	BRA	NITERÏ¿½I	RIO DE JANEIRO
35	BRA	CUIABÏ¿½	MATO GROSSO
36	BRA	JUIZ DE FORA	MINAS GERAIS
37	BRA	ARACAJU	SERGIPE
38	BRA	SÏ¿½O JOÏ¿½O DE MERITI	RIO DE JANEIRO
39	BRA	LONDRINA	PARANÏ¿½
40	BRA	JOINVILLE	SANTA CATARINA
41	BRA	BELFORD ROXO	RIO DE JANEIRO
42	BRA	SANTOS	SAO PAULO
43	BRA	ANANINDEUA	PARÏ¿½
44	BRA	CAMPOS DOS GOYTACAZES	RIO DE JANEIRO
45	BRA	MAUÏ¿½	SAO PAULO
46	BRA	CARAPICUÏ¿½BA	SAO PAULO
47	BRA	OLINDA	PERNAMBUCO
48	BRA	CAMPINA GRANDE	PARAÏ¿½BA
49	BRA	SÏ¿½O JOSÏ¿½ DO RIO PRETO	SAO PAULO
50	BRA	CAXIAS DO SUL	RIO GRANDE DO SUL
51	BRA	MOJI DAS CRUZES	SAO PAULO
52	BRA	DIADEMA	SAO PAULO
53	BRA	APARECIDA DE GOIÏ¿½NIA	GOIÏ¿½S
54	BRA	PIRACICABA	SAO PAULO
55	BRA	CARIACICA	ESPÏ¿½RITO SANTO
56	BRA	VILA VELHA	ESPÏ¿½RITO SANTO
57	BRA	PELOTAS	RIO GRANDE DO SUL
58	BRA	BAURU	SAO PAULO
59	BRA	PORTO VELHO	RONDÏ¿½NIA
60	BRA	SERRA	ESPÏ¿½RITO SANTO
61	BRA	BETIM	MINAS GERAIS
62	BRA	JUNDÏ¿½AÏ¿½	SAO PAULO
63	BRA	CANOAS	RIO GRANDE DO SUL
64	BRA	FRANCA	SAO PAULO
65	BRA	SÏ¿½O VICENTE	SAO PAULO
66	BRA	MARINGÏ¿½	PARANÏ¿½
67	BRA	MONTES CLAROS	MINAS GERAIS
68	BRA	ANÏ¿½POLIS	GOIÏ¿½S
69	BRA	FLORIANÏ¿½POLIS	SANTA CATARINA
70	BRA	PETRÏ¿½POLIS	RIO DE JANEIRO
71	BRA	ITAQUAQUECETUBA	SAO PAULO
72	BRA	VITÏ¿½RIA	ESPÏ¿½RITO SANTO
73	BRA	PONTA GROSSA	PARANÏ¿½
74	BRA	RIO BRANCO	ACRE
75	BRA	FOZ DO IGUAÏ¿½U	PARANÏ¿½
76	BRA	MACAPÏ¿½	AMAPÏ¿½
77	BRA	ILHÏ¿½US	BAHIA
78	BRA	VITÏ¿½RIA DA CONQUISTA	BAHIA
79	BRA	UBERABA	MINAS GERAIS
80	BRA	PAULISTA	PERNAMBUCO
81	BRA	LIMEIRA	SAO PAULO
82	BRA	BLUMENAU	SANTA CATARINA
83	BRA	CARUARU	PERNAMBUCO
84	BRA	SANTARÏ¿½M	PARÏ¿½
85	BRA	VOLTA REDONDA	RIO DE JANEIRO
86	BRA	NOVO HAMBURGO	RIO GRANDE DO SUL
87	BRA	CAUCAIA	CEARÏ¿½
88	BRA	SANTA MARIA	RIO GRANDE DO SUL
89	BRA	CASCAVEL	PARANÏ¿½
90	BRA	GUARUJÏ¿½	SAO PAULO
91	BRA	RIBEIRÏ¿½O DAS NEVES	MINAS GERAIS
92	BRA	GOVERNADOR VALADARES	MINAS GERAIS
93	BRA	TAUBATÏ¿½	SAO PAULO
94	BRA	IMPERATRIZ	MARANHÏ¿½O
95	BRA	GRAVATAÏ¿½	RIO GRANDE DO SUL
96	BRA	EMBU	SAO PAULO
97	BRA	MOSSORÏ¿½	RIO GRANDE DO NORTE
98	BRA	VÏ¿½RZEA GRANDE	MATO GROSSO
99	BRA	PETROLINA	PERNAMBUCO
100	BRA	BARUERI	SAO PAULO
101	BRA	VIAMÏ¿½O	RIO GRANDE DO SUL
102	BRA	IPATINGA	MINAS GERAIS
103	BRA	JUAZEIRO	BAHIA
104	BRA	JUAZEIRO DO NORTE	CEARÏ¿½
105	BRA	TABOÏ¿½O DA SERRA	SAO PAULO
106	BRA	SÏ¿½O JOSÏ¿½ DOS PINHAIS	PARANÏ¿½
107	BRA	MAGÏ¿½	RIO DE JANEIRO
108	BRA	SUZANO	SAO PAULO
109	BRA	SÏ¿½O LEOPOLDO	RIO GRANDE DO SUL
110	BRA	MARÏ¿½LIA	SAO PAULO
111	BRA	SÏ¿½O CARLOS	SAO PAULO
112	BRA	SUMARÏ¿½	SAO PAULO
113	BRA	PRESIDENTE PRUDENTE	SAO PAULO
114	BRA	DIVINÏ¿½POLIS	MINAS GERAIS
115	BRA	SETE LAGOAS	MINAS GERAIS
116	BRA	RIO GRANDE	RIO GRANDE DO SUL
117	BRA	ITABUNA	BAHIA
118	BRA	JEQUIÏ¿½	BAHIA
119	BRA	ARAPIRACA	ALAGOAS
120	BRA	COLOMBO	PARANÏ¿½
121	BRA	AMERICANA	SAO PAULO
122	BRA	ALVORADA	RIO GRANDE DO SUL
123	BRA	ARARAQUARA	SAO PAULO
124	BRA	ITABORAÏ¿½	RIO DE JANEIRO
125	BRA	SANTA BÏ¿½RBARA DÏ¿½OESTE	SAO PAULO
126	BRA	NOVA FRIBURGO	RIO DE JANEIRO
127	BRA	JACAREÏ¿½	SAO PAULO
128	BRA	ARAÏ¿½ATUBA	SAO PAULO
129	BRA	BARRA MANSA	RIO DE JANEIRO
130	BRA	PRAIA GRANDE	SAO PAULO
131	BRA	MARABÏ¿½	PARÏ¿½
132	BRA	CRICIÏ¿½MA	SANTA CATARINA
133	BRA	BOA VISTA	RORAIMA
134	BRA	PASSO FUNDO	RIO GRANDE DO SUL
135	BRA	DOURADOS	MATO GROSSO DO SUL
136	BRA	SANTA LUZIA	MINAS GERAIS
137	BRA	RIO CLARO	SAO PAULO
138	BRA	MARACANAÏ¿½	CEARÏ¿½
139	BRA	GUARAPUAVA	PARANÏ¿½
140	BRA	RONDONÏ¿½POLIS	MATO GROSSO
141	BRA	SÏ¿½O JOSÏ¿½	SANTA CATARINA
142	BRA	CACHOEIRO DE ITAPEMIRIM	ESPÏ¿½RITO SANTO
143	BRA	NILÏ¿½POLIS	RIO DE JANEIRO
144	BRA	ITAPEVI	SAO PAULO
145	BRA	CABO DE SANTO AGOSTINHO	PERNAMBUCO
146	BRA	CAMAÏ¿½ARI	BAHIA
147	BRA	SOBRAL	CEARÏ¿½
148	BRA	ITAJAÏ¿½	SANTA CATARINA
149	BRA	CHAPECÏ¿½	SANTA CATARINA
150	BRA	COTIA	SAO PAULO
151	BRA	LAGES	SANTA CATARINA
152	BRA	FERRAZ DE VASCONCELOS	SAO PAULO
153	BRA	INDAIATUBA	SAO PAULO
154	BRA	HORTOLÏ¿½NDIA	SAO PAULO
155	BRA	CAXIAS	MARANHÏ¿½O
156	BRA	SÏ¿½O CAETANO DO SUL	SAO PAULO
157	BRA	ITU	SAO PAULO
158	BRA	NOSSA SENHORA DO SOCORRO	SERGIPE
159	BRA	PARNAÏ¿½BA	PIAUÏ¿½
160	BRA	POÏ¿½OS DE CALDAS	MINAS GERAIS
161	BRA	TERESÏ¿½POLIS	RIO DE JANEIRO
162	BRA	BARREIRAS	BAHIA
163	BRA	CASTANHAL	PARÏ¿½
164	BRA	ALAGOINHAS	BAHIA
165	BRA	ITAPECERICA DA SERRA	SAO PAULO
166	BRA	URUGUAIANA	RIO GRANDE DO SUL
167	BRA	PARANAGUÏ¿½	PARANÏ¿½
168	BRA	IBIRITÏ¿½	MINAS GERAIS
169	BRA	TIMON	MARANHÏ¿½O
170	BRA	LUZIÏ¿½NIA	GOIÏ¿½S
171	BRA	MACAÏ¿½	RIO DE JANEIRO
172	BRA	TEÏ¿½FILO OTONI	MINAS GERAIS
173	BRA	MOJI-GUAÏ¿½U	SAO PAULO
174	BRA	PALMAS	TOCANTINS
175	BRA	PINDAMONHANGABA	SAO PAULO
176	BRA	FRANCISCO MORATO	SAO PAULO
177	BRA	BAGÏ¿½	RIO GRANDE DO SUL
178	BRA	SAPUCAIA DO SUL	RIO GRANDE DO SUL
179	BRA	CABO FRIO	RIO DE JANEIRO
180	BRA	ITAPETININGA	SAO PAULO
181	BRA	PATOS DE MINAS	MINAS GERAIS
182	BRA	CAMARAGIBE	PERNAMBUCO
183	BRA	BRAGANÏ¿½A PAULISTA	SAO PAULO
184	BRA	QUEIMADOS	RIO DE JANEIRO
185	BRA	ARAGUAÏ¿½NA	TOCANTINS
186	BRA	GARANHUNS	PERNAMBUCO
187	BRA	VITÏ¿½RIA DE SANTO ANTÏ¿½O	PERNAMBUCO
188	BRA	SANTA RITA	PARAÏ¿½BA
189	BRA	BARBACENA	MINAS GERAIS
190	BRA	ABAETETUBA	PARÏ¿½
191	BRA	JAÏ¿½	SAO PAULO
192	BRA	LAURO DE FREITAS	BAHIA
193	BRA	FRANCO DA ROCHA	SAO PAULO
194	BRA	TEIXEIRA DE FREITAS	BAHIA
195	BRA	VARGINHA	MINAS GERAIS
196	BRA	RIBEIRÏ¿½O PIRES	SAO PAULO
197	BRA	SABARÏ¿½	MINAS GERAIS
198	BRA	CATANDUVA	SAO PAULO
199	BRA	RIO VERDE	GOIÏ¿½S
200	BRA	BOTUCATU	SAO PAULO
201	BRA	COLATINA	ESPÏ¿½RITO SANTO
202	BRA	SANTA CRUZ DO SUL	RIO GRANDE DO SUL
203	BRA	LINHARES	ESPÏ¿½RITO SANTO
204	BRA	APUCARANA	PARANÏ¿½
205	BRA	BARRETOS	SAO PAULO
206	BRA	GUARATINGUETÏ¿½	SAO PAULO
207	BRA	CACHOEIRINHA	RIO GRANDE DO SUL
208	BRA	CODÏ¿½	MARANHÏ¿½O
209	BRA	JARAGUÏ¿½ DO SUL	SANTA CATARINA
210	BRA	CUBATÏ¿½O	SAO PAULO
211	BRA	ITABIRA	MINAS GERAIS
212	BRA	ITAITUBA	PARÏ¿½
213	BRA	ARARAS	SAO PAULO
214	BRA	RESENDE	RIO DE JANEIRO
215	BRA	ATIBAIA	SAO PAULO
216	BRA	POUSO ALEGRE	MINAS GERAIS
217	BRA	TOLEDO	PARANÏ¿½
218	BRA	CRATO	CEARÏ¿½
219	BRA	PASSOS	MINAS GERAIS
220	BRA	ARAGUARI	MINAS GERAIS
221	BRA	SÏ¿½O JOSÏ¿½ DE RIBAMAR	MARANHÏ¿½O
222	BRA	PINHAIS	PARANÏ¿½
223	BRA	SERTÏ¿½OZINHO	SAO PAULO
224	BRA	CONSELHEIRO LAFAIETE	MINAS GERAIS
225	BRA	PAULO AFONSO	BAHIA
226	BRA	ANGRA DOS REIS	RIO DE JANEIRO
227	BRA	EUNÏ¿½POLIS	BAHIA
228	BRA	SALTO	SAO PAULO
229	BRA	OURINHOS	SAO PAULO
230	BRA	PARNAMIRIM	RIO GRANDE DO NORTE
231	BRA	JACOBINA	BAHIA
232	BRA	CORONEL FABRICIANO	MINAS GERAIS
233	BRA	BIRIGUI	SAO PAULO
234	BRA	TATUÏ¿½	SAO PAULO
235	BRA	JI-PARANÏ¿½	RONDÏ¿½NIA
236	BRA	BACABAL	MARANHÏ¿½O
237	BRA	CAMETÏ¿½	PARÏ¿½
238	BRA	GUAÏ¿½BA	RIO GRANDE DO SUL
239	BRA	SÏ¿½O LOURENÏ¿½O DA MATA	PERNAMBUCO
240	BRA	SANTANA DO LIVRAMENTO	RIO GRANDE DO SUL
241	BRA	VOTORANTIM	SAO PAULO
242	BRA	CAMPO LARGO	PARANÏ¿½
243	BRA	PATOS	PARAÏ¿½BA
244	BRA	ITUIUTABA	MINAS GERAIS
245	BRA	CORUMBÏ¿½	MATO GROSSO DO SUL
246	BRA	PALHOÏ¿½A	SANTA CATARINA
247	BRA	BARRA DO PIRAÏ¿½	RIO DE JANEIRO
248	BRA	BENTO GONÏ¿½ALVES	RIO GRANDE DO SUL
249	BRA	POÏ¿½	SAO PAULO
250	BRA	Ï¿½GUAS LINDAS DE GOIÏ¿½S	GOIÏ¿½S
1	BRB	BRIDGETOWN	ST MICHAEL
1	BRN	BANDAR SERI BEGAWAN	BRUNEI AND MUARA
1	BTN	THIMPHU	THIMPHU
1	BWA	GABORONE	GABORONE
2	BWA	FRANCISTOWN	FRANCISTOWN
1	CAF	BANGUI	BANGUI
1	CAN	MONTRÏ¿½AL	QUÏ¿½BEC
2	CAN	CALGARY	ALBERTA
3	CAN	TORONTO	ONTARIO
4	CAN	NORTH YORK	ONTARIO
5	CAN	WINNIPEG	MANITOBA
6	CAN	EDMONTON	ALBERTA
7	CAN	MISSISSAUGA	ONTARIO
8	CAN	SCARBOROUGH	ONTARIO
9	CAN	VANCOUVER	BRITISH COLOMBIA
10	CAN	ETOBICOKE	ONTARIO
11	CAN	LONDON	ONTARIO
12	CAN	HAMILTON	ONTARIO
13	CAN	OTTAWA	ONTARIO
14	CAN	LAVAL	QUÏ¿½BEC
15	CAN	SURREY	BRITISH COLOMBIA
16	CAN	BRAMPTON	ONTARIO
17	CAN	WINDSOR	ONTARIO
18	CAN	SASKATOON	SASKATCHEWAN
19	CAN	KITCHENER	ONTARIO
20	CAN	MARKHAM	ONTARIO
21	CAN	REGINA	SASKATCHEWAN
22	CAN	BURNABY	BRITISH COLOMBIA
23	CAN	QUÏ¿½BEC	QUÏ¿½BEC
24	CAN	YORK	ONTARIO
25	CAN	RICHMOND	BRITISH COLOMBIA
26	CAN	VAUGHAN	ONTARIO
27	CAN	BURLINGTON	ONTARIO
28	CAN	OSHAWA	ONTARIO
29	CAN	OAKVILLE	ONTARIO
30	CAN	SAINT CATHARINES	ONTARIO
31	CAN	LONGUEUIL	QUÏ¿½BEC
32	CAN	RICHMOND HILL	ONTARIO
33	CAN	THUNDER BAY	ONTARIO
34	CAN	NEPEAN	ONTARIO
35	CAN	CAPE BRETON	NOVA SCOTIA
36	CAN	EAST YORK	ONTARIO
37	CAN	HALIFAX	NOVA SCOTIA
38	CAN	CAMBRIDGE	ONTARIO
39	CAN	GLOUCESTER	ONTARIO
40	CAN	ABBOTSFORD	BRITISH COLOMBIA
41	CAN	GUELPH	ONTARIO
42	CAN	SAINT JOHNÏ¿½S	NEWFOUNDLAND
43	CAN	COQUITLAM	BRITISH COLOMBIA
44	CAN	SAANICH	BRITISH COLOMBIA
45	CAN	GATINEAU	QUÏ¿½BEC
46	CAN	DELTA	BRITISH COLOMBIA
47	CAN	SUDBURY	ONTARIO
48	CAN	KELOWNA	BRITISH COLOMBIA
49	CAN	BARRIE	ONTARIO
1	CCK	BANTAM	HOME ISLAND
2	CCK	WEST ISLAND	WEST ISLAND
1	CHE	ZÏ¿½RICH	ZÏ¿½RICH
2	CHE	GENEVE	GENEVE
3	CHE	BASEL	BASEL-STADT
4	CHE	BERN	BERN
5	CHE	LAUSANNE	VAUD
1	CHL	SANTIAGO DE CHILE	SANTIAGO
2	CHL	PUENTE ALTO	SANTIAGO
3	CHL	VIÏ¿½A DEL MAR	VALPARAÏ¿½SO
4	CHL	VALPARAÏ¿½SO	VALPARAÏ¿½SO
5	CHL	TALCAHUANO	BÏ¿½OBÏ¿½O
6	CHL	ANTOFAGASTA	ANTOFAGASTA
7	CHL	SAN BERNARDO	SANTIAGO
8	CHL	TEMUCO	LA ARAUCANÏ¿½A
9	CHL	CONCEPCIÏ¿½N	BÏ¿½OBÏ¿½O
10	CHL	RANCAGUA	OÏ¿½HIGGINS
11	CHL	ARICA	TARAPACÏ¿½
12	CHL	TALCA	MAULE
13	CHL	CHILLÏ¿½N	BÏ¿½OBÏ¿½O
14	CHL	IQUIQUE	TARAPACÏ¿½
15	CHL	LOS ANGELES	BÏ¿½OBÏ¿½O
16	CHL	PUERTO MONTT	LOS LAGOS
17	CHL	COQUIMBO	COQUIMBO
18	CHL	OSORNO	LOS LAGOS
19	CHL	LA SERENA	COQUIMBO
20	CHL	CALAMA	ANTOFAGASTA
21	CHL	VALDIVIA	LOS LAGOS
22	CHL	PUNTA ARENAS	MAGALLANES
23	CHL	COPIAPÏ¿½	ATACAMA
24	CHL	QUILPUÏ¿½	VALPARAÏ¿½SO
25	CHL	CURICÏ¿½	MAULE
26	CHL	OVALLE	COQUIMBO
27	CHL	CORONEL	BÏ¿½OBÏ¿½O
28	CHL	SAN PEDRO DE LA PAZ	BÏ¿½OBÏ¿½O
29	CHL	MELIPILLA	SANTIAGO
1	CHN	SHANGHAI	SHANGHAI
2	CHN	PEKING	PEKING
3	CHN	CHONGQING	CHONGQING
4	CHN	TIANJIN	TIANJIN
5	CHN	WUHAN	HUBEI
6	CHN	HARBIN	HEILONGJIANG
7	CHN	SHENYANG	LIAONING
8	CHN	KANTON [GUANGZHOU]	GUANGDONG
9	CHN	CHENGDU	SICHUAN
10	CHN	NANKING [NANJING]	JIANGSU
11	CHN	CHANGCHUN	JILIN
12	CHN	XIÏ¿½AN	SHAANXI
13	CHN	DALIAN	LIAONING
14	CHN	QINGDAO	SHANDONG
15	CHN	JINAN	SHANDONG
16	CHN	HANGZHOU	ZHEJIANG
17	CHN	ZHENGZHOU	HENAN
18	CHN	SHIJIAZHUANG	HEBEI
19	CHN	TAIYUAN	SHANXI
20	CHN	KUNMING	YUNNAN
21	CHN	CHANGSHA	HUNAN
22	CHN	NANCHANG	JIANGXI
23	CHN	FUZHOU	FUJIAN
24	CHN	LANZHOU	GANSU
25	CHN	GUIYANG	GUIZHOU
26	CHN	NINGBO	ZHEJIANG
27	CHN	HEFEI	ANHUI
28	CHN	URUMTÏ¿½I [Ï¿½RÏ¿½MQI]	XINXIANG
29	CHN	ANSHAN	LIAONING
30	CHN	FUSHUN	LIAONING
31	CHN	NANNING	GUANGXI
32	CHN	ZIBO	SHANDONG
33	CHN	QIQIHAR	HEILONGJIANG
34	CHN	JILIN	JILIN
35	CHN	TANGSHAN	HEBEI
36	CHN	BAOTOU	INNER MONGOLIA
37	CHN	SHENZHEN	GUANGDONG
38	CHN	HOHHOT	INNER MONGOLIA
39	CHN	HANDAN	HEBEI
40	CHN	WUXI	JIANGSU
41	CHN	XUZHOU	JIANGSU
42	CHN	DATONG	SHANXI
43	CHN	YICHUN	HEILONGJIANG
44	CHN	BENXI	LIAONING
45	CHN	LUOYANG	HENAN
46	CHN	SUZHOU	JIANGSU
47	CHN	XINING	QINGHAI
48	CHN	HUAINAN	ANHUI
49	CHN	JIXI	HEILONGJIANG
50	CHN	DAQING	HEILONGJIANG
51	CHN	FUXIN	LIAONING
52	CHN	AMOY [XIAMEN]	FUJIAN
53	CHN	LIUZHOU	GUANGXI
54	CHN	SHANTOU	GUANGDONG
55	CHN	JINZHOU	LIAONING
56	CHN	MUDANJIANG	HEILONGJIANG
57	CHN	YINCHUAN	NINGXIA
58	CHN	CHANGZHOU	JIANGSU
59	CHN	ZHANGJIAKOU	HEBEI
60	CHN	DANDONG	LIAONING
61	CHN	HEGANG	HEILONGJIANG
62	CHN	KAIFENG	HENAN
63	CHN	JIAMUSI	HEILONGJIANG
64	CHN	LIAOYANG	LIAONING
65	CHN	HENGYANG	HUNAN
66	CHN	BAODING	HEBEI
67	CHN	HUNJIANG	JILIN
68	CHN	XINXIANG	HENAN
69	CHN	HUANGSHI	HUBEI
70	CHN	HAIKOU	HAINAN
71	CHN	YANTAI	SHANDONG
72	CHN	BENGBU	ANHUI
73	CHN	XIANGTAN	HUNAN
74	CHN	WEIFANG	SHANDONG
75	CHN	WUHU	ANHUI
76	CHN	PINGXIANG	JIANGXI
77	CHN	YINGKOU	LIAONING
78	CHN	ANYANG	HENAN
79	CHN	PANZHIHUA	SICHUAN
80	CHN	PINGDINGSHAN	HENAN
81	CHN	XIANGFAN	HUBEI
82	CHN	ZHUZHOU	HUNAN
83	CHN	JIAOZUO	HENAN
84	CHN	WENZHOU	ZHEJIANG
85	CHN	ZHANGJIANG	GUANGDONG
86	CHN	ZIGONG	SICHUAN
87	CHN	SHUANGYASHAN	HEILONGJIANG
88	CHN	ZAOZHUANG	SHANDONG
89	CHN	YAKESHI	INNER MONGOLIA
90	CHN	YICHANG	HUBEI
91	CHN	ZHENJIANG	JIANGSU
92	CHN	HUAIBEI	ANHUI
93	CHN	QINHUANGDAO	HEBEI
94	CHN	GUILIN	GUANGXI
95	CHN	LIUPANSHUI	GUIZHOU
96	CHN	PANJIN	LIAONING
97	CHN	YANGQUAN	SHANXI
98	CHN	JINXI	LIAONING
99	CHN	LIAOYUAN	JILIN
100	CHN	LIANYUNGANG	JIANGSU
101	CHN	XIANYANG	SHAANXI
102	CHN	TAIÏ¿½AN	SHANDONG
103	CHN	CHIFENG	INNER MONGOLIA
104	CHN	SHAOGUAN	GUANGDONG
105	CHN	NANTONG	JIANGSU
106	CHN	LESHAN	SICHUAN
107	CHN	BAOJI	SHAANXI
108	CHN	LINYI	SHANDONG
109	CHN	TONGHUA	JILIN
110	CHN	SIPING	JILIN
111	CHN	CHANGZHI	SHANXI
112	CHN	TENGZHOU	SHANDONG
113	CHN	CHAOZHOU	GUANGDONG
114	CHN	YANGZHOU	JIANGSU
115	CHN	DONGWAN	GUANGDONG
116	CHN	MAÏ¿½ANSHAN	ANHUI
117	CHN	FOSHAN	GUANGDONG
118	CHN	YUEYANG	HUNAN
119	CHN	XINGTAI	HEBEI
120	CHN	CHANGDE	HUNAN
121	CHN	SHIHEZI	XINXIANG
122	CHN	YANCHENG	JIANGSU
123	CHN	JIUJIANG	JIANGXI
124	CHN	DONGYING	SHANDONG
125	CHN	SHASHI	HUBEI
126	CHN	XINTAI	SHANDONG
127	CHN	JINGDEZHEN	JIANGXI
128	CHN	TONGCHUAN	SHAANXI
129	CHN	ZHONGSHAN	GUANGDONG
130	CHN	SHIYAN	HUBEI
131	CHN	TIELI	HEILONGJIANG
132	CHN	JINING	SHANDONG
133	CHN	WUHAI	INNER MONGOLIA
134	CHN	MIANYANG	SICHUAN
135	CHN	LUZHOU	SICHUAN
136	CHN	ZUNYI	GUIZHOU
137	CHN	SHIZUISHAN	NINGXIA
138	CHN	NEIJIANG	SICHUAN
139	CHN	TONGLIAO	INNER MONGOLIA
140	CHN	TIELING	LIAONING
141	CHN	WAFANGDIAN	LIAONING
142	CHN	ANQING	ANHUI
143	CHN	SHAOYANG	HUNAN
144	CHN	LAIWU	SHANDONG
145	CHN	CHENGDE	HEBEI
146	CHN	TIANSHUI	GANSU
147	CHN	NANYANG	HENAN
148	CHN	CANGZHOU	HEBEI
149	CHN	YIBIN	SICHUAN
150	CHN	HUAIYIN	JIANGSU
151	CHN	DUNHUA	JILIN
152	CHN	YANJI	JILIN
153	CHN	JIANGMEN	GUANGDONG
154	CHN	TONGLING	ANHUI
155	CHN	SUIHUA	HEILONGJIANG
156	CHN	GONGZILING	JILIN
157	CHN	XIANTAO	HUBEI
158	CHN	CHAOYANG	LIAONING
159	CHN	GANZHOU	JIANGXI
160	CHN	HUZHOU	ZHEJIANG
161	CHN	BAICHENG	JILIN
162	CHN	SHANGZI	HEILONGJIANG
163	CHN	YANGJIANG	GUANGDONG
164	CHN	QITAIHE	HEILONGJIANG
165	CHN	GEJIU	YUNNAN
166	CHN	JIANGYIN	JIANGSU
167	CHN	HEBI	HENAN
168	CHN	JIAXING	ZHEJIANG
169	CHN	WUZHOU	GUANGXI
170	CHN	MEIHEKOU	JILIN
171	CHN	XUCHANG	HENAN
172	CHN	LIAOCHENG	SHANDONG
173	CHN	HAICHENG	LIAONING
174	CHN	QIANJIANG	HUBEI
175	CHN	BAIYIN	GANSU
176	CHN	BEIÏ¿½AN	HEILONGJIANG
177	CHN	YIXING	JIANGSU
178	CHN	LAIZHOU	SHANDONG
179	CHN	QARAMAY	XINXIANG
180	CHN	ACHENG	HEILONGJIANG
181	CHN	DEZHOU	SHANDONG
182	CHN	NANPING	FUJIAN
183	CHN	ZHAOQING	GUANGDONG
184	CHN	BEIPIAO	LIAONING
185	CHN	FENGCHENG	JIANGXI
186	CHN	FUYU	JILIN
187	CHN	XINYANG	HENAN
188	CHN	DONGTAI	JIANGSU
189	CHN	YUCI	SHANXI
190	CHN	HONGHU	HUBEI
191	CHN	EZHOU	HUBEI
192	CHN	HEZE	SHANDONG
193	CHN	DAXIAN	SICHUAN
194	CHN	LINFEN	SHANXI
195	CHN	TIANMEN	HUBEI
196	CHN	YIYANG	HUNAN
197	CHN	QUANZHOU	FUJIAN
198	CHN	RIZHAO	SHANDONG
199	CHN	DEYANG	SICHUAN
200	CHN	GUANGYUAN	SICHUAN
201	CHN	CHANGSHU	JIANGSU
202	CHN	ZHANGZHOU	FUJIAN
203	CHN	HAILAR	INNER MONGOLIA
204	CHN	NANCHONG	SICHUAN
205	CHN	JIUTAI	JILIN
206	CHN	ZHAODONG	HEILONGJIANG
207	CHN	SHAOXING	ZHEJIANG
208	CHN	FUYANG	ANHUI
209	CHN	MAOMING	GUANGDONG
210	CHN	QUJING	YUNNAN
211	CHN	GHULJA	XINXIANG
212	CHN	JIAOHE	JILIN
213	CHN	PUYANG	HENAN
214	CHN	HUADIAN	JILIN
215	CHN	JIANGYOU	SICHUAN
216	CHN	QASHQAR	XINXIANG
217	CHN	ANSHUN	GUIZHOU
218	CHN	FULING	SICHUAN
219	CHN	XINYU	JIANGXI
220	CHN	HANZHONG	SHAANXI
221	CHN	DANYANG	JIANGSU
222	CHN	CHENZHOU	HUNAN
223	CHN	XIAOGAN	HUBEI
224	CHN	SHANGQIU	HENAN
225	CHN	ZHUHAI	GUANGDONG
226	CHN	QINGYUAN	GUANGDONG
227	CHN	AQSU	XINXIANG
228	CHN	JINING	INNER MONGOLIA
229	CHN	XIAOSHAN	ZHEJIANG
230	CHN	ZAOYANG	HUBEI
231	CHN	XINGHUA	JIANGSU
232	CHN	HAMI	XINXIANG
233	CHN	HUIZHOU	GUANGDONG
234	CHN	JINMEN	HUBEI
235	CHN	SANMING	FUJIAN
236	CHN	ULANHOT	INNER MONGOLIA
237	CHN	KORLA	XINXIANG
238	CHN	WANXIAN	SICHUAN
239	CHN	RUIÏ¿½AN	ZHEJIANG
240	CHN	ZHOUSHAN	ZHEJIANG
241	CHN	LIANGCHENG	SHANDONG
242	CHN	JIAOZHOU	SHANDONG
243	CHN	TAIZHOU	JIANGSU
244	CHN	SUZHOU	ANHUI
245	CHN	YICHUN	JIANGXI
246	CHN	TAONAN	JILIN
247	CHN	PINGDU	SHANDONG
248	CHN	JIÏ¿½AN	JIANGXI
249	CHN	LONGKOU	SHANDONG
250	CHN	LANGFANG	HEBEI
251	CHN	ZHOUKOU	HENAN
252	CHN	SUINING	SICHUAN
253	CHN	YULIN	GUANGXI
254	CHN	JINHUA	ZHEJIANG
255	CHN	LIUÏ¿½AN	ANHUI
256	CHN	SHUANGCHENG	HEILONGJIANG
257	CHN	SUIZHOU	HUBEI
258	CHN	ANKANG	SHAANXI
259	CHN	WEINAN	SHAANXI
260	CHN	LONGJING	JILIN
261	CHN	DAÏ¿½AN	JILIN
262	CHN	LENGSHUIJIANG	HUNAN
263	CHN	LAIYANG	SHANDONG
264	CHN	XIANNING	HUBEI
265	CHN	DALI	YUNNAN
266	CHN	ANDA	HEILONGJIANG
267	CHN	JINCHENG	SHANXI
268	CHN	LONGYAN	FUJIAN
269	CHN	XICHANG	SICHUAN
270	CHN	WENDENG	SHANDONG
271	CHN	HAILUN	HEILONGJIANG
272	CHN	BINZHOU	SHANDONG
273	CHN	LINHE	INNER MONGOLIA
274	CHN	WUWEI	GANSU
275	CHN	DUYUN	GUIZHOU
276	CHN	MISHAN	HEILONGJIANG
277	CHN	SHANGRAO	JIANGXI
278	CHN	CHANGJI	XINXIANG
279	CHN	MEIXIAN	GUANGDONG
280	CHN	YUSHU	JILIN
281	CHN	TIEFA	LIAONING
282	CHN	HUAIÏ¿½AN	JIANGSU
283	CHN	LEIYANG	HUNAN
284	CHN	ZALANTUN	INNER MONGOLIA
285	CHN	WEIHAI	SHANDONG
286	CHN	LOUDI	HUNAN
287	CHN	QINGZHOU	SHANDONG
288	CHN	QIDONG	JIANGSU
289	CHN	HUAIHUA	HUNAN
290	CHN	LUOHE	HENAN
291	CHN	CHUZHOU	ANHUI
292	CHN	KAIYUAN	LIAONING
293	CHN	LINQING	SHANDONG
294	CHN	CHAOHU	ANHUI
295	CHN	LAOHEKOU	HUBEI
296	CHN	DUJIANGYAN	SICHUAN
297	CHN	ZHUMADIAN	HENAN
298	CHN	LINCHUAN	JIANGXI
299	CHN	JIAONAN	SHANDONG
300	CHN	SANMENXIA	HENAN
301	CHN	HEYUAN	GUANGDONG
302	CHN	MANZHOULI	INNER MONGOLIA
303	CHN	LHASA	TIBET
304	CHN	LIANYUAN	HUNAN
305	CHN	KUYTUN	XINXIANG
306	CHN	PUQI	HUBEI
307	CHN	HONGJIANG	HUNAN
308	CHN	QINZHOU	GUANGXI
309	CHN	RENQIU	HEBEI
310	CHN	YUYAO	ZHEJIANG
311	CHN	GUIGANG	GUANGXI
312	CHN	KAILI	GUIZHOU
313	CHN	YANÏ¿½AN	SHAANXI
314	CHN	BEIHAI	GUANGXI
315	CHN	XUANGZHOU	ANHUI
316	CHN	QUZHOU	ZHEJIANG
317	CHN	YONGÏ¿½AN	FUJIAN
318	CHN	ZIXING	HUNAN
319	CHN	LIYANG	JIANGSU
320	CHN	YIZHENG	JIANGSU
321	CHN	YUMEN	GANSU
322	CHN	LILING	HUNAN
323	CHN	YUNCHENG	SHANXI
324	CHN	SHANWEI	GUANGDONG
325	CHN	CIXI	ZHEJIANG
326	CHN	YUANJIANG	HUNAN
327	CHN	BOZHOU	ANHUI
328	CHN	JINCHANG	GANSU
329	CHN	FUÏ¿½AN	FUJIAN
330	CHN	SUQIAN	JIANGSU
331	CHN	SHISHOU	HUBEI
332	CHN	HENGSHUI	HEBEI
333	CHN	DANJIANGKOU	HUBEI
334	CHN	FUJIN	HEILONGJIANG
335	CHN	SANYA	HAINAN
336	CHN	GUANGSHUI	HUBEI
337	CHN	HUANGSHAN	ANHUI
338	CHN	XINGCHENG	LIAONING
339	CHN	ZHUCHENG	SHANDONG
340	CHN	KUNSHAN	JIANGSU
341	CHN	HAINING	ZHEJIANG
342	CHN	PINGLIANG	GANSU
343	CHN	FUQING	FUJIAN
344	CHN	XINZHOU	SHANXI
345	CHN	JIEYANG	GUANGDONG
346	CHN	ZHANGJIAGANG	JIANGSU
347	CHN	TONG XIAN	PEKING
348	CHN	YAÏ¿½AN	SICHUAN
349	CHN	JINZHOU	LIAONING
350	CHN	EMEISHAN	SICHUAN
351	CHN	ENSHI	HUBEI
352	CHN	BOSE	GUANGXI
353	CHN	YUZHOU	HENAN
354	CHN	KAIYUAN	YUNNAN
355	CHN	TUMEN	JILIN
356	CHN	PUTIAN	FUJIAN
357	CHN	LINHAI	ZHEJIANG
358	CHN	XILIN HOT	INNER MONGOLIA
359	CHN	SHAOWU	FUJIAN
360	CHN	JUNAN	SHANDONG
361	CHN	HUAYING	SICHUAN
362	CHN	PINGYI	SHANDONG
363	CHN	HUANGYAN	ZHEJIANG
1	CIV	ABIDJAN	ABIDJAN
2	CIV	BOUAKÏ¿½	BOUAKÏ¿½
3	CIV	YAMOUSSOUKRO	YAMOUSSOUKRO
4	CIV	DALOA	DALOA
5	CIV	KORHOGO	KORHOGO
1	CMR	DOUALA	LITTORAL
2	CMR	YAOUNDÏ¿½	CENTRE
3	CMR	GAROUA	NORD
4	CMR	MAROUA	EXTRÏ¿½ME-NORD
5	CMR	BAMENDA	NORD-OUEST
6	CMR	BAFOUSSAM	OUEST
7	CMR	NKONGSAMBA	LITTORAL
1	COD	KINSHASA	KINSHASA
2	COD	LUBUMBASHI	SHABA
3	COD	MBUJI-MAYI	EAST KASAI
4	COD	KOLWEZI	SHABA
5	COD	KISANGANI	HAUTE-ZAÏ¿½RE
6	COD	KANANGA	WEST KASAI
7	COD	LIKASI	SHABA
8	COD	BUKAVU	SOUTH KIVU
9	COD	KIKWIT	BANDUNDU
10	COD	TSHIKAPA	WEST KASAI
11	COD	MATADI	BAS-ZAÏ¿½RE
12	COD	MBANDAKA	EQUATEUR
13	COD	MWENE-DITU	EAST KASAI
14	COD	BOMA	BAS-ZAÏ¿½RE
15	COD	UVIRA	SOUTH KIVU
16	COD	BUTEMBO	NORTH KIVU
17	COD	GOMA	NORTH KIVU
18	COD	KALEMIE	SHABA
1	COG	BRAZZAVILLE	BRAZZAVILLE
2	COG	POINTE-NOIRE	KOUILOU
1	COK	AVARUA	RAROTONGA
1	COL	SANTAFE DE BOGOTA	SANTAFÏ¿½ DE BOGOTÏ¿
2	COL	CALI	VALLE
3	COL	MEDELLIN	ANTIOQUIA
4	COL	BARRANQUILLA	ATLÏ¿½NTICO
5	COL	CARTAGENA	BOLÏ¿½VAR
6	COL	CUCUTA	NORTE DE SANTANDER
7	COL	BUCARAMANGA	SANTANDER
8	COL	IBAGUI	TOLIMA
9	COL	PEREIRA	RISARALDA
10	COL	SANTA MARTA	MAGDALENA
11	COL	MANIZALES	CALDAS
12	COL	BELLO	ANTIOQUIA
13	COL	PASTO	NARIÏ¿½O
14	COL	NEIVA	HUILA
15	COL	SOLEDAD	ATLÏ¿½NTICO
16	COL	ARMENIA	QUINDÏ¿½O
17	COL	VILLAVICENCIO	META
18	COL	SOACHA	CUNDINAMARCA
19	COL	VALLEDUPAR	CESAR
20	COL	MONTERIA	CÏ¿½RDOBA
21	COL	ITAGII	ANTIOQUIA
22	COL	PALMIRA	VALLE
23	COL	BUENAVENTURA	VALLE
24	COL	FLORIDABLANCA	SANTANDER
25	COL	SINCELEJO	SUCRE
26	COL	POPAYAN	CAUCA
27	COL	BARRANCABERMEJA	SANTANDER
28	COL	DOS QUEBRADAS	RISARALDA
29	COL	TULUI	VALLE
30	COL	ENVIGADO	ANTIOQUIA
31	COL	CARTAGO	VALLE
32	COL	GIRARDOT	CUNDINAMARCA
33	COL	BUGA	VALLE
34	COL	TUNJA	BOYACÏ¿½
35	COL	FLORENCIA	CAQUETÏ¿½
36	COL	MAICAO	LA GUAJIRA
37	COL	SOGAMOSO	BOYACÏ¿½
38	COL	GIRON	SANTANDER
1	COM	MORONI	NJAZIDJA
1	CPV	PRAIA	SÏ¿½O TIAGO
1	CRI	SAN JOSE	SAN JOSÏ¿½
1	CUB	LA HABANA	LA HABANA
2	CUB	SANTIAGO DE CUBA	SANTIAGO DE CUBA
3	CUB	CAMAGIEY	CAMAGÏ¿½EY
4	CUB	HOLGUIN	HOLGUÏ¿½N
5	CUB	SANTA CLARA	VILLA CLARA
6	CUB	GUANTINAMO	GUANTÏ¿½NAMO
7	CUB	PINAR DEL RIO	PINAR DEL RÏ¿½O
8	CUB	BAYAMO	GRANMA
9	CUB	CIENFUEGOS	CIENFUEGOS
10	CUB	VICTORIA DE LAS TUNAS	LAS TUNAS
11	CUB	MATANZAS	MATANZAS
12	CUB	MANZANILLO	GRANMA
13	CUB	SANCTI-SPIRITUS	SANCTI-SPÏ¿½RITUS
14	CUB	CIEGO DE IVILA	CIEGO DE Ï¿½VILA
1	CXR	FLYING FISH COVE	Ï¿½
1	CYM	GEORGE TOWN	GRAND CAYMAN
1	CYP	NICOSIA	NICOSIA
2	CYP	LIMASSOL	LIMASSOL
1	CZE	PRAHA	HLAVNÏ¿½ MESTO PRAHA
2	CZE	BRNO	JIZNÏ¿½ MORAVA
3	CZE	OSTRAVA	SEVERNÏ¿½ MORAVA
4	CZE	PLZEN	ZAPADNÏ¿½ CECHY
5	CZE	OLOMOUC	SEVERNÏ¿½ MORAVA
6	CZE	LIBEREC	SEVERNÏ¿½ CECHY
7	CZE	CESKÏ¿½ BUDEJOVICE	JIZNÏ¿½ CECHY
8	CZE	HRADEC KRÏ¿½LOVÏ¿½	VÏ¿½CHODNÏ¿½ CECHY
9	CZE	Ï¿½STÏ¿½ NAD LABEM	SEVERNÏ¿½ CECHY
10	CZE	PARDUBICE	VÏ¿½CHODNÏ¿½ CECHY
1	DEU	BERLIN	BERLIINI
2	DEU	HAMBURG	HAMBURG
3	DEU	MUNICH [MÏ¿½NCHEN]	BAIJERI
4	DEU	KÏ¿½LN	NORDRHEIN-WESTFALEN
5	DEU	FRANKFURT AM MAIN	HESSEN
6	DEU	ESSEN	NORDRHEIN-WESTFALEN
7	DEU	DORTMUND	NORDRHEIN-WESTFALEN
8	DEU	STUTTGART	BADEN-WÏ¿½RTTEMBERG
9	DEU	DÏ¿½SSELDORF	NORDRHEIN-WESTFALEN
10	DEU	BREMEN	BREMEN
11	DEU	DUISBURG	NORDRHEIN-WESTFALEN
12	DEU	HANNOVER	NIEDERSACHSEN
13	DEU	LEIPZIG	SAKSI
14	DEU	NÏ¿½RNBERG	BAIJERI
15	DEU	DRESDEN	SAKSI
16	DEU	BOCHUM	NORDRHEIN-WESTFALEN
17	DEU	WUPPERTAL	NORDRHEIN-WESTFALEN
18	DEU	BIELEFELD	NORDRHEIN-WESTFALEN
19	DEU	MANNHEIM	BADEN-WÏ¿½RTTEMBERG
20	DEU	BONN	NORDRHEIN-WESTFALEN
21	DEU	GELSENKIRCHEN	NORDRHEIN-WESTFALEN
22	DEU	KARLSRUHE	BADEN-WÏ¿½RTTEMBERG
23	DEU	WIESBADEN	HESSEN
24	DEU	MÏ¿½NSTER	NORDRHEIN-WESTFALEN
25	DEU	MÏ¿½NCHENGLADBACH	NORDRHEIN-WESTFALEN
26	DEU	CHEMNITZ	SAKSI
27	DEU	AUGSBURG	BAIJERI
28	DEU	HALLE/SAALE	ANHALT SACHSEN
29	DEU	BRAUNSCHWEIG	NIEDERSACHSEN
30	DEU	AACHEN	NORDRHEIN-WESTFALEN
31	DEU	KREFELD	NORDRHEIN-WESTFALEN
32	DEU	MAGDEBURG	ANHALT SACHSEN
33	DEU	KIEL	SCHLESWIG-HOLSTEIN
34	DEU	OBERHAUSEN	NORDRHEIN-WESTFALEN
35	DEU	LÏ¿½BECK	SCHLESWIG-HOLSTEIN
36	DEU	HAGEN	NORDRHEIN-WESTFALEN
37	DEU	ROSTOCK	MECKLENBURG-VORPOMME
38	DEU	FREIBURG IM BREISGAU	BADEN-WÏ¿½RTTEMBERG
39	DEU	ERFURT	THÏ¿½RINGEN
40	DEU	KASSEL	HESSEN
41	DEU	SAARBRÏ¿½CKEN	SAARLAND
42	DEU	MAINZ	RHEINLAND-PFALZ
43	DEU	HAMM	NORDRHEIN-WESTFALEN
44	DEU	HERNE	NORDRHEIN-WESTFALEN
45	DEU	MÏ¿½LHEIM AN DER RUHR	NORDRHEIN-WESTFALEN
46	DEU	SOLINGEN	NORDRHEIN-WESTFALEN
47	DEU	OSNABRÏ¿½CK	NIEDERSACHSEN
48	DEU	LUDWIGSHAFEN AM RHEIN	RHEINLAND-PFALZ
49	DEU	LEVERKUSEN	NORDRHEIN-WESTFALEN
50	DEU	OLDENBURG	NIEDERSACHSEN
51	DEU	NEUSS	NORDRHEIN-WESTFALEN
52	DEU	HEIDELBERG	BADEN-WÏ¿½RTTEMBERG
53	DEU	DARMSTADT	HESSEN
54	DEU	PADERBORN	NORDRHEIN-WESTFALEN
55	DEU	POTSDAM	BRANDENBURG
56	DEU	WÏ¿½RZBURG	BAIJERI
57	DEU	REGENSBURG	BAIJERI
58	DEU	RECKLINGHAUSEN	NORDRHEIN-WESTFALEN
59	DEU	GÏ¿½TTINGEN	NIEDERSACHSEN
60	DEU	BREMERHAVEN	BREMEN
61	DEU	WOLFSBURG	NIEDERSACHSEN
62	DEU	BOTTROP	NORDRHEIN-WESTFALEN
63	DEU	REMSCHEID	NORDRHEIN-WESTFALEN
64	DEU	HEILBRONN	BADEN-WÏ¿½RTTEMBERG
65	DEU	PFORZHEIM	BADEN-WÏ¿½RTTEMBERG
66	DEU	OFFENBACH AM MAIN	HESSEN
67	DEU	ULM	BADEN-WÏ¿½RTTEMBERG
68	DEU	INGOLSTADT	BAIJERI
69	DEU	GERA	THÏ¿½RINGEN
70	DEU	SALZGITTER	NIEDERSACHSEN
71	DEU	COTTBUS	BRANDENBURG
72	DEU	REUTLINGEN	BADEN-WÏ¿½RTTEMBERG
73	DEU	FÏ¿½RTH	BAIJERI
74	DEU	SIEGEN	NORDRHEIN-WESTFALEN
75	DEU	KOBLENZ	RHEINLAND-PFALZ
76	DEU	MOERS	NORDRHEIN-WESTFALEN
77	DEU	BERGISCH GLADBACH	NORDRHEIN-WESTFALEN
78	DEU	ZWICKAU	SAKSI
79	DEU	HILDESHEIM	NIEDERSACHSEN
80	DEU	WITTEN	NORDRHEIN-WESTFALEN
81	DEU	SCHWERIN	MECKLENBURG-VORPOMME
82	DEU	ERLANGEN	BAIJERI
83	DEU	KAISERSLAUTERN	RHEINLAND-PFALZ
84	DEU	TRIER	RHEINLAND-PFALZ
85	DEU	JENA	THÏ¿½RINGEN
86	DEU	ISERLOHN	NORDRHEIN-WESTFALEN
87	DEU	GÏ¿½TERSLOH	NORDRHEIN-WESTFALEN
88	DEU	MARL	NORDRHEIN-WESTFALEN
89	DEU	LÏ¿½NEN	NORDRHEIN-WESTFALEN
90	DEU	DÏ¿½REN	NORDRHEIN-WESTFALEN
91	DEU	RATINGEN	NORDRHEIN-WESTFALEN
92	DEU	VELBERT	NORDRHEIN-WESTFALEN
93	DEU	ESSLINGEN AM NECKAR	BADEN-WÏ¿½RTTEMBERG
1	DJI	DJIBOUTI	DJIBOUTI
1	DMA	ROSEAU	ST GEORGE
1	DNK	KÏ¿½BENHAVN	KÏ¿½BENHAVN
2	DNK	Ï¿½RHUS	Ï¿½RHUS
3	DNK	ODENSE	FYN
4	DNK	AALBORG	NORDJYLLAND
5	DNK	FREDERIKSBERG	FREDERIKSBERG
1	DOM	SANTO DOMINGO DE GUZMÏ¿½N	DISTRITO NACIONAL
2	DOM	SANTIAGO DE LOS CABALLEROS	SANTIAGO
3	DOM	LA ROMANA	LA ROMANA
4	DOM	SAN PEDRO DE MACORÏ¿½S	SAN PEDRO DE MACORÏ¿
5	DOM	SAN FRANCISCO DE MACORÏ¿½S	DUARTE
6	DOM	SAN FELIPE DE PUERTO PLATA	PUERTO PLATA
1	DZA	ALGER	ALGER
2	DZA	ORAN	ORAN
3	DZA	CONSTANTINE	CONSTANTINE
4	DZA	ANNABA	ANNABA
5	DZA	BATNA	BATNA
6	DZA	SÏ¿½TIF	SÏ¿½TIF
7	DZA	SIDI BEL ABBÏ¿½S	SIDI BEL ABBÏ¿½S
8	DZA	SKIKDA	SKIKDA
9	DZA	BISKRA	BISKRA
10	DZA	BLIDA (EL-BOULAIDA)	BLIDA
11	DZA	BÏ¿½JAÏ¿½A	BÏ¿½JAÏ¿½A
12	DZA	MOSTAGANEM	MOSTAGANEM
13	DZA	TÏ¿½BESSA	TÏ¿½BESSA
14	DZA	TLEMCEN (TILIMSEN)	TLEMCEN
15	DZA	BÏ¿½CHAR	BÏ¿½CHAR
16	DZA	TIARET	TIARET
17	DZA	ECH-CHLEFF (EL-ASNAM)	CHLEF
18	DZA	GHARDAÏ¿½A	GHARDAÏ¿½A
1	ECU	GUAYAQUIL	GUAYAS
2	ECU	QUITO	PICHINCHA
3	ECU	CUENCA	AZUAY
4	ECU	MACHALA	EL ORO
5	ECU	SANTO DOMINGO DE LOS COLORADOS	PICHINCHA
6	ECU	PORTOVIEJO	MANABÏ¿½
7	ECU	AMBATO	TUNGURAHUA
8	ECU	MANTA	MANABÏ¿½
9	ECU	DURAN [ELOY ALFARO]	GUAYAS
10	ECU	IBARRA	IMBABURA
11	ECU	QUEVEDO	LOS RÏ¿½OS
12	ECU	MILAGRO	GUAYAS
13	ECU	LOJA	LOJA
14	ECU	RIOBAMBA	CHIMBORAZO
15	ECU	ESMERALDAS	ESMERALDAS
1	EGY	CAIRO	KAIRO
2	EGY	ALEXANDRIA	ALEKSANDRIA
3	EGY	GIZA	GIZA
4	EGY	SHUBRA AL-KHAYMA	AL-QALYUBIYA
5	EGY	PORT SAID	PORT SAID
6	EGY	SUEZ	SUEZ
7	EGY	AL-MAHALLAT AL-KUBRA	AL-GHARBIYA
8	EGY	TANTA	AL-GHARBIYA
9	EGY	AL-MANSURA	AL-DAQAHLIYA
10	EGY	LUXOR	LUXOR
11	EGY	ASYUT	ASYUT
12	EGY	BAHTIM	AL-QALYUBIYA
13	EGY	ZAGAZIG	AL-SHARQIYA
14	EGY	AL-FAIYUM	AL-FAIYUM
15	EGY	ISMAILIA	ISMAILIA
16	EGY	KAFR AL-DAWWAR	AL-BUHAYRA
17	EGY	ASSUAN	ASSUAN
18	EGY	DAMANHUR	AL-BUHAYRA
19	EGY	AL-MINYA	AL-MINYA
20	EGY	BANI SUWAYF	BANI SUWAYF
21	EGY	QINA	QINA
22	EGY	SAWHAJ	SAWHAJ
23	EGY	SHIBIN AL-KAWM	AL-MINUFIYA
24	EGY	BULAQ AL-DAKRUR	GIZA
25	EGY	BANHA	AL-QALYUBIYA
26	EGY	WARRAQ AL-ARAB	GIZA
27	EGY	KAFR AL-SHAYKH	KAFR AL-SHAYKH
28	EGY	MALLAWI	AL-MINYA
29	EGY	BILBAYS	AL-SHARQIYA
30	EGY	MIT GHAMR	AL-DAQAHLIYA
31	EGY	AL-ARISH	SHAMAL SINA
32	EGY	TALKHA	AL-DAQAHLIYA
33	EGY	QALYUB	AL-QALYUBIYA
34	EGY	JIRJA	SAWHAJ
35	EGY	IDFU	QINA
36	EGY	AL-HAWAMIDIYA	GIZA
37	EGY	DISUQ	KAFR AL-SHAYKH
1	ERI	ASMARA	MAEKEL
1	ESH	EL-AAIÏ¿½N	EL-AAIÏ¿½N
1	ESP	MADRID	MADRID
2	ESP	BARCELONA	KATALONIA
3	ESP	VALENCIA	VALENCIA
4	ESP	SEVILLA	ANDALUSIA
5	ESP	ZARAGOZA	ARAGONIA
6	ESP	MÏ¿½LAGA	ANDALUSIA
7	ESP	BILBAO	BASKIMAA
8	ESP	LAS PALMAS DE GRAN CANARIA	CANARY ISLANDS
9	ESP	MURCIA	MURCIA
10	ESP	PALMA DE MALLORCA	BALEARS
11	ESP	VALLADOLID	CASTILLA AND LEÏ¿½N
12	ESP	CÏ¿½RDOBA	ANDALUSIA
13	ESP	VIGO	GALICIA
14	ESP	ALICANTE [ALACANT]	VALENCIA
15	ESP	GIJÏ¿½N	ASTURIA
16	ESP	LÏ¿½HOSPITALET DE LLOBREGAT	KATALONIA
17	ESP	GRANADA	ANDALUSIA
18	ESP	A CORUÏ¿½A (LA CORUÏ¿½A)	GALICIA
19	ESP	VITORIA-GASTEIZ	BASKIMAA
20	ESP	SANTA CRUZ DE TENERIFE	CANARY ISLANDS
21	ESP	BADALONA	KATALONIA
22	ESP	OVIEDO	ASTURIA
23	ESP	MÏ¿½STOLES	MADRID
24	ESP	ELCHE [ELX]	VALENCIA
25	ESP	SABADELL	KATALONIA
26	ESP	SANTANDER	CANTABRIA
27	ESP	JEREZ DE LA FRONTERA	ANDALUSIA
28	ESP	PAMPLONA [IRUÏ¿½A]	NAVARRA
29	ESP	DONOSTIA-SAN SEBASTIÏ¿½N	BASKIMAA
30	ESP	CARTAGENA	MURCIA
31	ESP	LEGANÏ¿½S	MADRID
32	ESP	FUENLABRADA	MADRID
33	ESP	ALMERÏ¿½A	ANDALUSIA
34	ESP	TERRASSA	KATALONIA
35	ESP	ALCALÏ¿½ DE HENARES	MADRID
36	ESP	BURGOS	CASTILLA AND LEÏ¿½N
37	ESP	SALAMANCA	CASTILLA AND LEÏ¿½N
38	ESP	ALBACETE	KASTILIA-LA MANCHA
39	ESP	GETAFE	MADRID
40	ESP	CÏ¿½DIZ	ANDALUSIA
41	ESP	ALCORCÏ¿½N	MADRID
42	ESP	HUELVA	ANDALUSIA
43	ESP	LEÏ¿½N	CASTILLA AND LEÏ¿½N
44	ESP	CASTELLÏ¿½N DE LA PLANA [CASTELL	VALENCIA
45	ESP	BADAJOZ	EXTREMADURA
46	ESP	[SAN CRISTÏ¿½BAL DE] LA LAGUNA	CANARY ISLANDS
47	ESP	LOGROÏ¿½O	LA RIOJA
48	ESP	SANTA COLOMA DE GRAMENET	KATALONIA
49	ESP	TARRAGONA	KATALONIA
50	ESP	LLEIDA (LÏ¿½RIDA)	KATALONIA
51	ESP	JAÏ¿½N	ANDALUSIA
52	ESP	OURENSE (ORENSE)	GALICIA
53	ESP	MATARÏ¿½	KATALONIA
54	ESP	ALGECIRAS	ANDALUSIA
55	ESP	MARBELLA	ANDALUSIA
56	ESP	BARAKALDO	BASKIMAA
57	ESP	DOS HERMANAS	ANDALUSIA
58	ESP	SANTIAGO DE COMPOSTELA	GALICIA
59	ESP	TORREJÏ¿½N DE ARDOZ	MADRID
1	EST	TALLINN	HARJUMAA
2	EST	TARTU	TARTUMAA
1	ETH	ADDIS ABEBA	ADDIS ABEBA
2	ETH	DIRE DAWA	DIRE DAWA
3	ETH	NAZRET	OROMIA
4	ETH	GONDER	AMHARA
5	ETH	DESE	AMHARA
6	ETH	MEKELE	TIGRAY
7	ETH	BAHIR DAR	AMHARA
1	FIN	HELSINKI [HELSINGFORS]	NEWMAA
2	FIN	ESPOO	NEWMAA
3	FIN	TAMPERE	PIRKANMAA
4	FIN	VANTAA	NEWMAA
5	FIN	TURKU [Ï¿½BO]	VARSINAIS-SUOMI
6	FIN	OULU	POHJOIS-POHJANMAA
7	FIN	LAHTI	PÏ¿½IJÏ¿½T-HÏ¿½ME
1	FJI	SUVA	CENTRAL
1	FLK	STANLEY	EAST FALKLAND
1	FRA	PARIS	Ï¿½LE-DE-FRANCE
2	FRA	MARSEILLE	PROVENCE-ALPES-CÏ¿½T
3	FRA	LYON	RHÏ¿½NE-ALPES
4	FRA	TOULOUSE	MIDI-PYRÏ¿½NÏ¿½ES
5	FRA	NICE	PROVENCE-ALPES-CÏ¿½T
6	FRA	NANTES	PAYS DE LA LOIRE
7	FRA	STRASBOURG	ALSACE
8	FRA	MONTPELLIER	LANGUEDOC-ROUSSILLON
9	FRA	BORDEAUX	AQUITAINE
10	FRA	RENNES	HAUTE-NORMANDIE
11	FRA	LE HAVRE	CHAMPAGNE-ARDENNE
12	FRA	REIMS	NORD-PAS-DE-CALAIS
13	FRA	LILLE	RHÏ¿½NE-ALPES
14	FRA	ST-Ï¿½TIENNE	BRETAGNE
15	FRA	TOULON	PROVENCE-ALPES-CÏ¿½T
16	FRA	GRENOBLE	RHÏ¿½NE-ALPES
17	FRA	ANGERS	PAYS DE LA LOIRE
18	FRA	DIJON	BOURGOGNE
19	FRA	BREST	BRETAGNE
20	FRA	LE MANS	PAYS DE LA LOIRE
21	FRA	CLERMONT-FERRAND	AUVERGNE
22	FRA	AMIENS	PICARDIE
23	FRA	AIX-EN-PROVENCE	PROVENCE-ALPES-CÏ¿½T
24	FRA	LIMOGES	LIMOUSIN
25	FRA	NÏ¿½MES	LANGUEDOC-ROUSSILLON
26	FRA	TOURS	CENTRE
27	FRA	VILLEURBANNE	RHÏ¿½NE-ALPES
28	FRA	METZ	LORRAINE
29	FRA	BESANÏ¿½ON	FRANCHE-COMTÏ¿½
30	FRA	CAEN	BASSE-NORMANDIE
31	FRA	ORLÏ¿½ANS	CENTRE
32	FRA	MULHOUSE	ALSACE
33	FRA	ROUEN	HAUTE-NORMANDIE
34	FRA	BOULOGNE-BILLANCOURT	Ï¿½LE-DE-FRANCE
35	FRA	PERPIGNAN	LANGUEDOC-ROUSSILLON
36	FRA	NANCY	LORRAINE
37	FRA	ROUBAIX	NORD-PAS-DE-CALAIS
38	FRA	ARGENTEUIL	Ï¿½LE-DE-FRANCE
39	FRA	TOURCOING	NORD-PAS-DE-CALAIS
40	FRA	MONTREUIL	Ï¿½LE-DE-FRANCE
1	FRO	TÏ¿½RSHAVN	STREYMOYAR
1	FSM	WENO	CHUUK
2	FSM	PALIKIR	POHNPEI
1	GAB	LIBREVILLE	ESTUAIRE
1	GBR	LONDON	ENGLAND
2	GBR	BIRMINGHAM	ENGLAND
3	GBR	GLASGOW	SCOTLAND
4	GBR	LIVERPOOL	ENGLAND
5	GBR	EDINBURGH	SCOTLAND
6	GBR	SHEFFIELD	ENGLAND
7	GBR	MANCHESTER	ENGLAND
8	GBR	LEEDS	ENGLAND
9	GBR	BRISTOL	ENGLAND
10	GBR	CARDIFF	WALES
11	GBR	COVENTRY	ENGLAND
12	GBR	LEICESTER	ENGLAND
13	GBR	BRADFORD	ENGLAND
14	GBR	BELFAST	NORTH IRELAND
15	GBR	NOTTINGHAM	ENGLAND
16	GBR	KINGSTON UPON HULL	ENGLAND
17	GBR	PLYMOUTH	ENGLAND
18	GBR	STOKE-ON-TRENT	ENGLAND
19	GBR	WOLVERHAMPTON	ENGLAND
20	GBR	DERBY	ENGLAND
21	GBR	SWANSEA	WALES
22	GBR	SOUTHAMPTON	ENGLAND
23	GBR	ABERDEEN	SCOTLAND
24	GBR	NORTHAMPTON	ENGLAND
25	GBR	DUDLEY	ENGLAND
26	GBR	PORTSMOUTH	ENGLAND
27	GBR	NEWCASTLE UPON TYNE	ENGLAND
28	GBR	SUNDERLAND	ENGLAND
29	GBR	LUTON	ENGLAND
30	GBR	SWINDON	ENGLAND
31	GBR	SOUTHEND-ON-SEA	ENGLAND
32	GBR	WALSALL	ENGLAND
33	GBR	BOURNEMOUTH	ENGLAND
34	GBR	PETERBOROUGH	ENGLAND
35	GBR	BRIGHTON	ENGLAND
36	GBR	BLACKPOOL	ENGLAND
37	GBR	DUNDEE	SCOTLAND
38	GBR	WEST BROMWICH	ENGLAND
39	GBR	READING	ENGLAND
40	GBR	OLDBURY/SMETHWICK (WARLEY)	ENGLAND
41	GBR	MIDDLESBROUGH	ENGLAND
42	GBR	HUDDERSFIELD	ENGLAND
43	GBR	OXFORD	ENGLAND
44	GBR	POOLE	ENGLAND
45	GBR	BOLTON	ENGLAND
46	GBR	BLACKBURN	ENGLAND
47	GBR	NEWPORT	WALES
48	GBR	PRESTON	ENGLAND
49	GBR	STOCKPORT	ENGLAND
50	GBR	NORWICH	ENGLAND
51	GBR	ROTHERHAM	ENGLAND
52	GBR	CAMBRIDGE	ENGLAND
53	GBR	WATFORD	ENGLAND
54	GBR	IPSWICH	ENGLAND
55	GBR	SLOUGH	ENGLAND
56	GBR	EXETER	ENGLAND
57	GBR	CHELTENHAM	ENGLAND
58	GBR	GLOUCESTER	ENGLAND
59	GBR	SAINT HELENS	ENGLAND
60	GBR	SUTTON COLDFIELD	ENGLAND
61	GBR	YORK	ENGLAND
62	GBR	OLDHAM	ENGLAND
63	GBR	BASILDON	ENGLAND
64	GBR	WORTHING	ENGLAND
65	GBR	CHELMSFORD	ENGLAND
66	GBR	COLCHESTER	ENGLAND
67	GBR	CRAWLEY	ENGLAND
68	GBR	GILLINGHAM	ENGLAND
69	GBR	SOLIHULL	ENGLAND
70	GBR	ROCHDALE	ENGLAND
71	GBR	BIRKENHEAD	ENGLAND
72	GBR	WORCESTER	ENGLAND
73	GBR	HARTLEPOOL	ENGLAND
74	GBR	HALIFAX	ENGLAND
75	GBR	WOKING/BYFLEET	ENGLAND
76	GBR	SOUTHPORT	ENGLAND
77	GBR	MAIDSTONE	ENGLAND
78	GBR	EASTBOURNE	ENGLAND
79	GBR	GRIMSBY	ENGLAND
80	GBR	SAINT HELIER	JERSEY
81	GBR	DOUGLAS	Ï¿½
1	GEO	TBILISI	TBILISI
2	GEO	KUTAISI	IMERETI
3	GEO	RUSTAVI	KVEMO KARTLI
4	GEO	BATUMI	ADZARIA [ATÏ¿½ARA]
5	GEO	SOHUMI	ABHASIA [APHAZETI]
1	GHA	ACCRA	GREATER ACCRA
2	GHA	KUMASI	ASHANTI
3	GHA	TAMALE	NORTHERN
4	GHA	TEMA	GREATER ACCRA
5	GHA	SEKONDI-TAKORADI	WESTERN
1	GIB	GIBRALTAR	Ï¿½
1	GIN	CONAKRY	CONAKRY
1	GLP	LES ABYMES	GRANDE-TERRE
2	GLP	BASSE-TERRE	BASSE-TERRE
1	GMB	SEREKUNDA	KOMBO ST MARY
2	GMB	BANJUL	BANJUL
1	GNB	BISSAU	BISSAU
1	GNQ	MALABO	BIOKO
1	GRC	ATHENAI	ATTIKA
2	GRC	THESSALONIKI	CENTRAL MACEDONIA
3	GRC	PIREUS	ATTIKA
4	GRC	PATRAS	WEST GREECE
5	GRC	PERISTERION	ATTIKA
6	GRC	HERAKLEION	CRETE
7	GRC	KALLITHEA	ATTIKA
8	GRC	LARISA	THESSALIA
1	GRD	SAINT GEORGEÏ¿½S	ST GEORGE
1	GRL	NUUK	KITAA
1	GTM	CIUDAD DE GUATEMALA	GUATEMALA
2	GTM	MIXCO	GUATEMALA
3	GTM	VILLA NUEVA	GUATEMALA
4	GTM	QUETZALTENANGO	QUETZALTENANGO
1	GUF	CAYENNE	CAYENNE
1	GUM	TAMUNING	Ï¿½
2	GUM	AGAÏ¿½A	Ï¿½
1	GUY	GEORGETOWN	GEORGETOWN
1	HKG	KOWLOON AND NEW KOWLOON	KOWLOON AND NEW KOWL
2	HKG	VICTORIA	HONGKONG
1	HND	TEGUCIGALPA	DISTRITO CENTRAL
2	HND	SAN PEDRO SULA	CORTÏ¿½S
3	HND	LA CEIBA	ATLÏ¿½NTIDA
1	HRV	ZAGREB	GRAD ZAGREB
2	HRV	SPLIT	SPLIT-DALMATIA
3	HRV	RIJEKA	PRIMORJE-GORSKI KOTA
4	HRV	OSIJEK	OSIJEK-BARANJA
1	HTI	PORT-AU-PRINCE	OUEST
2	HTI	CARREFOUR	OUEST
3	HTI	DELMAS	OUEST
4	HTI	LE-CAP-HAÏ¿½TIEN	NORD
1	HUN	BUDAPEST	BUDAPEST
2	HUN	DEBRECEN	HAJDÏ¿½-BIHAR
3	HUN	MISKOLC	BORSOD-ABAÏ¿½J-ZEMPL
4	HUN	SZEGED	CSONGRÏ¿½D
5	HUN	PÏ¿½CS	BARANYA
6	HUN	GYÏ¿½R	GYÏ¿½R-MOSON-SOPRON
7	HUN	NYIREGYHÏ¿½ZA	SZABOLCS-SZATMÏ¿½R-B
8	HUN	KECSKEMÏ¿½T	BÏ¿½CS-KISKUN
9	HUN	SZÏ¿½KESFEHÏ¿½RVÏ¿½R	FEJÏ¿½R
1	IDN	JAKARTA	JAKARTA RAYA
2	IDN	SURABAYA	EAST JAVA
3	IDN	BANDUNG	WEST JAVA
4	IDN	MEDAN	SUMATERA UTARA
5	IDN	PALEMBANG	SUMATERA SELATAN
6	IDN	TANGERANG	WEST JAVA
7	IDN	SEMARANG	CENTRAL JAVA
8	IDN	UJUNG PANDANG	SULAWESI SELATAN
9	IDN	MALANG	EAST JAVA
10	IDN	BANDAR LAMPUNG	LAMPUNG
11	IDN	BEKASI	WEST JAVA
12	IDN	PADANG	SUMATERA BARAT
13	IDN	SURAKARTA	CENTRAL JAVA
14	IDN	BANJARMASIN	KALIMANTAN SELATAN
15	IDN	PEKAN BARU	RIAU
16	IDN	DENPASAR	BALI
17	IDN	YOGYAKARTA	YOGYAKARTA
18	IDN	PONTIANAK	KALIMANTAN BARAT
19	IDN	SAMARINDA	KALIMANTAN TIMUR
20	IDN	JAMBI	JAMBI
21	IDN	DEPOK	WEST JAVA
22	IDN	CIMAHI	WEST JAVA
23	IDN	BALIKPAPAN	KALIMANTAN TIMUR
24	IDN	MANADO	SULAWESI UTARA
25	IDN	MATARAM	NUSA TENGGARA BARAT
26	IDN	PEKALONGAN	CENTRAL JAVA
27	IDN	TEGAL	CENTRAL JAVA
28	IDN	BOGOR	WEST JAVA
29	IDN	CIPUTAT	WEST JAVA
30	IDN	PONDOKGEDE	WEST JAVA
31	IDN	CIREBON	WEST JAVA
32	IDN	KEDIRI	EAST JAVA
33	IDN	AMBON	MOLUKIT
34	IDN	JEMBER	EAST JAVA
35	IDN	CILACAP	CENTRAL JAVA
36	IDN	CIMANGGIS	WEST JAVA
37	IDN	PEMATANG SIANTAR	SUMATERA UTARA
38	IDN	PURWOKERTO	CENTRAL JAVA
39	IDN	CIOMAS	WEST JAVA
40	IDN	TASIKMALAYA	WEST JAVA
41	IDN	MADIUN	EAST JAVA
42	IDN	BENGKULU	BENGKULU
43	IDN	KARAWANG	WEST JAVA
44	IDN	BANDA ACEH	ACEH
45	IDN	PALU	SULAWESI TENGAH
46	IDN	PASURUAN	EAST JAVA
47	IDN	KUPANG	NUSA TENGGARA TIMUR
48	IDN	TEBING TINGGI	SUMATERA UTARA
49	IDN	PERCUT SEI TUAN	SUMATERA UTARA
50	IDN	BINJAI	SUMATERA UTARA
51	IDN	SUKABUMI	WEST JAVA
52	IDN	WARU	EAST JAVA
53	IDN	PANGKAL PINANG	SUMATERA SELATAN
54	IDN	MAGELANG	CENTRAL JAVA
55	IDN	BLITAR	EAST JAVA
56	IDN	SERANG	WEST JAVA
57	IDN	PROBOLINGGO	EAST JAVA
58	IDN	CILEGON	WEST JAVA
59	IDN	CIANJUR	WEST JAVA
60	IDN	CIPARAY	WEST JAVA
61	IDN	LHOKSEUMAWE	ACEH
62	IDN	TAMAN	EAST JAVA
63	IDN	DEPOK	YOGYAKARTA
64	IDN	CITEUREUP	WEST JAVA
65	IDN	PEMALANG	CENTRAL JAVA
66	IDN	KLATEN	CENTRAL JAVA
67	IDN	SALATIGA	CENTRAL JAVA
68	IDN	CIBINONG	WEST JAVA
69	IDN	PALANGKA RAYA	KALIMANTAN TENGAH
70	IDN	MOJOKERTO	EAST JAVA
71	IDN	PURWAKARTA	WEST JAVA
72	IDN	GARUT	WEST JAVA
73	IDN	KUDUS	CENTRAL JAVA
74	IDN	KENDARI	SULAWESI TENGGARA
75	IDN	JAYA PURA	WEST IRIAN
76	IDN	GORONTALO	SULAWESI UTARA
77	IDN	MAJALAYA	WEST JAVA
78	IDN	PONDOK AREN	WEST JAVA
79	IDN	JOMBANG	EAST JAVA
80	IDN	SUNGGAL	SUMATERA UTARA
81	IDN	BATAM	RIAU
82	IDN	PADANG SIDEMPUAN	SUMATERA UTARA
83	IDN	SAWANGAN	WEST JAVA
84	IDN	BANYUWANGI	EAST JAVA
85	IDN	TANJUNG PINANG	RIAU
1	IND	MUMBAI (BOMBAY)	MAHARASHTRA
2	IND	DELHI	DELHI
3	IND	CALCUTTA [KOLKATA]	WEST BENGALI
4	IND	CHENNAI (MADRAS)	TAMIL NADU
5	IND	HYDERABAD	ANDHRA PRADESH
6	IND	AHMEDABAD	GUJARAT
7	IND	BANGALORE	KARNATAKA
8	IND	KANPUR	UTTAR PRADESH
9	IND	NAGPUR	MAHARASHTRA
10	IND	LUCKNOW	UTTAR PRADESH
11	IND	PUNE	MAHARASHTRA
12	IND	SURAT	GUJARAT
13	IND	JAIPUR	RAJASTHAN
14	IND	INDORE	MADHYA PRADESH
15	IND	BHOPAL	MADHYA PRADESH
16	IND	LUDHIANA	PUNJAB
17	IND	VADODARA (BARODA)	GUJARAT
18	IND	KALYAN	MAHARASHTRA
19	IND	MADURAI	TAMIL NADU
20	IND	HAORA (HOWRAH)	WEST BENGALI
21	IND	VARANASI (BENARES)	UTTAR PRADESH
22	IND	PATNA	BIHAR
23	IND	SRINAGAR	JAMMU AND KASHMIR
24	IND	AGRA	UTTAR PRADESH
25	IND	COIMBATORE	TAMIL NADU
26	IND	THANE (THANA)	MAHARASHTRA
27	IND	ALLAHABAD	UTTAR PRADESH
28	IND	MEERUT	UTTAR PRADESH
29	IND	VISHAKHAPATNAM	ANDHRA PRADESH
30	IND	JABALPUR	MADHYA PRADESH
31	IND	AMRITSAR	PUNJAB
32	IND	FARIDABAD	HARYANA
33	IND	VIJAYAWADA	ANDHRA PRADESH
34	IND	GWALIOR	MADHYA PRADESH
35	IND	JODHPUR	RAJASTHAN
36	IND	NASHIK (NASIK)	MAHARASHTRA
37	IND	HUBLI-DHARWAD	KARNATAKA
38	IND	SOLAPUR (SHOLAPUR)	MAHARASHTRA
39	IND	RANCHI	JHARKHAND
40	IND	BAREILLY	UTTAR PRADESH
41	IND	GUWAHATI (GAUHATI)	ASSAM
42	IND	SHAMBAJINAGAR (AURANGABAD)	MAHARASHTRA
43	IND	COCHIN (KOCHI)	KERALA
44	IND	RAJKOT	GUJARAT
45	IND	KOTA	RAJASTHAN
46	IND	THIRUVANANTHAPURAM (TRIVANDRUM	KERALA
47	IND	PIMPRI-CHINCHWAD	MAHARASHTRA
48	IND	JALANDHAR (JULLUNDUR)	PUNJAB
49	IND	GORAKHPUR	UTTAR PRADESH
50	IND	CHANDIGARH	CHANDIGARH
51	IND	MYSORE	KARNATAKA
52	IND	ALIGARH	UTTAR PRADESH
53	IND	GUNTUR	ANDHRA PRADESH
54	IND	JAMSHEDPUR	JHARKHAND
55	IND	GHAZIABAD	UTTAR PRADESH
56	IND	WARANGAL	ANDHRA PRADESH
57	IND	RAIPUR	CHHATISGARH
58	IND	MORADABAD	UTTAR PRADESH
59	IND	DURGAPUR	WEST BENGALI
60	IND	AMRAVATI	MAHARASHTRA
61	IND	CALICUT (KOZHIKODE)	KERALA
62	IND	BIKANER	RAJASTHAN
63	IND	BHUBANESWAR	ORISSA
64	IND	KOLHAPUR	MAHARASHTRA
65	IND	KATAKA (CUTTACK)	ORISSA
66	IND	AJMER	RAJASTHAN
67	IND	BHAVNAGAR	GUJARAT
68	IND	TIRUCHIRAPALLI	TAMIL NADU
69	IND	BHILAI	CHHATISGARH
70	IND	BHIWANDI	MAHARASHTRA
71	IND	SAHARANPUR	UTTAR PRADESH
72	IND	ULHASNAGAR	MAHARASHTRA
73	IND	SALEM	TAMIL NADU
74	IND	UJJAIN	MADHYA PRADESH
75	IND	MALEGAON	MAHARASHTRA
76	IND	JAMNAGAR	GUJARAT
77	IND	BOKARO STEEL CITY	JHARKHAND
78	IND	AKOLA	MAHARASHTRA
79	IND	BELGAUM	KARNATAKA
80	IND	RAJAHMUNDRY	ANDHRA PRADESH
81	IND	NELLORE	ANDHRA PRADESH
82	IND	UDAIPUR	RAJASTHAN
83	IND	NEW BOMBAY	MAHARASHTRA
84	IND	BHATPARA	WEST BENGALI
85	IND	GULBARGA	KARNATAKA
86	IND	NEW DELHI	DELHI
87	IND	JHANSI	UTTAR PRADESH
88	IND	GAYA	BIHAR
89	IND	KAKINADA	ANDHRA PRADESH
90	IND	DHULE (DHULIA)	MAHARASHTRA
91	IND	PANIHATI	WEST BENGALI
92	IND	NANDED (NANDER)	MAHARASHTRA
93	IND	MANGALORE	KARNATAKA
94	IND	DEHRA DUN	UTTARANCHAL
95	IND	KAMARHATI	WEST BENGALI
96	IND	DAVANGERE	KARNATAKA
97	IND	ASANSOL	WEST BENGALI
98	IND	BHAGALPUR	BIHAR
99	IND	BELLARY	KARNATAKA
100	IND	BARDDHAMAN (BURDWAN)	WEST BENGALI
101	IND	RAMPUR	UTTAR PRADESH
102	IND	JALGAON	MAHARASHTRA
103	IND	MUZAFFARPUR	BIHAR
104	IND	NIZAMABAD	ANDHRA PRADESH
105	IND	MUZAFFARNAGAR	UTTAR PRADESH
106	IND	PATIALA	PUNJAB
107	IND	SHAHJAHANPUR	UTTAR PRADESH
108	IND	KURNOOL	ANDHRA PRADESH
109	IND	TIRUPPUR (TIRUPPER)	TAMIL NADU
110	IND	ROHTAK	HARYANA
111	IND	SOUTH DUM DUM	WEST BENGALI
112	IND	MATHURA	UTTAR PRADESH
113	IND	CHANDRAPUR	MAHARASHTRA
114	IND	BARAHANAGAR (BARANAGAR)	WEST BENGALI
115	IND	DARBHANGA	BIHAR
116	IND	SILIGURI (SHILIGURI)	WEST BENGALI
117	IND	RAURKELA	ORISSA
118	IND	AMBATTUR	TAMIL NADU
119	IND	PANIPAT	HARYANA
120	IND	FIROZABAD	UTTAR PRADESH
121	IND	ICHALKARANJI	MAHARASHTRA
122	IND	JAMMU	JAMMU AND KASHMIR
123	IND	RAMAGUNDAM	ANDHRA PRADESH
124	IND	ELURU	ANDHRA PRADESH
125	IND	BRAHMAPUR	ORISSA
126	IND	ALWAR	RAJASTHAN
127	IND	PONDICHERRY	PONDICHERRY
128	IND	THANJAVUR	TAMIL NADU
129	IND	BIHAR SHARIF	BIHAR
130	IND	TUTICORIN	TAMIL NADU
131	IND	IMPHAL	MANIPUR
132	IND	LATUR	MAHARASHTRA
133	IND	SAGAR	MADHYA PRADESH
134	IND	FARRUKHABAD-CUM-FATEHGARH	UTTAR PRADESH
135	IND	SANGLI	MAHARASHTRA
136	IND	PARBHANI	MAHARASHTRA
137	IND	NAGAR COIL	TAMIL NADU
138	IND	BIJAPUR	KARNATAKA
139	IND	KUKATPALLE	ANDHRA PRADESH
140	IND	BALLY	WEST BENGALI
141	IND	BHILWARA	RAJASTHAN
142	IND	RATLAM	MADHYA PRADESH
143	IND	AVADI	TAMIL NADU
144	IND	DINDIGUL	TAMIL NADU
145	IND	AHMADNAGAR	MAHARASHTRA
146	IND	BILASPUR	CHHATISGARH
147	IND	SHIMOGA	KARNATAKA
148	IND	KHARAGPUR	WEST BENGALI
149	IND	MIRA BHAYANDAR	MAHARASHTRA
150	IND	VELLORE	TAMIL NADU
151	IND	JALNA	MAHARASHTRA
152	IND	BURNPUR	WEST BENGALI
153	IND	ANANTAPUR	ANDHRA PRADESH
154	IND	ALLAPPUZHA (ALLEPPEY)	KERALA
155	IND	TIRUPATI	ANDHRA PRADESH
156	IND	KARNAL	HARYANA
157	IND	BURHANPUR	MADHYA PRADESH
158	IND	HISAR (HISSAR)	HARYANA
159	IND	TIRUVOTTIYUR	TAMIL NADU
160	IND	MIRZAPUR-CUM-VINDHYACHAL	UTTAR PRADESH
161	IND	SECUNDERABAD	ANDHRA PRADESH
162	IND	NADIAD	GUJARAT
163	IND	DEWAS	MADHYA PRADESH
164	IND	MURWARA (KATNI)	MADHYA PRADESH
165	IND	GANGANAGAR	RAJASTHAN
166	IND	VIZIANAGARAM	ANDHRA PRADESH
167	IND	ERODE	TAMIL NADU
168	IND	MACHILIPATNAM (MASULIPATAM)	ANDHRA PRADESH
169	IND	BHATINDA (BATHINDA)	PUNJAB
170	IND	RAICHUR	KARNATAKA
171	IND	AGARTALA	TRIPURA
172	IND	ARRAH (ARA)	BIHAR
173	IND	SATNA	MADHYA PRADESH
174	IND	LALBAHADUR NAGAR	ANDHRA PRADESH
175	IND	AIZAWL	MIZORAM
176	IND	ULUBERIA	WEST BENGALI
177	IND	KATIHAR	BIHAR
178	IND	CUDDALORE	TAMIL NADU
179	IND	HUGLI-CHINSURAH	WEST BENGALI
180	IND	DHANBAD	JHARKHAND
181	IND	RAIGANJ	WEST BENGALI
182	IND	SAMBHAL	UTTAR PRADESH
183	IND	DURG	CHHATISGARH
184	IND	MUNGER (MONGHYR)	BIHAR
185	IND	KANCHIPURAM	TAMIL NADU
186	IND	NORTH DUM DUM	WEST BENGALI
187	IND	KARIMNAGAR	ANDHRA PRADESH
188	IND	BHARATPUR	RAJASTHAN
189	IND	SIKAR	RAJASTHAN
190	IND	HARDWAR (HARIDWAR)	UTTARANCHAL
191	IND	DABGRAM	WEST BENGALI
192	IND	MORENA	MADHYA PRADESH
193	IND	NOIDA	UTTAR PRADESH
194	IND	HAPUR	UTTAR PRADESH
195	IND	BHUSAWAL	MAHARASHTRA
196	IND	KHANDWA	MADHYA PRADESH
197	IND	YAMUNA NAGAR	HARYANA
198	IND	SONIPAT (SONEPAT)	HARYANA
199	IND	TENALI	ANDHRA PRADESH
200	IND	RAURKELA CIVIL TOWNSHIP	ORISSA
201	IND	KOLLAM (QUILON)	KERALA
202	IND	KUMBAKONAM	TAMIL NADU
203	IND	INGRAJ BAZAR (ENGLISH BAZAR)	WEST BENGALI
204	IND	TIMKUR	KARNATAKA
205	IND	AMROHA	UTTAR PRADESH
206	IND	SERAMPORE	WEST BENGALI
207	IND	CHAPRA	BIHAR
208	IND	PALI	RAJASTHAN
209	IND	MAUNATH BHANJAN	UTTAR PRADESH
210	IND	ADONI	ANDHRA PRADESH
211	IND	JAUNPUR	UTTAR PRADESH
212	IND	TIRUNELVELI	TAMIL NADU
213	IND	BAHRAICH	UTTAR PRADESH
214	IND	GADAG BETIGERI	KARNATAKA
215	IND	PRODDATUR	ANDHRA PRADESH
216	IND	CHITTOOR	ANDHRA PRADESH
217	IND	BARRACKPUR	WEST BENGALI
218	IND	BHARUCH (BROACH)	GUJARAT
219	IND	NAIHATI	WEST BENGALI
220	IND	SHILLONG	MEGHALAYA
221	IND	SAMBALPUR	ORISSA
222	IND	JUNAGADH	GUJARAT
223	IND	RAE BARELI	UTTAR PRADESH
224	IND	REWA	MADHYA PRADESH
225	IND	GURGAON	HARYANA
226	IND	KHAMMAM	ANDHRA PRADESH
227	IND	BULANDSHAHR	UTTAR PRADESH
228	IND	NAVSARI	GUJARAT
229	IND	MALKAJGIRI	ANDHRA PRADESH
230	IND	MIDNAPORE (MEDINIPUR)	WEST BENGALI
231	IND	MIRAJ	MAHARASHTRA
232	IND	RAJ NANDGAON	CHHATISGARH
233	IND	ALANDUR	TAMIL NADU
234	IND	PURI	ORISSA
235	IND	NAVADWIP	WEST BENGALI
236	IND	SIRSA	HARYANA
237	IND	KORBA	CHHATISGARH
238	IND	FAIZABAD	UTTAR PRADESH
239	IND	ETAWAH	UTTAR PRADESH
240	IND	PATHANKOT	PUNJAB
241	IND	GANDHINAGAR	GUJARAT
242	IND	PALGHAT (PALAKKAD)	KERALA
243	IND	VERAVAL	GUJARAT
244	IND	HOSHIARPUR	PUNJAB
245	IND	AMBALA	HARYANA
246	IND	SITAPUR	UTTAR PRADESH
247	IND	BHIWANI	HARYANA
248	IND	CUDDAPAH	ANDHRA PRADESH
249	IND	BHIMAVARAM	ANDHRA PRADESH
250	IND	KRISHNANAGAR	WEST BENGALI
251	IND	CHANDANNAGAR	WEST BENGALI
252	IND	MANDYA	KARNATAKA
253	IND	DIBRUGARH	ASSAM
254	IND	NANDYAL	ANDHRA PRADESH
255	IND	BALURGHAT	WEST BENGALI
256	IND	NEYVELI	TAMIL NADU
257	IND	FATEHPUR	UTTAR PRADESH
258	IND	MAHBUBNAGAR	ANDHRA PRADESH
259	IND	BUDAUN	UTTAR PRADESH
260	IND	PORBANDAR	GUJARAT
261	IND	SILCHAR	ASSAM
262	IND	BERHAMPORE (BAHARAMPUR)	WEST BENGALI
263	IND	PURNEA (PURNIA)	JHARKHAND
264	IND	BANKURA	WEST BENGALI
265	IND	RAJAPALAIYAM	TAMIL NADU
266	IND	TITAGARH	WEST BENGALI
267	IND	HALISAHAR	WEST BENGALI
268	IND	HATHRAS	UTTAR PRADESH
269	IND	BHIR (BID)	MAHARASHTRA
270	IND	PALLAVARAM	TAMIL NADU
271	IND	ANAND	GUJARAT
272	IND	MANGO	JHARKHAND
273	IND	SANTIPUR	WEST BENGALI
274	IND	BHIND	MADHYA PRADESH
275	IND	GONDIYA	MAHARASHTRA
276	IND	TIRUVANNAMALAI	TAMIL NADU
277	IND	YEOTMAL (YAVATMAL)	MAHARASHTRA
278	IND	KULTI-BARAKAR	WEST BENGALI
279	IND	MOGA	PUNJAB
280	IND	SHIVAPURI	MADHYA PRADESH
281	IND	BIDAR	KARNATAKA
282	IND	GUNTAKAL	ANDHRA PRADESH
283	IND	UNNAO	UTTAR PRADESH
284	IND	BARASAT	WEST BENGALI
285	IND	TAMBARAM	TAMIL NADU
286	IND	ABOHAR	PUNJAB
287	IND	PILIBHIT	UTTAR PRADESH
288	IND	VALPARAI	TAMIL NADU
289	IND	GONDA	UTTAR PRADESH
290	IND	SURENDRANAGAR	GUJARAT
291	IND	QUTUBULLAPUR	ANDHRA PRADESH
292	IND	BEAWAR	RAJASTHAN
293	IND	HINDUPUR	ANDHRA PRADESH
294	IND	GANDHIDHAM	GUJARAT
295	IND	HALDWANI-CUM-KATHGODAM	UTTARANCHAL
296	IND	TELLICHERRY (THALASSERY)	KERALA
297	IND	WARDHA	MAHARASHTRA
298	IND	RISHRA	WEST BENGALI
299	IND	BHUJ	GUJARAT
300	IND	MODINAGAR	UTTAR PRADESH
301	IND	GUDIVADA	ANDHRA PRADESH
302	IND	BASIRHAT	WEST BENGALI
303	IND	UTTARPARA-KOTRUNG	WEST BENGALI
304	IND	ONGOLE	ANDHRA PRADESH
305	IND	NORTH BARRACKPUR	WEST BENGALI
306	IND	GUNA	MADHYA PRADESH
307	IND	HALDIA	WEST BENGALI
308	IND	HABRA	WEST BENGALI
309	IND	KANCHRAPARA	WEST BENGALI
310	IND	TONK	RAJASTHAN
311	IND	CHAMPDANI	WEST BENGALI
312	IND	ORAI	UTTAR PRADESH
313	IND	PUDUKKOTTAI	TAMIL NADU
314	IND	SASARAM	BIHAR
315	IND	HAZARIBAG	JHARKHAND
316	IND	PALAYANKOTTAI	TAMIL NADU
317	IND	BANDA	UTTAR PRADESH
318	IND	GODHRA	GUJARAT
319	IND	HOSPET	KARNATAKA
320	IND	ASHOKNAGAR-KALYANGARH	WEST BENGALI
321	IND	ACHALPUR	MAHARASHTRA
322	IND	PATAN	GUJARAT
323	IND	MANDASOR	MADHYA PRADESH
324	IND	DAMOH	MADHYA PRADESH
325	IND	SATARA	MAHARASHTRA
326	IND	MEERUT CANTONMENT	UTTAR PRADESH
327	IND	DEHRI	BIHAR
328	IND	DELHI CANTONMENT	DELHI
329	IND	CHHINDWARA	MADHYA PRADESH
330	IND	BANSBERIA	WEST BENGALI
331	IND	NAGAON	ASSAM
332	IND	KANPUR CANTONMENT	UTTAR PRADESH
333	IND	VIDISHA	MADHYA PRADESH
334	IND	BETTIAH	BIHAR
335	IND	PURULIA	JHARKHAND
336	IND	HASSAN	KARNATAKA
337	IND	AMBALA SADAR	HARYANA
338	IND	BAIDYABATI	WEST BENGALI
339	IND	MORVI	GUJARAT
340	IND	RAIGARH	CHHATISGARH
341	IND	VEJALPUR	GUJARAT
1	IRL	DUBLIN	LEINSTER
2	IRL	CORK	MUNSTER
1	IRN	TEHERAN	TEHERAN
2	IRN	MASHHAD	KHORASAN
3	IRN	ESFAHAN	ESFAHAN
4	IRN	TABRIZ	EAST AZERBAIDZAN
5	IRN	SHIRAZ	FARS
6	IRN	KARAJ	TEHERAN
7	IRN	AHVAZ	KHUZESTAN
8	IRN	QOM	QOM
9	IRN	KERMANSHAH	KERMANSHAH
10	IRN	URMIA	WEST AZERBAIDZAN
11	IRN	ZAHEDAN	SISTAN VA BALUCHESTA
12	IRN	RASHT	GILAN
13	IRN	HAMADAN	HAMADAN
14	IRN	KERMAN	KERMAN
15	IRN	ARAK	MARKAZI
16	IRN	ARDEBIL	ARDEBIL
17	IRN	YAZD	YAZD
18	IRN	QAZVIN	QAZVIN
19	IRN	ZANJAN	ZANJAN
20	IRN	SANANDAJ	KORDESTAN
21	IRN	BANDAR-E-ABBAS	HORMOZGAN
22	IRN	KHORRAMABAD	LORESTAN
23	IRN	ESLAMSHAHR	TEHERAN
24	IRN	BORUJERD	LORESTAN
25	IRN	ABADAN	KHUZESTAN
26	IRN	DEZFUL	KHUZESTAN
27	IRN	KASHAN	ESFAHAN
28	IRN	SARI	MAZANDARAN
29	IRN	GORGAN	GOLESTAN
30	IRN	NAJAFABAD	ESFAHAN
31	IRN	SABZEVAR	KHORASAN
32	IRN	KHOMEYNISHAHR	ESFAHAN
33	IRN	AMOL	MAZANDARAN
34	IRN	NEYSHABUR	KHORASAN
35	IRN	BABOL	MAZANDARAN
36	IRN	KHOY	WEST AZERBAIDZAN
37	IRN	MALAYER	HAMADAN
38	IRN	BUSHEHR	BUSHEHR
39	IRN	QAEMSHAHR	MAZANDARAN
40	IRN	QARCHAK	TEHERAN
41	IRN	QODS	TEHERAN
42	IRN	SIRJAN	KERMAN
43	IRN	BOJNURD	KHORASAN
44	IRN	MARAGHEH	EAST AZERBAIDZAN
45	IRN	BIRJAND	KHORASAN
46	IRN	ILAM	ILAM
47	IRN	BUKAN	WEST AZERBAIDZAN
48	IRN	MASJED-E-SOLEYMAN	KHUZESTAN
49	IRN	SAQQEZ	KORDESTAN
50	IRN	GONBAD-E QABUS	MAZANDARAN
51	IRN	SAVEH	QOM
52	IRN	MAHABAD	WEST AZERBAIDZAN
53	IRN	VARAMIN	TEHERAN
54	IRN	ANDIMESHK	KHUZESTAN
55	IRN	KHORRAMSHAHR	KHUZESTAN
56	IRN	SHAHRUD	SEMNAN
57	IRN	MARV DASHT	FARS
58	IRN	ZABOL	SISTAN VA BALUCHESTA
59	IRN	SHAHR-E KORD	CHAHARMAHAL VA BAKHT
60	IRN	BANDAR-E ANZALI	GILAN
61	IRN	RAFSANJAN	KERMAN
62	IRN	MARAND	EAST AZERBAIDZAN
63	IRN	TORBAT-E HEYDARIYEH	KHORASAN
64	IRN	JAHROM	FARS
65	IRN	SEMNAN	SEMNAN
66	IRN	MIANDOAB	WEST AZERBAIDZAN
67	IRN	QOMSHEH	ESFAHAN
1	IRQ	BAGHDAD	BAGHDAD
2	IRQ	MOSUL	NINAWA
3	IRQ	IRBIL	IRBIL
4	IRQ	KIRKUK	AL-TAMIM
5	IRQ	BASRA	BASRA
6	IRQ	AL-SULAYMANIYA	AL-SULAYMANIYA
7	IRQ	AL-NAJAF	AL-NAJAF
8	IRQ	KARBALA	KARBALA
9	IRQ	AL-HILLA	BABIL
10	IRQ	AL-NASIRIYA	DHIQAR
11	IRQ	AL-AMARA	MAYSAN
12	IRQ	AL-DIWANIYA	AL-QADISIYA
13	IRQ	AL-RAMADI	AL-ANBAR
14	IRQ	AL-KUT	WASIT
15	IRQ	BAQUBA	DIYALA
1	ISL	REYKJAVÏ¿½K	HÏ¿½FUÏ¿½BORGARSVÏ¿½
1	ISR	JERUSALEM	JERUSALEM
2	ISR	TEL AVIV-JAFFA	TEL AVIV
3	ISR	HAIFA	HAIFA
4	ISR	RISHON LE ZIYYON	HA MERKAZ
5	ISR	BEERSEBA	HA DAROM
6	ISR	HOLON	TEL AVIV
7	ISR	PETAH TIQWA	HA MERKAZ
8	ISR	ASHDOD	HA DAROM
9	ISR	NETANYA	HA MERKAZ
10	ISR	BAT YAM	TEL AVIV
11	ISR	BENE BERAQ	TEL AVIV
12	ISR	RAMAT GAN	TEL AVIV
13	ISR	ASHQELON	HA DAROM
14	ISR	REHOVOT	HA MERKAZ
1	ITA	ROMA	LATIUM
2	ITA	MILANO	LOMBARDIA
3	ITA	NAPOLI	CAMPANIA
4	ITA	TORINO	PIEMONTE
5	ITA	PALERMO	SISILIA
6	ITA	GENOVA	LIGURIA
7	ITA	BOLOGNA	EMILIA-ROMAGNA
8	ITA	FIRENZE	TOSCANA
9	ITA	CATANIA	SISILIA
10	ITA	BARI	APULIA
11	ITA	VENEZIA	VENETO
12	ITA	MESSINA	SISILIA
13	ITA	VERONA	VENETO
14	ITA	TRIESTE	FRIULI-VENEZIA GIULI
15	ITA	PADOVA	VENETO
16	ITA	TARANTO	APULIA
17	ITA	BRESCIA	LOMBARDIA
18	ITA	REGGIO DI CALABRIA	CALABRIA
19	ITA	MODENA	EMILIA-ROMAGNA
20	ITA	PRATO	TOSCANA
21	ITA	PARMA	EMILIA-ROMAGNA
22	ITA	CAGLIARI	SARDINIA
23	ITA	LIVORNO	TOSCANA
24	ITA	PERUGIA	UMBRIA
25	ITA	FOGGIA	APULIA
26	ITA	REGGIO NELLÏ¿½ EMILIA	EMILIA-ROMAGNA
27	ITA	SALERNO	CAMPANIA
28	ITA	RAVENNA	EMILIA-ROMAGNA
29	ITA	FERRARA	EMILIA-ROMAGNA
30	ITA	RIMINI	EMILIA-ROMAGNA
31	ITA	SYRAKUSA	SISILIA
32	ITA	SASSARI	SARDINIA
33	ITA	MONZA	LOMBARDIA
34	ITA	BERGAMO	LOMBARDIA
35	ITA	PESCARA	ABRUZZIT
36	ITA	LATINA	LATIUM
37	ITA	VICENZA	VENETO
38	ITA	TERNI	UMBRIA
39	ITA	FORLÏ¿½	EMILIA-ROMAGNA
40	ITA	TRENTO	TRENTINO-ALTO ADIGE
41	ITA	NOVARA	PIEMONTE
42	ITA	PIACENZA	EMILIA-ROMAGNA
43	ITA	ANCONA	MARCHE
44	ITA	LECCE	APULIA
45	ITA	BOLZANO	TRENTINO-ALTO ADIGE
46	ITA	CATANZARO	CALABRIA
47	ITA	LA SPEZIA	LIGURIA
48	ITA	UDINE	FRIULI-VENEZIA GIULI
49	ITA	TORRE DEL GRECO	CAMPANIA
50	ITA	ANDRIA	APULIA
51	ITA	BRINDISI	APULIA
52	ITA	GIUGLIANO IN CAMPANIA	CAMPANIA
53	ITA	PISA	TOSCANA
54	ITA	BARLETTA	APULIA
55	ITA	AREZZO	TOSCANA
56	ITA	ALESSANDRIA	PIEMONTE
57	ITA	CESENA	EMILIA-ROMAGNA
58	ITA	PESARO	MARCHE
1	JAM	SPANISH TOWN	ST. CATHERINE
2	JAM	KINGSTON	ST. ANDREW
3	JAM	PORTMORE	ST. ANDREW
1	JOR	AMMAN	AMMAN
2	JOR	AL-ZARQA	AL-ZARQA
3	JOR	IRBID	IRBID
4	JOR	AL-RUSAYFA	AL-ZARQA
5	JOR	WADI AL-SIR	AMMAN
1	JPN	TOKYO	TOKYO-TO
2	JPN	JOKOHAMA [YOKOHAMA]	KANAGAWA
3	JPN	OSAKA	OSAKA
4	JPN	NAGOYA	AICHI
5	JPN	SAPPORO	HOKKAIDO
6	JPN	KIOTO	KYOTO
7	JPN	KOBE	HYOGO
8	JPN	FUKUOKA	FUKUOKA
9	JPN	KAWASAKI	KANAGAWA
10	JPN	HIROSHIMA	HIROSHIMA
11	JPN	KITAKYUSHU	FUKUOKA
12	JPN	SENDAI	MIYAGI
13	JPN	CHIBA	CHIBA
14	JPN	SAKAI	OSAKA
15	JPN	KUMAMOTO	KUMAMOTO
16	JPN	OKAYAMA	OKAYAMA
17	JPN	SAGAMIHARA	KANAGAWA
18	JPN	HAMAMATSU	SHIZUOKA
19	JPN	KAGOSHIMA	KAGOSHIMA
20	JPN	FUNABASHI	CHIBA
21	JPN	HIGASHIOSAKA	OSAKA
22	JPN	HACHIOJI	TOKYO-TO
23	JPN	NIIGATA	NIIGATA
24	JPN	AMAGASAKI	HYOGO
25	JPN	HIMEJI	HYOGO
26	JPN	SHIZUOKA	SHIZUOKA
27	JPN	URAWA	SAITAMA
28	JPN	MATSUYAMA	EHIME
29	JPN	MATSUDO	CHIBA
30	JPN	KANAZAWA	ISHIKAWA
31	JPN	KAWAGUCHI	SAITAMA
32	JPN	ICHIKAWA	CHIBA
33	JPN	OMIYA	SAITAMA
34	JPN	UTSUNOMIYA	TOCHIGI
35	JPN	OITA	OITA
36	JPN	NAGASAKI	NAGASAKI
37	JPN	YOKOSUKA	KANAGAWA
38	JPN	KURASHIKI	OKAYAMA
39	JPN	GIFU	GIFU
40	JPN	HIRAKATA	OSAKA
41	JPN	NISHINOMIYA	HYOGO
42	JPN	TOYONAKA	OSAKA
43	JPN	WAKAYAMA	WAKAYAMA
44	JPN	FUKUYAMA	HIROSHIMA
45	JPN	FUJISAWA	KANAGAWA
46	JPN	ASAHIKAWA	HOKKAIDO
47	JPN	MACHIDA	TOKYO-TO
48	JPN	NARA	NARA
49	JPN	TAKATSUKI	OSAKA
50	JPN	IWAKI	FUKUSHIMA
51	JPN	NAGANO	NAGANO
52	JPN	TOYOHASHI	AICHI
53	JPN	TOYOTA	AICHI
54	JPN	SUITA	OSAKA
55	JPN	TAKAMATSU	KAGAWA
56	JPN	KORIYAMA	FUKUSHIMA
57	JPN	OKAZAKI	AICHI
58	JPN	KAWAGOE	SAITAMA
59	JPN	TOKOROZAWA	SAITAMA
60	JPN	TOYAMA	TOYAMA
61	JPN	KOCHI	KOCHI
62	JPN	KASHIWA	CHIBA
63	JPN	AKITA	AKITA
64	JPN	MIYAZAKI	MIYAZAKI
65	JPN	KOSHIGAYA	SAITAMA
66	JPN	NAHA	OKINAWA
67	JPN	AOMORI	AOMORI
68	JPN	HAKODATE	HOKKAIDO
69	JPN	AKASHI	HYOGO
70	JPN	YOKKAICHI	MIE
71	JPN	FUKUSHIMA	FUKUSHIMA
72	JPN	MORIOKA	IWATE
73	JPN	MAEBASHI	GUMMA
74	JPN	KASUGAI	AICHI
75	JPN	OTSU	SHIGA
76	JPN	ICHIHARA	CHIBA
77	JPN	YAO	OSAKA
78	JPN	ICHINOMIYA	AICHI
79	JPN	TOKUSHIMA	TOKUSHIMA
80	JPN	KAKOGAWA	HYOGO
81	JPN	IBARAKI	OSAKA
82	JPN	NEYAGAWA	OSAKA
83	JPN	SHIMONOSEKI	YAMAGUCHI
84	JPN	YAMAGATA	YAMAGATA
85	JPN	FUKUI	FUKUI
86	JPN	HIRATSUKA	KANAGAWA
87	JPN	MITO	IBARAGI
88	JPN	SASEBO	NAGASAKI
89	JPN	HACHINOHE	AOMORI
90	JPN	TAKASAKI	GUMMA
91	JPN	SHIMIZU	SHIZUOKA
92	JPN	KURUME	FUKUOKA
93	JPN	FUJI	SHIZUOKA
94	JPN	SOKA	SAITAMA
95	JPN	FUCHU	TOKYO-TO
96	JPN	CHIGASAKI	KANAGAWA
97	JPN	ATSUGI	KANAGAWA
98	JPN	NUMAZU	SHIZUOKA
99	JPN	AGEO	SAITAMA
100	JPN	YAMATO	KANAGAWA
101	JPN	MATSUMOTO	NAGANO
102	JPN	KURE	HIROSHIMA
103	JPN	TAKARAZUKA	HYOGO
104	JPN	KASUKABE	SAITAMA
105	JPN	CHOFU	TOKYO-TO
106	JPN	ODAWARA	KANAGAWA
107	JPN	KOFU	YAMANASHI
108	JPN	KUSHIRO	HOKKAIDO
109	JPN	KISHIWADA	OSAKA
110	JPN	HITACHI	IBARAGI
111	JPN	NAGAOKA	NIIGATA
112	JPN	ITAMI	HYOGO
113	JPN	UJI	KYOTO
114	JPN	SUZUKA	MIE
115	JPN	HIROSAKI	AOMORI
116	JPN	UBE	YAMAGUCHI
117	JPN	KODAIRA	TOKYO-TO
118	JPN	TAKAOKA	TOYAMA
119	JPN	OBIHIRO	HOKKAIDO
120	JPN	TOMAKOMAI	HOKKAIDO
121	JPN	SAGA	SAGA
122	JPN	SAKURA	CHIBA
123	JPN	KAMAKURA	KANAGAWA
124	JPN	MITAKA	TOKYO-TO
125	JPN	IZUMI	OSAKA
126	JPN	HINO	TOKYO-TO
127	JPN	HADANO	KANAGAWA
128	JPN	ASHIKAGA	TOCHIGI
129	JPN	TSU	MIE
130	JPN	SAYAMA	SAITAMA
131	JPN	YACHIYO	CHIBA
132	JPN	TSUKUBA	IBARAGI
133	JPN	TACHIKAWA	TOKYO-TO
134	JPN	KUMAGAYA	SAITAMA
135	JPN	MORIGUCHI	OSAKA
136	JPN	OTARU	HOKKAIDO
137	JPN	ANJO	AICHI
138	JPN	NARASHINO	CHIBA
139	JPN	OYAMA	TOCHIGI
140	JPN	OGAKI	GIFU
141	JPN	MATSUE	SHIMANE
142	JPN	KAWANISHI	HYOGO
143	JPN	HITACHINAKA	TOKYO-TO
144	JPN	NIIZA	SAITAMA
145	JPN	NAGAREYAMA	CHIBA
146	JPN	TOTTORI	TOTTORI
147	JPN	TAMA	IBARAGI
148	JPN	IRUMA	SAITAMA
149	JPN	OTA	GUMMA
150	JPN	OMUTA	FUKUOKA
151	JPN	KOMAKI	AICHI
152	JPN	OME	TOKYO-TO
153	JPN	KADOMA	OSAKA
154	JPN	YAMAGUCHI	YAMAGUCHI
155	JPN	HIGASHIMURAYAMA	TOKYO-TO
156	JPN	YONAGO	TOTTORI
157	JPN	MATSUBARA	OSAKA
158	JPN	MUSASHINO	TOKYO-TO
159	JPN	TSUCHIURA	IBARAGI
160	JPN	JOETSU	NIIGATA
161	JPN	MIYAKONOJO	MIYAZAKI
162	JPN	MISATO	SAITAMA
163	JPN	KAKAMIGAHARA	GIFU
164	JPN	DAITO	OSAKA
165	JPN	SETO	AICHI
166	JPN	KARIYA	AICHI
167	JPN	URAYASU	CHIBA
168	JPN	BEPPU	OITA
169	JPN	NIIHAMA	EHIME
170	JPN	MINOO	OSAKA
171	JPN	FUJIEDA	SHIZUOKA
172	JPN	ABIKO	CHIBA
173	JPN	NOBEOKA	MIYAZAKI
174	JPN	TONDABAYASHI	OSAKA
175	JPN	UEDA	NAGANO
176	JPN	KASHIHARA	NARA
177	JPN	MATSUSAKA	MIE
178	JPN	ISESAKI	GUMMA
179	JPN	ZAMA	KANAGAWA
180	JPN	KISARAZU	CHIBA
181	JPN	NODA	CHIBA
182	JPN	ISHINOMAKI	MIYAGI
183	JPN	FUJINOMIYA	SHIZUOKA
184	JPN	KAWACHINAGANO	OSAKA
185	JPN	IMABARI	EHIME
186	JPN	AIZUWAKAMATSU	FUKUSHIMA
187	JPN	HIGASHIHIROSHIMA	HIROSHIMA
188	JPN	HABIKINO	OSAKA
189	JPN	EBETSU	HOKKAIDO
190	JPN	HOFU	YAMAGUCHI
191	JPN	KIRYU	GUMMA
192	JPN	OKINAWA	OKINAWA
193	JPN	YAIZU	SHIZUOKA
194	JPN	TOYOKAWA	AICHI
195	JPN	EBINA	KANAGAWA
196	JPN	ASAKA	SAITAMA
197	JPN	HIGASHIKURUME	TOKYO-TO
198	JPN	IKOMA	NARA
199	JPN	KITAMI	HOKKAIDO
200	JPN	KOGANEI	TOKYO-TO
201	JPN	IWATSUKI	SAITAMA
202	JPN	MISHIMA	SHIZUOKA
203	JPN	HANDA	AICHI
204	JPN	MURORAN	HOKKAIDO
205	JPN	KOMATSU	ISHIKAWA
206	JPN	YATSUSHIRO	KUMAMOTO
207	JPN	IIDA	NAGANO
208	JPN	TOKUYAMA	YAMAGUCHI
209	JPN	KOKUBUNJI	TOKYO-TO
210	JPN	AKISHIMA	TOKYO-TO
211	JPN	IWAKUNI	YAMAGUCHI
212	JPN	KUSATSU	SHIGA
213	JPN	KUWANA	MIE
214	JPN	SANDA	HYOGO
215	JPN	HIKONE	SHIGA
216	JPN	TODA	SAITAMA
217	JPN	TAJIMI	GIFU
218	JPN	IKEDA	OSAKA
219	JPN	FUKAYA	SAITAMA
220	JPN	ISE	MIE
221	JPN	SAKATA	YAMAGATA
222	JPN	KASUGA	FUKUOKA
223	JPN	KAMAGAYA	CHIBA
224	JPN	TSURUOKA	YAMAGATA
225	JPN	HOYA	TOKYO-TO
226	JPN	NISHIO	CHIBA
227	JPN	TOKAI	AICHI
228	JPN	INAZAWA	AICHI
229	JPN	SAKADO	SAITAMA
230	JPN	ISEHARA	KANAGAWA
231	JPN	TAKASAGO	HYOGO
232	JPN	FUJIMI	SAITAMA
233	JPN	URASOE	OKINAWA
234	JPN	YONEZAWA	YAMAGATA
235	JPN	KONAN	AICHI
236	JPN	YAMATOKORIYAMA	NARA
237	JPN	MAIZURU	KYOTO
238	JPN	ONOMICHI	HIROSHIMA
239	JPN	HIGASHIMATSUYAMA	SAITAMA
240	JPN	KIMITSU	CHIBA
241	JPN	ISAHAYA	NAGASAKI
242	JPN	KANUMA	TOCHIGI
243	JPN	IZUMISANO	OSAKA
244	JPN	KAMEOKA	KYOTO
245	JPN	MOBARA	CHIBA
246	JPN	NARITA	CHIBA
247	JPN	KASHIWAZAKI	NIIGATA
248	JPN	TSUYAMA	OKAYAMA
1	KAZ	ALMATY	ALMATY QALASY
2	KAZ	QARAGHANDY	QARAGHANDY
3	KAZ	SHYMKENT	SOUTH KAZAKSTAN
4	KAZ	TARAZ	TARAZ
5	KAZ	ASTANA	ASTANA
6	KAZ	Ï¿½SKEMEN	EAST KAZAKSTAN
7	KAZ	PAVLODAR	PAVLODAR
8	KAZ	SEMEY	EAST KAZAKSTAN
9	KAZ	AQTÏ¿½BE	AQTÏ¿½BE
10	KAZ	QOSTANAY	QOSTANAY
11	KAZ	PETROPAVL	NORTH KAZAKSTAN
12	KAZ	ORAL	WEST KAZAKSTAN
13	KAZ	TEMIRTAU	QARAGHANDY
14	KAZ	QYZYLORDA	QYZYLORDA
15	KAZ	AQTAU	MANGGHYSTAU
16	KAZ	ATYRAU	ATYRAU
17	KAZ	EKIBASTUZ	PAVLODAR
18	KAZ	KÏ¿½KSHETAU	NORTH KAZAKSTAN
19	KAZ	RUDNYY	QOSTANAY
20	KAZ	TALDYQORGHAN	ALMATY
21	KAZ	ZHEZQAZGHAN	QARAGHANDY
1	KEN	NAIROBI	NAIROBI
2	KEN	MOMBASA	COAST
3	KEN	KISUMU	NYANZA
4	KEN	NAKURU	RIFT VALLEY
5	KEN	MACHAKOS	EASTERN
6	KEN	ELDORET	RIFT VALLEY
7	KEN	MERU	EASTERN
8	KEN	NYERI	CENTRAL
1	KGZ	BISHKEK	BISHKEK SHAARY
2	KGZ	OSH	OSH
1	KHM	PHNOM PENH	PHNOM PENH
2	KHM	BATTAMBANG	BATTAMBANG
3	KHM	SIEM REAP	SIEM REAP
1	KIR	BIKENIBEU	SOUTH TARAWA
2	KIR	BAIRIKI	SOUTH TARAWA
1	KNA	BASSETERRE	ST GEORGE BASSETERRE
1	KOR	SEOUL	SEOUL
2	KOR	PUSAN	PUSAN
3	KOR	INCHON	INCHON
4	KOR	TAEGU	TAEGU
5	KOR	TAEJON	TAEJON
6	KOR	KWANGJU	KWANGJU
7	KOR	ULSAN	KYONGSANGNAM
8	KOR	SONGNAM	KYONGGI
9	KOR	PUCHON	KYONGGI
10	KOR	SUWON	KYONGGI
11	KOR	ANYANG	KYONGGI
12	KOR	CHONJU	CHOLLABUK
13	KOR	CHONGJU	CHUNGCHONGBUK
14	KOR	KOYANG	KYONGGI
15	KOR	ANSAN	KYONGGI
16	KOR	POHANG	KYONGSANGBUK
17	KOR	CHANG-WON	KYONGSANGNAM
18	KOR	MASAN	KYONGSANGNAM
19	KOR	KWANGMYONG	KYONGGI
20	KOR	CHONAN	CHUNGCHONGNAM
21	KOR	CHINJU	KYONGSANGNAM
22	KOR	IKSAN	CHOLLABUK
23	KOR	PYONGTAEK	KYONGGI
24	KOR	KUMI	KYONGSANGBUK
25	KOR	UIJONGBU	KYONGGI
26	KOR	KYONGJU	KYONGSANGBUK
27	KOR	KUNSAN	CHOLLABUK
28	KOR	CHEJU	CHEJU
29	KOR	KIMHAE	KYONGSANGNAM
30	KOR	SUNCHON	CHOLLANAM
31	KOR	MOKPO	CHOLLANAM
32	KOR	YONG-IN	KYONGGI
33	KOR	WONJU	KANG-WON
34	KOR	KUNPO	KYONGGI
35	KOR	CHUNCHON	KANG-WON
36	KOR	NAMYANGJU	KYONGGI
37	KOR	KANGNUNG	KANG-WON
38	KOR	CHUNGJU	CHUNGCHONGBUK
39	KOR	ANDONG	KYONGSANGBUK
40	KOR	YOSU	CHOLLANAM
41	KOR	KYONGSAN	KYONGSANGBUK
42	KOR	PAJU	KYONGGI
43	KOR	YANGSAN	KYONGSANGNAM
44	KOR	ICHON	KYONGGI
45	KOR	ASAN	CHUNGCHONGNAM
46	KOR	KOJE	KYONGSANGNAM
47	KOR	KIMCHON	KYONGSANGBUK
48	KOR	NONSAN	CHUNGCHONGNAM
49	KOR	KURI	KYONGGI
50	KOR	CHONG-UP	CHOLLABUK
51	KOR	CHECHON	CHUNGCHONGBUK
52	KOR	SOSAN	CHUNGCHONGNAM
53	KOR	SHIHUNG	KYONGGI
54	KOR	TONG-YONG	KYONGSANGNAM
55	KOR	KONGJU	CHUNGCHONGNAM
56	KOR	YONGJU	KYONGSANGBUK
57	KOR	CHINHAE	KYONGSANGNAM
58	KOR	SANGJU	KYONGSANGBUK
59	KOR	PORYONG	CHUNGCHONGNAM
60	KOR	KWANG-YANG	CHOLLANAM
61	KOR	MIRYANG	KYONGSANGNAM
62	KOR	HANAM	KYONGGI
63	KOR	KIMJE	CHOLLABUK
64	KOR	YONGCHON	KYONGSANGBUK
65	KOR	SACHON	KYONGSANGNAM
66	KOR	UIWANG	KYONGGI
67	KOR	NAJU	CHOLLANAM
68	KOR	NAMWON	CHOLLABUK
69	KOR	TONGHAE	KANG-WON
70	KOR	MUN-GYONG	KYONGSANGBUK
1	KWT	AL-SALIMIYA	HAWALLI
2	KWT	JALIB AL-SHUYUKH	HAWALLI
3	KWT	KUWAIT	AL-ASIMA
1	LAO	VIENTIANE	VIANGCHAN
2	LAO	SAVANNAKHET	SAVANNAKHET
1	LBN	BEIRUT	BEIRUT
2	LBN	TRIPOLI	AL-SHAMAL
1	LBR	MONROVIA	MONTSERRADO
1	LBY	TRIPOLI	TRIPOLI
2	LBY	BENGASI	BENGASI
3	LBY	MISRATA	MISRATA
4	LBY	AL-ZAWIYA	AL-ZAWIYA
1	LCA	CASTRIES	CASTRIES
1	LIE	SCHAAN	SCHAAN
2	LIE	VADUZ	VADUZ
1	LKA	COLOMBO	WESTERN
2	LKA	DEHIWALA	WESTERN
3	LKA	MORATUWA	WESTERN
4	LKA	JAFFNA	NORTHERN
5	LKA	KANDY	CENTRAL
6	LKA	SRI JAYAWARDENEPURA KOTTE	WESTERN
7	LKA	NEGOMBO	WESTERN
1	LSO	MASERU	MASERU
1	LTU	VILNIUS	VILNA
2	LTU	KAUNAS	KAUNAS
3	LTU	KLAIPEDA	KLAIPEDA
4	LTU	Ï¿½IAULIAI	Ï¿½IAULIAI
5	LTU	PANEVEZYS	PANEVEZYS
1	LUX	LUXEMBOURG [LUXEMBURG/LÏ¿½TZEBUERG]	LUXEMBOURG
1	LVA	RIGA	RIIKA
2	LVA	DAUGAVPILS	DAUGAVPILS
3	LVA	LIEPAJA	LIEPAJA
1	MAC	MACAO	MACAU
1	MAR	CASABLANCA	CASABLANCA
2	MAR	RABAT	RABAT-SALÏ¿½-ZAMMOUR
3	MAR	MARRAKECH	MARRAKECH-TENSIFT-AL
4	MAR	FÏ¿½S	FÏ¿½S-BOULEMANE
5	MAR	TANGER	TANGER-TÏ¿½TOUAN
6	MAR	SALÏ¿½	RABAT-SALÏ¿½-ZAMMOUR
7	MAR	MEKNÏ¿½S	MEKNÏ¿½S-TAFILALET
8	MAR	OUJDA	ORIENTAL
9	MAR	KÏ¿½NITRA	GHARB-CHRARDA-BÏ¿½NI
10	MAR	TÏ¿½TOUAN	TANGER-TÏ¿½TOUAN
11	MAR	SAFI	DOUKKALA-ABDA
12	MAR	AGADIR	SOUSS MASSA-DRAÏ¿½
13	MAR	MOHAMMEDIA	CASABLANCA
14	MAR	KHOURIBGA	CHAOUIA-OUARDIGHA
15	MAR	BENI-MELLAL	TADLA-AZILAL
16	MAR	TÏ¿½MARA	RABAT-SALÏ¿½-ZAMMOUR
17	MAR	EL JADIDA	DOUKKALA-ABDA
18	MAR	NADOR	ORIENTAL
19	MAR	KSAR EL KEBIR	TANGER-TÏ¿½TOUAN
20	MAR	SETTAT	CHAOUIA-OUARDIGHA
21	MAR	TAZA	TAZA-AL HOCEIMA-TAOU
22	MAR	EL ARAICH	TANGER-TÏ¿½TOUAN
1	MCO	MONTE-CARLO	Ï¿½
2	MCO	MONACO-VILLE	Ï¿½
1	MDA	CHISINAU	CHISINAU
2	MDA	TIRASPOL	DNJESTRIA
3	MDA	BALTI	BALTI
4	MDA	BENDER (TÏ¿½GHINA)	BENDER (TÏ¿½GHINA)
1	MDG	ANTANANARIVO	ANTANANARIVO
2	MDG	TOAMASINA	TOAMASINA
3	MDG	ANTSIRABÏ¿½	ANTANANARIVO
4	MDG	MAHAJANGA	MAHAJANGA
5	MDG	FIANARANTSOA	FIANARANTSOA
1	MDV	MALE	MAALE
1	MEX	CIUDAD DE MEXICO	DISTRITO FEDERAL
2	MEX	GUADALAJARA	JALISCO
3	MEX	ECATEPEC DE MORELOS	MÏ¿½XICO
4	MEX	PUEBLA	PUEBLA
5	MEX	NEZAHUALCÏ¿½YOTL	MÏ¿½XICO
6	MEX	JUAREZ	CHIHUAHUA
7	MEX	TIJUANA	BAJA CALIFORNIA
8	MEX	LEÏ¿½N	GUANAJUATO
9	MEX	MONTERREY	NUEVO LEÏ¿½N
10	MEX	ZAPOPAN	JALISCO
11	MEX	NAUCALPAN DE JUAREZ	MÏ¿½XICO
12	MEX	MEXICALI	BAJA CALIFORNIA
13	MEX	CULIACÏ¿½N	SINALOA
14	MEX	ACAPULCO DE JUÏ¿½REZ	GUERRERO
15	MEX	TLALNEPANTLA DE BAZ	MÏ¿½XICO
16	MEX	MÏ¿½RIDA	YUCATÏ¿½N
17	MEX	CHIHUAHUA	CHIHUAHUA
18	MEX	SAN LUIS POTOSÏ¿½	SAN LUIS POTOSÏ¿½
19	MEX	GUADALUPE	NUEVO LEÏ¿½N
20	MEX	TOLUCA	MÏ¿½XICO
21	MEX	AGUASCALIENTES	AGUASCALIENTES
22	MEX	QUERÏ¿½TARO	QUERÏ¿½TARO DE ARTEA
23	MEX	MORELIA	MICHOACÏ¿½N DE OCAMP
24	MEX	HERMOSILLO	SONORA
25	MEX	SALTILLO	COAHUILA DE ZARAGOZA
26	MEX	TORREÏ¿½N	COAHUILA DE ZARAGOZA
27	MEX	CENTRO (VILLAHERMOSA)	TABASCO
28	MEX	SAN NICOLÏ¿½S DE LOS GARZA	NUEVO LEÏ¿½N
29	MEX	DURANGO	DURANGO
30	MEX	CHIMALHUACÏ¿½N	MÏ¿½XICO
31	MEX	TLAQUEPAQUE	JALISCO
32	MEX	ATIZAPÏ¿½N DE ZARAGOZA	MÏ¿½XICO
33	MEX	VERACRUZ	VERACRUZ
34	MEX	CUAUTITLÏ¿½N IZCALLI	MÏ¿½XICO
35	MEX	IRAPUATO	GUANAJUATO
36	MEX	TUXTLA GUTIÏ¿½RREZ	CHIAPAS
37	MEX	TULTITLÏ¿½N	MÏ¿½XICO
38	MEX	REYNOSA	TAMAULIPAS
39	MEX	BENITO JUÏ¿½REZ	QUINTANA ROO
40	MEX	MATAMOROS	TAMAULIPAS
41	MEX	XALAPA	VERACRUZ
42	MEX	CELAYA	GUANAJUATO
43	MEX	MAZATLÏ¿½N	SINALOA
44	MEX	ENSENADA	BAJA CALIFORNIA
45	MEX	AHOME	SINALOA
46	MEX	CAJEME	SONORA
47	MEX	CUERNAVACA	MORELOS
48	MEX	TONALÏ¿½	JALISCO
49	MEX	VALLE DE CHALCO SOLIDARIDAD	MÏ¿½XICO
50	MEX	NUEVO LAREDO	TAMAULIPAS
51	MEX	TEPIC	NAYARIT
52	MEX	TAMPICO	TAMAULIPAS
53	MEX	IXTAPALUCA	MÏ¿½XICO
54	MEX	APODACA	NUEVO LEÏ¿½N
55	MEX	GUASAVE	SINALOA
56	MEX	GÏ¿½MEZ PALACIO	DURANGO
57	MEX	TAPACHULA	CHIAPAS
58	MEX	NICOLÏ¿½S ROMERO	MÏ¿½XICO
59	MEX	COATZACOALCOS	VERACRUZ
60	MEX	URUAPAN	MICHOACÏ¿½N DE OCAMP
61	MEX	VICTORIA	TAMAULIPAS
62	MEX	OAXACA DE JUÏ¿½REZ	OAXACA
63	MEX	COACALCO DE BERRIOZÏ¿½BAL	MÏ¿½XICO
64	MEX	PACHUCA DE SOTO	HIDALGO
65	MEX	GENERAL ESCOBEDO	NUEVO LEÏ¿½N
66	MEX	SALAMANCA	GUANAJUATO
67	MEX	SANTA CATARINA	NUEVO LEÏ¿½N
68	MEX	TEHUACÏ¿½N	PUEBLA
69	MEX	CHALCO	MÏ¿½XICO
70	MEX	CÏ¿½RDENAS	TABASCO
71	MEX	CAMPECHE	CAMPECHE
72	MEX	LA PAZ	MÏ¿½XICO
73	MEX	OTHÏ¿½N P. BLANCO (CHETUMAL)	QUINTANA ROO
74	MEX	TEXCOCO	MÏ¿½XICO
75	MEX	LA PAZ	BAJA CALIFORNIA SUR
76	MEX	METEPEC	MÏ¿½XICO
77	MEX	MONCLOVA	COAHUILA DE ZARAGOZA
78	MEX	HUIXQUILUCAN	MÏ¿½XICO
79	MEX	CHILPANCINGO DE LOS BRAVO	GUERRERO
80	MEX	PUERTO VALLARTA	JALISCO
81	MEX	FRESNILLO	ZACATECAS
82	MEX	CIUDAD MADERO	TAMAULIPAS
83	MEX	SOLEDAD DE GRACIANO SÏ¿½NCHEZ	SAN LUIS POTOSÏ¿½
84	MEX	SAN JUAN DEL RÏ¿½O	QUERÏ¿½TARO
85	MEX	SAN FELIPE DEL PROGRESO	MÏ¿½XICO
86	MEX	CÏ¿½RDOBA	VERACRUZ
87	MEX	TECÏ¿½MAC	MÏ¿½XICO
88	MEX	OCOSINGO	CHIAPAS
89	MEX	CARMEN	CAMPECHE
90	MEX	LÏ¿½ZARO CÏ¿½RDENAS	MICHOACÏ¿½N DE OCAMP
91	MEX	JIUTEPEC	MORELOS
92	MEX	PAPANTLA	VERACRUZ
93	MEX	COMALCALCO	TABASCO
94	MEX	ZAMORA	MICHOACÏ¿½N DE OCAMP
95	MEX	NOGALES	SONORA
96	MEX	HUIMANGUILLO	TABASCO
97	MEX	CUAUTLA	MORELOS
98	MEX	MINATITLÏ¿½N	VERACRUZ
99	MEX	POZA RICA DE HIDALGO	VERACRUZ
100	MEX	CIUDAD VALLES	SAN LUIS POTOSÏ¿½
101	MEX	NAVOLATO	SINALOA
102	MEX	SAN LUIS RÏ¿½O COLORADO	SONORA
103	MEX	PÏ¿½NJAMO	GUANAJUATO
104	MEX	SAN ANDRÏ¿½S TUXTLA	VERACRUZ
105	MEX	GUANAJUATO	GUANAJUATO
106	MEX	NAVOJOA	SONORA
107	MEX	ZITÏ¿½CUARO	MICHOACÏ¿½N DE OCAMP
108	MEX	BOCA DEL RÏ¿½O	VERACRUZ-LLAVE
109	MEX	ALLENDE	GUANAJUATO
110	MEX	SILAO	GUANAJUATO
111	MEX	MACUSPANA	TABASCO
112	MEX	SAN JUAN BAUTISTA TUXTEPEC	OAXACA
113	MEX	SAN CRISTÏ¿½BAL DE LAS CASAS	CHIAPAS
114	MEX	VALLE DE SANTIAGO	GUANAJUATO
115	MEX	GUAYMAS	SONORA
116	MEX	COLIMA	COLIMA
117	MEX	DOLORES HIDALGO	GUANAJUATO
118	MEX	LAGOS DE MORENO	JALISCO
119	MEX	PIEDRAS NEGRAS	COAHUILA DE ZARAGOZA
120	MEX	ALTAMIRA	TAMAULIPAS
121	MEX	TÏ¿½XPAM	VERACRUZ
122	MEX	SAN PEDRO GARZA GARCÏ¿½A	NUEVO LEÏ¿½N
123	MEX	CUAUHTÏ¿½MOC	CHIHUAHUA
124	MEX	MANZANILLO	COLIMA
125	MEX	IGUALA DE LA INDEPENDENCIA	GUERRERO
126	MEX	ZACATECAS	ZACATECAS
127	MEX	TLAJOMULCO DE ZÏ¿½Ï¿½IGA	JALISCO
128	MEX	TULANCINGO DE BRAVO	HIDALGO
129	MEX	ZINACANTEPEC	MÏ¿½XICO
130	MEX	SAN MARTÏ¿½N TEXMELUCAN	PUEBLA
131	MEX	TEPATITLÏ¿½N DE MORELOS	JALISCO
132	MEX	MARTÏ¿½NEZ DE LA TORRE	VERACRUZ
133	MEX	ORIZABA	VERACRUZ
134	MEX	APATZINGÏ¿½N	MICHOACÏ¿½N DE OCAMP
135	MEX	ATLIXCO	PUEBLA
136	MEX	DELICIAS	CHIHUAHUA
137	MEX	IXTLAHUACA	MÏ¿½XICO
138	MEX	EL MANTE	TAMAULIPAS
139	MEX	LERDO	DURANGO
140	MEX	ALMOLOYA DE JUÏ¿½REZ	MÏ¿½XICO
141	MEX	ACÏ¿½MBARO	GUANAJUATO
142	MEX	ACUÏ¿½A	COAHUILA DE ZARAGOZA
143	MEX	GUADALUPE	ZACATECAS
144	MEX	HUEJUTLA DE REYES	HIDALGO
145	MEX	HIDALGO	MICHOACÏ¿½N DE OCAMP
146	MEX	LOS CABOS	BAJA CALIFORNIA SUR
147	MEX	COMITÏ¿½N DE DOMÏ¿½NGUEZ	CHIAPAS
148	MEX	CUNDUACÏ¿½N	TABASCO
149	MEX	RÏ¿½O BRAVO	TAMAULIPAS
150	MEX	TEMAPACHE	VERACRUZ
151	MEX	CHILAPA DE ALVAREZ	GUERRERO
152	MEX	HIDALGO DEL PARRAL	CHIHUAHUA
153	MEX	SAN FRANCISCO DEL RINCÏ¿½N	GUANAJUATO
154	MEX	TAXCO DE ALARCÏ¿½N	GUERRERO
155	MEX	ZUMPANGO	MÏ¿½XICO
156	MEX	SAN PEDRO CHOLULA	PUEBLA
157	MEX	LERMA	MÏ¿½XICO
158	MEX	TECOMÏ¿½N	COLIMA
159	MEX	LAS MARGARITAS	CHIAPAS
160	MEX	COSOLEACAQUE	VERACRUZ
161	MEX	SAN LUIS DE LA PAZ	GUANAJUATO
162	MEX	JOSÏ¿½ AZUETA	GUERRERO
163	MEX	SANTIAGO IXCUINTLA	NAYARIT
164	MEX	SAN FELIPE	GUANAJUATO
165	MEX	TEJUPILCO	MÏ¿½XICO
166	MEX	TANTOYUCA	VERACRUZ
167	MEX	SALVATIERRA	GUANAJUATO
168	MEX	TULTEPEC	MÏ¿½XICO
169	MEX	TEMIXCO	MORELOS
170	MEX	MATAMOROS	COAHUILA DE ZARAGOZA
171	MEX	PÏ¿½NUCO	VERACRUZ
172	MEX	EL FUERTE	SINALOA
173	MEX	TIERRA BLANCA	VERACRUZ
1	MHL	DALAP-ULIGA-DARRIT	MAJURO
1	MKD	SKOPJE	SKOPJE
1	MLI	BAMAKO	BAMAKO
1	MLT	BIRKIRKARA	OUTER HARBOUR
2	MLT	VALLETTA	INNER HARBOUR
1	MMR	RANGOON (YANGON)	RANGOON [YANGON]
2	MMR	MANDALAY	MANDALAY
3	MMR	MOULMEIN (MAWLAMYINE)	MON
4	MMR	PEGU (BAGO)	PEGU [BAGO]
5	MMR	BASSEIN (PATHEIN)	IRRAWADDY [AYEYARWAD
6	MMR	MONYWA	SAGAING
7	MMR	SITTWE (AKYAB)	RAKHINE
8	MMR	TAUNGGYI (TAUNGGYE)	SHAN
9	MMR	MEIKHTILA	MANDALAY
10	MMR	MERGUI (MYEIK)	TENASSERIM [TANINTHA
11	MMR	LASHIO (LASHO)	SHAN
12	MMR	PROME (PYAY)	PEGU [BAGO]
13	MMR	HENZADA (HINTHADA)	IRRAWADDY [AYEYARWAD
14	MMR	MYINGYAN	MANDALAY
15	MMR	TAVOY (DAWEI)	TENASSERIM [TANINTHA
16	MMR	PAGAKKU (PAKOKKU)	MAGWE [MAGWAY]
1	MNG	ULAN BATOR	ULAANBAATAR
1	MNP	GARAPAN	SAIPAN
1	MOZ	MAPUTO	MAPUTO
2	MOZ	MATOLA	MAPUTO
3	MOZ	BEIRA	SOFALA
4	MOZ	NAMPULA	NAMPULA
5	MOZ	CHIMOIO	MANICA
6	MOZ	NAÏ¿½ALA-PORTO	NAMPULA
7	MOZ	QUELIMANE	ZAMBÏ¿½ZIA
8	MOZ	MOCUBA	ZAMBÏ¿½ZIA
9	MOZ	TETE	TETE
10	MOZ	XAI-XAI	GAZA
11	MOZ	GURUE	ZAMBÏ¿½ZIA
12	MOZ	MAXIXE	INHAMBANE
1	MRT	NOUAKCHOTT	NOUAKCHOTT
2	MRT	NOUÏ¿½DHIBOU	DAKHLET NOUÏ¿½DHIBOU
1	MSR	PLYMOUTH	PLYMOUTH
1	MTQ	FORT-DE-FRANCE	FORT-DE-FRANCE
1	MUS	PORT-LOUIS	PORT-LOUIS
2	MUS	BEAU BASSIN-ROSE HILL	PLAINES WILHELMS
3	MUS	VACOAS-PHOENIX	PLAINES WILHELMS
1	MWI	BLANTYRE	BLANTYRE
2	MWI	LILONGWE	LILONGWE
1	MYS	KUALA LUMPUR	WILAYAH PERSEKUTUAN
2	MYS	IPOH	PERAK
3	MYS	JOHOR BAHARU	JOHOR
4	MYS	PETALING JAYA	SELANGOR
5	MYS	KELANG	SELANGOR
6	MYS	KUALA TERENGGANU	TERENGGANU
7	MYS	PINANG	PULAU PINANG
8	MYS	KOTA BHARU	KELANTAN
9	MYS	KUANTAN	PAHANG
10	MYS	TAIPING	PERAK
11	MYS	SEREMBAN	NEGERI SEMBILAN
12	MYS	KUCHING	SARAWAK
13	MYS	SIBU	SARAWAK
14	MYS	SANDAKAN	SABAH
15	MYS	ALOR SETAR	KEDAH
16	MYS	SELAYANG BARU	SELANGOR
17	MYS	SUNGAI PETANI	KEDAH
18	MYS	SHAH ALAM	SELANGOR
1	MYT	MAMOUTZOU	MAMOUTZOU
1	NAM	WINDHOEK	KHOMAS
1	NCL	NOUMÏ¿½A	Ï¿½
1	NER	NIAMEY	NIAMEY
2	NER	ZINDER	ZINDER
3	NER	MARADI	MARADI
1	NFK	KINGSTON	Ï¿½
1	NGA	LAGOS	LAGOS
2	NGA	IBADAN	OYO & OSUN
3	NGA	OGBOMOSHO	OYO & OSUN
4	NGA	KANO	KANO & JIGAWA
5	NGA	OSHOGBO	OYO & OSUN
6	NGA	ILORIN	KWARA & KOGI
7	NGA	ABEOKUTA	OGUN
8	NGA	PORT HARCOURT	RIVERS & BAYELSA
9	NGA	ZARIA	KADUNA
10	NGA	ILESHA	OYO & OSUN
11	NGA	ONITSHA	ANAMBRA & ENUGU & EB
12	NGA	IWO	OYO & OSUN
13	NGA	ADO-EKITI	ONDO & EKITI
14	NGA	ABUJA	FEDERAL CAPITAL DIST
15	NGA	KADUNA	KADUNA
16	NGA	MUSHIN	LAGOS
17	NGA	MAIDUGURI	BORNO & YOBE
18	NGA	ENUGU	ANAMBRA & ENUGU & EB
19	NGA	EDE	OYO & OSUN
20	NGA	ABA	IMO & ABIA
21	NGA	IFE	OYO & OSUN
22	NGA	ILA	OYO & OSUN
23	NGA	OYO	OYO & OSUN
24	NGA	IKERRE	ONDO & EKITI
25	NGA	BENIN CITY	EDO & DELTA
26	NGA	ISEYIN	OYO & OSUN
27	NGA	KATSINA	KATSINA
28	NGA	JOS	PLATEAU & NASSARAWA
29	NGA	SOKOTO	SOKOTO & KEBBI & ZAM
30	NGA	ILOBU	OYO & OSUN
31	NGA	OFFA	KWARA & KOGI
32	NGA	IKORODU	LAGOS
33	NGA	ILAWE-EKITI	ONDO & EKITI
34	NGA	OWO	ONDO & EKITI
35	NGA	IKIRUN	OYO & OSUN
36	NGA	SHAKI	OYO & OSUN
37	NGA	CALABAR	CROSS RIVER
38	NGA	ONDO	ONDO & EKITI
39	NGA	AKURE	ONDO & EKITI
40	NGA	GUSAU	SOKOTO & KEBBI & ZAM
41	NGA	IJEBU-ODE	OGUN
42	NGA	EFFON-ALAIYE	OYO & OSUN
43	NGA	KUMO	BAUCHI & GOMBE
44	NGA	SHOMOLU	LAGOS
45	NGA	OKA-AKOKO	ONDO & EKITI
46	NGA	IKARE	ONDO & EKITI
47	NGA	SAPELE	EDO & DELTA
48	NGA	DEBA HABE	BAUCHI & GOMBE
49	NGA	MINNA	NIGER
50	NGA	WARRI	EDO & DELTA
51	NGA	BIDA	NIGER
52	NGA	IKIRE	OYO & OSUN
53	NGA	MAKURDI	BENUE
54	NGA	LAFIA	PLATEAU & NASSARAWA
55	NGA	INISA	OYO & OSUN
56	NGA	SHAGAMU	OGUN
57	NGA	AWKA	ANAMBRA & ENUGU & EB
58	NGA	GOMBE	BAUCHI & GOMBE
59	NGA	IGBOHO	OYO & OSUN
60	NGA	EJIGBO	OYO & OSUN
61	NGA	AGEGE	LAGOS
62	NGA	ISE-EKITI	ONDO & EKITI
63	NGA	UGEP	CROSS RIVER
64	NGA	EPE	LAGOS
1	NIC	MANAGUA	MANAGUA
2	NIC	LEÏ¿½N	LEÏ¿½N
3	NIC	CHINANDEGA	CHINANDEGA
4	NIC	MASAYA	MASAYA
1	NIU	ALOFI	Ï¿½
1	NLD	AMSTERDAM	NOORD-HOLLAND
2	NLD	ROTTERDAM	ZUID-HOLLAND
3	NLD	HAAG	ZUID-HOLLAND
4	NLD	UTRECHT	UTRECHT
5	NLD	EINDHOVEN	NOORD-BRABANT
6	NLD	TILBURG	NOORD-BRABANT
7	NLD	GRONINGEN	GRONINGEN
8	NLD	BREDA	NOORD-BRABANT
9	NLD	APELDOORN	GELDERLAND
10	NLD	NIJMEGEN	GELDERLAND
11	NLD	ENSCHEDE	OVERIJSSEL
12	NLD	HAARLEM	NOORD-HOLLAND
13	NLD	ALMERE	FLEVOLAND
14	NLD	ARNHEM	GELDERLAND
15	NLD	ZAANSTAD	NOORD-HOLLAND
16	NLD	Ï¿½S-HERTOGENBOSCH	NOORD-BRABANT
17	NLD	AMERSFOORT	UTRECHT
18	NLD	MAASTRICHT	LIMBURG
19	NLD	DORDRECHT	ZUID-HOLLAND
20	NLD	LEIDEN	ZUID-HOLLAND
21	NLD	HAARLEMMERMEER	NOORD-HOLLAND
22	NLD	ZOETERMEER	ZUID-HOLLAND
23	NLD	EMMEN	DRENTHE
24	NLD	ZWOLLE	OVERIJSSEL
25	NLD	EDE	GELDERLAND
26	NLD	DELFT	ZUID-HOLLAND
27	NLD	HEERLEN	LIMBURG
28	NLD	ALKMAAR	NOORD-HOLLAND
1	NOR	OSLO	OSLO
2	NOR	BERGEN	HORDALAND
3	NOR	TRONDHEIM	SÏ¿½R-TRÏ¿½NDELAG
4	NOR	STAVANGER	ROGALAND
5	NOR	BÏ¿½RUM	AKERSHUS
1	NPL	KATHMANDU	CENTRAL
2	NPL	BIRATNAGAR	EASTERN
3	NPL	POKHARA	WESTERN
4	NPL	LALITAPUR	CENTRAL
5	NPL	BIRGUNJ	CENTRAL
1	NRU	YANGOR	Ï¿½
2	NRU	YAREN	Ï¿½
1	NZL	AUCKLAND	AUCKLAND
2	NZL	CHRISTCHURCH	CANTERBURY
3	NZL	MANUKAU	AUCKLAND
4	NZL	NORTH SHORE	AUCKLAND
5	NZL	WAITAKERE	AUCKLAND
6	NZL	WELLINGTON	WELLINGTON
7	NZL	DUNEDIN	DUNEDIN
8	NZL	HAMILTON	HAMILTON
9	NZL	LOWER HUTT	WELLINGTON
1	OMN	AL-SIB	MASQAT
2	OMN	SALALA	ZUFAR
3	OMN	BAWSHAR	MASQAT
4	OMN	SUHAR	AL-BATINA
5	OMN	MASQAT	MASQAT
1	PAK	KARACHI	SINDH
2	PAK	LAHORE	PUNJAB
3	PAK	FAISALABAD	PUNJAB
4	PAK	RAWALPINDI	PUNJAB
5	PAK	MULTAN	PUNJAB
6	PAK	HYDERABAD	SINDH
7	PAK	GUJRANWALA	PUNJAB
8	PAK	PESHAWAR	NOTHWEST BORDER PROV
9	PAK	QUETTA	BALUCHISTAN
10	PAK	ISLAMABAD	ISLAMABAD
11	PAK	SARGODHA	PUNJAB
12	PAK	SIALKOT	PUNJAB
13	PAK	BAHAWALPUR	PUNJAB
14	PAK	SUKKUR	SINDH
15	PAK	JHANG	PUNJAB
16	PAK	SHEIKHUPURA	PUNJAB
17	PAK	LARKANA	SINDH
18	PAK	GUJRAT	PUNJAB
19	PAK	MARDAN	NOTHWEST BORDER PROV
20	PAK	KASUR	PUNJAB
21	PAK	RAHIM YAR KHAN	PUNJAB
22	PAK	SAHIWAL	PUNJAB
23	PAK	OKARA	PUNJAB
24	PAK	WAH	PUNJAB
25	PAK	DERA GHAZI KHAN	PUNJAB
26	PAK	MIRPUR KHAS	SIND
27	PAK	NAWABSHAH	SIND
28	PAK	MINGORA	NOTHWEST BORDER PROV
29	PAK	CHINIOT	PUNJAB
30	PAK	KAMOKE	PUNJAB
31	PAK	MANDI BUREWALA	PUNJAB
32	PAK	JHELUM	PUNJAB
33	PAK	SADIQABAD	PUNJAB
34	PAK	JACOBABAD	SIND
35	PAK	SHIKARPUR	SIND
36	PAK	KHANEWAL	PUNJAB
37	PAK	HAFIZABAD	PUNJAB
38	PAK	KOHAT	NOTHWEST BORDER PROV
39	PAK	MUZAFFARGARH	PUNJAB
40	PAK	KHANPUR	PUNJAB
41	PAK	GOJRA	PUNJAB
42	PAK	BAHAWALNAGAR	PUNJAB
43	PAK	MURIDKE	PUNJAB
44	PAK	PAK PATTAN	PUNJAB
45	PAK	ABOTTABAD	NOTHWEST BORDER PROV
46	PAK	TANDO ADAM	SIND
47	PAK	JARANWALA	PUNJAB
48	PAK	KHAIRPUR	SIND
49	PAK	CHISHTIAN MANDI	PUNJAB
50	PAK	DASKA	PUNJAB
51	PAK	DADU	SIND
52	PAK	MANDI BAHAUDDIN	PUNJAB
53	PAK	AHMADPUR EAST	PUNJAB
54	PAK	KAMALIA	PUNJAB
55	PAK	KHUZDAR	BALUCHISTAN
56	PAK	VIHARI	PUNJAB
57	PAK	DERA ISMAIL KHAN	NOTHWEST BORDER PROV
58	PAK	WAZIRABAD	PUNJAB
59	PAK	NOWSHERA	NOTHWEST BORDER PROV
1	PAN	CIUDAD DE PANAMÏ¿½	PANAMÏ¿½
2	PAN	SAN MIGUELITO	SAN MIGUELITO
1	PCN	ADAMSTOWN	Ï¿½
1	PER	LIMA	LIMA
2	PER	AREQUIPA	AREQUIPA
3	PER	TRUJILLO	LA LIBERTAD
4	PER	CHICLAYO	LAMBAYEQUE
5	PER	CALLAO	CALLAO
6	PER	IQUITOS	LORETO
7	PER	CHIMBOTE	ANCASH
8	PER	HUANCAYO	JUNÏ¿½N
9	PER	PIURA	PIURA
10	PER	CUSCO	CUSCO
11	PER	PUCALLPA	UCAYALI
12	PER	TACNA	TACNA
13	PER	ICA	ICA
14	PER	SULLANA	PIURA
15	PER	JULIACA	PUNO
16	PER	HUÏ¿½NUCO	HUANUCO
17	PER	AYACUCHO	AYACUCHO
18	PER	CHINCHA ALTA	ICA
19	PER	CAJAMARCA	CAJAMARCA
20	PER	PUNO	PUNO
21	PER	VENTANILLA	CALLAO
22	PER	CASTILLA	PIURA
1	PHL	QUEZON	NATIONAL CAPITAL REG
2	PHL	MANILA	NATIONAL CAPITAL REG
3	PHL	KALOOKAN	NATIONAL CAPITAL REG
4	PHL	DAVAO	SOUTHERN MINDANAO
5	PHL	CEBU	CENTRAL VISAYAS
6	PHL	ZAMBOANGA	WESTERN MINDANAO
7	PHL	PASIG	NATIONAL CAPITAL REG
8	PHL	VALENZUELA	NATIONAL CAPITAL REG
9	PHL	LAS PIÏ¿½AS	NATIONAL CAPITAL REG
10	PHL	ANTIPOLO	SOUTHERN TAGALOG
11	PHL	TAGUIG	NATIONAL CAPITAL REG
12	PHL	CAGAYAN DE ORO	NORTHERN MINDANAO
13	PHL	PARAÏ¿½AQUE	NATIONAL CAPITAL REG
14	PHL	MAKATI	NATIONAL CAPITAL REG
15	PHL	BACOLOD	WESTERN VISAYAS
16	PHL	GENERAL SANTOS	SOUTHERN MINDANAO
17	PHL	MARIKINA	NATIONAL CAPITAL REG
18	PHL	DASMARIÏ¿½AS	SOUTHERN TAGALOG
19	PHL	MUNTINLUPA	NATIONAL CAPITAL REG
20	PHL	ILOILO	WESTERN VISAYAS
21	PHL	PASAY	NATIONAL CAPITAL REG
22	PHL	MALABON	NATIONAL CAPITAL REG
23	PHL	SAN JOSÏ¿½ DEL MONTE	CENTRAL LUZON
24	PHL	BACOOR	SOUTHERN TAGALOG
25	PHL	ILIGAN	CENTRAL MINDANAO
26	PHL	CALAMBA	SOUTHERN TAGALOG
27	PHL	MANDALUYONG	NATIONAL CAPITAL REG
28	PHL	BUTUAN	CARAGA
29	PHL	ANGELES	CENTRAL LUZON
30	PHL	TARLAC	CENTRAL LUZON
31	PHL	MANDAUE	CENTRAL VISAYAS
32	PHL	BAGUIO	CAR
33	PHL	BATANGAS	SOUTHERN TAGALOG
34	PHL	CAINTA	SOUTHERN TAGALOG
35	PHL	SAN PEDRO	SOUTHERN TAGALOG
36	PHL	NAVOTAS	NATIONAL CAPITAL REG
37	PHL	CABANATUAN	CENTRAL LUZON
38	PHL	SAN FERNANDO	CENTRAL LUZON
39	PHL	LIPA	SOUTHERN TAGALOG
40	PHL	LAPU-LAPU	CENTRAL VISAYAS
41	PHL	SAN PABLO	SOUTHERN TAGALOG
42	PHL	BIÏ¿½AN	SOUTHERN TAGALOG
43	PHL	TAYTAY	SOUTHERN TAGALOG
44	PHL	LUCENA	SOUTHERN TAGALOG
45	PHL	IMUS	SOUTHERN TAGALOG
46	PHL	OLONGAPO	CENTRAL LUZON
47	PHL	BINANGONAN	SOUTHERN TAGALOG
48	PHL	SANTA ROSA	SOUTHERN TAGALOG
49	PHL	TAGUM	SOUTHERN MINDANAO
50	PHL	TACLOBAN	EASTERN VISAYAS
51	PHL	MALOLOS	CENTRAL LUZON
52	PHL	MABALACAT	CENTRAL LUZON
53	PHL	COTABATO	CENTRAL MINDANAO
54	PHL	MEYCAUAYAN	CENTRAL LUZON
55	PHL	PUERTO PRINCESA	SOUTHERN TAGALOG
56	PHL	LEGAZPI	BICOL
57	PHL	SILANG	SOUTHERN TAGALOG
58	PHL	ORMOC	EASTERN VISAYAS
59	PHL	SAN CARLOS	ILOCOS
60	PHL	KABANKALAN	WESTERN VISAYAS
61	PHL	TALISAY	CENTRAL VISAYAS
62	PHL	VALENCIA	NORTHERN MINDANAO
63	PHL	CALBAYOG	EASTERN VISAYAS
64	PHL	SANTA MARIA	CENTRAL LUZON
65	PHL	PAGADIAN	WESTERN MINDANAO
66	PHL	CADIZ	WESTERN VISAYAS
67	PHL	BAGO	WESTERN VISAYAS
68	PHL	TOLEDO	CENTRAL VISAYAS
69	PHL	NAGA	BICOL
70	PHL	SAN MATEO	SOUTHERN TAGALOG
71	PHL	PANABO	SOUTHERN MINDANAO
72	PHL	KORONADAL	SOUTHERN MINDANAO
73	PHL	MARAWI	CENTRAL MINDANAO
74	PHL	DAGUPAN	ILOCOS
75	PHL	SAGAY	WESTERN VISAYAS
76	PHL	ROXAS	WESTERN VISAYAS
77	PHL	LUBAO	CENTRAL LUZON
78	PHL	DIGOS	SOUTHERN MINDANAO
79	PHL	SAN MIGUEL	CENTRAL LUZON
80	PHL	MALAYBALAY	NORTHERN MINDANAO
81	PHL	TUGUEGARAO	CAGAYAN VALLEY
82	PHL	ILAGAN	CAGAYAN VALLEY
83	PHL	BALIUAG	CENTRAL LUZON
84	PHL	SURIGAO	CARAGA
85	PHL	SAN CARLOS	WESTERN VISAYAS
86	PHL	SAN JUAN DEL MONTE	NATIONAL CAPITAL REG
87	PHL	TANAUAN	SOUTHERN TAGALOG
88	PHL	CONCEPCION	CENTRAL LUZON
89	PHL	RODRIGUEZ (MONTALBAN)	SOUTHERN TAGALOG
90	PHL	SARIAYA	SOUTHERN TAGALOG
91	PHL	MALASIQUI	ILOCOS
92	PHL	GENERAL MARIANO ALVAREZ	SOUTHERN TAGALOG
93	PHL	URDANETA	ILOCOS
94	PHL	HAGONOY	CENTRAL LUZON
95	PHL	SAN JOSE	SOUTHERN TAGALOG
96	PHL	POLOMOLOK	SOUTHERN MINDANAO
97	PHL	SANTIAGO	CAGAYAN VALLEY
98	PHL	TANZA	SOUTHERN TAGALOG
99	PHL	OZAMIS	NORTHERN MINDANAO
100	PHL	MEXICO	CENTRAL LUZON
101	PHL	SAN JOSE	CENTRAL LUZON
102	PHL	SILAY	WESTERN VISAYAS
103	PHL	GENERAL TRIAS	SOUTHERN TAGALOG
104	PHL	TABACO	BICOL
105	PHL	CABUYAO	SOUTHERN TAGALOG
106	PHL	CALAPAN	SOUTHERN TAGALOG
107	PHL	MATI	SOUTHERN MINDANAO
108	PHL	MIDSAYAP	CENTRAL MINDANAO
109	PHL	CAUAYAN	CAGAYAN VALLEY
110	PHL	GINGOOG	NORTHERN MINDANAO
111	PHL	DUMAGUETE	CENTRAL VISAYAS
112	PHL	SAN FERNANDO	ILOCOS
113	PHL	ARAYAT	CENTRAL LUZON
114	PHL	BAYAWAN (TULONG)	CENTRAL VISAYAS
115	PHL	KIDAPAWAN	CENTRAL MINDANAO
116	PHL	DARAGA (LOCSIN)	BICOL
117	PHL	MARILAO	CENTRAL LUZON
118	PHL	MALITA	SOUTHERN MINDANAO
119	PHL	DIPOLOG	WESTERN MINDANAO
120	PHL	CAVITE	SOUTHERN TAGALOG
121	PHL	DANAO	CENTRAL VISAYAS
122	PHL	BISLIG	CARAGA
123	PHL	TALAVERA	CENTRAL LUZON
124	PHL	GUAGUA	CENTRAL LUZON
125	PHL	BAYAMBANG	ILOCOS
126	PHL	NASUGBU	SOUTHERN TAGALOG
127	PHL	BAYBAY	EASTERN VISAYAS
128	PHL	CAPAS	CENTRAL LUZON
129	PHL	SULTAN KUDARAT	ARMM
130	PHL	LAOAG	ILOCOS
131	PHL	BAYUGAN	CARAGA
132	PHL	MALUNGON	SOUTHERN MINDANAO
133	PHL	SANTA CRUZ	SOUTHERN TAGALOG
134	PHL	SORSOGON	BICOL
135	PHL	CANDELARIA	SOUTHERN TAGALOG
136	PHL	LIGAO	BICOL
1	PLW	KOROR	KOROR
1	PNG	PORT MORESBY	NATIONAL CAPITAL DIS
1	POL	WARSZAWA	MAZOWIECKIE
2	POL	LÏ¿½DZ	LODZKIE
3	POL	KRAKÏ¿½W	MALOPOLSKIE
4	POL	WROCLAW	DOLNOSLASKIE
5	POL	POZNAN	WIELKOPOLSKIE
6	POL	GDANSK	POMORSKIE
7	POL	SZCZECIN	ZACHODNIO-POMORSKIE
8	POL	BYDGOSZCZ	KUJAWSKO-POMORSKIE
9	POL	LUBLIN	LUBELSKIE
10	POL	KATOWICE	SLASKIE
11	POL	BIALYSTOK	PODLASKIE
12	POL	CZESTOCHOWA	SLASKIE
13	POL	GDYNIA	POMORSKIE
14	POL	SOSNOWIEC	SLASKIE
15	POL	RADOM	MAZOWIECKIE
16	POL	KIELCE	SWIETOKRZYSKIE
17	POL	GLIWICE	SLASKIE
18	POL	TORUN	KUJAWSKO-POMORSKIE
19	POL	BYTOM	SLASKIE
20	POL	ZABRZE	SLASKIE
21	POL	BIELSKO-BIALA	SLASKIE
22	POL	OLSZTYN	WARMINSKO-MAZURSKIE
23	POL	RZESZÏ¿½W	PODKARPACKIE
24	POL	RUDA SLASKA	SLASKIE
25	POL	RYBNIK	SLASKIE
26	POL	WALBRZYCH	DOLNOSLASKIE
27	POL	TYCHY	SLASKIE
28	POL	DABROWA GÏ¿½RNICZA	SLASKIE
29	POL	PLOCK	MAZOWIECKIE
30	POL	ELBLAG	WARMINSKO-MAZURSKIE
31	POL	OPOLE	OPOLSKIE
32	POL	GORZÏ¿½W WIELKOPOLSKI	LUBUSKIE
33	POL	WLOCLAWEK	KUJAWSKO-POMORSKIE
34	POL	CHORZÏ¿½W	SLASKIE
35	POL	TARNÏ¿½W	MALOPOLSKIE
36	POL	ZIELONA GÏ¿½RA	LUBUSKIE
37	POL	KOSZALIN	ZACHODNIO-POMORSKIE
38	POL	LEGNICA	DOLNOSLASKIE
39	POL	KALISZ	WIELKOPOLSKIE
40	POL	GRUDZIADZ	KUJAWSKO-POMORSKIE
41	POL	SLUPSK	POMORSKIE
42	POL	JASTRZEBIE-ZDRÏ¿½J	SLASKIE
43	POL	JAWORZNO	SLASKIE
44	POL	JELENIA GÏ¿½RA	DOLNOSLASKIE
1	PRI	SAN JUAN	SAN JUAN
2	PRI	BAYAMÏ¿½N	BAYAMÏ¿½N
3	PRI	PONCE	PONCE
4	PRI	CAROLINA	CAROLINA
5	PRI	CAGUAS	CAGUAS
6	PRI	ARECIBO	ARECIBO
7	PRI	GUAYNABO	GUAYNABO
8	PRI	MAYAGÏ¿½EZ	MAYAGÏ¿½EZ
9	PRI	TOA BAJA	TOA BAJA
1	PRK	PYONGYANG	PYONGYANG-SI
2	PRK	HAMHUNG	HAMGYONG N
3	PRK	CHONGJIN	HAMGYONG P
4	PRK	NAMPO	NAMPO-SI
5	PRK	SINUIJU	PYONGAN P
6	PRK	WONSAN	KANGWON
7	PRK	PHYONGSONG	PYONGAN N
8	PRK	SARIWON	HWANGHAE P
9	PRK	HAEJU	HWANGHAE N
10	PRK	KANGGYE	CHAGANG
11	PRK	KIMCHAEK	HAMGYONG P
12	PRK	HYESAN	YANGGANG
13	PRK	KAESONG	KAESONG-SI
1	PRT	LISBOA	LISBOA
2	PRT	PORTO	PORTO
3	PRT	AMADORA	LISBOA
4	PRT	COÏ¿½MBRA	COÏ¿½MBRA
5	PRT	BRAGA	BRAGA
1	PRY	ASUNCIÏ¿½N	ASUNCIÏ¿½N
2	PRY	CIUDAD DEL ESTE	ALTO PARANÏ¿½
3	PRY	SAN LORENZO	CENTRAL
4	PRY	LAMBARÏ¿½	CENTRAL
5	PRY	FERNANDO DE LA MORA	CENTRAL
1	PSE	GAZA	GAZA
2	PSE	KHAN YUNIS	KHAN YUNIS
3	PSE	HEBRON	HEBRON
4	PSE	JABALIYA	NORTH GAZA
5	PSE	NABLUS	NABLUS
6	PSE	RAFAH	RAFAH
1	PYF	FAAA	TAHITI
2	PYF	PAPEETE	TAHITI
1	QAT	DOHA	DOHA
1	REU	SAINT-DENIS	SAINT-DENIS
1	ROM	BUCURESTI	BUKAREST
2	ROM	IASI	IASI
3	ROM	CONSTANTA	CONSTANTA
4	ROM	CLUJ-NAPOCA	CLUJ
5	ROM	GALATI	GALATI
6	ROM	TIMISOARA	TIMIS
7	ROM	BRASOV	BRASOV
8	ROM	CRAIOVA	DOLJ
9	ROM	PLOIESTI	PRAHOVA
10	ROM	BRAILA	BRAILA
11	ROM	ORADEA	BIHOR
12	ROM	BACAU	BACAU
13	ROM	PITESTI	ARGES
14	ROM	ARAD	ARAD
15	ROM	SIBIU	SIBIU
16	ROM	TÏ¿½RGU MURES	MURES
17	ROM	BAIA MARE	MARAMURES
18	ROM	BUZAU	BUZAU
19	ROM	SATU MARE	SATU MARE
20	ROM	BOTOSANI	BOTOSANI
21	ROM	PIATRA NEAMT	NEAMT
22	ROM	RÏ¿½MNICU VÏ¿½LCEA	VÏ¿½LCEA
23	ROM	SUCEAVA	SUCEAVA
24	ROM	DROBETA-TURNU SEVERIN	MEHEDINTI
25	ROM	TÏ¿½RGOVISTE	DÏ¿½MBOVITA
26	ROM	FOCSANI	VRANCEA
27	ROM	TÏ¿½RGU JIU	GORJ
28	ROM	TULCEA	TULCEA
29	ROM	RESITA	CARAS-SEVERIN
1	RUS	MOSCOW	MOSCOW (CITY)
2	RUS	ST PETERSBURG	PIETARI
3	RUS	NOVOSIBIRSK	NOVOSIBIRSK
4	RUS	NIZNI NOVGOROD	NIZNI NOVGOROD
5	RUS	JEKATERINBURG	SVERDLOVSK
6	RUS	SAMARA	SAMARA
7	RUS	OMSK	OMSK
8	RUS	KAZAN	TATARSTAN
9	RUS	UFA	BAÏ¿½KORTOSTAN
10	RUS	TÏ¿½ELJABINSK	TÏ¿½ELJABINSK
11	RUS	ROSTOV-NA-DONU	ROSTOV-NA-DONU
12	RUS	PERM	PERM
13	RUS	VOLGOGRAD	VOLGOGRAD
14	RUS	VORONEZ	VORONEZ
15	RUS	KRASNOJARSK	KRASNOJARSK
16	RUS	SARATOV	SARATOV
17	RUS	TOLJATTI	SAMARA
18	RUS	ULJANOVSK	ULJANOVSK
19	RUS	IZEVSK	UDMURTIA
20	RUS	KRASNODAR	KRASNODAR
21	RUS	JAROSLAVL	JAROSLAVL
22	RUS	HABAROVSK	HABAROVSK
23	RUS	VLADIVOSTOK	PRIMORJE
24	RUS	IRKUTSK	IRKUTSK
25	RUS	BARNAUL	ALTAI
26	RUS	NOVOKUZNETSK	KEMEROVO
27	RUS	PENZA	PENZA
28	RUS	RJAZAN	RJAZAN
29	RUS	ORENBURG	ORENBURG
30	RUS	LIPETSK	LIPETSK
31	RUS	NABEREZNYJE TÏ¿½ELNY	TATARSTAN
32	RUS	TULA	TULA
33	RUS	TJUMEN	TJUMEN
34	RUS	KEMEROVO	KEMEROVO
35	RUS	ASTRAHAN	ASTRAHAN
36	RUS	TOMSK	TOMSK
37	RUS	KIROV	KIROV
38	RUS	IVANOVO	IVANOVO
39	RUS	TÏ¿½EBOKSARY	TÏ¿½UVASSIA
40	RUS	BRJANSK	BRJANSK
41	RUS	TVER	TVER
42	RUS	KURSK	KURSK
43	RUS	MAGNITOGORSK	TÏ¿½ELJABINSK
44	RUS	KALININGRAD	KALININGRAD
45	RUS	NIZNI TAGIL	SVERDLOVSK
46	RUS	MURMANSK	MURMANSK
47	RUS	ULAN-UDE	BURJATIA
48	RUS	KURGAN	KURGAN
49	RUS	ARKANGELI	ARKANGELI
50	RUS	SOTÏ¿½I	KRASNODAR
51	RUS	SMOLENSK	SMOLENSK
52	RUS	ORJOL	ORJOL
53	RUS	STAVROPOL	STAVROPOL
54	RUS	BELGOROD	BELGOROD
55	RUS	KALUGA	KALUGA
56	RUS	VLADIMIR	VLADIMIR
57	RUS	MAHATÏ¿½KALA	DAGESTAN
58	RUS	TÏ¿½EREPOVETS	VOLOGDA
59	RUS	SARANSK	MORDVA
60	RUS	TAMBOV	TAMBOV
61	RUS	VLADIKAVKAZ	NORTH OSSETIA-ALANIA
62	RUS	TÏ¿½ITA	TÏ¿½ITA
63	RUS	VOLOGDA	VOLOGDA
64	RUS	VELIKI NOVGOROD	NOVGOROD
65	RUS	KOMSOMOLSK-NA-AMURE	HABAROVSK
66	RUS	KOSTROMA	KOSTROMA
67	RUS	VOLZSKI	VOLGOGRAD
68	RUS	TAGANROG	ROSTOV-NA-DONU
69	RUS	PETROSKOI	KARJALA
70	RUS	BRATSK	IRKUTSK
71	RUS	DZERZINSK	NIZNI NOVGOROD
72	RUS	SURGUT	HANTI-MANSIA
73	RUS	ORSK	ORENBURG
74	RUS	STERLITAMAK	BAÏ¿½KORTOSTAN
75	RUS	ANGARSK	IRKUTSK
76	RUS	JOÏ¿½KAR-OLA	MARINMAA
77	RUS	RYBINSK	JAROSLAVL
78	RUS	PROKOPJEVSK	KEMEROVO
79	RUS	NIZNEVARTOVSK	HANTI-MANSIA
80	RUS	NALTÏ¿½IK	KABARDI-BALKARIA
81	RUS	SYKTYVKAR	KOMI
82	RUS	SEVERODVINSK	ARKANGELI
83	RUS	BIJSK	ALTAI
84	RUS	NIZNEKAMSK	TATARSTAN
85	RUS	BLAGOVEÏ¿½TÏ¿½ENSK	AMUR
86	RUS	Ï¿½AHTY	ROSTOV-NA-DONU
87	RUS	STARYI OSKOL	BELGOROD
88	RUS	ZELENOGRAD	MOSCOW (CITY)
89	RUS	BALAKOVO	SARATOV
90	RUS	NOVOROSSIJSK	KRASNODAR
91	RUS	PIHKOVA	PIHKOVA
92	RUS	ZLATOUST	TÏ¿½ELJABINSK
93	RUS	JAKUTSK	SAHA (JAKUTIA)
94	RUS	PODOLSK	MOSKOVA
95	RUS	PETROPAVLOVSK-KAMTÏ¿½ATSKI	KAMTÏ¿½ATKA
96	RUS	KAMENSK-URALSKI	SVERDLOVSK
97	RUS	ENGELS	SARATOV
98	RUS	SYZRAN	SAMARA
99	RUS	GROZNY	TÏ¿½ETÏ¿½ENIA
100	RUS	NOVOTÏ¿½ERKASSK	ROSTOV-NA-DONU
101	RUS	BEREZNIKI	PERM
102	RUS	JUZNO-SAHALINSK	SAHALIN
103	RUS	VOLGODONSK	ROSTOV-NA-DONU
104	RUS	ABAKAN	HAKASSIA
105	RUS	MAIKOP	ADYGEA
106	RUS	MIASS	TÏ¿½ELJABINSK
107	RUS	ARMAVIR	KRASNODAR
108	RUS	LJUBERTSY	MOSKOVA
109	RUS	RUBTSOVSK	ALTAI
110	RUS	KOVROV	VLADIMIR
111	RUS	NAHODKA	PRIMORJE
112	RUS	USSURIJSK	PRIMORJE
113	RUS	SALAVAT	BAÏ¿½KORTOSTAN
114	RUS	MYTIÏ¿½TÏ¿½I	MOSKOVA
115	RUS	KOLOMNA	MOSKOVA
116	RUS	ELEKTROSTAL	MOSKOVA
117	RUS	MUROM	VLADIMIR
118	RUS	KOLPINO	PIETARI
119	RUS	NORILSK	KRASNOJARSK
120	RUS	ALMETJEVSK	TATARSTAN
121	RUS	NOVOMOSKOVSK	TULA
122	RUS	DIMITROVGRAD	ULJANOVSK
123	RUS	PERVOURALSK	SVERDLOVSK
124	RUS	HIMKI	MOSKOVA
125	RUS	BALAÏ¿½IHA	MOSKOVA
126	RUS	NEVINNOMYSSK	STAVROPOL
127	RUS	PJATIGORSK	STAVROPOL
128	RUS	KOROLEV	MOSKOVA
129	RUS	SERPUHOV	MOSKOVA
130	RUS	ODINTSOVO	MOSKOVA
131	RUS	OREHOVO-ZUJEVO	MOSKOVA
132	RUS	KAMYÏ¿½IN	VOLGOGRAD
133	RUS	NOVOTÏ¿½EBOKSARSK	TÏ¿½UVASSIA
134	RUS	TÏ¿½ERKESSK	KARATÏ¿½AI-TÏ¿½ERKES
135	RUS	ATÏ¿½INSK	KRASNOJARSK
136	RUS	MAGADAN	MAGADAN
137	RUS	MITÏ¿½URINSK	TAMBOV
138	RUS	KISLOVODSK	STAVROPOL
139	RUS	JELETS	LIPETSK
140	RUS	SEVERSK	TOMSK
141	RUS	NOGINSK	MOSKOVA
142	RUS	VELIKIJE LUKI	PIHKOVA
143	RUS	NOVOKUIBYÏ¿½EVSK	SAMARA
144	RUS	NEFTEKAMSK	BAÏ¿½KORTOSTAN
145	RUS	LENINSK-KUZNETSKI	KEMEROVO
146	RUS	OKTJABRSKI	BAÏ¿½KORTOSTAN
147	RUS	SERGIJEV POSAD	MOSKOVA
148	RUS	ARZAMAS	NIZNI NOVGOROD
149	RUS	KISELJOVSK	KEMEROVO
150	RUS	NOVOTROITSK	ORENBURG
151	RUS	OBNINSK	KALUGA
152	RUS	KANSK	KRASNOJARSK
153	RUS	GLAZOV	UDMURTIA
154	RUS	SOLIKAMSK	PERM
155	RUS	SARAPUL	UDMURTIA
156	RUS	UST-ILIMSK	IRKUTSK
157	RUS	Ï¿½TÏ¿½OLKOVO	MOSKOVA
158	RUS	MEZDURETÏ¿½ENSK	KEMEROVO
159	RUS	USOLJE-SIBIRSKOJE	IRKUTSK
160	RUS	ELISTA	KALMYKIA
161	RUS	NOVOÏ¿½AHTINSK	ROSTOV-NA-DONU
162	RUS	VOTKINSK	UDMURTIA
163	RUS	KYZYL	TYVA
164	RUS	SEROV	SVERDLOVSK
165	RUS	ZELENODOLSK	TATARSTAN
166	RUS	ZELEZNODOROZNYI	MOSKOVA
167	RUS	KINEÏ¿½MA	IVANOVO
168	RUS	KUZNETSK	PENZA
169	RUS	UHTA	KOMI
170	RUS	JESSENTUKI	STAVROPOL
171	RUS	TOBOLSK	TJUMEN
172	RUS	NEFTEJUGANSK	HANTI-MANSIA
173	RUS	BATAISK	ROSTOV-NA-DONU
174	RUS	NOJABRSK	YAMALIN NENETSIA
175	RUS	BALAÏ¿½OV	SARATOV
176	RUS	ZELEZNOGORSK	KURSK
177	RUS	ZUKOVSKI	MOSKOVA
178	RUS	ANZERO-SUDZENSK	KEMEROVO
179	RUS	BUGULMA	TATARSTAN
180	RUS	ZELEZNOGORSK	KRASNOJARSK
181	RUS	NOVOURALSK	SVERDLOVSK
182	RUS	PUÏ¿½KIN	PIETARI
183	RUS	VORKUTA	KOMI
184	RUS	DERBENT	DAGESTAN
185	RUS	KIROVO-TÏ¿½EPETSK	KIROV
186	RUS	KRASNOGORSK	MOSKOVA
187	RUS	KLIN	MOSKOVA
188	RUS	TÏ¿½AIKOVSKI	PERM
189	RUS	NOVYI URENGOI	YAMALIN NENETSIA
1	RWA	KIGALI	KIGALI
1	SAU	RIYADH	RIYADH
2	SAU	JEDDA	MEKKA
3	SAU	MEKKA	MEKKA
4	SAU	MEDINA	MEDINA
5	SAU	AL-DAMMAM	AL-SHARQIYA
6	SAU	AL-TAIF	MEKKA
7	SAU	TABUK	TABUK
8	SAU	BURAYDA	AL-QASIM
9	SAU	AL-HUFUF	AL-SHARQIYA
10	SAU	AL-MUBARRAZ	AL-SHARQIYA
11	SAU	KHAMIS MUSHAYT	ASIR
12	SAU	HAIL	HAIL
13	SAU	AL-KHARJ	RIAD
14	SAU	AL-KHUBAR	AL-SHARQIYA
15	SAU	JUBAYL	AL-SHARQIYA
16	SAU	HAFAR AL-BATIN	AL-SHARQIYA
17	SAU	AL-TUQBA	AL-SHARQIYA
18	SAU	YANBU	MEDINA
19	SAU	ABHA	ASIR
20	SAU	ARAÏ¿½AR	AL-KHUDUD AL-SAMALIY
21	SAU	AL-QATIF	AL-SHARQIYA
22	SAU	AL-HAWIYA	MEKKA
23	SAU	UNAYZA	QASIM
24	SAU	NAJRAN	NAJRAN
1	SDN	OMDURMAN	KHARTUM
2	SDN	KHARTUM	KHARTUM
3	SDN	SHARQ AL-NIL	KHARTUM
4	SDN	PORT SUDAN	AL-BAHR AL-AHMAR
5	SDN	KASSALA	KASSALA
6	SDN	OBEID	KURDUFAN AL-SHAMALIY
7	SDN	NYALA	DARFUR AL-JANUBIYA
8	SDN	WAD MADANI	AL-JAZIRA
9	SDN	AL-QADARIF	AL-QADARIF
10	SDN	KUSTI	AL-BAHR AL-ABYAD
11	SDN	AL-FASHIR	DARFUR AL-SHAMALIYA
12	SDN	JUBA	BAHR AL-JABAL
1	SEN	PIKINE	CAP-VERT
2	SEN	DAKAR	CAP-VERT
3	SEN	THIÏ¿½S	THIÏ¿½S
4	SEN	KAOLACK	KAOLACK
5	SEN	ZIGUINCHOR	ZIGUINCHOR
6	SEN	RUFISQUE	CAP-VERT
7	SEN	SAINT-LOUIS	SAINT-LOUIS
8	SEN	MBOUR	THIÏ¿½S
9	SEN	DIOURBEL	DIOURBEL
1	SGP	SINGAPORE	Ï¿½
1	SHN	JAMESTOWN	SAINT HELENA
1	SJM	LONGYEARBYEN	LÏ¿½NSIMAA
1	SLB	HONIARA	HONIARA
1	SLE	FREETOWN	WESTERN
1	SLV	SAN SALVADOR	SAN SALVADOR
2	SLV	SANTA ANA	SANTA ANA
3	SLV	MEJICANOS	SAN SALVADOR
4	SLV	SOYAPANGO	SAN SALVADOR
5	SLV	SAN MIGUEL	SAN MIGUEL
6	SLV	NUEVA SAN SALVADOR	LA LIBERTAD
7	SLV	APOPA	SAN SALVADOR
1	SMR	SERRAVALLE	SERRAVALLE/DOGANO
2	SMR	SAN MARINO	SAN MARINO
1	SOM	MOGADISHU	BANAADIR
2	SOM	HARGEYSA	WOQOOYI GALBEED
3	SOM	KISMAAYO	JUBBADA HOOSE
1	SPM	SAINT-PIERRE	SAINT-PIERRE
1	STP	SÏ¿½O TOMÏ¿½	AQUA GRANDE
1	SUR	PARAMARIBO	PARAMARIBO
1	SVK	BRATISLAVA	BRATISLAVA
2	SVK	KOÏ¿½ICE	VÏ¿½CHODNÏ¿½ SLOVENS
3	SVK	PREÏ¿½OV	VÏ¿½CHODNÏ¿½ SLOVENS
1	SVN	LJUBLJANA	OSREDNJESLOVENSKA
2	SVN	MARIBOR	PODRAVSKA
1	SWE	STOCKHOLM	LISBOA
2	SWE	GOTHENBURG [GÏ¿½TEBORG]	WEST GÏ¿½TANMAAN LÏ¿
3	SWE	MALMÏ¿½	SKÏ¿½NE LÏ¿½N
4	SWE	UPPSALA	UPPSALA LÏ¿½N
5	SWE	LINKÏ¿½PING	EAST GÏ¿½TANMAAN LÏ¿
6	SWE	VÏ¿½STERÏ¿½S	VÏ¿½STMANLANDS LÏ¿½N
7	SWE	Ï¿½REBRO	Ï¿½REBROS LÏ¿½N
8	SWE	NORRKÏ¿½PING	EAST GÏ¿½TANMAAN LÏ¿
9	SWE	HELSINGBORG	SKÏ¿½NE LÏ¿½N
10	SWE	JÏ¿½NKÏ¿½PING	JÏ¿½NKÏ¿½PINGS LÏ¿½N
11	SWE	UMEÏ¿½	VÏ¿½STERBOTTENS LÏ¿½
12	SWE	LUND	SKÏ¿½NE LÏ¿½N
13	SWE	BORÏ¿½S	WEST GÏ¿½TANMAAN LÏ¿
14	SWE	SUNDSVALL	VÏ¿½STERNORRLANDS LÏ
15	SWE	GÏ¿½VLE	GÏ¿½VLEBORGS LÏ¿½N
1	SWZ	MBABANE	HHOHHO
1	SYC	VICTORIA	MAHÏ¿½
1	SYR	DAMASCUS	DAMASCUS
2	SYR	ALEPPO	ALEPPO
3	SYR	HIMS	HIMS
4	SYR	HAMA	HAMA
5	SYR	LATAKIA	LATAKIA
6	SYR	AL-QAMISHLIYA	AL-HASAKA
7	SYR	DAYR AL-ZAWR	DAYR AL-ZAWR
8	SYR	JARAMANA	DAMASKOS
9	SYR	DUMA	DAMASKOS
10	SYR	AL-RAQQA	AL-RAQQA
11	SYR	IDLIB	IDLIB
1	TCA	COCKBURN TOWN	GRAND TURK
1	TCD	NÏ¿½DJAMÏ¿½NA	CHARI-BAGUIRMI
2	TCD	MOUNDOU	LOGONE OCCIDENTAL
1	TGO	LOMÏ¿½	MARITIME
1	THA	BANGKOK	BANGKOK
2	THA	NONTHABURI	NONTHABURI
3	THA	NAKHON RATCHASIMA	NAKHON RATCHASIMA
4	THA	CHIANG MAI	CHIANG MAI
5	THA	UDON THANI	UDON THANI
6	THA	HAT YAI	SONGKHLA
7	THA	KHON KAEN	KHON KAEN
8	THA	PAK KRET	NONTHABURI
9	THA	NAKHON SAWAN	NAKHON SAWAN
10	THA	UBON RATCHATHANI	UBON RATCHATHANI
11	THA	SONGKHLA	SONGKHLA
12	THA	NAKHON PATHOM	NAKHON PATHOM
1	TJK	DUSHANBE	KAROTEGIN
2	TJK	KHUJAND	KHUJAND
1	TKL	FAKAOFO	FAKAOFO
1	TKM	ASHGABAT	AHAL
2	TKM	CHÏ¿½RJEW	LEBAP
3	TKM	DASHHOWUZ	DASHHOWUZ
4	TKM	MARY	MARY
1	TMP	DILI	DILI
1	TON	NUKUÏ¿½ALOFA	TONGATAPU
1	TTO	CHAGUANAS	CARONI
2	TTO	PORT-OF-SPAIN	PORT-OF-SPAIN
1	TUN	TUNIS	TUNIS
2	TUN	SFAX	SFAX
3	TUN	ARIANA	ARIANA
4	TUN	ETTADHAMEN	ARIANA
5	TUN	SOUSSE	SOUSSE
6	TUN	KAIROUAN	KAIROUAN
7	TUN	BISERTA	BISERTA
8	TUN	GABÏ¿½S	GABÏ¿½S
1	TUR	ISTANBUL	ISTANBUL
2	TUR	ANKARA	ANKARA
3	TUR	IZMIR	IZMIR
4	TUR	ADANA	ADANA
5	TUR	BURSA	BURSA
6	TUR	GAZIANTEP	GAZIANTEP
7	TUR	KONYA	KONYA
8	TUR	MERSIN (IÏ¿½EL)	IÏ¿½EL
9	TUR	ANTALYA	ANTALYA
10	TUR	DIYARBAKIR	DIYARBAKIR
11	TUR	KAYSERI	KAYSERI
12	TUR	ESKISEHIR	ESKISEHIR
13	TUR	SANLIURFA	SANLIURFA
14	TUR	SAMSUN	SAMSUN
15	TUR	MALATYA	MALATYA
16	TUR	GEBZE	KOCAELI
17	TUR	DENIZLI	DENIZLI
18	TUR	SIVAS	SIVAS
19	TUR	ERZURUM	ERZURUM
20	TUR	TARSUS	ADANA
21	TUR	KAHRAMANMARAS	KAHRAMANMARAS
22	TUR	ELÏ¿½ZIG	ELÏ¿½ZIG
23	TUR	VAN	VAN
24	TUR	SULTANBEYLI	ISTANBUL
25	TUR	IZMIT (KOCAELI)	KOCAELI
26	TUR	MANISA	MANISA
27	TUR	BATMAN	BATMAN
28	TUR	BALIKESIR	BALIKESIR
29	TUR	SAKARYA (ADAPAZARI)	SAKARYA
30	TUR	ISKENDERUN	HATAY
31	TUR	OSMANIYE	OSMANIYE
32	TUR	Ï¿½ORUM	Ï¿½ORUM
33	TUR	KÏ¿½TAHYA	KÏ¿½TAHYA
34	TUR	HATAY (ANTAKYA)	HATAY
35	TUR	KIRIKKALE	KIRIKKALE
36	TUR	ADIYAMAN	ADIYAMAN
37	TUR	TRABZON	TRABZON
38	TUR	ORDU	ORDU
39	TUR	AYDIN	AYDIN
40	TUR	USAK	USAK
41	TUR	EDIRNE	EDIRNE
42	TUR	Ï¿½ORLU	TEKIRDAG
43	TUR	ISPARTA	ISPARTA
44	TUR	KARABÏ¿½K	KARABÏ¿½K
45	TUR	KILIS	KILIS
46	TUR	ALANYA	ANTALYA
47	TUR	KIZILTEPE	MARDIN
48	TUR	ZONGULDAK	ZONGULDAK
49	TUR	SIIRT	SIIRT
50	TUR	VIRANSEHIR	SANLIURFA
51	TUR	TEKIRDAG	TEKIRDAG
52	TUR	KARAMAN	KARAMAN
53	TUR	AFYON	AFYON
54	TUR	AKSARAY	AKSARAY
55	TUR	CEYHAN	ADANA
56	TUR	ERZINCAN	ERZINCAN
57	TUR	BISMIL	DIYARBAKIR
58	TUR	NAZILLI	AYDIN
59	TUR	TOKAT	TOKAT
60	TUR	KARS	KARS
61	TUR	INEGÏ¿½L	BURSA
62	TUR	BANDIRMA	BALIKESIR
1	TUV	FUNAFUTI	FUNAFUTI
1	TWN	TAIPEI	TAIPEI
2	TWN	KAOHSIUNG	KAOHSIUNG
3	TWN	TAICHUNG	TAICHUNG
4	TWN	TAINAN	TAINAN
5	TWN	PANCHIAO	TAIPEI
6	TWN	CHUNGHO	TAIPEI
7	TWN	KEELUNG (CHILUNG)	KEELUNG
8	TWN	SANCHUNG	TAIPEI
9	TWN	HSINCHUANG	TAIPEI
10	TWN	HSINCHU	HSINCHU
11	TWN	CHUNGLI	TAOYUAN
12	TWN	FENGSHAN	KAOHSIUNG
13	TWN	TAOYUAN	TAOYUAN
14	TWN	CHIAYI	CHIAYI
15	TWN	HSINTIEN	TAIPEI
16	TWN	CHANGHWA	CHANGHWA
17	TWN	YUNGHO	TAIPEI
18	TWN	TUCHENG	TAIPEI
19	TWN	PINGTUNG	PINGTUNG
20	TWN	YUNGKANG	TAINAN
21	TWN	PINGCHEN	TAOYUAN
22	TWN	TALI	TAICHUNG
23	TWN	TAIPING	\N
24	TWN	PATE	TAOYUAN
25	TWN	FENGYUAN	TAICHUNG
26	TWN	LUCHOU	TAIPEI
27	TWN	HSICHUH	TAIPEI
28	TWN	SHULIN	TAIPEI
29	TWN	YUANLIN	CHANGHWA
30	TWN	YANGMEI	TAOYUAN
31	TWN	TALIAO	\N
32	TWN	KUEISHAN	\N
33	TWN	TANSHUI	TAIPEI
34	TWN	TAITUNG	TAITUNG
35	TWN	HUALIEN	HUALIEN
36	TWN	NANTOU	NANTOU
37	TWN	LUNGTAN	TAIPEI
38	TWN	TOULIU	YÏ¿½NLIN
39	TWN	TSAOTUN	NANTOU
40	TWN	KANGSHAN	KAOHSIUNG
41	TWN	ILAN	ILAN
42	TWN	MIAOLI	MIAOLI
1	TZA	DAR ES SALAAM	DAR ES SALAAM
2	TZA	DODOMA	DODOMA
3	TZA	MWANZA	MWANZA
4	TZA	ZANZIBAR	ZANZIBAR WEST
5	TZA	TANGA	TANGA
6	TZA	MBEYA	MBEYA
7	TZA	MOROGORO	MOROGORO
8	TZA	ARUSHA	ARUSHA
9	TZA	MOSHI	KILIMANJARO
10	TZA	TABORA	TABORA
1	UGA	KAMPALA	CENTRAL
1	UKR	KYIV	KIOVA
2	UKR	HARKOVA [HARKIV]	HARKOVA
3	UKR	DNIPROPETROVSK	DNIPROPETROVSK
4	UKR	DONETSK	DONETSK
5	UKR	ODESA	ODESA
6	UKR	ZAPORIZZJA	ZAPORIZZJA
7	UKR	LVIV	LVIV
8	UKR	KRYVYI RIG	DNIPROPETROVSK
9	UKR	MYKOLAJIV	MYKOLAJIV
10	UKR	MARIUPOL	DONETSK
11	UKR	LUGANSK	LUGANSK
12	UKR	VINNYTSJA	VINNYTSJA
13	UKR	MAKIJIVKA	DONETSK
14	UKR	HERSON	HERSON
15	UKR	SEVASTOPOL	KRIM
16	UKR	SIMFEROPOL	KRIM
17	UKR	PULTAVA [POLTAVA]	PULTAVA
18	UKR	TÏ¿½ERNIGIV	TÏ¿½ERNIGIV
19	UKR	TÏ¿½ERKASY	TÏ¿½ERKASY
20	UKR	GORLIVKA	DONETSK
21	UKR	ZYTOMYR	ZYTOMYR
22	UKR	SUMY	SUMY
23	UKR	DNIPRODZERZYNSK	DNIPROPETROVSK
24	UKR	KIROVOGRAD	KIROVOGRAD
25	UKR	HMELNYTSKYI	HMELNYTSKYI
26	UKR	TÏ¿½ERNIVTSI	TÏ¿½ERNIVTSI
27	UKR	RIVNE	RIVNE
28	UKR	KREMENTÏ¿½UK	PULTAVA
29	UKR	IVANO-FRANKIVSK	IVANO-FRANKIVSK
30	UKR	TERNOPIL	TERNOPIL
31	UKR	LUTSK	VOLYNIA
32	UKR	BILA TSERKVA	KIOVA
33	UKR	KRAMATORSK	DONETSK
34	UKR	MELITOPOL	ZAPORIZZJA
35	UKR	KERTÏ¿½	KRIM
36	UKR	NIKOPOL	DNIPROPETROVSK
37	UKR	BERDJANSK	ZAPORIZZJA
38	UKR	PAVLOGRAD	DNIPROPETROVSK
39	UKR	SJEVERODONETSK	LUGANSK
40	UKR	SLOVJANSK	DONETSK
41	UKR	UZGOROD	TAKA-KARPATIA
42	UKR	ALTÏ¿½EVSK	LUGANSK
43	UKR	LYSYTÏ¿½ANSK	LUGANSK
44	UKR	JEVPATORIJA	KRIM
45	UKR	KAMJANETS-PODILSKYI	HMELNYTSKYI
46	UKR	JENAKIJEVE	DONETSK
47	UKR	KRASNYI LUTÏ¿½	LUGANSK
48	UKR	STAHANOV	LUGANSK
49	UKR	OLEKSANDRIJA	KIROVOGRAD
50	UKR	KONOTOP	SUMY
51	UKR	KOSTJANTYNIVKA	DONETSK
52	UKR	BERDYTÏ¿½IV	ZYTOMYR
53	UKR	IZMAJIL	ODESA
54	UKR	Ï¿½OSTKA	SUMY
55	UKR	UMAN	TÏ¿½ERKASY
56	UKR	BROVARY	KIOVA
57	UKR	MUKATÏ¿½EVE	TAKA-KARPATIA
1	URY	MONTEVIDEO	MONTEVIDEO
1	USA	NEW YORK	NEW YORK
2	USA	LOS ANGELES	CALIFORNIA
3	USA	CHICAGO	ILLINOIS
4	USA	HOUSTON	TEXAS
5	USA	PHILADELPHIA	PENNSYLVANIA
6	USA	PHOENIX	ARIZONA
7	USA	SAN DIEGO	CALIFORNIA
8	USA	DALLAS	TEXAS
9	USA	SAN ANTONIO	TEXAS
10	USA	DETROIT	MICHIGAN
11	USA	SAN JOSE	CALIFORNIA
12	USA	INDIANAPOLIS	INDIANA
13	USA	SAN FRANCISCO	CALIFORNIA
14	USA	JACKSONVILLE	FLORIDA
15	USA	COLUMBUS	OHIO
16	USA	AUSTIN	TEXAS
17	USA	BALTIMORE	MARYLAND
18	USA	MEMPHIS	TENNESSEE
19	USA	MILWAUKEE	WISCONSIN
20	USA	BOSTON	MASSACHUSETTS
21	USA	WASHINGTON	DISTRICT OF COLUMBIA
22	USA	NASHVILLE-DAVIDSON	TENNESSEE
23	USA	EL PASO	TEXAS
24	USA	SEATTLE	WASHINGTON
25	USA	DENVER	COLORADO
26	USA	CHARLOTTE	NORTH CAROLINA
27	USA	FORT WORTH	TEXAS
28	USA	PORTLAND	OREGON
29	USA	OKLAHOMA CITY	OKLAHOMA
30	USA	TUCSON	ARIZONA
31	USA	NEW ORLEANS	LOUISIANA
32	USA	LAS VEGAS	NEVADA
33	USA	CLEVELAND	OHIO
34	USA	LONG BEACH	CALIFORNIA
35	USA	ALBUQUERQUE	NEW MEXICO
36	USA	KANSAS CITY	MISSOURI
37	USA	FRESNO	CALIFORNIA
38	USA	VIRGINIA BEACH	VIRGINIA
39	USA	ATLANTA	GEORGIA
40	USA	SACRAMENTO	CALIFORNIA
41	USA	OAKLAND	CALIFORNIA
42	USA	MESA	ARIZONA
43	USA	TULSA	OKLAHOMA
44	USA	OMAHA	NEBRASKA
45	USA	MINNEAPOLIS	MINNESOTA
46	USA	HONOLULU	HAWAII
47	USA	MIAMI	FLORIDA
48	USA	COLORADO SPRINGS	COLORADO
49	USA	SAINT LOUIS	MISSOURI
50	USA	WICHITA	KANSAS
51	USA	SANTA ANA	CALIFORNIA
52	USA	PITTSBURGH	PENNSYLVANIA
53	USA	ARLINGTON	TEXAS
54	USA	CINCINNATI	OHIO
55	USA	ANAHEIM	CALIFORNIA
56	USA	TOLEDO	OHIO
57	USA	TAMPA	FLORIDA
58	USA	BUFFALO	NEW YORK
59	USA	SAINT PAUL	MINNESOTA
60	USA	CORPUS CHRISTI	TEXAS
61	USA	AURORA	COLORADO
62	USA	RALEIGH	NORTH CAROLINA
63	USA	NEWARK	NEW JERSEY
64	USA	LEXINGTON-FAYETTE	KENTUCKY
65	USA	ANCHORAGE	ALASKA
66	USA	LOUISVILLE	KENTUCKY
67	USA	RIVERSIDE	CALIFORNIA
68	USA	SAINT PETERSBURG	FLORIDA
69	USA	BAKERSFIELD	CALIFORNIA
70	USA	STOCKTON	CALIFORNIA
71	USA	BIRMINGHAM	ALABAMA
72	USA	JERSEY CITY	NEW JERSEY
73	USA	NORFOLK	VIRGINIA
74	USA	BATON ROUGE	LOUISIANA
75	USA	HIALEAH	FLORIDA
76	USA	LINCOLN	NEBRASKA
77	USA	GREENSBORO	NORTH CAROLINA
78	USA	PLANO	TEXAS
79	USA	ROCHESTER	NEW YORK
80	USA	GLENDALE	ARIZONA
81	USA	AKRON	OHIO
82	USA	GARLAND	TEXAS
83	USA	MADISON	WISCONSIN
84	USA	FORT WAYNE	INDIANA
85	USA	FREMONT	CALIFORNIA
86	USA	SCOTTSDALE	ARIZONA
87	USA	MONTGOMERY	ALABAMA
88	USA	SHREVEPORT	LOUISIANA
89	USA	AUGUSTA-RICHMOND COUNTY	GEORGIA
90	USA	LUBBOCK	TEXAS
91	USA	CHESAPEAKE	VIRGINIA
92	USA	MOBILE	ALABAMA
93	USA	DES MOINES	IOWA
94	USA	GRAND RAPIDS	MICHIGAN
95	USA	RICHMOND	VIRGINIA
96	USA	YONKERS	NEW YORK
97	USA	SPOKANE	WASHINGTON
98	USA	GLENDALE	CALIFORNIA
99	USA	TACOMA	WASHINGTON
100	USA	IRVING	TEXAS
101	USA	HUNTINGTON BEACH	CALIFORNIA
102	USA	MODESTO	CALIFORNIA
103	USA	DURHAM	NORTH CAROLINA
104	USA	COLUMBUS	GEORGIA
105	USA	ORLANDO	FLORIDA
106	USA	BOISE CITY	IDAHO
107	USA	WINSTON-SALEM	NORTH CAROLINA
108	USA	SAN BERNARDINO	CALIFORNIA
109	USA	JACKSON	MISSISSIPPI
110	USA	LITTLE ROCK	ARKANSAS
111	USA	SALT LAKE CITY	UTAH
112	USA	RENO	NEVADA
113	USA	NEWPORT NEWS	VIRGINIA
114	USA	CHANDLER	ARIZONA
115	USA	LAREDO	TEXAS
116	USA	HENDERSON	NEVADA
117	USA	ARLINGTON	VIRGINIA
118	USA	KNOXVILLE	TENNESSEE
119	USA	AMARILLO	TEXAS
120	USA	PROVIDENCE	RHODE ISLAND
121	USA	CHULA VISTA	CALIFORNIA
122	USA	WORCESTER	MASSACHUSETTS
123	USA	OXNARD	CALIFORNIA
124	USA	DAYTON	OHIO
125	USA	GARDEN GROVE	CALIFORNIA
126	USA	OCEANSIDE	CALIFORNIA
127	USA	TEMPE	ARIZONA
128	USA	HUNTSVILLE	ALABAMA
129	USA	ONTARIO	CALIFORNIA
130	USA	CHATTANOOGA	TENNESSEE
131	USA	FORT LAUDERDALE	FLORIDA
132	USA	SPRINGFIELD	MASSACHUSETTS
133	USA	SPRINGFIELD	MISSOURI
134	USA	SANTA CLARITA	CALIFORNIA
135	USA	SALINAS	CALIFORNIA
136	USA	TALLAHASSEE	FLORIDA
137	USA	ROCKFORD	ILLINOIS
138	USA	POMONA	CALIFORNIA
139	USA	METAIRIE	LOUISIANA
140	USA	PATERSON	NEW JERSEY
141	USA	OVERLAND PARK	KANSAS
142	USA	SANTA ROSA	CALIFORNIA
143	USA	SYRACUSE	NEW YORK
144	USA	KANSAS CITY	KANSAS
145	USA	HAMPTON	VIRGINIA
146	USA	LAKEWOOD	COLORADO
147	USA	VANCOUVER	WASHINGTON
148	USA	IRVINE	CALIFORNIA
149	USA	AURORA	ILLINOIS
150	USA	MORENO VALLEY	CALIFORNIA
151	USA	PASADENA	CALIFORNIA
152	USA	HAYWARD	CALIFORNIA
153	USA	BROWNSVILLE	TEXAS
154	USA	BRIDGEPORT	CONNECTICUT
155	USA	HOLLYWOOD	FLORIDA
156	USA	WARREN	MICHIGAN
157	USA	TORRANCE	CALIFORNIA
158	USA	EUGENE	OREGON
159	USA	PEMBROKE PINES	FLORIDA
160	USA	SALEM	OREGON
161	USA	PASADENA	TEXAS
162	USA	ESCONDIDO	CALIFORNIA
163	USA	SUNNYVALE	CALIFORNIA
164	USA	SAVANNAH	GEORGIA
165	USA	FONTANA	CALIFORNIA
166	USA	ORANGE	CALIFORNIA
167	USA	NAPERVILLE	ILLINOIS
168	USA	ALEXANDRIA	VIRGINIA
169	USA	RANCHO CUCAMONGA	CALIFORNIA
170	USA	GRAND PRAIRIE	TEXAS
171	USA	EAST LOS ANGELES	CALIFORNIA
172	USA	FULLERTON	CALIFORNIA
173	USA	CORONA	CALIFORNIA
174	USA	FLINT	MICHIGAN
175	USA	PARADISE	NEVADA
176	USA	MESQUITE	TEXAS
177	USA	STERLING HEIGHTS	MICHIGAN
178	USA	SIOUX FALLS	SOUTH DAKOTA
179	USA	NEW HAVEN	CONNECTICUT
180	USA	TOPEKA	KANSAS
181	USA	CONCORD	CALIFORNIA
182	USA	EVANSVILLE	INDIANA
183	USA	HARTFORD	CONNECTICUT
184	USA	FAYETTEVILLE	NORTH CAROLINA
185	USA	CEDAR RAPIDS	IOWA
186	USA	ELIZABETH	NEW JERSEY
187	USA	LANSING	MICHIGAN
188	USA	LANCASTER	CALIFORNIA
189	USA	FORT COLLINS	COLORADO
190	USA	CORAL SPRINGS	FLORIDA
191	USA	STAMFORD	CONNECTICUT
192	USA	THOUSAND OAKS	CALIFORNIA
193	USA	VALLEJO	CALIFORNIA
194	USA	PALMDALE	CALIFORNIA
195	USA	COLUMBIA	SOUTH CAROLINA
196	USA	EL MONTE	CALIFORNIA
197	USA	ABILENE	TEXAS
198	USA	NORTH LAS VEGAS	NEVADA
199	USA	ANN ARBOR	MICHIGAN
200	USA	BEAUMONT	TEXAS
201	USA	WACO	TEXAS
202	USA	MACON	GEORGIA
203	USA	INDEPENDENCE	MISSOURI
204	USA	PEORIA	ILLINOIS
205	USA	INGLEWOOD	CALIFORNIA
206	USA	SPRINGFIELD	ILLINOIS
207	USA	SIMI VALLEY	CALIFORNIA
208	USA	LAFAYETTE	LOUISIANA
209	USA	GILBERT	ARIZONA
210	USA	CARROLLTON	TEXAS
211	USA	BELLEVUE	WASHINGTON
212	USA	WEST VALLEY CITY	UTAH
213	USA	CLARKSVILLE	TENNESSEE
214	USA	COSTA MESA	CALIFORNIA
215	USA	PEORIA	ARIZONA
216	USA	SOUTH BEND	INDIANA
217	USA	DOWNEY	CALIFORNIA
218	USA	WATERBURY	CONNECTICUT
219	USA	MANCHESTER	NEW HAMPSHIRE
220	USA	ALLENTOWN	PENNSYLVANIA
221	USA	MCALLEN	TEXAS
222	USA	JOLIET	ILLINOIS
223	USA	LOWELL	MASSACHUSETTS
224	USA	PROVO	UTAH
225	USA	WEST COVINA	CALIFORNIA
226	USA	WICHITA FALLS	TEXAS
227	USA	ERIE	PENNSYLVANIA
228	USA	DALY CITY	CALIFORNIA
229	USA	CITRUS HEIGHTS	CALIFORNIA
230	USA	NORWALK	CALIFORNIA
231	USA	GARY	INDIANA
232	USA	BERKELEY	CALIFORNIA
233	USA	SANTA CLARA	CALIFORNIA
234	USA	GREEN BAY	WISCONSIN
235	USA	CAPE CORAL	FLORIDA
236	USA	ARVADA	COLORADO
237	USA	PUEBLO	COLORADO
238	USA	SANDY	UTAH
239	USA	ATHENS-CLARKE COUNTY	GEORGIA
240	USA	CAMBRIDGE	MASSACHUSETTS
241	USA	WESTMINSTER	COLORADO
242	USA	SAN BUENAVENTURA	CALIFORNIA
243	USA	PORTSMOUTH	VIRGINIA
244	USA	LIVONIA	MICHIGAN
245	USA	BURBANK	CALIFORNIA
246	USA	CLEARWATER	FLORIDA
247	USA	MIDLAND	TEXAS
248	USA	DAVENPORT	IOWA
249	USA	MISSION VIEJO	CALIFORNIA
250	USA	MIAMI BEACH	FLORIDA
251	USA	SUNRISE MANOR	NEVADA
252	USA	NEW BEDFORD	MASSACHUSETTS
253	USA	EL CAJON	CALIFORNIA
254	USA	NORMAN	OKLAHOMA
255	USA	RICHMOND	CALIFORNIA
256	USA	ALBANY	NEW YORK
257	USA	BROCKTON	MASSACHUSETTS
258	USA	ROANOKE	VIRGINIA
259	USA	BILLINGS	MONTANA
260	USA	COMPTON	CALIFORNIA
261	USA	GAINESVILLE	FLORIDA
262	USA	FAIRFIELD	CALIFORNIA
263	USA	ARDEN-ARCADE	CALIFORNIA
264	USA	SAN MATEO	CALIFORNIA
265	USA	VISALIA	CALIFORNIA
266	USA	BOULDER	COLORADO
267	USA	CARY	NORTH CAROLINA
268	USA	SANTA MONICA	CALIFORNIA
269	USA	FALL RIVER	MASSACHUSETTS
270	USA	KENOSHA	WISCONSIN
271	USA	ELGIN	ILLINOIS
272	USA	ODESSA	TEXAS
273	USA	CARSON	CALIFORNIA
274	USA	CHARLESTON	SOUTH CAROLINA
1	UZB	TOSKENT	TOSKENT SHAHRI
2	UZB	NAMANGAN	NAMANGAN
3	UZB	SAMARKAND	SAMARKAND
4	UZB	ANDIJON	ANDIJON
5	UZB	BUHORO	BUHORO
6	UZB	KARSI	QASHQADARYO
7	UZB	NUKUS	KARAKALPAKISTAN
8	UZB	KÏ¿½KON	FARGONA
9	UZB	FARGONA	FARGONA
10	UZB	CIRCIK	TOSKENT
11	UZB	MARGILON	FARGONA
12	UZB	Ï¿½RGENC	KHORAZM
13	UZB	ANGREN	TOSKENT
14	UZB	CIZAH	CIZAH
15	UZB	NAVOI	NAVOI
16	UZB	OLMALIK	TOSKENT
17	UZB	TERMIZ	SURKHONDARYO
1	VAT	CITTÏ¿½ DEL VATICANO	Ï¿½
1	VCT	KINGSTOWN	ST GEORGE
1	VEN	CARACAS	DISTRITO FEDERAL
2	VEN	MARACAÏBO	ZULIA
3	VEN	BARQUISIMETO	LARA
4	VEN	VALENCIA	CARABOBO
5	VEN	CIUDAD GUAYANA	BOLÏ¿½VAR
6	VEN	PETARE	MIRANDA
7	VEN	MARACAY	ARAGUA
8	VEN	BARCELONA	ANZOÏ¿½TEGUI
9	VEN	MATURÏN	MONAGAS
10	VEN	SAN CRISTOBAL	TÏ¿½CHIRA
11	VEN	CIUDAD BOLÏVAR	BOLÏ¿½VAR
12	VEN	CUMANI	SUCRE
13	VEN	MERIDA	MÏ¿½RIDA
14	VEN	CABIMAS	ZULIA
15	VEN	BARINAS	BARINAS
16	VEN	TURMERO	ARAGUA
17	VEN	BARUTA	MIRANDA
18	VEN	PUERTO CABELLO	CARABOBO
19	VEN	SANTA ANA DE CORO	FALCÏ¿½N
20	VEN	LOS TEQUES	MIRANDA
21	VEN	PUNTO FIJO	FALCÏ¿½N
22	VEN	GUARENAS	MIRANDA
23	VEN	ACARIGUA	PORTUGUESA
24	VEN	PUERTO LA CRUZ	ANZOÏ¿½TEGUI
25	VEN	CIUDAD LOSADA	\N
26	VEN	GUACARA	CARABOBO
27	VEN	VALERA	TRUJILLO
28	VEN	GUANARE	PORTUGUESA
29	VEN	CARÏ¿½PANO	SUCRE
30	VEN	CATIA LA MAR	DISTRITO FEDERAL
31	VEN	EL TIGRE	ANZOÏ¿½TEGUI
32	VEN	GUATIRE	MIRANDA
33	VEN	CALABOZO	GUÏ¿½RICO
34	VEN	POZUELOS	ANZOÏ¿½TEGUI
35	VEN	CIUDAD OJEDA	ZULIA
36	VEN	OCUMARE DEL TUY	MIRANDA
37	VEN	VALLE DE LA PASCUA	GUÏ¿½RICO
38	VEN	ARAURE	PORTUGUESA
39	VEN	SAN FERNANDO DE APURE	APURE
40	VEN	SAN FELIPE	YARACUY
41	VEN	EL LIMÏ	ARAGUA
42	VEN	SAN FELIX / PUERTO ORDAZ	\N
1	VGB	ROAD TOWN	TORTOLA
1	VIR	CHARLOTTE AMALIE	ST THOMAS
1	VNM	HO CHI MINH CITY	HO CHI MINH CITY
2	VNM	HANOI	HANOI
3	VNM	HAIPHONG	HAIPHONG
4	VNM	DA NANG	QUANG NAM-DA NANG
5	VNM	BIÏ¿½N HOA	DONG NAI
6	VNM	NHA TRANG	KHANH HOA
7	VNM	HUE	THUA THIEN-HUE
8	VNM	CAN THO	CAN THO
9	VNM	CAM PHA	QUANG BINH
10	VNM	NAM DINH	NAM HA
11	VNM	QUY NHON	BINH DINH
12	VNM	VUNG TAU	BA RIA-VUNG TAU
13	VNM	RACH GIA	KIEN GIANG
14	VNM	LONG XUYEN	AN GIANG
15	VNM	THAI NGUYEN	BAC THAI
16	VNM	HONG GAI	QUANG NINH
17	VNM	PHAN THIÏ¿½T	BINH THUAN
18	VNM	CAM RANH	KHANH HOA
19	VNM	VINH	NGHE AN
20	VNM	MY THO	TIEN GIANG
21	VNM	DA LAT	LAM DONG
22	VNM	BUON MA THUOT	DAC LAC
1	VUT	PORT-VILA	SHEFA
1	WLF	MATA-UTU	WALLIS
1	WSM	APIA	UPOLU
1	YEM	SANAA	SANAA
2	YEM	ADEN	ADEN
3	YEM	TAIZZ	TAIZZ
4	YEM	HODEIDA	HODEIDA
5	YEM	AL-MUKALLA	HADRAMAWT
6	YEM	IBB	IBB
1	YUG	BEOGRAD	CENTRAL SERBIA
2	YUG	NOVI SAD	VOJVODINA
3	YUG	NIÏ¿½	CENTRAL SERBIA
4	YUG	PRIÏ¿½TINA	KOSOVO AND METOHIJA
5	YUG	KRAGUJEVAC	CENTRAL SERBIA
6	YUG	PODGORICA	MONTENEGRO
7	YUG	SUBOTICA	VOJVODINA
8	YUG	PRIZREN	KOSOVO AND METOHIJA
1	ZAF	CAPE TOWN	WESTERN CAPE
2	ZAF	SOWETO	GAUTENG
3	ZAF	JOHANNESBURG	GAUTENG
4	ZAF	PORT ELIZABETH	EASTERN CAPE
5	ZAF	PRETORIA	GAUTENG
6	ZAF	INANDA	KWAZULU-NATAL
7	ZAF	DURBAN	KWAZULU-NATAL
8	ZAF	VANDERBIJLPARK	GAUTENG
9	ZAF	KEMPTON PARK	GAUTENG
10	ZAF	ALBERTON	GAUTENG
11	ZAF	PINETOWN	KWAZULU-NATAL
12	ZAF	PIETERMARITZBURG	KWAZULU-NATAL
13	ZAF	BENONI	GAUTENG
14	ZAF	RANDBURG	GAUTENG
15	ZAF	UMLAZI	KWAZULU-NATAL
16	ZAF	BLOEMFONTEIN	FREE STATE
17	ZAF	VEREENIGING	GAUTENG
18	ZAF	WONDERBOOM	GAUTENG
19	ZAF	ROODEPOORT	GAUTENG
20	ZAF	BOKSBURG	GAUTENG
21	ZAF	KLERKSDORP	NORTH WEST
22	ZAF	SOSHANGUVE	GAUTENG
23	ZAF	NEWCASTLE	KWAZULU-NATAL
24	ZAF	EAST LONDON	EASTERN CAPE
25	ZAF	WELKOM	FREE STATE
26	ZAF	KIMBERLEY	NORTHERN CAPE
27	ZAF	UITENHAGE	EASTERN CAPE
28	ZAF	CHATSWORTH	KWAZULU-NATAL
29	ZAF	MDANTSANE	EASTERN CAPE
30	ZAF	KRUGERSDORP	GAUTENG
31	ZAF	BOTSHABELO	FREE STATE
32	ZAF	BRAKPAN	GAUTENG
33	ZAF	WITBANK	MPUMALANGA
34	ZAF	OBERHOLZER	GAUTENG
35	ZAF	GERMISTON	GAUTENG
36	ZAF	SPRINGS	GAUTENG
37	ZAF	WESTONARIA	GAUTENG
38	ZAF	RANDFONTEIN	GAUTENG
39	ZAF	PAARL	WESTERN CAPE
40	ZAF	POTCHEFSTROOM	NORTH WEST
41	ZAF	RUSTENBURG	NORTH WEST
42	ZAF	NIGEL	GAUTENG
43	ZAF	GEORGE	WESTERN CAPE
44	ZAF	LADYSMITH	KWAZULU-NATAL
1	ZMB	LUSAKA	LUSAKA
2	ZMB	NDOLA	COPPERBELT
3	ZMB	KITWE	COPPERBELT
4	ZMB	KABWE	CENTRAL
5	ZMB	CHINGOLA	COPPERBELT
6	ZMB	MUFULIRA	COPPERBELT
7	ZMB	LUANSHYA	COPPERBELT
1	ZWE	HARARE	HARARE
2	ZWE	BULAWAYO	BULAWAYO
3	ZWE	CHITUNGWIZA	HARARE
4	ZWE	MOUNT DARWIN	HARARE
5	ZWE	MUTARE	MANICALAND
6	ZWE	GWERU	MIDLANDS
\.


--
-- Data for Name: datos_adicionales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.datos_adicionales (id_datos_adicionales, nombre_cliente, sr_numero, date_organization, state_organization, principal_business, managing_members, bank_account, fiscal_year, ein, date_annual_meeting, secretary, treasurer, members, initial_manager, fecha_creacion, fk_solicitud, createat) FROM stdin;
2	11	12	2024-09-25	17	18	20	13	14	16	2024-09-24	19	21	22	23	2024-09-23 14:10:50.524841	0	2024-09-23 14:10:50.524841
1	Santiago Erazo Corporation LLC	8745309221 file 213216778	2024-09-23	7	9	11	12	4	6	2024-09-23	10	12	13	14	2024-09-23 11:51:26.286681	1	2024-09-23 11:51:26.286681
\.


--
-- Data for Name: datos_bancarios_sociedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.datos_bancarios_sociedad (id_bancos_sociedad, id_banco, cuenta_banco, tipo_cuenta, titular_cuenta, fecha_de_creacion, usuario_creacion) FROM stdin;
1	2	123567895678	ahorros	Santiago Erazo	01-02-2024	2
\.


--
-- Data for Name: documentos_adjuntos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documentos_adjuntos (id_tipo_documento_adjunto, nombre_documento_adjunto, create_at) FROM stdin;
2	docuemtno adjutno cedula de ciudadania	2024-11-11 07:23:01.747073
3	pasaporte	2024-11-12 07:56:40.447389
4	cedula extranjeria	2024-11-12 07:58:11.149589
\.


--
-- Data for Name: egresos_sociedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.egresos_sociedad (id_egresos_sociedad, fk_tercero, valor, create_at, consecutivo_egreso, fk_sociedad, anticipo, factura) FROM stdin;
2	\N	8755.00	2024-11-12 09:18:48.675869	2321	3670447a-0f07-489f-aa14-5446a9e40f05                                                                                                                                                                                                                                                                                                                                    	\N	\N
3	\N	87552.00	2024-11-12 09:21:24.340573	232122	3670447a-0f07-489f-aa14-5446a9e40f05                                                                                                                                                                                                                                                                                                                                    	\N	\N
4	\N	12.00	2024-11-12 09:22:45.08046	232122234	3670447a-0f07-489f-aa14-5446a9e40f05                                                                                                                                                                                                                                                                                                                                    	\N	\N
5	1	123456.00	2024-11-12 09:24:42.9769	2321123	3670447a-0f07-489f-aa14-5446a9e40f05                                                                                                                                                                                                                                                                                                                                    	\N	\N
6	1	79.00	2024-11-12 16:57:08.110658	232122	0a46f31d-7777-424e-9f11-145ea36e39df                                                                                                                                                                                                                                                                                                                                    	\N	\N
7	2	129.00	2024-11-12 17:53:03.086143	789053	f1255464-eacd-4713-92c5-274359ef0893                                                                                                                                                                                                                                                                                                                                    	\N	\N
8	1	123455.00	2024-11-14 17:58:33.706912	78905342	3670447a-0f07-489f-aa14-5446a9e40f05                                                                                                                                                                                                                                                                                                                                    	567.00	\N
\.


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.estados (id_estado, cod_estado, estado) FROM stdin;
1	AK	ALASKA
2	AL	ALABAMA
3	AR	ARKANSAS
4	AZ	ARIZONA
5	CA	CALIFORNIA
6	CO	COLORADO
7	CT	CONNECTICUT
8	DE	DELAWARE
9	FL	FLORIDA
10	GA	GEORGIA
11	HI	HAWÁI
12	IA	IOWA
13	ID	IDAHO
14	IL	ILLINOIS
15	IN	INDIANA
16	KS	KANSAS
17	KY	KENTUCKY
18	LA	LOUISIANA
19	MA	MASSACHUSETTS
20	MD	MARYLAND
21	ME	MAINE
22	MI	MÍCHIGAN
23	MN	MINNESOTA
24	MO	MISSOURI
25	MS	MISSISSIPPI
26	MT	MONTANA
27	NC	NORTH CAROLINA
28	ND	NORTH DAKOTA
29	NE	NEBRASKA
30	NH	NEW HAMPSHIRE
31	NJ	NEW JERSEY
32	NM	NEW MEXICO
33	NV	NEVADA
34	NY	NUEVA YORK
35	OH	OHIO
36	OK	OKLAHOMA
37	OR	OREGÓN
38	PA	PENNSYLVANIA
39	RI	RHODE ISLAND
40	SC	SOUTH CAROLINA
41	SD	SOUTH DAKOTA
42	TN	TENNESSEE
43	TX	TEXAS
44	UT	UTAH
45	VA	VIRGINIA
46	VT	VERMONT
47	WA	WASHINGTON
48	WI	WISCONSIN
49	WV	WEST VIRGINIA
50	WY	WYOMING
\.


--
-- Data for Name: factura; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.factura (id, datos, created_at, id_solicitud, estado, ruta_pago, tipo_consignacion, nota_pago) FROM stdin;
81	{"tax": "1234", "logo": "patrinium", "Total": "", "email": "serazo31@gmail.com", "adress": "calle 48 #101-40", "servicios": {"Uber": {"valor": "2000", "cantidad": "2"}, "acuerdoDeSocios": {"valor": "1000", "cantidad": "1"}}, "number_tax": "12", "observaciones": "Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años,", "invoice_number": "f404", "cuenta_bancaria": "1"}	2024-10-21	13	1	JORGE MANDUJANO - PASAPORTE.pdf	Cheque	Pago realizado el 3 de octubre
82	{"tax": "1", "logo": "patrinium", "Total": "", "email": "serazo31@gmail.com", "adress": "calle 48 #101-40", "servicios": {"Uber": {"valor": "3", "cantidad": "1"}, "acuerdoDeSocios": {"valor": "3", "cantidad": "1"}, "recogida_aeropuerto": {"valor": "3", "cantidad": "2"}}, "number_tax": "1", "observaciones": "pruebaaaa", "invoice_number": "F900", "cuenta_bancaria": "1"}	2024-10-20	13	0	\N	\N	\N
\.


--
-- Data for Name: pais; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.pais (id_pais, cod_iso, pais, contin, localizacion, cod_ita) FROM stdin;
1	ABW	ARUBA	NORTH AMERICA	CARIBBEAN	AW
2	AFG	AFGHANISTAN	ASIA	SOUTHERN AND CENTRAL ASIA	AF
3	AGO	ANGOLA	AFRICA	CENTRAL AFRICA	AO
4	AIA	ANGUILLA	NORTH AMERICA	CARIBBEAN	AI
5	ALB	ALBANIA	EUROPE	SOUTHERN EUROPE	AL
6	AND	ANDORRA	EUROPE	SOUTHERN EUROPE	AD
7	ANT	NETHERLANDS ANTILLES	NORTH AMERICA	CARIBBEAN	AN
8	ARE	UNITED ARAB EMIRATES	ASIA	MIDDLE EAST	AE
9	ARG	ARGENTINA	SOUTH AMERICA	SOUTH AMERICA	AR
10	ARM	ARMENIA	ASIA	MIDDLE EAST	AM
11	ASM	AMERICAN SAMOA	OCEANIA	POLYNESIA	AS
12	ATA	ANTARCTICA	ANTARCTICA	ANTARCTICA	AQ
13	ATF	FRENCH SOUTHERN TERRITORIES	ANTARCTICA	ANTARCTICA	TF
14	ATG	ANTIGUA AND BARBUDA	NORTH AMERICA	CARIBBEAN	AG
15	AUS	AUSTRALIA	OCEANIA	AUSTRALIA AND NEW ZEALAND	AU
16	AUT	AUSTRIA	EUROPE	WESTERN EUROPE	AT
17	AZE	AZERBAIJAN	ASIA	MIDDLE EAST	AZ
18	BDI	BURUNDI	AFRICA	EASTERN AFRICA	BI
19	BEL	BELGIUM	EUROPE	WESTERN EUROPE	BE
20	BEN	BENIN	AFRICA	WESTERN AFRICA	BJ
21	BFA	BURKINA FASO	AFRICA	WESTERN AFRICA	BF
22	BGD	BANGLADESH	ASIA	SOUTHERN AND CENTRAL ASIA	BD
23	BGR	BULGARIA	EUROPE	EASTERN EUROPE	BG
24	BHR	BAHRAIN	ASIA	MIDDLE EAST	BH
25	BHS	BAHAMAS	NORTH AMERICA	CARIBBEAN	BS
26	BIH	BOSNIA AND HERZEGOVINA	EUROPE	SOUTHERN EUROPE	BA
27	BLR	BELARUS	EUROPE	EASTERN EUROPE	BY
28	BLZ	BELIZE	NORTH AMERICA	CENTRAL AMERICA	BZ
29	BMU	BERMUDA	NORTH AMERICA	NORTH AMERICA	BM
30	BOL	BOLIVIA	SOUTH AMERICA	SOUTH AMERICA	BO
31	BRA	BRAZIL	SOUTH AMERICA	SOUTH AMERICA	BR
32	BRB	BARBADOS	NORTH AMERICA	CARIBBEAN	BB
33	BRN	BRUNEI	ASIA	SOUTHEAST ASIA	BN
34	BTN	BHUTAN	ASIA	SOUTHERN AND CENTRAL ASIA	BT
35	BVT	BOUVET ISLAND	ANTARCTICA	ANTARCTICA	BV
36	BWA	BOTSWANA	AFRICA	SOUTHERN AFRICA	BW
37	CAF	CENTRAL AFRICAN REPUBLIC	AFRICA	CENTRAL AFRICA	CF
38	CAN	CANADA	NORTH AMERICA	NORTH AMERICA	CA
39	CCK	COCOS (KEELING) ISLANDS	OCEANIA	AUSTRALIA AND NEW ZEALAND	CC
40	CHE	SWITZERLAND	EUROPE	WESTERN EUROPE	CH
41	CHL	CHILE	SOUTH AMERICA	SOUTH AMERICA	CL
42	CHN	CHINA	ASIA	EASTERN ASIA	CN
43	CIV	CÏ¿½TE DÏ¿½IVOIRE	AFRICA	WESTERN AFRICA	CI
44	CMR	CAMEROON	AFRICA	CENTRAL AFRICA	CM
45	COD	CONGO	THE DEMOCRATIC REPUBLIC OF THE	AFRICA	CD
46	COG	CONGO	AFRICA	CENTRAL AFRICA	CG
47	COK	COOK ISLANDS	OCEANIA	POLYNESIA	CK
48	COL	COLOMBIA	SOUTH AMERICA	SOUTH AMERICA	CO
49	COM	COMOROS	AFRICA	EASTERN AFRICA	KM
50	CPV	CAPE VERDE	AFRICA	WESTERN AFRICA	CV
51	CRI	COSTA RICA	NORTH AMERICA	CENTRAL AMERICA	CR
52	CUB	CUBA	NORTH AMERICA	CARIBBEAN	CU
53	CXR	CHRISTMAS ISLAND	OCEANIA	AUSTRALIA AND NEW ZEALAND	CX
54	CYM	CAYMAN ISLANDS	NORTH AMERICA	CARIBBEAN	KY
55	CYP	CYPRUS	ASIA	MIDDLE EAST	CY
56	CZE	CZECH REPUBLIC	EUROPE	EASTERN EUROPE	CZ
57	DEU	GERMANY	EUROPE	WESTERN EUROPE	DE
58	DJI	DJIBOUTI	AFRICA	EASTERN AFRICA	DJ
59	DMA	DOMINICA	NORTH AMERICA	CARIBBEAN	DM
60	DNK	DENMARK	EUROPE	NORDIC COUNTRIES	DK
61	DOM	DOMINICAN REPUBLIC	NORTH AMERICA	CARIBBEAN	DO
62	DZA	ALGERIA	AFRICA	NORTHERN AFRICA	DZ
63	ECU	ECUADOR	SOUTH AMERICA	SOUTH AMERICA	EC
64	EGY	EGYPT	AFRICA	NORTHERN AFRICA	EG
65	ERI	ERITREA	AFRICA	EASTERN AFRICA	ER
66	ESH	WESTERN SAHARA	AFRICA	NORTHERN AFRICA	EH
67	ESP	SPAIN	EUROPE	SOUTHERN EUROPE	ES
68	EST	ESTONIA	EUROPE	BALTIC COUNTRIES	EE
69	ETH	ETHIOPIA	AFRICA	EASTERN AFRICA	ET
70	FIN	FINLAND	EUROPE	NORDIC COUNTRIES	FI
71	FJI	FIJI ISLANDS	OCEANIA	MELANESIA	FJ
72	FLK	FALKLAND ISLANDS	SOUTH AMERICA	SOUTH AMERICA	FK
73	FRA	FRANCE	EUROPE	WESTERN EUROPE	FR
74	FRO	FAROE ISLANDS	EUROPE	NORDIC COUNTRIES	FO
75	FSM	MICRONESIA	FEDERATED STATES OF	OCEANIA	FM
76	GAB	GABON	AFRICA	CENTRAL AFRICA	GA
77	GBR	UNITED KINGDOM	EUROPE	BRITISH ISLANDS	GB
78	GEO	GEORGIA	ASIA	MIDDLE EAST	GE
79	GHA	GHANA	AFRICA	WESTERN AFRICA	GH
80	GIB	GIBRALTAR	EUROPE	SOUTHERN EUROPE	GI
81	GIN	GUINEA	AFRICA	WESTERN AFRICA	GN
82	GLP	GUADELOUPE	NORTH AMERICA	CARIBBEAN	GP
83	GMB	GAMBIA	AFRICA	WESTERN AFRICA	GM
84	GNB	GUINEA-BISSAU	AFRICA	WESTERN AFRICA	GW
85	GNQ	EQUATORIAL GUINEA	AFRICA	CENTRAL AFRICA	GQ
86	GRC	GREECE	EUROPE	SOUTHERN EUROPE	GR
87	GRD	GRENADA	NORTH AMERICA	CARIBBEAN	GD
88	GRL	GREENLAND	NORTH AMERICA	NORTH AMERICA	GL
89	GTM	GUATEMALA	NORTH AMERICA	CENTRAL AMERICA	GT
90	GUF	FRENCH GUIANA	SOUTH AMERICA	SOUTH AMERICA	GF
91	GUM	GUAM	OCEANIA	MICRONESIA	GU
92	GUY	GUYANA	SOUTH AMERICA	SOUTH AMERICA	GY
93	HKG	HONG KONG	ASIA	EASTERN ASIA	HK
94	HMD	HEARD ISLAND AND MCDONALD ISLANDS	ANTARCTICA	ANTARCTICA	HM
95	HND	HONDURAS	NORTH AMERICA	CENTRAL AMERICA	HN
96	HRV	CROATIA	EUROPE	SOUTHERN EUROPE	HR
97	HTI	HAITI	NORTH AMERICA	CARIBBEAN	HT
98	HUN	HUNGARY	EUROPE	EASTERN EUROPE	HU
99	IDN	INDONESIA	ASIA	SOUTHEAST ASIA	ID
100	IND	INDIA	ASIA	SOUTHERN AND CENTRAL ASIA	IN
101	IOT	BRITISH INDIAN OCEAN TERRITORY	AFRICA	EASTERN AFRICA	IO
102	IRL	IRELAND	EUROPE	BRITISH ISLANDS	IE
103	IRN	IRAN	ASIA	SOUTHERN AND CENTRAL ASIA	IR
104	IRQ	IRAQ	ASIA	MIDDLE EAST	IQ
105	ISL	ICELAND	EUROPE	NORDIC COUNTRIES	IS
106	ISR	ISRAEL	ASIA	MIDDLE EAST	IL
107	ITA	ITALY	EUROPE	SOUTHERN EUROPE	IT
108	JAM	JAMAICA	NORTH AMERICA	CARIBBEAN	JM
109	JOR	JORDAN	ASIA	MIDDLE EAST	JO
110	JPN	JAPAN	ASIA	EASTERN ASIA	JP
111	KAZ	KAZAKSTAN	ASIA	SOUTHERN AND CENTRAL ASIA	KZ
112	KEN	KENYA	AFRICA	EASTERN AFRICA	KE
113	KGZ	KYRGYZSTAN	ASIA	SOUTHERN AND CENTRAL ASIA	KG
114	KHM	CAMBODIA	ASIA	SOUTHEAST ASIA	KH
115	KIR	KIRIBATI	OCEANIA	MICRONESIA	KI
116	KNA	SAINT KITTS AND NEVIS	NORTH AMERICA	CARIBBEAN	KN
117	KOR	SOUTH KOREA	ASIA	EASTERN ASIA	KR
118	KWT	KUWAIT	ASIA	MIDDLE EAST	KW
119	LAO	LAOS	ASIA	SOUTHEAST ASIA	LA
120	LBN	LEBANON	ASIA	MIDDLE EAST	LB
121	LBR	LIBERIA	AFRICA	WESTERN AFRICA	LR
122	LBY	LIBYAN ARAB JAMAHIRIYA	AFRICA	NORTHERN AFRICA	LY
123	LCA	SAINT LUCIA	NORTH AMERICA	CARIBBEAN	LC
124	LIE	LIECHTENSTEIN	EUROPE	WESTERN EUROPE	LI
125	LKA	SRI LANKA	ASIA	SOUTHERN AND CENTRAL ASIA	LK
126	LSO	LESOTHO	AFRICA	SOUTHERN AFRICA	LS
127	LTU	LITHUANIA	EUROPE	BALTIC COUNTRIES	LT
128	LUX	LUXEMBOURG	EUROPE	WESTERN EUROPE	LU
129	LVA	LATVIA	EUROPE	BALTIC COUNTRIES	LV
130	MAC	MACAO	ASIA	EASTERN ASIA	MO
131	MAR	MOROCCO	AFRICA	NORTHERN AFRICA	MA
132	MCO	MONACO	EUROPE	WESTERN EUROPE	MC
133	MDA	MOLDOVA	EUROPE	EASTERN EUROPE	MD
134	MDG	MADAGASCAR	AFRICA	EASTERN AFRICA	MG
135	MDV	MALDIVES	ASIA	SOUTHERN AND CENTRAL ASIA	MV
136	MEX	MEXICO	NORTH AMERICA	CENTRAL AMERICA	MX
137	MHL	MARSHALL ISLANDS	OCEANIA	MICRONESIA	MH
138	MKD	MACEDONIA	EUROPE	SOUTHERN EUROPE	MK
139	MLI	MALI	AFRICA	WESTERN AFRICA	ML
140	MLT	MALTA	EUROPE	SOUTHERN EUROPE	MT
141	MMR	MYANMAR	ASIA	SOUTHEAST ASIA	MM
142	MNG	MONGOLIA	ASIA	EASTERN ASIA	MN
143	MNP	NORTHERN MARIANA ISLANDS	OCEANIA	MICRONESIA	MP
144	MOZ	MOZAMBIQUE	AFRICA	EASTERN AFRICA	MZ
145	MRT	MAURITANIA	AFRICA	WESTERN AFRICA	MR
146	MSR	MONTSERRAT	NORTH AMERICA	CARIBBEAN	MS
147	MTQ	MARTINIQUE	NORTH AMERICA	CARIBBEAN	MQ
148	MUS	MAURITIUS	AFRICA	EASTERN AFRICA	MU
149	MWI	MALAWI	AFRICA	EASTERN AFRICA	MW
150	MYS	MALAYSIA	ASIA	SOUTHEAST ASIA	MY
151	MYT	MAYOTTE	AFRICA	EASTERN AFRICA	YT
152	NAM	NAMIBIA	AFRICA	SOUTHERN AFRICA	NA
153	NCL	NEW CALEDONIA	OCEANIA	MELANESIA	NC
154	NER	NIGER	AFRICA	WESTERN AFRICA	NE
155	NFK	NORFOLK ISLAND	OCEANIA	AUSTRALIA AND NEW ZEALAND	NF
156	NGA	NIGERIA	AFRICA	WESTERN AFRICA	NG
157	NIC	NICARAGUA	NORTH AMERICA	CENTRAL AMERICA	NI
158	NIU	NIUE	OCEANIA	POLYNESIA	NU
159	NLD	NETHERLANDS	EUROPE	WESTERN EUROPE	NL
160	NOR	NORWAY	EUROPE	NORDIC COUNTRIES	NO
161	NPL	NEPAL	ASIA	SOUTHERN AND CENTRAL ASIA	NP
162	NRU	NAURU	OCEANIA	MICRONESIA	NR
163	NZL	NEW ZEALAND	OCEANIA	AUSTRALIA AND NEW ZEALAND	NZ
164	OMN	OMAN	ASIA	MIDDLE EAST	OM
165	PAK	PAKISTAN	ASIA	SOUTHERN AND CENTRAL ASIA	PK
166	PAN	PANAMA	NORTH AMERICA	CENTRAL AMERICA	PA
167	PCN	PITCAIRN	OCEANIA	POLYNESIA	PN
168	PER	PERU	SOUTH AMERICA	SOUTH AMERICA	PE
169	PHL	PHILIPPINES	ASIA	SOUTHEAST ASIA	PH
170	PLW	PALAU	OCEANIA	MICRONESIA	PW
171	PNG	PAPUA NEW GUINEA	OCEANIA	MELANESIA	PG
172	POL	POLAND	EUROPE	EASTERN EUROPE	PL
173	PRI	PUERTO RICO	NORTH AMERICA	CARIBBEAN	PR
174	PRK	NORTH KOREA	ASIA	EASTERN ASIA	KP
175	PRT	PORTUGAL	EUROPE	SOUTHERN EUROPE	PT
176	PRY	PARAGUAY	SOUTH AMERICA	SOUTH AMERICA	PY
177	PSE	PALESTINE	ASIA	MIDDLE EAST	PS
178	PYF	FRENCH POLYNESIA	OCEANIA	POLYNESIA	PF
179	QAT	QATAR	ASIA	MIDDLE EAST	QA
180	REU	RÏ¿½UNION	AFRICA	EASTERN AFRICA	RE
181	ROM	ROMANIA	EUROPE	EASTERN EUROPE	RO
182	RUS	RUSSIAN FEDERATION	EUROPE	EASTERN EUROPE	RU
183	RWA	RWANDA	AFRICA	EASTERN AFRICA	RW
184	SAU	SAUDI ARABIA	ASIA	MIDDLE EAST	SA
185	SDN	SUDAN	AFRICA	NORTHERN AFRICA	SD
186	SEN	SENEGAL	AFRICA	WESTERN AFRICA	SN
187	SGP	SINGAPORE	ASIA	SOUTHEAST ASIA	SG
188	SGS	SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS	ANTARCTICA	ANTARCTICA	GS
189	SHN	SAINT HELENA	AFRICA	WESTERN AFRICA	SH
190	SJM	SVALBARD AND JAN MAYEN	EUROPE	NORDIC COUNTRIES	SJ
191	SLB	SOLOMON ISLANDS	OCEANIA	MELANESIA	SB
192	SLE	SIERRA LEONE	AFRICA	WESTERN AFRICA	SL
193	SLV	EL SALVADOR	NORTH AMERICA	CENTRAL AMERICA	SV
194	SMR	SAN MARINO	EUROPE	SOUTHERN EUROPE	SM
195	SOM	SOMALIA	AFRICA	EASTERN AFRICA	SO
196	SPM	SAINT PIERRE AND MIQUELON	NORTH AMERICA	NORTH AMERICA	PM
197	STP	SAO TOME AND PRINCIPE	AFRICA	CENTRAL AFRICA	ST
198	SUR	SURINAME	SOUTH AMERICA	SOUTH AMERICA	SR
199	SVK	SLOVAKIA	EUROPE	EASTERN EUROPE	SK
200	SVN	SLOVENIA	EUROPE	SOUTHERN EUROPE	SI
201	SWE	SWEDEN	EUROPE	NORDIC COUNTRIES	SE
202	SWZ	SWAZILAND	AFRICA	SOUTHERN AFRICA	SZ
203	SYC	SEYCHELLES	AFRICA	EASTERN AFRICA	SC
204	SYR	SYRIA	ASIA	MIDDLE EAST	SY
205	TCA	TURKS AND CAICOS ISLANDS	NORTH AMERICA	CARIBBEAN	TC
206	TCD	CHAD	AFRICA	CENTRAL AFRICA	TD
207	TGO	TOGO	AFRICA	WESTERN AFRICA	TG
208	THA	THAILAND	ASIA	SOUTHEAST ASIA	TH
209	TJK	TAJIKISTAN	ASIA	SOUTHERN AND CENTRAL ASIA	TJ
210	TKL	TOKELAU	OCEANIA	POLYNESIA	TK
211	TKM	TURKMENISTAN	ASIA	SOUTHERN AND CENTRAL ASIA	TM
212	TMP	EAST TIMOR	ASIA	SOUTHEAST ASIA	TP
213	TON	TONGA	OCEANIA	POLYNESIA	TO
214	TTO	TRINIDAD AND TOBAGO	NORTH AMERICA	CARIBBEAN	TT
215	TUN	TUNISIA	AFRICA	NORTHERN AFRICA	TN
216	TUR	TURKEY	ASIA	MIDDLE EAST	TR
217	TUV	TUVALU	OCEANIA	POLYNESIA	TV
218	TWN	TAIWAN	ASIA	EASTERN ASIA	TW
219	TZA	TANZANIA	AFRICA	EASTERN AFRICA	TZ
220	UGA	UGANDA	AFRICA	EASTERN AFRICA	UG
221	UKR	UKRAINE	EUROPE	EASTERN EUROPE	UA
222	UMI	UNITED STATES MINOR OUTLYING ISLANDS	OCEANIA	MICRONESIA/CARIBBEAN	UM
223	URY	URUGUAY	SOUTH AMERICA	SOUTH AMERICA	UY
224	USA	UNITED STATES	NORTH AMERICA	NORTH AMERICA	US
225	UZB	UZBEKISTAN	ASIA	SOUTHERN AND CENTRAL ASIA	UZ
226	VAT	HOLY SEE (VATICAN CITY STATE)	EUROPE	SOUTHERN EUROPE	VA
227	VCT	SAINT VINCENT AND THE GRENADINES	NORTH AMERICA	CARIBBEAN	VC
228	VEN	VENEZUELA	SOUTH AMERICA	SOUTH AMERICA	VE
229	VGB	VIRGIN ISLANDS	BRITISH	NORTH AMERICA	VG
230	VIR	VIRGIN ISLANDS	U.S.	NORTH AMERICA	VI
231	VNM	VIETNAM	ASIA	SOUTHEAST ASIA	VN
232	VUT	VANUATU	OCEANIA	MELANESIA	VU
233	WLF	WALLIS AND FUTUNA	OCEANIA	POLYNESIA	WF
234	WSM	SAMOA	OCEANIA	POLYNESIA	WS
235	YEM	YEMEN	ASIA	MIDDLE EAST	YE
236	YUG	YUGOSLAVIA	EUROPE	SOUTHERN EUROPE	YU
237	ZAF	SOUTH AFRICA	AFRICA	SOUTHERN AFRICA	ZA
238	ZMB	ZAMBIA	AFRICA	EASTERN AFRICA	ZM
239	ZWE	ZIMBABWE	AFRICA	EASTERN AFRICA	ZW
\.


--
-- Data for Name: permisos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permisos (id, nombre, created_at, updated_at) FROM stdin;
b92775a3-e4fd-4d41-82a7-a21b9e9d07f0	laboratorio	2024-03-06 11:11:12	\N
7c025ebd-e145-4449-8d67-c2bb0d4a0b62	colposcopia	2024-03-06 11:12:00	\N
a0f62197-b91a-48fa-8531-4983761ae3ac	VPH	2024-03-07 05:21:20	\N
2a5d66b0-8ce9-4c16-8a9b-f0f12e224b84	seguridad	2024-03-07 05:38:31	\N
54cfb534-4808-4771-acc2-430eb32a46c9	informes	2024-03-07 05:38:51	\N
ed0548ae-6b7c-4b63-939d-4837877b72a0	informacion	2024-03-07 05:39:05	\N
0f4a256e-e0fa-4bf4-aaf1-11913fe19e72	pacientes	2024-03-07 05:39:13	\N
da7ef5e1-eb7e-4876-a2d3-2c1890fe1ac1	seguimientos	2024-03-07 05:39:38	\N
d4dd3331-39dc-4b37-9817-92fc622d4053	casos	2024-03-07 06:18:19	\N
eb8996a8-689c-4441-a0d1-a63ea254e400	entrega resultados	2024-03-07 06:18:33	\N
1956078a-7bae-4541-9fb9-0cdc1be594ae	resultados entregados	2024-03-07 06:18:58	\N
a5491c7f-def4-4460-9b73-a674414fcda0	impresion	2024-03-07 06:19:13	\N
96861c4f-e404-43e7-bafd-e77870fc135a	integracion Viper	2024-03-07 06:19:33	\N
06f4bd36-acf4-4dbd-b9d6-c066497a7b98	configuracion	2024-03-07 06:19:50	\N
f67aeb37-9071-486f-8e8f-99baf100411d	citologia	2024-03-07 06:24:45	\N
26451748-2441-4ea3-aaaf-e5808fc01fc5	Biopsias	2024-03-08 03:49:58	\N
\.


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.persona (id_persona, nombres, apellidos, cedula, pais, ciudad, cliente, oficina_envia, estadousa, pasaporte_numero, pasaporte_fecha_expedicion, pasaporte_fecha_caducidad, tipo_visa, fecha_expedicion_visa, fecha_caducidad_visa, fecha_creacion, usuario_createat) FROM stdin;
1	\N	\N	213231231	17	dssdasda	sdasad	qweweqqw		213221323123	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-21	2024-03-14 18:13:02.472514	ssadsad
2	\N	\N	213231231	17	dssdasda	sdasad	qweweqqw		213221323123	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-21	2024-03-14 18:18:29.675292	\N
3	\N	\N	213231231	17	dssdasda	sdasad	qweweqqw		213221323123	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-21	2024-03-14 18:20:57.161101	\N
4	\N	\N	213231231	17	dssdasda	sdasad	qweweqqw		213221323123	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-21	2024-03-14 18:23:39.459035	\N
5	\N	\N	sdasad	18	das	asd	asd		saddsa	2024-03-09	2024-03-09	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:24:04.216246	\N
6	\N	\N	sdasad	18	das	asd	asd		saddsa	2024-03-09	2024-03-09	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:25:00.141131	\N
7	\N	\N	sdasad	18	das	asd	asd		saddsa	2024-03-09	2024-03-09	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:26:25.943511	\N
8	\N	\N	21312321	1	asd	asd	sda		a123231231231	2024-02-29	2024-03-09	sadsad	2024-03-29	2024-03-22	2024-03-14 18:26:53.663648	\N
9	\N	\N	21312321	1	asd	asd	sda		a123231231231	2024-02-29	2024-03-09	sadsad	2024-03-29	2024-03-22	2024-03-14 18:27:10.199216	\N
10	\N	\N	asddsa	16	adsads	adssad	adsasd		asdsdadsa	2024-03-13	2024-03-02	asd	2024-03-14	2024-03-16	2024-03-14 18:27:34.030592	\N
11	eliana	ortega caicedo	1085275751	1	asd	asd	sadds		2131221331	2024-03-14	2024-03-14	sdadsa	2024-03-30	2024-03-29	2024-03-14 18:29:18.958577	eliana
12	ruby	caicedo diaz	37720381	48	pasto	santiago	sosos		213231231231	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:31:59.715737	ruby
13	ruby	caicedo diaz	37720381	48	pasto	santiago	sosos		213231231231	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:34:16.776364	ruby
14	juan	dsaasddsa	sa	17	dssdasda	sdasad	adsasd		asdsdadsa	2024-03-14	2024-03-14	ssadsad	2024-03-23	2024-03-09	2024-03-14 18:34:44.174084	juan
15	asddsadsaads	dsaasddsa	1233213221	16	dssdasda	sdasad	adsasd		asd	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:35:50.667415	asddsadsaads
16	asddsadsaads	dsaasddsa	1233213221	16	dssdasda	sdasad	adsasd		asd	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:35:53.06978	asddsadsaads
17	asddsadsaads	dsaasddsa	1233213221	16	dssdasda	sdasad	adsasd		asd	2024-03-14	2024-03-14	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:35:55.028844	asddsadsaads
18	ruby wwqe	dsaasddsaqweweq	sa3123123	17	dssdasda	sdasad	sosos		321	2024-03-16	2024-03-16	ssadsad	2024-03-14	2024-03-14	2024-03-14 18:37:20.843592	ruby wwqe
19	wqewe21312312312	213231231	2312312	15	21231	21231	123213		2123	2024-03-14	2024-03-14	dfggfd	2024-03-14	2024-03-14	2024-03-14 18:40:29.224662	wqewe21312312312
20	wqewe21312312312	213231231	2312312	15	21231	21231	123213		2123	2024-03-14	2024-03-14	dfggfd	2024-03-14	2024-03-14	2024-03-14 18:41:13.185633	wqewe21312312312
21	wqewe21312312312	213231231	2312312	15	21231	21231	123213		2123	2024-03-14	2024-03-14	dfggfd	2024-03-14	2024-03-14	2024-03-14 18:41:14.181037	wqewe21312312312
22	wqewe21312312312	213231231	2312312	15	21231	21231	123213		2123	2024-03-14	2024-03-14	dfggfd	2024-03-14	2024-03-14	2024-03-14 18:41:14.349098	wqewe21312312312
23	213321	213321	123321	16	231321	123231	123321		123321	2024-03-14	2024-03-23	31321	2024-03-14	2024-03-14	2024-03-14 18:41:33.375013	213321
24	2323132121	asddas	asdads	17	dasads	dsasad	sdadsa		31321	2024-03-14	2024-03-14	ddsa	2024-03-14	2024-03-14	2024-03-14 18:42:08.333852	2323132121
25	asddsadsaads	lozano	sa		dssdasda	sdasad	sosos		asdsdadsa	2024-03-16	2024-03-26	ssadsad	2024-03-21	2024-03-15	2024-03-16 16:21:54.348583	asddsadsaads
\.


--
-- Data for Name: personas_sociedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.personas_sociedad (id_personas_sociedad, nombre_sociedad, fk_persona, porcentaje, create_at, create_user, fk_solicitud, uuid) FROM stdin;
48	prueba_UUID	55	90.00	2024-11-07 14:26:18.881895	usuario_ejemplo	13	3670447a-0f07-489f-aa14-5446a9e40f05
50	pruea_UUID_unico	55	10.00	2024-11-07 14:34:02.493	usuario_ejemplo	13	f1255464-eacd-4713-92c5-274359ef0893
51	pruea_UUID_unico	58	90.00	2024-11-07 14:34:02.524183	usuario_ejemplo	13	f1255464-eacd-4713-92c5-274359ef0893
49	prueba_UUID	58	10.00	2024-11-07 14:26:18.912441	usuario_ejemplo	13	3670447a-0f07-489f-aa14-5446a9e40f05
52	plato	55	23.00	2024-11-08 08:56:02.163994	usuario_ejemplo	14	0a46f31d-7777-424e-9f11-145ea36e39df
53	plato	55	77.00	2024-11-08 08:56:02.193511	usuario_ejemplo	14	0a46f31d-7777-424e-9f11-145ea36e39df
\.


--
-- Data for Name: plantillas_save_html; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.plantillas_save_html (id_plantillas_save, contenido_html, createat, usuario, fk_solicitud) FROM stdin;
6	<div style="page: page1;">\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">WASHINTONG USA</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;"> </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">LLCsad</span></p>\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">(nombre del </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">clinete</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">)</span></p>\n<p style="text-align: center;"><span style="font-size: 8pt;">(A Delaware Limited Liability Company)</span></p>\n<p style="text-align: center;"><span style="font-size: 9pt;">SR </span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3</span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3XXXXXX</span><span style="font-size: 9pt;"> FILE</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">72</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">XXXXXX</span></p>\n<p style="text-align: center;"><span style="font-size: 9pt;">(inserter)</span></p>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">COMPANY INFORMATION DETAILS</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Organization and Registration</span></p>\n</td>\n<td>\n<p><span lang="es-ES">February</span><span lang="es-ES"> 10, 2023</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">State of Organization:</span></p>\n</td>\n<td>\n<p>Delaware <span style="font-size: 9pt;">SR </span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3XXXXXX FILE</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">72XXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Principal Place of Business:</span></p>\n</td>\n<td>\n<p>Stuart Florida (default florida)</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Members:</span></p>\n</td>\n<td>\n<p>DeSoto Investments LLC</p>\n<p><span style="font-size: 9pt;">Authorized Person: Moni</span><span style="font-size: 9pt;">k</span><span style="font-size: 9pt;">a</span><span style="font-size: 9pt;"> A. Lewinski</span></p>\n<p>George Washington</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Bank Account:</span></p>\n</td>\n<td>\n<p>January &ndash; December</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Fiscal Year:</span></p>\n</td>\n<td>\n<p><span lang="es-ES">XX-XXXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span lang="es-ES" style="font-weight: bold;">EIN</span><span lang="es-ES">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Annual Meeting</span><span style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Secretary</span><span lang="es-ES-tradnl" style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Treasurer:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Miembros</span></p>\n</td>\n<td>\n<p>Sdadsasda</p>\n<p>Asddas</p>\n<p>asdasd</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">insertar</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Initial Temporal Manager:</span></p>\n</td>\n<td>\n<p>CYVA INTERNATIONAL SERVICES LLC</p>\n<p>By: Jairo Vargas authorized Signatory</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p style="margin-left: 1800in; margin-right: 0in;">&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</div>	2024-09-30	admin	3
7	<div style="page: page1;">\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-size: 24pt; font-weight: bold;">CERTIFICATE OF FORMATION</span></p>\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-size: 24pt; font-weight: bold;">O</span><span style="font-size: 24pt; font-weight: bold;">F</span></p>\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-size: 22pt; font-weight: bold;">WASHINGTON USA</span><span style="font-size: 22pt; font-weight: bold;"> LLC</span><span style="font-size: 22pt; font-weight: bold;"> </span></p>\n<p>&nbsp;</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">This Certificate of Formation of &ndash; <span style="font-weight: bold;">WASHINGTON USA LLC</span><span style="font-size: 11pt; font-weight: bold;"> </span><span style="font-size: 11pt; font-weight: bold;">- </span>(the "Company") has been duly executed and is being filed by the undersigned authorized person for the purpose of forming a limited liability company pursuant to the Delaware Limited Liability Company Act, (6 <span style="text-decoration: underline;">Del.</span> <span style="text-decoration: underline;">C</span>. &sect;&sect;18-101, <span style="text-decoration: underline;">et</span> <span style="text-decoration: underline;">seq</span>.) (the &ldquo;Act&rdquo;).</p>\n<p><span style="text-decoration: underline;">Name</span></p>\n<p>. The name of the limited liab</p>\n<p>ility company formed hereby</p>\n<p>is:</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-weight: bold;">WASHINGTON USA LLC</span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span> <span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span></p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">2. <span style="text-decoration: underline;">Registered Office</span>. The address of the registered office of the Company in the State of Delaware is c/o Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">3. <span style="text-decoration: underline;">Registered Agent</span>. The name and address of the registered agent for service of process on the Company in the State of Delaware is Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">4. <span style="text-decoration: underline;">Other Matters</span>. The limited liability company agreement of the Company entered into by the members of the Company (the &ldquo;Agreement&rdquo;) provides that the management of the Company shall be vested exclusively in a manager of the Company designated by the Agreement (the &ldquo;Manager&rdquo;), and the Agreement designates <span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span> as the sole Manager of the Company. Further, as authorized by Section 18-108 of the Act and provided by the Agreement, the Company has the power to and shall, to the fullest extent permitted by applicable law, indemnify and hold harmless the Manager, and each other person authorized to act on behalf of the Company from time to time (collectively, the &ldquo;Indemnitee&rdquo;), from and against all liabilities and claims against the Indemnitee, arising from the Indemnitee&rsquo;s performance of his duties in conformance with the terms of the Agreement.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;"><span lang="es-CO">(agregar o quitar cosas)</span></p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">&nbsp;</p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">JAIRO ROMAN ERAZO&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>___________________________________</p>\n<p>Tandem International Business Services LLC - Organizer</p>\n<p>By: Jairo Vargas &ndash; Authorized Person</p>\n</div>	2024-09-30	admin	1
8	<div style="page: page1;">\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-size: 24pt; font-weight: bold;">CERTIFICATE OF FORMATION</span></p>\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;"><span style="font-size: 24pt; font-weight: bold;">O</span><span style="font-size: 24pt; font-weight: bold;">F</span></p>\n<p style="text-align: center; margin-top: 5pt; margin-bottom: 5pt;">&nbsp;</p>\n<p>&nbsp;</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">This Certificate of Formation of &ndash; <span style="font-weight: bold;">WASHINGTON USA LLC</span><span style="font-size: 11pt; font-weight: bold;"> </span><span style="font-size: 11pt; font-weight: bold;">- </span>(the "Company") has been duly executed and is being filed by the undersigned authorizedn for the purpose of forming a limited liability company pursuant to the Delaware Limited Liability Company Act, (6&nbsp;<span style="text-decoration: underline;">Del.</span> <span style="text-decoration: underline;">C</span>. &sect;&sect;18-101, <span style="text-decoration: underline;">et</span> <span style="text-decoration: underline;">seq</span>.) (the &ldquo;Act&rdquo;).</p>\n<p><span style="text-decoration: underline;">Name</span></p>\n<p>. The name of the limited liab</p>\n<p>ility company formed hereby</p>\n<p>is:</p>\n<p>jclkzdjas</p>\n<p>jkaskdaslsda</p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;"><span style="font-weight: bold;">WASHINGTON USA LLC</span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span><span style="font-weight: bold;"> </span> <span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt; font-weight: bold;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span><span style="font-size: 14pt;"> </span></p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">2. <span style="text-decoration: underline;">Registered Off<em>ice</em></span><em>. The address of the registered off</em>ice of the Company in the State of Delaware is c/o Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">3. <span style="text-decoration: underline;">Registered Agent</span>. The name and address of the registered ag<strong>ent for service of proc</strong>ess on the Company in the State of Delaware is Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">4. <span style="text-decoration: underline;">Other Matters</span>. The limited liability company agreement of the Company entered into by the members of the Company (the &ldquo;Agreement&rdquo;) provides that the management of the Company shall be vested exclusively in a manager of the Company designated by the Agreement (the &ldquo;Manager&rdquo;), and the Agreement designates <span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span> as the sole Manager of the Company. Further, as authorized by Section 18-108 of the Act and provided by the Agreement, the Company has the power to and shall, to the fullest extent permitted by applicable law, indemnify and hold harmless the Manager, and each other person authorized to act on behalf of the Company from time to time (collectively, the &ldquo;Indemnitee&rdquo;), from and against all liabilities and claims against the Indemnitee, arising from the Indemnitee&rsquo;s performance of his duties in conformance with the terms of the Agreement.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;"><span lang="es-CO">(agregar o quitar cosas)</span></p>\n<p style="margin-top: 5pt; margin-bottom: 5pt;">IN WITNESS WHEREOF, the undersigned being fully authorized person has caused this Certificate of Formation to be duly executed as of the 10<span style="vertical-align: super;">th</span> day of February 2023.</p>\n<p>&nbsp;</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">2. <span style="text-decoration: underline;">Registered Office</span>. The address of the registered office of the Company in the State of Delaware is c/o Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">3. <span style="text-decoration: underline;">Registered Agent</span>. The name and address of the registered agent for service of process on the Company in the State of Delaware is Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">4. <span style="text-decoration: underline;">Other Matters</span>. The limited liability company agreement of the Company entered into by the members of the Company (the &ldquo;Agreement&rdquo;) provides that the management of the Company shall be vested exclusively in a manager of the Company designated by the Agreement (the &ldquo;Manager&rdquo;), and the Agreement designates <span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span> as the sole Manager of the Company. Further, as authorized by Section 18-108 of the Act and provided by the Agreement, the Company has the power to and shall, to the fullest extent permitted by applicable law, indemnify and hold harmless the Manager, and each other person authorized to act on behalf of the Company from time to time (collectively, the &ldquo;Indemnitee&rdquo;), from and against all liabilities and claims against the Indemnitee, arising from the Indemnitee&rsquo;s performance of his duties in conformance with the terms of the Agreement.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;"><span lang="es-CO">(agregar o quitar cosas)<br></span><span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span></p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">2. <span style="text-decoration: underline;">Registered Office</span>. The address of the registered office of the Company in the State of Delaware is c/o Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">3. <span style="text-decoration: underline;">Registered Agent</span>. The name and address of the registered agent for service of process on the Company in the State of Delaware is Harvard Business Services, Inc., 16192 Coastal Highway, Lewes, Sussex County, Delaware 19958.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;">4. <span style="text-decoration: underline;">Other Matters</span>. The limited liability company agreement of the Company entered into by the members of the Company (the &ldquo;Agreement&rdquo;) provides that the management of the Company shall be vested exclusively in a manager of the Company designated by the Agreement (the &ldquo;Manager&rdquo;), and the Agreement designates <span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span> as the sole Manager of the Company. Further, as authorized by Section 18-108 of the Act and provided by the Agreement, the Company has the power to and shall, to the fullest extent permitted by applicable law, indemnify and hold harmless the Manager, and each other person authorized to act on behalf of the Company from time to time (collectively, the &ldquo;Indemnitee&rdquo;), from and against all liabilities and claims against the Indemnitee, arising from the Indemnitee&rsquo;s performance of his duties in conformance with the terms of the Agreement.</p>\n<p style="text-align: justify; margin-top: 5pt; margin-bottom: 5pt;"><span lang="es-CO">(agregar o quitar cosas)<span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span></span></p>\n<p>___________________________________</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-weight: bold;">C</span><span style="font-weight: bold;">yva International Services LLC</span></p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n<p>Tandem International Business Services LLC - Organizer</p>\n<p>By: Jairo Vargas &ndash; Authorized Person</p>\n</div>	2024-10-04	admin	1
9	<div style="page: page1;">\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">WASHINTONG USA</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;"> </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">LLC </span></p>\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">(nombre del </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">clinete</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">)</span></p>\n<p style="text-align: center;"><span style="font-size: 8pt;">(A Delaware Limited Liability Company)</span></p>\n<p style="text-align: center;"><span style="font-size: 12px;">SANTAIGOeRAZO 123456789</span></p>\n<p style="text-align: center;"><span style="font-size: 9pt;">(inserter)</span></p>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">COMPANY INFORMATION DETAILS</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Organization and Registration</span></p>\n</td>\n<td>\n<p><span lang="es-ES">February</span><span lang="es-ES"> 10, 2023</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">State of Organization:</span></p>\n</td>\n<td>\n<p>Delaware <span style="font-size: 9pt;">SR </span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3XXXXXX FILE</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">72XXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Principal Place of Business:</span></p>\n</td>\n<td>\n<p>Stuart Florida (default florida)</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Members:</span></p>\n</td>\n<td>\n<p>DeSoto Investments LLC</p>\n<p><span style="font-size: 9pt;">Authorized Person: Moni</span><span style="font-size: 9pt;">k</span><span style="font-size: 9pt;">a</span><span style="font-size: 9pt;"> A. Lewinski</span></p>\n<p>George Washington</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Bank Account:</span></p>\n</td>\n<td>\n<p>January &ndash; December</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Fiscal Year:</span></p>\n</td>\n<td>\n<p><span lang="es-ES">XX-XXXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span lang="es-ES" style="font-weight: bold;">EIN</span><span lang="es-ES">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Annual Meeting</span><span style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Secretary</span><span lang="es-ES-tradnl" style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Treasurer:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Miembros</span></p>\n</td>\n<td>\n<p>Sdadsasda</p>\n<p>Asddas</p>\n<p>asdasd</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">insertar</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Initial Temporal Manager:</span></p>\n</td>\n<td>\n<p>CYVA INTERNATIONAL SERVICES LLC</p>\n<p>By: Jairo Vargas authorized Signatory</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p style="margin-left: 1800in; margin-right: 0in;">&nbsp;</p>\n<p>&nbsp;</p>\n<p>&nbsp;</p>\n</div>	2024-10-20	admin	13
10	<div style="page: page1;">\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">WASHINTONG USA</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;"> </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">LLC </span></p>\n<p style="text-align: center;"><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">(nombre del </span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">clinete</span><span lang="es-ES" style="font-size: 22pt; font-weight: bold;">)</span></p>\n<p style="text-align: center;"><span style="font-size: 8pt;">(A Delaware Limited Liability Company)</span></p>\n<p style="text-align: center;"><span style="font-size: 9pt;">SR </span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3</span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3XXXXXX</span><span style="font-size: 9pt;"> FILE</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">72</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">XXXXXX</span></p>\n<p style="text-align: center;"><span style="font-size: 9pt;">(inserter)</span></p>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">COMPANY INFORMATION DETAILS</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Organization and Registration</span></p>\n</td>\n<td>\n<p><span lang="es-ES">February</span><span lang="es-ES"> 10, 2023</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">State of Organization:</span></p>\n</td>\n<td>\n<p>Delaware <span style="font-size: 9pt;">SR </span><span style="font-size: 9pt;">202</span><span style="font-size: 9pt;">3XXXXXX FILE</span><span style="font-size: 9pt;"> </span><span style="font-size: 9pt;">72XXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Principal Place of Business:</span></p>\n</td>\n<td>\n<p>Stuart Florida (default florida)</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Members:</span></p>\n</td>\n<td>\n<p>DeSoto Investments LLC</p>\n<p><span style="font-size: 9pt;">Authorized Person: Moni</span><span style="font-size: 9pt;">k</span><span style="font-size: 9pt;">a</span><span style="font-size: 9pt;"> A. Lewinski</span></p>\n<p>George Washington</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Bank Account:</span></p>\n</td>\n<td>\n<p>January &ndash; December</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Fiscal Year:</span></p>\n</td>\n<td>\n<p><span lang="es-ES">XX-XXXXXXX</span></p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span lang="es-ES" style="font-weight: bold;">EIN</span><span lang="es-ES">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Date of Annual Meeting</span><span style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Secretary</span><span lang="es-ES-tradnl" style="font-weight: bold;">:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Treasurer:</span></p>\n</td>\n<td>\n<p>&nbsp;</p>\n</td>\n</tr>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Miembros</span></p>\n</td>\n<td>\n<p>Sdadsasda</p>\n<p>Asddas</p>\n<p>asdasd</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p>&nbsp;</p>\n<p style="text-align: center;"><span style="font-size: 14pt; font-weight: bold;">insertar</span></p>\n<p>&nbsp;</p>\n<table class="Tablaconcuadrcula">\n<tbody>\n<tr>\n<td>\n<p><span style="font-weight: bold;">Initial Temporal Manager:</span></p>\n</td>\n<td>\n<p>CYVA INTERNATIONAL SERVICES LLC</p>\n<p>By: Jairo Vargas authorized Signatory</p>\n<p>&nbsp;</p>\n</td>\n</tr>\n</tbody>\n</table>\n<p style="margin-left: 1800in; margin-right: 0in;">&nbsp;</p>\n<p>pruiebaaaa nuevos estilos 22 de octubre</p>\n<p>&nbsp;</p>\n</div>	2024-10-22	admin	14
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, rol, inicio_ruta, entrega_resultados, resultados_entregados, impresion_resultados, laboratorio, vph, integracion_viper, seguimientos, colposcopia, pacientes, informacion, informes, config_general, seguridad, created_at, updated_at) FROM stdin;
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	Administrador	t	t	t	t	t	t	t	t	t	t	t	t	t	t	2024-03-06 15:49:21.213863	\N
833c6fcf-6f91-4e24-93c9-d529497a3e5b	Root	t	t	t	t	t	t	t	t	t	t	t	t	t	t	2024-03-06 15:49:21.213863	\N
67802511-e7f0-40f1-9eb4-e44d09c1ac23	Verificacion	t	t	f	f	t	f	f	f	f	f	f	f	f	f	2024-03-06 15:49:21.213863	\N
4a308b7c-6eb9-4bce-bdec-f3c1bc3e217d	Digitador	t	t	t	f	f	f	f	t	f	f	f	f	f	f	2024-03-06 15:49:21.213863	\N
\.


--
-- Data for Name: roles_has_permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles_has_permiso (id_rol, id_permiso) FROM stdin;
833c6fcf-6f91-4e24-93c9-d529497a3e5b	b92775a3-e4fd-4d41-82a7-a21b9e9d07f0
833c6fcf-6f91-4e24-93c9-d529497a3e5b	7c025ebd-e145-4449-8d67-c2bb0d4a0b62
833c6fcf-6f91-4e24-93c9-d529497a3e5b	a0f62197-b91a-48fa-8531-4983761ae3ac
833c6fcf-6f91-4e24-93c9-d529497a3e5b	2a5d66b0-8ce9-4c16-8a9b-f0f12e224b84
833c6fcf-6f91-4e24-93c9-d529497a3e5b	54cfb534-4808-4771-acc2-430eb32a46c9
833c6fcf-6f91-4e24-93c9-d529497a3e5b	ed0548ae-6b7c-4b63-939d-4837877b72a0
833c6fcf-6f91-4e24-93c9-d529497a3e5b	0f4a256e-e0fa-4bf4-aaf1-11913fe19e72
833c6fcf-6f91-4e24-93c9-d529497a3e5b	da7ef5e1-eb7e-4876-a2d3-2c1890fe1ac1
833c6fcf-6f91-4e24-93c9-d529497a3e5b	d4dd3331-39dc-4b37-9817-92fc622d4053
833c6fcf-6f91-4e24-93c9-d529497a3e5b	eb8996a8-689c-4441-a0d1-a63ea254e400
833c6fcf-6f91-4e24-93c9-d529497a3e5b	1956078a-7bae-4541-9fb9-0cdc1be594ae
833c6fcf-6f91-4e24-93c9-d529497a3e5b	a5491c7f-def4-4460-9b73-a674414fcda0
833c6fcf-6f91-4e24-93c9-d529497a3e5b	96861c4f-e404-43e7-bafd-e77870fc135a
833c6fcf-6f91-4e24-93c9-d529497a3e5b	06f4bd36-acf4-4dbd-b9d6-c066497a7b98
833c6fcf-6f91-4e24-93c9-d529497a3e5b	f67aeb37-9071-486f-8e8f-99baf100411d
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	b92775a3-e4fd-4d41-82a7-a21b9e9d07f0
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	7c025ebd-e145-4449-8d67-c2bb0d4a0b62
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	a0f62197-b91a-48fa-8531-4983761ae3ac
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	2a5d66b0-8ce9-4c16-8a9b-f0f12e224b84
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	54cfb534-4808-4771-acc2-430eb32a46c9
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	ed0548ae-6b7c-4b63-939d-4837877b72a0
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	0f4a256e-e0fa-4bf4-aaf1-11913fe19e72
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	da7ef5e1-eb7e-4876-a2d3-2c1890fe1ac1
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	d4dd3331-39dc-4b37-9817-92fc622d4053
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	eb8996a8-689c-4441-a0d1-a63ea254e400
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	1956078a-7bae-4541-9fb9-0cdc1be594ae
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	a5491c7f-def4-4460-9b73-a674414fcda0
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	96861c4f-e404-43e7-bafd-e77870fc135a
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	06f4bd36-acf4-4dbd-b9d6-c066497a7b98
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	f67aeb37-9071-486f-8e8f-99baf100411d
dd864b28-e9c3-4ae8-bab6-d7b2d5ec9620	26451748-2441-4ea3-aaaf-e5808fc01fc5
\.


--
-- Data for Name: servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servicios (id_servicio, nombre_servicio, created_at, servicio_name) FROM stdin;
10	Apertura Bancos Cuenta Personal	2024-05-23 14:14:28.456329	aperturaBancosCuentaPersonal
47	NS junio 15	2024-06-15 10:25:24.165585	NSjunio15
48	Desarrollo De Software	2024-08-23 17:00:39.940242	DesarrolloDeSoftware
49	Marketing Digital	2024-08-23 17:01:55.591207	MarketingDigital
14	Servicios Profesionales	2024-05-23 14:14:28.456329	ServiciosProfesionales
17	Protección de Patrimonio	2024-05-23 14:14:28.456329	ProteccióndePatrimonio
1	Tipo de Trust	2024-05-23 14:14:28.456329	TipoTrust
2	Registro de Corporación	2024-05-23 14:14:28.456329	registroCorporacion
3	Registro de FIP	2024-05-23 14:14:28.456329	registroFIP
4	Good Standing	2024-05-23 14:14:28.456329	goodStanding
5	Certificate of Incumbency	2024-05-23 14:14:28.456329	certificateIncumbency
6	Contrato de Arrendamiento	2024-05-23 14:14:28.456329	contratoArrendamiento
7	Registro de Corporación Exterior	2024-05-23 14:14:28.456329	registroCorporacionExterior
8	Contratos Comerciales	2024-05-23 14:14:28.456329	contratosComerciales
9	Apertura Cuenta Bancos Corporativa	2024-05-23 14:14:28.456329	aperturaCuentaBancosCorporativa
11	Servicios de Contabilidad	2024-05-23 14:14:28.456329	serviciosContabilidad
12	Servicios de Impuestos	2024-05-23 14:14:28.456329	serviciosImpuestos
13	Servicio de Agente Registrador	2024-05-23 14:14:28.456329	servicioAgenteRegistrador
15	Acuerdo de Socios	2024-05-23 14:14:28.456329	acuerdoDeSocios
16	Protección para Divorcios	2024-05-23 14:14:28.456329	proteccionDivorcios
19	Investigación de Antecedentes	2024-05-23 14:14:28.456329	investigacionAntecedentes
20	Compra Venta de Empresas	2024-05-23 14:14:28.456329	compraVentaEmpresas
21	Visas de Inversionista para USA	2024-05-23 14:14:28.456329	visasInversionistaUSA
22	Planes de Negocios	2024-05-23 14:14:28.456329	planesNegocios
23	Internacionalización de Empresas	2024-05-23 14:14:28.456329	internacionalizacionEmpresas
24	Formas W8	2024-05-23 14:14:28.456329	formasW8
25	Formas W8BEN	2024-05-23 14:14:28.456329	formasW8BEN
26	Formas W9	2024-05-23 14:14:28.456329	formasW9
27	Formas FBAR	2024-05-23 14:14:28.456329	formasFBAR
28	Formas 1050R	2024-05-23 14:14:28.456329	formas1050R
29	Formas 5471/2	2024-05-23 14:14:28.456329	formas5471_2
30	Reporte B12	2024-05-23 14:14:28.456329	reporteB12
31	Reporte B13	2024-05-23 14:14:28.456329	reporteB13
32	Reporte Fincen	2024-05-23 14:14:28.456329	reporteFincen
33	Reporte BOI	2024-05-23 14:14:28.456329	reporteBOI
34	Servicios de Domicilio	2024-05-23 14:14:28.456329	serviciosDomicilio
35	Servicio de Tesorería	2024-05-23 14:14:28.456329	servicioTesoreria
36	Servicio de Nómina	2024-05-23 14:14:28.456329	servicioNomina
37	Control de Inventarios	2024-05-23 14:14:28.456329	controlInventarios
38	Servicios de Facturación	2024-05-23 14:14:28.456329	serviciosFacturacion
39	Servicios Administración Negocios	2024-05-23 14:14:28.456329	serviciosAdministracionNegocios
40	Servicios Legales de Notario	2024-05-23 14:14:28.456329	serviciosLegalesNotario
41	Servicios Legales de Apostille	2024-05-23 14:14:28.456329	serviciosLegalesApostille
42	Servicios Reportes Especiales	2024-05-23 14:14:28.456329	serviciosReportesEspeciales
18	Actas 	2024-05-23 14:14:28.456329	Actas
\.


--
-- Data for Name: servicios_adicionales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.servicios_adicionales (id_servicios_adicionales, servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud) FROM stdin;
22	{"Actas": {"value": "Actas ", "estado": 3}, "formasW9": {"value": "Formas W9", "estado": 3}, "reporteFincen": {"value": "Reporte Fincen", "estado": 3}}	{"campoDinamico[0]": {"value": "UBER", "estado": 3}}	2024-10-17 14:12:49.572067	serazo	11
23	[]	[]	2024-10-17 19:53:19.59618	1	11
25	{"acuerdoDeSocios": {"value": "Acuerdo de Socios", "estado": 0}, "proteccionDivorcios": {"value": "Protección para Divorcios", "estado": 0}, "internacionalizacionEmpresas": {"value": "Internacionalización de Empresas", "estado": 0}}	{"campoDinamico[0]": {"value": "Uber", "estado": 0}, "campoDinamico[1]": {"value": "recogida aeropuerto", "estado": 0}}	2024-10-18 15:11:41.349838	serazo	13
24	{"Actas": {"value": "Actas ", "estado": 0}, "acuerdoDeSocios": {"value": "Acuerdo de Socios", "estado": 0}}	[]	2024-10-17 19:54:51.618053	serazo	12
26	{"investigacionAntecedentes": {"value": "Investigación de Antecedentes", "estado": 3}}	[]	2024-10-22 09:38:30.965167	serazo	14
\.


--
-- Data for Name: sociedad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sociedad (id_sociedad, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen, pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, tipo_visa, direccion_local, telefonos, emails, industria, nombre_negocio_local, ubicacion_negocio_principal, tamano_negocio, contacto_ejecutivo_local, numero_empleados, numero_hijos, razon_consultoria, requiere_registro_corporacion, observaciones, fk_solicitud, createdat) FROM stdin;
55	santiago	erazo ramirez	2024-08-08	soltero	Colombia	Colombia	Colombia	asd	colobmia	asd	calle 48 #101-40	3218332134	serazo31@gmail.com	tecnologia	sjcolusicones it 	cali	mediano	3213123	1	0	cualquiera	si	dfs	189	2024-08-08
58	Eliana	Ortega Caicedo	1989-09-09	soltero	Colombia	Colombia	Colombia	AO123457689	Colombia	B1	calle 100	8765442	serazo31@gmail.com	tecnologia	sjcolusicones it 	cali	mediano	3213123	1	0	cualquiera	si	pruebaaaaaaa	189	2024-08-20
59	Cristina 	Fajardo	2009-02-20	casado	Colombia	Colombia	Colombia	AO00009	Colombia	B1	calle 48 #101-40	3218332134	serazo31@gmail.com	tecnologia	sjcolusicones it 	cali	mediano	3213123	4	0	TRUST	si	Prueba con Sr Jairo y Sra Cristina agosto 20 del 2024	189	2024-08-20
\.


--
-- Data for Name: solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.solicitud (id_solicitud, nombre_cliente, referido_por, necesidad, created_at, servicios, servicios_adicionales, fk_persona) FROM stdin;
13	no va 	Gustavo Bueno	orem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.	2024-10-18	{"acuerdoDeSocios":{"value":"Acuerdo de Socios","estado":3},"proteccionDivorcios":{"value":"Protecci\\u00f3n para Divorcios","estado":3},"internacionalizacionEmpresas":{"value":"Internacionalizaci\\u00f3n de Empresas","estado":3}}	{"campoDinamico[0]": {"value": "Uber", "estado": 3}, "campoDinamico[1]": {"value": "recogida aeropuerto", "estado": 3}}	59
14	no va 	juan carlos chaparro	prueba 22 de 10 de 2024	2024-10-22	{"investigacionAntecedentes":{"value":"Investigaci\\u00f3n de Antecedentes","estado":3}}	[]	59
\.


--
-- Data for Name: terceros; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.terceros (id_terceros, nombre_tercero, create_at, nombre_comercial, tipo_entidad, direccion, ciudad, estado, codigo_postal, tin, firma, fecha) FROM stdin;
1	Breilim Monroy	2024-11-12 07:55:15.776351	\N	\N	\N	\N	\N	\N	\N	\N	\N
2	hector Diaz	2024-11-12 07:56:00.882394	\N	\N	\N	\N	\N	\N	\N	\N	\N
5	Santiago Erazo	2024-11-14 14:18:33.055965	sjk soluciones it 	s_corporation	av 5 #45 o 6	MIAMI	Flrorida	234112	12397481762187	santaigo erazo ramirez	2020-03-31
\.


--
-- Data for Name: tipo_pago; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tipo_pago (id_tipo_pago, tipo_pago) FROM stdin;
1	ss
2	sasdasdsadas
\.


--
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuarios (id_usuario, identificacion, usuario, password, tipo_doc, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo, telefono, id_sede, id_especialidad, id_servicio, rol, id_eps, estado, fecha_creacion, delete_at, usuario_add, update_at, update_by, delete_by) FROM stdin;
f49f0d25-aac5-4b48-a6a4-1cce0f59cb08	11116678	diana0180	$2y$10$DIDsBwlHcFWAAtSLQO.e7ezhHFyhDGJfcmvyX6gu13d3tcUKLs.ye	cedula	Diana	Maria	Castillo	Carela	diana01@gmail.com	3396	10	10	10	Root	10	activo	2024-02-02 00:00:00	2024-02-02 15:34:36.366428	carlos	\N	\N	\N
678f6eb6-6b6b-4ae7-91ba-ab2752d8f2a3	1261111	juan10	$2y$10$fx63b2eO4j/bNSlPBcCzpOKJLujEVjprCVoNteQYtgitUKUMsumYy	cedula	Camilo juan	Camilo	Castillo	Perez	aaabbb@gmail.com	99995555	55	55	55	Root	55	activo	2024-02-05 00:00:00	2024-02-05 17:10:41.827688	carlos	\N	\N	\N
3741aa08-cd06-4bcc-b0ce-a7d9146a66a9	1111	dianaa	$2y$10$eoDPCF.sxu3e0vTwgtu//uUgEr91qdo9XDxGQQXmdb.D4ptW71OMa	cedula	Diana	Maria	Castillo	Carela	diana@gmail.com	33	10	10	10	Root	10	activo	2024-02-02 00:00:00	2024-02-02 15:32:30.53964	carlos	\N	\N	\N
f7762d0f-513d-41d4-98bb-495b1cf2bdc3	1010101012	camilo01	$2y$10$wPtr5/LmDz8I2ULjBXVr0ONoXNj8N6cSxMHwZSwgHuJ.1qaCZVVXi	cedula	Camilo	Juan	Castillo	Perez	camilo01@gmail.com	111111	1	11	1	Root	1	activo	2024-02-08 00:00:00	2024-02-08 11:51:25.996029	carlos	\N	\N	\N
53cef0d5-6470-4a48-984d-1cd03732fae3	7777	m	$2y$10$hIYkg68UUY1bjvUTLXIK9OZO/exPVu3rbZez3/KTdxX9D6a1MYH3e	cedula	M	M	M	M	mmmm@gmail.com	51511	1	1	1	Root	1	Inactivo	2024-02-02 00:00:00	2024-02-09 17:05:29	carlos	\N	\N	carlos
672416a3-aad6-4ef9-9cae-4c6e18b00e58	77777777	t	$2y$10$405R/s1nmNixm/Io4CBFd.W3YicHp6gYxqfYllG1SbqUzRNjPs8Sa	cedula	T	T	T	T	t@gmail.com	66	6	6	6	Root	6	Inactivo	2024-02-02 00:00:00	2024-02-09 17:05:37	carlos	\N	\N	carlos
6869394e-b189-40f3-bc7f-f0f65b38ccbc	10074126119	juanc	$2y$10$IhrQjcaP5HyVQCJyyNlDjeNLd5ngHDDFmPvVrlHf1XdDH6zEE/kSa	cedula	Juan	Miguel	Hernandez	Perea	aaajuanm@gmail.com	3214569874	1	1	1	Root	1	activo	2024-02-09 00:00:00	\N	carlos	\N	\N	\N
ef592b2d-7303-45d3-883a-7ebba92d5195	1007412611	camilo	$2y$10$hCI9/xi3w6Pq2vW7y1PGpuDfOkl8VRZtcX5rqjW01BE/yNkjBE/nG	cedula	Juanp	Camilo	Castiilo	Perez	camilo@gmail.com	3172509264	10	10	10	Digitador	10	activo	2024-02-02 00:00:00	2024-02-02 15:29:31.045803	carlos	\N	\N	\N
434764eb-6ab2-4f4e-a37c-0f2f2f9d7f74	55555	carlosMata	$2y$10$oNeRGeWM9GIUon4O4vjCV.oOGK7WHzLIgw9xZf48MytsaERHGnr1e	Cédula	Carlos	Eduardo	Mata	Lopez	matacarlos@gmail.com	314564365	7	7	7	Root	7	activo	2024-02-02 00:00:00	2024-02-02 15:41:02.051072	carlos	\N	\N	\N
0d45c913-2dd5-45f9-9597-a08793187cbf	1007822	carlos	$2y$10$oNeRGeWM9GIUon4O4vjCV.oOGK7WHzLIgw9xZf48MytsaERHGnr1e	cedula	Carlos	Mm	Mmm	Mmm	mm@gmail.com	51515	1	1	1	Administrador	1	activo	2024-02-02 00:00:00	2024-02-02 15:36:11.588728	carlos	\N	\N	\N
b822fd3c-b24a-4b0d-a1e1-572cbd3266ea	8526698	a	$2y$10$3gWp9VlcJreFMKQ7ZFpn8etx8cajs3Nfc.6TBCO7J2NCem/PVjWOK	cedula	A	A	A	A	aaa@gmail.com	741236	6	6	6	Root	6	activo	2024-02-02 00:00:00	2024-02-02 15:41:50.959177	carlos	2024-03-07 22:18:43	carlos	\N
\.


--
-- Name: archivo_adjunto_id_archivo_adjunto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.archivo_adjunto_id_archivo_adjunto_seq', 46, true);


--
-- Name: bancos_consignaciones_id_banco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bancos_consignaciones_id_banco_seq', 11, true);


--
-- Name: bancos_id_bancos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bancos_id_bancos_seq', 2, true);


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_id_seq', 2, true);


--
-- Name: datos_bancarios_sociedad_id_bancos_sociedad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.datos_bancarios_sociedad_id_bancos_sociedad_seq', 1, true);


--
-- Name: documentos_adjuntos_id_tipo_documento_adjunto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documentos_adjuntos_id_tipo_documento_adjunto_seq', 4, true);


--
-- Name: egresos_sociedad_id_egresos_sociedad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.egresos_sociedad_id_egresos_sociedad_seq', 8, true);


--
-- Name: factura_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.factura_id_seq', 82, true);


--
-- Name: persona_id_persona_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.persona_id_persona_seq', 25, true);


--
-- Name: personas_sociedad_id_personas_sociedad_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.personas_sociedad_id_personas_sociedad_seq', 53, true);


--
-- Name: plantillas_save_html_id_plantillas_save_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.plantillas_save_html_id_plantillas_save_seq', 10, true);


--
-- Name: servicios_adicionales_id_servicios_adicionales_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicios_adicionales_id_servicios_adicionales_seq', 26, true);


--
-- Name: servicios_id_tabla_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.servicios_id_tabla_seq', 49, true);


--
-- Name: sociedad_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sociedad_id_seq', 59, true);


--
-- Name: solicitudes_id_solicitudes_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitudes_id_solicitudes_seq', 14, true);


--
-- Name: terceros_id_terceros_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.terceros_id_terceros_seq', 5, true);


--
-- Name: tipo_pago_id_tipo_pago_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_pago_id_tipo_pago_seq', 2, true);


--
-- Name: archivo_adjunto archivo_adjunto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.archivo_adjunto
    ADD CONSTRAINT archivo_adjunto_pkey PRIMARY KEY (id_archivo_adjunto);


--
-- Name: bancos_consignaciones bancos_consignaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bancos_consignaciones
    ADD CONSTRAINT bancos_consignaciones_pkey PRIMARY KEY (id_banco);


--
-- Name: datos_adicionales clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datos_adicionales
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_datos_adicionales);


--
-- Name: datos_bancarios_sociedad datos_bancarios_sociedad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.datos_bancarios_sociedad
    ADD CONSTRAINT datos_bancarios_sociedad_pkey PRIMARY KEY (id_bancos_sociedad);


--
-- Name: documentos_adjuntos documentos_adjuntos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentos_adjuntos
    ADD CONSTRAINT documentos_adjuntos_pkey PRIMARY KEY (id_tipo_documento_adjunto);


--
-- Name: egresos_sociedad egresos_sociedad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.egresos_sociedad
    ADD CONSTRAINT egresos_sociedad_pkey PRIMARY KEY (id_egresos_sociedad);


--
-- Name: factura factura_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_pkey PRIMARY KEY (id);


--
-- Name: permisos permisos_nombre_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT permisos_nombre_key UNIQUE (nombre);


--
-- Name: permisos permisos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT permisos_pkey PRIMARY KEY (id);


--
-- Name: roles permisos_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT permisos_roles_pkey PRIMARY KEY (id);


--
-- Name: persona persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id_persona);


--
-- Name: personas_sociedad personas_sociedad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.personas_sociedad
    ADD CONSTRAINT personas_sociedad_pkey PRIMARY KEY (id_personas_sociedad);


--
-- Name: usuarios pk_usuarios; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT pk_usuarios PRIMARY KEY (id_usuario);


--
-- Name: plantillas_save_html plantillas_save_html_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.plantillas_save_html
    ADD CONSTRAINT plantillas_save_html_pkey PRIMARY KEY (id_plantillas_save);


--
-- Name: roles roles_rol_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_rol_key UNIQUE (rol);


--
-- Name: servicios_adicionales servicios_adicionales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios_adicionales
    ADD CONSTRAINT servicios_adicionales_pkey PRIMARY KEY (id_servicios_adicionales);


--
-- Name: servicios servicios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id_servicio);


--
-- Name: sociedad sociedad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sociedad
    ADD CONSTRAINT sociedad_pkey PRIMARY KEY (id_sociedad);


--
-- Name: solicitud solicitudes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);


--
-- Name: terceros terceros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.terceros
    ADD CONSTRAINT terceros_pkey PRIMARY KEY (id_terceros);


--
-- Name: tipo_pago tipo_pago_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_pago
    ADD CONSTRAINT tipo_pago_pkey PRIMARY KEY (id_tipo_pago);


--
-- Name: archivo_adjunto fk_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.archivo_adjunto
    ADD CONSTRAINT fk_solicitud FOREIGN KEY (id_solicitud) REFERENCES public.solicitud(id_solicitud) NOT VALID;


--
-- Name: roles_has_permiso roles_has_permiso_id_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles_has_permiso
    ADD CONSTRAINT roles_has_permiso_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

