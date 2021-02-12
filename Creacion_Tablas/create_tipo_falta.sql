-- Table: public.tbl_tipo_falta

-- DROP TABLE public.tbl_tipo_falta;

CREATE TABLE public.tbl_tipo_falta
(
    id_tipo_falta integer NOT NULL DEFAULT nextval('tbl_tipo_falta_id_tipo_falta_seq'::regclass),
    nombre_tipo character varying(25) COLLATE pg_catalog."default" NOT NULL,
    borrado boolean NOT NULL,
    escala integer,
    CONSTRAINT tbl_tipo_falta_pk PRIMARY KEY (id_tipo_falta)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_tipo_falta
    OWNER to postgres;