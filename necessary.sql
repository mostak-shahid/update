#MySQL Vertical Horizontal Join

SELECT u.id, u.name, u.username, group_concat(CASE p.option WHEN 'left_point' THEN p.value END) left_point, group_concat(CASE p.option WHEN 'right_point' THEN p.value END) right_point
	FROM users u
    LEFT JOIN profiles p
    ON    u.id = p.user_id
GROUP BY u.id