SELECT `title` AS `Title`,
       `summary` AS `Summary`,
       `prod_year`
FROM db_vbrazas.film
INNER JOIN db_vbrazas.genre
    ON db_vbrazas.film.id_genre = db_vbrazas.genre.id_genre
WHERE db_vbrazas.genre.name = 'erotic'
ORDER BY  `prod_year` DESC;