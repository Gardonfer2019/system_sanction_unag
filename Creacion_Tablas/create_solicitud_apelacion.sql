-- Table: public.tbl_solicitud_apelacion

-- DROP TABLE public.tbl_solicitud_apelacion;

CREATE TABLE public.tbl_solicitud_apelacion
(
    id_apelacion integer NOT NULL DEFAULT nextval('tbl_solicitud_apelacion_id_apelacion_seq'::regclass),
    id_solicitud_falta_estudiante integer NOT NULL,
    numero_registro_asignado character varying(7) COLLATE pg_catalog."default" NOT NULL,
    fecha_apelacion timestamp with time zone NOT NULL,
    justificacion character varying(500) COLLATE pg_catalog."default" NOT NULL,
    resolucion boolean NOT NULL,
    borrado boolean NOT NULL,
    CONSTRAINT tbl_solicitud_apelacion_pk PRIMARY KEY (id_apelacion)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_solicitud_apelacion
    OWNER to postgres;