--
-- PostgreSQL database dump
--

\restrict FTuYjWeKrIxU765zm6KAq2yqBKnWFAYxX8LkMCAdyEiW1LNKccj2aVXxPlnmNuq

-- Dumped from database version 17.6
-- Dumped by pg_dump version 17.6

-- Started on 2025-10-04 11:35:42

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

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 217 (class 1259 OID 32795)
-- Name: activity_log; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_log (
    id bigint NOT NULL,
    log_name character varying(125),
    description text NOT NULL,
    subject_type character varying(125),
    subject_id bigint,
    causer_type character varying(125),
    causer_id bigint,
    properties json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    event character varying(125),
    batch_uuid uuid
);


ALTER TABLE public.activity_log OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 32800)
-- Name: activity_log_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_log_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_log_id_seq OWNER TO postgres;

--
-- TOC entry 5176 (class 0 OID 0)
-- Dependencies: 218
-- Name: activity_log_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_log_id_seq OWNED BY public.activity_log.id;


--
-- TOC entry 219 (class 1259 OID 32801)
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(125) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 32806)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(125) NOT NULL,
    owner character varying(125) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 32809)
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categories (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125),
    description text,
    group_name character varying(125),
    image character varying(125),
    meta_title character varying(125),
    meta_description text,
    meta_keyword text,
    "order" integer,
    status character varying(125) DEFAULT 'Active'::character varying NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 32815)
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.categories_id_seq OWNER TO postgres;

--
-- TOC entry 5177 (class 0 OID 0)
-- Dependencies: 222
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- TOC entry 223 (class 1259 OID 32816)
-- Name: client_logos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.client_logos (
    id bigint NOT NULL,
    client_name character varying(125),
    logo character varying(125) NOT NULL,
    website_url character varying(125),
    is_active boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.client_logos OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 32821)
-- Name: client_logos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.client_logos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.client_logos_id_seq OWNER TO postgres;

--
-- TOC entry 5178 (class 0 OID 0)
-- Dependencies: 224
-- Name: client_logos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.client_logos_id_seq OWNED BY public.client_logos.id;


--
-- TOC entry 225 (class 1259 OID 32822)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(125) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 32828)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- TOC entry 5179 (class 0 OID 0)
-- Dependencies: 226
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 227 (class 1259 OID 32829)
-- Name: faqs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.faqs (
    id bigint NOT NULL,
    question character varying(125) NOT NULL,
    question_en character varying(125),
    answer text,
    answer_en text,
    is_active boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.faqs OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 32836)
-- Name: faqs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.faqs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.faqs_id_seq OWNER TO postgres;

--
-- TOC entry 5180 (class 0 OID 0)
-- Dependencies: 228
-- Name: faqs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.faqs_id_seq OWNED BY public.faqs.id;


--
-- TOC entry 229 (class 1259 OID 32837)
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(125) NOT NULL,
    name character varying(125) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 32842)
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(125) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 32847)
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- TOC entry 5181 (class 0 OID 0)
-- Dependencies: 231
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 232 (class 1259 OID 32848)
-- Name: media; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.media (
    id bigint NOT NULL,
    model_type character varying(125) NOT NULL,
    model_id bigint NOT NULL,
    uuid uuid,
    collection_name character varying(125) NOT NULL,
    name character varying(125) NOT NULL,
    file_name character varying(125) NOT NULL,
    mime_type character varying(125),
    disk character varying(125) NOT NULL,
    conversions_disk character varying(125),
    size bigint NOT NULL,
    manipulations json NOT NULL,
    custom_properties json NOT NULL,
    generated_conversions json NOT NULL,
    responsive_images json NOT NULL,
    order_column integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.media OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 32853)
-- Name: media_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.media_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.media_id_seq OWNER TO postgres;

--
-- TOC entry 5182 (class 0 OID 0)
-- Dependencies: 233
-- Name: media_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.media_id_seq OWNED BY public.media.id;


--
-- TOC entry 234 (class 1259 OID 32854)
-- Name: messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.messages (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    email character varying(125) NOT NULL,
    subject character varying(125),
    message text NOT NULL,
    hp character varying(125),
    ip inet,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.messages OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 32859)
-- Name: messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.messages_id_seq OWNER TO postgres;

--
-- TOC entry 5183 (class 0 OID 0)
-- Dependencies: 235
-- Name: messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.messages_id_seq OWNED BY public.messages.id;


--
-- TOC entry 236 (class 1259 OID 32860)
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(125) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 32863)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- TOC entry 5184 (class 0 OID 0)
-- Dependencies: 237
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 238 (class 1259 OID 32864)
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(125) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 32867)
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(125) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 32870)
-- Name: notifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifications (
    id uuid NOT NULL,
    type character varying(125) NOT NULL,
    notifiable_type character varying(125) NOT NULL,
    notifiable_id bigint NOT NULL,
    data text NOT NULL,
    read_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.notifications OWNER TO postgres;

--
-- TOC entry 241 (class 1259 OID 32875)
-- Name: our_works; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.our_works (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125) NOT NULL,
    icon_class character varying(125),
    excerpt text,
    description text,
    featured_on_home boolean DEFAULT false NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.our_works OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 32883)
-- Name: our_works_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.our_works_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.our_works_id_seq OWNER TO postgres;

--
-- TOC entry 5185 (class 0 OID 0)
-- Dependencies: 242
-- Name: our_works_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.our_works_id_seq OWNED BY public.our_works.id;


--
-- TOC entry 243 (class 1259 OID 32884)
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(125) NOT NULL,
    token character varying(125) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- TOC entry 244 (class 1259 OID 32887)
-- Name: permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    guard_name character varying(125) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO postgres;

--
-- TOC entry 245 (class 1259 OID 32890)
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.permissions_id_seq OWNER TO postgres;

--
-- TOC entry 5186 (class 0 OID 0)
-- Dependencies: 245
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- TOC entry 246 (class 1259 OID 32891)
-- Name: portfolios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.portfolios (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125),
    note text,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.portfolios OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 32897)
-- Name: portfolios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.portfolios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.portfolios_id_seq OWNER TO postgres;

--
-- TOC entry 5187 (class 0 OID 0)
-- Dependencies: 247
-- Name: portfolios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.portfolios_id_seq OWNED BY public.portfolios.id;


--
-- TOC entry 248 (class 1259 OID 32898)
-- Name: posts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125),
    intro text,
    content text,
    type character varying(125),
    category_id integer,
    category_name character varying(125),
    is_featured integer,
    image character varying(125),
    meta_title character varying(125),
    meta_keywords text,
    meta_description text,
    meta_og_image character varying(125),
    meta_og_url character varying(125),
    hits integer DEFAULT 0 NOT NULL,
    "order" integer,
    status character varying(125) DEFAULT 'Published'::character varying NOT NULL,
    moderated_by integer,
    moderated_at timestamp(0) without time zone,
    created_by integer,
    created_by_name character varying(125),
    created_by_alias character varying(125),
    updated_by integer,
    deleted_by integer,
    published_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    sort_order integer DEFAULT 0 NOT NULL,
    service_id bigint,
    event_start_date timestamp(0) without time zone,
    event_end_date timestamp(0) without time zone,
    event_location character varying(125)
);


ALTER TABLE public.posts OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 32906)
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.posts_id_seq OWNER TO postgres;

--
-- TOC entry 5188 (class 0 OID 0)
-- Dependencies: 249
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- TOC entry 250 (class 1259 OID 32907)
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 32910)
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    guard_name character varying(125) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- TOC entry 252 (class 1259 OID 32913)
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.roles_id_seq OWNER TO postgres;

--
-- TOC entry 5189 (class 0 OID 0)
-- Dependencies: 252
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- TOC entry 253 (class 1259 OID 32914)
-- Name: services; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.services (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125),
    description text,
    icon text,
    is_active boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    image character varying(125),
    featured_on_home boolean DEFAULT true NOT NULL,
    name_en character varying(125),
    description_en text
);


ALTER TABLE public.services OWNER TO postgres;

--
-- TOC entry 254 (class 1259 OID 32922)
-- Name: services_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.services_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.services_id_seq OWNER TO postgres;

--
-- TOC entry 5190 (class 0 OID 0)
-- Dependencies: 254
-- Name: services_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.services_id_seq OWNED BY public.services.id;


--
-- TOC entry 255 (class 1259 OID 32923)
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(125) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 32928)
-- Name: settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.settings (
    id bigint NOT NULL,
    name character varying(125),
    val text,
    type character(20) DEFAULT 'string'::bpchar NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.settings OWNER TO postgres;

--
-- TOC entry 257 (class 1259 OID 32934)
-- Name: settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.settings_id_seq OWNER TO postgres;

--
-- TOC entry 5191 (class 0 OID 0)
-- Dependencies: 257
-- Name: settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.settings_id_seq OWNED BY public.settings.id;


--
-- TOC entry 258 (class 1259 OID 32935)
-- Name: sliders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sliders (
    id bigint NOT NULL,
    title character varying(125) NOT NULL,
    subtitle character varying(125),
    image character varying(125) NOT NULL,
    button_text character varying(125),
    button_link character varying(125),
    is_active boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    created_by integer,
    updated_by integer,
    deleted_by integer
);


ALTER TABLE public.sliders OWNER TO postgres;

--
-- TOC entry 259 (class 1259 OID 32942)
-- Name: sliders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.sliders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.sliders_id_seq OWNER TO postgres;

--
-- TOC entry 5192 (class 0 OID 0)
-- Dependencies: 259
-- Name: sliders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.sliders_id_seq OWNED BY public.sliders.id;


--
-- TOC entry 260 (class 1259 OID 32943)
-- Name: stats; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.stats (
    id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    value character varying(125) NOT NULL,
    label character varying(125) NOT NULL,
    label_en character varying(125),
    sort_order integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL
);


ALTER TABLE public.stats OWNER TO postgres;

--
-- TOC entry 5193 (class 0 OID 0)
-- Dependencies: 260
-- Name: COLUMN stats.value; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.stats.value IS 'Statistik value, misal: 12+, 150+, 98%';


--
-- TOC entry 5194 (class 0 OID 0)
-- Dependencies: 260
-- Name: COLUMN stats.label; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.stats.label IS 'Deskripsi statistik, misal: Tahun pengalaman, Proyek berhasil diselesaikan, dll';


--
-- TOC entry 5195 (class 0 OID 0)
-- Dependencies: 260
-- Name: COLUMN stats.label_en; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.stats.label_en IS 'Deskripsi statistik dalam bahasa Inggris';


--
-- TOC entry 5196 (class 0 OID 0)
-- Dependencies: 260
-- Name: COLUMN stats.sort_order; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.stats.sort_order IS 'Urutan tampil statistik';


--
-- TOC entry 5197 (class 0 OID 0)
-- Dependencies: 260
-- Name: COLUMN stats.is_active; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.stats.is_active IS 'Status aktif/non-aktif statistik';


--
-- TOC entry 261 (class 1259 OID 32948)
-- Name: stats_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.stats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.stats_id_seq OWNER TO postgres;

--
-- TOC entry 5198 (class 0 OID 0)
-- Dependencies: 261
-- Name: stats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.stats_id_seq OWNED BY public.stats.id;


--
-- TOC entry 262 (class 1259 OID 32949)
-- Name: taggables; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.taggables (
    id bigint NOT NULL,
    tag_id bigint NOT NULL,
    taggable_id bigint NOT NULL,
    taggable_type character varying(125) NOT NULL
);


ALTER TABLE public.taggables OWNER TO postgres;

--
-- TOC entry 263 (class 1259 OID 32952)
-- Name: taggables_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taggables_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.taggables_id_seq OWNER TO postgres;

--
-- TOC entry 5199 (class 0 OID 0)
-- Dependencies: 263
-- Name: taggables_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taggables_id_seq OWNED BY public.taggables.id;


--
-- TOC entry 264 (class 1259 OID 32953)
-- Name: tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    slug character varying(125),
    group_name character varying(125),
    description text,
    image character varying(125),
    status character varying(125) DEFAULT 'Active'::character varying NOT NULL,
    meta_title character varying(125),
    meta_description text,
    meta_keyword text,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.tags OWNER TO postgres;

--
-- TOC entry 265 (class 1259 OID 32959)
-- Name: tags_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tags_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tags_id_seq OWNER TO postgres;

--
-- TOC entry 5200 (class 0 OID 0)
-- Dependencies: 265
-- Name: tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tags_id_seq OWNED BY public.tags.id;


--
-- TOC entry 266 (class 1259 OID 32960)
-- Name: user_providers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_providers (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    provider character varying(125) NOT NULL,
    provider_id character varying(125) NOT NULL,
    avatar character varying(125),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.user_providers OWNER TO postgres;

--
-- TOC entry 267 (class 1259 OID 32963)
-- Name: user_providers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_providers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_providers_id_seq OWNER TO postgres;

--
-- TOC entry 5201 (class 0 OID 0)
-- Dependencies: 267
-- Name: user_providers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_providers_id_seq OWNED BY public.user_providers.id;


--
-- TOC entry 268 (class 1259 OID 32964)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(125) NOT NULL,
    email character varying(125) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(125) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    username character varying(125),
    first_name character varying(125),
    last_name character varying(125),
    mobile character varying(125),
    gender character varying(125),
    date_of_birth date,
    address text,
    bio text,
    social_profiles json,
    avatar character varying(125),
    last_ip character varying(125),
    login_count integer DEFAULT 0 NOT NULL,
    last_login timestamp(0) without time zone,
    status smallint DEFAULT '1'::smallint NOT NULL,
    created_by integer,
    updated_by integer,
    deleted_by integer,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 269 (class 1259 OID 32971)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 5202 (class 0 OID 0)
-- Dependencies: 269
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 4836 (class 2604 OID 32972)
-- Name: activity_log id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_log ALTER COLUMN id SET DEFAULT nextval('public.activity_log_id_seq'::regclass);


--
-- TOC entry 4837 (class 2604 OID 32973)
-- Name: categories id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- TOC entry 4839 (class 2604 OID 32974)
-- Name: client_logos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client_logos ALTER COLUMN id SET DEFAULT nextval('public.client_logos_id_seq'::regclass);


--
-- TOC entry 4842 (class 2604 OID 32975)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 4844 (class 2604 OID 32976)
-- Name: faqs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.faqs ALTER COLUMN id SET DEFAULT nextval('public.faqs_id_seq'::regclass);


--
-- TOC entry 4847 (class 2604 OID 32977)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 4848 (class 2604 OID 32978)
-- Name: media id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media ALTER COLUMN id SET DEFAULT nextval('public.media_id_seq'::regclass);


--
-- TOC entry 4849 (class 2604 OID 32979)
-- Name: messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages ALTER COLUMN id SET DEFAULT nextval('public.messages_id_seq'::regclass);


--
-- TOC entry 4850 (class 2604 OID 32980)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 4851 (class 2604 OID 32981)
-- Name: our_works id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.our_works ALTER COLUMN id SET DEFAULT nextval('public.our_works_id_seq'::regclass);


--
-- TOC entry 4855 (class 2604 OID 32982)
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- TOC entry 4856 (class 2604 OID 32983)
-- Name: portfolios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolios ALTER COLUMN id SET DEFAULT nextval('public.portfolios_id_seq'::regclass);


--
-- TOC entry 4858 (class 2604 OID 32984)
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- TOC entry 4862 (class 2604 OID 32985)
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- TOC entry 4863 (class 2604 OID 32986)
-- Name: services id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.services ALTER COLUMN id SET DEFAULT nextval('public.services_id_seq'::regclass);


--
-- TOC entry 4867 (class 2604 OID 32987)
-- Name: settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings ALTER COLUMN id SET DEFAULT nextval('public.settings_id_seq'::regclass);


--
-- TOC entry 4869 (class 2604 OID 32988)
-- Name: sliders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sliders ALTER COLUMN id SET DEFAULT nextval('public.sliders_id_seq'::regclass);


--
-- TOC entry 4872 (class 2604 OID 32989)
-- Name: stats id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stats ALTER COLUMN id SET DEFAULT nextval('public.stats_id_seq'::regclass);


--
-- TOC entry 4875 (class 2604 OID 32990)
-- Name: taggables id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taggables ALTER COLUMN id SET DEFAULT nextval('public.taggables_id_seq'::regclass);


--
-- TOC entry 4876 (class 2604 OID 32991)
-- Name: tags id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags ALTER COLUMN id SET DEFAULT nextval('public.tags_id_seq'::regclass);


--
-- TOC entry 4878 (class 2604 OID 32992)
-- Name: user_providers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_providers ALTER COLUMN id SET DEFAULT nextval('public.user_providers_id_seq'::regclass);


--
-- TOC entry 4879 (class 2604 OID 32993)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 5118 (class 0 OID 32795)
-- Dependencies: 217
-- Data for Name: activity_log; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.activity_log (id, log_name, description, subject_type, subject_id, causer_type, causer_id, properties, created_at, updated_at, event, batch_uuid) FROM stdin;
1	posts	created	Modules\\Post\\Models\\Post	1	\N	\N	{"attributes":{"id":1,"name":"Strategi Digital untuk Bisnis UMKM di Era Modern","slug":"strategi-digital-bisnis-umkm","intro":"Panduan praktis untuk UMKM mengadopsi teknologi dalam operasional bisnis sehari-hari.","content":"<p>Bisnis UMKM saat ini dihadapkan pada tantangan untuk tetap kompetitif di era digital. Artikel ini membahas strategi implementasi teknologi yang efektif dan terjangkau.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/digital-strategy.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-09-30T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","updated_at":"2025-10-02T19:21:42.000000Z","deleted_at":null,"sort_order":1,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 01:21:42	2025-10-03 01:21:42	created	\N
2	posts	created	Modules\\Post\\Models\\Post	2	\N	\N	{"attributes":{"id":2,"name":"Pentingnya UX dalam Desain Produk Digital","slug":"pentingnya-ux-dalam-desain-produk","intro":"Mengapa pengalaman pengguna menjadi faktor kunci dalam kesuksesan produk digital.","content":"<p>Desain pengalaman pengguna (UX) bukan hanya tentang tampilan yang menarik, tetapi juga tentang kemudahan penggunaan dan kepuasan pengguna dalam berinteraksi dengan produk digital.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/ux-design.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-09-27T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","updated_at":"2025-10-02T19:21:42.000000Z","deleted_at":null,"sort_order":2,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 01:21:42	2025-10-03 01:21:42	created	\N
3	posts	created	Modules\\Post\\Models\\Post	3	\N	\N	{"attributes":{"id":3,"name":"Tren Teknologi yang Membentuk Masa Depan Bisnis","slug":"tren-teknologi-masa-depan-bisnis","intro":"Tinjauan terhadap teknologi-teknologi terkini yang akan mengubah lanskap bisnis.","content":"<p>Artificial Intelligence, Internet of Things, dan teknologi blockchain adalah beberapa tren yang akan menentukan masa depan bisnis di Indonesia dan dunia.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/tech-trends.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-09-24T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","updated_at":"2025-10-02T19:21:42.000000Z","deleted_at":null,"sort_order":3,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 01:21:42	2025-10-03 01:21:42	created	\N
4	posts	updated	Modules\\Post\\Models\\Post	2	App\\Models\\User	1	{"attributes":{"updated_by":1,"deleted_by":1},"old":{"updated_by":null,"deleted_by":null}}	2025-10-03 10:16:13	2025-10-03 10:16:13	updated	\N
5	posts	deleted	Modules\\Post\\Models\\Post	2	App\\Models\\User	1	{"old":{"name":"Pentingnya UX dalam Desain Produk Digital","slug":"pentingnya-ux-dalam-desain-produk","intro":"Mengapa pengalaman pengguna menjadi faktor kunci dalam kesuksesan produk digital.","content":"<p>Desain pengalaman pengguna (UX) bukan hanya tentang tampilan yang menarik, tetapi juga tentang kemudahan penggunaan dan kepuasan pengguna dalam berinteraksi dengan produk digital.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/ux-design.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":1,"deleted_by":1,"published_at":"2025-09-27T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","deleted_at":"2025-10-03T04:16:13.000000Z","sort_order":2,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 10:16:13	2025-10-03 10:16:13	deleted	\N
6	posts	updated	Modules\\Post\\Models\\Post	1	App\\Models\\User	1	{"attributes":{"updated_by":1,"deleted_by":1},"old":{"updated_by":null,"deleted_by":null}}	2025-10-03 10:16:18	2025-10-03 10:16:18	updated	\N
7	posts	deleted	Modules\\Post\\Models\\Post	1	App\\Models\\User	1	{"old":{"name":"Strategi Digital untuk Bisnis UMKM di Era Modern","slug":"strategi-digital-bisnis-umkm","intro":"Panduan praktis untuk UMKM mengadopsi teknologi dalam operasional bisnis sehari-hari.","content":"<p>Bisnis UMKM saat ini dihadapkan pada tantangan untuk tetap kompetitif di era digital. Artikel ini membahas strategi implementasi teknologi yang efektif dan terjangkau.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/digital-strategy.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":1,"deleted_by":1,"published_at":"2025-09-30T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","deleted_at":"2025-10-03T04:16:18.000000Z","sort_order":1,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 10:16:18	2025-10-03 10:16:18	deleted	\N
8	posts	updated	Modules\\Post\\Models\\Post	3	App\\Models\\User	1	{"attributes":{"updated_by":1,"deleted_by":1},"old":{"updated_by":null,"deleted_by":null}}	2025-10-03 10:16:25	2025-10-03 10:16:25	updated	\N
9	posts	deleted	Modules\\Post\\Models\\Post	3	App\\Models\\User	1	{"old":{"name":"Tren Teknologi yang Membentuk Masa Depan Bisnis","slug":"tren-teknologi-masa-depan-bisnis","intro":"Tinjauan terhadap teknologi-teknologi terkini yang akan mengubah lanskap bisnis.","content":"<p>Artificial Intelligence, Internet of Things, dan teknologi blockchain adalah beberapa tren yang akan menentukan masa depan bisnis di Indonesia dan dunia.<\\/p>","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"img\\/posts\\/tech-trends.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"1","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":null,"created_by_alias":null,"updated_by":1,"deleted_by":1,"published_at":"2025-09-24T19:21:42.000000Z","created_at":"2025-10-02T19:21:42.000000Z","deleted_at":"2025-10-03T04:16:25.000000Z","sort_order":3,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 10:16:25	2025-10-03 10:16:25	deleted	\N
10	posts	created	Modules\\Post\\Models\\Post	4	\N	\N	{"attributes":{"id":4,"name":"Commodi aut veritatis in aut","slug":"commodi-aut-veritatis-in-aut","intro":"Eos voluptas et doloremque minus quasi eius et. Culpa voluptatem totam quis ab nihil. Eos pariatur qui unde aut. Labore in alias fugit non aperiam.","content":"Vel esse sed neque veritatis eos. Qui porro dolorem quia enim accusamus. Ut dolor voluptatem nisi fugiat.\\n\\nOmnis nihil amet et delectus. Accusamus voluptates fugiat delectus excepturi sapiente deleniti. Placeat ab repellat commodi ut ipsam sed eos dolores. Et voluptatum ea numquam consequatur deleniti.\\n\\nQui sint sit minus in quo ea eveniet. Autem doloremque porro nam.\\n\\nVelit blanditiis enim similique est exercitationem dolore voluptates. Veritatis nihil possimus et consequuntur sit quibusdam earum. Ea ut ducimus vel qui.\\n\\nDelectus quis rem amet animi perferendis. Ut corporis voluptatem esse est est. Quo soluta qui rerum ea culpa non. Sunt eum quia voluptas culpa vero explicabo non.","type":"Feature","category_id":5,"category_name":null,"is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=41","meta_title":"Commodi aut veritatis in aut","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=41","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:57:49.000000Z","created_at":"2025-10-03T08:57:50.000000Z","updated_at":"2025-10-03T08:57:49.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:57:50	2025-10-03 14:57:50	created	\N
11	posts	created	Modules\\Post\\Models\\Post	5	\N	\N	{"attributes":{"id":5,"name":"Porro eum unde rerum ut","slug":"porro-eum-unde-rerum-ut","intro":"Non accusamus in voluptatem reiciendis labore vero. Temporibus illum repellat provident culpa quos. Aut cupiditate fugit accusamus dolores et facilis. Voluptate doloremque quia adipisci illum. Suscipit omnis et nemo quia.","content":"Praesentium corrupti aspernatur non et quibusdam sunt magni. Labore illum ducimus commodi aut nisi aspernatur. Aspernatur repellendus quibusdam incidunt minus impedit et.\\n\\nVoluptas in ab adipisci sed sequi. Libero autem voluptatem eos voluptatem. Repellendus nemo earum sed ut. Dolorum qui et molestias qui cumque mollitia. Explicabo inventore vel ipsa vel.\\n\\nCorrupti doloremque enim delectus alias consequatur molestiae. Dolor ratione id in earum sunt ut. Aut quo quo impedit. Sit sint voluptas ut qui.\\n\\nEsse eos rerum consequatur recusandae praesentium. Deleniti non adipisci modi dolore atque deleniti. Quas voluptas alias ad magni quasi laudantium. Qui rerum et sint deleniti eum quaerat repellat.\\n\\nSed delectus voluptas esse aliquam. Enim quaerat placeat fuga dolor unde nesciunt. Ab possimus quod blanditiis aut. Ipsum et debitis voluptatem labore.\\n\\nRerum dicta voluptas optio possimus ut consectetur consequatur. Necessitatibus nihil optio modi illum ut. Et odio ut blanditiis sit vel quod ut.","type":"News","category_id":4,"category_name":null,"is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=8","meta_title":"Porro eum unde rerum ut","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=8","meta_og_url":"","hits":0,"order":null,"status":"Draft","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:57:50.000000Z","created_at":"2025-10-03T08:57:50.000000Z","updated_at":"2025-10-03T08:57:50.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:57:50	2025-10-03 14:57:50	created	\N
12	posts	created	Modules\\Post\\Models\\Post	6	\N	\N	{"attributes":{"id":6,"name":"Inventore quia libero vel id","slug":"inventore-quia-libero-vel-id","intro":"Ducimus ut sit iste quis perferendis quod et. Vel dolorum animi laudantium vero debitis. Assumenda beatae optio harum et. Non adipisci accusamus incidunt quas suscipit.","content":"Amet enim tenetur voluptatem nisi est tenetur optio. Molestiae quae et aliquam similique eligendi molestiae. Impedit quam dolorum delectus.\\n\\nAssumenda aut cum qui quam corporis dolor et. Excepturi vel facere odit porro est. Dolorem laboriosam cum earum impedit. Sit minus ut omnis delectus ut nostrum placeat. Dolorem autem sit eligendi voluptatem ipsam natus voluptas.\\n\\nArchitecto numquam voluptates reiciendis aut. Consequatur nostrum odio reiciendis commodi id repudiandae dolore. Quibusdam et illum dolores asperiores doloribus. Cum quibusdam similique et et explicabo illo.\\n\\nNostrum quia soluta id facere quam possimus. Quis odio ut et omnis exercitationem architecto recusandae. Qui blanditiis dolor temporibus eum velit eveniet possimus. Voluptatem corrupti officia ipsa saepe perspiciatis ut.\\n\\nSunt ea at tempore placeat quo totam dolores. Autem est dicta atque sit. Excepturi molestiae omnis sunt omnis omnis dignissimos voluptatem.","type":"News","category_id":1,"category_name":null,"is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=49","meta_title":"Inventore quia libero vel id","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=49","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:57:50.000000Z","created_at":"2025-10-03T08:57:50.000000Z","updated_at":"2025-10-03T08:57:50.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:57:50	2025-10-03 14:57:50	created	\N
13	posts	created	Modules\\Post\\Models\\Post	7	\N	\N	{"attributes":{"id":7,"name":"Animi dicta sunt dolores et","slug":"animi-dicta-sunt-dolores-et","intro":"Saepe molestias hic mollitia nostrum. Et voluptatem magnam alias facere doloribus harum.","content":"Voluptate inventore explicabo vitae corporis. Corporis ut repellendus ut repudiandae asperiores in iure. Sunt est consequatur vel consequatur asperiores in. Voluptas modi perspiciatis accusantium. Dignissimos similique voluptatem molestiae hic natus consequatur sed.\\n\\nEx delectus deserunt saepe voluptates atque. Aliquid laboriosam voluptatibus rerum nesciunt recusandae non ea.\\n\\nSed architecto omnis eos veritatis sed repudiandae accusantium. Sint fugit maxime perferendis quia maiores aut. Laudantium in voluptatem natus aut.\\n\\nVoluptates quod atque repudiandae ducimus debitis assumenda ea. Veniam quisquam labore error modi laborum. Assumenda porro asperiores quae laboriosam architecto et totam.\\n\\nOdit ea nam voluptatem. Debitis molestiae ut ut voluptatem sed facere. Quis neque blanditiis dolorum necessitatibus officiis itaque. Unde esse eaque quidem et a.\\n\\nQuo eaque quas harum dolor velit nam eos. Distinctio quod quia aperiam possimus. Dicta eius maxime voluptatum rerum. Ut dolor impedit provident id. Beatae exercitationem tempore aspernatur aut.\\n\\nAut dolorum dolorum reprehenderit id recusandae. Et nostrum repellendus assumenda reiciendis quasi. Et qui tenetur unde vero dolore.","type":"Feature","category_id":4,"category_name":null,"is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=4","meta_title":"Animi dicta sunt dolores et","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=4","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:57:50.000000Z","created_at":"2025-10-03T08:57:50.000000Z","updated_at":"2025-10-03T08:57:50.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:57:50	2025-10-03 14:57:50	created	\N
14	posts	created	Modules\\Post\\Models\\Post	8	\N	\N	{"attributes":{"id":8,"name":"Asperiores non possimus est","slug":"asperiores-non-possimus-est","intro":"Minima voluptates voluptate tempore et excepturi molestias. Autem voluptas ex at et eum quam. Rerum nihil minus dolore ex et sunt praesentium id. Consequatur praesentium voluptatem et quidem.","content":"Accusamus quisquam quis veritatis nihil nihil ipsa commodi. Delectus corporis culpa deleniti iusto omnis. Aut in est impedit doloremque eveniet quia. Pariatur at iure ut laboriosam est et.\\n\\nEx et sint minus dolores quia ea. Corrupti in et odit placeat mollitia accusamus quas. Velit alias earum ea itaque qui occaecati cupiditate. Consequuntur omnis odit voluptates porro vitae ut enim ad. Ut et dolor et iure.\\n\\nIpsam voluptatibus et amet corporis. Aut vel qui nulla consequatur architecto aperiam ad. Rerum culpa eos consequuntur consectetur saepe temporibus eveniet qui.\\n\\nCorrupti aut est enim ut. Beatae sequi vitae saepe et sunt. Non iste inventore provident nobis et ad. Quidem quisquam ipsum sapiente praesentium facere.\\n\\nQuia rerum quasi commodi hic officia rerum cupiditate. Dolor ut sit iure.\\n\\nEt ab similique molestiae. Animi iure rerum cum sit ratione est. Omnis quia sed enim sit aliquid.\\n\\nPraesentium similique reprehenderit aspernatur dolor minus qui. Et iste dolores dolorum illum. Possimus et est commodi. Inventore doloribus et quia repellendus.","type":"Feature","category_id":4,"category_name":null,"is_featured":0,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=18","meta_title":"Asperiores non possimus est","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=18","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:57:50.000000Z","created_at":"2025-10-03T08:57:50.000000Z","updated_at":"2025-10-03T08:57:50.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:57:50	2025-10-03 14:57:50	created	\N
15	posts	created	Modules\\Post\\Models\\Post	9	\N	\N	{"attributes":{"id":9,"name":"Ea aut rerum et impedit sunt","slug":"ea-aut-rerum-et-impedit-sunt","intro":"Rerum tenetur quos a. Corporis vero unde voluptatum. Explicabo architecto dolores et nisi. Ipsa error consequatur natus et in veniam nemo. Nihil consectetur expedita saepe est labore iure iure.","content":"Omnis eum animi ut sed quia. Eos quo ut fugiat sunt. Est non ex molestiae qui. Vel tempora corrupti ea voluptate eveniet ipsa et.\\n\\nOccaecati unde autem asperiores in voluptas. Consequatur repudiandae a temporibus. Sint voluptatem ad quae occaecati laudantium voluptates. Veritatis labore ut rerum ut. Magnam culpa et a.\\n\\nUt expedita odit ipsa et et iste. Dolore iste ratione quis architecto id quas culpa. Placeat tempore velit repudiandae qui aut. Dolorum ut aut eaque voluptates quae.\\n\\nAssumenda vel rem autem dolores nemo ut nam deserunt. Qui omnis similique nemo laborum est voluptas sit voluptatem. Impedit qui quod sit quas. Odit corrupti officia quis iusto in iste tempore.\\n\\nId quibusdam dolores at omnis cupiditate non sit. Id mollitia error et magnam ut. Aut cupiditate fugit veniam ratione laudantium earum.","type":"Article","category_id":5,"category_name":"Dolorem ea","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=14","meta_title":"Ea aut rerum et impedit sunt","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=14","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:59:28.000000Z","created_at":"2025-10-03T08:59:28.000000Z","updated_at":"2025-10-03T08:59:28.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:59:28	2025-10-03 14:59:28	created	\N
16	posts	created	Modules\\Post\\Models\\Post	10	\N	\N	{"attributes":{"id":10,"name":"Error sit distinctio esse id","slug":"error-sit-distinctio-esse-id","intro":"Saepe ex ex dicta sit minus vel aspernatur. Molestias debitis neque laboriosam enim ut sunt.","content":"Saepe dolor voluptatem neque est. Et aut hic ut voluptas nulla. Quod qui blanditiis modi distinctio quia.\\n\\nOccaecati cum vel omnis quo quos veritatis. Vero dolores voluptatem modi provident cum nam. Repellendus in dolores et impedit non magnam. Laudantium veritatis illo fuga ex.\\n\\nMaiores quae a ut quibusdam. Esse omnis ipsam et quos.\\n\\nQuod veritatis ullam nihil eveniet earum rerum aut. Quo quae voluptatem tempore fugiat quisquam. Ea rem a amet rerum similique odit quaerat.\\n\\nAt libero similique laboriosam quas voluptatibus sit. Consectetur in ex nostrum voluptatibus natus voluptas blanditiis. Similique excepturi maiores beatae. Reiciendis ut modi quam ad ex officiis tempore.","type":"News","category_id":4,"category_name":"Aliquam esse","is_featured":0,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=25","meta_title":"Error sit distinctio esse id","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=25","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:59:28.000000Z","created_at":"2025-10-03T08:59:28.000000Z","updated_at":"2025-10-03T08:59:28.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:59:28	2025-10-03 14:59:28	created	\N
17	posts	created	Modules\\Post\\Models\\Post	11	\N	\N	{"attributes":{"id":11,"name":"Aut ad quos vitae est","slug":"aut-ad-quos-vitae-est","intro":"Commodi ab quae non eos modi. Voluptas illo at voluptatibus placeat. Accusantium est eaque nemo aperiam magni. Corrupti accusantium quas et nam dolores.","content":"Perferendis veniam explicabo deleniti illum nihil cum. Velit ad quasi enim sed. Accusamus adipisci doloremque id at eos sit voluptates. Eaque et non non dolores in dolor reprehenderit.\\n\\nMagni cupiditate quia voluptas vitae ullam. Qui neque expedita magni mollitia aut. Voluptas doloremque sit occaecati minima. Quas id et aut nesciunt officia illo.\\n\\nOfficiis placeat nihil autem molestiae quas. Mollitia praesentium consequatur natus magni repellendus porro. Sapiente eveniet optio quisquam voluptatem culpa ab. Delectus nemo eligendi et dicta.\\n\\nAccusamus nulla laboriosam fugiat ab doloremque ducimus sapiente aliquam. Dicta molestias non suscipit aut enim. Alias et minus reiciendis nesciunt rerum quisquam. Eos maiores illum sequi ea.\\n\\nAtque aliquam dolorum officiis accusamus error alias. Quibusdam aut qui et commodi quo fuga.\\n\\nConsequuntur dolorem quasi delectus qui id. Veniam doloremque voluptas et laudantium inventore. Qui dolorem sunt veritatis perferendis voluptas. Ducimus quasi corporis quidem qui ipsa quam distinctio nihil.\\n\\nPossimus qui sed possimus ut architecto iste quod vero. Quibusdam dolorem unde et. Dolorem libero minima facilis qui qui quo voluptatum. Quibusdam praesentium molestiae dolorum autem quis voluptatem.","type":"Article","category_id":2,"category_name":"Cum ipsam","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=44","meta_title":"Aut ad quos vitae est","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=44","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:59:28.000000Z","created_at":"2025-10-03T08:59:28.000000Z","updated_at":"2025-10-03T08:59:28.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:59:28	2025-10-03 14:59:28	created	\N
18	posts	created	Modules\\Post\\Models\\Post	12	\N	\N	{"attributes":{"id":12,"name":"Cum ea et repellendus","slug":"cum-ea-et-repellendus","intro":"Omnis eum eligendi dolorem nulla dicta in at inventore. Saepe et ut aliquam nihil. Velit vero accusamus delectus corrupti dolores.","content":"Consequatur fugit cum praesentium earum non molestiae modi. Voluptatum perferendis repudiandae odit aut provident. Sed ut placeat illo sint error perferendis. Et omnis aut ipsam repellat eius rerum.\\n\\nDolores eos non porro architecto voluptatem quia laudantium. Blanditiis nostrum ut molestias necessitatibus tempora voluptas et. Ipsa consequuntur qui id iure mollitia explicabo sed nobis.\\n\\nDebitis ratione occaecati ratione quae corporis fugiat numquam. Eius architecto voluptates nisi dolorem. Amet nostrum vero voluptatem voluptate ut accusantium.\\n\\nSed veniam ea illo et velit et ut. Voluptas eveniet eos in rerum repellendus tempore. Totam autem eligendi molestias. Hic tempore quae quae commodi sed id.\\n\\nQuibusdam dignissimos quia et molestias quo voluptatem cumque provident. Eveniet iure cupiditate nulla non cumque consequatur ipsum. Dolores voluptatibus voluptate ab perspiciatis similique. Voluptas fugiat architecto neque id ratione ut alias eos.","type":"News","category_id":2,"category_name":"Cum ipsam","is_featured":0,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=23","meta_title":"Cum ea et repellendus","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=23","meta_og_url":"","hits":0,"order":null,"status":"Draft","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:59:28.000000Z","created_at":"2025-10-03T08:59:28.000000Z","updated_at":"2025-10-03T08:59:28.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:59:28	2025-10-03 14:59:28	created	\N
19	posts	created	Modules\\Post\\Models\\Post	13	\N	\N	{"attributes":{"id":13,"name":"Ab sint beatae nemo rerum","slug":"ab-sint-beatae-nemo-rerum","intro":"Nemo rerum molestiae aperiam labore dolor. Et maxime dolore eveniet recusandae. Rerum quasi a quisquam omnis consectetur consequuntur quia dolores. Deleniti atque rerum quidem dolor eos voluptatum accusamus.","content":"Et ullam iusto facere et. Est voluptatem qui sed. Dolorem natus architecto voluptatem aperiam incidunt ullam.\\n\\nExercitationem sapiente voluptatum qui sit. Assumenda ut magni vitae dicta facere et tenetur. Deleniti mollitia non ipsa praesentium. Molestias voluptates ex eaque nulla et. Quam nostrum tempore nihil sed earum.\\n\\nVeniam error eum dignissimos debitis sed tempora vel. Qui quae quis et nostrum. Odit dolor deserunt dolorem perferendis.\\n\\nNecessitatibus sed qui laboriosam error distinctio excepturi nostrum. Corporis natus impedit nostrum modi. Reprehenderit nemo est consequuntur odit unde.\\n\\nCommodi doloremque est aliquid molestiae. Incidunt doloribus ea consequatur qui ut sint ipsa. Ea rerum possimus amet earum cumque. Quia nobis vel repellendus atque. Quas magnam natus voluptates dolorum velit distinctio.","type":"Article","category_id":4,"category_name":"Aliquam esse","is_featured":0,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_title":"Ab sint beatae nemo rerum","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T08:59:28.000000Z","created_at":"2025-10-03T08:59:28.000000Z","updated_at":"2025-10-03T08:59:28.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 14:59:28	2025-10-03 14:59:28	created	\N
20	posts	updated	Modules\\Post\\Models\\Post	9	App\\Models\\User	1	{"attributes":{"hits":1},"old":{"hits":0}}	2025-10-03 17:32:35	2025-10-03 17:32:35	updated	\N
21	posts	created	Modules\\Post\\Models\\Post	14	\N	\N	{"attributes":{"id":14,"name":"Aut eum nisi sunt numquam","slug":"aut-eum-nisi-sunt-numquam","intro":"Placeat sunt ut aut et non. Quia maiores hic sunt perferendis eaque hic. Sed sint reprehenderit vero libero non et distinctio.","content":"Quo minus perferendis et aut sed similique. Eos aliquam magnam rerum accusamus. Quia assumenda alias soluta et et et quis. Perspiciatis optio ea dolor architecto.\\n\\nEos perspiciatis sint et reiciendis enim suscipit. Modi molestias totam beatae ea voluptatem labore voluptatem. Et amet mollitia nam et id.\\n\\nTenetur voluptas sed nemo aut rerum dolor aliquid. Consequatur est at sed et. Doloremque nulla perspiciatis deleniti aut.\\n\\nLaboriosam illo nisi maxime ea laudantium nobis. Ea sequi ad enim suscipit. Rerum quia incidunt sed fuga aut.\\n\\nFacere debitis nam cumque quis nihil. Similique nulla quasi deserunt voluptates aut. Distinctio amet libero veritatis qui. Voluptatem soluta et eum rerum excepturi.\\n\\nModi qui quaerat qui debitis eos maxime. Dolor id dolor autem sint sapiente in. Aut perferendis et facere excepturi amet.\\n\\nFacilis sit distinctio placeat quidem consequatur sapiente velit. Quia quo voluptas nihil mollitia labore numquam autem. Voluptatem deleniti sed suscipit quo recusandae odio dolore.","type":"Feature","category_id":4,"category_name":"Aliquam esse","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=11","meta_title":"Aut eum nisi sunt numquam","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=11","meta_og_url":"","hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","updated_at":"2025-10-03T11:57:27.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 17:57:27	2025-10-03 17:57:27	created	\N
22	posts	created	Modules\\Post\\Models\\Post	15	\N	\N	{"attributes":{"id":15,"name":"Inventore et quos ad sed","slug":"inventore-et-quos-ad-sed","intro":"Provident accusantium tenetur perferendis sed suscipit. Et beatae in accusantium est. Nesciunt sequi voluptatem beatae laudantium non ad.","content":"Dolorum alias atque autem aut. Enim accusantium vel eos alias ipsam.\\n\\nConsequatur repellendus omnis aut nostrum. Unde velit consequatur qui aliquid. Officiis dolorem ipsa qui repudiandae sed recusandae in aliquam. At doloribus perferendis non tempora asperiores maxime. Autem ut tempora hic rerum.\\n\\nNihil quod repudiandae ea rerum fuga laboriosam et dolor. Perferendis sint consectetur illo ut consequatur. Temporibus voluptatem unde voluptate aut ducimus. Facilis rerum ut aut quidem et.\\n\\nQuam repellat dicta eveniet aut illo hic ex. Enim voluptatem iste iste velit. Amet est mollitia voluptatem quasi nam dolorem. Dolorem perspiciatis rerum nulla.\\n\\nMinima et perspiciatis et laudantium molestiae laudantium. Voluptatem mollitia ut ex nemo dolor. Saepe ipsum iusto unde cupiditate tenetur ratione. Ipsum laborum ea inventore cumque nisi alias dolorem occaecati. Nihil et amet velit labore explicabo.\\n\\nEt voluptas et sunt vero aut. Fugit sit ab perferendis quis qui ut sit. Reprehenderit quis et numquam omnis minima et. Consequatur esse magni iure occaecati et quas.\\n\\nQuidem delectus optio officia neque sit sint ex. Omnis quo eos dolores impedit odio aut reiciendis. Ut in et quo quis consequatur modi. Labore omnis sunt amet error.","type":"Feature","category_id":1,"category_name":"Dicta nihil","is_featured":0,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=17","meta_title":"Inventore et quos ad sed","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=17","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","updated_at":"2025-10-03T11:57:27.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 17:57:27	2025-10-03 17:57:27	created	\N
23	posts	created	Modules\\Post\\Models\\Post	16	\N	\N	{"attributes":{"id":16,"name":"Est ducimus accusamus omnis","slug":"est-ducimus-accusamus-omnis","intro":"Sit totam dolores earum quis impedit. Consequatur aut repudiandae modi cupiditate ea. Hic nemo tenetur porro voluptatum ut quae consequuntur. Dolorem ex sit rem minus.","content":"Ut magni ut suscipit nesciunt et natus esse. Minima ad deleniti architecto illum ducimus ut ipsam voluptatem. Dicta veritatis temporibus ab consequatur qui dolorem fugiat ut. Libero corrupti reiciendis rerum facilis velit.\\n\\nDolore qui minima quo consequatur vitae quia. Voluptatum enim molestias omnis aperiam. Inventore officiis consequatur commodi.\\n\\nSed ad laboriosam minus modi mollitia dicta. Non esse dolorum recusandae doloremque commodi.\\n\\nAut qui quos aliquam non. Nulla omnis eius rerum non autem. Laborum culpa pariatur perspiciatis facilis vel et.\\n\\nDelectus vitae et autem dolores distinctio molestias aut. Dignissimos et et nisi voluptatem incidunt cupiditate in. Est eos deleniti inventore eos saepe facilis. Aut velit fugiat est molestiae dolorem odit voluptas.","type":"Article","category_id":2,"category_name":"Cum ipsam","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=48","meta_title":"Est ducimus accusamus omnis","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=48","meta_og_url":"","hits":0,"order":null,"status":"Draft","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","updated_at":"2025-10-03T11:57:27.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 17:57:27	2025-10-03 17:57:27	created	\N
24	posts	created	Modules\\Post\\Models\\Post	17	\N	\N	{"attributes":{"id":17,"name":"Hic et aliquam sed qui","slug":"hic-et-aliquam-sed-qui","intro":"Ducimus ut temporibus fuga nihil eos tenetur. Quia recusandae at sunt similique. Fugiat quia vitae excepturi labore repellendus blanditiis. Facilis voluptas sint culpa ipsa laboriosam odit ut.","content":"Voluptates dolorum sit porro maxime qui blanditiis error. Maiores quae non iure et voluptatem similique quisquam. Dolor aut eaque ea aliquam ex qui dolorem. Sed esse saepe molestias aut. Eos accusamus omnis quas inventore.\\n\\nEt harum odio sit ipsum et nihil eum. Totam dolorem fuga numquam unde est. Praesentium excepturi quis illum fugiat sed. Natus incidunt minus ipsum quia.\\n\\nQuia et ipsum dolor consequuntur vero voluptatem. Optio voluptas vel expedita deleniti necessitatibus delectus sit. Odit sit esse sed odio velit quaerat. Ipsa rerum dolores et quia.\\n\\nEt nostrum quae commodi voluptas. Et doloribus veritatis similique placeat placeat. Iure modi voluptatibus quaerat reprehenderit. Est esse sequi fuga adipisci quis.\\n\\nDolor excepturi nobis blanditiis harum. Veritatis odio quae illo eos. Tempora impedit deleniti ut provident. Magnam animi qui ab non aut autem voluptatem.\\n\\nNulla consequatur delectus fugit non fugit debitis aut ipsa. Neque voluptatem ab impedit voluptatem quam sint eius. At tempora amet aliquam soluta soluta. Excepturi sapiente asperiores enim eligendi accusamus.","type":"News","category_id":3,"category_name":"Qui impedit","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_title":"Hic et aliquam sed qui","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","updated_at":"2025-10-03T11:57:27.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 17:57:27	2025-10-03 17:57:27	created	\N
25	posts	created	Modules\\Post\\Models\\Post	18	\N	\N	{"attributes":{"id":18,"name":"Quas minus accusamus amet","slug":"quas-minus-accusamus-amet","intro":"Aut in ut ducimus. Consequuntur quae magni molestiae hic ut. Eligendi rerum enim voluptas adipisci qui qui necessitatibus. Illo est quas qui dolorem quo.","content":"Ut repellendus quibusdam et quisquam quis totam. Molestiae nam commodi provident quae quas voluptatum. Odit et inventore quae voluptatem omnis commodi qui.\\n\\nSimilique dicta ullam cumque minima. Cupiditate est sed itaque voluptas repellat est. Repellendus odio enim voluptas sit expedita odio quae architecto.\\n\\nEst dolores nobis modi reprehenderit sequi cum. Doloribus rerum eligendi ratione eligendi. Voluptas distinctio et aut voluptatem.\\n\\nEt debitis est placeat et illum ad et. Blanditiis nemo vero corrupti eveniet dicta harum expedita quia. Atque et dolores tempora quia explicabo sed. Iure sed aliquam incidunt et perspiciatis.\\n\\nLaudantium voluptate et consectetur sunt exercitationem. Maxime similique sunt repudiandae est unde minima fuga. Nesciunt dolores dolorem id iusto quis dolor et.\\n\\nError consectetur architecto et illum odio. Sint facilis inventore tempora sunt officiis aut corporis.","type":"Feature","category_id":2,"category_name":"Cum ipsam","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=28","meta_title":"Quas minus accusamus amet","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=28","meta_og_url":"","hits":0,"order":null,"status":"Draft","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":null,"deleted_by":null,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","updated_at":"2025-10-03T11:57:27.000000Z","deleted_at":null,"sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 17:57:27	2025-10-03 17:57:27	created	\N
26	posts	updated	Modules\\Post\\Models\\Post	14	App\\Models\\User	1	{"attributes":{"hits":1},"old":{"hits":0}}	2025-10-03 18:35:32	2025-10-03 18:35:32	updated	\N
27	posts	created	Modules\\Post\\Models\\Post	19	App\\Models\\User	1	{"attributes":{"name":"BNI wondrX","slug":"bni-wondrx","intro":"ICE BSD","content":"BNI","type":null,"category_id":null,"category_name":null,"is_featured":1,"image":"http:\\/\\/172.6.7.253\\/wp-content\\/uploads\\/2016\\/09\\/BNI-wondrX-scaled-e1756711869168.jpg","meta_title":null,"meta_keywords":null,"meta_description":null,"meta_og_image":null,"meta_og_url":null,"hits":0,"order":null,"status":"Published","moderated_by":null,"moderated_at":null,"created_by":1,"created_by_name":"Super Admin","created_by_alias":null,"updated_by":1,"deleted_by":null,"published_at":"2025-10-03T14:21:00.000000Z","created_at":"2025-10-03T13:21:45.000000Z","deleted_at":null,"sort_order":0,"service_id":5,"event_start_date":"2025-08-17T14:21:00.000000Z","event_end_date":"2025-10-15T14:21:00.000000Z","event_location":"ICE BSD"}}	2025-10-03 19:21:45	2025-10-03 19:21:45	created	\N
28	posts	updated	Modules\\Post\\Models\\Post	18	App\\Models\\User	1	{"attributes":{"updated_by":1,"deleted_by":1},"old":{"updated_by":null,"deleted_by":null}}	2025-10-03 19:21:55	2025-10-03 19:21:55	updated	\N
29	posts	deleted	Modules\\Post\\Models\\Post	18	App\\Models\\User	1	{"old":{"name":"Quas minus accusamus amet","slug":"quas-minus-accusamus-amet","intro":"Aut in ut ducimus. Consequuntur quae magni molestiae hic ut. Eligendi rerum enim voluptas adipisci qui qui necessitatibus. Illo est quas qui dolorem quo.","content":"Ut repellendus quibusdam et quisquam quis totam. Molestiae nam commodi provident quae quas voluptatum. Odit et inventore quae voluptatem omnis commodi qui.\\n\\nSimilique dicta ullam cumque minima. Cupiditate est sed itaque voluptas repellat est. Repellendus odio enim voluptas sit expedita odio quae architecto.\\n\\nEst dolores nobis modi reprehenderit sequi cum. Doloribus rerum eligendi ratione eligendi. Voluptas distinctio et aut voluptatem.\\n\\nEt debitis est placeat et illum ad et. Blanditiis nemo vero corrupti eveniet dicta harum expedita quia. Atque et dolores tempora quia explicabo sed. Iure sed aliquam incidunt et perspiciatis.\\n\\nLaudantium voluptate et consectetur sunt exercitationem. Maxime similique sunt repudiandae est unde minima fuga. Nesciunt dolores dolorem id iusto quis dolor et.\\n\\nError consectetur architecto et illum odio. Sint facilis inventore tempora sunt officiis aut corporis.","type":"Feature","category_id":2,"category_name":"Cum ipsam","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=28","meta_title":"Quas minus accusamus amet","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=28","meta_og_url":"","hits":0,"order":null,"status":"Draft","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":1,"deleted_by":1,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","deleted_at":"2025-10-03T13:21:55.000000Z","sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 19:21:55	2025-10-03 19:21:55	deleted	\N
30	posts	updated	Modules\\Post\\Models\\Post	17	App\\Models\\User	1	{"attributes":{"updated_by":1,"deleted_by":1},"old":{"updated_by":null,"deleted_by":null}}	2025-10-03 19:22:02	2025-10-03 19:22:02	updated	\N
31	posts	deleted	Modules\\Post\\Models\\Post	17	App\\Models\\User	1	{"old":{"name":"Hic et aliquam sed qui","slug":"hic-et-aliquam-sed-qui","intro":"Ducimus ut temporibus fuga nihil eos tenetur. Quia recusandae at sunt similique. Fugiat quia vitae excepturi labore repellendus blanditiis. Facilis voluptas sint culpa ipsa laboriosam odit ut.","content":"Voluptates dolorum sit porro maxime qui blanditiis error. Maiores quae non iure et voluptatem similique quisquam. Dolor aut eaque ea aliquam ex qui dolorem. Sed esse saepe molestias aut. Eos accusamus omnis quas inventore.\\n\\nEt harum odio sit ipsum et nihil eum. Totam dolorem fuga numquam unde est. Praesentium excepturi quis illum fugiat sed. Natus incidunt minus ipsum quia.\\n\\nQuia et ipsum dolor consequuntur vero voluptatem. Optio voluptas vel expedita deleniti necessitatibus delectus sit. Odit sit esse sed odio velit quaerat. Ipsa rerum dolores et quia.\\n\\nEt nostrum quae commodi voluptas. Et doloribus veritatis similique placeat placeat. Iure modi voluptatibus quaerat reprehenderit. Est esse sequi fuga adipisci quis.\\n\\nDolor excepturi nobis blanditiis harum. Veritatis odio quae illo eos. Tempora impedit deleniti ut provident. Magnam animi qui ab non aut autem voluptatem.\\n\\nNulla consequatur delectus fugit non fugit debitis aut ipsa. Neque voluptatem ab impedit voluptatem quam sint eius. At tempora amet aliquam soluta soluta. Excepturi sapiente asperiores enim eligendi accusamus.","type":"News","category_id":3,"category_name":"Qui impedit","is_featured":1,"image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_title":"Hic et aliquam sed qui","meta_keywords":"","meta_description":"","meta_og_image":"https:\\/\\/picsum.photos\\/1200\\/630?random=30","meta_og_url":"","hits":0,"order":null,"status":"Unpublished","moderated_by":null,"moderated_at":null,"created_by":null,"created_by_name":"System","created_by_alias":null,"updated_by":1,"deleted_by":1,"published_at":"2025-10-03T11:57:27.000000Z","created_at":"2025-10-03T11:57:27.000000Z","deleted_at":"2025-10-03T13:22:02.000000Z","sort_order":0,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 19:22:02	2025-10-03 19:22:02	deleted	\N
32	posts	updated	Modules\\Post\\Models\\Post	14	App\\Models\\User	1	{"attributes":{"name":"BNI wondrX","slug":"bni-wondrx","intro":"BNI","content":"BNI","image":"http:\\/\\/172.6.7.253\\/wp-content\\/uploads\\/2016\\/09\\/BNI-wondrX-scaled-e1756711869168.jpg","updated_by":1,"service_id":5,"event_start_date":"2025-08-15T14:23:00.000000Z","event_end_date":"2025-08-17T14:23:00.000000Z","event_location":"ICE BSD"},"old":{"name":"Aut eum nisi sunt numquam","slug":"aut-eum-nisi-sunt-numquam","intro":"Placeat sunt ut aut et non. Quia maiores hic sunt perferendis eaque hic. Sed sint reprehenderit vero libero non et distinctio.","content":"Quo minus perferendis et aut sed similique. Eos aliquam magnam rerum accusamus. Quia assumenda alias soluta et et et quis. Perspiciatis optio ea dolor architecto.\\n\\nEos perspiciatis sint et reiciendis enim suscipit. Modi molestias totam beatae ea voluptatem labore voluptatem. Et amet mollitia nam et id.\\n\\nTenetur voluptas sed nemo aut rerum dolor aliquid. Consequatur est at sed et. Doloremque nulla perspiciatis deleniti aut.\\n\\nLaboriosam illo nisi maxime ea laudantium nobis. Ea sequi ad enim suscipit. Rerum quia incidunt sed fuga aut.\\n\\nFacere debitis nam cumque quis nihil. Similique nulla quasi deserunt voluptates aut. Distinctio amet libero veritatis qui. Voluptatem soluta et eum rerum excepturi.\\n\\nModi qui quaerat qui debitis eos maxime. Dolor id dolor autem sint sapiente in. Aut perferendis et facere excepturi amet.\\n\\nFacilis sit distinctio placeat quidem consequatur sapiente velit. Quia quo voluptas nihil mollitia labore numquam autem. Voluptatem deleniti sed suscipit quo recusandae odio dolore.","image":"https:\\/\\/picsum.photos\\/1200\\/630?random=11","updated_by":null,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 19:23:25	2025-10-03 19:23:25	updated	\N
33	posts	updated	Modules\\Post\\Models\\Post	11	App\\Models\\User	1	{"attributes":{"name":"KAFEGAMA PELUNCURAN BUKU","slug":"kafegama-peluncuran-buku","intro":"1 BUKU atau 2 BUKU","content":"TAU INFO DARIMANA","image":"http:\\/\\/172.6.7.253\\/wp-content\\/uploads\\/2016\\/09\\/KAFEGAMA-PELUNCURAN-scaled-e1756713184581.jpg","updated_by":1,"service_id":3,"event_location":"MM UGM"},"old":{"name":"Aut ad quos vitae est","slug":"aut-ad-quos-vitae-est","intro":"Commodi ab quae non eos modi. Voluptas illo at voluptatibus placeat. Accusantium est eaque nemo aperiam magni. Corrupti accusantium quas et nam dolores.","content":"Perferendis veniam explicabo deleniti illum nihil cum. Velit ad quasi enim sed. Accusamus adipisci doloremque id at eos sit voluptates. Eaque et non non dolores in dolor reprehenderit.\\n\\nMagni cupiditate quia voluptas vitae ullam. Qui neque expedita magni mollitia aut. Voluptas doloremque sit occaecati minima. Quas id et aut nesciunt officia illo.\\n\\nOfficiis placeat nihil autem molestiae quas. Mollitia praesentium consequatur natus magni repellendus porro. Sapiente eveniet optio quisquam voluptatem culpa ab. Delectus nemo eligendi et dicta.\\n\\nAccusamus nulla laboriosam fugiat ab doloremque ducimus sapiente aliquam. Dicta molestias non suscipit aut enim. Alias et minus reiciendis nesciunt rerum quisquam. Eos maiores illum sequi ea.\\n\\nAtque aliquam dolorum officiis accusamus error alias. Quibusdam aut qui et commodi quo fuga.\\n\\nConsequuntur dolorem quasi delectus qui id. Veniam doloremque voluptas et laudantium inventore. Qui dolorem sunt veritatis perferendis voluptas. Ducimus quasi corporis quidem qui ipsa quam distinctio nihil.\\n\\nPossimus qui sed possimus ut architecto iste quod vero. Quibusdam dolorem unde et. Dolorem libero minima facilis qui qui quo voluptatum. Quibusdam praesentium molestiae dolorum autem quis voluptatem.","image":"https:\\/\\/picsum.photos\\/1200\\/630?random=44","updated_by":null,"service_id":null,"event_location":null}}	2025-10-03 19:24:58	2025-10-03 19:24:58	updated	\N
34	posts	updated	Modules\\Post\\Models\\Post	9	App\\Models\\User	1	{"attributes":{"name":"ASEAN DAY","slug":"asean-day","intro":"HUT ASEAN","content":"ASEAN DAY","image":"http:\\/\\/172.6.7.253\\/wp-content\\/uploads\\/2016\\/09\\/STV04521-scaled-e1756714572833.jpg","updated_by":1,"service_id":4,"event_start_date":"2025-09-19T14:26:00.000000Z","event_end_date":"2025-10-03T14:26:00.000000Z","event_location":"ASEAN SEKRETARIAT"},"old":{"name":"Ea aut rerum et impedit sunt","slug":"ea-aut-rerum-et-impedit-sunt","intro":"Rerum tenetur quos a. Corporis vero unde voluptatum. Explicabo architecto dolores et nisi. Ipsa error consequatur natus et in veniam nemo. Nihil consectetur expedita saepe est labore iure iure.","content":"Omnis eum animi ut sed quia. Eos quo ut fugiat sunt. Est non ex molestiae qui. Vel tempora corrupti ea voluptate eveniet ipsa et.\\n\\nOccaecati unde autem asperiores in voluptas. Consequatur repudiandae a temporibus. Sint voluptatem ad quae occaecati laudantium voluptates. Veritatis labore ut rerum ut. Magnam culpa et a.\\n\\nUt expedita odit ipsa et et iste. Dolore iste ratione quis architecto id quas culpa. Placeat tempore velit repudiandae qui aut. Dolorum ut aut eaque voluptates quae.\\n\\nAssumenda vel rem autem dolores nemo ut nam deserunt. Qui omnis similique nemo laborum est voluptas sit voluptatem. Impedit qui quod sit quas. Odit corrupti officia quis iusto in iste tempore.\\n\\nId quibusdam dolores at omnis cupiditate non sit. Id mollitia error et magnam ut. Aut cupiditate fugit veniam ratione laudantium earum.","image":"https:\\/\\/picsum.photos\\/1200\\/630?random=14","updated_by":null,"service_id":null,"event_start_date":null,"event_end_date":null,"event_location":null}}	2025-10-03 19:26:54	2025-10-03 19:26:54	updated	\N
35	posts	updated	Modules\\Post\\Models\\Post	14	App\\Models\\User	1	{"attributes":{"hits":2},"old":{"hits":1}}	2025-10-04 08:56:04	2025-10-04 08:56:04	updated	\N
36	posts	updated	Modules\\Post\\Models\\Post	11	App\\Models\\User	1	{"attributes":{"hits":1},"old":{"hits":0}}	2025-10-04 08:56:12	2025-10-04 08:56:12	updated	\N
\.


--
-- TOC entry 5120 (class 0 OID 32801)
-- Dependencies: 219
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 5121 (class 0 OID 32806)
-- Dependencies: 220
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 5122 (class 0 OID 32809)
-- Dependencies: 221
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, name, slug, description, group_name, image, meta_title, meta_description, meta_keyword, "order", status, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at) FROM stdin;
1	Dicta nihil	dicta-nihil	Consequatur deserunt est nostrum voluptatibus sed odio autem. Eos quos molestias non atque. Explicabo voluptas magnam aut dolor sunt id.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
2	Cum ipsam	cum-ipsam	Laboriosam et vel nostrum doloribus. Veniam aut et accusamus distinctio optio assumenda ut. Adipisci ea ut non eos laboriosam omnis. Iure cum in odit ipsa. Voluptas quas et et aut.	\N	\N	\N	\N	\N	\N	Active	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
3	Qui impedit	qui-impedit	Qui aut veniam magni eos sapiente facilis totam ullam. Quia vero excepturi nihil unde. Nostrum aut accusantium qui et velit repellendus voluptate.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
4	Aliquam esse	aliquam-esse	Eligendi iure nobis corporis ut quia dolor unde. Quia quia aut aliquam et. Enim consequatur at sunt unde illum. Asperiores sit rem officiis ex at. Quasi voluptas hic aut.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
5	Dolorem ea	dolorem-ea	Temporibus earum minima aut ducimus aut corporis ducimus. Fugiat tempora qui optio accusantium. Laudantium nihil quo est nostrum.	\N	\N	\N	\N	\N	\N	Draft	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
6	Ipsum illum	ipsum-illum	Velit dolor culpa reiciendis illum numquam ullam aliquam aut. Eveniet ut unde quia dolores ducimus est qui. Nesciunt quibusdam alias error tenetur. Architecto sit quo et eos qui expedita quam.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
7	Dolores	dolores	Quam aut totam quia. Ipsam laudantium occaecati ut sit molestias est dolorem. Unde sed nihil eum libero. Fugiat saepe autem debitis eius labore minus.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
8	Tempora beatae	tempora-beatae	Et ea magni occaecati eum corporis consequatur voluptate. Et voluptatem dolor architecto. Consequatur earum et aliquid quam aspernatur.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
9	Minima sit	minima-sit	Assumenda est ullam dignissimos repudiandae est enim. Velit provident animi deserunt eum dolores quos suscipit. Natus nam laudantium delectus omnis maxime fugit eum.	\N	\N	\N	\N	\N	\N	Active	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
10	Et facere sint	et-facere-sint	Explicabo consequuntur rerum quia deleniti. Tempora ut nihil distinctio quod aliquid. Ea consequuntur corporis alias voluptates omnis ut. Eum aut at quis facere aliquam temporibus et.	\N	\N	\N	\N	\N	\N	Active	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
11	Magni aperiam	magni-aperiam	Et vel eum numquam laudantium ut ut. Aut et facilis temporibus culpa. Maxime quas veniam voluptate aut ex earum. Sint temporibus eum voluptatem est explicabo veniam consectetur.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
12	Totam	totam	Ut voluptas quia incidunt. Quaerat nisi et quaerat ipsam adipisci laborum quia. Voluptatem dolor rerum incidunt saepe aut. Autem et veritatis itaque aliquam.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
13	Eos deleniti	eos-deleniti	Id vitae omnis aut. Est velit cupiditate odit. Voluptatem non quos quis illum. Repudiandae et et sed neque eius.	\N	\N	\N	\N	\N	\N	Draft	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
14	Fugit	fugit	Ut ut adipisci omnis modi assumenda vel. Libero qui sunt saepe rerum laborum.	\N	\N	\N	\N	\N	\N	Inactive	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
15	Praesentium	praesentium	Et velit maiores expedita et quo reprehenderit. Vel quam ducimus eveniet qui. Odio et exercitationem veniam maiores ut.	\N	\N	\N	\N	\N	\N	Draft	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
\.


--
-- TOC entry 5124 (class 0 OID 32816)
-- Dependencies: 223
-- Data for Name: client_logos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.client_logos (id, client_name, logo, website_url, is_active, sort_order, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
5	PT. ANTAM Tbk	https://images.seeklogo.com/logo-png/40/1/antam-logo-png_seeklogo-400273.png	https://www.antam.com	t	5	2025-10-03 01:16:51	2025-10-04 10:18:33	\N	\N	1	\N
4	BNI	https://www.bni.co.id/Portals/1/BNI/Images/logo-bni-new.png	https://www.bni.co.id/	t	4	2025-10-03 01:16:51	2025-10-04 10:19:34	\N	\N	1	\N
3	ASEAN	https://asean.org/wp-content/uploads/2020/04/cropped-logo-asean-home-4.png	https://asean.org/	t	3	2025-10-03 01:16:51	2025-10-04 10:21:16	\N	\N	1	\N
2	UNDP	https://www.undp.org/sites/g/files/zskgke326/files/2025-04/undp-logo-blue.4f32e17f.svg	https://www.undp.org/indonesia	t	2	2025-10-03 01:16:51	2025-10-04 10:22:12	\N	\N	1	\N
1	InnoGRAPH	https://www.innograph.com/web/image/website/1/logo/Innograph.com?unique=26aab34	https://www.innograph.com/	t	1	2025-10-03 01:16:51	2025-10-04 10:23:23	\N	\N	1	\N
6	Bulog	https://www.bulog.co.id/wp-content/uploads/2025/01/Logo-BULOG_Web-2048x650.png	https://www.bulog.co.id/	t	6	2025-10-04 10:25:13	2025-10-04 10:25:41	\N	1	1	\N
\.


--
-- TOC entry 5126 (class 0 OID 32822)
-- Dependencies: 225
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 5128 (class 0 OID 32829)
-- Dependencies: 227
-- Data for Name: faqs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.faqs (id, question, question_en, answer, answer_en, is_active, sort_order, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at) FROM stdin;
2	Apakah tim kami bisa berkolaborasi dengan tim internal klien?	\N	Tentu. Kami terbiasa bekerja secara kolaboratif lewat sprint mingguan, ritual agile, dan alat komunikasi yang transparan agar tim internal Anda tetap terinformasi.	\N	t	2	\N	\N	\N	2025-10-03 01:16:51	2025-10-03 01:21:42	\N
4	Bagaimana pola kerja dan metode pembiayaan di Digioh?	\N	Kami fleksibel dengan model fixed scope maupun retainer. Setelah discovery selesai, kami serahkan proposal detail lengkap dengan timeline, deliverable, dan estimasi biaya.	\N	t	4	\N	\N	\N	2025-10-03 01:16:51	2025-10-03 01:21:42	\N
1	Berapa lama estimasi pengerjaan satu proyek digital?	\N	Waktu pengerjaan bergantung pada kompleksitas fitur. Rata-rata produk digital MVP kami selesaikan dalam 8-12 minggu termasuk fase discovery, desain, serta pengembangan.	\N	t	1	\N	1	\N	2025-10-03 01:16:51	2025-10-03 17:12:51	\N
3	Layanan purna jual apa saja yang tersedia?	\N	Kami menyediakan support operasional, maintenance, optimalisasi performa, hingga growth marketing untuk produk yang sudah dirilis.\r\n#layanan	\N	t	3	\N	1	\N	2025-10-03 01:16:51	2025-10-03 17:13:18	\N
\.


--
-- TOC entry 5130 (class 0 OID 32837)
-- Dependencies: 229
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 5131 (class 0 OID 32842)
-- Dependencies: 230
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 5133 (class 0 OID 32848)
-- Dependencies: 232
-- Data for Name: media; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.media (id, model_type, model_id, uuid, collection_name, name, file_name, mime_type, disk, conversions_disk, size, manipulations, custom_properties, generated_conversions, responsive_images, order_column, created_at, updated_at) FROM stdin;
2	Modules\\Slider\\Models\\Slider	6	6169a720-51b4-45e2-9aab-1b92804d2953	sliders	Frame-1000010220-e1756451252956	pviE65BqHxd9HLCTJ08Bx6Qm2upKGMpHMVlnpDWc.png	image/png	media	media	1748533	[]	[]	{"thumb300":true}	[]	1	2025-10-03 14:04:29	2025-10-03 14:04:29
\.


--
-- TOC entry 5135 (class 0 OID 32854)
-- Dependencies: 234
-- Data for Name: messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.messages (id, name, email, subject, message, hp, ip, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5137 (class 0 OID 32860)
-- Dependencies: 236
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2024_03_22_233017_add_profile_columns_to_users_table	1
5	2024_03_23_023114_create_permission_tables	1
6	2024_03_23_025255_create_media_table	1
7	2024_03_24_145514_create_settings_table	1
8	2024_03_24_151236_create_notifications_table	1
9	2024_03_24_195455_create_user_providers_table	1
10	2024_03_26_013544_create_activity_log_table	1
11	2024_03_26_013545_add_event_column_to_activity_log_table	1
12	2024_03_26_013546_add_batch_uuid_column_to_activity_log_table	1
13	2024_04_06_020035_create_posts_table	1
14	2024_04_06_031129_create_categories_table	1
15	2024_04_06_033820_create_tags_table	1
16	2024_04_06_154118_create_polymorphic_taggables_table	1
17	2025_09_29_000000_create_messages_table	1
18	2025_09_29_050230_create_ourworks_table	1
19	2025_09_29_084456_create_sliders_table	1
20	2025_09_29_090000_add_userstamps_to_sliders	1
21	2025_09_29_090001_add_userstamps_to_our_works	1
22	2025_09_29_092139_create_portfolios_table	1
23	2025_09_29_093000_add_sort_order_to_posts	1
24	2025_09_29_095530_create_clientlogos_table	1
25	2025_09_29_100000_add_userstamps_to_client_logos	1
26	2025_10_01_000001_create_services_table	2
27	2025_10_01_000100_add_service_id_to_posts_table	2
28	2025_10_01_000200_update_services_add_image_and_featured	2
29	2025_10_01_010000_add_event_fields_to_posts_table	2
30	2025_10_01_020000_add_en_fields_to_services_table	2
31	2025_10_02_030000_create_faqs_table	2
33	2025_10_03_103747_create_stats_table	3
34	2025_10_03_105035_update_stats_table_add_columns	3
\.


--
-- TOC entry 5139 (class 0 OID 32864)
-- Dependencies: 238
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.model_has_permissions (permission_id, model_type, model_id) FROM stdin;
\.


--
-- TOC entry 5140 (class 0 OID 32867)
-- Dependencies: 239
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.model_has_roles (role_id, model_type, model_id) FROM stdin;
1	App\\Models\\User	1
2	App\\Models\\User	2
3	App\\Models\\User	3
4	App\\Models\\User	4
5	App\\Models\\User	5
\.


--
-- TOC entry 5141 (class 0 OID 32870)
-- Dependencies: 240
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5142 (class 0 OID 32875)
-- Dependencies: 241
-- Data for Name: our_works; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.our_works (id, name, slug, icon_class, excerpt, description, featured_on_home, is_active, sort_order, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
2	Aplikasi E-Commerce Modern	aplikasi-e-commerce-modern	\N	Pengembangan platform e-commerce lengkap dengan fitur manajemen produk, pembayaran digital, dan sistem logistik terintegrasi.	<p>Pengembangan platform e-commerce lengkap dengan fitur manajemen produk, pembayaran digital, dan sistem logistik terintegrasi.</p>	t	t	1	2025-10-03 01:20:19	2025-10-03 01:21:42	\N	\N	\N	\N
3	Sistem Manajemen HRD	sistem-manajemen-hrd	\N	Sistem komprehensif untuk manajemen SDM termasuk absensi, cuti, gaji, dan kinerja karyawan.	<p>Sistem komprehensif untuk manajemen SDM termasuk absensi, cuti, gaji, dan kinerja karyawan.</p>	t	t	2	2025-10-03 01:20:19	2025-10-03 01:21:42	\N	\N	\N	\N
4	Platform Pembelajaran Online	platform-pembelajaran-online	\N	Platform LMS untuk institusi pendidikan dengan fitur kelas virtual, ujian online, dan pelacakan kemajuan siswa.	<p>Platform LMS untuk institusi pendidikan dengan fitur kelas virtual, ujian online, dan pelacakan kemajuan siswa.</p>	t	t	3	2025-10-03 01:20:19	2025-10-03 01:21:42	\N	\N	\N	\N
\.


--
-- TOC entry 5144 (class 0 OID 32884)
-- Dependencies: 243
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 5145 (class 0 OID 32887)
-- Dependencies: 244
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
1	view_backend	web	2025-10-02 23:00:06	2025-10-02 23:00:06
2	edit_settings	web	2025-10-02 23:00:06	2025-10-02 23:00:06
3	view_logs	web	2025-10-02 23:00:06	2025-10-02 23:00:06
4	view_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
5	add_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
6	edit_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
7	edit_users_permissions	web	2025-10-02 23:00:06	2025-10-02 23:00:06
8	delete_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
9	restore_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
10	block_users	web	2025-10-02 23:00:06	2025-10-02 23:00:06
11	view_roles	web	2025-10-02 23:00:06	2025-10-02 23:00:06
12	add_roles	web	2025-10-02 23:00:06	2025-10-02 23:00:06
13	edit_roles	web	2025-10-02 23:00:06	2025-10-02 23:00:06
14	delete_roles	web	2025-10-02 23:00:06	2025-10-02 23:00:06
15	restore_roles	web	2025-10-02 23:00:06	2025-10-02 23:00:06
16	view_backups	web	2025-10-02 23:00:07	2025-10-02 23:00:07
17	add_backups	web	2025-10-02 23:00:07	2025-10-02 23:00:07
18	create_backups	web	2025-10-02 23:00:07	2025-10-02 23:00:07
19	download_backups	web	2025-10-02 23:00:07	2025-10-02 23:00:07
20	delete_backups	web	2025-10-02 23:00:07	2025-10-02 23:00:07
21	view_posts	web	2025-10-02 23:00:07	2025-10-02 23:00:07
22	add_posts	web	2025-10-02 23:00:07	2025-10-02 23:00:07
23	edit_posts	web	2025-10-02 23:00:07	2025-10-02 23:00:07
24	delete_posts	web	2025-10-02 23:00:07	2025-10-02 23:00:07
25	restore_posts	web	2025-10-02 23:00:07	2025-10-02 23:00:07
26	view_categories	web	2025-10-02 23:00:07	2025-10-02 23:00:07
27	add_categories	web	2025-10-02 23:00:07	2025-10-02 23:00:07
28	edit_categories	web	2025-10-02 23:00:07	2025-10-02 23:00:07
29	delete_categories	web	2025-10-02 23:00:07	2025-10-02 23:00:07
30	restore_categories	web	2025-10-02 23:00:07	2025-10-02 23:00:07
31	view_tags	web	2025-10-02 23:00:07	2025-10-02 23:00:07
32	add_tags	web	2025-10-02 23:00:07	2025-10-02 23:00:07
33	edit_tags	web	2025-10-02 23:00:07	2025-10-02 23:00:07
34	delete_tags	web	2025-10-02 23:00:07	2025-10-02 23:00:07
35	restore_tags	web	2025-10-02 23:00:07	2025-10-02 23:00:07
36	view_comments	web	2025-10-02 23:00:07	2025-10-02 23:00:07
37	add_comments	web	2025-10-02 23:00:07	2025-10-02 23:00:07
38	edit_comments	web	2025-10-02 23:00:07	2025-10-02 23:00:07
39	delete_comments	web	2025-10-02 23:00:07	2025-10-02 23:00:07
40	restore_comments	web	2025-10-02 23:00:07	2025-10-02 23:00:07
41	view_sliders	web	2025-10-03 14:57:50	2025-10-03 14:57:50
42	add_sliders	web	2025-10-03 14:57:50	2025-10-03 14:57:50
43	edit_sliders	web	2025-10-03 14:57:50	2025-10-03 14:57:50
44	delete_sliders	web	2025-10-03 14:57:50	2025-10-03 14:57:50
45	restore_sliders	web	2025-10-03 14:57:50	2025-10-03 14:57:50
46	view_clientlogos	web	2025-10-03 14:57:50	2025-10-03 14:57:50
47	add_clientlogos	web	2025-10-03 14:57:50	2025-10-03 14:57:50
48	edit_clientlogos	web	2025-10-03 14:57:50	2025-10-03 14:57:50
49	delete_clientlogos	web	2025-10-03 14:57:50	2025-10-03 14:57:50
50	restore_clientlogos	web	2025-10-03 14:57:50	2025-10-03 14:57:50
\.


--
-- TOC entry 5147 (class 0 OID 32891)
-- Dependencies: 246
-- Data for Name: portfolios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.portfolios (id, name, slug, note, status, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at) FROM stdin;
\.


--
-- TOC entry 5149 (class 0 OID 32898)
-- Dependencies: 248
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.posts (id, name, slug, intro, content, type, category_id, category_name, is_featured, image, meta_title, meta_keywords, meta_description, meta_og_image, meta_og_url, hits, "order", status, moderated_by, moderated_at, created_by, created_by_name, created_by_alias, updated_by, deleted_by, published_at, created_at, updated_at, deleted_at, sort_order, service_id, event_start_date, event_end_date, event_location) FROM stdin;
2	Pentingnya UX dalam Desain Produk Digital	pentingnya-ux-dalam-desain-produk	Mengapa pengalaman pengguna menjadi faktor kunci dalam kesuksesan produk digital.	<p>Desain pengalaman pengguna (UX) bukan hanya tentang tampilan yang menarik, tetapi juga tentang kemudahan penggunaan dan kepuasan pengguna dalam berinteraksi dengan produk digital.</p>	\N	\N	\N	1	img/posts/ux-design.jpg	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N	\N	1	1	2025-09-28 01:21:42	2025-10-03 01:21:42	2025-10-03 10:16:13	2025-10-03 10:16:13	2	\N	\N	\N	\N
1	Strategi Digital untuk Bisnis UMKM di Era Modern	strategi-digital-bisnis-umkm	Panduan praktis untuk UMKM mengadopsi teknologi dalam operasional bisnis sehari-hari.	<p>Bisnis UMKM saat ini dihadapkan pada tantangan untuk tetap kompetitif di era digital. Artikel ini membahas strategi implementasi teknologi yang efektif dan terjangkau.</p>	\N	\N	\N	1	img/posts/digital-strategy.jpg	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N	\N	1	1	2025-10-01 01:21:42	2025-10-03 01:21:42	2025-10-03 10:16:18	2025-10-03 10:16:18	1	\N	\N	\N	\N
3	Tren Teknologi yang Membentuk Masa Depan Bisnis	tren-teknologi-masa-depan-bisnis	Tinjauan terhadap teknologi-teknologi terkini yang akan mengubah lanskap bisnis.	<p>Artificial Intelligence, Internet of Things, dan teknologi blockchain adalah beberapa tren yang akan menentukan masa depan bisnis di Indonesia dan dunia.</p>	\N	\N	\N	1	img/posts/tech-trends.jpg	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N	\N	1	1	2025-09-25 01:21:42	2025-10-03 01:21:42	2025-10-03 10:16:25	2025-10-03 10:16:25	3	\N	\N	\N	\N
4	Commodi aut veritatis in aut	commodi-aut-veritatis-in-aut	Eos voluptas et doloremque minus quasi eius et. Culpa voluptatem totam quis ab nihil. Eos pariatur qui unde aut. Labore in alias fugit non aperiam.	Vel esse sed neque veritatis eos. Qui porro dolorem quia enim accusamus. Ut dolor voluptatem nisi fugiat.\n\nOmnis nihil amet et delectus. Accusamus voluptates fugiat delectus excepturi sapiente deleniti. Placeat ab repellat commodi ut ipsam sed eos dolores. Et voluptatum ea numquam consequatur deleniti.\n\nQui sint sit minus in quo ea eveniet. Autem doloremque porro nam.\n\nVelit blanditiis enim similique est exercitationem dolore voluptates. Veritatis nihil possimus et consequuntur sit quibusdam earum. Ea ut ducimus vel qui.\n\nDelectus quis rem amet animi perferendis. Ut corporis voluptatem esse est est. Quo soluta qui rerum ea culpa non. Sunt eum quia voluptas culpa vero explicabo non.	Feature	5	\N	1	https://picsum.photos/1200/630?random=41	Commodi aut veritatis in aut			https://picsum.photos/1200/630?random=41		0	\N	Unpublished	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:57:49	2025-10-03 14:57:50	2025-10-03 14:57:49	\N	0	\N	\N	\N	\N
5	Porro eum unde rerum ut	porro-eum-unde-rerum-ut	Non accusamus in voluptatem reiciendis labore vero. Temporibus illum repellat provident culpa quos. Aut cupiditate fugit accusamus dolores et facilis. Voluptate doloremque quia adipisci illum. Suscipit omnis et nemo quia.	Praesentium corrupti aspernatur non et quibusdam sunt magni. Labore illum ducimus commodi aut nisi aspernatur. Aspernatur repellendus quibusdam incidunt minus impedit et.\n\nVoluptas in ab adipisci sed sequi. Libero autem voluptatem eos voluptatem. Repellendus nemo earum sed ut. Dolorum qui et molestias qui cumque mollitia. Explicabo inventore vel ipsa vel.\n\nCorrupti doloremque enim delectus alias consequatur molestiae. Dolor ratione id in earum sunt ut. Aut quo quo impedit. Sit sint voluptas ut qui.\n\nEsse eos rerum consequatur recusandae praesentium. Deleniti non adipisci modi dolore atque deleniti. Quas voluptas alias ad magni quasi laudantium. Qui rerum et sint deleniti eum quaerat repellat.\n\nSed delectus voluptas esse aliquam. Enim quaerat placeat fuga dolor unde nesciunt. Ab possimus quod blanditiis aut. Ipsum et debitis voluptatem labore.\n\nRerum dicta voluptas optio possimus ut consectetur consequatur. Necessitatibus nihil optio modi illum ut. Et odio ut blanditiis sit vel quod ut.	News	4	\N	1	https://picsum.photos/1200/630?random=8	Porro eum unde rerum ut			https://picsum.photos/1200/630?random=8		0	\N	Draft	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	2025-10-03 14:57:50	\N	0	\N	\N	\N	\N
6	Inventore quia libero vel id	inventore-quia-libero-vel-id	Ducimus ut sit iste quis perferendis quod et. Vel dolorum animi laudantium vero debitis. Assumenda beatae optio harum et. Non adipisci accusamus incidunt quas suscipit.	Amet enim tenetur voluptatem nisi est tenetur optio. Molestiae quae et aliquam similique eligendi molestiae. Impedit quam dolorum delectus.\n\nAssumenda aut cum qui quam corporis dolor et. Excepturi vel facere odit porro est. Dolorem laboriosam cum earum impedit. Sit minus ut omnis delectus ut nostrum placeat. Dolorem autem sit eligendi voluptatem ipsam natus voluptas.\n\nArchitecto numquam voluptates reiciendis aut. Consequatur nostrum odio reiciendis commodi id repudiandae dolore. Quibusdam et illum dolores asperiores doloribus. Cum quibusdam similique et et explicabo illo.\n\nNostrum quia soluta id facere quam possimus. Quis odio ut et omnis exercitationem architecto recusandae. Qui blanditiis dolor temporibus eum velit eveniet possimus. Voluptatem corrupti officia ipsa saepe perspiciatis ut.\n\nSunt ea at tempore placeat quo totam dolores. Autem est dicta atque sit. Excepturi molestiae omnis sunt omnis omnis dignissimos voluptatem.	News	1	\N	1	https://picsum.photos/1200/630?random=49	Inventore quia libero vel id			https://picsum.photos/1200/630?random=49		0	\N	Unpublished	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	2025-10-03 14:57:50	\N	0	\N	\N	\N	\N
7	Animi dicta sunt dolores et	animi-dicta-sunt-dolores-et	Saepe molestias hic mollitia nostrum. Et voluptatem magnam alias facere doloribus harum.	Voluptate inventore explicabo vitae corporis. Corporis ut repellendus ut repudiandae asperiores in iure. Sunt est consequatur vel consequatur asperiores in. Voluptas modi perspiciatis accusantium. Dignissimos similique voluptatem molestiae hic natus consequatur sed.\n\nEx delectus deserunt saepe voluptates atque. Aliquid laboriosam voluptatibus rerum nesciunt recusandae non ea.\n\nSed architecto omnis eos veritatis sed repudiandae accusantium. Sint fugit maxime perferendis quia maiores aut. Laudantium in voluptatem natus aut.\n\nVoluptates quod atque repudiandae ducimus debitis assumenda ea. Veniam quisquam labore error modi laborum. Assumenda porro asperiores quae laboriosam architecto et totam.\n\nOdit ea nam voluptatem. Debitis molestiae ut ut voluptatem sed facere. Quis neque blanditiis dolorum necessitatibus officiis itaque. Unde esse eaque quidem et a.\n\nQuo eaque quas harum dolor velit nam eos. Distinctio quod quia aperiam possimus. Dicta eius maxime voluptatum rerum. Ut dolor impedit provident id. Beatae exercitationem tempore aspernatur aut.\n\nAut dolorum dolorum reprehenderit id recusandae. Et nostrum repellendus assumenda reiciendis quasi. Et qui tenetur unde vero dolore.	Feature	4	\N	1	https://picsum.photos/1200/630?random=4	Animi dicta sunt dolores et			https://picsum.photos/1200/630?random=4		0	\N	Published	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	2025-10-03 14:57:50	\N	0	\N	\N	\N	\N
8	Asperiores non possimus est	asperiores-non-possimus-est	Minima voluptates voluptate tempore et excepturi molestias. Autem voluptas ex at et eum quam. Rerum nihil minus dolore ex et sunt praesentium id. Consequatur praesentium voluptatem et quidem.	Accusamus quisquam quis veritatis nihil nihil ipsa commodi. Delectus corporis culpa deleniti iusto omnis. Aut in est impedit doloremque eveniet quia. Pariatur at iure ut laboriosam est et.\n\nEx et sint minus dolores quia ea. Corrupti in et odit placeat mollitia accusamus quas. Velit alias earum ea itaque qui occaecati cupiditate. Consequuntur omnis odit voluptates porro vitae ut enim ad. Ut et dolor et iure.\n\nIpsam voluptatibus et amet corporis. Aut vel qui nulla consequatur architecto aperiam ad. Rerum culpa eos consequuntur consectetur saepe temporibus eveniet qui.\n\nCorrupti aut est enim ut. Beatae sequi vitae saepe et sunt. Non iste inventore provident nobis et ad. Quidem quisquam ipsum sapiente praesentium facere.\n\nQuia rerum quasi commodi hic officia rerum cupiditate. Dolor ut sit iure.\n\nEt ab similique molestiae. Animi iure rerum cum sit ratione est. Omnis quia sed enim sit aliquid.\n\nPraesentium similique reprehenderit aspernatur dolor minus qui. Et iste dolores dolorum illum. Possimus et est commodi. Inventore doloribus et quia repellendus.	Feature	4	\N	0	https://picsum.photos/1200/630?random=18	Asperiores non possimus est			https://picsum.photos/1200/630?random=18		0	\N	Published	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	2025-10-03 14:57:50	\N	0	\N	\N	\N	\N
10	Error sit distinctio esse id	error-sit-distinctio-esse-id	Saepe ex ex dicta sit minus vel aspernatur. Molestias debitis neque laboriosam enim ut sunt.	Saepe dolor voluptatem neque est. Et aut hic ut voluptas nulla. Quod qui blanditiis modi distinctio quia.\n\nOccaecati cum vel omnis quo quos veritatis. Vero dolores voluptatem modi provident cum nam. Repellendus in dolores et impedit non magnam. Laudantium veritatis illo fuga ex.\n\nMaiores quae a ut quibusdam. Esse omnis ipsam et quos.\n\nQuod veritatis ullam nihil eveniet earum rerum aut. Quo quae voluptatem tempore fugiat quisquam. Ea rem a amet rerum similique odit quaerat.\n\nAt libero similique laboriosam quas voluptatibus sit. Consectetur in ex nostrum voluptatibus natus voluptas blanditiis. Similique excepturi maiores beatae. Reiciendis ut modi quam ad ex officiis tempore.	News	4	Aliquam esse	0	https://picsum.photos/1200/630?random=25	Error sit distinctio esse id			https://picsum.photos/1200/630?random=25		0	\N	Unpublished	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	2025-10-03 14:59:28	\N	0	\N	\N	\N	\N
12	Cum ea et repellendus	cum-ea-et-repellendus	Omnis eum eligendi dolorem nulla dicta in at inventore. Saepe et ut aliquam nihil. Velit vero accusamus delectus corrupti dolores.	Consequatur fugit cum praesentium earum non molestiae modi. Voluptatum perferendis repudiandae odit aut provident. Sed ut placeat illo sint error perferendis. Et omnis aut ipsam repellat eius rerum.\n\nDolores eos non porro architecto voluptatem quia laudantium. Blanditiis nostrum ut molestias necessitatibus tempora voluptas et. Ipsa consequuntur qui id iure mollitia explicabo sed nobis.\n\nDebitis ratione occaecati ratione quae corporis fugiat numquam. Eius architecto voluptates nisi dolorem. Amet nostrum vero voluptatem voluptate ut accusantium.\n\nSed veniam ea illo et velit et ut. Voluptas eveniet eos in rerum repellendus tempore. Totam autem eligendi molestias. Hic tempore quae quae commodi sed id.\n\nQuibusdam dignissimos quia et molestias quo voluptatem cumque provident. Eveniet iure cupiditate nulla non cumque consequatur ipsum. Dolores voluptatibus voluptate ab perspiciatis similique. Voluptas fugiat architecto neque id ratione ut alias eos.	News	2	Cum ipsam	0	https://picsum.photos/1200/630?random=23	Cum ea et repellendus			https://picsum.photos/1200/630?random=23		0	\N	Draft	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	2025-10-03 14:59:28	\N	0	\N	\N	\N	\N
13	Ab sint beatae nemo rerum	ab-sint-beatae-nemo-rerum	Nemo rerum molestiae aperiam labore dolor. Et maxime dolore eveniet recusandae. Rerum quasi a quisquam omnis consectetur consequuntur quia dolores. Deleniti atque rerum quidem dolor eos voluptatum accusamus.	Et ullam iusto facere et. Est voluptatem qui sed. Dolorem natus architecto voluptatem aperiam incidunt ullam.\n\nExercitationem sapiente voluptatum qui sit. Assumenda ut magni vitae dicta facere et tenetur. Deleniti mollitia non ipsa praesentium. Molestias voluptates ex eaque nulla et. Quam nostrum tempore nihil sed earum.\n\nVeniam error eum dignissimos debitis sed tempora vel. Qui quae quis et nostrum. Odit dolor deserunt dolorem perferendis.\n\nNecessitatibus sed qui laboriosam error distinctio excepturi nostrum. Corporis natus impedit nostrum modi. Reprehenderit nemo est consequuntur odit unde.\n\nCommodi doloremque est aliquid molestiae. Incidunt doloribus ea consequatur qui ut sint ipsa. Ea rerum possimus amet earum cumque. Quia nobis vel repellendus atque. Quas magnam natus voluptates dolorum velit distinctio.	Article	4	Aliquam esse	0	https://picsum.photos/1200/630?random=30	Ab sint beatae nemo rerum			https://picsum.photos/1200/630?random=30		0	\N	Published	\N	\N	\N	System	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	2025-10-03 14:59:28	\N	0	\N	\N	\N	\N
9	ASEAN DAY	asean-day	HUT ASEAN	ASEAN DAY	Article	5	Dolorem ea	1	http://172.6.7.253/wp-content/uploads/2016/09/STV04521-scaled-e1756714572833.jpg	Ea aut rerum et impedit sunt			https://picsum.photos/1200/630?random=14		1	\N	Published	\N	\N	\N	System	\N	1	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	2025-10-03 19:26:54	\N	0	4	2025-09-19 20:26:00	2025-10-03 20:26:00	ASEAN SEKRETARIAT
15	Inventore et quos ad sed	inventore-et-quos-ad-sed	Provident accusantium tenetur perferendis sed suscipit. Et beatae in accusantium est. Nesciunt sequi voluptatem beatae laudantium non ad.	Dolorum alias atque autem aut. Enim accusantium vel eos alias ipsam.\n\nConsequatur repellendus omnis aut nostrum. Unde velit consequatur qui aliquid. Officiis dolorem ipsa qui repudiandae sed recusandae in aliquam. At doloribus perferendis non tempora asperiores maxime. Autem ut tempora hic rerum.\n\nNihil quod repudiandae ea rerum fuga laboriosam et dolor. Perferendis sint consectetur illo ut consequatur. Temporibus voluptatem unde voluptate aut ducimus. Facilis rerum ut aut quidem et.\n\nQuam repellat dicta eveniet aut illo hic ex. Enim voluptatem iste iste velit. Amet est mollitia voluptatem quasi nam dolorem. Dolorem perspiciatis rerum nulla.\n\nMinima et perspiciatis et laudantium molestiae laudantium. Voluptatem mollitia ut ex nemo dolor. Saepe ipsum iusto unde cupiditate tenetur ratione. Ipsum laborum ea inventore cumque nisi alias dolorem occaecati. Nihil et amet velit labore explicabo.\n\nEt voluptas et sunt vero aut. Fugit sit ab perferendis quis qui ut sit. Reprehenderit quis et numquam omnis minima et. Consequatur esse magni iure occaecati et quas.\n\nQuidem delectus optio officia neque sit sint ex. Omnis quo eos dolores impedit odio aut reiciendis. Ut in et quo quis consequatur modi. Labore omnis sunt amet error.	Feature	1	Dicta nihil	0	https://picsum.photos/1200/630?random=17	Inventore et quos ad sed			https://picsum.photos/1200/630?random=17		0	\N	Unpublished	\N	\N	\N	System	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	2025-10-03 17:57:27	\N	0	\N	\N	\N	\N
16	Est ducimus accusamus omnis	est-ducimus-accusamus-omnis	Sit totam dolores earum quis impedit. Consequatur aut repudiandae modi cupiditate ea. Hic nemo tenetur porro voluptatum ut quae consequuntur. Dolorem ex sit rem minus.	Ut magni ut suscipit nesciunt et natus esse. Minima ad deleniti architecto illum ducimus ut ipsam voluptatem. Dicta veritatis temporibus ab consequatur qui dolorem fugiat ut. Libero corrupti reiciendis rerum facilis velit.\n\nDolore qui minima quo consequatur vitae quia. Voluptatum enim molestias omnis aperiam. Inventore officiis consequatur commodi.\n\nSed ad laboriosam minus modi mollitia dicta. Non esse dolorum recusandae doloremque commodi.\n\nAut qui quos aliquam non. Nulla omnis eius rerum non autem. Laborum culpa pariatur perspiciatis facilis vel et.\n\nDelectus vitae et autem dolores distinctio molestias aut. Dignissimos et et nisi voluptatem incidunt cupiditate in. Est eos deleniti inventore eos saepe facilis. Aut velit fugiat est molestiae dolorem odit voluptas.	Article	2	Cum ipsam	1	https://picsum.photos/1200/630?random=48	Est ducimus accusamus omnis			https://picsum.photos/1200/630?random=48		0	\N	Draft	\N	\N	\N	System	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	2025-10-03 17:57:27	\N	0	\N	\N	\N	\N
19	BNI wondrX	bni-wondrx	ICE BSD	BNI	\N	\N	\N	1	http://172.6.7.253/wp-content/uploads/2016/09/BNI-wondrX-scaled-e1756711869168.jpg	\N	\N	\N	\N	\N	0	\N	Published	\N	\N	1	Super Admin	\N	1	\N	2025-10-03 20:21:00	2025-10-03 19:21:45	2025-10-03 19:21:45	\N	0	5	2025-08-17 20:21:00	2025-10-15 20:21:00	ICE BSD
17	Hic et aliquam sed qui	hic-et-aliquam-sed-qui	Ducimus ut temporibus fuga nihil eos tenetur. Quia recusandae at sunt similique. Fugiat quia vitae excepturi labore repellendus blanditiis. Facilis voluptas sint culpa ipsa laboriosam odit ut.	Voluptates dolorum sit porro maxime qui blanditiis error. Maiores quae non iure et voluptatem similique quisquam. Dolor aut eaque ea aliquam ex qui dolorem. Sed esse saepe molestias aut. Eos accusamus omnis quas inventore.\n\nEt harum odio sit ipsum et nihil eum. Totam dolorem fuga numquam unde est. Praesentium excepturi quis illum fugiat sed. Natus incidunt minus ipsum quia.\n\nQuia et ipsum dolor consequuntur vero voluptatem. Optio voluptas vel expedita deleniti necessitatibus delectus sit. Odit sit esse sed odio velit quaerat. Ipsa rerum dolores et quia.\n\nEt nostrum quae commodi voluptas. Et doloribus veritatis similique placeat placeat. Iure modi voluptatibus quaerat reprehenderit. Est esse sequi fuga adipisci quis.\n\nDolor excepturi nobis blanditiis harum. Veritatis odio quae illo eos. Tempora impedit deleniti ut provident. Magnam animi qui ab non aut autem voluptatem.\n\nNulla consequatur delectus fugit non fugit debitis aut ipsa. Neque voluptatem ab impedit voluptatem quam sint eius. At tempora amet aliquam soluta soluta. Excepturi sapiente asperiores enim eligendi accusamus.	News	3	Qui impedit	1	https://picsum.photos/1200/630?random=30	Hic et aliquam sed qui			https://picsum.photos/1200/630?random=30		0	\N	Unpublished	\N	\N	\N	System	\N	1	1	2025-10-03 17:57:27	2025-10-03 17:57:27	2025-10-03 19:22:02	2025-10-03 19:22:02	0	\N	\N	\N	\N
18	Quas minus accusamus amet	quas-minus-accusamus-amet	Aut in ut ducimus. Consequuntur quae magni molestiae hic ut. Eligendi rerum enim voluptas adipisci qui qui necessitatibus. Illo est quas qui dolorem quo.	Ut repellendus quibusdam et quisquam quis totam. Molestiae nam commodi provident quae quas voluptatum. Odit et inventore quae voluptatem omnis commodi qui.\n\nSimilique dicta ullam cumque minima. Cupiditate est sed itaque voluptas repellat est. Repellendus odio enim voluptas sit expedita odio quae architecto.\n\nEst dolores nobis modi reprehenderit sequi cum. Doloribus rerum eligendi ratione eligendi. Voluptas distinctio et aut voluptatem.\n\nEt debitis est placeat et illum ad et. Blanditiis nemo vero corrupti eveniet dicta harum expedita quia. Atque et dolores tempora quia explicabo sed. Iure sed aliquam incidunt et perspiciatis.\n\nLaudantium voluptate et consectetur sunt exercitationem. Maxime similique sunt repudiandae est unde minima fuga. Nesciunt dolores dolorem id iusto quis dolor et.\n\nError consectetur architecto et illum odio. Sint facilis inventore tempora sunt officiis aut corporis.	Feature	2	Cum ipsam	1	https://picsum.photos/1200/630?random=28	Quas minus accusamus amet			https://picsum.photos/1200/630?random=28		0	\N	Draft	\N	\N	\N	System	\N	1	1	2025-10-03 17:57:27	2025-10-03 17:57:27	2025-10-03 19:21:55	2025-10-03 19:21:55	0	\N	\N	\N	\N
14	BNI wondrX	bni-wondrx	BNI	BNI	Feature	4	Aliquam esse	1	http://172.6.7.253/wp-content/uploads/2016/09/BNI-wondrX-scaled-e1756711869168.jpg	Aut eum nisi sunt numquam			https://picsum.photos/1200/630?random=11		2	\N	Published	\N	\N	\N	System	\N	1	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	2025-10-04 08:56:04	\N	0	5	2025-08-15 20:23:00	2025-08-17 20:23:00	ICE BSD
11	KAFEGAMA PELUNCURAN BUKU	kafegama-peluncuran-buku	1 BUKU atau 2 BUKU	TAU INFO DARIMANA	Article	2	Cum ipsam	1	http://172.6.7.253/wp-content/uploads/2016/09/KAFEGAMA-PELUNCURAN-scaled-e1756713184581.jpg	Aut ad quos vitae est			https://picsum.photos/1200/630?random=44		1	\N	Published	\N	\N	\N	System	\N	1	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	2025-10-04 08:56:12	\N	0	3	\N	\N	MM UGM
\.


--
-- TOC entry 5151 (class 0 OID 32907)
-- Dependencies: 250
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.role_has_permissions (permission_id, role_id) FROM stdin;
1	2
2	2
1	3
1	4
41	2
42	2
43	2
44	2
45	2
46	2
47	2
48	2
49	2
50	2
\.


--
-- TOC entry 5152 (class 0 OID 32910)
-- Dependencies: 251
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.roles (id, name, guard_name, created_at, updated_at) FROM stdin;
1	super admin	web	2025-10-02 23:00:07	2025-10-02 23:00:07
2	administrator	web	2025-10-02 23:00:07	2025-10-02 23:00:07
3	manager	web	2025-10-02 23:00:07	2025-10-02 23:00:07
4	executive	web	2025-10-02 23:00:07	2025-10-02 23:00:07
5	user	web	2025-10-02 23:00:07	2025-10-02 23:00:07
\.


--
-- TOC entry 5154 (class 0 OID 32914)
-- Dependencies: 253
-- Data for Name: services; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.services (id, name, slug, description, icon, is_active, sort_order, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at, image, featured_on_home, name_en, description_en) FROM stdin;
1	digiSELFIE Photobooth	digiselfie-photobooth	Looking for a 'kekinian' photobooth?\r\ndigiSELFIE is the answer!\r\nGet the best experience photobooth solution from one of the pioneer in Indonesia!	\N	t	0	1	1	\N	2025-10-02 23:50:47	2025-10-02 23:50:47	\N	/storage/uploads/services/QkQo7VNjIrbaxl8n6pZp4UhN2udxV0GpHLYOySF8.jpg	t	\N	\N
2	LCD Totem & Touch Screen	lcd-totem-&-touch-screen	Slides your hundreds photo and videos with the best digital signage display. Get our most rented products to make your event perfect!\r\n*Touch screen ready	\N	t	0	1	1	\N	2025-10-03 00:39:19	2025-10-03 00:39:19	\N	/storage/uploads/services/29J8vt2WZSJt2gWcuyE6Ifk1Mefh5VIqkRFolPqG.png	t	\N	\N
3	Strategi Digital & Discovery	\N	Kami bekerja bersama Anda untuk memahami kebutuhan bisnis dan menyusun roadmap produk yang realistis serta terukur.	<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 015.273-3.12c.37-.08.63-.391.63-.772V4.5a.75.75 0 01.75-.75A2.25 2.25 0 0118 6v2.25c0 .621.504 1.125 1.125 1.125h1.006c1.026 0 1.945.694 2.054 1.715a9.03 9.03 0 01-.972 5.186M6.633 10.5a2.25 2.25 0 10-3.633 2.769 8.966 8.966 0 00.614 5.093c.16.363.502.588.889.588H9.75A2.25 2.25 0 0012 16.5v-1.125c0-.621-.504-1.125-1.125-1.125h-.642c-.598 0-1.05-.533-.879-1.11a9.04 9.04 0 011.493-2.88M6.633 10.5a9.06 9.06 0 011.74 4.5"/></svg>	t	1	\N	1	1	2025-10-03 01:16:51	2025-10-03 19:27:45	2025-10-03 19:27:45	img/services/strategy.jpg	t	Digital Strategy & Discovery	We work together with you to understand business needs and develop a realistic and measurable product roadmap.
4	Desain Experience & Branding	\N	Tim UI/UX kami membangun tampilan yang elegan dan mudah digunakan, lengkap dengan guideline merek yang konsisten di semua saluran.	<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 017.5 15.75m11.85-5.603a60.436 60.436 0 01.491 6.347 48.623 48.623 0 00-3.572-2.804M7.5 15.75l2.25-1.5m6.75 0l-2.25-1.5m-2.25 1.5l.36-.24c.284-.19.426-.285.426-.41 0-.125-.142-.22-.426-.41L12 12.75m0 2.25l-.36.24c-.284.19-.426.285-.426.41 0 .125.142.22.426.41l.36.24m0-1.3l2.25-1.5m-2.25 1.5l-2.25-1.5M7.5 19.5l3.75-2.5m5.25 0l-3.75 2.5M3 9.75c2.347-1.718 5.16-2.75 9-2.75s6.653 1.032 9 2.75M3 9.75C4.89 11.737 8.247 12.75 12 12.75s7.11-1.013 9-3M3 9.75A49.087 49.087 0 0112 9c3.328 0 6.165.3 9 .75"/></svg>	t	2	\N	\N	\N	2025-10-03 01:16:51	2025-10-03 01:21:42	\N	img/services/design.jpg	t	Experience Design & Branding	Our UI/UX team builds elegant and user-friendly interfaces, complete with consistent brand guidelines across all channels.
5	Pengembangan Produk End-to-End	\N	Kami membangun aplikasi web maupun mobile yang skalabel dengan praktik engineering modern, CI/CD, dan pengujian menyeluruh.	<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 8.25V6zM13.5 6A2.25 2.25 0 0115.75 3.75H18a2.25 2.25 0 012.25 2.25v2.25A2.25 2.25 0 0118 10.5h-2.25A2.25 2.25 0 0113.5 8.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0112.5 20.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 15.75A2.25 2.25 0 0115.75 13.5H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>	t	3	\N	\N	\N	2025-10-03 01:16:51	2025-10-03 01:21:42	\N	img/services/development.jpg	t	End-to-End Product Development	We build scalable web and mobile applications with modern engineering practices, CI/CD, and comprehensive testing.
6	Optimalisasi & Growth Marketing	\N	Kami mendukung peluncuran dan pengembangan produk melalui analitik, eksperimen, dan kampanye digital yang terukur.	<svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l7.5 7.5V13.5H3zM3 10.5h7.5V3L3 10.5zm10.5 0H21L13.5 3v7.5zm0 3H21l-7.5 7.5V13.5z"/></svg>	t	4	\N	1	1	2025-10-03 01:16:51	2025-10-03 19:27:40	2025-10-03 19:27:40	img/services/marketing.jpg	t	Optimization & Growth Marketing	We support product launches and growth through analytics, experiments, and measurable digital campaigns.
\.


--
-- TOC entry 5156 (class 0 OID 32923)
-- Dependencies: 255
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- TOC entry 5157 (class 0 OID 32928)
-- Dependencies: 256
-- Data for Name: settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.settings (id, name, val, type, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at) FROM stdin;
4	show_copyright	1	text                	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
5	email	dukunganteknis@digioh.com	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
6	website_url	https://digioh.id	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
7	facebook_url	https://www.facebook.com/digiframebiz	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
8	twitter_url	https://twitter.com/digioh_id	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
9	instagram_url	https://www.instagram.com/digioh.id	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
10	youtube_url	https://www.youtube.com/@digioh8450	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
11	linkedin_url	https://www.linkedin.com/company/digital-open-house/	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
12	whatsapp_url	#	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
13	messenger_url	#	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
14	about_title	Tentang DigiOH	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
16	about_title_en	About DigiOH	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
18	about_image	img/DIGIOH_Logomark.png	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
19	about_founder_1_name	John Doe	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
20	about_founder_1_title	Chief Executive Officer	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
21	about_founder_1_photo	img/avatar-1.png	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
22	about_founder_1_linkedin	#	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
23	about_founder_2_name	Jane Smith	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
24	about_founder_2_title	Chief Operating Officer	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
25	about_founder_2_photo	img/avatar-2.png	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
26	about_founder_2_linkedin	#	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
27	about_founder_3_name	Alex Lee	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
28	about_founder_3_title	Chief Technology Officer	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
29	about_founder_3_photo	img/avatar-3.png	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
30	about_founder_3_linkedin	#	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
31	meta_site_name	DigiOH | Digital Studio Indonesia	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
33	meta_keyword	Digital Studio, Web Development, Mobile App, UI/UX Design, Digital Marketing, DigiOH, Indonesia, Jakarta	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
34	meta_image	img/default_banner.jpg	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
35	meta_fb_app_id	569561286532601	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
36	meta_twitter_site	@digioh_id	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
37	meta_twitter_creator	@digioh_id	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
38	google_analytics	G-ABCDE12345	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
39	custom_css_block	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
40	contact_email	dukunganteknis@digioh.com	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
41	whatsapp_number	6281284717402	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
42	whatsapp_prefill	Halo saya (nama), salam kenal. Saya baru saja mengunjungi website Anda. Apakah bisa dibantu lebih lanjut untuk kebutuhan acara ?	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
43	contact_address	Fatmawati Festival Blok A-7, Jalan RS Fatmawati no. 50 Seberang Rumah Duka Fatmawati, Jl. RS. Fatmawati Raya No.50, RT.4/RW.4, West Cilandak, Cilandak, South Jakarta City, Jakarta 12430	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
45	home_services_heading_en	We help companies design, build, and grow end-to-end digital products.	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
46	home_services_heading	Kami membantu perusahaan merancang, membangun, dan mengembangkan produk digital end-to-end.	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
47	home_show_portfolio	0	boolean             	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
48	home_service_1_title_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
49	home_service_1_description_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
50	home_service_2_title_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
51	home_service_2_description_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
52	home_service_3_title_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
53	home_service_3_description_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
54	home_service_4_title_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
55	home_service_4_description_en	\N	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
56	instagram_section_enabled	1	boolean             	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
57	instagram_section_title	Lihat Aktivitas Kami di Instagram	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
58	instagram_section_title_en	See Our Activities on Instagram	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
64	instagram_profile_url	https://www.instagram.com/digioh.id	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
65	instagram_cta_text	Ikuti kami di Instagram	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
66	instagram_cta_text_en	Follow us on Instagram	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
3	footer_text	<a href="https://digioh.id" class="text-muted">Built with ♥ by DigiOH</a>	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
1	app_name	DigiOH	string              	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
2	app_description	DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi modern.	text                	1	1	\N	2025-10-03 00:07:34	2025-10-04 10:14:25	\N
15	about_body	<p>DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi.</p><ul><li>Strategi & Konsultasi</li><li>Desain & Pengembangan</li><li>Pemasaran & Pertumbuhan</li></ul>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
17	about_body_en	<p>DigiOH is a digital studio helping brands grow through creative solutions and technology.</p><ul><li>Strategy & Consulting</li><li>Design & Development</li><li>Marketing & Growth</li></ul>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:25	\N
32	meta_description	DigiOH adalah studio digital yang membantu brand tumbuh melalui solusi kreatif dan teknologi. Kami menyediakan layanan desain, pengembangan, dan pemasaran digital.	text                	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
44	contact_map_embed	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.745392983338!2d106.79147507503836!3d-6.297151293691941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ee5af21ba50f%3A0x73accc0cd6192cc7!2sdigiOH!5e0!3m2!1sen!2sid!4v1759433296026!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
59	instagram_section_subtitle	Ikuti perjalanan kreatif kami dan lihat behind-the-scenes dari berbagai proyek yang sedang kami kerjakan.	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
60	instagram_section_subtitle_en	Follow our creative journey and see behind-the-scenes from various projects we are working on.	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
61	instagram_embed_1	<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DKgQ-X7zKpT/?utm_source=ig_embed&utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DKgQ-X7zKpT/?utm_source=ig_embed&utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DKgQ-X7zKpT/?utm_source=ig_embed&utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by PT DIGIOH | HYBRID EVENT ORGANIZER (@digioh.id)</a></p></div></blockquote>\r\n<script async src="//www.instagram.com/embed.js"></script>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
62	instagram_embed_2	<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DNzZXBw5mOI/?utm_source=ig_embed&utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DNzZXBw5mOI/?utm_source=ig_embed&utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DNzZXBw5mOI/?utm_source=ig_embed&utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by PT DIGIOH | HYBRID EVENT ORGANIZER (@digioh.id)</a></p></div></blockquote>\r\n<script async src="//www.instagram.com/embed.js"></script>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
63	instagram_embed_3	<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DO5Uf-9Ez_O/?utm_source=ig_embed&utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/reel/DO5Uf-9Ez_O/?utm_source=ig_embed&utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DO5Uf-9Ez_O/?utm_source=ig_embed&utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by PT DIGIOH | HYBRID EVENT ORGANIZER (@digioh.id)</a></p></div></blockquote>\r\n<script async src="//www.instagram.com/embed.js"></script>	string              	1	1	\N	2025-10-03 00:07:35	2025-10-04 10:14:26	\N
\.


--
-- TOC entry 5159 (class 0 OID 32935)
-- Dependencies: 258
-- Data for Name: sliders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sliders (id, title, subtitle, image, button_text, button_link, is_active, sort_order, created_at, updated_at, deleted_at, created_by, updated_by, deleted_by) FROM stdin;
2	Transformasi Digital dengan Pendekatan Strategis	Kami menyusun roadmap produk yang realistis dan terukur untuk bisnis Anda	http://172.6.7.253/wp-content/uploads/2025/08/Frame-1000010219.png	Pelajari Proses Kami	/about	t	2	2025-10-03 18:02:33	2025-10-03 18:24:20	\N	\N	1	\N
1	Solusi Digital Terbaik untuk Bisnis Anda	Tim kami membantu Anda dari ide hingga produk digital yang berdampak	http://172.6.7.253/wp-content/uploads/2025/08/Frame-1000010220-e1756451252956.png	Diskusikan Proyek Anda	/contact	t	1	2025-10-03 18:02:33	2025-10-03 18:24:37	\N	\N	1	\N
3	Pengembangan Produk End-to-End	Pembuatan aplikasi web dan mobile yang skalabel dengan praktik engineering modern	http://172.6.7.253/wp-content/uploads/2025/08/Frame-1000010218-e1756444952881.png	Lihat Portofolio	/services	t	3	2025-10-03 18:02:33	2025-10-03 18:24:45	\N	\N	1	\N
\.


--
-- TOC entry 5161 (class 0 OID 32943)
-- Dependencies: 260
-- Data for Name: stats; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.stats (id, created_at, updated_at, value, label, label_en, sort_order, is_active) FROM stdin;
1	2025-10-03 10:51:50	2025-10-03 10:51:50	12+	Tahun pengalaman	Years of experience	1	t
2	2025-10-03 10:51:50	2025-10-03 10:51:50	150+	Proyek berhasil diselesaikan	Projects completed successfully	2	t
3	2025-10-03 10:51:50	2025-10-03 10:51:50	98%	Pelanggan yang kembali bekerja bersama	Customers who return to work together	3	t
4	2025-10-03 11:01:13	2025-10-03 11:01:13	299 +	Digital Signage Screen	TOTEM	4	t
\.


--
-- TOC entry 5163 (class 0 OID 32949)
-- Dependencies: 262
-- Data for Name: taggables; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.taggables (id, tag_id, taggable_id, taggable_type) FROM stdin;
\.


--
-- TOC entry 5165 (class 0 OID 32953)
-- Dependencies: 264
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tags (id, name, slug, group_name, description, image, status, meta_title, meta_description, meta_keyword, created_by, updated_by, deleted_by, created_at, updated_at, deleted_at) FROM stdin;
1	Aut saepe	aut-saepe	\N	Libero enim inventore autem doloremque alias. Rerum reiciendis assumenda tempora dolorem architecto soluta in. Et atque et corrupti non.	\N	Active	\N	\N	\N	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
2	Quis quidem	quis-quidem	\N	Illum deserunt voluptatem ex voluptatum eveniet quia. Fugit eum ipsam autem est incidunt. Amet laborum nihil praesentium optio sed omnis et facilis.	\N	Active	\N	\N	\N	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
3	Doloremque hic	doloremque-hic	\N	Dolores ratione magnam qui aut maxime vel dignissimos aliquam. Magni earum animi corrupti cum in iusto facere. Voluptas libero reiciendis minima vel ipsum ipsum.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
4	Et recusandae	et-recusandae	\N	Est assumenda numquam eveniet vel rerum. Et suscipit ea nisi modi assumenda consequatur beatae. Est nihil temporibus ratione voluptas voluptatem. Odio et porro est nesciunt. Dolorem atque ea culpa odio eos qui.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
5	Corrupti eos	corrupti-eos	\N	Voluptatem error officia tempore eveniet nemo. Quae aut repudiandae qui distinctio et ut.	\N	Inactive	\N	\N	\N	\N	\N	\N	2025-10-03 14:57:50	2025-10-03 14:57:50	\N
6	Error	error	\N	Omnis voluptas id maiores nisi ut est. Qui tenetur et accusantium molestiae iure et laborum. Sint ex molestiae labore est. Totam consequatur harum ut modi.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
7	Error	error	\N	Eius rerum veniam in. Reiciendis veniam cumque itaque voluptatem. Consequuntur commodi deleniti et illo non.	\N	Active	\N	\N	\N	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
8	Rerum et fugit	rerum-et-fugit	\N	Facilis ipsum quia odio et earum culpa est. Minima aut dolores ipsa. Sunt id sit eos rerum et exercitationem. Eveniet non enim vel aut distinctio suscipit placeat.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
9	Et aut quasi	et-aut-quasi	\N	Ad voluptas unde qui autem fugit id sunt. Odio necessitatibus molestiae dolor et. Enim ex maxime voluptas saepe excepturi. Eaque possimus ratione hic et qui.	\N	Active	\N	\N	\N	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
10	Expedita	expedita	\N	Rerum velit sequi exercitationem. Exercitationem voluptates ipsam aut temporibus dolore. Provident sapiente sit vel omnis et quisquam illo consequatur. Cumque ex earum voluptatem modi eaque est libero.	\N	Inactive	\N	\N	\N	\N	\N	\N	2025-10-03 14:59:28	2025-10-03 14:59:28	\N
11	Tempora	tempora	\N	Consequatur rerum vel quia. Laudantium rerum ea consequuntur hic quam accusamus. Sed sunt unde incidunt tempore qui. Itaque ut nemo voluptatibus.	\N	Inactive	\N	\N	\N	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
12	Quae nihil qui	quae-nihil-qui	\N	Culpa harum eius quia autem hic voluptatem ut. Quos amet quisquam ut delectus maiores omnis sit sed.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
13	Molestiae id	molestiae-id	\N	Maiores optio dolores corporis enim. Mollitia aut corporis soluta asperiores architecto sit. Et exercitationem sunt nisi soluta sit maiores aut. Ut distinctio voluptate cumque enim rerum.	\N	Draft	\N	\N	\N	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
14	Dolores quis	dolores-quis	\N	Aut autem consequatur tempore quia. Qui deserunt fugiat minima nostrum et sunt. Eveniet dolor cumque molestiae quae nobis quam provident. Nostrum esse facilis veritatis quo voluptas temporibus cupiditate.	\N	Active	\N	\N	\N	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
15	Necessitatibus	necessitatibus	\N	Accusantium ducimus excepturi tempora. Possimus commodi natus ut maxime et culpa voluptate.	\N	Inactive	\N	\N	\N	\N	\N	\N	2025-10-03 17:57:27	2025-10-03 17:57:27	\N
\.


--
-- TOC entry 5167 (class 0 OID 32960)
-- Dependencies: 266
-- Data for Name: user_providers; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_providers (id, user_id, provider, provider_id, avatar, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5169 (class 0 OID 32964)
-- Dependencies: 268
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, username, first_name, last_name, mobile, gender, date_of_birth, address, bio, social_profiles, avatar, last_ip, login_count, last_login, status, created_by, updated_by, deleted_by, deleted_at) FROM stdin;
2	Admin Istrator	admin@admin.com	2025-10-03 17:57:23	$2y$12$16lu/jZfqcemUQNpURz7UuVM.AdTeBZ96PN/BUpvsY43cs3RdI3.G	\N	2025-10-03 17:57:23	2025-10-04 08:49:12	100002	Admin	Istrator	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N
3	Manager User	manager@manager.com	2025-10-03 17:57:23	$2y$12$lDbNWmq9nxt8hENbsjIbOOta4mwg68vn2wi4TIIzB4thhlhAVv8T.	\N	2025-10-03 17:57:23	2025-10-04 08:49:13	100003	Manager	User	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N
4	Executive User	executive@executive.com	2025-10-03 17:57:23	$2y$12$zHhaa1kuNvUrtgvv1TZaZuW02knnSg3Zv72zpr45i/V66Es1VIc8i	\N	2025-10-03 17:57:23	2025-10-04 08:49:13	100004	Executive	User	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N
5	General User	user@user.com	2025-10-03 17:57:23	$2y$12$85w/oo9NlFm6IADUFeYJaO2ZjOs04Vw9cR8GhgWFF0YlT0vxUb4H2	\N	2025-10-03 17:57:23	2025-10-04 08:49:13	100005	General	User	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N
1	Super Admin	super@admin.com	2025-10-03 17:57:27	$2y$12$rOfAUqgUASRCOMICxmugL.JTC07u/aSPcyqhpg3RHEONcK2SxEQKG	\N	2025-10-03 17:57:23	2025-10-04 08:49:13	100001	Super	Admin	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	1	\N	\N	\N	\N
\.


--
-- TOC entry 5203 (class 0 OID 0)
-- Dependencies: 218
-- Name: activity_log_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.activity_log_id_seq', 36, true);


--
-- TOC entry 5204 (class 0 OID 0)
-- Dependencies: 222
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 15, true);


--
-- TOC entry 5205 (class 0 OID 0)
-- Dependencies: 224
-- Name: client_logos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.client_logos_id_seq', 6, true);


--
-- TOC entry 5206 (class 0 OID 0)
-- Dependencies: 226
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 5207 (class 0 OID 0)
-- Dependencies: 228
-- Name: faqs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.faqs_id_seq', 4, true);


--
-- TOC entry 5208 (class 0 OID 0)
-- Dependencies: 231
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 5209 (class 0 OID 0)
-- Dependencies: 233
-- Name: media_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.media_id_seq', 2, true);


--
-- TOC entry 5210 (class 0 OID 0)
-- Dependencies: 235
-- Name: messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.messages_id_seq', 1, false);


--
-- TOC entry 5211 (class 0 OID 0)
-- Dependencies: 237
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 34, true);


--
-- TOC entry 5212 (class 0 OID 0)
-- Dependencies: 242
-- Name: our_works_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.our_works_id_seq', 4, true);


--
-- TOC entry 5213 (class 0 OID 0)
-- Dependencies: 245
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permissions_id_seq', 50, true);


--
-- TOC entry 5214 (class 0 OID 0)
-- Dependencies: 247
-- Name: portfolios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.portfolios_id_seq', 1, false);


--
-- TOC entry 5215 (class 0 OID 0)
-- Dependencies: 249
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.posts_id_seq', 19, true);


--
-- TOC entry 5216 (class 0 OID 0)
-- Dependencies: 252
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_id_seq', 1, false);


--
-- TOC entry 5217 (class 0 OID 0)
-- Dependencies: 254
-- Name: services_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.services_id_seq', 6, true);


--
-- TOC entry 5218 (class 0 OID 0)
-- Dependencies: 257
-- Name: settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.settings_id_seq', 66, true);


--
-- TOC entry 5219 (class 0 OID 0)
-- Dependencies: 259
-- Name: sliders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.sliders_id_seq', 3, true);


--
-- TOC entry 5220 (class 0 OID 0)
-- Dependencies: 261
-- Name: stats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.stats_id_seq', 4, true);


--
-- TOC entry 5221 (class 0 OID 0)
-- Dependencies: 263
-- Name: taggables_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.taggables_id_seq', 1, false);


--
-- TOC entry 5222 (class 0 OID 0)
-- Dependencies: 265
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tags_id_seq', 15, true);


--
-- TOC entry 5223 (class 0 OID 0)
-- Dependencies: 267
-- Name: user_providers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_providers_id_seq', 1, false);


--
-- TOC entry 5224 (class 0 OID 0)
-- Dependencies: 269
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- TOC entry 4884 (class 2606 OID 32998)
-- Name: activity_log activity_log_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_log
    ADD CONSTRAINT activity_log_pkey PRIMARY KEY (id);


--
-- TOC entry 4890 (class 2606 OID 33000)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 4888 (class 2606 OID 33002)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 4892 (class 2606 OID 33004)
-- Name: categories categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- TOC entry 4894 (class 2606 OID 33006)
-- Name: client_logos client_logos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.client_logos
    ADD CONSTRAINT client_logos_pkey PRIMARY KEY (id);


--
-- TOC entry 4896 (class 2606 OID 33008)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 4898 (class 2606 OID 33010)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 4900 (class 2606 OID 33012)
-- Name: faqs faqs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.faqs
    ADD CONSTRAINT faqs_pkey PRIMARY KEY (id);


--
-- TOC entry 4902 (class 2606 OID 33014)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 4904 (class 2606 OID 33016)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 4909 (class 2606 OID 33018)
-- Name: media media_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_pkey PRIMARY KEY (id);


--
-- TOC entry 4911 (class 2606 OID 33020)
-- Name: media media_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.media
    ADD CONSTRAINT media_uuid_unique UNIQUE (uuid);


--
-- TOC entry 4913 (class 2606 OID 33022)
-- Name: messages messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.messages
    ADD CONSTRAINT messages_pkey PRIMARY KEY (id);


--
-- TOC entry 4915 (class 2606 OID 33024)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 4918 (class 2606 OID 33026)
-- Name: model_has_permissions model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- TOC entry 4921 (class 2606 OID 33028)
-- Name: model_has_roles model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- TOC entry 4924 (class 2606 OID 33030)
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- TOC entry 4926 (class 2606 OID 33032)
-- Name: our_works our_works_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.our_works
    ADD CONSTRAINT our_works_pkey PRIMARY KEY (id);


--
-- TOC entry 4928 (class 2606 OID 33034)
-- Name: our_works our_works_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.our_works
    ADD CONSTRAINT our_works_slug_unique UNIQUE (slug);


--
-- TOC entry 4930 (class 2606 OID 33036)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 4932 (class 2606 OID 33038)
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- TOC entry 4934 (class 2606 OID 33040)
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- TOC entry 4936 (class 2606 OID 33042)
-- Name: portfolios portfolios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolios
    ADD CONSTRAINT portfolios_pkey PRIMARY KEY (id);


--
-- TOC entry 4938 (class 2606 OID 33044)
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- TOC entry 4940 (class 2606 OID 33046)
-- Name: role_has_permissions role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- TOC entry 4942 (class 2606 OID 33048)
-- Name: roles roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- TOC entry 4944 (class 2606 OID 33050)
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- TOC entry 4946 (class 2606 OID 33052)
-- Name: services services_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.services
    ADD CONSTRAINT services_pkey PRIMARY KEY (id);


--
-- TOC entry 4949 (class 2606 OID 33054)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 4952 (class 2606 OID 33056)
-- Name: settings settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.settings
    ADD CONSTRAINT settings_pkey PRIMARY KEY (id);


--
-- TOC entry 4954 (class 2606 OID 33058)
-- Name: sliders sliders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sliders
    ADD CONSTRAINT sliders_pkey PRIMARY KEY (id);


--
-- TOC entry 4956 (class 2606 OID 33060)
-- Name: stats stats_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.stats
    ADD CONSTRAINT stats_pkey PRIMARY KEY (id);


--
-- TOC entry 4958 (class 2606 OID 33062)
-- Name: taggables taggables_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taggables
    ADD CONSTRAINT taggables_pkey PRIMARY KEY (id);


--
-- TOC entry 4960 (class 2606 OID 33064)
-- Name: tags tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_pkey PRIMARY KEY (id);


--
-- TOC entry 4962 (class 2606 OID 33066)
-- Name: user_providers user_providers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_providers
    ADD CONSTRAINT user_providers_pkey PRIMARY KEY (id);


--
-- TOC entry 4964 (class 2606 OID 33068)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 4966 (class 2606 OID 33070)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 4882 (class 1259 OID 33071)
-- Name: activity_log_log_name_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX activity_log_log_name_index ON public.activity_log USING btree (log_name);


--
-- TOC entry 4885 (class 1259 OID 33072)
-- Name: causer; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX causer ON public.activity_log USING btree (causer_type, causer_id);


--
-- TOC entry 4905 (class 1259 OID 33073)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 4906 (class 1259 OID 33074)
-- Name: media_model_type_model_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX media_model_type_model_id_index ON public.media USING btree (model_type, model_id);


--
-- TOC entry 4907 (class 1259 OID 33075)
-- Name: media_order_column_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX media_order_column_index ON public.media USING btree (order_column);


--
-- TOC entry 4916 (class 1259 OID 33076)
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);


--
-- TOC entry 4919 (class 1259 OID 33077)
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);


--
-- TOC entry 4922 (class 1259 OID 33078)
-- Name: notifications_notifiable_type_notifiable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX notifications_notifiable_type_notifiable_id_index ON public.notifications USING btree (notifiable_type, notifiable_id);


--
-- TOC entry 4947 (class 1259 OID 33079)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 4950 (class 1259 OID 33080)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- TOC entry 4886 (class 1259 OID 33081)
-- Name: subject; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX subject ON public.activity_log USING btree (subject_type, subject_id);


--
-- TOC entry 4967 (class 1259 OID 33082)
-- Name: users_username_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX users_username_index ON public.users USING btree (username);


--
-- TOC entry 4968 (class 2606 OID 33083)
-- Name: model_has_permissions model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 4969 (class 2606 OID 33088)
-- Name: model_has_roles model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 4970 (class 2606 OID 33093)
-- Name: role_has_permissions role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- TOC entry 4971 (class 2606 OID 33098)
-- Name: role_has_permissions role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- TOC entry 4972 (class 2606 OID 33103)
-- Name: user_providers user_providers_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_providers
    ADD CONSTRAINT user_providers_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


-- Completed on 2025-10-04 11:35:43

--
-- PostgreSQL database dump complete
--

\unrestrict FTuYjWeKrIxU765zm6KAq2yqBKnWFAYxX8LkMCAdyEiW1LNKccj2aVXxPlnmNuq

