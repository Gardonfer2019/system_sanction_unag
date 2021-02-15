-- Table: public.tbl_tipo_usuarios

-- DROP TABLE public.tbl_tipo_usuarios;

CREATE TABLE public.tbl_tipo_usuarios
(
    id_tipo_usuario integer NOT NULL,
    nombre character varying(7) COLLATE pg_catalog."default" NOT NULL,
    "Descripcion" character varying(100) COLLATE pg_catalog."default" NOT NULL,
    borrado boolean,
    CONSTRAINT tbl_tipo_usuarios_pkey PRIMARY KEY (id_tipo_usuario)
)

TABLESPACE pg_default;

ALTER TABLE public.tbl_tipo_usuarios
    OWNER to postgres;