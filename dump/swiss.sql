--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: administrators; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE administrators (
    id integer NOT NULL,
    user_id integer NOT NULL,
    created_at date DEFAULT now() NOT NULL,
    updated_at date DEFAULT now() NOT NULL
);


ALTER TABLE administrators OWNER TO postgres;

--
-- Name: administrators_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE administrators_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE administrators_id_seq OWNER TO postgres;

--
-- Name: administrators_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE administrators_id_seq OWNED BY administrators.id;


--
-- Name: games; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE games (
    id integer NOT NULL,
    name character varying(255),
    created_at date,
    updated_at date
);


ALTER TABLE games OWNER TO postgres;

--
-- Name: games_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE games_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE games_id_seq OWNER TO postgres;

--
-- Name: games_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE games_id_seq OWNED BY games.id;


--
-- Name: matches; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE matches (
    id integer NOT NULL,
    tournament_id integer NOT NULL,
    first_player_id integer NOT NULL,
    second_player_id integer NOT NULL,
    winner integer NOT NULL,
    begin date DEFAULT now(),
    finish date NOT NULL,
    created_at date DEFAULT now(),
    updated_at date DEFAULT now(),
    created_by integer NOT NULL
);


ALTER TABLE matches OWNER TO postgres;

--
-- Name: matches_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE matches_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE matches_id_seq OWNER TO postgres;

--
-- Name: matches_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE matches_id_seq OWNED BY matches.id;


--
-- Name: players; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE players (
    id integer NOT NULL,
    nickname character varying(255) NOT NULL,
    user_id integer NOT NULL
);


ALTER TABLE players OWNER TO postgres;

--
-- Name: players_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE players_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE players_id_seq OWNER TO postgres;

--
-- Name: players_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE players_id_seq OWNED BY players.id;


--
-- Name: rankings; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rankings (
    id integer NOT NULL,
    player_id integer NOT NULL,
    tournament_id integer NOT NULL,
    score integer DEFAULT 0 NOT NULL
);


ALTER TABLE rankings OWNER TO postgres;

--
-- Name: rankings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rankings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rankings_id_seq OWNER TO postgres;

--
-- Name: rankings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rankings_id_seq OWNED BY rankings.id;


--
-- Name: tournaments; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournaments (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    begin date DEFAULT now() NOT NULL,
    finish date NOT NULL,
    created_at date DEFAULT now() NOT NULL,
    updated_at date DEFAULT now() NOT NULL,
    has_ended boolean DEFAULT false NOT NULL,
    created_by integer NOT NULL
);


ALTER TABLE tournaments OWNER TO postgres;

--
-- Name: tournaments_games; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tournaments_games (
    id integer NOT NULL,
    game_id integer,
    tournament_id integer
);


ALTER TABLE tournaments_games OWNER TO postgres;

--
-- Name: tournaments_games_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tournaments_games_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tournaments_games_id_seq OWNER TO postgres;

--
-- Name: tournaments_games_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tournaments_games_id_seq OWNED BY tournaments_games.id;


--
-- Name: tournaments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE tournaments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE tournaments_id_seq OWNER TO postgres;

--
-- Name: tournaments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE tournaments_id_seq OWNED BY tournaments.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(60) NOT NULL,
    birthdate date,
    remember_token character varying(100)
);


ALTER TABLE users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY administrators ALTER COLUMN id SET DEFAULT nextval('administrators_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY games ALTER COLUMN id SET DEFAULT nextval('games_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches ALTER COLUMN id SET DEFAULT nextval('matches_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY players ALTER COLUMN id SET DEFAULT nextval('players_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rankings ALTER COLUMN id SET DEFAULT nextval('rankings_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournaments ALTER COLUMN id SET DEFAULT nextval('tournaments_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournaments_games ALTER COLUMN id SET DEFAULT nextval('tournaments_games_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: administrators; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY administrators (id, user_id, created_at, updated_at) FROM stdin;
\.


--
-- Name: administrators_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('administrators_id_seq', 1, false);


--
-- Data for Name: games; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY games (id, name, created_at, updated_at) FROM stdin;
\.


--
-- Name: games_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('games_id_seq', 1, false);


--
-- Data for Name: matches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY matches (id, tournament_id, first_player_id, second_player_id, winner, begin, finish, created_at, updated_at, created_by) FROM stdin;
\.


--
-- Name: matches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('matches_id_seq', 1, false);


--
-- Data for Name: players; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY players (id, nickname, user_id) FROM stdin;
\.


--
-- Name: players_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('players_id_seq', 1, false);


--
-- Data for Name: rankings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rankings (id, player_id, tournament_id, score) FROM stdin;
\.


--
-- Name: rankings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rankings_id_seq', 1, false);


--
-- Data for Name: tournaments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournaments (id, name, begin, finish, created_at, updated_at, has_ended, created_by) FROM stdin;
\.


--
-- Data for Name: tournaments_games; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tournaments_games (id, game_id, tournament_id) FROM stdin;
\.


--
-- Name: tournaments_games_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tournaments_games_id_seq', 1, false);


--
-- Name: tournaments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('tournaments_id_seq', 1, false);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, name, email, password, birthdate, remember_token) FROM stdin;
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('users_id_seq', 1, false);


--
-- Name: administrators_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY administrators
    ADD CONSTRAINT administrators_pkey PRIMARY KEY (id);


--
-- Name: games_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY games
    ADD CONSTRAINT games_pkey PRIMARY KEY (id);


--
-- Name: matches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_pkey PRIMARY KEY (id);


--
-- Name: players_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY players
    ADD CONSTRAINT players_pkey PRIMARY KEY (id);


--
-- Name: rankings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rankings
    ADD CONSTRAINT rankings_pkey PRIMARY KEY (id);


--
-- Name: tournament_game_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tournaments_games
    ADD CONSTRAINT tournament_game_pkey PRIMARY KEY (id);


--
-- Name: tournaments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tournaments
    ADD CONSTRAINT tournaments_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: administrators_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY administrators
    ADD CONSTRAINT administrators_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: matches_created_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_created_by_fkey FOREIGN KEY (created_by) REFERENCES administrators(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: matches_first_player_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_first_player_id_fkey FOREIGN KEY (first_player_id) REFERENCES players(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: matches_second_player_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_second_player_id_fkey FOREIGN KEY (second_player_id) REFERENCES players(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: matches_tournament_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_tournament_id_fkey FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: matches_winner_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY matches
    ADD CONSTRAINT matches_winner_fkey FOREIGN KEY (winner) REFERENCES players(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: players_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY players
    ADD CONSTRAINT players_user_id_fkey FOREIGN KEY (user_id) REFERENCES users(id);


--
-- Name: rankings_player_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rankings
    ADD CONSTRAINT rankings_player_id_fkey FOREIGN KEY (player_id) REFERENCES players(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: rankings_tournament_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rankings
    ADD CONSTRAINT rankings_tournament_id_fkey FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tournament_game_game_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournaments_games
    ADD CONSTRAINT tournament_game_game_id_fkey FOREIGN KEY (game_id) REFERENCES games(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tournament_game_tournament_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournaments_games
    ADD CONSTRAINT tournament_game_tournament_id_fkey FOREIGN KEY (tournament_id) REFERENCES tournaments(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tournaments_created_by_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tournaments
    ADD CONSTRAINT tournaments_created_by_fkey FOREIGN KEY (created_by) REFERENCES administrators(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

