-- Table: public.tbl_faltas

-- DROP TABLE public.tbl_faltas;

CREATE TABLE public.tbl_faltas
(
    id_falta integer NOT NULL DEFAULT nextval('tbl_faltas_id_falta_seq'::regclass),
    id_tipo_falta integer NOT NULL,
    incurrencia integer NOT NULL,
    orden integer NOT NULL,
    descripcion character varying(500) COLLATE pg_catalog."default" NOT NULL,
    borrado boolean NOT NULL,
    reglamento integer NOT NULL,
    CONSTRAINT tbl_faltas_pk PRIMARY KEY (id_falta),
    CONSTRAINT tbl_faltas_fk0 FOREIGN KEY (id_tipo_falta)
        REFERENCES public.tbl_tipo_falta (id_tipo_falta) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_faltas
    OWNER to postgres;