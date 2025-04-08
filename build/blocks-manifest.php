<?php
// This file is generated. Do not modify it manually.
return array(
	'teammemberblock' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'team-members-block/team-members-block',
		'version' => '0.1.0',
		'title' => 'Team Members',
		'category' => 'widgets',
		'attributes' => array(
			'limit' => array(
				'type' => 'number',
				'default' => 3
			)
		),
		'icon' => 'groups',
		'description' => 'Display your team members with names, roles, bios, and social links in a clean, customizable layout.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'team-member-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'teammembersearch' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'team-members-block/team-members-search',
		'version' => '0.1.0',
		'title' => 'Team Members Search',
		'category' => 'widgets',
		'attributes' => array(
			'limit' => array(
				'type' => 'number',
				'default' => 3
			),
			'title' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'icon' => 'search',
		'description' => 'A Simple live search plugin for team members.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'team-member-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
