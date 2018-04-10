SELECT count(*) AS `nb_susc`, round(avg(`price`), 0) AS `av_susc`, mod(`duration_sub`, 42) AS `ft` FROM db_vbrazas.member
INNER JOIN db_vbrazas.subscription ON db_vbrazas.subscription.id_sub=db_vbrazas.member.id_sub
GROUP BY `duration_sub`;