-- Table: public.tbl_sanciones

-- DROP TABLE public.tbl_sanciones;

CREATE TABLE public.tbl_sanciones
(
    id_sancion integer NOT NULL DEFAULT nextval('tbl_sanciones_id_sancion_seq'::regclass),
    nombre_sancion character varying(500) COLLATE pg_catalog."default" NOT NULL,
    borrado boolean,
    CONSTRAINT tbl_sanciones_pk PRIMARY KEY (id_sancion)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_sanciones
    OWNER to postgres;