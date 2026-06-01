<?php
require "include/bittorrent.php";
dbconn();
stdhead("User Agreement");
begin_main_frame();
begin_frame("User Agreement");
?>

<p>
This page is a default user agreement template for a site operated with
<?php echo $SITENAME ?>. Site operators should review and customize it before
running a public service.
</p>

<p>
Use of this site is subject to the rules, policies, and moderation decisions
published by the site operator. Users are responsible for complying with all
applicable laws and for making sure they have the right to upload, download,
share, or discuss any material through the site.
</p>

<p>
The site may collect account, session, announce, transfer, and moderation data
needed to provide tracker and community features. Site operators should publish
their own privacy policy if they operate this software for other users.
</p>

<p>
The site is provided without warranties. Availability, accuracy, data retention,
and feature behavior may change at any time. The operator may remove content,
restrict access, or disable accounts when needed to protect the service or its
users.
</p>

<p>
The P2Pnow Nexus source code is licensed separately under the GNU General Public
License version 2. See the project LICENSE file for the software license. This
site agreement does not limit the rights granted by that open source license.
</p>

<p>
By continuing to use this site, you agree to follow the site rules and any
additional terms published by the operator.
</p>

<?php
end_frame();
end_main_frame();
stdfoot();
