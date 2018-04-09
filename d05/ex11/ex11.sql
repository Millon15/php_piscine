SELECT `last_name` AS `NAME`, `first_name`, db_vbrazas.subscription.price
FROM db_vbrazas.user_card
INNER JOIN db_vbrazas.member ON db_vbrazas.member.id_user_card=db_vbrazas.user_card.id_user
INNER JOIN db_vbrazas.subscription ON db_vbrazas.subscription.id_sub=db_vbrazas.member.id_sub
WHERE db_vbrazas.subscription.price > 42
AND db_vbrazas.user_card.last_name = upper(db_vbrazas.user_card.last_name)
ORDER BY db_vbrazas.user_card.last_name, db_vbrazas.user_card.first_name ASC;