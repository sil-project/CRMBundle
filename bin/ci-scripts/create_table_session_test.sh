#!/usr/bin/env bash

# TODO share this between script (in an include)
if [ -f .env ]
then
    source .env
else
    echo "Please run this script from project root, and check .env file as it is mandatory"
    echo "If it is missing a quick solution is :"
    echo "ln -s .env.travis .env"
    exit 42
fi

if [ -z "${DBHOST}" ]
then
    echo "Please add DBHOST in .env file as it is mandatory"
    exit 42
fi

psql -w -h ${DBHOST}  -U ${DBROOTUSER} -d ${DBAPPNAME} <<EOF
-- Table: public.blast_session

DROP TABLE public.blast_session;

CREATE TABLE public.blast_session
(
  id integer NOT NULL,
  session_id character varying(255) NOT NULL,
  data bytea,
  createdat timestamp(0) without time zone NOT NULL,
  expiresat timestamp(0) without time zone NOT NULL,
  CONSTRAINT blast_session_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.blast_session
  OWNER TO ${DBAPPUSER};

-- Index: public.blast_session_session_id_index

-- DROP INDEX public.blast_session_session_id_index;

CREATE INDEX blast_session_session_id_index
  ON public.blast_session
  USING btree
  (session_id COLLATE pg_catalog."default");
EOF

psql -w -h ${DBHOST}  -U ${DBROOTUSER} -d ${DBAPPNAME} <<EOF
DROP SEQUENCE public.blast_session_id_seq;

CREATE SEQUENCE public.blast_session_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 80
  CACHE 1;
ALTER TABLE public.blast_session_id_seq
  OWNER TO ${DBAPPUSER};
EOF
