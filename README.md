# emailasusername
Two Joomla Plugins (A system plugin and authentication plugin) Which together removes usernames from the registration and login pages of Joomla and other Joomla extensions.

# History
A plugin which I started many years ago, just as Joomla 1.5 was released. 

# How it works
It leverages template overrides to hide the (mandatory) username in Joomla, and then a system plugin silently intercepts posts involving registration & automatically generates a unique username (site wide) so that the input passes the registration validation. As far as the user sees, they have only had to supply (at minimum) an email address and password, Joomla sees the user has submitted a username (because the system plugin has silently generated one), email address and password. 

# Will the system plugin overwrite my existing overrides?
In short, yes, however ANY and ALL existing template overrides are backed up in two seperate places. Once in the database, and again on in file system. Disable the system plugin will automatically restore the back from the database. The file based backup is taken the 1st time the system plugin is enabled, and only created again if it finds your_template_name.eaubackup does not exist.

# How can I get the overrides required for the plugin AND my own overrides installed?
Simply edit the overrides in plugins/system/emailasusername/template_overrides. You will need to disable, and then re-enable the system plugin to see your changes. Therefore I found it easier to enable the system plugin, make whatever changes are required directly in 
/templates/your_template/html/ and then copy the resulting file(s) to /plugins/system/emailasusername/templates_overrides/...
If you are wondering what file in /templates/your_template/html/ to edit, then you should head over to the Joomla site, and read up on template overrides. This link was correct at time of writing:
https://docs.joomla.org/How_to_override_the_output_from_the_Joomla!_core

# What about system generated emails?
These are handled by installing language overrides. However because of the way the Joomla user controller is programmed, it is impossible to include the users email address in the email (as a username would appear) Because the users email address is not supplied to the function (a printf) which renders the email text. Of course this could be done with a core hack, but those should be avoided at all costs, and in my experience makes a site basically un-maintainable.

# Architecture
emailasusername.php is the entry point, which extends apollo.php (apollo.php was a base class which was intended to form the basis of other plugins which never materialised for various reasons)
from there it uses the URL to decipher which "controller" to load. Note that controllers are "Email as username controllers" Not Joomla Controllers. Controllers are organised by extension, and stored in the accociated directory in the template_overrides directory/
Each controller inherits lunarExtension which provides functions / properties required by all controllers.
This is also where the username generation, and injection into post data occurrs.
The actuall template overrides are stored in the folder named after the version (e.g. 3.0.0) This allows it to support multiple versions of multiple extensions.

# You said there are two plugins
That right, while the system plugin handles the UI and autogeneration of usernames, the authentication plugin allows the user to login with thier email address and password. While you might be tempted to disable the default joomla authentication plugin, I'd councel against it, if you do you will find that you cant login to the administration section without knowing / remembering the email address you assigned to the admin user. You can find this out by looking in the user table however.

# Future
Basically none. I posted it here so the code could "live on" & anyone that wants to modify it for thier own needs can. Unfortunately, I just dont have the time to devote to it anymore!
