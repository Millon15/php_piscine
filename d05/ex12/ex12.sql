SELECT `last_name`,
       `first_name`
FROM db_vbrazas.user_card
WHERE db_vbrazas.user_card.last_name LIKE '%-%'
      OR db_vbrazas.user_card.first_name LIKE '%-%'
ORDER BY  db_vbrazas.user_card.last_name ASC, db_vbrazas.user_card.first_name ASC;