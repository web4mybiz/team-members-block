=== Team Member Block & Search ===
Contributors:      Rizwan Iliyas
Tags:              block, team, custom post type, gutenberg
Tested up to:      6.7
Stable tag:        0.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Display your team members with names, roles, bios, and social links in a clean, customizable layout.

== Description ==

Team Members Block is a simple and effective WordPress plugin that lets you showcase your team in a clean and customizable way. 
It creates a custom post type called team_member where you can easily add and manage your team members.

Each team member entry allows you to include:

- Name (title)
- Designation
- Joined date
- LinkedIn and Twitter profile links
- Photo (Team Member image)

== Features ==

- Gutenberg Block support with live preview
- REST API integration with live search
- Featured image as profile photo
- Custom meta fields for designation, social profiles, and join date
- Limit number of team members displayed
- Follows WordPress Coding Standards and security best practices

== How To Use ==

This plugin includes two custom Gutenberg blocks:

    1. Team Member Block – Displays a grid of team members added via the custom post type.
    2. Team Member Search Block – A live search block that fetches team members from the REST API using JavaScript.

Follow these steps to get started:

    1. Install and activate the plugin.
    2. From the WordPress admin sidebar, go to Team Members to add team profiles.
    3. For each member, fill in details like name, designation, joined date, featured image, and social links.
    4. To display a list of team members:

        - Edit any page or post.
        - Add a new block.
        - Search for "Team Members" block.
        - Insert it where you want the team to appear.
        - Use the sidebar settings to customize the number of members displayed.

    5. To enable live team member search:

        - Add the "Team Members Search" block to any page.
        - Start typing in the search field (minimum 3 characters) to see live results powered by the WordPress REST API.