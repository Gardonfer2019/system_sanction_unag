-- Table: public.tbl_sancion_falta

-- DROP TABLE public.tbl_sancion_falta;

CREATE TABLE public.tbl_sancion_falta
(
    id_sancion_falta integer NOT NULL DEFAULT nextval('tbl_sancion_falta_id_sancion_falta_seq'::regclass),
    id_sancion integer NOT NULL,
    id_falta integer NOT NULL,
    borrado boolean NOT NULL,
    CONSTRAINT tbl_sancion_falta_pk PRIMARY KEY (id_sancion_falta),
    CONSTRAINT tbl_sancion_falta_fk0 FOREIGN KEY (id_sancion)
        REFERENCES public.tbl_sanciones (id_sancion) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT tbl_sancion_falta_fk1 FOREIGN KEY (id_falta)
        REFERENCES public.tbl_faltas (id_falta) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_sancion_falta
    OWNER to postgres;