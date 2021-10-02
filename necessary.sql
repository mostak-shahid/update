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
