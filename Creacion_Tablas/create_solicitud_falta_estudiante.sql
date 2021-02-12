-- Table: public.tbl_solicitud_falta_estudiante

-- DROP TABLE public.tbl_solicitud_falta_estudiante;

CREATE TABLE public.tbl_solicitud_falta_estudiante
(
    id_solicitud_falta_estudiante integer NOT NULL DEFAULT nextval('tbl_solicitud_falta_estudiant_id_solicitud_falta_estudiante_seq'::regclass),
    id_sancion_falta integer NOT NULL,
    id_usuario integer NOT NULL,
    numero_registro_asignado character varying(7) COLLATE pg_catalog."default" NOT NULL,
    fecha_falta_cometida timestamp with time zone NOT NULL,
    "año" integer NOT NULL,
    periodo integer NOT NULL,
    observaciones character varying(200) COLLATE pg_catalog."default" NOT NULL,
    responsable character varying(45) COLLATE pg_catalog."default" NOT NULL,
    borrado boolean NOT NULL,
    apelada boolean NOT NULL,
    sancionada boolean,
    CONSTRAINT tbl_solicitud_falta_estudiante_pk PRIMARY KEY (id_solicitud_falta_estudiante)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_solicitud_falta_estudiante
    OWNER to postgres;