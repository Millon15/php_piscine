SELECT `name`
FROM db_vbrazas.distrib
WHERE `id_distrib` IN (42, 62, 63, 64, 65, 66, 67, 68, 69, 71, 88, 89, 90)
      AND lower(`name`) LIKE '%y%y%'
      LIMIT 5 OFFSET 2;