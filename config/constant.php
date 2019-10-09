<?php
define('PER_PAGE', 20);
define('SUCCESS', 'success');
define('ERROR','error');

// Define route
define("MEMBER_LIST", 'members.list');
define("MEMBER_CREATE", 'members.create');
define("MEMBER_STORE", 'members.store');
define('MEMBER_EDIT', 'members.edit/{id}');
define('MEMBER_UPDATE', 'members.update/{id}');
define("MEMBER_DETAIL", 'members.detail');
define("MEMBER_DELETE", 'members.delete');

define('DIVISION_LIST', 'divisions.list');
define('DIVISION_DELETE', 'divisions.delete');
define('DIVISION_CREATE', 'divisions.create');
define('DIVISION_STORE', 'divisions.store');
define('DIVISION_EDIT', 'divisions.edit/{id}');
define('DIVISION_UPDATE', 'divisions.update/{id}');

define('TEAM_LIST', 'teams.list');
define('TEAM_CREATE', 'teams.create');
define('TEAM_STORE', 'teams.store');