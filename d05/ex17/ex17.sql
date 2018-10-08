SELECT count(*) AS `nb_susc`,
       floor(avg(`price`)) AS `av_susc`,
       sum(`duration_sub`) % 42 AS `ft`
FROM db_vbrazas.subscription;