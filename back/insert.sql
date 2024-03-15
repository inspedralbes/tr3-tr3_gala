-- Inserir dades a la taula 'pelicules'
INSERT INTO pelicules (titol, descripcio, director, any, url) VALUES
('Inception', 'Un lladre que entra en els somnis dels altres per robar secrets del seu subconscient.', 'Christopher Nolan', 2010, 'https://i.pinimg.com/originals/a4/a3/d9/a4a3d901487cb61d972d534741f815f3.jpg'),
('The Shawshank Redemption', 'Dos homes empresonats es vinculen al llarg d\'una sèrie d\'anys, trobant consol i eventual redempció a través d\'actes de decència comuna.', 'Frank Darabont', 1994, 'https://m.media-amazon.com/images/I/71VNhykMgNL._AC_UF894,1000_QL80_.jpg'),
('The Godfather', 'El patriarca envellit d\'una dinastia del crim organitzat transmet el control del seu imperi clandestí al seu fill reticent.', 'Francis Ford Coppola', 1972, 'https://i.pinimg.com/736x/24/5a/44/245a44e4d9da3687f77e6202bd6d2995.jpg'),
-- Afegeix aquí la resta de pel·lícules segons el teu JSON
('The Dark Knight', 'Quan el Joker comença a causar estralls a Gotham City, Batman es veu obligat a intervenir per protegir la ciutat que tant estima.', 'Christopher Nolan', 2008, 'https://i.pinimg.com/originals/47/7f/41/477f41e7457b4a1b2d9a423e28d18f5a.jpg'),
('The Lord of the Rings: The Return of the King', 'Mentre l\'ombra de la guerra s\'estén per tota la Terra Mitjana, Aragorn es presenta com a líder dels mortals per dur a terme la darrera batalla contra Sauron.', 'Peter Jackson', 2003, 'https://i.pinimg.com/originals/c3/af/66/c3af66c2db87942b8dabcfd6e2e66e13.jpg'),
('Pulp Fiction', 'Històries interconnectades sobre crim, passió i violència a Los Angeles.', 'Quentin Tarantino', 1994, 'https://m.media-amazon.com/images/I/51KGTUrvvlL._AC_.jpg'),
('Forrest Gump', 'Les cròniques de la vida de Forrest Gump, un home amb un baix coeficient intel·lectual, que va participar involuntàriament en molts dels esdeveniments més importants de la història dels Estats Units.', 'Robert Zemeckis', 1994, 'https://i.pinimg.com/originals/4f/49/e0/4f49e0c43b94a0b97b925f07a3a4a16d.jpg'),
('The Matrix', 'Un hacker descobreix la veritat sorprenent sobre el món que l\'envolta.', 'The Wachowskis', 1999, 'https://m.media-amazon.com/images/I/51vpnbPUa9L.jpg'),
('Interstellar', 'Un grup d\'exploradors espacials viatja a través d\'un forat de cuc per garantir la supervivència de la humanitat.', 'Christopher Nolan', 2014, 'https://i.pinimg.com/originals/f7/06/01/f70601f96fa28c3a5b408a97cd321b49.jpg'),
('Fight Club', 'Un insòlit club de lluita porta a un executiu i a un venedor de sabó a formar un vincle inesperat.', 'David Fincher', 1999, 'https://i.pinimg.com/originals/c2/a3/5f/c2a35f2717c98d4a7d42d3885f44ac29.jpg'),
('The Silence of the Lambs', 'Un jove agent del FBI s\'enfronta al psicòpata caníbal Dr. Hannibal Lecter per atrapar a un assassí en sèrie.', 'Jonathan Demme', 1991, 'https://i.pinimg.com/originals/79/ed/24/79ed2416fa5ec3e0b2d18572f9ad2dbf.jpg'),
('Schindler\'s List', 'Un empresari alemany salva la vida de milers de jueus polonesos durant l\'Holocaust.', 'Steven Spielberg', 1993, 'https://i.pinimg.com/originals/47/22/ef/4722ef1b545b83cc5f0063f7cf1a2a2e.jpg'),
('The Departed', 'Un agent encobert i un informant cadascun naveguen en una xarxa perillosa de delinqüència i traïció.', 'Martin Scorsese', 2006, 'https://i.pinimg.com/originals/98/e8/98/98e89823f14c08b7b8a210fffd4dab91.jpg'),
('Goodfellas', 'La vida dels gàngsters des de la dècada de 1950 fins als anys 1980.', 'Martin Scorsese', 1990, 'https://i.pinimg.com/originals/49/95/f0/4995f0a8dd2f254f1642ab4ee9af4f4e.jpg'),
('Inglourious Basterds', 'Un grup de soldats jueus-estatunidencs amb l\'objectiu de matar nazis d\'alta jerarquia durant la Segona Guerra Mundial.', 'Quentin Tarantino', 2009, 'https://i.pinimg.com/originals/36/7c/80/367c808b21c0220f9ad6b7a020f41fae.jpg');

-- Inserir dades a la taula 'sessions'
INSERT INTO sessions (pelicula_id, fecha, hora) VALUES
(1, '2024-03-15', '13:00:00'),
(1, '2024-03-16', '15:30:00'),
(1, '2024-03-17', '18:00:00');
