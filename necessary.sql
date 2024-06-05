$wild = '%';
		$result = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT {$wpdb->prefix}users.ID, {$wpdb->prefix}users.user_email, {$wpdb->prefix}users.user_login, group_concat(CASE {$wpdb->prefix}usermeta.meta_key WHEN '{$wpdb->prefix}capabilities' THEN {$wpdb->prefix}usermeta.meta_value END) {$wpdb->prefix}capabilities FROM {$wpdb->prefix}users LEFT JOIN {$wpdb->prefix}usermeta ON {$wpdb->prefix}users.ID = {$wpdb->prefix}usermeta.user_id WHERE ({$wpdb->prefix}users.ID LIKE %s OR {$wpdb->prefix}users.user_login LIKE %s OR {$wpdb->prefix}users.user_email LIKE %s) AND {$wpdb->prefix}usermeta.meta_value LIKE %s GROUP BY {$wpdb->prefix}users.ID LIMIT 0, 10;",
				array(
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like($userQuery) . $wild,
					$wild . $wpdb->esc_like('customer') . $wild
				)
			),
		);

SELECT wp_mos_skim_user.*, wp_users.display_name
    FROM wp_mos_skim_user
    LEFT JOIN wp_users
    ON wp_mos_skim_user.user_id =  wp_users.ID
    WHERE status LIKE "pending"
    
SELECT skims.*, deposits.total, deposits.count, wp_users.display_name FROM wp_mos_skim_user as skims LEFT JOIN ( SELECT skim_id, SUM(amount) as total, COUNT(amount) as count FROM wp_mos_deposits where status='active' GROUP BY skim_id) as deposits ON skims.ID = deposits.skim_id LEFT JOIN wp_users ON skims.user_id = wp_users.ID WHERE status='active'    
    

#MySQL Vertical Horizontal Join
SELECT u.id, u.name, u.username, group_concat(CASE p.key WHEN 'address_line_1' THEN p.value END) address_line_1, group_concat(CASE p.key WHEN 'address_line_2' THEN p.value END) address_line_2 FROM users u LEFT JOIN profiles p ON u.id = p.user_id GROUP BY u.id


#mysql get all parent with level
SELECT ID.level, DATA.* FROM( 
    SELECT
        @child_id as _child_id, 
        (   SELECT @child_id := user_id 
            FROM trees 
            WHERE child_id = @child_id 
        ) as _pid, 
        @l := @l+1 as level
    FROM trees, 
        (SELECT @child_id := 5, @l := 0 ) b 
    WHERE @child_id > 0 
) ID, trees AS DATA 
WHERE ID._child_id = DATA.child_id 
ORDER BY level

#mysql get all child with level
SELECT ID.level, DATA.* FROM( 
    SELECT
        @child_ids as _child_ids, 
        (   SELECT @child_ids := GROUP_CONCAT(child_id) 
            FROM trees
            WHERE FIND_IN_SET(user_id, @child_ids)
        ) as cids, 
        @l := @l+1 as level
    FROM trees,
        (SELECT @child_ids :='8', @l := 0 ) b 
    WHERE @child_ids IS NOT NULL
) id, trees AS DATA
WHERE FIND_IN_SET(DATA.child_id, ID._child_ids)
ORDER BY level, id



DB::table("users")->select('users.*',DB::raw(GROUP_concat(CASE profiles.key WHEN 'profile_photo' THEN profiles.value END)))->join('profiles','users.id', '=', 'profiles.user_id')->groupBy('users.id')->get()


DB::table('customers')
  ->leftJoin('contacts', function ($join) {
      $join->on('contacts.customer_id', '=', 'customers.id')
              ->where(DB::raw('length(contacts.email)'), '>', 4);
  })
  ->select([
      'customers.id',
      'customers.name',
      DB::raw('-(distinct contacts.email separator ", ") AS contact_emails'),
  ])
  ->groupBy('customers.id')
  ->get();
  
  
  $assignment_details = $assignment->raw_plan()
                                ->select('raw_plans.*', DB::raw('group_concat(name) as names'))
                                ->where('assignment_id', 1)
                                ->groupBy('flag')
                                ->get();
                                
                                
                                
DB::table('users')->select('users.name',DB::raw('case profiles.key when "address_line_1" then profiles.value end as C
ustomText'))->join('profiles','users.id','=','profiles.user_id')->get();


#Delete all products
DELETE relations.*, taxes.*, terms.*
FROM wpyq_term_relationships AS relations
INNER JOIN wpyq_term_taxonomy AS taxes
ON relations.term_taxonomy_id=taxes.term_taxonomy_id
INNER JOIN wpyq_terms AS terms
ON taxes.term_id=terms.term_id
WHERE object_id IN (SELECT ID FROM wpyq_posts WHERE post_type IN ('product','product_variation'));

DELETE FROM wpyq_postmeta WHERE post_id IN (SELECT ID FROM wpyq_posts WHERE post_type IN ('product','product_variation'));
DELETE FROM wpyq_posts WHERE post_type IN ('product','product_variation');
