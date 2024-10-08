PGDMP  1    6    	            |            patrimonium    16.4    16.4 m    S           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            T           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            U           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            V           1262    24576    patrimonium    DATABASE     ~   CREATE DATABASE patrimonium WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Spain.1252';
    DROP DATABASE patrimonium;
                postgres    false            �            1259    24577    archivo_adjunto    TABLE     �   CREATE TABLE public.archivo_adjunto (
    id_archivo_adjunto integer NOT NULL,
    nombre_archivo character varying(200),
    descripcion character varying(64000),
    id_solicitud integer,
    create_at date
);
 #   DROP TABLE public.archivo_adjunto;
       public         heap    postgres    false            �            1259    24582 &   archivo_adjunto_id_archivo_adjunto_seq    SEQUENCE     �   CREATE SEQUENCE public.archivo_adjunto_id_archivo_adjunto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 =   DROP SEQUENCE public.archivo_adjunto_id_archivo_adjunto_seq;
       public          postgres    false    215            W           0    0 &   archivo_adjunto_id_archivo_adjunto_seq    SEQUENCE OWNED BY     q   ALTER SEQUENCE public.archivo_adjunto_id_archivo_adjunto_seq OWNED BY public.archivo_adjunto.id_archivo_adjunto;
          public          postgres    false    216            �            1259    24583    bancos    TABLE     �   CREATE TABLE public.bancos (
    id_banco integer NOT NULL,
    nombre_banco character varying(300),
    tipo_banco character varying(300)
);
    DROP TABLE public.bancos;
       public         heap    postgres    false            �            1259    24588    bancos_consignaciones    TABLE     �  CREATE TABLE public.bancos_consignaciones (
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
 )   DROP TABLE public.bancos_consignaciones;
       public         heap    postgres    false            �            1259    24593 "   bancos_consignaciones_id_banco_seq    SEQUENCE     �   CREATE SEQUENCE public.bancos_consignaciones_id_banco_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 9   DROP SEQUENCE public.bancos_consignaciones_id_banco_seq;
       public          postgres    false    218            X           0    0 "   bancos_consignaciones_id_banco_seq    SEQUENCE OWNED BY     i   ALTER SEQUENCE public.bancos_consignaciones_id_banco_seq OWNED BY public.bancos_consignaciones.id_banco;
          public          postgres    false    219            �            1259    24594    bancos_id_bancos_seq    SEQUENCE     �   CREATE SEQUENCE public.bancos_id_bancos_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.bancos_id_bancos_seq;
       public          postgres    false    217            Y           0    0    bancos_id_bancos_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.bancos_id_bancos_seq OWNED BY public.bancos.id_banco;
          public          postgres    false    220            �            1259    24595    ciudades    TABLE     �   CREATE TABLE public.ciudades (
    id_ciudad integer,
    cod_iso character varying(500),
    ciudad character varying(500),
    estado character varying(500)
);
    DROP TABLE public.ciudades;
       public         heap    postgres    false            �            1259    24735    datos_adicionales    TABLE       CREATE TABLE public.datos_adicionales (
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
 %   DROP TABLE public.datos_adicionales;
       public         heap    postgres    false            �            1259    24734    clientes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.clientes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.clientes_id_seq;
       public          postgres    false    245            Z           0    0    clientes_id_seq    SEQUENCE OWNED BY     ^   ALTER SEQUENCE public.clientes_id_seq OWNED BY public.datos_adicionales.id_datos_adicionales;
          public          postgres    false    244            �            1259    24600    datos_bancarios_sociedad    TABLE     8  CREATE TABLE public.datos_bancarios_sociedad (
    id_bancos_sociedad integer NOT NULL,
    id_banco integer,
    cuenta_banco character varying(300),
    tipo_cuenta character varying(300),
    titular_cuenta character varying(300),
    fecha_de_creacion character varying(300),
    usuario_creacion integer
);
 ,   DROP TABLE public.datos_bancarios_sociedad;
       public         heap    postgres    false            �            1259    24605 /   datos_bancarios_sociedad_id_bancos_sociedad_seq    SEQUENCE     �   CREATE SEQUENCE public.datos_bancarios_sociedad_id_bancos_sociedad_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 F   DROP SEQUENCE public.datos_bancarios_sociedad_id_bancos_sociedad_seq;
       public          postgres    false    222            [           0    0 /   datos_bancarios_sociedad_id_bancos_sociedad_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.datos_bancarios_sociedad_id_bancos_sociedad_seq OWNED BY public.datos_bancarios_sociedad.id_bancos_sociedad;
          public          postgres    false    223            �            1259    24606    estados    TABLE     �   CREATE TABLE public.estados (
    id_estado integer,
    cod_estado character varying(20),
    estado character varying(500)
);
    DROP TABLE public.estados;
       public         heap    postgres    false            �            1259    24611    factura    TABLE       CREATE TABLE public.factura (
    id integer NOT NULL,
    datos jsonb,
    created_at date,
    id_solicitud integer,
    estado integer,
    ruta_pago character varying(500),
    tipo_consignacion character varying(100),
    nota_pago character varying(2000)
);
    DROP TABLE public.factura;
       public         heap    postgres    false            \           0    0    COLUMN factura.estado    COMMENT     V   COMMENT ON COLUMN public.factura.estado IS '0=facturada, 1=pagada, 2=orden servicio';
          public          postgres    false    225            �            1259    24616    factura_id_seq    SEQUENCE     �   CREATE SEQUENCE public.factura_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.factura_id_seq;
       public          postgres    false    225            ]           0    0    factura_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.factura_id_seq OWNED BY public.factura.id;
          public          postgres    false    226            �            1259    24617    pais    TABLE     �   CREATE TABLE public.pais (
    id_pais integer,
    cod_iso character varying(500),
    pais character varying(500),
    contin character varying(500),
    localizacion character varying(500),
    cod_ita character varying(500)
);
    DROP TABLE public.pais;
       public         heap    postgres    false            �            1259    24622    permisos    TABLE     �   CREATE TABLE public.permisos (
    id uuid NOT NULL,
    nombre character varying NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp without time zone
);
    DROP TABLE public.permisos;
       public         heap    postgres    false            �            1259    24628    persona    TABLE     �  CREATE TABLE public.persona (
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
    DROP TABLE public.persona;
       public         heap    postgres    false            �            1259    24634    persona_id_persona_seq    SEQUENCE     �   CREATE SEQUENCE public.persona_id_persona_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.persona_id_persona_seq;
       public          postgres    false    229            ^           0    0    persona_id_persona_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.persona_id_persona_seq OWNED BY public.persona.id_persona;
          public          postgres    false    230            �            1259    24635    roles    TABLE     =  CREATE TABLE public.roles (
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
    DROP TABLE public.roles;
       public         heap    postgres    false            �            1259    24641    roles_has_permiso    TABLE     b   CREATE TABLE public.roles_has_permiso (
    id_rol uuid NOT NULL,
    id_permiso uuid NOT NULL
);
 %   DROP TABLE public.roles_has_permiso;
       public         heap    postgres    false            �            1259    24644 	   servicios    TABLE     �   CREATE TABLE public.servicios (
    id_servicio integer NOT NULL,
    nombre_servicio character varying(255) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    servicio_name character varying
);
    DROP TABLE public.servicios;
       public         heap    postgres    false            �            1259    24650    servicios_adicionales    TABLE     +  CREATE TABLE public.servicios_adicionales (
    id_servicios_adicionales integer NOT NULL,
    servicios json,
    servicios_adicionales json,
    fecha_creacion timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    usuario_creacion character varying(255),
    fk_solicitud integer NOT NULL
);
 )   DROP TABLE public.servicios_adicionales;
       public         heap    postgres    false            �            1259    24656 2   servicios_adicionales_id_servicios_adicionales_seq    SEQUENCE     �   CREATE SEQUENCE public.servicios_adicionales_id_servicios_adicionales_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 I   DROP SEQUENCE public.servicios_adicionales_id_servicios_adicionales_seq;
       public          postgres    false    234            _           0    0 2   servicios_adicionales_id_servicios_adicionales_seq    SEQUENCE OWNED BY     �   ALTER SEQUENCE public.servicios_adicionales_id_servicios_adicionales_seq OWNED BY public.servicios_adicionales.id_servicios_adicionales;
          public          postgres    false    235            �            1259    24657    servicios_id_tabla_seq    SEQUENCE     �   CREATE SEQUENCE public.servicios_id_tabla_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.servicios_id_tabla_seq;
       public          postgres    false    233            `           0    0    servicios_id_tabla_seq    SEQUENCE OWNED BY     T   ALTER SEQUENCE public.servicios_id_tabla_seq OWNED BY public.servicios.id_servicio;
          public          postgres    false    236            �            1259    24658    sociedad    TABLE       CREATE TABLE public.sociedad (
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
    DROP TABLE public.sociedad;
       public         heap    postgres    false            �            1259    24663    sociedad_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sociedad_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.sociedad_id_seq;
       public          postgres    false    237            a           0    0    sociedad_id_seq    SEQUENCE OWNED BY     L   ALTER SEQUENCE public.sociedad_id_seq OWNED BY public.sociedad.id_sociedad;
          public          postgres    false    238            �            1259    24664 	   solicitud    TABLE     *  CREATE TABLE public.solicitud (
    id_solicitud integer NOT NULL,
    nombre_cliente character varying(300) NOT NULL,
    referido_por character varying(300) NOT NULL,
    necesidad text NOT NULL,
    created_at date,
    servicios json,
    servicios_adicionales jsonb,
    fk_persona integer
);
    DROP TABLE public.solicitud;
       public         heap    postgres    false            �            1259    24669    solicitudes_id_solicitudes_seq    SEQUENCE     �   CREATE SEQUENCE public.solicitudes_id_solicitudes_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 5   DROP SEQUENCE public.solicitudes_id_solicitudes_seq;
       public          postgres    false    239            b           0    0    solicitudes_id_solicitudes_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.solicitudes_id_solicitudes_seq OWNED BY public.solicitud.id_solicitud;
          public          postgres    false    240            �            1259    24670 	   tipo_pago    TABLE     k   CREATE TABLE public.tipo_pago (
    id_tipo_pago integer NOT NULL,
    tipo_pago character varying(200)
);
    DROP TABLE public.tipo_pago;
       public         heap    postgres    false            �            1259    24673    tipo_pago_id_tipo_pago_seq    SEQUENCE     �   CREATE SEQUENCE public.tipo_pago_id_tipo_pago_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 1   DROP SEQUENCE public.tipo_pago_id_tipo_pago_seq;
       public          postgres    false    241            c           0    0    tipo_pago_id_tipo_pago_seq    SEQUENCE OWNED BY     Y   ALTER SEQUENCE public.tipo_pago_id_tipo_pago_seq OWNED BY public.tipo_pago.id_tipo_pago;
          public          postgres    false    242            �            1259    24674    usuarios    TABLE     |  CREATE TABLE public.usuarios (
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
    DROP TABLE public.usuarios;
       public         heap    postgres    false            m           2604    24680 "   archivo_adjunto id_archivo_adjunto    DEFAULT     �   ALTER TABLE ONLY public.archivo_adjunto ALTER COLUMN id_archivo_adjunto SET DEFAULT nextval('public.archivo_adjunto_id_archivo_adjunto_seq'::regclass);
 Q   ALTER TABLE public.archivo_adjunto ALTER COLUMN id_archivo_adjunto DROP DEFAULT;
       public          postgres    false    216    215            n           2604    24681    bancos id_banco    DEFAULT     s   ALTER TABLE ONLY public.bancos ALTER COLUMN id_banco SET DEFAULT nextval('public.bancos_id_bancos_seq'::regclass);
 >   ALTER TABLE public.bancos ALTER COLUMN id_banco DROP DEFAULT;
       public          postgres    false    220    217            o           2604    24682    bancos_consignaciones id_banco    DEFAULT     �   ALTER TABLE ONLY public.bancos_consignaciones ALTER COLUMN id_banco SET DEFAULT nextval('public.bancos_consignaciones_id_banco_seq'::regclass);
 M   ALTER TABLE public.bancos_consignaciones ALTER COLUMN id_banco DROP DEFAULT;
       public          postgres    false    219    218            ~           2604    24738 &   datos_adicionales id_datos_adicionales    DEFAULT     �   ALTER TABLE ONLY public.datos_adicionales ALTER COLUMN id_datos_adicionales SET DEFAULT nextval('public.clientes_id_seq'::regclass);
 U   ALTER TABLE public.datos_adicionales ALTER COLUMN id_datos_adicionales DROP DEFAULT;
       public          postgres    false    244    245    245            p           2604    24683 +   datos_bancarios_sociedad id_bancos_sociedad    DEFAULT     �   ALTER TABLE ONLY public.datos_bancarios_sociedad ALTER COLUMN id_bancos_sociedad SET DEFAULT nextval('public.datos_bancarios_sociedad_id_bancos_sociedad_seq'::regclass);
 Z   ALTER TABLE public.datos_bancarios_sociedad ALTER COLUMN id_bancos_sociedad DROP DEFAULT;
       public          postgres    false    223    222            q           2604    24684 
   factura id    DEFAULT     h   ALTER TABLE ONLY public.factura ALTER COLUMN id SET DEFAULT nextval('public.factura_id_seq'::regclass);
 9   ALTER TABLE public.factura ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    226    225            s           2604    24685    persona id_persona    DEFAULT     x   ALTER TABLE ONLY public.persona ALTER COLUMN id_persona SET DEFAULT nextval('public.persona_id_persona_seq'::regclass);
 A   ALTER TABLE public.persona ALTER COLUMN id_persona DROP DEFAULT;
       public          postgres    false    230    229            v           2604    24686    servicios id_servicio    DEFAULT     {   ALTER TABLE ONLY public.servicios ALTER COLUMN id_servicio SET DEFAULT nextval('public.servicios_id_tabla_seq'::regclass);
 D   ALTER TABLE public.servicios ALTER COLUMN id_servicio DROP DEFAULT;
       public          postgres    false    236    233            x           2604    24687 .   servicios_adicionales id_servicios_adicionales    DEFAULT     �   ALTER TABLE ONLY public.servicios_adicionales ALTER COLUMN id_servicios_adicionales SET DEFAULT nextval('public.servicios_adicionales_id_servicios_adicionales_seq'::regclass);
 ]   ALTER TABLE public.servicios_adicionales ALTER COLUMN id_servicios_adicionales DROP DEFAULT;
       public          postgres    false    235    234            z           2604    24688    sociedad id_sociedad    DEFAULT     s   ALTER TABLE ONLY public.sociedad ALTER COLUMN id_sociedad SET DEFAULT nextval('public.sociedad_id_seq'::regclass);
 C   ALTER TABLE public.sociedad ALTER COLUMN id_sociedad DROP DEFAULT;
       public          postgres    false    238    237            {           2604    24689    solicitud id_solicitud    DEFAULT     �   ALTER TABLE ONLY public.solicitud ALTER COLUMN id_solicitud SET DEFAULT nextval('public.solicitudes_id_solicitudes_seq'::regclass);
 E   ALTER TABLE public.solicitud ALTER COLUMN id_solicitud DROP DEFAULT;
       public          postgres    false    240    239            |           2604    24690    tipo_pago id_tipo_pago    DEFAULT     �   ALTER TABLE ONLY public.tipo_pago ALTER COLUMN id_tipo_pago SET DEFAULT nextval('public.tipo_pago_id_tipo_pago_seq'::regclass);
 E   ALTER TABLE public.tipo_pago ALTER COLUMN id_tipo_pago DROP DEFAULT;
       public          postgres    false    242    241            2          0    24577    archivo_adjunto 
   TABLE DATA           s   COPY public.archivo_adjunto (id_archivo_adjunto, nombre_archivo, descripcion, id_solicitud, create_at) FROM stdin;
    public          postgres    false    215   ��       4          0    24583    bancos 
   TABLE DATA           D   COPY public.bancos (id_banco, nombre_banco, tipo_banco) FROM stdin;
    public          postgres    false    217   8�       5          0    24588    bancos_consignaciones 
   TABLE DATA           �   COPY public.bancos_consignaciones (id_banco, nombre_banco, nombre_cuenta, numero_cuenta, routing_ach, aba, swift, ciudad, sucursal, fecha_ingreso) FROM stdin;
    public          postgres    false    218   }�       8          0    24595    ciudades 
   TABLE DATA           F   COPY public.ciudades (id_ciudad, cod_iso, ciudad, estado) FROM stdin;
    public          postgres    false    221   "�       P          0    24735    datos_adicionales 
   TABLE DATA           6  COPY public.datos_adicionales (id_datos_adicionales, nombre_cliente, sr_numero, date_organization, state_organization, principal_business, managing_members, bank_account, fiscal_year, ein, date_annual_meeting, secretary, treasurer, members, initial_manager, fecha_creacion, fk_solicitud, createat) FROM stdin;
    public          postgres    false    245   �=      9          0    24600    datos_bancarios_sociedad 
   TABLE DATA           �   COPY public.datos_bancarios_sociedad (id_bancos_sociedad, id_banco, cuenta_banco, tipo_cuenta, titular_cuenta, fecha_de_creacion, usuario_creacion) FROM stdin;
    public          postgres    false    222   R>      ;          0    24606    estados 
   TABLE DATA           @   COPY public.estados (id_estado, cod_estado, estado) FROM stdin;
    public          postgres    false    224   �>      <          0    24611    factura 
   TABLE DATA           w   COPY public.factura (id, datos, created_at, id_solicitud, estado, ruta_pago, tipo_consignacion, nota_pago) FROM stdin;
    public          postgres    false    225   �@      >          0    24617    pais 
   TABLE DATA           U   COPY public.pais (id_pais, cod_iso, pais, contin, localizacion, cod_ita) FROM stdin;
    public          postgres    false    227   yA      ?          0    24622    permisos 
   TABLE DATA           F   COPY public.permisos (id, nombre, created_at, updated_at) FROM stdin;
    public          postgres    false    228   |O      @          0    24628    persona 
   TABLE DATA             COPY public.persona (id_persona, nombres, apellidos, cedula, pais, ciudad, cliente, oficina_envia, estadousa, pasaporte_numero, pasaporte_fecha_expedicion, pasaporte_fecha_caducidad, tipo_visa, fecha_expedicion_visa, fecha_caducidad_visa, fecha_creacion, usuario_createat) FROM stdin;
    public          postgres    false    229   �Q      B          0    24635    roles 
   TABLE DATA             COPY public.roles (id, rol, inicio_ruta, entrega_resultados, resultados_entregados, impresion_resultados, laboratorio, vph, integracion_viper, seguimientos, colposcopia, pacientes, informacion, informes, config_general, seguridad, created_at, updated_at) FROM stdin;
    public          postgres    false    231   �T      C          0    24641    roles_has_permiso 
   TABLE DATA           ?   COPY public.roles_has_permiso (id_rol, id_permiso) FROM stdin;
    public          postgres    false    232   �U      D          0    24644 	   servicios 
   TABLE DATA           \   COPY public.servicios (id_servicio, nombre_servicio, created_at, servicio_name) FROM stdin;
    public          postgres    false    233   �W      E          0    24650    servicios_adicionales 
   TABLE DATA           �   COPY public.servicios_adicionales (id_servicios_adicionales, servicios, servicios_adicionales, fecha_creacion, usuario_creacion, fk_solicitud) FROM stdin;
    public          postgres    false    234   ^[      H          0    24658    sociedad 
   TABLE DATA           �  COPY public.sociedad (id_sociedad, nombre, apellido, fecha_nacimiento, estado_civil, pais_origen, pais_residencia_fiscal, pais_domicilio, numero_pasaporte, pais_pasaporte, tipo_visa, direccion_local, telefonos, emails, industria, nombre_negocio_local, ubicacion_negocio_principal, tamano_negocio, contacto_ejecutivo_local, numero_empleados, numero_hijos, razon_consultoria, requiere_registro_corporacion, observaciones, fk_solicitud, createdat) FROM stdin;
    public          postgres    false    237   �\      J          0    24664 	   solicitud 
   TABLE DATA           �   COPY public.solicitud (id_solicitud, nombre_cliente, referido_por, necesidad, created_at, servicios, servicios_adicionales, fk_persona) FROM stdin;
    public          postgres    false    239   +^      L          0    24670 	   tipo_pago 
   TABLE DATA           <   COPY public.tipo_pago (id_tipo_pago, tipo_pago) FROM stdin;
    public          postgres    false    241   _      N          0    24674    usuarios 
   TABLE DATA           4  COPY public.usuarios (id_usuario, identificacion, usuario, password, tipo_doc, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, correo, telefono, id_sede, id_especialidad, id_servicio, rol, id_eps, estado, fecha_creacion, delete_at, usuario_add, update_at, update_by, delete_by) FROM stdin;
    public          postgres    false    243   ?_      d           0    0 &   archivo_adjunto_id_archivo_adjunto_seq    SEQUENCE SET     U   SELECT pg_catalog.setval('public.archivo_adjunto_id_archivo_adjunto_seq', 41, true);
          public          postgres    false    216            e           0    0 "   bancos_consignaciones_id_banco_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.bancos_consignaciones_id_banco_seq', 11, true);
          public          postgres    false    219            f           0    0    bancos_id_bancos_seq    SEQUENCE SET     B   SELECT pg_catalog.setval('public.bancos_id_bancos_seq', 2, true);
          public          postgres    false    220            g           0    0    clientes_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.clientes_id_seq', 2, true);
          public          postgres    false    244            h           0    0 /   datos_bancarios_sociedad_id_bancos_sociedad_seq    SEQUENCE SET     ]   SELECT pg_catalog.setval('public.datos_bancarios_sociedad_id_bancos_sociedad_seq', 1, true);
          public          postgres    false    223            i           0    0    factura_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.factura_id_seq', 76, true);
          public          postgres    false    226            j           0    0    persona_id_persona_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.persona_id_persona_seq', 25, true);
          public          postgres    false    230            k           0    0 2   servicios_adicionales_id_servicios_adicionales_seq    SEQUENCE SET     a   SELECT pg_catalog.setval('public.servicios_adicionales_id_servicios_adicionales_seq', 17, true);
          public          postgres    false    235            l           0    0    servicios_id_tabla_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.servicios_id_tabla_seq', 49, true);
          public          postgres    false    236            m           0    0    sociedad_id_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.sociedad_id_seq', 59, true);
          public          postgres    false    238            n           0    0    solicitudes_id_solicitudes_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('public.solicitudes_id_solicitudes_seq', 7, true);
          public          postgres    false    240            o           0    0    tipo_pago_id_tipo_pago_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('public.tipo_pago_id_tipo_pago_seq', 1, true);
          public          postgres    false    242            �           2606    24692 $   archivo_adjunto archivo_adjunto_pkey 
   CONSTRAINT     r   ALTER TABLE ONLY public.archivo_adjunto
    ADD CONSTRAINT archivo_adjunto_pkey PRIMARY KEY (id_archivo_adjunto);
 N   ALTER TABLE ONLY public.archivo_adjunto DROP CONSTRAINT archivo_adjunto_pkey;
       public            postgres    false    215            �           2606    24694 0   bancos_consignaciones bancos_consignaciones_pkey 
   CONSTRAINT     t   ALTER TABLE ONLY public.bancos_consignaciones
    ADD CONSTRAINT bancos_consignaciones_pkey PRIMARY KEY (id_banco);
 Z   ALTER TABLE ONLY public.bancos_consignaciones DROP CONSTRAINT bancos_consignaciones_pkey;
       public            postgres    false    218            �           2606    24744    datos_adicionales clientes_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY public.datos_adicionales
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id_datos_adicionales);
 I   ALTER TABLE ONLY public.datos_adicionales DROP CONSTRAINT clientes_pkey;
       public            postgres    false    245            �           2606    24696 6   datos_bancarios_sociedad datos_bancarios_sociedad_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.datos_bancarios_sociedad
    ADD CONSTRAINT datos_bancarios_sociedad_pkey PRIMARY KEY (id_bancos_sociedad);
 `   ALTER TABLE ONLY public.datos_bancarios_sociedad DROP CONSTRAINT datos_bancarios_sociedad_pkey;
       public            postgres    false    222            �           2606    24698    factura factura_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.factura
    ADD CONSTRAINT factura_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.factura DROP CONSTRAINT factura_pkey;
       public            postgres    false    225            �           2606    24700    permisos permisos_nombre_key 
   CONSTRAINT     Y   ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT permisos_nombre_key UNIQUE (nombre);
 F   ALTER TABLE ONLY public.permisos DROP CONSTRAINT permisos_nombre_key;
       public            postgres    false    228            �           2606    24702    permisos permisos_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.permisos
    ADD CONSTRAINT permisos_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.permisos DROP CONSTRAINT permisos_pkey;
       public            postgres    false    228            �           2606    24704    roles permisos_roles_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT permisos_roles_pkey PRIMARY KEY (id);
 C   ALTER TABLE ONLY public.roles DROP CONSTRAINT permisos_roles_pkey;
       public            postgres    false    231            �           2606    24706    persona persona_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id_persona);
 >   ALTER TABLE ONLY public.persona DROP CONSTRAINT persona_pkey;
       public            postgres    false    229            �           2606    24708    usuarios pk_usuarios 
   CONSTRAINT     Z   ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT pk_usuarios PRIMARY KEY (id_usuario);
 >   ALTER TABLE ONLY public.usuarios DROP CONSTRAINT pk_usuarios;
       public            postgres    false    243            �           2606    24710    roles roles_rol_key 
   CONSTRAINT     M   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_rol_key UNIQUE (rol);
 =   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_rol_key;
       public            postgres    false    231            �           2606    24712 0   servicios_adicionales servicios_adicionales_pkey 
   CONSTRAINT     �   ALTER TABLE ONLY public.servicios_adicionales
    ADD CONSTRAINT servicios_adicionales_pkey PRIMARY KEY (id_servicios_adicionales);
 Z   ALTER TABLE ONLY public.servicios_adicionales DROP CONSTRAINT servicios_adicionales_pkey;
       public            postgres    false    234            �           2606    24714    servicios servicios_pkey 
   CONSTRAINT     _   ALTER TABLE ONLY public.servicios
    ADD CONSTRAINT servicios_pkey PRIMARY KEY (id_servicio);
 B   ALTER TABLE ONLY public.servicios DROP CONSTRAINT servicios_pkey;
       public            postgres    false    233            �           2606    24716    sociedad sociedad_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.sociedad
    ADD CONSTRAINT sociedad_pkey PRIMARY KEY (id_sociedad);
 @   ALTER TABLE ONLY public.sociedad DROP CONSTRAINT sociedad_pkey;
       public            postgres    false    237            �           2606    24718    solicitud solicitudes_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT solicitudes_pkey PRIMARY KEY (id_solicitud);
 D   ALTER TABLE ONLY public.solicitud DROP CONSTRAINT solicitudes_pkey;
       public            postgres    false    239            �           2606    24720    tipo_pago tipo_pago_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY public.tipo_pago
    ADD CONSTRAINT tipo_pago_pkey PRIMARY KEY (id_tipo_pago);
 B   ALTER TABLE ONLY public.tipo_pago DROP CONSTRAINT tipo_pago_pkey;
       public            postgres    false    241            �           2606    24721    archivo_adjunto fk_solicitud    FK CONSTRAINT     �   ALTER TABLE ONLY public.archivo_adjunto
    ADD CONSTRAINT fk_solicitud FOREIGN KEY (id_solicitud) REFERENCES public.solicitud(id_solicitud) NOT VALID;
 F   ALTER TABLE ONLY public.archivo_adjunto DROP CONSTRAINT fk_solicitud;
       public          postgres    false    239    4762    215            �           2606    24726 /   roles_has_permiso roles_has_permiso_id_rol_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.roles_has_permiso
    ADD CONSTRAINT roles_has_permiso_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.roles(id) ON UPDATE CASCADE ON DELETE CASCADE;
 Y   ALTER TABLE ONLY public.roles_has_permiso DROP CONSTRAINT roles_has_permiso_id_rol_fkey;
       public          postgres    false    4752    232    231            2   t   x�3������,.)�WHIU(N�)MQ(�����
�93�oL<�H$rr��X�Zr[��k֚X����� �3:q���vTp�u�tv�sD�ld����� ��C      4   5   x�3�LI,�,�L�KI�L�/*�/JL����2�LJ�K����M�L���b���� � x      5   �  x���Mo�0���W�iO��G�8G�զ�"@{؋��b��_'Үv��(�&�=�3�	zz�Lg*���J��S�WHzR�l
K�����S�9ET�X��)����)c���h�I܅�x:���T� ��`�94+ }���0F�@���;u(������Ag���.ߵC�!!4
���R�!�P�#���g�L�2��2{�-�_ǠWf��砎��2�ڭ1|EgB:�c�&Kq����0���ED��߱<�� j(�wP;�7iԶ��rή3]qQ�����:������H��4����*���t�<c�2�a[��Z����`�mӍ.$��-��hJ���h\�3E�x��9�����-��HpJ*#Y��9aW�˨/R����ˬx�^�(�L̹?���s���Êk���!Br��iDyc�W�-ƍ|US�BX�%�%�o�3���ޘ�٥�u�wpYa��Ԕ�l�]���K�$f������lEh}�Nip��2�=F�Ȕ��E����}Y���%�t붧F9{�6�2z�9%ww�3W��ևc;���`V��[H��N����F[�)?ڼo�O�wM5$���#h�����n�i�����,��W!�j8"!i���(�kW���w��w:����][      8      x�|}I����Zy
-��/Hj\B"DB���RY��O��f_��sw� �|V�" �Ç�A�ʜ~Vmg������������?��W�2�bu3���o[�J9��4�)Mn~e�^����k�)�y���~�����N���(�hWՈ����)�M}���ړ���6�h+�����)}�鍩���59���q(ץ�*OX��Ci�ߦ��#"�:�G�0zAZ��_�uf]������e?7�~�[3�cg�\�"���|<'�h�o�yiNn�ݔ�]�^@5��>̣��J�6��rE��4ڦ���u�_�:���bs��Ez�Z^��4O3{��/V��ۓ�Wn@��ڞ:�]�D���TT[�~�����$F��v���誚3��s��j�z��S��4�G����;�;r^m:��z�@��OPk׵�����x�/��J��q��%¨�vU��&�C�\���h|���+j��J�c�&zn��η�y;19Q>��56_R)<��]쩳ݲ죯v��Txt�Т�kI%:V��CI`��]�,=F� i��d�GշkHF���]<'��vgA�ڻ}.�Ɲ��O3�bt�����Ρ�>������xW8x2�3�����_�G�ў�{.���җ�#��[R9p���4g2e¿k������fA\&��<��ήI�(C�����܍O�F�<O�+��I#s�fM��6(J�T��A\�����|9���4��kߥ��&���~�w��x+���	�ʱ�z�����k�I���El~m�Un���]t�f������°K��� ���T��5�Ph�l�!��Y�7�6ۗ��	�@�V?��gz^�H/��#�|;YȽ
`M�յT>��|����\�A�	7ij�1��q��*W����G�P��dخ�@�ͯm��z�&u��Rm`�&���m�qwW���	UU#YH�k+��O�.d$mݙ�!u��n�I�vr�PB��^=lg��"����W�u�;�"7qc�T�(��϶#��9���T�e��r6�)(�b
3�|2=;�m��׶l�߫^�D�H=�Acւ~LC����N��5k���2N���@Xrw�6=Y���r����֚��k8�,�eHތ˭�){��gӐ�� �w7���lA��I�E[��sk�!���y��3eT���������3p���O[UmS���O�J��@��ɝR�aRa-^�X�����7pR��d�ĺ��g�\e��Vy�1�lGz�BA�d�����<�� �<����Y?�\���n<߀���1ˇխ2�.#Qu��ȍ�h<���ۈ�p�w�6�,���h=Տ��y�!ܠi�^�����~��m"�~�a'I�3�!�t�l����ĨpG-D|��R'�/�� 2�Aީ��ػUI�``�8�rRoa�[��_�	����n��V�R�7�>}��7Y�C�{��F۝���w�A�}�䗤)uK���
2]C۴#)p�ER�6��4�w�j��ԁ�x ��c�o�;��ٰ��Q��(�\@#��o&wd;P��S�A	#���v�ʧ,*E_!�Pݜ��S��|Ep�f��Qʹt�`X��[�Fy�r�Ȑ�m���\)(]�AwPzC4<LSP�������K��{N�d�{xk}��ɤ��t�_��:�����$Q��R�mK�<rzQQDI�j�~̉��9��u��D(=���Q���?��zV�G;S��A����B~F)R���+ԫ�B�ݜ����S[��m�t��'Ot�S�zz;�n���
��o���[���Ci���#�B\��r�2ӭ�U���oei��n�_�8�`���	U<��X>�����[i�)��!tېg��g�z�rH���F��sg��ţ�@z$��S�!p�n"�Ow�C>�TɌ�Z�]�Mn�9#p?��xFܲ������&R��+��#�Tg��r7��{�'�OK`��oR�[��F���=J����a(��d[���~�0�ҿT�^�^�ߵ9tr�)��0���"�XF��6�y�t �~�9}�/�N��\0��L�<�im���iI��<J!+%�T�۪"B��r��t$B\O����6�ܪͭ����L�{�'�g7<�{�6���`��<�g�QYa���
��*=FQ������V-#Db�L��5M�(��X����)� ?E�O�p�%gu25���[t7��Ha���Q�x&�HP�b��P����;��^�At�~�\�Ah�\@7��F�U;ݡ�0���� &��ş��ߖPM�YP�@HlM2�-��H)�c��q E���?[�r��2�Q�@��u0i��GJt�)a'�j{v Lj)>r:�lb�Šh!{GPaMX?V,���0rm��1�R�n5zW+l�з���#&�U4C8u��j�
S�yl"zQ���F�J��^z ��n���V�1|yl?/�}R�y����b��6��'�k��9��I�4H���ً���yE'tA� ��W"u&a�W��-�/�gF?Z*lm;U��ֶ���
�)�˜��_"jܷ�"|O��bRT��&���^[O�(D�M�H1Sa�՜Z3�s
/!��a*ܥh�0���J�眻z����XH2a�HV�l_ϊ̄���Nb�D�=ͼ��(?P��!�g�*�v홬Q�#�nȒwޅ,��Vՙ�28�1�F���T0o���y6W�ֶ+��bh���z��-��KK����Zd26��Ӯ�Qͷ���	�O-��]��E7�$Nq'm�{��Ƒ$�&��HR{��A�h/Z�٪Z�/r��i1$m�<zь�.�?�ǏH7��ym�	��%Fq^�e��e�8�����[�i�^�:��+m̹�p�D:�uL�VYJ�$#��\���n��w��[��v���8se����p5ܕT�C$�ɥ��S��;y�A-�Za�Ɍ�7!vJ(��4��k�ƔAŻ�w^4��&�Tu˗g^$g�)��m�w½K�c��{����;�.�)�4n����@��\���Tq�����{v'��7h���O훡��Z��^���5���l�q&-�Ta�}�C��v)�fnnk����N�k�2�~�="z�������z6w�k�k/Lu�:s���^�N:�&/�8xw�?�M�u�A�H��7"#r�U����Xv��*Dff\v��K_�4+q��7�1�:��ۊ��l�ª-��PaP��	?(�4�g#z8Lm�g6g޽~���3������9�����7�v��(x�
GE���E� Yn�����!�^�����o����(l%
�����W���YK<��
�����
j;�(� >�y��~�Ag�f�|~�-�F��1j�LT΍�ý���S����7�BΓ�L�&ya�;���f��E&��*�O��P#©�������Ԓ�,%��^SD��������$c>�l�+�<˙�tS��QP(�4���;�c(b���`?�/��n��#Ѩ(w�nf����#$���,�;���ཷ��1��DC��%�T������(�i�sn��If��Q�0=}G�j�C�3��٘D'�U���
���A8�XǬ�w�Y+4h��uVlT^�H�9+��>$���5�	`�,<j��5���m�+�h�s�>�"��/�!��so��u���,�P���oc��:��H��7w��/c�^g4��ۑ� �5�L4̑����s��.�Ќ�C�£d�fGC�8�#Y��it`��5*���f���(�pLC��9���B�&����uB߁�Dà�U��%� �w�=����O�c)j/ڞL8���=�p��rGNB�W����j�C��������Kj������S�|�{��F:�	���1�ќ�ºj�� ν(�F:%B�x8 ~�3��m�>ۅS:;�+�\\�7��,��� /�����r�1m��`�>Ī��O�1����^ƚ�������&W
�� �zX�������n�}���#O/m'!=�E��5�x�����1��b�Lؤ��)��t.C) l�e�j���~r�-��O�C�A-��U�_Dݢ� ����%{oP�����    �S���(�$��(�m.��p$�H9֘�7vH4�9� ҂�{����<:��=�'�s���%[4 b1 *IF�Ѡ�0��/�j���7��3Hc;���+�4�u��⪄���ۂzi��;��/��2�_���egl�y;�o��`�?�9'�Hn���!x��9Sl�`��N$���E�����u8#�@�2�x���0i��G,D��;|`��QYw�����=Y3�e�=���|ظ�BD_�V��~X3���y�*P8Hp(��ԇF�@�=�ϩ�FP���H?Ө��֟4$�@�@��ՊB�x�al�R���.χMS��� L�k@�~��]�wȻ��A�<A�F2���
2n�ۛ��T#��`�?g�Q��B��Q�[�t�D����և0���>��|}��Ͻ��k�a����T�3��%�����,�H�L疹�����6p�/��S����~x2�X�?�Mo���je.�����T�#~om.��S��#1���d^?yi$d���ExcX��	3)p@�g���`$A�￀ySxnO.į��{Z���Z_fL8#��#�}�C`bs\��A�!�Z����G�֩�<d���U˞ͼ��A�#mЈ'8��[�Ζ�H�D�.Xg0�����~CA���d��ՠ!�7���^��2�}�\!>�	�F< �C�3�qxiM}��vc���Լ��S�B��6�xP�	ǰ�{��jt7����ݧ�t�?]�
�A�A�د��S?�P3��O����LML��f�U��`�Mn:�l�>���J�Fj;>ޮk�	<:4��t����? 7'ևp��?Rr��=�u6X;���pZ�-���j�'���J<�쒊���z�:ajRTJr����_N�i������-g����p	��'L�C��Q=}_�^����aN�P_Ёszr� x,ʐs�o���@?��\��wJeT�;�7�L��%L�Bx�$҅�v���T!�2��%Bz?x�i�p�D���j�{��}�M�J��o�<��;���o�7���N��B:��biAH�1��R��4��9�iw*\�(���c&�p��vIݝ�)s�]H�j&V�{�,����
7ھ��".��&߽}z����|(�&XHא�A��nލY:k���o�6P���n}2�)KU��mDR�U��c��M<*��f��b���^e�r�{��A����L�;
r%g^�2i�0ĜZ����%�	���'Uۤ'���������/\9�_�*�hy)}��98�o�M��5�C6£�bA��{պ��fꍍ0�f+���^^����>�����@D�mm�N&ԧ����%%��k�]=}�@F�x�r����_`TKL��1��X����n�2�֔����<#VN�Qj���G�3ɨ)\a�����Ba�fe���|@�U;��d�&'߳y�s�ԗ����`��)G 4������<ɾŒD��=��PfYM-=Hٶ&�)�T/aޭ��/˱w?<޼�O@�� r�+u��+
:^�aB��� !I'�0o���P),k�9R���.������v���݇Yp�������N��K��aA-����_NU<Ƈ���F*�!�s��~I����e��R/[�i�a$�0�ƒW.J��n�)A�aGQV����a�R�R�&F�!ja}*Liy�YD���
��LA��6�Q�����0������ ��F�E�X����YC�F�J/�`d	Kr-_��)��y
d�.\Y����p��x��U����hEq�ԕ�.X]��`�ªr����
�:�`���ļ)�e;����s���,K������v�C2ھ���6����~��{�'��Pyfэf�ۛf�i~;Q��X��L-L�x�!7-s����T�����B��YZa@"x�Ρ�qP�8z�	ʰ��L����Ǩ5�v"�İ�����clPJ�JRo4���E�!�AB�e�v\F���6�Z��x�
�����L�h*�Z@jHL���^�[a8Ӊ7���T��?�_������z�h�"�h���� �����)9��O�/���uW�i7~9�d0�l�]�ճ"&�V��m�O2!�d(.���pT��rX��M2�^�$8.�mY���kG/1y�g���y�����Bj�B;`a�
�Fh}8���!�BM*:0r#�Vc���l��~Q�^��Y��Ĝl��Ѱ:H�o��V�jֈ��6���<+ў�
��m�JS���?$)�m����b+'��B���7�d�m�[~~�Cȭ��ļ4l�<m�����ƒ�äz3Fm�������ʳ��Գ`N�%�>�K�Tͤ���?�L	1��/8�Sm����v��J�B��-�.�u�ک:��Q�����o7���������?U�Sϲ��~�H U7��>��Y�F�}�uQ�;.@h��]��K	������tUd��3�[,����H�B�����>C����	�rH�v_�s<�Y*EP��C���9��}Oa3�!��L���c�;5z��0���$<�0��HPB���y8j?�,zta����Ĉ��c|�u�7��1��|��[�k�s�;n�ׁ=�
}�z=��=�.������56ǽ��+�ǃ�������a��>�!W[�4aʛ��rNp�g�=w�1|z�%��`+&���jAx����ގm��!� 9zw�G{��W���5�J��W�c�2#�A�ٚ(�<��
O<���-N\=��3Qt��~�lP���T�Je]ZN������^��7Fl���K1S�[�l꡴+��M�%Q�� ̲qǤ^�����$���2���U
�(a����-�qf1�[���e�1�p�)�*@��R�&+b��,���V� kp\�mG�@�*X`j�b-D/�#Q�U���y"��հ��X��I [�9:��;�D�Vc��}*ir��K�u1���Lz�8�|(4i˨* ����������K"�P��-�v���_��G%���&R��p�x,�A����5��*���&�� �W҂�j�z�t�]��!
���=�\�x�o=]Y�����
���	p-�M����&(��ӻ��p�����*��P��y]�78��H�Դ��5���G�%����YWx�eO�w���-s�qTm���D�Wm�-7fS��a�:n)\�x)���SAX�4�{���YzH��I�K�V���NNqΠ��~�؈*$#�Yx�e_�3�yD�Xq����+Qds9+�BevuZ$��p�_n��H�s$᜸� �=���h��z���X���"X������v���}(�
4%M1�}ڈ�� �&q��CCtLum�I����w�q��S���2$��:���8j��|B����.� !g6�1!����lo� �gd�y�0��/,igM���(}�~Ks��fR�~z�dڹ��
�HL0����ڴ�\�R`_�u6�#�SWW��$���̏�T��}�,U�E�7�zJ����
������5����LJ<�lͧb�zL�9M}��<�6�ѩ�\=]�`�[�R�#?��Ŷ�%M�a����Q�4��C��㊵��9�Nn��~�X��p½��4=�F1H�$A��3 nn�c
�ÕfEZ��խ8���m#Z���
�z#c�^/`�����T�H��vU,l��~L3����n���D�",�v��X���J7�\��v�8kP�إ@K��T�f�X�?���~O��(�c�Y���qS9A�2�0��p��� ?��n���[NnPjf����1�!q��i����rh�2A���񐩂�^eJEg�Fnq��*���~\�pI�X�;���$CчeS�<�`�(�"��le��-H�J[�8���`*���g���B5	Sp ���,�)�b���5R�|�r$6�#^:��G42�Ku��_#1ݏ�+��	XDVXW�^G}�}�P�]�NR���3���Q�Ep��=�5����a��C/f�F�a�+�P�U�H����;�yK~(�"n�qp�*ت�1w��}0��+��ry<��°��-R�B�jl�K��#3�s��L&FC    �B�T���r*F�~�6)��\��>��Mc-.�73�Ȱ@����38}6Q�3䣮ג�O?Z�p���Z�_�2 �)�J�c��	{�}����Ng��n�]�1S�u�� I����2��=��£LAWg�\H�E�a��Z�\�+Bȇ2�н�44�%!D|�Ę%!j��������v|��"r�w=Z���Q�����Qʅ�oΠT��Q��l�*S���}���d����Ի����"��vjE^g|�R؅����b�Sse�\b�}��:_X�ǵ�/�,#z���2��y��|�$�E/l����w6!����?2�[�|+�g�{�ё9%7_\�E�e~0o\`�l�sQ��MpH�,2�d�T.���,��0c���w�]���� �c>6�mB��̙��g��0h�f��'$(�zL��[�,|\\|��nY�T��L�m���L�֩����kE��3�Zޔ+��i�)�ӱ�N��X�X���{)g�����,D�?!��c]ǹ��G��c���7��v�$t��S9�{eN.���;�b������>��=&�P����{��];��H(��Yk�SH(�b�;��u��np$�O0	��#�,s�VE6��i�S�����^����ZR�o?i�������#���G;bg��f\�h�Ae/?�67���p�M	���HX{�f�m��j<��x/_IN<�����GM=$�'o�C�QT[���<���ɀ��`��q�OU�[;���02�OJ�K��;p�i���Q�����k��ۏx�7�w��5�<P�o�>+;�1��Ӛ>nQ�*�@�7b��h;v<���G�%��Pjk�R�0a��N�f';�g��L&ӹ%G�/PX�|PfU�vV�R
Ll~>�Lč���kH��>��H~�o+�-TV	����k�.�Sۉz���i�'�O��g���c!�\���n�Ʌ9c�%���=�O��l���yR#��a�3L�둩�,+��vዝ�%�m�"�-��<�*�*}ށ���`J�@v��i�����������RX$ǯ��)	�y黕�c�:��'��^��b�
�|UmDr"̸��ଏ��S)��������{��2��5��o:�y�%��[���bj)��7T:��:`0"3(�`��4�5�1|"�s����td��<C��d%ޥV%���O�|G��\Dg�*�|4�
B�i���ҍS�P�;0�F0�z+UN8,d��V���i[�C���;<i+H�ٜ,1�:+LX�X_�=u|���۩�a�1�p�6�+GdfI$��\h/�pb�0�r�yPxڳ�V�\!��0A5���Q�Mj�;<w6<)������i[���*�>��<���"�PQ�l,Ŧf<��z���2��Qa&o��`��7~b-�4�E0H���`(g6[Z��'�b�s��Z�)�>`5(�l�g2�U��B�7����{��*ªպ�[������x ��Ɂ,X�������̃� )ہ;l�n���n�~P��F^��k�p�pǖ��#m�pæ�3����h�I��=cY��O�5�#o�->;lC7��VU�8��Hꀷ����m��Ώz%�ڮy�/�Z�qZ/uz�W8�w�_��
#Kȩ
7x�i!a��I�J�uM��R:�Ŗ��H}u��D��� (���,mƙ&�'6RE��s������|@bP@��;�-`�OT�wv����V*j\�Ɯl�n�by���dt�y}�{#��~�\�e�h��ӹ�*����$I'[�k���0��	m�c��*�#�8�;�b)�;Ru�3%�#��rd��n�ű��>z�F�~F�Q�´��8�� ��o����pJ����Y9��{��q6߿}}��9�|jJ���?��08��D,�|Չ �v���%)g{[Q���C�O�Eh$(-�?�����E�ʦ��k��y�'Raie���p�íg��D���g���0/�l��c��!,;���!L��8��T�����1��C�4���r�?�6U����NL�w���7�A��?(���껑�꼯PX��l�OxiJ��^Zy5��z���x�2��z����sz�n��ԞH��f,D$|��r������b�����fƦ?�?��a.,��Ԙ?�*�޺?w_�j���.��	oN�� P��r�8�#���)|���f��*,��-k�<)�T�0�#�R5�C�h��w��ۺ�|ŘX�\l�j��s}a�?IJ&���2��S6�LVq�9�2��R�u'5��kI%���\�.L�?�D��՚��͍�8���3����@�=�F��0{�7��F������Z�F�[�9�E���^sQ��՜����Q:���ʥ35n�ٍ����jR�#d���mGo��9�I���w�VNx�bI�Z)L��C��BJ��FN�����3Mߪ�Z���l�Cb�+��!���a�.��iy$����-턁?mu���w��e������iKkR[b����غ������v��K�=����	W����,Ǝ՟K;�5J�{��Q�~���]=7/.z/�<�N|F�$�T�4�eh�^�y��eh�^��;�'%��n��z5.{�Z�R�߿���pԛ��������;�x�]���0�t��=���C�O��D�{j?��:>��%?�j�1��y),:�G2��:+v��� �:G=��)<�bi���ʮ�������h���pP?нGX�c��?������OO	Se[�?=#<�f;9�$�p[dj�P��$���L�^���q�n�^c{���{�	����N���w���=���f�-��k�)�]]BJ ������b7���8��ֳo���ƴ�֐�5������tFHcήmx�޿�**>G�4׵}��O�xƶ���C���i�k�ü�2��9�H_���[���$G���G�r��Cu��.�F<�+!�D����j��<eף�Ml|z�~�`����8K����M�0~4�Kt�0y.�F,�ڜN��i������rA���\���5$���_����f���[�8h�R����5�#�'�D=����Q������p�*[�I��\�j���$�䦆�,���c:�Lg�pG�� O_.L�! W������]��4���ޞy���`�]�pB��sF��%�&1@�y��5Oz��I5F�+�Ӈ���H|�,֔�jeS۩�?�|;��BK�~d�����1nc�}H��f0�珜��S��[����.�k����T�	��+G�Ƀ��L�5���~��G޸6W��kCI��a���p�s��TbA|g�|��l_�N��n�	ŃO�l�۰s��Q��cd���z�G7Pf��J�>���r$@B�~�J��ဲ/S=Ɠ{@�x��n����G��0����BT3p��l\�Q�����q�qz��Gy)7_��f>eW�ox�_f<��� ��nJ:�d��H����qs8q�Od�⬍���o��t�ܧ,�ט�b�47s���ПÇ��Fb"�B����8.�s|M*������n0"45nݏ?�q��1��/����l	z�S��^0�!]�u/�/��:���
Nd辄�[G-d9I��	�B:Ra�T�_�����~�!���V.�Đ�1���ED7N�G?�L�Q;ws9��F�X�f�����,Uѫn�B�2�6'1�\�E/��T,��(L�v�ZliT��y��e��גzjk�pD��]o�w#|��A6a#��_�ĝ'�����4�Lا�f⤪����o�4|�7�}J���|5mrS�=ȋ�'vN��|��_�V> -���K��,�UH��6�蔊���.c$XW���q}�;8R�k;�S.����f���lr��t��C飐�%��(�7|T�l���(��Q�(�\AF�T���/��w�!G��'&&­�]}WQ�c���Kz��|p�؝U-Eم�nJ���vޏZ&l�)��ǵ�����������>��uϩOR�����{�်E���Jf�̄*f���k�Ҝf����̳*̴չ�p��#.�[m    b�����M��wF�p��b^(��;�;�t��9�^zP��� a��L�w�`�B'Ɔ��[��>�ݞ G�[3a�4�@5^U6�HτYB?���!'S	���eq�3aـͼ#���{gSM(0-��8�	�����OZ����5��OϩV�"y��5��O�XX�����|�Z��(N�mOi�g�OxV����y�ɔ���?�w��n"��;���*l����Eq���>y���� �m���@2��W<J'ϒ�Q(YDڱР���j	�)&�p��m�.��QY�B��a#� ��\��`�!9V���b��)a��K��ޫ*c��ޮ�j�:Y��*�	���zY�3�e����:�`�y��wV�fp�KP��^�'a� �g%N�
��[�VG�h��*�ڮ�ר�1������q�NĻ3]G������"��ʕ�ɃS,i�6�{�B���(T�f����r�D�E�M-N�Ҩa�L]bR�VJ���);N�,m$�Flyįt^NVܬ�����+.m���]��*<CLi[��q�`p��Łt7L@����4�٭<;v��oTtja�qʳq�G?m�h<Fq2���R�R�3+��N*�.s�(�LDP����8�c�鄗ꆓ���>� w�o�Q�E�%v~������QLU�0��z���p�2�V�0���jrp|9��8��j���R�U�ã�>�U5�'����T�N����^�Q�9t`������/jUO��0�@~펹o$5���?:���l���ӅwZ�rk��+D���o��`�L�,ٴP��Y�'&�|���{I"Lꩤ�ṋ�ed��nz����a1R3��{�F���#6(�������s��� "0~���F|�7�M�������ȕ+��	�Ҥ�ӳa�ka���\�}�^��sR�|e�w- ��6<VA�t<s�����|xR�Hs�Q��-i��l `f1�*ӿ��t�K�)��p��q�݉w�|ae�g�'y-"B�*�l�M���$m&�	�Ά��>�L����a�\?WYC�T�3�Q�����6*�$9��0 v�w� ������1�{�eAGϏ��l��q��{��0�t���`ػ&C��[LDS��3�{��r���v=��ݰ��}`�ou�k,�k��j���H� ��\��ܱD;OcNRge�/)�hX[Vũ�{*���0�'���ͱg�}_�?+li+���G:A^�
�o9��?۔�;��K{�8�:�/�9����3R��yҎ�J೨N2�Hf=�\V?�c�ǉо�{L�Z�;��K2-���nHRq/�&�\M|�L��i��k̷Dƚ��<�w�)�*j��~��cGr�!](��n��m>��a����7>���ԡ��`=Q�
'��Hk�=����/F`Zln1}�wa�Qb��w�������(�sS�� @:�bf�� �Q6��ͼ�o�Tc܂�S�t3�Β�N���'���?�HQ�d*�ʍ��<&�)F
�����Ϣ��M�p���6Ӗl�l#���LH��'?�U"�w��u>y#������|���~LG��������uV�����c�O�sU�W��3��(C����6ʉ��������˧� �эp�7�
9z� 3�I3��^<g��
�]K���M�l�}�CF�B1��
�����R�j�ǭ�j���l�N2uՀo�Qcjg�^�!G��-��E���S���0�y��vީ<��^P��w*�<e�?�����X�v�@I��ش۩᭖}��w�'�;%�U����r3˹��.=�Xb1�'ދ݈�� SN��Xpw/tS�EVh�����Ȏ�!y�%���������dp����L8��Ϲ��Y�G�#�f�ꋎ�yd��sy@�p%]�L�`sB�H�z��]X��\���Ro���R]Ma����)�)�v��7�����]d��̎�'x���s�(T�Ο�ے9�$Lx�^�'�/Z�a��Y����X�_h��(�1\�L�1%������u���FRqH���-g��F��}憯���(ޣ�>\�,F
�#�8l�ߘ��"��  �r���w"W 0���x�>� {���#Z�8b�P�)�8���^�Fs§����i_�lbN�u�ް����+Gf�K9n�9J0���ln�G����Ӫ���`c�_�H�AD*���i	n%�e���7v�A�`n�(�L2���7�P3����bw�ۇ�kJ�Uze�G���)03��-N���b�Wg7�&��P�=rF8�����R3N�%�h��76���2O{LC��5���k�ʩ5$s��*J)��"|O�Dl|�zYn)��$"?UKC������t����"�����I�JI�-Ƴ+�Q�4Gŏ����4��+>�g��'2~ ��;͗�aRĪ�񁵳'hD��{�K��$@~?r|���/8�sW{����vW�Q�]sDπn�m�G��Æ����ÌTcu�.PM9���.d855���򙏒��
1���4�@�,�M��~u"Ѻ�8�ޠ��sQ u����3�(�̋��k����ad�o�s��O[�+TNO�O[�|uth	��t����p)���8�xh 8�}`����޵X߀ǚ)u��(s_�d0�s�A7C��<�:��=�7��C�I�܈��L�\I���b�D8����G]���Y]͍W<�u�|��,|��*(׻�zdȚ�B�UV� ��9�Rð��8� *��X�z�=h|vo1K	kA����CfV�^�a�D�"�F�;p�x�v����+Co�P�Q���X��
�9=�[W��"��\�K���$�R���@�@=˄���&_��tp�X��UR�pZ�(����bƉ�u�H�ms7=O٫�g!'>��N�B��C���ʴ�������#�
�ON~�JC��-�K*|9��e̯�K�nws7͛JTn�U���O'�j&��ɣ��B=�d���1lb�5�1�SaYU>�9�aQs7���ܩ	C��}z��퍬���}��i����]�b%�Oqo[��'�2�yf��VK������l8Olq}\�^9ë�u�{�vK��TRƎ01�.*��hk���T�����0qf������(٤�W����� 4e>Q�~�`�&7m��T�)�$4S"L�<R�����ܰw�'��A�儥�*ܒc��2�;��.U<�1zja)�K�Dm�͜ �'z�¢����m�$��g�b���ze*l�b.�²�w��v�6vaz�*?]{��%���^&m1����@�X�v�^���8CxQ����Dя�.ޥ*a��wYd�"���h�ع�����mЄW���q�.��N���!�� �<����vG/��]�Og�O�t/�۫��D�>	:��=����16O{ՠ1�yC��Apun�-�|��b�f}Ǽ>9k�Þ-{�N����]Z��^%����^��Eq����
 �(?|�b�m�Rm��c�x�=2���P�e<�of�b��}y�Ȍ��a�q�`�:��+�[���_'���{�y�����x��l��ȩ�짊���x�C��:P��8��� �A��n�����r�p��(�8���$J�Xqܗ S��U�!���)��~l7 c�P��!� ��
m�BaG�jL���< (���ִ?��aa);I��4�v%�����#Iꇒ7�t�w<]�|LD&S�����y�Nۖ��O�ƾ'L��M@#����D�i�%����5\� �M\���4-J,۟Δ�{4M�^L�!.2���R��]f�s��
oz�J�
V�N2-k'�	�M�ܲ8aѹu<ú��f��h���_af�,F�U��0C�<a�7�����驗R�}j�8ٚua&<35ſ@�څ���bx�w,��2�V�G'���>?�#�ku«k��s!�v� �Sh���6gT&�*Gr�9�S�ne¨������/�nQ������.�8Q�* J�a��c��0� �U��Z�U�7c6��n�n��7W��_�poކ�ڧ����p���F�    c-m��b��0a�"�m�l�n��6O�
�R��u�S��:,컻�޹Y7 �ZvPY� j	�cUa�'b�J�F8H��d�Վm?լ��4���n�A���.nS�ycQb���&7Ki�n��u_�͙�t+L+J�to4k+����T/%�#�Z�K�w/T�Jb��]�� �Y�ޘ��ݧW7�{��q�x��wI0��mn�p�O'G.��ڳ��J�'�W�	�m��QFk,9�ƼB�*��_�-Ϥu�Uup�z^��7|og[�t'|HI�p<dU�L��oR��f,���ˬ�{aK�Io<�^�2b�Pi��m5��۲���+��.��~�^�X۹����ͩ�+[Zk�b[[�	#?"���u�������:��� =���s1=w��ٗ\�M����L_�Y�����]< ����A�j��Z&n�.ñ�p����n�yaIH+��pT����{9
G�r�ȟ������46o�1U7��6���G����v�+~;nk�E9E�LO��p�4�&�~�Xx���c�mV�"����V���'
q�¤c�
G�Oe�P*ud9�[R��i�rR�X�U"[��N�*�/
�S��?ͅ ��*P��uO��b�1U�A˪w�9|���s�}lI�����*k����c�Ow�r���C���kK�h�=�Bm�d0k�[pTQ7D�������[�(
�`@"#�������>���v��ޑ';��/%x�6v7LV��(4�ł�3��fQ�L�Qh~q]�|���������V���~�E��z������(:��؍���gkf�'V����0��H19Bjj���G|�'hyPO��K�ʹG�X��.�{�#v�d�qxO�8���&�w�SxS�a)1�wm��摙�pR�n�q`�q�����(0�f�բw2��,l�̽T,�@՜&5_-�R ~o�1U�⺒ Ɂ��«x@�m˦**|^��+
���3d�(����8'B�7�'�����~	���Z����D��%/81Q�����?�W�P�[]�d�d��xI!$���Jjs(�����VɄ>KB��;2�� R��l]�_
٩�$^T�Q�M-S��2!+�����*L�qz2�ߘf�X�Bo����:|S
�ôTE�=�ĺ��l��D��D�xnx��Ő�F]`��c#$�����1EY<��B	�"�o�t���"*L�s>h�bp޻�A�#����/ey���1r��,'�!�T���L����:��w^-��KyJ��{
���}`�sF�{�X%Ɖ�e��#?dOݓⵚ��pa<��sPO��'A����c��]S�^�d89�ƨ[�(��a�i HSL�<����k:�@����*�G�9�:/c��Է8����<R� ��0�'�G:Ϧ�����Tb1ި�w��X��*T�O?P�g'
�)���E���X��*;����/�L�����<?
:bd�ZY�%o���u
��cTV��:�Q+�T�����Md��c�M�bK�O�v�(���~Čr9wtR��xVPvlS�6�b���oe���\R����\�'�D�`��3�?�����lA���Ԅ�_�Q���X}��-
�{�|�°�B~L�$)�����r��fY�"}��_/�M�߄�B}8
���|�#U�O����:FJ�mA�����O���d�s�f�+U�O�;m�&�� �z��x�4��s<��=u��z�O�A�M�*�Gp�� ��%��ټŒ�Ջ���#4 /�����i N.G�uHԾ*W������T�5it��_�c�z���S)�|�`������1oj��,�d�&,��<� �1&��e�Ǣ�|T��w��<���1F���&>U��#�s��*���\��{����}�6v��x����v�K\�A��.�K�ہl��+�'#GJ�1nE�d?�|l-��/6	�I|��0��M�"�o���*zS�zK�*c�>o�N@%�������?���J�!�;��M������H*��a��F!߼��� ��z��h�Gl�
�sw�F���E�x��^FLRE�� �Q�t���x��� *��p���)O��-�H�c���b���!������U�����e%+�խ~��
��dNXW�1N�-�����6.�GSE��FS�X�S���GW,�֯\��x/�5"��t�%[��a����/�^�p��Y����t���}���Y z3�W�������f+0��o�3o�g��F���3�"�mlg��R�nI���!�_����7
��پ�e��s��(R�W*��g��8�}��;��/J�`}��Zv�"usj���mz�_�*G���X��7f>/����k^�����#�:.9ɉ��qɫV�Fң�B3oK�CZƷ/z����q�z�^_0��8���,Z�qC�8[]�H���$���/R��F�j.U
�a�_�ޏɗ�54/S|^��{7؝}�/�9	ܛ��̱ܨ{1��"s.��A�����Ǆ}|h��8[��\½?�L�9o�����lV���Oo�NK�e��K���<��|h�[<S 	~������e-d{���[�|�����g
�{L���2}=���<'SDV0K��(�o��0�E�2��$�� 2���Qo}&8(�&Ylo,L2��Ջd��y`k��!�����Zm>{�3qCQ8iU[�f���A��k�lxE�Yc��
��m�y�+�ψ�:�K�8AS�Ȼ{��̏!7��ўL�7��6�2��2K�48̄�1��j5�vB�Hq8����()/ъ&�v��S׽ɣ���G ���e��q���d�0X�34&l�)��W�0��r]��1���a��1��R�X7Y���1���wĞ�B\���aWT$����^���y(�[=e��y�D>1��s{L1x�G��x�Lj��
��f�oz�V�O��S0�R���0���;��[�wG�cW{��ې�OS�:���ߘ,_���S&�akehVm>�I�0����3�BC��3�@Al�r3O>�B�r{r���G!>s��	v��<�����:n3��ȅ��u|~��h/V�B� ��aN��,uu�,��tit��!�s/�F�]߯&� �r ���n��.~E�=1g�K���>/c����Xr҃�����mg���E�aR*� ��	������-���� zA^ѵ}4Nho	�d!���LH�0	�ʍqi[e�i�����x�l��D>�vA�2��4�%�P�	o,	V;"�f�y��[�M�J��S���c�� ��L��ڌ]�ԛ���35�U�7J7��(t;|��OZc�n~.񬘃7*W����t�G=���Q;���>#��~�@`8�î�v��x���M�Vl��Y�/��
38�r���
/0��&�p�ڶ��
$�����Q�Q�g�n}�w����AU��G��1F��T�N A�X#E A����P��~���p�1ۯ]�&�ҋQIإ��1����f@�>|`���?����w¨+�����u��L���N�BV��[sz�������O�-�"�� ���v�&��D��ʐ�:X�ew�����6ް�) ^�n���_vC_�C�X�^Nv���d��ϰ�	7옰+jǣQze�O��7)
X�ϩRHTBa����9F7R}�<��'�<l�Эk	��~��;��޳�LՉ_��@Pm��%�������9g��V�}ܮF�?�V� ҟ����W��b_���Q��;�I�Q�ͷ���b�P����깋�_t� &k�ue�O�x�X�p���`��	oa�8R��b˭P��	z�r=��t�<R��ͧb����r����zͰ�1 _C�h{K@�3_Q�Ў~օ���d��/�k;՞(��l��!�'I��_>&��������؝
9�<F2�+��1���:`���5ؿ��`%��7��,o����6�7v�*x�='�Aj�m͛d�9�'8I����i���E��XΉ��$j��#J�O7�����ob���uh�{ ��؏oz?    Ӈ;l�U�:�mV��Q�Z��_,�Lm���B,�+mh�RK`{�N�M����k�9��m]��eh6�dxaT*�SX��ەOi�#���B�L�Q�|�d���Ft@�|�8 0�%����Ԫ��=e��K[ Q�Lw1-M�Nt-Mxi��J�
�d����`��&׽�fΑ�u/��A��lI�,Ն���#Y��'�p\�T�(C��M���O�'�@˚�l�P�G�>��dB;6�p�יRv�[ҵ�TY��8��R~�jh�d�ː�����u#�ߝ�F,���[����8o ƞ��w�f�u�	���Iw�d�&���;������Fx1�8�n��a+Q2�Egϑ$m?� ��_�MT)�Ŗ->YxA����a�m)(*1S�a/Ր��۟����a����9��V��������x
'ζ��ۃ.pO;#�l�U�������ڍ-^xCB~�o�ƙ����UGv��\�8�
��H�QJ˻�S�}�p�2( (�_�
�$���=������i���w{���1�l$^�[��e��C������ax��qN8���;���������~':[�������o�%u�G�)�ɮ���?p�e��-U�Wr@��O5��1䂐Q����;�"�l0�]c(,*{��h��R����H���-N�c�PA�WR!���L����0[n81��+܏AM&j�P
���G�<�}��B�
w�:�D�#ꥥi�l(��M�j-�`{uQO���w`��
��dL�VK��[���א&$�fO�O��KٱQ0ù �IeY���V��>��}?8�����#�rP`-K(=2!{��娬���G�*l$g�B/�L�l�����P�^��d@;��=R���G���\�L�,�e���\�u>^��z[['�ޤ��l��F�y�o�,�qƤ���\�LMM��D��0h�f�}Dl��$B����w$�}������f+�R�CIh��d��6�^�<�%�ړ,$�ƨz�.�o���	m[5<-���č�{�}�uZ�a������l1�>�ݧoJ�br��ʿǥ��TJwB����/bn�8����oyK�=t=����G��fZr4N/X&��� �d���f�H������9C�X��eK���ͽЇ�`�Fl����X1Y�X׼(_Y1�3~����U]^��|
����Վ��c�6Z`�2mk��.i��-X���q��L{>Y�}�8���ۿ�2Xz��!P�a�-�!��4z�UZ�{�˳�)��䠚����Id�u)3��I:'Cߴ���}�*�6L�LB��hO���z�5�v�Y�ѣ�~l�U
���3��`'�;�Z���>���E������q*��G�ֈuU����0H&�®ZVP)�6F�Y�SG�޼@`�ԛ9٨歒�^"b�L�e;������:�8��K�yq��N"��eQ`�X�^쒀y�u��$��)��{�D�Z��:Q���x�32�5o��~�r��D%�uFb�$�I��#P�E^"Q�΢]jE9��-�N�1�I5k�QV���
%�hc��b8N�� ����ڨ���P/�jٴ�{ճ^+*���޳�@E�&������I��<��B����ꅾμ�z�35P����C$
oЇ��NE9�X�1�b�\[5�I69|�'��ڕ���pE8d]av�y�M������f��8�
R��F%��w�B�gD���o�=��T���+/N�{�8��q�G�(���"���)VI�����Hش��h�zA�1�C��up?EJ��*�@�;�<%��c#����'ƃ�P��r
���o��R�Т�E;��B���Q��{#���=lI�Ԅ9��x�<���T
{x�E@dK��?��D*��z���]�?d�� (�9��}x�(�!
�)"I��ĎPu�<Wg�(�I񘓻uP��PP۲-�\P�3`6�'%T�3�t����^���d�%GzlV<�m���?X�G��޳����V�ӐI�;$�PBp�0�"��)�2Do�+��>LcG8�B C%��>��D�����p���-u�����d�������A�=)��:QX�03�}/l��*�����Z��vE8*9��U86�$�Rq�hAܼ�3U|���8�W��αZ�?��2���^!OsV�REGd��Dݨ^�H_�>U|�`�e�QR�H�MZ�*>pg[7uV�e��f6�� ��\��>'�}�ظ��G����T���c���a`���� �n�ۿ�N�$��\	|��Kߡ6�TiA��S�G������C�,�H�kR��Sa#�:���h���0ZQ9JX�������u
���
]����P�O=�F�?H�@�|�,Ut$Q96e��#�:�`EG�����k�Ȉ|��L4f^X�=[��y9E`FX��̛`RM�S�G-�!��d�REH�o�A���7�M��J/�󇙂�4 &�Hr�
�����M7� �쑴�OSd�n�@B�C⚸�<яIL�/9�Oz���M�zYaN/vG��B����W�y}��o��'�:���L�l|���_[��F/�v��[B�lmu�ĩ�=?q7�vB7�R=��X�r�������=����[�7���е�F��N�&�2���H�%�l����1�������ڎ�F������!�EQ>�8�D�3�GG9r�5���4�qb
���G���Ң���_�1o���T�?�Z,RiT
0X��gi�_��91aا��:��"c!�55~�)id�ǚ����-������eX��U���X�$p�s�bO�'�
;�����]H��A
`M�t�ۭxb���fo���%d�|d��?<Z֫{I�a}�M��I���F6��nA'�����Κ�t��BS��Ɏ�-��;�$bz�E����}oe���s�zJ�SmG�Ў�����0��6|�j�e��}�b�-F��%Ǜ����v����
�S�X�T[2���hLޣ1-�%Yd��� ��'B���'
5�	B��B^���b�i���iz�cS��)��yQ[� 4�C%i`[�GA���*���ROn"����qb\��PY��M�C��V�h���S���Ra��R�ݦj�|���(J�#������0s��^k�����O��Rď��4vNB�{\�P��!�no�6N�Qć�z+�Xn�/�^�M��ӣ[m�V9=-�R-3�[�'#.M�J��C(�Uֲ�JU�.h�D�cD�&��=�~E�D���h틬m�t7S��
z�"d�������w�TRh��ߴ͛�˱��W�������l��[�����T�k-[� ��1R���1��q�_�*��N�]���o�ֻ�E��j�̛��е�d^��s�l�&qة��a�$�%��j����w��F��mI�]��j��Y\�Nm�Ol+w{U�k,���W��6��c��W���]��G1� ��Đ�'yb�i���"*��s��t?>�[�3�F���}���ª2���Y>N�ҝ+x�rz��"o��{�w ��.�r����V0�������,�Uӵ�N�X�1�
�����z��8�A�D R) ��*�+ye���h*w([O�Ɯ�p�t�3��4zA���mr����n@d��Ն��RN�-ʄ䌓�A�@��N�|��L�$m9����[;N�;��mnq��N)8�e���=?��b�*jk�)<=P�\�6�8_�qc�W@'�ݰIE�4i�qw���m�t=0�`���:�;Iͷ}>��u�����|�������蔳�iO������7����3��������[4�'Z2��JE�?����)8L�7�ʟ���T~�C	��/�J�y���VQ=5o�E{#<�}��	Y���C���/Yv\׵�~�G/��U��R��E���$�)�w��>�~�� �����iq�DC��w��DI-�0��oH$}lT���P)x!������?e=��ӛ�|��4�B���󷂝���N�%2U���}����7"I    ����&�8���~g�v��"�Y]��ؘ�`{$������kðna�)z����Ƃۊ��dֺ�q�~�+�5j�/,��)^!a7-�SZ�� H��(Zq����@��w�;uo��"�I?4S��E}Y���<�[� ����@��"���aպr���4M��g�{F|�|��U{qLaU�o�K��m$�l��oe_6�>&��b[����n%(�P��f���GN	�e뿴CW���9���8j�����-��Ư��1s�[�/�b���=��[&7vUSX�T�f0��Y���z�8�]k���$��e	�1|�w	OmP ��՛������RIy1cy//\�����	����ݗ9; ���<l�U�4�zrc����o�<�B1w�.�����Rk�7;p���Z��J��;�2��M1��<��ͭ�L腗�;D�	��R�7\��0P�T��L �`�%���e��%���8�T�P9��8iB^Q;W���IO���:J��ܼ�E@"qa�O��1�T`a�@7 "\[���������2�JD���X���5ԅE7�YC��T�Q�2m���!(5�M��O���cɆ�2�p~I�d�n��`���U�y�a��M�$x���>�/��b�/�x���ˈhR�L~~Q�Iȭ�∀Ҧ���� ��3�;���n�����D6 U�^�[|�Ъubi��tFDK�������� ی�VA�0�e=k�	��.5�[P����h~k����Eox8�M��N��˯T����s���� �IbK����;7HdOv�8@QG	�+ѻt���-S�u��vF)�st=Q������7�ƻ����sx�dL{EOb�so��H�*�[�;�����	�.�V"W�x�xG�^�.f�����n��0�{�b���H���X�� `Q�$rX�2E��n/D;'�M@��LZ��5���{���wBqP�xw��@�p�4�� ���|T���-q��r9(�P���7&��A��X�=��	�~	�h�/> �aƂ�@��O�D���[3��Q���o�;S�\h�ڇ�Q֑��N�)�捫*Cƈ���v0n$G�%�h�Tf��w���P�,����)P�<"V��Y;**�)�Rᨀe\t��N�k^C$�'j��Ĕ1#W���U�|n�����{�2:l�t��iAN{���{��!m�m��8ʛK������ripK�#O9	ب�7\O�.��)��BX�X���J��<�,L�Ѭ'��u�5����}9t�	�I�#Ƶ��ؚ#�۳ w�C�\Z|SHņ�@��,P���B��J����>,sû����r��޻+�z93��q\�������̜�4� ��Y�mzXFt��6!@*1�%���|	�o�+v(�����o��WX������Z�ګ4���?7�����U�_ǀc8��<����[��73c����SN<wT u'^�V�Ҝ�%X'�Ŭh����+��װ�Z�m�l���G��(��~������bB�`Fj�u��D"I{��~���;z#�,6.p|Y��	��.�'����tɊ���]�&��+	t��.z�
	�f�EUq�=�Ǚ8�Y�].�"�@d@`U6��~�7/���S3���1ĕ�����~;�E�"d'D��S��&vB�`kf���A�ص�O�C\�

k�UO�Ԗ`���+<~�Ù�5�޲��L�2�l��M�e;�T"b���_����2��⪫���z��4-��;�].��X���~-������_�jI}B�3�f�o�j�J�}z��G�z����	
�F�j̋�.�C����*4�UkB�pD��ݖ��Tb�vQ�L	P�+{�ZNR!Ɇ�钹R�3xgM�HJ�.jZ�������c�޴�-MĐN��6�"�y����H"t��Sͦ)��Ea7��mi�L?��E��؄����r%��C#���U�ϼ=� �*<�/o^w2HM#��CU����]Ղ �\L�W�"��1��p:tbu�j�������I��K��j�Ӡ*�X��`�x���4*����a��z���E��}�b�a&����a���t�T��oY�D���ظ@��q������16*'~���T��g�7�=���	��S`-�a��-��O�Fr%a6.f��پ�gH���U��9bm^�S
x� ev���
ٿ1Q�͎�\ R�	ݣ#���w�%S�i���ɥ#jS�pv8E\���:�
��~�f�He��}���*U�)HB��
e�<N}CU��L�'��ZϠ�Wmլ�m|�x�#���v���<@�j�b5��~+��<�;�="}p�W��!H:��8���Ɩ�Y��G�uI!}���P�uppK����o��*i{q��p 7I`���7m� ��y��;ٮ�zv�[x��zxA���%�o���}��-|?ݔ�{e{�tŴ���ʉ�ob���ꦧܔ"���n��8>��_��L�����p4�;<��_�������Qai�j�%O9�Kz��iLS����� ﭶ]�Nc�7��Ն隷���i����}ۄX���3�]o�sRq��s�q�����J$��ۃ���_�y��O��	vu���Qތ���a�� )��
rɚ��"	'Mة��;"U��`���ٓ#i�~t� �p�(9o�y����ͱB9��wl�!�f8f5��������W��6f�.~t�r"{����S���|�?�[gˢ/.K�	��@�����KfځX����,���]�`+G^��H��751�1M:R&����HĠ�h����QE5S�ǘ@��������0�+���;~`����O�����l%i��@(�MC��
#=�i��lZ����6�ͽreg�|��{�"�'CMQ~�` �l1���aU���x�Hu+��w�CY���P�5{w�������\�f��^� B�"��ܳQ�j(��
��9��>���_�I�*�`�@6��ÁV�֍;��U���V�E�f��Zv�,}ձdZ�%0F�t��%�<�Z���p*D�M:�3��9O���8j^������E@!�uĩuY�-�O�+\2�,��qۍ]��ʰ��R�|D`a@З�s�J`��$Պp�f��[V���r<�F�YNa�.�你��!�p���\������f��jD��_�w�[���&������N�w�ܵ�(zZ��Zo�"�f�!�|C��g�Gi��(|5G���u����
%w�p��]=,���5
&}!&#n�*'~� Xx	N�ѕ�w�6F�)�!8i>�a�Ύ(�]Z�](;O܈�9�?~.:�	L�6emGKu(�?�i�{�->'��NBi��19�N`��~
8Z\��t2Dkl��	.[���=	w��xP��oii`-rMn�؂���|W�,@�U<�`���m�v��le�82�$"oɥ�p�|.�%1�E�'�8�M:~���$��̎�����س[�˨W�B��2�-=_bE��G$"�o�	x;\`�N� w �����p��'L�	@�g����hѼ ���"_���`�E�hX3��R��xoD�`����d/��������+.���o��W�^`P~�n�Q5��hԾ��L%0�cf2."M��^	Cm6��޺�W� �������˦\��^`Q��!��?�! i-\�u���Hd=�`,�:r��(�n�-�}��"%Hl��K�<
M���HzP���,�-��մ^ Pz���@�2p���2hK�wI��2��f���\���\�a�~��@�_��7��:=��(�V�j�'��Φ7���K�^1�46vI������{p�o����a�h�s}�Cd��Ei{R.}y;2���s���R��	6G�%s��qC9,���AH��oe'.��ĉ�+}S�yb��M��7_2�;�398Q�D�s������%W�	4�n�T�h�����9����'�%�2�!e�p��)qvұ���}W�7iC�    �G�h���z.��p�H=�u�m��I���7����8�af�i79��
p
�G�h1{[OSڂ��,�RP����1����)._V!���ݪ��ƪdƈo�6�	з�48o�����~�@��f�?x{��	��`eM�W��(�zv�Y�o_���0�'�+�Ғܪ��Q7*i��"�����v�R�A���|K�������w��G�-��p�$qY�����M,Ǒې�"Q�B5�P��[rY��=_u�^E�OɣiI�ëYŬ1����/��D
�T	1���'�cw�4_�ve�h��rk�x-�Xt�"�3 X��� Nw�L>'A^��!v]x�(������N�%�@��{bˏcZS�rm��lb���p1H�{�o����<2;����<��j69{X�!W^	of�������R+�k�C�#�8��؁�"��9챹�qh�?p~��%��y��Kk'ν����$r����P��B�Jbt�=≸����y7P��[����K,)p[1��"�� ��dԃ�%9G��d�Pʟ�#��_#T��$�A�*Q��=�PakA��O
���C�s'd�-,ۻπ���y�H}��Me�5��5"��B��+ 1W��x�5��<�$92NL��Z��]�,#n-��dు"w�s"�g}���ap2~v��]r��M3���}�b�n��S6D�B�NQ�R��ɰo���Pd:!��u�pW
e͝��"��Z�׭���t��N�{�6ܯ�V��{�����oS�r�vZo�x{2�_�q�9N�^Fmrj�Y6���@a�mȵ�h��ٟ�o�{�3$�q��
7��<�����3Ա�C�yĥ���6E�/@���2rJ���e��Q�!����/�"H��AF�������yuء5����f��.���S9:Gd��Ӻ�ȻĬ���J�L�;9W�W�(����/�t!^S@憳��i�$.����m�o���x{71��@���1v?-I+$E�?�|��Ҙ	E-�}���%%0Es� ��<K����­� �*Z�?�a���{@�?�����%wv�ſ�P��۫�?�C���Bωa�GsaӘK���ܫ����%n3��Ђ�����:l�/]LN��_��eP����c�����ְ8�V�\7����_�b��CA�4���=p��� 
��V+F�־��U&�r��0Z�ݯ��b�+��,k|xc�oԤ�9��~|g��$�:�w@"� ��R�\z)�(l�"�T���o¨t9{��f���M����!	�E(��A|�[8����9�o�*�q�3b�6���U�����O�@��~~���w�z�<�l�����0�s�{���>�"p�,�� �L`L�q2�����%x��� ��3>�џ������Cu[�m����m��L�>�1	��t6��E��X�U�������﮿k{��ZD$	�Fn�:�L?|@��Q�7�?wY�����S�xs��J:*./�����I���,�[�句���	�A�{��8��>��n��U���C�8ۗ|xC ���Orw�Fr�� b9�sl�%������~0�]��R�p�����>�Ga�Oa������N�e���$~ ��bE7l�,"d����Ǿ?i�:6��ط���ç|E��~"��.�����D�5|���Ex�n�.�r�tt?�A)c9]��}�@����wT���x86�ռId�%>���I�ot x�9ꯈ8|�u }�`����TD��v��w<!���\s;3=~��,�]�@$��돾�ɜ�|@���Q��W���-W�����-�I͏��
�ϡ})E��~L��Wck����;������'�p#����.0=�?q�������x
����a�>��M��G�I�{n��I9��~�Χ�D����+r�)g#���qV���=,d\�T��y���0{{+\���\ߛW��p���:�W�;@�Ǚ9��"?}']��H���D����b�;M8����\���1,��}�e2}�_����J
N����B��eֹh"�����^�C5ӊS禷�|͠%���P�@�,��8�u�ĀM��&�����4x�#��d�_��r1}�{\�Xt��x�����)|q����k���4�D�=T���$���e��'�����~��	�Z[����4W<��ZK�g��\�}殟 ��H��t�*"�H�*S���W�;�Ͳ ���K��k�/��Ђ������I�T�(�����XO�D$�F�f�g�|��	̪`��]��LU��y�����T��oD��D�@βm��pW�g��*W��Y�7�cd��Çۇ��J�}���3U.���Ѩr޳_�s1�Է-��ؙ�3�+PC�:��.�Y��	�E5�Fq���HTo\?8T���k�� �|�T�4f/����<����l��8	&�C�Am,,���7�i���Ҷ�垶��p��Ez��x�H�~!��uo�C͓�Z�P��
{wi�W�:7S@с����Zi��Ց�����$u��O�=�.��b�I�R���n3�r�W� a��[��f�C���%� �>/�MP�ǀ4�-�f&0ɭi�at�O�&D�u��7���aB踹�L 2��c��8p��]�=`P�A�(�:ѿ&�J@rm�����~��/�H���������\�6`r�a�V @��'�~�	����HS[U9��q�`�"=-�5כT�0����s�Q����N�j�U[��H��������$��VS���+iM�r�_/f`'�)��Ŀ���	����*b�N�su}�:Es���FφW	L,N�N�DXk�=�	�F�w���N ��
;��$�մf`|�qe���¦{	�ݗ���^oky/л���)>.ɽ�oh�}����L(^%���������;}�I��ܜ/����t؋�S��S�� ��=#�R��I� ��1�i���3^ӻ��!:��p�8��ꉎ���Oз��P��BD�C�OF�[m�_�iH�o&&xt�8Ne��1�,'v-���'�.\��j�8k����c��n_���9p&�0�޼4��!d��̓eO�ң��#��%���a�Y����
n+SRE_�Q8`��r���\�u��H(g��lx���ؤ��y*�%�A��iE%�H����ΐ;�۸������������̋!%0��U޳^/��L+ױ6���/nz�����D���-s]�ܟIn���+�qܩI�t%f*(
B�^3�;���ʝ\���[��}��w���It�ʪ�n�4>�%�I�h�\ӁK�?��Cy��6�����{�m�*6�圻��|D2�L>
W���{��Ɩ�(��$�R⁹�x���âs��	
,�YZqe��I��i(�ч��K� @6Ϋ(M�B6��F��FK�����hMp"�Z\io,<fɺ�2@�'�=����2,�'V��"@&���7��L���Ţ��N�P��p�)�E>�@6A�`s��R	�D��կ[ pſK�%�{i%o#i�Y�B'�i��7���c
2	�	��K��Psݕ�W��%��-1+��x�$@�U��p�-{����O�$�.z���ٌ���z(a7�̜�h|G��a9�-��x뛔<����{؅� o\�n�V��s�鄇Ua�6�%�0�������/X��,���[ e?�u���&	c4��{8�)q�4�F�}uvM�W���	�wn%	���>P���=���4n؅�<���Zj?�sǦ/vUI�� ���0tՠ���	�
��!�y�G�z���܃��p����Y�}�?�$p]�5Ww��)^\�#lGx���hJ:w3 d���`@x�Gx��0he�;&�L �)���*����ZP��#�yXm��L�"$�<�9�˄�*�s;1ū�lLaNt��+����}�k?�G�䥀i    $�߰�v��������A�8��;������ucd��=���WH@*G�)�b}B�}��[����M	�� p��?��9��a+��\������������-�
�_��\��/��4��u�	A:����I������X�m_�����l:`߾�!֞Q��A"���r�υ��AC�/�$�÷�4��j�t��e���-�.$p�&�m��/J"���Qb�k7��"�1|a0x-�:�p���i�m����В&��C�j�G7(j��A�G���!�#4�p��	��)h<_��eq����	�	����[85)Ŧ꼘�a1H���7���G��`#���bj�@T��hX������m�$xɜ�!��>4�qT�G��Sf��Q�BȎ-��ue~�P��Q_���Pa!��1m��x&�G����]�)��K)UC�$b�B�:qX&%Q'P�*��7^vRVI��Gx���K0;�w���9�{ʾ��I�^uR*AN��E`qs)��\�&&��)̔p�6S퓀��;v+�H)��+.��a�BՓq�)ml�|��vCB9"���z�����Z�q.$W<�[�<�r{C6��,?�x��0�޳r\�y�e���bB��%� ���}�ϧ�|�ɮ�ͼN���a�K�����15p��_�"��E!�L]�6w[Ր���c-n���0�$�_;���5Bk��e��8��Z]����J���9��@�������5;8���Oj�J��@�����:鯞7AX�]{��"*�DY�x��XML��!f�ʔ��+#
�[�t7��pi�4�'ZQ��>U,�#4�1^��l����B{--��)�ki��sI��)B��p��<l*I��ō����0�i©/V���9Y �ʩ��~�	Y$�
۠�h��(��"eU8_!���P��i;w��9Ǝ9��&�Tj���5c�)psR>�1�CUwķE�"*qۼ��*���(�k��J�@$iŐ�2T�0���k9��UX%lz8A��3�W+��	$���( m��#ȭ%��ε�y� �Bx*-��I�x$u*'/��'�}.P1�A�@��,H��ۼ<--ކ�>��TU����R��� Nf*��+�Đq/"��I�`��2 Y�>�*#�a�NO��οd��>������X\ہ��Kتp��1
���+��(rg��PW�%D5S�XdR��<��P������A?S�+�GelV����yꏝ�u�r��G�>���X�)�͕:�X�� �L�{Vr�����:{�Rh�sa!;$��wvLE�L�h�w2�"�f��r?�[E�kc^��Q5�T���e��P}���}�.&�����6�2����5�bɨ<ݖ����T�H�{ԧ[������-�|MB����Sm%�t Y�J�'��26A���y|*`���"�ʰ�-�bl$�K�jaD4H���(}���tB�A��T�BLq�2�cиT+�;S��W6��LE���94�U�].��9SA�����bh��4�h��d���ధ$�����zI��*���7S����$�R��t���IKXb�
׹��QN�P�z�\�6�3�|`P*X���D��;�����ӳ�������4꒙Jռ��"����t�T���IW#T��q�7g.T�R7Y����${��q��d��'��^<B��c[T��ז�neA�g[�5n� �Ӛ�לl��ׁ�L�)LۚVcX�� ��1��}k'��K~�u�1�F��l��+|\�o����D;-k¾��I������a�)fWT)����2��l7jU�M|#h�Fc�D��e�$���Y���oӯ�U����On�e����9Р�[y���k/_p3�~���C�XBo�����_21[�����2+��� �3�0�`Oѭ\[���܏�񯘻�\n���h�ElC+����*����W	��	O`��K[�����C�4�x�x��d����\%��>���\��8�B\���@�	��$#]�!�G��j>�M_��>�����/vx���:��9���%(�,�6D�p�\8����g���C�H׸�\�����^=�e�$�Ie������VN�/'u��,I���W�i�_�_K�y��FwE�Z��'a��
�p�Rnr�
tk��+�M���	��Q���&_U��ބ'�p._r�s���y�,��,$�b����Ѭ��tH�TҖ7{!�=,?��gn2��tQx�m�a��ة��zѫ�>�_�A˚i4���l��$�W��Í�"���#�I|#'K���YdgoQA�c�i0����9�-�3�׸h*� s8 [W�0��"��J(������6­��ue��~���_�=c�VRWs�$Q��yW��&I��\rVu�R�cF��ѫU�iH��0P��(��?^F�o;@煟���^R^K��J:�������'�)�K]�����}uc%����jF2����~|�6��Gvk�|t����&�nQ��uX@Iz���L3�9��$����qx�M�u��R :1�X Us'�FVaz������^�����/_�>�����A�鵛��V�!/�N&FB�B75.��l������+>wB��:���Y�d��k�N�p"tY� �H��I��G:z�E7zf��*^A�eӚj&�8)�ȶ� �N0����HHy)��|���	� �&��ѐ���#���)�dU�aG+3�	���9��<� S��ƴ�3ҿ�1��w�M�0��To�����/؂��ҸGX��
��ح�c0%Z�����X)E(n����*�س'6ڷ������)t�x��up!~�!�x��94��X���+�ݵvux��
�9p>�íߜ$�s�!�ҭ� RO�����Mx��D�m��IB�'}oM	��$M�*3�'c9�z]��Xds#���R4;(�'������_ig��O��\q?��s��[�/��̽ʶip�Lj�`|�	I�\8G��ލ��$;���G�x�nV߄��ۅ'�n3TW|��q|Oy]D��|�h�;�

z�rO��S������?�����D�~�7n�:x�oܷ�p�N�P���a�9v�j�qߛ�nl����� ���r�o��i��o}����7E�#���o�����Ά4]o���à~�L��ʽ�h�C���:�V��&&�ǈ�c����w_8��_�s�Fz�C�$����=��,��S�[�=�垲O���m8��{�@s�-u�5y2rSvA��ω�IFh4d&8�OFg�.�B��)���X��9"E��;}�Yp�a����	��^�/Z�bp~�ɰa��*�)�k�W�K2ֲy���'�RdcS�8�mb�d����/h�\[hd�i)��N�W�;|g$/'������/��q�ۣ��)�&0�2�>`#���KҸ�La̄y�Y�ep��d�y0�ܭ9��ǁ�w�7�i����`P��(@:'a�RC�L��u^�6�?�x�d�m
H�,B�s
62�H,�������cor8��'�e���k��d��	�n�F1��
��9O.)]��Ĥ�m�,��U��.��s�0}�F�(����F���������,Ƚ.n��ꀝ\��2:��7�l�)X��
��(��~a���	�5:/ă9i�a�[&���{"`�/,_8GEf
Oؽ���nbc'�kǰI��%wM��q�5ۤT� #��&=<q��jbl����?�n��J�8�@I��\:���$�_<V߾3�~�1��g�~�K�P�'o[T��l�)�wy��F�!*/��	��'��wt\��ȹ�U3O�`Y����Y$�9 ����f���Rϐm�|P�� <�Ƈ���M^��#��$��2ɰ���������c�d���]�m�Ů���J�ib�I<L0d2��_H��#�z4b�!�T^�u���6����V�Ã׉��e    �����	�~z�0RP��e|p��|D�S��T�\���cK=d~��fg81�~ʕ����j��!F�[-2�����!+����"J�"���AN��8����	���c+����t�˯��a����8WZ���.�趗����0q~"֔q����o���;Pƴ˿�z�+`V&�[D�}�my`;�|�{Y쩇��1/Gq��%���ŷ�����őqv�b���ճ�v~`��Ce�)���Un(w}x�Ś�E �侅��NF��w��A�g��F�>�2h�(.:{�[��w�'���qr�O<r]7 �K�GB������$I`@Y�~ᇆ���'��$C������T���裘0��d���?����C}�r!f�8P�b
�Kj�-U\��*qE�3�D���CI"�����mA�8۶�e�dˀ�� w*@�?!d/D��^i��?A�/�f�����©f1�����S|��qw};�hیl�8u?Q`+�sB1�I>Wkij�~��{�c��� �x������P��$=.��[��Ps �l��/�����3u'�"$@(c�����-�%2�c=�~S?����N{c�O��N�Ӳ�@�'���_O�c'@�,_z|�N`��}!��i����x�V�2���RWmX{v���0�� ÿ�N��r���lm-@�6�l���4�0�3�t�8ԝ;�fi	2�
���c��]�7����˔�4���c興�4*�c�)R�*�0��!ה5B�H�ft>�H�v4��JJW�0��[���6NW ���R�~5J+�)�7��!���Ľ\�DN��V���A`���ĩ)�&������yآtIeD���.ij\��B0zH�c��.+��Ry��pvkV�a�oxo�;"�eCO���S��r-��BD�I�af1��QaKv��>sQw����߆��Y��`x�d[%��Gs�(��2מɸ���Z�3����~�.����̥&v�8��F����d��m#�ʲ�Kd��xe2t�HF�q��7��sy[�E��``����6O�IX=ѳn��ks<#-��I��qdw�({��W�t#�Ko/��}������C�5Ҧ0�9Op��V �!� ���c(�8$�v�]�t�t3�d���Ʌ^E�W���Z?Q�`�ݝԮ�� !��p��	��b�0��C	x����Ӓ�Ŋ��y�w�&̰~�p���B����ʓ`rw{]A�Tv�>/ ��ir��쮒��>��:4 R0���ap���@@���
��_-n�K��Of
hq�pU�k騀/	N_zl���*�gč|Z�U\L��~�m�3��߸�Bc�=U��e	�t�qzp�;9*�F�)Oc9B�|cZ������z�c��0#�>ҋI@��A�]����Yz:�ni��Z�����WW��@���"�/<��	:ñ	�f��M^�я����2�����������u3t��b��rq, �=fJ�z��`x�Q�vQ�k��,���f�2�"�M� �+������6S�u]�*�RO�$�Q���R:���k��K�����AbdK�v<�Þ��p���"�÷-�N�t)��s�	\r��� ���q���|�,�'��]Sϋ�׎�81ri"�9	P�S�b�O
B"�t�R:	@�}YvC���sR�� ����I ѻKŖ&3�W�K��kX�gŌ7�!�2��^��,na������	�6SWF�z>��d��e�T��eo��Wז���qV�z"��	`�J���� �
�P��$�E��% h|�ç���������RZ�Hc(cG�v��u�3qe���֎��k{s'N:�%_�m�X҄@br0w��/���p)�`�_��<&`��RJr��G�����?��d(yŮ���On��8�6Q�"���+�S�@M\�Y�Eap��#��Ũ_Gh�P�r�l	�:)-� �l#�~ޚ��;�H��W*�1����]���
�<C�����v��FCl��C:�Gx�P��/;d�,�T�M	�9��(����a����ʑ���t�T����ݎ����Q҂����o���<�%�0�[�6��$��D�BJzE3��5��mX#�4���/$k�In!:Kq4S!��Ƽ,�ܫ�?���d*C�����ԧ79^`�.���D���H��LT2�#���u�b΂,���z�1*H��$
�8�RJ�{��r�j�ʔ"�Kz�J��7� ����^�����!������H�hR���:Q��Ŭ�e� l�zkJՐr4��)G�T��f��gd�Y2'
.i� �e*g&>����f����L3�:S	:V����P����\1�?�J�$���ʒM�@�h.�l�KS3U�v�9�S��P%P8j/�7(�Z����LT����n��W�
�9M�U�"�宼���G�X#w�L<�Yk� � ,g��Q�K�E7 ��CѠ�e*��˖�G���<16tz�v������%d�������nz�q���M%I�3�QA���*�:I�M��\#dp�s��(u�7o0��T�Y�]_�ŴNaƺU9��ˊ
;69��M�r鷧n�o�l�b�9/KTL�a��%*��9�./4�/*���x$sU,�K��VP�!�P�u���t�Fή���|sF��2<�@X�RGw/먷e*��[�{[*�R��ʈ�:*�º�Iݲ!��(.��P������t,�e*����c��{*�6`O$mͰQ��(.����5�"P�������!2���q��K|��9R�bG���H�_b�
�L�n�5�B��4����}�_�i�� �?"�V��]�.me~l�d*��_����[�o �u�>�6�.q�*���E*�UY��@�"/ު,{/�L5�����4�2�y�[�gS�|��ȶ����
����nU���V�Q�٪K�	h�-��ʯyI�<�r�N�W6�~$��6�_ĸ�wYr$Y\M]�~Q:gfs/*�+9�:.׭���7p�D�4�p��۰I
�;뼐p�NI)�n����tgg��m{��T��2�c2s*�"laӼﻪ8{g�@C�f���dy�¬nT)�]��`o]�[�:_�*���!R��li�=MS/�� |O�̨(���;���ֹʩ���V\�,����J��k&l��mU�5=V~�����ݗ�3��G����EIy6������vM+�����ك��q��=���ܓ��S�m�*�B2Z �,-lU�m�w�j��,�:�_,�ӝ��4=��fq�H�m���*�;���m��d�T`�o�DY���@l)�����N+���JoU���˂��P�L�bnKf��,U�S��׼=�m�,�QdAp�)9�RQ6�u��gՄ����Vڜ�u��(^q�U��ǰn �.��*�~���ckr{��t6i�Th�Q��=�x8GоEQ�N�ӛŜ��~��mVz�ر�R�Q�JI��w��p[��ۗd�Ѷ! '�T�Yl/A�)ְJ�v�wO��䓯w�c�_9��0x�s���`�\����ʦ����'�C�K'�p�I%0&��'����
{���i'��8��jŷ4'���6}͎zS��nj	�x�o���n�p�`�_\��\pxʾ��b�06>�|!H.�o�ԑ�h�2 il\��͋]ʰ���bE{��E����&C�����&e�WH�^�8cھpi7�
.j��)6;��,��8_�|\Fx'����q�DWRXI@�^3�A����%�L��-������aiJ����Nm9"�b�/�Ǹ@�6w9"�q+�I���&�x���ap1o�q�!�7�fϭO��������lË�W�f��1���q��|�L�Q����n\Nq7q8��^r��ʙv3�\`e`���g���b	z��K?�9������]v��%}b�M���0��^�K� �L`�!�������W���� R  0tVP�K�2�x@4s��o3��"В\~'��v��+��B�OF����&�m4,���mH����a��ch�"⏎r{���>��Cm}�*���
���@d
w��h��1���Z�	\hy�����o�EȌ6A��N�Fl�����a7��!v�~ֹ ����������W�觹���T��w��3o���~	�]ġu���i�����
�!����	��
���zȼ�.>���_k�	ĝa���k����y#�������a�W�q�v�K_X>�G׮�-TYD�Dr� A�{4�V~A�8���=&@�:ؾ��n�,�)�n44��Cнn]96k�K0CGaW����/��]��44G��Xy*�,I&�'�Z��l\�s�	jƹ��N_z��h���	*)�oNTB�(�?���C�P� C�~d��$d�M����#Z���w����8�'��$���|�#�m�]�,7�-df&�B���`ȝ0�+f�&�\:�q:r�`�@0�<x�׊�A��o�����46�&@��`��A�C��].��������'�CU�����|����=b4���9�� ,._�w���;c�P9؉�B8�=�z�/�rp&�OB0�^Oj�5j��|��^(�y��h�_I��zg m�r�ћv=�{��ñ���(��?�s�=�V�Y�.����˯�;I��X�7RQ.���W\I\���sٕ����;+I�Ρ��O�f����6����:����=!�\���p��7GXD*[7��=�i���q�y!���><r6.EЬ�OC��o:�+�'.*X�|+:s�B���mB�_\X���E��Qfxc
�k!_��s�Ų�l�������/��[�����5d�P ��m�˾�$@�W�8(I�{�5��#G��їر��-6�*�y:�cg�Z"P�-����J���[�p+0�I4����w�����6 .H\���?0���dX�,ƶx��q�n�&[���X�t�[Jm[�;l��`j� '�1��[���b���+�N[��7��a��N T��Z���$2�H� ҥ]�	�rR�~.~#zڑ�Nڻ�MS���	p��rͫ��o,W(/C��;K�o��'#^6�۝#B܊E��!	aI��t}�����������7��<-0���L0v: hPo�	SLCk�5�����>@�(��	wQ��Oc�� ���L���m�g��A�_�*9rI�Id�%'�	�1M��#�n��և���1O��		t����ӓhg�`�p�0�IO}r\.9H�E�`�� ��}���lÿ������_��p      P   �   x�}�+�0D���@"���4*+-1�B��
��몕��ifG@�1�����@:0�_	BH�[M�i�7�a.�"�e�����ʻ깶Wme_릗eƹ��C8�/��<c��F�!����1*�>)�2      9   ?   x�3�4�442653�����EE�Ŝ��y%����
�E�U����F�FF&�F\1z\\\ ��;      ;   �  x�M�M��0�׏��	���-9���آI��A/�t�#��J�AQ�[�=��H�瑩��~~��T��1�f�Ԁ�L�WT�Z6&��I��6SL�E��-�T}[��]�yc╓�>&#&��=��1�v�s��?�\aH\ͯ!��C$�@&c��ɝ jt��1wƘ����`�0z-s;n䮘S�%���!��3�Ü})��#Bg^�&֎*��M�z�*A���ҳRU#�Y�f�Ųk��㜄�B~ʝ�ݜ3B�-����Bc*á��3���ev<>��A�������z8�� h���O�ӧ�7�+hx�?��T��Ō�-�n���a�i���8b�g�ј,�}.�����o���;��U�6-���!	�;��̬9"���o�q���|5�T(��������(ӏ}�������"����K��Ӟ#5�lXڗ��\���m����a]��\��8�nF����㍈� ��+      <   �   x�m��n� ���SD���?���ri���1 k%�F���Q߽^�K�
���2��47U��v�S;xdW�D��I�O.�������=s(�f��,W.����$��.d�ż��-�N'��Z@�X��m�~Vgdv�Q�f��3��4���f�G�x�XkD_�]�� rIqa��ߒu��);�X���p�1�<��q���n]���ˡm�_��c�      >   �  x��Z˖�<��O�a���� !�Ѐ.lC�|d�w�'��ku�Xo�Z��Tr���-mI&+�ő�I��YH��.%���Pґ<���fi��C�/-i���(��U�R��Y��{���;����Lzӹ|���H���Gm̛5h�&i
,A�}׫�
���9f�X:��z��@'�S�����],B�U8����NU-���BY�e���ƭ�*�J��;��,ظvW��g��Iz�Z�ղ(���V�V�*�An1H�I�Ju6Kߙɩ3�X���җ�|����b��^��Yܭ��:t^��fǆ�X�P���
鋱zg-V�sX�#�c�o�39u\��4gLG��c��<�ਆ�� V@��X|!���a���$V[**M��G���+�׳S_>Z�vT(�R��F�Z(�,��X���vӺ��!�{�wm������^$	uEp���J�O�WT"I1����_�t��m��H2*(��K=c�����H+�Q"�a���npW�����;~$)�ƳqACCl��H �9���O�Y���8����޾z��O�)���>��aZt"���I���^�@��!!��	�8�wpG��c\�u"hJ��.�H��Xv�A��.�4��A�@�ț�Q�;q?�p�̣H7X�����«~,�.#�_"1l1б��)�HwT�-�]����
����m� ��ْ��w��t��H���Vx5m�[dK#�z�uݕ����J'��J}����Ͽ����>tid>�K-��J�ܬ�\̖Vdk���f	-*e��H�w$�~���T"�1�����]� wl��}��#ϔ�� (�����)��igY:�x�g�֊5`�a<٫�A�*j��X5�1%j�Ŝ#=�C����K<M��X�?@��{��� ����k�8a�r����cwk'��S��T���%4 ��<}��y�,Ob��J�T���"n_)��R��Y�!�
���Qe����m3���*�bvg�oo�ƀ
>Yv# ẢjE��	�~!������N �`s�NT�_�|yJ�Y����w�R��zb�ClRU�|M���{)/�8i�,> ���bU#��{zNȑ���o�X�/�p!M�f[�D�#��,��ut�Al���=!_������,{��_��"�_�a�!6	�MK{iZֺ+��`ߊM�BT��RE|v��&�k��}��SG�͚݉����.}w]�������Ly��ފMN�,X�\K��P]�[K���f_�!��Cs_^]���ر�z�Ư�����#?�^݈�j]�`A��1w��خ��M�S���$T�j�4M7�/e�=��^lS�-[����9��f������9ƴ�b���'��Qr�C_��?� ����Y^L��0���fʎ/�� ys��
�J�ڈ-�
�����M�S����ma��ְދ �w��`{�r=��'����.����A	�h�2S�4��e�؊P��[���-��I���z��b��&�}�ѿ6O�i����xd}ߡ�����5�T�D�E�l`�-5�cA74ERe��HW����[�Z�
=���X�+����AE�*�qnq���`O^��'��(��3�h�Z؂��1�|ؐ���꟯4�?��&LO�ToS�����Y$:���T6��d1SW��}��89D��0>,Tw���Z�Xo���ڲ�i|s�*+j�E��9�jO�P�V2�rjDV)�5��|=�~5w�A����誈#����jϢ�-�j9�L�(�SõV=�7�(w���^0᝚�rZ8�jK�1P;��0�G���Ȏe�ݏ�b�,���*��f�4tV�x2��Z�=%�5%	'V^N�أk�`f���Ly3�KwASB=�=K�導G��T����ɴ���b���@L�19��SC�.֒>�ې	#n�Q�+�,ْ��(8���زG����f=�U�$+K���.!���'n�ʲ�aa�iB����Y���d+��T�!v�e��i�K��+Y�HFb�"�5t�5�>��'�,o>G��Ec��s����ư5�F�ZM?"�"��-ٶb۪�{s
n�4鎬Ѽz�N΀�	���W2@fb����`>΀j	�F�х�d@���-�R:�v����u'.9?G���;���&/����@�]��e�ƻE�e�,|2d�*�"���1t�u�1v�ab ;���Xn��k@6g�)V�X���Ml��!f�	خrȷ�����p\��JC|�QJs�����!"��<9��<b{���^�۷l�}g����=�愒�r�(���4l�T� ���!0hz��edQ3g^p�w�L���Q���,_�=Y�r��Qܘ���l�^���!(r��P8�88������~aaDQ�Qgd������zٲ��`^�s�J�l�=|.�P_B_�Rrq��FJɷ��� ��Χ���;�A�}���{t��I��,�7G���Y�����
+��ӏ�l�k��=|q���Y�T�O����lR꽦~T>t|���N�<��M�K{U��j�1�Pk�X��{~��И��������R�bc! `�W���� 5�{��3�"�7;�!CnY��|���풼�_�G�g5O\��vE��,_ˣ'�{��6!>��ܭ]O�x��P�6%�7��bM���l3�CH�ϕ��1��{[Ӏ�t���|�4����4��(�t�	��vCC�ӠA�p5���t���vPw=�:�3?c�|;��Q��g 50��hhܵ�n�Q�c�A�[��ai8�~9p��\&L�E�s������M�l��lr@'�K��ל�Fu.��a@<�R\���J�����P� 4��A^j���m �� 6\r~>�>\s�{{�f��W�C�F<��yU�w�x������ W�^E���>1z�~�tl '�����P���`Z�,����5՛�v�P�G~���|��,�O~H{~�9_�'�ݩİ��{�_@"�/�P'�2�4քdEa����F��Ǘ?= 
<{�KEe#���ֆ?����_B�-�F�\0졁ގ�GKA~�����bXRh�Ъ���A���V�س%�-���bX�K6�"h��Kb���K!��JF!�V�Z]�����?'E�GǢ���࠙�ϛTӫG�5X����:@�J}�=�
G� ��Jw���<yi�G'KB~g��>��hl=��=���bB�շ���%����LH)o��{w�IJ#JԬ?V#*�h��{�e�q��5���E�ΫG6[N��YJ-�v�G���R��r�����V�СWn>�Rq�{޼<{8�1�;��-�Y�	���(� �Kvt�:hd�Gֻ?�� ��%�>�=+�p���[�K��� M�0���2�3)�0B)����Q�/̸`s�{�C=����n�nG���iR�Eʹ(���4�5K��~9�z�o�n�$�7_��8�6N@;���t���)�Np�tG'$����,��^�t����@�      ?   `  x�m��n�HEc�+�� �X*�h��DMªbl�����Ki���m@P����P�PJ��s &�Ah�&&���E�~��~��%``��/D���ǿO�cH�qf�#�5��rX��r��}�n��Vă�8s )Є�N��"K�%�ZԾ|�������h��A�ȹ!�n�)CUi0qR��U^����(���J�>[����B�����bP�]��m�W���bW5ȭt��#H7�/����!ڷ��#GVL'kH�����6T'�P�Fb%,WG���Y)���f2k�\Cɞ�:UA�h�Ә�� �_�b=A<F���r�H%��s�1ť��!�TW�ӘVE�V�U��w��r4������f�z�����C�W�x^F�2��P����q2� �ѩYV[~c.��/��<Q�2a��͜�������Ǒ��աss���K��:O�:%��Z}dV<~��bR��aϷ3����j�ϴ_Wb��F����i�Ԛ�sf)Z�T��ܼ۟�t��9����z���	���G�L4��=����ϡ���+���������^K�䓙i��������]/W�w������/�&�      @   �  x�͖mn�0�˧�*��>}�����2�Ҵ�ӏ��ڱ���&�cɲ��I���C.B��m×��i��������g�O������!��"�FWk�ڠ��0���"����a��nJ��vA�0 4��4TS��%CNh\�)�w���1^�c���+�gݬkkc5�G�E������`([?|��gi�,9Ⱥq�:;����v��h��~-|�s�s��KĹ�#�=y+�U�f�P[=%v�ȃ)�,(��Ѽ�AYT���|c��`�z�x��~@V2�O�����6j��ڭ��S�y�ڝܙI$
To,�\p��̒q
Pⴤ��.��R����UaY���]Qh(�b��i�;�پn�5wv�SC���`_�T��%�
��b������$��U�ޚ-'˦đ��<y^	��4�k��ck5kbOQ�+�,8.���-�~��X����Fv�S��>�Ƨ'x�^�6�����nu<����w%З¯l�^?�~	0�BG�#	�
������<_��i�C����!��T~� �>��ϟ#�FNY�����Bs{@�é��<� � ��3�pn�� �M&�@��}�o\ٴ��(y:�K�TR��ORi
����B��zU�u���$��m%��������1���DMD|�1T8)�w��V����0�Ր6p�6��n4g|��.��.�y^{�UU��D�      B   �   x����j1�k�S�tؒ����S�Hu�-��Enaoߟ	���>�j�����a%�jZm	znأ�$����[�����#�'��!�3��	�D��"MC�!��]!��%W���˺�r�\<�����~k�ܽh���^m�cjչ^?7ǝ��ͱ�+�ҲB�&�MZ7�A��a��=ͷ��8�{z���rZ��6�h�      C   �  x�����% E�}��#� �l�����_�O��3x���V����r�
���������u�l[��.�%�3M�&���!o|N�$1�N��H�H�\��>.�p�=���U��<��W]׳��rY�H��e�'R����g�I~�G����g ��@k��iġ=Rޱ�X���KZ��㎈˴f����	9*"�G`��KԔf��$�N�tɚD�
p����P�$ѽkղ�I��-=X�|�s^{5s��v��ƷO���u��z6%�fN����v���蹕,��ܤ��f�M��e�LR�ы�ݝ�az��F�VVۭ~`J�`�����~�w���;ӭ�zb0/�������F՛?8y��h8!�Ͻ����XPɝ����;Cy��UZ��UZ��UZ��UZ��UZ��UZ��UZ��Uz��Uz9u��"���kf�*-R�*�t��"��U&�F��6��U5!w��_�Ͽ����?H�T!      D   �  x���߮�6Ư����HH�rNN�Hm6ڜ��T���Dn��I��S��΋u0`@m��rA���<3�����ͅ)g�]���P%''a
�x�1��O~��B��X��e��oК����p���׻��Ш�Y>шPâtEq�2�����7Fg�&;A��R�΍h��F����&X/�!�d=b'Z=�k�Gn~�TW��WY�T�	�D�"ZS�:q�zga2�X���Q�*/Q�U�!����H��U�T�/��iL{̮��C�zo2וϛ��E%�"`�Gq�Ei,��M���c�i��
����p�c�2��Nɹ�*�Z�aW�:��<i�"^
�/䠒��PɟcIu ,��J�K���R~�xxG�"i� ��-*y��Fj��m1�]�ؔ�&L"��_c��úk��N�-����nz�C��^��"���d��1ߢ�� P6t;��(0�YVN4p>v��� �f�t|[Z���A��l�܅I��YW���W���]&A�qWv�͔Q�PZ99еwP�W^��,[�8i����H��0O�-��>�ウ��������r`��$���$.h�����u�?��c��
` c�)�JXӣ�N�AnխX�U�S6s�ɿ����S�Ʀu	��^�f�93�X��X�ϯ�9ʀ-������Z`���8�T*`qQ?�gPV����pE�c�\���A��8�����LG1S�P�A�,(��9h/U"&�@����zs��p� �����s6~�����D���&
m�y�{t��>�Zr����כT�<��RB��o'����mo&1����xX�=O��f�ĕ��wI��lS������L
�ڇ�r�#�{� ���j�m:���A ��m��5N�,�b� ��hs\�Z�b�+¹�\����+����~^ �?����      E   v  x��R=o�0��W f�lc�4�����1�`7�
�!U�{�|�f�*��{w������U�u�M�(�N5�i|�/O��Uޅ.�'��]-�X��gj��z�J�>�,*3ץ,tfVhQG@D���z�
	��$�9�,G��=T�w�ߴlU��
���Ņ;�Uܨ�Ъ��e��ᱨj�H�dL_�:�4b�8��j� #�� ,Ą�(�v��)��rY��Y�L?3H�: ���cs��	#!MI���`�u�ޚ�Z�\��m�� �VZv�����=>#�b��zP����:�]��8���߿�܀�ε�/�?����H0BO�v�1Ď����Lݪ���7{����Ym�)AyQQ�l��u�/P��      H   7  x����N�0���SD�)I�-���q�ⵡ�6������!@��Ȋ�D��/NUA�>�\�};�nZj3��R��� ��C�%<�`j��`���	cŅ�jb$�Zْ��@:T*�e�!�i:Ȯ�9���c�!Qz�e1jt�!�èS*]�	���u ��D�<'Pv��p�9a�kQ,�j�P�����Cw�⊦��X���Z}B*)��g�1�\h/qp[�X?�,*�)R�ԣ�[�ad>-G8��\"a���u
��3�yx\oF�������)��.��?4� ���b���OӢ(�E�      J   �   x��P=O�0��_q��"�P�U�V��P:\l7r��"'a���\\Ȁ���>t��Y�H�� �ҌR�����F����֪W��z��Bl�F�2����֎8��_���peU<.��3ZjHhs��l]��}����V���!0�5���O��;^P��� 0
����c�]�<���K�Q\�v�����d�Vde����Xx���v!b,�Qn@n�\�/Gg������]Q_Aq      L      x�3�,.����� ��      N   -  x��VIv�:;���Me�7�~	�4t9o"K2� &�$���:�ƾhC���y���U�n]b�bh1ZhD%�\S��q0f�DP�΅�PO5D����������m\6�݋��v��p����X����u��"�d�]��Õ������݂�N�:(�y6��:����=�&��( ��wI�mVm��k`�)���s��y�byB󄇄s�e`t:N����n�yl1w<���	�P����`��k �7D����#��&����ui
�Y�zS[��:�YZ�$������0kW���b�_(��p��ov�_��r�[Z�(�NhP~0?���R���T�o�`�H��SJ,��Ji%0r/c@�ZX�(לk��.E���K���u8_.���o�l��-ڃ�T���^qY���Ml�,�
Ԭ�?V���
p���y)�/�c!8�0̫Pd)P2�rP,B&Ƒ5��������At`୕�,W�ײ�۵�e���f#�5F�����^~{��7!zх�N�7����f��8�s�ڎ���i���7$�s���1���/,0b�w8З�7%���`!�ڑ@�L��*����vE���C�W���c3疭΂�ѣ[�\��.{��5����h�}L�8A��|�W��I��F��?C۽�)�x��^�.V@� 5�!A����B�)dw�9�N��$WIh��چ]����˗�?��}��^�5F���?��a�	>΃]l���#�{p�+���
P�ƜED�`�K|�ejke怱�ގ�n��s[�Y����5j�M�b�z�z���r�z�X�뫫��;ƭp�����K�zj�t7��t�^�e\IA?��3	Ꝅ#�w�:ߠp�-@�%@J��pQ��)v�w_IG�**��7�z��]�B��lQ���cٹ{�L��/�.D�W�U�y�i���g?�)Z$0�
{�9ZWq���I�#��*OP)��|��*8u�o{!h"�1����=�l�<v��uv����J�[W�J;��&}:a�,UE���Uoj�SY_es}uW.MS�����k�S��B�6	�ג�'c�/w�} �g����m�ş�@Q�2�B������e�gJ �Ԅ"H
�[UH|���H8Z�v�����㋣���/�d8γt'��/�G(dR�o��DPl�oؘjߺ�9��&�s�Q2�*Oݙ��M���[�x=�J�-�ѣ9i�&����������Z�Q�Y=`�؇/���z#��'�e0�C��r�o �9�y$��D�g�ó�������     