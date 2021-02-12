-- Table: public.tbl_sancion_estudiante

-- DROP TABLE public.tbl_sancion_estudiante;

CREATE TABLE public.tbl_sancion_estudiante
(
    id_sancion_estudiante integer NOT NULL DEFAULT nextval('tbl_sancion_estudiante_id_sancion_estudiante_seq'::regclass),
    id_solicitud_falta_estudiante integer NOT NULL,
    id_apelacion integer,
    numero_registro_asignado character varying(7) COLLATE pg_catalog."default" NOT NULL,
    id_usuario integer NOT NULL,
    borrado boolean NOT NULL,
    dictamen character varying(500) COLLATE pg_catalog."default" NOT NULL,
    sancionado boolean NOT NULL,
    fecha_sancion timestamp without time zone NOT NULL,
    CONSTRAINT tbl_sancion_estudiante_pk PRIMARY KEY (id_sancion_estudiante)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_sancion_estudiante
    OWNER to postgres;