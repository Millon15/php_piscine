SELECT datediff(max(`date`), min(`date`)) AS `uptime`
FROM db_vbrazas.member_history;