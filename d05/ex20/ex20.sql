SELECT db_vbrazas.film.id_genre,
       db_vbrazas.genre.name AS `name_genre`,
       db_vbrazas.film.id_distrib,
       db_vbrazas.distrib.name AS `name_distrib`,
       `title` AS `title_film`
FROM db_vbrazas.film
LEFT JOIN db_vbrazas.genre
    ON db_vbrazas.genre.id_genre = db_vbrazas.film.id_genre
LEFT JOIN db_vbrazas.distrib
    ON db_vbrazas.distrib.id_distrib = db_vbrazas.film.id_distrib
WHERE db_vbrazas.film.id_genre
    BETWEEN 4
        AND 8;